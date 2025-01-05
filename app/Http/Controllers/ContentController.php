<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{
    // Display the list of content for admin
    public function index()
    {
        $contents = Content::all();
        return view('admin.content-list', compact('contents'));
    }

    // Display the list of content for users, ordered by the latest
    public function uindex()
    {
        $contents = Content::orderBy('created_at', 'desc')->get();
        return view('user.educational-content', compact('contents'));
    }

    // Store a new content item
    public function store(Request $request)
    {
        // Validate the incoming request data
        $this->validateContent($request);

        // Handle file upload if a file is provided
        $filePath = $this->handleFileUpload($request->file('path'));

        // Save the content data to the database
        $content = new Content();
        $this->saveContent($content, $request, $filePath);

        return redirect()->route('content.index')->with('status', 'success')->with('message', 'Content added successfully!');
    }

    // Update an existing content item
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $this->validateContent($request);

        // Find the content by ID
        $content = Content::findOrFail($id);
        
        // Update the content data
        $this->updateContent($content, $request);

        if ($request->hasFile('path')) {
            // Delete the old file if a new file is uploaded
            $this->deleteOldFile($content->path);
            $filePath = $this->handleFileUpload($request->file('path'));
            $content->path = $filePath; // Save the new file path
        }

        $content->save();

        return redirect()->route('content.index')->with('status', 'success')->with('message', 'Content updated successfully!');
    }

    // Delete a content item
    public function destroy($content_id)
    {
        // Find the content by ID
        $content = Content::findOrFail($content_id);
        
        // Delete the old file associated with the content
        $this->deleteOldFile($content->path);
        
        // Delete the content from the database
        $content->delete();

        return redirect()->back()->with('status', 'success')->with('message', 'Content deleted successfully!');
    }

    // Validate the request data for storing or updating content
    private function validateContent(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'path' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);
    }

    // Handle the file upload and return the file path
    private function handleFileUpload($file)
    {
        if ($file) {
            $fileName = time() . '_' . $file->getClientOriginalName();
            return $file->storeAs('assets', $fileName); // Store file in the 'assets' directory
        }
        return null;
    }

    // Save the content data to the database
    private function saveContent(Content $content, Request $request, $filePath)
    {
        $content->name = $request->name;
        $content->description = $request->description;
        $content->path = $filePath;
        $content->date = now()->toDateString(); // Store the current date
        $content->save();
    }

    // Update the content data
    private function updateContent(Content $content, Request $request)
    {
        $content->name = $request->name;
        $content->description = $request->description;
        $content->date = now()->toDateString(); // Update the date
    }

    // Delete the old file from storage if it exists
    private function deleteOldFile($path)
    {
        if ($path && Storage::exists('public/' . $path)) {
            Storage::delete('public/' . $path); // Delete the file from storage
        }
    }
}

