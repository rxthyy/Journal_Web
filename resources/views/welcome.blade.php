<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Log - Share Your Journey</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('img/pen-logo.svg') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-brand">
                <img src="{{ asset('img/pen-logo.svg') }}" alt="Daily Log" class="nav-logo">
                <span class="nav-title">Daily Log</span>
            </div>
            <ul class="nav-menu" id="navMenu">
                <li class="nav-item"><a href="{{ url('/') }}" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="{{ url('/#about') }}" class="nav-link">About</a></li>
                <li class="nav-item"><a href="{{ url('/#community') }}" class="nav-link">Community</a></li>
                <li class="nav-item">
                    <a href="{{ url('/custom-login') }}" class="nav-link nav-btn">Login</a>
                </li>
            </ul>
            <div class="hamburger" id="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">Welcome to Daily Log!</h1>
                <p class="hero-subtitle">A platform where everyone can share their thoughts, feelings, and daily experiences.</p>
                <a href="{{ url('/custom-login') }}" class="btn btn-primary btn-large">Start Your Journey</a>
            </div>
        </div>
    </section>

    <!-- Rules Section -->
    <section class="rules-section">
        <div class="container">
            <h2 class="section-title">Community Guidelines</h2>
            <p class="section-subtitle">To keep our community safe and welcoming, please follow these simple rules:</p>
            <ul class="rules-list">
                <li class="rule-item">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>Be respectful to others</span>
                </li>
                <li class="rule-item">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>No hate speech or bullying</span>
                </li>
                <li class="rule-item">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>Keep content appropriate for all ages</span>
                </li>
                <li class="rule-item">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>Do not share personal information</span>
                </li>
                <li class="rule-item">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>Report any violations to the moderators</span>
                </li>
            </ul>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Daily Log. All rights reserved.</p>
        </div>
    </footer>

    <script src="{{ asset('js/navigation.js') }}"></script>
</body>
</html>