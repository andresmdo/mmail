<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthProfileController extends Controller
{
    public function view(Request $request)
    {
        $user = Auth::user();

        return view('user-profile', ['user' => $user]);
    }
}
