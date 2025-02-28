@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-xl font-bold">Payroll Records</h1>

    <a href="{{ route('payroll.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Payroll</a>

    <table class="w-full mt-4 border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">Employee</th>
                <th class="border p-2">Basic Salary</th>
                <th class="border p-2">Deductions</th>
                <th class="border p-2">Bonuses</th>
                <th class="border p-2">Net Salary</th>
                <th class="border p-2">Pay Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payrolls as $payroll)
                <tr>
                    <td class="border p-2">{{ $payroll->employee->name }}</td>
                    <td class="border p-2">${{ number_format($payroll->basic_salary, 2) }}</td>
                    <td class="border p-2">${{ number_format($payroll->deductions, 2) }}</td>
                    <td class="border p-2">${{ number_format($payroll->bonuses, 2) }}</td>
                    <td class="border p-2 font-bold">${{ number_format($payroll->net_salary, 2) }}</td>
                    <td class="border p-2">{{ $payroll->pay_date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection