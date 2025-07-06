@extends('layouts.app')

@section('content')
<style>
    .chat-box {
        max-height: 60vh;
        overflow-y: auto;
        background: #f5f5f5;
        padding: 1rem;
        border-radius: 10px;
    }
    .chat-message {
        max-width: 70%;
        padding: 10px 15px;
        border-radius: 20px;
        margin-bottom: 10px;
        position: relative;
        word-wrap: break-word;
    }
    .chat-left {
        background-color: #e1e1e1;
        align-self: flex-start;
    }
    .chat-right {
        background-color: #007bff;
        color: white;
        align-self: flex-end;
    }
    .chat-timestamp {
        font-size: 0.75rem;
        margin-top: 3px;
        color: #6c757d;
    }
</style>

<div class="container py-4">
    <h4 class="mb-4 text-center text-primary">📨 ChatBoat</h4>

    {{-- Flash Message --}}
    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    {{-- Select Receiver --}}
    <form action="{{ route('chat.store') }}" method="POST" class="mb-3">
        @csrf
        <div class="row g-2 align-items-end">
            <div class="col-12 col-md-4">
                <label class="form-label">Select User</label>
                <select name="receiver_id" class="form-select" required>
                    @foreach($users as $u)
                        <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->email }})</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label">Message</label>
                <input type="text" name="message" class="form-control" placeholder="Type your message..." required>
            </div>
            <div class="col-12 col-md-2 d-grid">
                <button class="btn btn-primary">Send</button>
            </div>
        </div>
    </form>

    {{-- Chat History --}}
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">Chat History</div>
        <div class="card-body d-flex flex-column chat-box">
            @forelse($messages as $msg)
                <div class="d-flex flex-column {{ $msg->sender_id === Auth::id() ? 'align-self-end' : 'align-self-start' }}">
                    <div class="chat-message {{ $msg->sender_id === Auth::id() ? 'chat-right' : 'chat-left' }}">
                        <div>{{ $msg->message }}</div>
                    </div>
                    <div class="chat-timestamp">
                        {{ $msg->sender->name }} • {{ $msg->created_at->format('h:i A | d M') }}
                    </div>
                </div>
            @empty
                <div class="text-center text-muted">No messages found.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
