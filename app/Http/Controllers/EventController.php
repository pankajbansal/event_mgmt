<?php

namespace App\Http\Controllers;

use App\Services\EventService;
use App\Http\Requests\EventRequest;
use Illuminate\Http\Request;

class EventController extends Controller
{
    protected $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 10);
        $events = $this->eventService->getAllEvents($perPage);

        return response()->json($events);
    }

    public function store(EventRequest $request)
    {
        $event = $this->eventService->createEvent($request->validated());

        return response()->json([
            'message' => 'Event created successfully.',
            'data' => $event
        ], 201);
    }

    public function show($id)
    {
        $event = $this->eventService->getEventById($id);

        if (!$event) {
            return response()->json(['message' => 'Event not found.'], 404);
        }

        return response()->json($event);
    }

    public function update(EventRequest $request, $id)
    {
        $event = $this->eventService->updateEvent($id, $request->validated());

        if (!$event) {
            return response()->json(['message' => 'Event not found.'], 404);
        }

        return response()->json([
            'message' => 'Event updated successfully.',
            'data' => $event
        ]);
    }

    public function destroy($id)
    {
        $deleted = $this->eventService->deleteEvent($id);

        if (!$deleted) {
            return response()->json(['message' => 'Event not found.'], 404);
        }

        return response()->json(['message' => 'Event deleted successfully.']);
    }
}

