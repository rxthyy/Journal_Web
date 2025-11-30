<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Calendar - Daily Log</title>
    <link rel="icon" type="image/png" href="{{ asset('img/pen-logo.svg') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="light">
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-brand">
                <img src="{{ asset('img/pen-logo.svg') }}" alt="Daily Log" class="nav-logo">
                <span class="nav-title">Daily Log</span>
            </div>
            <ul class="nav-menu" id="navMenu">
                <li class="nav-item"><a href="calendar.html" class="nav-link active">Calendar</a></li>
                <li class="nav-item"><a href="discover.html" class="nav-link">Discover</a></li>
                <li class="nav-item"><a href="profile.html" class="nav-link">Profile</a></li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fa-solid fa-bell"></i></a></li>
                <li class="nav-item"><a href="index.html" class="nav-link"><i class="fa-solid fa-right-from-bracket"></i></a></li>
            </ul>
            <div class="hamburger" id="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </div>
    </nav>

    <section class="calendar-section">
        <div class="container">
            <div class="calendar-stats">
                <div class="stat-card">
                    <i class="fa-solid fa-book"></i>
                    <div class="stat-info">
                        <span class="stat-value" id="monthEntries">0</span>
                        <span class="stat-label">Entries This Month</span>
                    </div>
                </div>
                <div class="stat-card">
                    <i class="fa-solid fa-fire"></i>
                    <div class="stat-info">
                        <span class="stat-value" id="currentStreak">0</span>
                        <span class="stat-label">Day Streak</span>
                    </div>
                </div>
                <div class="stat-card">
                    <i class="fa-solid fa-face-smile"></i>
                    <div class="stat-info">
                        <span class="stat-value" id="topMood">😊</span>
                        <span class="stat-label">Most Common Mood</span>
                    </div>
                </div>
            </div>

            <div class="calendar-wrapper">
                <div class="calendar">
                    <div class="calendar-header">
                        <span class="month-picker" id="month-picker">Loading...</span>
                        <div class="year-picker">
                            <span class="year-change" id="prev-year"><i class="fa-solid fa-chevron-left"></i></span>
                            <span id="year">...</span>
                            <span class="year-change" id="next-year"><i class="fa-solid fa-chevron-right"></i></span>
                        </div>
                    </div>
                    <div class="calendar-body">
                        <div class="calendar-week-day">
                            <div>Sun</div><div>Mon</div><div>Tue</div><div>Wed</div><div>Thu</div><div>Fri</div><div>Sat</div>
                        </div>
                        <div class="calendar-days"></div>
                    </div>
                    <div class="calendar-footer">
                        <div class="calendar-legend">
                            <span class="legend-label">Legend:</span>
                            <div class="legend-item"><span class="legend-dot public-dot"></span><span>Public</span></div>
                            <div class="legend-item"><span class="legend-dot friends-dot"></span><span>Friends</span></div>
                            <div class="legend-item"><span class="legend-dot private-dot"></span><span>Private</span></div>
                        </div>
                        <div class="toggle">
                            <span>Dark Mode</span>
                            <div class="dark-mode-switch"><div class="dark-mode-switch-ident"></div></div>
                        </div>
                    </div>
                    <div class="month-list"></div>
                </div>
            </div>
        </div>
    </section>

    <button class="fab" id="fabBtn" title="Create New Entry"><i class="fa-solid fa-plus"></i></button>

    <div class="modal" id="dayModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="modalTitle">Entries</h2>
                <button class="modal-close" id="modalClose"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body" id="modalBody"></div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="createEntryBtn"><i class="fa-solid fa-plus"></i> Create Entry for This Day</button>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/navigation.js') }}"></script>
    <script src="{{ asset('js/calendar.js') }}"></script>
</body>
</html>