<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        session()->flash('success', 'You have successfully logged in! Welcome back.');
    }

    // Override logout to add flash message
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Flash logout success message
        session()->flash('success', 'You have been logged out successfully.');

        return redirect('/');  
    }

    public function destroy(Request $request)
    {
        $user = $request->user();
        $this->logout($request);
        $user->delete();

        // Flash account deletion success message
        session()->flash('success', 'Your account has been deleted successfully.');

        return redirect('/');
    }
}
