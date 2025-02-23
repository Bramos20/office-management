<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meeting;
use App\Models\Employee;
use App\Notifications\MeetingNotification;

class MeetingController extends Controller
{
    public function index()
    {
        return Meeting::with('organizer')->latest()->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'scheduled_at' => 'required|date',
            'organizer_id' => 'required|exists:employees,id',
            'participants' => 'required|array',
            'participants.*' => 'exists:employees,id',
        ]);

        $meeting = Meeting::create($request->all());

        // Notify participants
        $participants = Employee::whereIn('id', $request->participants)->get();
        foreach ($participants as $participant) {
            $participant->notify(new MeetingNotification($meeting));
        }

        return response()->json($meeting, 201);
    }
}
