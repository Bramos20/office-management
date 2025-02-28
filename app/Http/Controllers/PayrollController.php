<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PayrollController extends Controller
{
    public function index()
    {
        $payrolls = Payroll::with('employee')->orderBy('pay_date', 'desc')->get();
        return view('payroll.index', compact('payrolls'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('payroll.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'basic_salary' => 'required|numeric',
            'deductions' => 'nullable|numeric',
            'bonuses' => 'nullable|numeric',
        ]);

        $netSalary = $request->basic_salary - $request->deductions + $request->bonuses;

        Payroll::create([
            'employee_id' => $request->employee_id,
            'basic_salary' => $request->basic_salary,
            'deductions' => $request->deductions ?? 0,
            'bonuses' => $request->bonuses ?? 0,
            'net_salary' => $netSalary,
            'pay_date' => Carbon::now(),
        ]);

        return redirect()->route('payroll.index')->with('success', 'Payroll recorded successfully.');
    }
}