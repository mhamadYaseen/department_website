<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AccountController extends Controller
{
    public function edit(Request $request)
    {
        return view('account.edit');
    }
    public function update(Request $request)
    {
        try {
            // Get the currently authenticated user
            $user = Auth::user();

            // Validate the form data
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                'password' => 'nullable|string|min:8|confirmed',
            ]);

            // Update the user
            $user->name = $validated['name'];
            $user->email = $validated['email'];

            // Only update password if provided
            if (!empty($validated['password'])) {
                $user->password = Hash::make($validated['password']);
            }

            if ($user->save()) {
                return redirect()->back()->with('success', 'Your profile has been updated.');
            }

            return redirect()->back()->with('error', 'Failed to update profile.');
        } catch (\Exception $e) {
            Log::error('Profile update failed: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'An error occurred while updating your profile.');
        }
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
