<?php
namespace App\Services;

use App\Models\Attendee;

class AttendeeService
{
    public function registerAttendee(array $data): Attendee
    {
        return Attendee::create($data);
    }

    public function findByEmail(string $email): ?Attendee
    {
        return Attendee::where('email', $email)->first();
    }
}
