<?php

namespace App\Http\Controllers;

use App\Models\FollowUp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowUpController extends Controller
{
    public function index()
    {
        $followups = FollowUp::with(['user', 'sender'])->latest()->get();
        return view('followup.index', compact('followups'));
    }

    public function create()
    {
        $users = User::all();
        return view('followup.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'message' => 'required',
            'followup_at' => 'required|date',
        ]);

        FollowUp::create([
            'user_id' => $request->user_id,
            'sender_user_id' => Auth::id(),
            'message' => $request->message,
            'followup_at' => $request->followup_at,
        ]);

        return redirect()->route('followups.index')->with('status', 'Follow-up added.');
    }

    public function edit(FollowUp $followup)
    {
        $users = User::all();
        return view('followup.edit', compact('followup', 'users'));
    }

    public function update(Request $request, FollowUp $followup)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'message' => 'required',
            'followup_at' => 'required|date',
        ]);

        $followup->update([
            'user_id' => $request->user_id,
            'message' => $request->message,
            'followup_at' => $request->followup_at,
        ]);

        return redirect()->route('followups.index')->with('status', 'Follow-up updated.');
    }

    public function destroy(FollowUp $followup)
    {
        $followup->delete();
        return back()->with('status', 'Follow-up deleted.');
    }
}
