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
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
    
        // If the user is an admin, show all employees
        if ($user->role === 'admin') {
            $employees = Employee::all();
        } 
        // If the user is an HOD, show only employees in their department
        elseif ($user->role === 'hod') {
            $employees = Employee::where('department_id', $user->employee->department_id)->get();
        } 
        // If the user is not an admin or HOD, deny access
        else {
            abort(403, 'Unauthorized access.');
        }
    
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
            'email' => 'required|email|unique:users,email', // Validate against users table
            'position' => 'required',
            'department_id' => 'required|exists:departments,id',
            'role' => 'required|in:admin,manager,hod,employee' // Ensure valid role selection
        ]);
    
        // Create a user first
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('password'), // Default password
            'role' => $request->role // Set the assigned role
        ]);
    
        // Now create the employee and assign the user_id
        $employee = Employee::create([
            'name' => $request->name,
            'email' => $request->email,
            'position' => $request->position,
            'department_id' => $request->department_id,
            'user_id' => $user->id // Correctly link user_id
        ]);
    
        // Send email to employee with password reset link
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
