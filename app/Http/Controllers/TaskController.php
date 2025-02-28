<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Notifications\TaskAssignedNotification;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('employee')->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('tasks.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'employee_id' => 'required|exists:employees,id',
            'deadline' => 'nullable|date'
        ]);
    
        $task = Task::create($request->all());
    
        // Send notification to the assigned employee
        $task->employee->notify(new TaskAssignedNotification($task));
    
        return redirect()->route('tasks.index')->with('success', 'Task assigned successfully and notification sent.');
    }

    public function edit(Task $task)
    {
        $employees = Employee::all();
        return view('tasks.edit', compact('task', 'employees'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required',
            'employee_id' => 'required|exists:employees,id',
            'status' => 'required|in:pending,in_progress,completed',
            'deadline' => 'nullable|date'
        ]);

        $task->update($request->all());
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted.');
    }
}
