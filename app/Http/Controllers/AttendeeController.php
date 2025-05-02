<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAttendeeRequest;
use App\Services\AttendeeService;

class AttendeeController extends Controller
{
    protected $attendeeService;

    public function __construct(AttendeeService $attendeeService)
    {
        $this->attendeeService = $attendeeService;
    }

    public function store(StoreAttendeeRequest $request)
    {
        $attendee = $this->attendeeService->registerAttendee($request->validated());

        return response()->json([
            'message' => 'Attendee registered successfully',
            'data' => $attendee,
        ], 201);
    }
}

