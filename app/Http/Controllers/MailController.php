<?php

namespace App\Http\Controllers;

use App\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MailController extends Controller
{
    public function view($mail)
    {
        if (is_int($mail)) {
            $mail = Mail::find($mail);
        }

        return view('mail.view', ['mail' => $mail]);
    }

    public function list(Request $request)
    {
        $mails = DB::table('mails')->where('user_id', '=', Auth::id())->get();

        return view('mail.list', ['mails' => $mails]);
    }

    public function add(Request $request)
    {
        return view('mail.add');
    }

    public function save(Request $request)
    {
        $data = $request->validate([
            'subject' => 'required|max:255',
            'body' => 'required',
        ]);
        $data['user_id'] = Auth::id();

        $mail = tap(new \App\Mail($data))->save();

        return redirect('mail.view')->with(['mail' => $mail]);
    }
}
