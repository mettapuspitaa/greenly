<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\UserAccount;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    
    public function index()
    {
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
            ->take(10);
        return view('user.leaderboard', compact('histories'));
    }
}
