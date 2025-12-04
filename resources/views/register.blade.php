<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Daily Log</title>
    <link rel="icon" type="image/svg+xml" href="/img/pen-logo.svg">
    <link rel="stylesheet" href="/css/style.css">
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
                <li class="nav-item"><a href="{{ url('/custom-login') }}" class="nav-link">Login</a></li>
            </ul>
            <div class="hamburger" id="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </div>
    </nav>

    <!-- Register Section -->
    <section class="auth-section">
        <div class="auth-container">
            <div class="auth-box">
                <h1 class="auth-title">Create Account</h1>
                <p class="auth-subtitle">Join Daily Log and start sharing your journey</p>
                
                <!-- Display validation errors -->
                @if ($errors->any())
                    <div style="background-color: #fee; border: 1px solid #fcc; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">
                        <ul style="margin: 0; padding-left: 1.5rem; color: #c00;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form class="auth-form" method="POST" action="{{ route('register') }}">
                    @csrf
                    
                    <div class="input-box">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" required autofocus>
                    </div>

                    <div class="input-box">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required>
                    </div>
                    
                    <div class="input-box">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" required>
                    </div>

                    <div class="input-box">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                    </div>

                    <div class="terms-agreement">
                        <label class="checkbox-label">
                            <input type="checkbox" required>
                            <span>I agree to the <a href="#" class="auth-link">Terms of Service</a> and <a href="#" class="auth-link">Privacy Policy</a></span>
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-full">
                        Create Account
                    </button>

                    <div class="auth-footer">
                        <p>Already have an account? <a href="{{ url('/custom-login') }}" class="auth-link">Login here</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script src="/js/navigation.js"></script>
    </body>
</html>