<?php

namespace App\Http\Controllers;

use App\Models\Emission;
use Illuminate\Http\Request;

class EmissionController extends Controller
{
    
    public function index()
    {
        $emissions = Emission::all(); // Fetch all emissions
        return view('admin.emisi-list', compact('emissions')); // Return to view with data
    }
    
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'emission' => 'required|numeric',
        ]);

        Emission::create($request->all()); // Save to database

        return redirect()->route('emission.index')->with('success', 'Emission created successfully.');
    }
    
    
    public function edit(Emission $emission)
    {
        return view('admin.edit', compact('emission')); // Pass the emission to the edit view
    }
    
    
    public function update(Request $request, Emission $emission)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'emission' => 'required|numeric',
        ]);

        $emission->update($request->all()); // Update emission in database

        return redirect()->route('emission.index')->with('success', 'Emission updated successfully.');
    }
    
    
    public function destroy(Emission $emission)
    {
        $emission->delete(); // Delete the emission

        return redirect()->route('emission.index')->with('success', 'Emission deleted successfully.');
    }

    public function fetchAllCategories()
    {
        $categories = Emission::all()->groupBy('type')->map(function ($items) {
            return $items->map(function ($item) {
                return ['name' => $item->name, 'emission' => $item->emission];
            });
        });

        return response()->json($categories);
    }

}