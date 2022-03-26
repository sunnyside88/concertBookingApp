<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Concert;
use App\Models\Seat;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function makeBooking($concert_id,Request $request)
    {
        $request->validate(
            [
                'seatNum'=> ['required','regex:/(^$|^\d+$)/','not_in:0'],
            ]);

        $seat = Seat::where('concert_id', $concert_id)->get();
        $AvailableSeat = $seat->where('IsBooked', false);

        if(Count($AvailableSeat)>=$request->seatNum)
        {
            $seatNum = $request->seatNum;

            for($i=0;$i<$seatNum;$i++){
                $booking = new Booking;
                $booking->Seat_id = $AvailableSeat[$i]->id;
                $booking->Concert_id = $concert_id;
                $booking->User_id = Auth::id();

                $booking->save();
            }

            return redirect()->back()->with('successfulStatus','Concert Booked Successfully');
        }else
        {
            return redirect()->back()->with('failedStatus','Available Seat Not Enough');
        }


    }
}
