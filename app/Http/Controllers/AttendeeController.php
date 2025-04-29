<?php

namespace App\Http\Controllers;

use App\Models\Attendee;
use Illuminate\Http\Request;

class AttendeeController extends Controller
{
    public function store(Request $request)
    {
        
        $attendeeDetails = Attendee::where('email', $request->input('email'))->first();

        if($attendeeDetails){
            return response()->json(['message' => 'Email is already registered.'], 400); 
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:attendees,email',
        ]);


        $attendee = Attendee::create($validated);

        return response()->json($attendee, 201);
    }
}
