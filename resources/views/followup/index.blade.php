@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            <i class="bi bi-list-task me-2 text-primary"></i> Follow-Up List
        </h2>
        <a href="{{ route('followups.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle me-1"></i> Add Follow-Up
        </a>
    </div>

    @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Desktop Table --}}
    <div class="d-none d-md-block">
        <div class="card shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>#</th>
                            <th>Assigned To</th>
                            <th>Message</th>
                            <th>Follow-Up At</th>
                            <th>Assigned By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse($followups as $f)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $f->user->name }}</td>
                                <td>{{ $f->message }}</td>
                                <td>{{ \Carbon\Carbon::parse($f->followup_at)->format('d M Y, h:i A') }}</td>
                                <td>{{ $f->sender->name }}</td>
                                <td>
                                    {{-- <a href="{{ route('followups.edit', $f->id) }}" class="btn btn-sm btn-outline-primary me-1">
                                        <i class="bi bi-pencil"></i>
                                    </a> --}}
                                    <form action="{{ route('followups.destroy', $f->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this follow-up?');">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-muted py-3">No follow-ups found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Mobile Card View --}}
    <div class="d-md-none">
        @forelse($followups as $f)
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-1">{{ $f->message }}</h5>
                    <p class="mb-1">
                        <strong>To:</strong> {{ $f->user->name }}<br>
                        <strong>By:</strong> {{ $f->sender->name }}<br>
                        <strong>At:</strong> {{ \Carbon\Carbon::parse($f->followup_at)->format('d M Y, h:i A') }}
                    </p>
                    <div class="d-flex justify-content-between">
                        {{-- <a href="{{ route('followups.edit', $f->id) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i> Edit
                        </a> --}}
                        <form action="{{ route('followups.destroy', $f->id) }}" method="POST" onsubmit="return confirm('Delete this follow-up?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-info">No follow-ups found.</div>
        @endforelse
    </div>
</div>
@endsection
