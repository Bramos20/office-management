@extends('layouts.app')

@section('title', 'Employees')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-xl font-bold">Employee List</h1>

    <a href="{{ route('employees.create') }}" class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded">Add Employee</a>

    <table class="w-full mt-4 border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">Name</th>
                <th class="border p-2">Email</th>
                <th class="border p-2">Position</th>
                <th class="border p-2">Department</th>
                <th class="border p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr>
                    <td class="border p-2">{{ $employee->name }}</td>
                    <td class="border p-2">{{ $employee->email }}</td>
                    <td class="border p-2">{{ $employee->position }}</td>
                    <td class="border p-2">{{ $employee->department->name }}</td>
                    <td class="border p-2">
                        <a href="{{ route('employees.edit', $employee->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</a>
                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection