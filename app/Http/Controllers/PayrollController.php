<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payroll;
use App\Models\Employee;
use App\Notifications\PayslipNotification;

class PayrollController extends Controller
{
    public function index()
    {
        return Payroll::with('employee')->latest()->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'basic_salary' => 'required|numeric',
            'tax' => 'nullable|numeric',
            'deductions' => 'nullable|numeric',
            'pay_date' => 'required|date',
        ]);

        // Auto-calculate net salary
        $net_salary = $request->basic_salary - ($request->tax + $request->deductions);

        $payroll = Payroll::create([
            'employee_id' => $request->employee_id,
            'basic_salary' => $request->basic_salary,
            'tax' => $request->tax ?? 0,
            'deductions' => $request->deductions ?? 0,
            'net_salary' => $net_salary,
            'pay_date' => $request->pay_date,
        ]);

        // Notify the employee
        $employee = Employee::find($request->employee_id);
        $employee->notify(new PayslipNotification($payroll));

        return response()->json($payroll, 201);
    }
}

