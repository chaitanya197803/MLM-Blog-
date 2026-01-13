<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - MLM System</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Welcome, {{ Auth::user()->name }}</h1>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>

        <div class="grid">
            <!-- Referral Code Card -->
            <div class="card">
                <div class="card-title">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    Your Referral Code
                </div>
                <div class="card-value">{{ Auth::user()->referral_code }}</div>
            </div>

            <!-- Referral Link Card -->
            <div class="card">
                <div class="card-title">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                    </svg>
                    Share & Earn
                </div>
                <div class="referral-link-container">
                    <div class="link-text" id="referral-link">{{ route('register', ['ref' => Auth::user()->referral_code]) }}</div>
                    <button class="copy-btn" onclick="copyLink()">Copy Link</button>
                </div>
            </div>

            <!-- Quick Stats Card -->
            <div class="card">
                <div class="card-title">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Network Overview
                </div>
                <div class="stats-grid">
                    <div class="stat-item">
                        <div class="stat-label">Direct Referrals</div>
                        <div class="stat-value">{{ Auth::user()->referrals()->count() }}</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Total Earnings</div>
                        <div class="stat-value">$0</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="toast">Referral link copied to clipboard!</div>

    <script>
        function copyLink() {
            const link = document.getElementById('referral-link').innerText;
            navigator.clipboard.writeText(link).then(() => {
                const toast = document.getElementById('toast');
                toast.classList.add('show');
                setTimeout(() => {
                    toast.classList.remove('show');
                }, 3000);
            });
        }
    </script>
</body>
</html>
