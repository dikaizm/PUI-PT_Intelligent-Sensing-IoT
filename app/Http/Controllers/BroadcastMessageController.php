<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class BroadcastMessageController extends Controller
{
    public function index()
    {
        $recipients = User::all();
        return view('admin.broadcast-message', compact('recipients'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'message' => 'required',
            'recipients' => 'required|array',
        ]);

        $subject = $request->input('subject');
        $message = $request->input('message');
        $recipients = $request->input('recipients');

        // TODO: Implement Email API to send broadcast message

        return redirect('/broadcast-message')->with('success', 'Pesan berhasil dikirim!');
    }
}
