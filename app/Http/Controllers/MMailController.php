<?php

namespace App\Http\Controllers;

use App\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MMailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mails = DB::table('mails')->where('user_id', '=', Auth::id())->get();

        return view('mail.list', ['mails' => $mails]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mail.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Mail $mail
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Mail $mail)
    {
        if (!$mail) {
            return abort(404, 'Mail not found!');
        }

        if ($mail->user->id !== Auth::id()) {
            return abort(403, 'Cannot see this ¯\_(ツ)_/¯');
        }

        return view('mail.view', ['mail' => $mail]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Mail $mail
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Mail $mail)
    {
        if (!$mail) {
            return abort(404, 'Mail not found!');
        }

        return view('mail.add')->with('mail', $mail);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Mail                $mail
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mail $mail)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Mail $mail
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mail $mail)
    {
    }
}
