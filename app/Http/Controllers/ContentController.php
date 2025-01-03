<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{
    public function index()
    {
        $contents = Content::all();
        return view('admin.content-list', compact('contents'));
    }

    public function uindex()
    {
        $contents = Content::orderBy('created_at', 'desc')->get(); // Mengurutkan konten berdasarkan yang terbaru
        return view('user.educational-content', compact('contents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'path' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('path')) {
            $file = $request->file('path');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('assets', $fileName);

            // Simpan path relatif ke database
            $content = new Content();
            $content->name = $request->name;
            $content->description = $request->description;
            $content->path = 'assets/' . $fileName;
            $content->date = now()->toDateString();
            $content->save();
        }

        return redirect()->route('content.index')->with('success', 'Content added successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'path' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $content = Content::findOrFail($id);
        $content->name = $request->name;
        $content->description = $request->description;
        $content->date = now()->toDateString();

        if ($request->hasFile('path')) {
            if ($content->path) {
                Storage::delete('public/' . $content->path); // Hapus file lama dengan path relatif
            }
        
            $file = $request->file('path');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('public/assets', $fileName);
            $content->path = 'assets/' . $fileName; // Simpan path relatif ke database
        }        

        $content->save();

        return redirect()->route('content.index')->with('success', 'Content updated successfully!');
    }

    public function destroy($content_id)
    {
        $content = Content::where('content_id', $content_id)->first();
        $content->delete();
        return redirect()->back()->with('success', 'Content deleted successfully!');
    }
}
