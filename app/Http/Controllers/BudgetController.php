<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Department;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function index()
    {
        $budgets = Budget::with('department')->get();
        return view('budgets.index', compact('budgets'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('budgets.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'allocated_amount' => 'required|numeric|min:0',
            'year' => 'required|string',
        ]);

        Budget::create($request->all());
        return redirect()->route('budgets.index')->with('success', 'Budget created successfully.');
    }

    public function edit(Budget $budget)
    {
        $departments = Department::all();
        return view('budgets.edit', compact('budget', 'departments'));
    }

    public function update(Request $request, Budget $budget)
    {
        $request->validate([
            'allocated_amount' => 'required|numeric|min:0',
            'status' => 'required|string',
        ]);

        $budget->update($request->all());
        return redirect()->route('budgets.index')->with('success', 'Budget updated successfully.');
    }

    public function destroy(Budget $budget)
    {
        $budget->delete();
        return redirect()->route('budgets.index')->with('success', 'Budget deleted successfully.');
    }
}

