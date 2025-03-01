@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">General Ledger</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date</th>
                <th>Transaction Type</th>
                <th>Category</th>
                <th>Department</th>
                <th>Amount (KES)</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
            <tr>
                <td>{{ $transaction->created_at->format('Y-m-d') }}</td>
                <td>{{ ucfirst($transaction->transaction_type) }}</td>
                <td>{{ $transaction->category }}</td>
                <td>{{ $transaction->department->name ?? 'N/A' }}</td>
                <td>{{ number_format($transaction->amount, 2) }}</td>
                <td>{{ $transaction->description ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-3">
        {{ $transactions->links() }}
    </div>
</div>
@endsection