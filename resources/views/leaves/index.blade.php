@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-xl font-bold">Leave Requests</h1>

    <a href="{{ route('leaves.create') }}" class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded">Request Leave</a>

    <table class="w-full mt-4 border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">Employee</th>
                <th class="border p-2">Start Date</th>
                <th class="border p-2">End Date</th>
                <th class="border p-2">Status</th>
                <th class="border p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($leaveRequests as $leave)
                <tr>
                    <td class="border p-2">{{ $leave->employee->name }}</td>
                    <td class="border p-2">{{ $leave->start_date }}</td>
                    <td class="border p-2">{{ $leave->end_date }}</td>
                    <td class="border p-2">{{ ucfirst($leave->status) }}</td>
                    <td class="border p-2">
                        @if ($leave->status === 'pending')
                            <form action="{{ route('leaves.approve', $leave->id) }}" method="POST" class="inline">
                                @csrf @method('PATCH')
                                <button class="bg-green-500 text-white px-2 py-1 rounded">Approve</button>
                            </form>
                            <form action="{{ route('leaves.reject', $leave->id) }}" method="POST" class="inline">
                                @csrf @method('PATCH')
                                <button class="bg-red-500 text-white px-2 py-1 rounded">Reject</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection