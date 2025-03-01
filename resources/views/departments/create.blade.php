@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New Department</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('departments.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Department Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Add Department</button>
    </form>
</div>
@endsection