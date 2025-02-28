<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with('employee')->orderBy('date', 'desc')->get();
        return view('attendance.index', compact('attendances'));
    }

    public function markAttendance()
    {
        $employee = Auth::user();

        $attendance = Attendance::firstOrCreate(
            [
                'employee_id' => $employee->id,
                'date' => Carbon::today()
            ],
            ['clock_in' => Carbon::now()]
        );

        return redirect()->route('attendance.index')->with('success', 'Clock-in recorded successfully.');
    }

    public function clockOut()
    {
        $employee = Auth::user();

        $attendance = Attendance::where('employee_id', $employee->id)
            ->where('date', Carbon::today())
            ->first();

        if ($attendance && !$attendance->clock_out) {
            $attendance->update(['clock_out' => Carbon::now()]);
            return redirect()->route('attendance.index')->with('success', 'Clock-out recorded successfully.');
        }

        return redirect()->route('attendance.index')->with('error', 'No clock-in record found.');
    }
}
