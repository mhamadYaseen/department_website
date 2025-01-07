<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FeedbackController extends Controller
{
    public function sendFeedback(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string|min:10',
        ]);

        // Prepare the data for the email view
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'messageContent' => $request->message,  // Avoid key name conflicts
        ];

        // Send email
        Mail::send('emails.feedback', $data, function ($mail) use ($data) {
            $mail->to('mhamadyaseen269@gmail.com')  // Replace with your email
                ->subject('User Feedback from ' . $data['name']);
        });

        // Redirect back with success message
        return back()->with('success', 'Thank you for your feedback!');
    }
}
