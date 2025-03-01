<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budget;
use App\Models\Finance;
use App\Models\Department;
use App\Models\User;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Finance::with(['approver', 'department'])->latest()->paginate(10);
        return view('finances.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        $users = User::all();
        return view('finances.create', compact('departments', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'transaction_type' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'category' => 'required|string',
            'department_id' => 'required|exists:departments,id',
            'approved_by' => 'nullable|exists:users,id',
        ]);
    
        // Get department budget
        $budget = Budget::where('department_id', $request->department_id)
            ->where('year', date('Y'))
            ->first();
    
        if ($budget && $request->transaction_type === 'expense') {
            $newSpentAmount = $budget->spent_amount + $request->amount;
            if ($newSpentAmount > $budget->allocated_amount) {
                return redirect()->back()->with('error', 'This expense exceeds the allocated budget!');
            }
            $budget->update(['spent_amount' => $newSpentAmount]);
        }
    
        Finance::create($request->all());
        return redirect()->route('finances.index')->with('success', 'Transaction recorded.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Finance $finance)
    {
        return view('finances.show', compact('finance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Finance $finance)
    {
        $departments = Department::all();
        $users = User::all();
        return view('finances.edit', compact('finance', 'departments', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Finance $finance)
    {
        $request->validate([
            'transaction_type' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'category' => 'required|string',
            'department_id' => 'required|exists:departments,id',
            'approved_by' => 'nullable|exists:users,id',
        ]);
    
        $finance->update($request->all());
        return redirect()->route('finances.index')->with('success', 'Transaction updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Finance $finance)
    {
        $finance->delete();
        return redirect()->route('finances.index')->with('success', 'Transaction deleted successfully.');
    }
}
