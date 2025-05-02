<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Event;
use App\Models\Attendee;

class BookingService
{
    public function createBooking(Event $event, Attendee $attendee): Booking
    {
        // Check if attendee already booked
        if ($event->bookings()->where('attendee_id', $attendee->id)->exists()) {
            throw new \Exception('Attendee already booked this event.');
        }

        // Check if event is full
        if ($event->bookings()->count() >= $event->capacity) {
            throw new \Exception('Event is fully booked.');
        }

        return Booking::create([
            'event_id' => $event->id,
            'attendee_id' => $attendee->id,
        ]);
    }
}
