@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-xl font-bold">Asset Management</h1>

    <a href="{{ route('assets.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Asset</a>

    <table class="w-full mt-4 border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">Name</th>
                <th class="border p-2">Category</th>
                <th class="border p-2">Serial Number</th>
                <th class="border p-2">Status</th>
                <th class="border p-2">Assigned To</th>
                <th class="border p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($assets as $asset)
                <tr>
                    <td class="border p-2">{{ $asset->name }}</td>
                    <td class="border p-2">{{ $asset->category }}</td>
                    <td class="border p-2">{{ $asset->serial_number }}</td>
                    <td class="border p-2">{{ ucfirst($asset->status) }}</td>
                    <td class="border p-2">{{ optional($asset->employee)->name ?? 'Unassigned' }}</td>
                    <td class="border p-2">
                        <form action="{{ route('assets.updateStatus', $asset->id) }}" method="POST">
                            @csrf
                            <select name="status" class="border p-1">
                                <option value="available" {{ $asset->status == 'available' ? 'selected' : '' }}>Available</option>
                                <option value="assigned" {{ $asset->status == 'assigned' ? 'selected' : '' }}>Assigned</option>
                                <option value="maintenance" {{ $asset->status == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                <option value="retired" {{ $asset->status == 'retired' ? 'selected' : '' }}>Retired</option>
                            </select>
                            <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded">Update</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection