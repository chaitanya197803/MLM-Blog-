<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Back - MLM System</title>
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
            <h1>Welcome Back</h1>
            <p>Continue your journey to success</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="john@example.com" required autofocus>
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

            <div class="form-group" style="display: flex; align-items: center; gap: 8px;">
                <input type="checkbox" name="remember" id="remember" style="width: auto;" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember" style="margin-bottom: 0; cursor: pointer;">Remember Me</label>
            </div>

            <button type="submit">Sign In</button>
        </form>

        <div class="footer-text">
            Don't have an account? <a href="{{ route('register') }}">Join the Elite</a>
        </div>
    </div>
</body>
</html>
