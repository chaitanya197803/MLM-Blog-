<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Our Elite Network - MLM System</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
    <div class="bg-blobs">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
    </div>

    <div class="card">
        <div class="header">
            <h1>Join the Elite</h1>
            <p>Begin your journey to financial freedom</p>
        </div>

        @if($referral_code)
        <div class="referral-badge">
            <div class="icon"></div>
            <span>Referred by: <strong>{{ $referral_code }}</strong></span>
        </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <label for="name">Full Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="John Doe" required autofocus>
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="john@example.com" required>
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" placeholder="••••••••" required>
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password-confirm">Confirm Password</label>
                <input id="password-confirm" type="password" name="password_confirmation" placeholder="••••••••" required>
            </div>

            <!-- Referral Code -->
            <div class="form-group">
                <label for="referral_code">Referral Code (Optional)</label>
                <input id="referral_code" type="text" name="referral_code" value="{{ old('referral_code', $referral_code) }}" placeholder="REF12345">
                @error('referral_code')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit">Create Account</button>
        </form>

        <div class="footer-text">
            Already have an account? <a href="{{ route('login') }}">Sign In</a>
        </div>
    </div>
</body>
</html>
