<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - ChatBot App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f1f4f7;
        }
        .card {
            border: none;
            border-radius: 1rem;
        }
        .card-header {
            border-radius: 1rem 1rem 0 0;
        }
        .form-label {
            font-weight: 500;
        }
        .social-btn {
            font-weight: 500;
        }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center py-3">
                    <h4 class="mb-0">Welcome to ChatBot Portal</h4>
                </div>
                <div class="card-body p-4">
                    {{-- Session Alerts --}}
                    @if(session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    @if(session('otp_required'))
                        {{-- OTP Form --}}
                        <form method="POST" action="{{ route('otp.verify') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="otp" class="form-label">Enter OTP</label>
                                <input type="text" name="otp" id="otp" class="form-control" placeholder="6-digit OTP" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Verify OTP</button>
                            </div>
                        </form>
                    @else
                        {{-- Login Form --}}
                        <form method="POST" action="{{ route('login.submit') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="your@email.com" required autofocus>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="********" required>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                    @endif

                    {{-- Divider --}}
                    <div class="text-center my-3 text-muted">
                        <span>OR</span>
                    </div>

                    {{-- Social Login Buttons --}}
                    <div class="d-grid gap-2">
                        <a href="{{ route('auth.google') }}" class="btn btn-outline-danger social-btn">
                            <i class="bi bi-google"></i> Login with Google
                        </a>
                        <a href="{{ route('auth.facebook') }}" class="btn btn-outline-primary social-btn">
                            <i class="bi bi-facebook"></i> Login with Facebook
                        </a>
                    </div>
                </div>
                <div class="card-footer text-center small text-muted">
                    &copy; {{ date('Y') }} ChatBot App. All rights reserved.
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Bootstrap Icons (optional, for icons in buttons) --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</body>
</html>
