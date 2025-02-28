@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-xl font-bold">Add Payroll</h1>

    <form action="{{ route('payroll.store') }}" method="POST">
        @csrf

        <label for="employee_id" class="block font-bold mt-4">Employee:</label>
        <select name="employee_id" required class="w-full border p-2">
            @foreach ($employees as $employee)
                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
            @endforeach
        </select>

        <label for="basic_salary" class="block font-bold mt-4">Basic Salary:</label>
        <input type="number" name="basic_salary" required class="w-full border p-2">

        <label for="deductions" class="block font-bold mt-4">Deductions:</label>
        <input type="number" name="deductions" class="w-full border p-2">

        <label for="bonuses" class="block font-bold mt-4">Bonuses:</label>
        <input type="number" name="bonuses" class="w-full border p-2">

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded mt-4">Submit</button>
    </form>
</div>
@endsection