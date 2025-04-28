<?php

namespace Tests\Feature;

use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_event()
    {
        $response = $this->postJson('/api/events', [
            'name' => 'Sample Event',
            'country' => 'USA',
            'capacity' => 100,
            'start_time' => now()->addHours(1),
            'end_time' => now()->addHours(2),
        ]);

        $response->assertStatus(201);
        $response->assertJson(['name' => 'Sample Event']);
    }

    public function test_can_list_events()
    {
        Event::factory()->create();

        $response = $this->getJson('/api/events');

        $response->assertStatus(200);
    }
}
