<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Concert;
use App\Models\Seat;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Exception;

class BookingController extends Controller
{
    public function makeBooking($concert_id, Request $request)
    {
        $request->validate(
            [
                'seatNum' => ['required', 'regex:/(^$|^\d+$)/', 'not_in:0'],
            ]
        );

        $seat = Seat::where('concert_id', $concert_id)->get();
        $AvailableSeat = $seat->where('isBooked', 0);
        $seatNum = $request->seatNum;

        if (Count($AvailableSeat) >= $request->seatNum) {
            $booking = new Booking;
            $booking->concert_id = $concert_id;
            $booking->user_id = Auth::id();
            $booking->save();

            $bookingId = $booking->id;
            $selectedSeats = $AvailableSeat->take($seatNum);
            foreach ($selectedSeats as $s) {
                $s->booking_id = $bookingId;
                $s->isBooked = 1;
                $s->save();
            }
            return redirect()->route('home')->with('successfulStatus', 'Concert Booked Successfully');
        } else {
            return redirect()->back()->with('failedStatus', 'Available Seat Not Enough');
        }
    }

    public function showBookingListing()
    {
        return view('userBooking');
    }

    public function getBookingListing()
    {
        $user = Auth::user()->id;
        $bookings = DB::table('bookings')
            ->where('user_id', '=', $user)
            ->get();
        return response()->json($bookings);
    }

    public function deleteBooking($id)
    {
        try {
            booking::find($id)->delete();
            return response()->json('Booking deleted');
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
