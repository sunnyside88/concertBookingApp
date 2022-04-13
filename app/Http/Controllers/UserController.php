<?php

namespace App\Http\Controllers;

use App\Models\Concert;
use App\Models\Seat;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
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

    public function profile()
    {
        return view('user');
    }

    public function getUserListing()
    {
        $users = DB::table('users')
            ->where('is_admin', '=', 0)
            ->get();
        return response()->json($users);
    }

    public function deleteUser($id)
    {
        try {
            User::find($id)->delete();
            return response()->json('user deleted');
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
