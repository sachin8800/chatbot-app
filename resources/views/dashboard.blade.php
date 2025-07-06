<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - ChatBot App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .dashboard-card {
            border-radius: 1rem;
            transition: transform 0.2s ease;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
        }
        .icon-box {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary px-4">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">ChatBot App</a>
            <div class="ms-auto">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-outline-light btn-sm">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Welcome, {{ Auth::user()->name }}</h2>
            <p class="text-muted">You are successfully logged in to the ChatBot App Dashboard.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <a href="{{ route('customers.index') }}" class="text-decoration-none text-dark">
                    <div class="card shadow-sm text-center dashboard-card p-4">
                        <div class="icon-box text-primary">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <h5 class="fw-semibold">Customer Management</h5>
                        <p class="text-muted small mb-0">View and manage customer records.</p>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ route('followups.index') }}" class="text-decoration-none text-dark">
                    <div class="card shadow-sm text-center dashboard-card p-4">
                        <div class="icon-box text-warning">
                            <i class="bi bi-journal-check"></i>
                        </div>
                        <h5 class="fw-semibold">Follow-Up Tasks</h5>
                        <p class="text-muted small mb-0">Track and update customer follow-ups.</p>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ url('/chat') }}" class="text-decoration-none text-dark">
                    <div class="card shadow-sm text-center dashboard-card p-4">
                        <div class="icon-box text-success">
                            <i class="bi bi-chat-dots-fill"></i>
                        </div>
                        <h5 class="fw-semibold">Chat Interface</h5>
                        <p class="text-muted small mb-0">Chat with other users in real-time.</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</body>
</html>
