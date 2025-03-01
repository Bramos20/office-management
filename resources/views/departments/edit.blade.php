@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Department</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('departments.update', $department->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Department Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $department->name }}" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update Department</button>
    </form>
</div>
@endsection