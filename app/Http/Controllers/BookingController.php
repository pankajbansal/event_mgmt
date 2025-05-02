<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use App\Models\Attendee;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $attendee = Attendee::find($request->attendee_id);
        if(!$attendee){
            return response()->json(['message' => 'Attendee is not registered.'], 400);   
        }
        
        $eventDetails = Event::find($request->event_id);
        if(!$eventDetails){
            return response()->json(['message' => 'Event is not registered.'], 400);   
        }

        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'attendee_id' => 'required|exists:attendees,id',
        ]);

        
        
        $event = Event::findOrFail($validated['event_id']);

        if ($event->bookings()->count() >= $event->capacity) {
            return response()->json(['message' => 'Event is fully booked.'], 422);
        }

        $exists = Booking::where('event_id', $validated['event_id'])
                         ->where('attendee_id', $validated['attendee_id'])
                         ->exists();

        if ($exists) {
            return response()->json(['message' => 'Attendee already booked this event.'], 422);
        }

        $booking = Booking::create($validated);

        return response()->json($booking, 201);
    }
}
