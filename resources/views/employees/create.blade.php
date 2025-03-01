@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New Employee</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('employees.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="position">Position</label>
            <input type="text" name="position" id="position" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="department_id">Department</label>
            <select name="department_id" id="department_id" class="form-control" required>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <select name="role" id="role" class="form-control" required>
                <option value="employee">Employee</option>
                <option value="manager">Manager</option>
                <option value="hod">HOD</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Add Employee</button>
    </form>
</div>
@endsection
