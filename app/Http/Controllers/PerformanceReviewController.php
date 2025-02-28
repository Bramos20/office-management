<?php

namespace App\Http\Controllers;

use App\Models\PerformanceReview;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;

class PerformanceReviewController extends Controller
{
    public function index()
    {
        $reviews = PerformanceReview::with('employee', 'reviewer')->get();
        return view('performance_reviews.index', compact('reviews'));
    }

    public function create()
    {
        $employees = Employee::all();
        $reviewers = User::where('role', 'manager')->get();
        return view('performance_reviews.create', compact('employees', 'reviewers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'reviewer_id' => 'required|exists:users,id',
            'rating' => 'required|integer|min:1|max:5',
            'comments' => 'required|string|max:255'
        ]);

        PerformanceReview::create($request->all());

        return redirect()->route('performance_reviews.index')->with('success', 'Performance review added.');
    }
}
