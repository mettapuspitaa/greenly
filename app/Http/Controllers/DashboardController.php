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
        $myhistories = History::with(['skor', 'user'])
            ->whereDate('created_at', today())
            ->where('user_id', $user->id) // Filter hanya untuk user yang login
            ->get();

        $latestSkor = $myhistories
            ->sortByDesc('created_at')
            ->first(); 

        $histories = History::with(['skor', 'user'])
            ->whereDate('created_at', today())
            ->get()
            ->groupBy('user_id')
            ->map(function ($userHistories) {
                return $userHistories->sortByDesc('created_at')->first();
            })
            ->sortBy(function ($history) {
                return $history->skor->emission_km + $history->skor->emission_kwh + $history->skor->emission_food;
            })
            ->values() // Reset indices
            ->mapWithKeys(function ($item, $key) {
                return [$key + 1 => $item]; // Create 1-based indexing if preferred
            })
            ->take(3);

        
        return view('user.dashboard', compact('latestSkor','histories'));
    }
}
