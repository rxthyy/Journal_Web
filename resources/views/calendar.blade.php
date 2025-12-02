<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Calendar - Daily Log</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('img/pen-logo.svg') }}">
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
                <li class="nav-item"><a href="{{ url('calendar') }}" class="nav-link active">Calendar</a></li>
                <li class="nav-item"><a href="{{ url('discover') }}" class="nav-link">Discover</a></li>
                <li class="nav-item"><a href="{{ url('view/profile') }}" class="nav-link">Profile</a></li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fa-solid fa-bell"></i></a></li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="nav-link" style="background: none; border: none; cursor: pointer; color: inherit;">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </button>
                    </form>
                </li>
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
            <!-- Calendar on LEFT -->
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

            <!-- Stats on RIGHT -->
            <div class="calendar-stats">
                <div class="stat-card">
                    <i class="fa-solid fa-book"></i>
                    <div class="stat-info">
                        <span class="stat-value" id="monthEntries">0</span>
                        <span class="stat-label">Entries This Month</span>
                    </div>
                </div>
                <div class="stat-card">
                    <i class="fa-solid fa-layer-group"></i>
                    <div class="stat-info">
                        <span class="stat-value" id="totalEntries">0</span>
                        <span class="stat-label">Total Entries</span>
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
        </div>
    </section>


    <!-- FAB Button to open create modal -->
    <button class="fab" id="fabBtn" title="Create New Entry">
        <i class="fa-solid fa-plus"></i>
    </button>

    <!-- Day Entries Modal (View entries for a day) -->
    <div class="modal" id="dayModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="modalTitle">Entries</h2>
                <button class="modal-close" id="modalClose"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body" id="modalBody"></div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="createEntryBtn">
                    <i class="fa-solid fa-plus"></i> Create Entry for This Day
                </button>
            </div>
        </div>
    </div>

    <!-- Create Entry Modal -->
    <div class="modal" id="entryModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Write Your Entry</h2>
                <button class="modal-close" id="entryModalClose"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                @if(session('success'))
                    <div class="alert-success">{{ session('success') }}</div>
                @endif
                
                @if($errors->any())
                    <div class="alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="entryForm" action="{{ route('entry.store') }}" method="POST">
                    @csrf
                    <input type="hidden" id="entryDate" name="entry_date">

                    <div class="form-group">
                        <label class="form-label"><i class="fa-solid fa-heading"></i> Title</label>
                        <input type="text" name="title" class="form-input" placeholder="Entry title" maxlength="100" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><i class="fa-solid fa-pen"></i> Content</label>
                        <textarea name="content" class="form-textarea-plain" placeholder="Write your entry..." rows="10" required></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><i class="fa-solid fa-face-smile"></i> Mood</label>
                        <select name="mood" class="form-input">
                            <option value="">Select mood (optional)</option>
                            <option value="happy">😊 Happy</option>
                            <option value="excited">🤗 Excited</option>
                            <option value="calm">😌 Calm</option>
                            <option value="thoughtful">🤔 Thoughtful</option>
                            <option value="sad">😢 Sad</option>
                            <option value="tired">😴 Tired</option>
                            <option value="stressed">😰 Stressed</option>
                            <option value="grateful">🙏 Grateful</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><i class="fa-solid fa-lock"></i> Privacy</label>
                        <select name="privacy" class="form-input" required>
                            <option value="public">🌐 Public</option>
                            <option value="friends">👥 Friends Only</option>
                            <option value="private">🔒 Private</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="checkbox-option">
                            <input type="checkbox" name="allow_comments" value="1" checked>
                            <span>Allow comments</span>
                        </label>
                    </div>

                    <div class="create-actions">
                        <button type="submit" class="btn btn-primary btn-full">
                            <i class="fa-solid fa-paper-plane"></i> Publish Entry
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/navigation.js') }}"></script>
    <script src="{{ asset('js/calendar-modal.js') }}"></script>
</body>
</html>