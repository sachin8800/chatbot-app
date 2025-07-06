@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Follow-Up</h2>

    <form action="{{ route('followups.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Select User</label>
            <select name="user_id" class="form-control" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Message</label>
            <textarea name="message" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label>Follow-Up Time</label>
            <input type="datetime-local" name="followup_at" class="form-control" required>
        </div>

        <button class="btn btn-success">Save</button>
        <a href="{{ route('followups.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
