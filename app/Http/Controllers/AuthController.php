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
    

    public function updateProfile(Request $request)
    {
        $user = Auth::user(); // Get the currently authenticated user

        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:useraccount,email,' . $user->id,
            'old_password' => 'nullable|string|min:8', // Old password field
            'password' => 'nullable|string|min:8|confirmed', // For password change
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Check if the old password matches
        if ($request->old_password && !Hash::check($request->old_password, $user->password)) {
            return redirect('/profile')->withErrors(['old_password' => 'The old password is incorrect.']);
        }
        
        // Update user details
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect('/profile')->with('success', 'Profile updated successfully!');
    }

}
