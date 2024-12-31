<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;

class HistoryController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'skor_id' => 'nullable|string',
            'rekomendasi' => 'nullable|string',
            'user_id' => 'nullable|string',
        ]);

        // Simpan data ke database
        $history = History::create($validated);

        return response()->json([
            'message' => 'Data saved successfully!',
            'data' => $skor,
        ]);
    }
}
