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
