<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = auth()->user()
            ->bookings()
            ->with('property')
            ->latest()
            ->paginate(10);

        return view('bookings.index', compact('bookings'));
    }

    public function cancel(Booking $booking)
    {
        abort_if($booking->user_id !== auth()->id(), 403);
        abort_if($booking->status !== 'pending', 400, 'Seules les réservations en attente peuvent être annulées.');

        $booking->update(['status' => 'cancelled']);

        return back()->with('success', 'Réservation annulée avec succès.');
    }
}