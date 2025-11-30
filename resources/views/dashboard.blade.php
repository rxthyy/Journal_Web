<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Daily Log</title>
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
                <li class="nav-item"><a href="login.html" class="nav-link nav-btn active">Login</a></li>
            </ul>
            <div class="hamburger" id="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </div>
    </nav>

    <!-- Login Section -->
    <section class="auth-section">
        <div class="auth-container">
            <div class="auth-box">
                <h1 class="auth-title">Welcome Back</h1>
                <p class="auth-subtitle">Login to continue your journey</p>
                
                <form class="auth-form">
                    <div class="input-box">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" placeholder="Username" required>
                    </div>
                    
                    <div class="input-box">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" placeholder="Password" required>
                    </div>

                    <div class="remember-forgot">
                        <label class="checkbox-label">
                            <input type="checkbox">
                            <span>Remember me</span>
                        </label>
                        <a href="#" class="forgot-link">Forgot Password?</a>
                    </div>

                    <button type="button" class="btn btn-primary btn-full" onclick="location.href='calendar.html'">
                        Login
                    </button>

                    <div class="auth-footer">
                        <p>Don't have an account? <a href="register.html" class="auth-link">Register</a></p>                    </div>
                </form>
            </div>
        </div>
    </section>

    <script src="js/navigation.js"></script>
</body>
</html>