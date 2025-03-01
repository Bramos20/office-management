@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add KPI</h2>
    <form action="{{ route('kpis.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Employee</label>
            <select name="employee_id" class="form-control" required>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>KPI Name</label>
            <input type="text" name="kpi_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Target Value</label>
            <input type="number" name="target_value" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Actual Value (Optional)</label>
            <input type="number" name="actual_value" class="form-control">
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="on track">On Track</option>
                <option value="needs improvement">Needs Improvement</option>
                <option value="off track">Off Track</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Save KPI</button>
    </form>
</div>
@endsection