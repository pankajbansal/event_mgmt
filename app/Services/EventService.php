<?php
namespace App\Services;

use App\Models\Event;

class EventService
{
    public function getAllEvents($perPage = 10)
    {
        return Event::paginate($perPage);
    }

    public function getEventById($id)
    {
        return Event::find($id);
    }

    public function createEvent(array $data)
    {
        return Event::create($data);
    }

    public function updateEvent($id, array $data)
    {
        $event = Event::find($id);

        if (!$event) {
            return null;
        }

        $event->update($data);

        return $event;
    }

    public function deleteEvent($id)
    {
        $event = Event::find($id);

        if (!$event) {
            return false;
        }

        return $event->delete();
    }
}
