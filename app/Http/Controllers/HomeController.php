<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $mails = DB::table('mails')->where('user_id', '=', Auth::id())->paginate(10);
        $amount = count($mails);

        return view('home', ['mails' => $mails, 'amount' => $amount]);
    }
}
