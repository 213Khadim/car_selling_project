<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::latest()->paginate(20);

        return view('admin.messages', compact('messages'));
    }

    public function show(Message $message)
    {
        $message->update(['status' => 'read']);

        return response()->json($message);
    }

    public function destroy(Message $message)
    {
        $message->delete();

        return redirect()->route('admin.messages')->with('success', 'Message deleted.');
    }
}
