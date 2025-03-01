@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Profit & Loss Statement</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Department</th>
                <th>Income (KES)</th>
                <th>Expenses (KES)</th>
                <th>Profit (KES)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($report as $data)
            <tr>
                <td>{{ $data['department'] }}</td>
                <td>{{ number_format($data['income'], 2) }}</td>
                <td>{{ number_format($data['expenses'], 2) }}</td>
                <td>{{ number_format($data['profit'], 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection