@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Add New Financial Transaction</h2>
    
    @if (session('error'))
        <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif
    
    <form action="{{ route('finances.store') }}" method="POST">
        @csrf
        
        <div class="mb-4">
            <label class="block text-gray-700">Transaction Type</label>
            <select name="transaction_type" class="w-full p-2 border rounded">
                <option value="income">Income</option>
                <option value="expense">Expense</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Amount</label>
            <input type="number" name="amount" step="0.01" class="w-full p-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Category</label>
            <input type="text" name="category" class="w-full p-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Description</label>
            <textarea name="description" class="w-full p-2 border rounded"></textarea>
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700">Department</label>
            <select name="department_id" class="w-full p-2 border rounded">
                @foreach($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save Transaction</button>
    </form>
</div>
@endsection