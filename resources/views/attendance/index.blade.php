@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-xl font-bold">Attendance Records</h1>

    <form action="{{ route('attendance.clock-in') }}" method="POST" class="inline">
        @csrf
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Clock In</button>
    </form>

    <form action="{{ route('attendance.clock-out') }}" method="POST" class="inline">
        @csrf
        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Clock Out</button>
    </form>

    <table class="w-full mt-4 border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">Employee</th>
                <th class="border p-2">Date</th>
                <th class="border p-2">Clock In</th>
                <th class="border p-2">Clock Out</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendances as $attendance)
                <tr>
                    <td class="border p-2">{{ $attendance->employee->name }}</td>
                    <td class="border p-2">{{ $attendance->date }}</td>
                    <td class="border p-2">{{ $attendance->clock_in }}</td>
                    <td class="border p-2">{{ $attendance->clock_out ?? 'Not clocked out' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection