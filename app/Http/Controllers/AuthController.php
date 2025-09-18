<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        // if already logged in and superadmin redirect to dashboard
        if (auth()->check() && auth()->user()->role === 'superadmin') {
            return redirect()->route('dashboard');
        }

        return view('welcome'); // gunakan welcome.blade sebagai login
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        $creds = $request->only('email','password');

        if (Auth::attempt($creds)) {
            // regenerate session
            $request->session()->regenerate();
            if (Auth::user()->role === 'superadmin') {
                return redirect()->route('dashboard');
            }
            Auth::logout();
            return back()->withErrors(['email'=>'Anda tidak memiliki akses Superadmin.']);
        }

        return back()->withErrors(['email'=>'Email atau password salah.'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
