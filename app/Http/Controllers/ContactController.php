<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Post;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:30',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        Message::create($validated);

        return back()->with('success', 'Your message has been sent successfully. We will contact you soon.');
    }

    public function posts()
    {
        $posts = Post::where('status', 'published')->latest()->paginate(9);

        return view('posts', compact('posts'));
    }
}
