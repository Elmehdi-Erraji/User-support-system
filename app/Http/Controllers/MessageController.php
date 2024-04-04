<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::all();
        return view('messages.index', compact('messages'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $message = Message::create([
            'content' => $request->input('content'),
        ]);


        // event(new MessageSent($message));

        return redirect()->route('messages.index')->with('success', 'Message sent successfully');
    }
}
