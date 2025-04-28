<?php

use App\Http\Controllers\AttendeeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::apiResource('events', EventController::class)->except(['create', 'edit']);
Route::post('attendees', [AttendeeController::class, 'store']);
Route::post('bookings', [BookingController::class, 'store']);
