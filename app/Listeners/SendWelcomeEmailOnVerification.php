<?php

namespace App\Listeners;

use App\Mail\WelcomeMail;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmailOnVerification
{
    public function handle(Verified $event)
    {
        $user = $event->user; // Get the verified user
        Mail::to($user->email)->send(new WelcomeMail($user));
    }
}
