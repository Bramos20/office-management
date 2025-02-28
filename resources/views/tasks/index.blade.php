@extends('layouts.app')

@section('title', 'Tasks')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-xl font-bold">Task List</h1>

    <a href="{{ route('tasks.create') }}" class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded">Assign Task</a>

    <table class="w-full mt-4 border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">Title</th>
                <th class="border p-2">Assigned To</th>
                <th class="border p-2">Status</th>
                <th class="border p-2">Deadline</th>
                <th class="border p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td class="border p-2">{{ $task->title }}</td>
                    <td class="border p-2">{{ $task->employee->name }}</td>
                    <td class="border p-2">{{ ucfirst($task->status) }}</td>
                    <td class="border p-2">{{ $task->deadline ?? 'No deadline' }}</td>
                    <td class="border p-2">
                        <a href="{{ route('tasks.edit', $task->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</a>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline">
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