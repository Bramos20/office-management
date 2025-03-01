@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Budgets</h2>
    <a href="{{ route('budgets.create') }}" class="btn btn-primary">Create New Budget</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Department</th>
                <th>Allocated Amount (KES)</th>
                <th>Spent Amount (KES)</th>
                <th>Year</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($budgets as $budget)
            <tr>
                <td>{{ $budget->department->name }}</td>
                <td>{{ number_format($budget->allocated_amount, 2) }}</td>
                <td>{{ number_format($budget->spent_amount, 2) }}</td>
                <td>{{ $budget->year }}</td>
                <td>{{ ucfirst($budget->status) }}</td>
                <td>
                    <a href="{{ route('budgets.edit', $budget->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('budgets.destroy', $budget->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection