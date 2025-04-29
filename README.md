# Event Booking System API

A RESTful API for managing events, attendees, and bookings.

## Setup Instructions

1. Clone the repository.
2. Run `composer install`.
3. Copy `.env.example` to `.env` and update DB settings.
4. Run `php artisan migrate`.
5. Start the server: `php artisan serve`.

## API Endpoints
- You can import Event_Booking_API_Collection.postman_collection.json file in postman for API signatures
- Events CRUD
- Attendee Registration
- Event Booking

## Authentication & Authorization
- Please refer the PDF Authentication&Authorization.pdf
  
## Testing

```bash
php artisan test
