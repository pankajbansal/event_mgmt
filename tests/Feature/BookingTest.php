<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Event;
use App\Models\Attendee;
use App\Models\Booking;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_booking()
    {
        $event = Event::factory()->create(['capacity' => 1]);
        $attendee = Attendee::factory()->create();

        $response = $this->postJson('/api/bookings', [
            'event_id' => $event->id,
            'attendee_id' => $attendee->id,
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('bookings', [
            'event_id' => $event->id,
            'attendee_id' => $attendee->id,
        ]);
    }

    public function test_cannot_book_same_event_twice()
    {
        $event = Event::factory()->create(['capacity' => 2]);
        $attendee = Attendee::factory()->create();

        Booking::create(['event_id' => $event->id, 'attendee_id' => $attendee->id]);

        $response = $this->postJson('/api/bookings', [
            'event_id' => $event->id,
            'attendee_id' => $attendee->id,
        ]);

        $response->assertStatus(422);
        $response->assertJson(['message' => 'Attendee already booked this event.']);
    }

    public function test_cannot_book_event_if_full()
    {
        $event = Event::factory()->create(['capacity' => 1]);
        $attendee1 = Attendee::factory()->create();
        $attendee2 = Attendee::factory()->create();

        Booking::create(['event_id' => $event->id, 'attendee_id' => $attendee1->id]);

        $response = $this->postJson('/api/bookings', [
            'event_id' => $event->id,
            'attendee_id' => $attendee2->id,
        ]);

        $response->assertStatus(422);
        $response->assertJson(['message' => 'Event is fully booked.']);
    }
}
