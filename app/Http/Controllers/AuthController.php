<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAccount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $user = UserAccount::where('email', $credentials['email'])->first();

        if (!$user) {
            return redirect('/login')->with('error', 'No account found with this email.');
        }
        
        if (Auth::attempt($credentials)) {
            if ($user->role == 'admin') {
                return redirect()->route('emission.index');
            }
            return redirect('/dashboard');
        }
        
        return redirect('/login')->with('error', 'Invalid credentials. Please try again.');        
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate the user's session
        $request->session()->invalidate();

        // Regenerate the session token to prevent session fixation attacks
        $request->session()->regenerateToken();

        // Redirect to the login page with a success message
        return redirect('/login')->with('success', 'Logged out successfully!');
    }
    
    public function register(Request $request)
    {
        // Validasi input dari pengguna
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        // Cek apakah email sudah ada
        if (UserAccount::where('email', $request->email)->exists()) {
            return redirect('/register')->withInput()->with('error', 'The email has already been taken.');
        }
        
        // Buat user baru
        UserAccount::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Redirect ke halaman login dengan pesan sukses
        return redirect('/login')->with('success', 'Account created successfully! Please log in.');
    }
    
}
