@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-xl font-bold">Performance Reviews</h1>

    <a href="{{ route('performance_reviews.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Review</a>

    <table class="w-full mt-4 border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">Employee</th>
                <th class="border p-2">Reviewer</th>
                <th class="border p-2">Rating</th>
                <th class="border p-2">Comments</th>
                <th class="border p-2">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reviews as $review)
                <tr>
                    <td class="border p-2">{{ $review->employee->name }}</td>
                    <td class="border p-2">{{ $review->reviewer->name }}</td>
                    <td class="border p-2">{{ $review->rating }}/5</td>
                    <td class="border p-2">{{ $review->comments }}</td>
                    <td class="border p-2">{{ $review->created_at->format('d M Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
