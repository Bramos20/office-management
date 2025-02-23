<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        return response()->json(Employee::with('department')->get(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employees',
            'department_id' => 'required|exists:departments,id',
        ]);

        $employee = Employee::create($request->all());
        return response()->json($employee, 201);
    }

    public function show(Employee $employee)
    {
        return response()->json($employee->load('department'), 200);
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'department_id' => 'required|exists:departments,id',
        ]);

        $employee->update($request->all());
        return response()->json($employee, 200);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return response()->json(null, 204);
    }
}
