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
        $today = date('Y-m-d');
        $startDate = date('Y-m-d', strtotime($today. ' + 1 days'));
        $endDate = date('Y-m-d', strtotime($today. ' + 5 days'));
        $response = $this->postJson('/api/events', [
            'name' => 'Sample Event 11',
            'country' => 'USA',
            'capacity' => 100,
            'start_time' => $startDate,
            'end_time' => $endDate,
        ]);

        $response->assertStatus(201);
        // $response->assertJson(['name' => 'Sample Event']);
        $response->assertJson([
            'data' => [
                'name' => 'Sample Event 11',
            ]
        ]);
        
    }

    public function test_can_list_events()
    {
        Event::factory()->create();

        $response = $this->getJson('/api/events');

        $response->assertStatus(200);
    }
}
