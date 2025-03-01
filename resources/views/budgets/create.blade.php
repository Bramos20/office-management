@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Budget</h2>
    <form action="{{ route('budgets.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Department:</label>
            <select name="department_id" class="form-control" required>
                @foreach($departments as $department)
                <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Allocated Amount (KES):</label>
            <input type="number" name="allocated_amount" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Year:</label>
            <input type="text" name="year" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Save Budget</button>
    </form>
</div>
@endsection