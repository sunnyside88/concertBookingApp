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
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:user')->except('logout');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin');
    }

    public function makeBooking($concert_id, Request $request)
    {
        $request->validate(
            [
                'seatNum' => ['required', 'regex:/(^$|^\d+$)/', 'not_in:0']
            ]
        );

        $seat = Seat::where('concert_id', $concert_id)->get();
        $AvailableSeat = $seat->where('isBooked', 0);
        $seatNum = $request->seatNum;
        $totalAmount = $request->totalAmount;

        if (Count($AvailableSeat) >= $request->seatNum) {
            $booking = new Booking;
            $booking->concert_id = $concert_id;
            $booking->total_amount = $totalAmount;
            $booking->total_ticket = $seatNum;
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

    public function getBookingListing()
    {
        $bookings = DB::table('bookings')
            ->join('concerts', 'concerts.id', '=', 'bookings.concert_id')
            ->join('users', 'users.id', '=', 'bookings.user_id')
            ->get();
        return response()->json($bookings);
    }

    public function getBookingsByUserId($user_id)
    {

        $bookings = DB::table('bookings')
            ->where('user_id', '=', $user_id)
            ->join('concerts', 'concerts.id', '=', 'bookings.concert_id')
            ->get();
        return response()->json($bookings);
    }

    public function deleteBooking($id)
    {
        try {
            Booking::find($id)->delete();
            return response()->json('booking deleted');
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
