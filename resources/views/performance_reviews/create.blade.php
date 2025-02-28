@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-xl font-bold">Add Performance Review</h1>

    <form action="{{ route('performance_reviews.store') }}" method="POST">
        @csrf

        <label for="employee_id" class="block font-bold mt-4">Employee:</label>
        <select name="employee_id" required class="w-full border p-2">
            @foreach ($employees as $employee)
                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
            @endforeach
        </select>

        <label for="reviewer_id" class="block font-bold mt-4">Reviewer:</label>
        <select name="reviewer_id" required class="w-full border p-2">
            @foreach ($reviewers as $reviewer)
                <option value="{{ $reviewer->id }}">{{ $reviewer->name }}</option>
            @endforeach
        </select>

        <label for="rating" class="block font-bold mt-4">Rating (1-5):</label>
        <input type="number" name="rating" min="1" max="5" required class="w-full border p-2">

        <label for="comments" class="block font-bold mt-4">Comments:</label>
        <textarea name="comments" required class="w-full border p-2"></textarea>

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded mt-4">Submit</button>
    </form>
</div>
@endsection