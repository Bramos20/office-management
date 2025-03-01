@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Financial Transactions</h2>
    
    <!-- Filter Form -->
    <form method="GET" action="{{ route('finances.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <label for="transaction_type">Transaction Type:</label>
                <select name="transaction_type" class="form-control">
                    <option value="">All</option>
                    <option value="income">Income</option>
                    <option value="expense">Expense</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="category">Category:</label>
                <input type="text" name="category" class="form-control" placeholder="e.g. Salary, Taxes">
            </div>
            <div class="col-md-3">
                <label for="date">Date:</label>
                <input type="date" name="date" class="form-control">
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>
    
    <!-- Transactions Table -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Date</th>
                <th>Transaction Type</th>
                <th>Category</th>
                <th>Amount (KES)</th>
                <th>Department</th>
                <th>Approved By</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($finances as $finance)
            <tr>
                <td>{{ $finance->created_at->format('d M Y') }}</td>
                <td>{{ ucfirst($finance->transaction_type) }}</td>
                <td>{{ $finance->category }}</td>
                <td>{{ number_format($finance->amount, 2) }}</td>
                <td>{{ $finance->department->name ?? 'N/A' }}</td>
                <td>{{ $finance->approver->name ?? 'Pending' }}</td>
                <td>
                    <a href="{{ route('finances.show', $finance->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('finances.edit', $finance->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('finances.destroy', $finance->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-3">
        {{ $finances->links() }}
    </div>
</div>
@endsection