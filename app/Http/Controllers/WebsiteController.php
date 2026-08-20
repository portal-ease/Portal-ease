<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Mail;

class WebsiteController extends Controller
{
    public function contact(ContactRequest $request)
    {
        $data = $request->validated();

        Mail::raw(
            "Name: {$data['name']}\nEmail: {$data['email']}\n\nMessage:\n{$data['message']}",
            function ($message) use ($data) {
                $message
                    ->to(config('portalease.contact_email'))
                    ->replyTo($data['email'], $data['name'])
                    ->subject('New contact message from PortalEase');
            }
        );

        return back()->with('status', 'Your message has been sent.');
    }
}
