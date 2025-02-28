@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-xl font-bold">Apply for Leave</h1>

    <form action="{{ route('leave_requests.store') }}" method="POST">
        @csrf

        <label for="employee_id" class="block font-bold mt-4">Employee:</label>
        <select name="employee_id" required class="w-full border p-2">
            @foreach ($employees as $employee)
                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
            @endforeach
        </select>

        <label for="start_date" class="block font-bold mt-4">Start Date:</label>
        <input type="date" name="start_date" required class="w-full border p-2">

        <label for="end_date" class="block font-bold mt-4">End Date:</label>
        <input type="date" name="end_date" required class="w-full border p-2">

        <label for="reason" class="block font-bold mt-4">Reason:</label>
        <textarea name="reason" required class="w-full border p-2"></textarea>

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded mt-4">Submit</button>
    </form>
</div>
@endsection