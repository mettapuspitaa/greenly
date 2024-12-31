<?php

namespace App\Http\Controllers;

use App\Models\HistoryCarbonFootprint;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    
    public function index()
    {
        $histories = HistoryCarbonFootprint::with(['skor', 'user'])->get();
        return view('user.history', compact('histories'));
    }
}