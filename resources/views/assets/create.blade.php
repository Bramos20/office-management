@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-xl font-bold">Add Asset</h1>

    <form action="{{ route('assets.store') }}" method="POST">
        @csrf

        <label for="name" class="block font-bold mt-4">Asset Name:</label>
        <input type="text" name="name" required class="w-full border p-2">

        <label for="category" class="block font-bold mt-4">Category:</label>
        <input type="text" name="category" required class="w-full border p-2">

        <label for="serial_number" class="block font-bold mt-4">Serial Number:</label>
        <input type="text" name="serial_number" required class="w-full border p-2">

        <label for="status" class="block font-bold mt-4">Status:</label>
        <select name="status" class="w-full border p-2">
            <option value="available">Available</option>
            <option value="assigned">Assigned</option>
            <option value="maintenance">Maintenance</option>
            <option value="retired">Retired</option>
        </select>

        <label for="assigned_to" class="block font-bold mt-4">Assign to (Optional):</label>
        <select name="assigned_to" class="w-full border p-2">
            <option value="">None</option>
            @foreach ($employees as $employee)
                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
            @endforeach
        </select>

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded mt-4">Add Asset</button>
    </form>
</div>
@endsection
