<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Daily Log</title>
    <link rel="icon" type="image/png" href="{{ asset('img/pen-logo.svg') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="light">
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-brand">
            <img src="{{ asset('img/pen-logo.svg') }}" alt="Daily Log" class="nav-logo">
                <span class="nav-title">Daily Log</span>
            </div>
            <ul class="nav-menu" id="navMenu">
            <li class="nav-item"><a href="{{ url('calendar') }}" class="nav-link active">Calendar</a></li>
                <li class="nav-item"><a href="{{ url('discover') }}" class="nav-link">Discover</a></li>
                <li class="nav-item"><a href="{{ url ('view/profile') }}" class="nav-link">Profile</a></li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fa-solid fa-bell"></i></a></li>
                <li class="nav-item"><a href="{{ url('welcome') }}" class="nav-link"><i class="fa-solid fa-right-from-bracket"></i></a></li>
            </ul>
            <div class="hamburger" id="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </div>
    </nav>

    <!-- Profile Section -->
    <section class="profile-section">
        <div class="container">
            <!-- Profile Header -->
            <div class="profile-header">
                <div class="profile-avatar">
                    <img src="https://via.placeholder.com/150" alt="Profile Picture" id="profileImage">
                    <button class="avatar-edit-btn" title="Change Photo">
                        <i class="fa-solid fa-camera"></i>
                    </button>
                </div>
                <div class="profile-info">
                    <h1 class="profile-name">John Doe</h1>
                    <p class="profile-username">@johndoe</p>
                    <p class="profile-bio">Living life one day at a time ✨ | Coffee enthusiast ☕ | Writing my story</p>
                    <div class="profile-stats">
                        <div class="stat-item">
                            <span class="stat-number">127</span>
                            <span class="stat-label">Entries</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">342</span>
                            <span class="stat-label">Followers</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">189</span>
                            <span class="stat-label">Following</span>
                        </div>
                    </div>
                    <button class="btn btn-primary" onclick="openEditModal()">
                        <i class="fa-solid fa-pen"></i> Edit Profile
                    </button>
                </div>
            </div>

            <!-- Profile Tabs -->
            <div class="profile-tabs">
                <button class="tab-btn active" data-tab="entries">
                    <i class="fa-solid fa-book"></i> My Entries
                </button>
                <button class="tab-btn" data-tab="saved">
                    <i class="fa-solid fa-bookmark"></i> Saved
                </button>
                <button class="tab-btn" data-tab="settings">
                    <i class="fa-solid fa-gear"></i> Settings
                </button>
            </div>

            <!-- Tab Content -->
            <div class="tab-content">
                <!-- My Entries Tab -->
                <div class="tab-pane active" id="entries">
                    <div class="entries-grid">
                        <div class="entry-card">
                            <div class="entry-header">
                                <span class="entry-date">November 28, 2024</span>
                                <div class="entry-privacy">
                                    <i class="fa-solid fa-globe"></i> Public
                                </div>
                            </div>
                            <h3 class="entry-title">A Beautiful Day</h3>
                            <p class="entry-preview">Today was amazing! I went to the park and enjoyed the sunshine. Met some interesting people and had great conversations...</p>
                            <div class="entry-footer">
                                <div class="entry-tags">
                                    <span class="tag">daily</span>
                                    <span class="tag">thoughts</span>
                                </div>
                                <div class="entry-actions">
                                    <button class="icon-btn"><i class="fa-solid fa-pen"></i></button>
                                    <button class="icon-btn"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="entry-card">
                            <div class="entry-header">
                                <span class="entry-date">November 27, 2024</span>
                                <div class="entry-privacy">
                                    <i class="fa-solid fa-lock"></i> Private
                                </div>
                            </div>
                            <h3 class="entry-title">Reflections on Growth</h3>
                            <p class="entry-preview">Taking time to reflect on how much I've grown this year. The challenges were tough but worth it...</p>
                            <div class="entry-footer">
                                <div class="entry-tags">
                                    <span class="tag">reflection</span>
                                    <span class="tag">personal</span>
                                </div>
                                <div class="entry-actions">
                                    <button class="icon-btn"><i class="fa-solid fa-pen"></i></button>
                                    <button class="icon-btn"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="entry-card">
                            <div class="entry-header">
                                <span class="entry-date">November 26, 2024</span>
                                <div class="entry-privacy">
                                    <i class="fa-solid fa-user-group"></i> Friends
                                </div>
                            </div>
                            <h3 class="entry-title">Weekend Adventures</h3>
                            <p class="entry-preview">Spent the weekend hiking with friends. The views were absolutely breathtaking and the company was even better...</p>
                            <div class="entry-footer">
                                <div class="entry-tags">
                                    <span class="tag">adventure</span>
                                    <span class="tag">friends</span>
                                </div>
                                <div class="entry-actions">
                                    <button class="icon-btn"><i class="fa-solid fa-pen"></i></button>
                                    <button class="icon-btn"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Saved Tab -->
                <div class="tab-pane" id="saved">
                    <div class="entries-grid">
                        <div class="entry-card">
                            <div class="entry-header">
                                <span class="entry-author">@janedoe</span>
                                <span class="entry-date">November 25, 2024</span>
                            </div>
                            <h3 class="entry-title">Life Lessons I've Learned</h3>
                            <p class="entry-preview">Sharing some wisdom I've gained over the years. Hope this helps someone going through similar experiences...</p>
                            <div class="entry-footer">
                                <div class="entry-tags">
                                    <span class="tag">wisdom</span>
                                    <span class="tag">life</span>
                                </div>
                                <button class="icon-btn"><i class="fa-solid fa-bookmark-slash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Settings Tab -->
                <div class="tab-pane" id="settings">
                    <div class="settings-section">
                        <h2 class="settings-title">Account Settings</h2>
                        
                        <div class="settings-group">
                            <h3>Privacy Settings</h3>
                            <div class="setting-item">
                                <div class="setting-info">
                                    <label>Default Entry Privacy</label>
                                    <p>Choose the default privacy level for new entries</p>
                                </div>
                                <select class="setting-select">
                                    <option value="public">Public</option>
                                    <option value="friends">Friends Only</option>
                                    <option value="private">Private</option>
                                </select>
                            </div>
                            
                            <div class="setting-item">
                                <div class="setting-info">
                                    <label>Profile Visibility</label>
                                    <p>Who can see your profile</p>
                                </div>
                                <select class="setting-select">
                                    <option value="everyone">Everyone</option>
                                    <option value="registered">Registered Users Only</option>
                                </select>
                            </div>
                        </div>

                        <div class="settings-group">
                            <h3>Notifications</h3>
                            <div class="setting-item">
                                <div class="setting-info">
                                    <label>Email Notifications</label>
                                    <p>Receive email updates about your account</p>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                            
                            <div class="setting-item">
                                <div class="setting-info">
                                    <label>New Follower Alerts</label>
                                    <p>Get notified when someone follows you</p>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                        </div>

                        <div class="settings-group">
                            <h3>Account Actions</h3>
                            <button class="btn btn-secondary">Change Password</button>
                            <button class="btn btn-danger">Delete Account</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('js/navigation.js') }}"></script>
    <script src="{{ asset('js/calendar.js') }}"></script>
</body>
</html>