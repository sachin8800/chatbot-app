<?php

namespace App\Http\Controllers;


use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 


class ChatController extends Controller
{
   public function index()
{
    $user = Auth::user();

    $users = User::where('id', '!=', $user->id)->get(); // ✅ add this

    $messages = ChatMessage::where('sender_id', $user->id)
                ->orWhere('receiver_id', $user->id)
                ->with(['sender', 'receiver'])
                ->orderBy('created_at')
                ->get();

    return view('chat.index', compact('messages', 'user', 'users'));
}


public function store(Request $request)
{
    $request->validate([
        'receiver_id' => 'required|exists:users,id',
        'message' => 'required',
    ]);

    ChatMessage::create([
        'sender_id' => Auth::id(),
        'receiver_id' => $request->receiver_id,
        'message' => $request->message,
    ]);

    return back()->with('status', 'Message sent!');
}

}
