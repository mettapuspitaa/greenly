<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    
    public function index()
    {
        $histories = History::with(['skor', 'user'])
            ->whereDate('created_at', today()) // Filter untuk data hari ini
            ->get()
            ->groupBy('user_id') // Kelompokkan berdasarkan user_id
            ->map(function ($userHistories) {
                // Ambil history terbaru untuk setiap user berdasarkan created_at
                return $userHistories->sortByDesc('created_at')->first();
            })
            ->sortBy(function ($history) {
                // Urutkan berdasarkan skor harian (emission_km + emission_kwh + emission_food)
                return $history->skor->emission_km + $history->skor->emission_kwh + $history->skor->emission_food;
            })
            ->take(10); // Ambil 10 skor terkecil

        return view('user.leaderboard', compact('histories'));
    }
}
