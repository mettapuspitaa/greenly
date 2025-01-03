<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\History;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Mendapatkan user yang sedang login

        // Ambil history terbaru untuk tanggal hari ini berdasarkan user_id
        $latestHistory = History::where('user_id', $user->id)
            ->whereDate('date', now()->toDateString())
            ->with('skor') // Eager loading relasi skor
            ->first();

        // Jika history tidak ada, gunakan nilai default
        $latestSkor = $latestHistory?->skor ?? (object) [
            'emission_km' => 0,
            'emission_kwh' => 0,
            'emission_food' => 0,
            'food' => 0,
            'energy' => 0,
            'transport' => 0,
        ];

        return view('user.dashboard', compact('latestSkor'));
    }
}
