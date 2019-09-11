<?php

namespace App\Http\Controllers;

use App\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MailController extends Controller
{
    public function view(int $id, Request $request)
    {
        $mail = Mail::find($id);

        if (!$mail->id) {
            return abort(404, 'Mail not found!');
        }

        if ($mail->user->id !== Auth::id()) {
            return abort(403, 'Cannot see this ¯\_(ツ)_/¯');
        }

        return view('mail.view', ['mail' => $mail]);
    }

    public function list(Request $request)
    {
        $pagemax = 10;
        $mails = DB::table('mails')->where('user_id', '=', Auth::id())->paginate($pagemax);

        $indexfix = ($mails->currentPage() - 1) * $mails->perPage();

        return view('mail.list', ['mails' => $mails, 'total' => $mails->total(), 'indexfix' => $indexfix]);
    }

    public function add(Request $request)
    {
        return view('mail.add');
    }

    public function edit(int $id)
    {
        $mail = Mail::find($id);

        if (!$mail->id) {
            return abort(404, 'Mail not found!');
        }

        if ($mail->user->id !== Auth::id()) {
            return abort(403, 'Cannot do this ¯\_(ツ)_/¯');
        }

        return view('mail.edit')->with('mail', $mail);
    }

    public function save(Request $request)
    {
        $data = $request->validate([
            'subject' => 'required|max:255',
            'body' => 'required',
        ]);
        $mail = new \App\Mail($data);
        $mail->user()->associate(Auth::user());
        $mail->save();

        return redirect()->route('mail.view', ['id' => $mail->id]);
    }

    public function update(Mail $mail, Request $request)
    {
        if ($mail->user->id !== Auth::id()) {
            return abort(403, 'Cannot do this ¯\_(ツ)_/¯');
        }

        $data = $request->validate([
            'subject' => 'required|max:255',
            'body' => 'required',
        ]);

        $mail->update($request->all());

        return redirect()->route('mail.view', ['id' => $mail->id]);
    }
}
