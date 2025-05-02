<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Attendee;

class AttendeeTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_register_attendee()
    {
        $response = $this->postJson('/api/attendees', [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('attendees', ['email' => 'johndoe@example.com']);
    }

    public function test_cannot_register_duplicate_email()
    {
        Attendee::factory()->create(['email' => 'johndoe@example.com']);

        $response = $this->postJson('/api/attendees', [
            'name' => 'John Doe 2',
            'email' => 'johndoe@example.com',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['email']);
    }
}
