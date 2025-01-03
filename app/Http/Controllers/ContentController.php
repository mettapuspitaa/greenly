<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index()
    {
        $contents = Content::all();
        return view('admin.content-list', compact('contents'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'path' => 'required|url',
        ]);

        // Tambahkan nilai default untuk 'date'
        $validated['date'] = now()->toDateString(); // Menggunakan format 'YYYY-MM-DD'

        Content::create($validated);

        return redirect()->back()->with('success', 'Content added successfully!');
    }

    public function update(Request $request, $content_id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'path' => 'required|url',
        ]);

        $content = Content::where('content_id', $content_id)->first();
        $content->update($validated);
        return redirect()->back()->with('success', 'Content updated successfully!');
    }

    public function destroy($content_id)
    {
        $content = Content::where('content_id', $content_id)->first();
        $content->delete();
        return redirect()->back()->with('success', 'Content deleted successfully!');
    }
}
