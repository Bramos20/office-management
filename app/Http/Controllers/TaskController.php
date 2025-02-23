<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Notifications\TaskAssignedEmailNotification;

class TaskController extends Controller
{
    public function index()
    {
        return response()->json(Task::with('employee')->get(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'employee_id' => 'required|exists:employees,id',
            'due_date' => 'nullable|date',
        ]);
    
        $task = Task::create($request->all());

        $task->employee->notify(new TaskAssignedEmailNotification($task));
        return response()->json($task, 201);
    }
    

    public function show(Task $task)
    {
        return response()->json($task->load('employee'), 200);
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required',
            'employee_id' => 'required|exists:employees,id',
            'status' => 'required|in:pending,in_progress,completed',
            'due_date' => 'nullable|date',
        ]);

        $task->update($request->all());
        return response()->json($task, 200);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(null, 204);
    }
}