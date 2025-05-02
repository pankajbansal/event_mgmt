<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Services\BookingService;
use App\Models\Event;
use App\Models\Attendee;

class BookingController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function store(StoreBookingRequest $request)
    {
        $event = Event::findOrFail($request->event_id);
        $attendee = Attendee::findOrFail($request->attendee_id);

        try {
            $booking = $this->bookingService->createBooking($event, $attendee);

            return response()->json(['message' => 'Booking created successfully', 'data' => $booking], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }
}
