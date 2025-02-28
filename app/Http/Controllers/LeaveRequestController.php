<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\LeaveRequestNotification;

class LeaveRequestController extends Controller
{
    public function index()
    {
        $leaveRequests = LeaveRequest::with('employee')->get();
        return view('leaves.index', compact('leaveRequests'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('leaves.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required'
        ]);

        $leaveRequest = LeaveRequest::create($request->all());

        // Notify admin
        $admin = User::where('role', 'admin')->first();
        if ($admin) {
            $admin->notify(new LeaveRequestNotification($leaveRequest));
        }

        return redirect()->route('leaves.index')->with('success', 'Leave request submitted.');
    }

    public function approve(LeaveRequest $leaveRequest)
    {
        $leaveRequest->update(['status' => 'approved']);
        $leaveRequest->employee->notify(new LeaveRequestNotification($leaveRequest, 'approved'));

        return redirect()->route('leaves.index')->with('success', 'Leave request approved.');
    }

    public function reject(LeaveRequest $leaveRequest)
    {
        $leaveRequest->update(['status' => 'rejected']);
        $leaveRequest->employee->notify(new LeaveRequestNotification($leaveRequest, 'rejected'));

        return redirect()->route('leaves.index')->with('success', 'Leave request rejected.');
    }
}
