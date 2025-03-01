<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('department')->get();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('employees.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email', // Ensure email is unique in users table
            'position' => 'required',
            'department_id' => 'required|exists:departments,id',
            'role' => 'required|in:admin,manager,employee' // Validate role input
        ]);
    
        // Create a user for the employee
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('password'), // Default password, to be changed by user
            'role' => $request->role
        ]);
    
        // Create the employee and link it to the user
        Employee::create([
            'name' => $request->name,
            'email' => $request->email,
            'position' => $request->position,
            'department_id' => $request->department_id,
            'user_id' => $user->id // Link employee to user
        ]);
    
        // Send email to employee with a password reset link
        $user->sendPasswordResetNotification($user->email);
    
        return redirect()->route('employees.index')->with('success', 'Employee added successfully. An email has been sent for password setup.');
    }
    

    public function edit(Employee $employee)
    {
        $departments = Department::all();
        return view('employees.edit', compact('employee', 'departments'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required',
            'email' => "required|email|unique:employees,email,{$employee->id}",
            'position' => 'required',
            'department_id' => 'required|exists:departments,id'
        ]);

        $employee->update($request->all());
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted.');
    }
}
