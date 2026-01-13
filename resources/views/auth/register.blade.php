<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - MLM System</title>
    <!-- Simple CSS for demonstration -->
    <style>
        body { font-family: sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f3f4f6; }
        .card { background: white; padding: 2rem; border-radius: 0.5rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        .form-group { margin-bottom: 1rem; }
        label { display: block; margin-bottom: 0.5rem; font-weight: bold; }
        input { width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; }
        button { width: 100%; padding: 0.75rem; background-color: #3b82f6; color: white; border: none; border-radius: 0.25rem; cursor: pointer; font-weight: bold; }
        button:hover { background-color: #2563eb; }
        .error { color: #ef4444; font-size: 0.875rem; margin-top: 0.25rem; }
    </style>
</head>
<body>
    <div class="card">
        <h2 style="text-align: center; margin-bottom: 1.5rem;">Register</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <label for="name">Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password-confirm">Confirm Password</label>
                <input id="password-confirm" type="password" name="password_confirmation" required>
            </div>

            <!-- Referral Code -->
            <div class="form-group">
                <label for="referral_code">Referral Code (Optional)</label>
                <input id="referral_code" type="text" name="referral_code" value="{{ old('referral_code', $referral_code) }}">
                @error('referral_code')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
