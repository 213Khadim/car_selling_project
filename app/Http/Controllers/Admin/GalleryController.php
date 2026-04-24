<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $items = Gallery::latest()->paginate(20);

        return view('admin.gallery', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'      => 'nullable|string|max:255',
            'category'   => 'nullable|string|max:100',
            'image_path' => 'required|image|max:4096',
        ]);

        Gallery::create([
            'title'      => $request->title,
            'category'   => $request->category,
            'image_path' => $request->file('image_path')->store('gallery', 'public'),
        ]);

        return redirect()->route('admin.gallery')->with('success', 'Image uploaded successfully.');
    }

    public function destroy(Gallery $gallery)
    {
        Storage::disk('public')->delete($gallery->image_path);
        $gallery->delete();

        return redirect()->route('admin.gallery')->with('success', 'Image deleted successfully.');
    }
}
