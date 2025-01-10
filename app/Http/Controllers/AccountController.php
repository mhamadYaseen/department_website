<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AccountController extends Controller
{
    public function edit(Request $request)
    {
        return view('account.edit');
    }
    public function update(Request $request)
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Update the user
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        // Redirect to the account page
        session()->flash('success', 'Your profile has been updated.');
        return redirect('/');
    }

    public function destroy(Request $request)
    {
       
        // Get the currently authenticated user
        $user = Auth::user();

        // Delete the user
        $user->delete();

        // Log the user out
        Auth::logout();

        // Redirect to a confirmation page
        return redirect('/')->with('status', 'Your account has been deleted.');
    }
}
