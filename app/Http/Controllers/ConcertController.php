<?php

namespace App\Http\Controllers;

use App\Models\Concert;
use App\Models\Seat;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConcertController extends Controller
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
    public function addConcert(Request $request)
    {
        $totalSeats = $request->totalSeats;

        $concert = Concert::create([
            'title' =>  $request->title,
            'date' =>  $request->date,
            'performer' =>  $request->performer,
            'venue' =>  $request->venue,
            'totalSeats' =>  $request->totalSeats,
            'price' =>  $request->price,
            'time' => $request->time,
            "posterUrl" => $request->posterUrl,
        ]);

        for ($x = 0; $x < $totalSeats; $x++) {
            Seat::create([
                'concert_id' => $concert->id,
                'isBooked' => false,
            ]);
        }

        return response()->json($concert);
    }

    public function getConcertListing()
    {
        $concerts = DB::select('select * from concert');
        return response()->json($concerts);
    }

    public function updateConcert(Request $request, $id)
    {
        try {
            $concertData = Concert::find($id);
            $concertOriTotalSeat = $concertData->totalSeats;
            $concertNewTotalSeat = $request->totalSeats;

            if ($concertNewTotalSeat > $concertOriTotalSeat) {
                $seatToAdd = $concertNewTotalSeat - $concertOriTotalSeat;
                for ($x = 0; $x < $seatToAdd; $x++) {
                    Seat::create([
                        'concert_id' => $concertData->id,
                        'isBooked' => false,
                    ]);
                }
            } else {
                $seatToDelete = $concertOriTotalSeat - $concertNewTotalSeat;
                DB::table("seat")
                    ->where("concert_id", "=", $id)
                    ->orderBy("id", "DESC")
                    ->take($seatToDelete)
                    ->delete();
            }
            $concertData->title = $request->title;
            $concertData->performer = $request->performer;
            $concertData->date = $request->date;
            $concertData->venue = $request->venue;
            $concertData->totalSeats = $request->totalSeats;
            $concertData->price = $request->price;
            $concertData->time = $request->time;
            $concertData->save();
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function deleteConcert($id)
    {
        try {
            Concert::find($id)->delete();
            Seat::where('concert_id', '=', $id)->delete(); // delete related seat
            return response()->json('concert deleted');
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function readConcert($id)
    {
        try {
            $concert = Concert::find($id);
            return response()->json($concert);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
