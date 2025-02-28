<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Employee;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function index()
    {
        $assets = Asset::with('employee')->get();
        return view('assets.index', compact('assets'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('assets.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'serial_number' => 'required|unique:assets',
            'status' => 'required',
            'assigned_to' => 'nullable|exists:employees,id',
        ]);

        Asset::create($request->all());

        return redirect()->route('assets.index')->with('success', 'Asset added.');
    }

    public function updateStatus(Request $request, Asset $asset)
    {
        $request->validate(['status' => 'required']);
        $asset->update(['status' => $request->status]);

        return redirect()->route('assets.index')->with('success', 'Asset status updated.');
    }
}
