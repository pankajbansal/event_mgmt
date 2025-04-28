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
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'attendee_id' => 'required|exists:attendees,id',
        ]);

        $event = Event::findOrFail($validated['event_id']);

        if ($event->bookings()->count() >= $event->capacity) {
            return response()->json(['message' => 'Event is fully booked.'], 400);
        }

        $exists = Booking::where('event_id', $validated['event_id'])
                         ->where('attendee_id', $validated['attendee_id'])
                         ->exists();

        if ($exists) {
            return response()->json(['message' => 'Attendee already booked this event.'], 400);
        }

        $booking = Booking::create($validated);

        return response()->json($booking, 201);
    }
}
