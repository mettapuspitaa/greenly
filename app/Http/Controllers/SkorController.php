<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skor;
use App\Models\History;
use Illuminate\Support\Facades\Auth;

class SkorController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'emission_km' => 'required|numeric',
            'emission_kwh' => 'required|numeric',
            'emission_food' => 'required|numeric',
            'food' => 'required|string',
            'energy' => 'required|string',
            'transport' => 'required|string',
        ]);

        // Simpan skor
        $skor = Skor::create([
            'emission_km' => $validated['emission_km'],
            'emission_kwh' => $validated['emission_kwh'],
            'emission_food' => $validated['emission_food'],
            'food' => $validated['food'],
            'energy' => $validated['energy'],
            'transport' => $validated['transport'],
        ]);

        // Simpan history
        History::create([
            'skor_id' => $skor->id,
            'user_id' => Auth::id(),
            'rekomendasi' => 'Kurangi konsumsi energi untuk mengurangi jejak karbon', // Anda bisa menyesuaikan rekomendasi
            'date' => now(),
        ]);

        return response()->json([
            'message' => 'Data saved successfully',
            'skor' => $skor,
        ]);
    }
}
