<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        $details = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ];

        Mail::send('contact', ['details' => $details], function($message) use ($request) {
            $message->to('fabillahsultan@gmail.com')
                    ->subject('New Contact Message');
        });        

        return back()->with('success', 'Your message has been sent successfully!');
    }
}

