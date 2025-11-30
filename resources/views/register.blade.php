<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Daily Log</title>
    <link rel="icon" type="image/png" href="img/pen-logo.svg">
    <link rel="stylesheet" href="css/style.css">
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
                <img src="img/pen-logo.svg" alt="Daily Log" class="nav-logo">
                <span class="nav-title">Daily Log</span>
            </div>
            <ul class="nav-menu" id="navMenu">
                <li class="nav-item"><a href="index.html" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="index.html#about" class="nav-link">About</a></li>
                <li class="nav-item"><a href="index.html#community" class="nav-link">Community</a></li>
                <li class="nav-item"><a href="login.html" class="nav-link">Login</a></li>
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
                
                <form class="auth-form">
                    <div class="input-box">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" placeholder="Full Name" required>
                    </div>

                    <div class="input-box">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" placeholder="Email Address" required>
                    </div>
                    
                    <div class="input-box">
                        <i class="fa-solid fa-at"></i>
                        <input type="text" placeholder="Username" required>
                    </div>
                    
                    <div class="input-box">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" placeholder="Password" id="password" required>
                    </div>

                    <div class="input-box">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" placeholder="Confirm Password" id="confirmPassword" required>
                    </div>

                    <div class="terms-agreement">
                        <label class="checkbox-label">
                            <input type="checkbox" required>
                            <span>I agree to the <a href="#" class="auth-link">Terms of Service</a> and <a href="#" class="auth-link">Privacy Policy</a></span>
                        </label>
                    </div>

                    <button type="button" class="btn btn-primary btn-full" onclick="handleRegister()">
                        Create Account
                    </button>

                    <div class="auth-footer">
                        <p>Already have an account? <a href="{{ asset('custom-login') }}" class="auth-link">Login here</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script src="{{ asset('js/navigation.js') }} "></script>

    <script>
        function handleRegister() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            
            if (password !== confirmPassword) {
                alert('Passwords do not match!');
                return;
            }
            
            // Redirect to calendar (in real app, this would create account first)
            location.href = 'calendar.html';
        }
    </script>
</body>
</html>