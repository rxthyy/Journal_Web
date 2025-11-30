<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discover - Daily Log</title>
    <link rel="icon" type="image/png" href="img/pen-logo.svg">
    <link rel="stylesheet" href="css/style.css">
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
                <img src="img/pen-logo.svg" alt="Daily Log" class="nav-logo">
                <span class="nav-title">Daily Log</span>
            </div>
            <ul class="nav-menu" id="navMenu">
                <li class="nav-item"><a href="{{ url('calendar') }}" class="nav-link">Calendar</a></li>
                <li class="nav-item"><a href="{{ url('discover') }}" class="nav-link active">Discover</a></li>
                <li class="nav-item"><a href="{{ url('view/profile') }}" class="nav-link">Profile</a></li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-bell"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('welcome') }}" class="nav-link">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </a>
                </li>
            </ul>
            <div class="hamburger" id="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </div>
    </nav>

    <!-- Discover Section -->
    <section class="discover-section">
        <div class="container">
            <!-- Search and Filters -->
            <div class="discover-header">
                <h1 class="page-title">Discover Stories</h1>
                <p class="page-subtitle">Explore entries from the community</p>
                
                <div class="search-filter-bar">
                    <div class="search-box">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" placeholder="Search entries, tags, or users...">
                    </div>
                    
                    <div class="filter-buttons">
                        <button class="filter-btn active" data-filter="all">
                            <i class="fa-solid fa-globe"></i> All
                        </button>
                        <button class="filter-btn" data-filter="following">
                            <i class="fa-solid fa-user-group"></i> Following
                        </button>
                        <button class="filter-btn" data-filter="popular">
                            <i class="fa-solid fa-fire"></i> Popular
                        </button>
                        <button class="filter-btn" data-filter="recent">
                            <i class="fa-solid fa-clock"></i> Recent
                        </button>
                    </div>
                </div>

                <!-- Popular Tags -->
                <div class="popular-tags">
                    <span class="tags-label">Popular Tags:</span>
                    <button class="tag-chip">#daily</button>
                    <button class="tag-chip">#travel</button>
                    <button class="tag-chip">#thoughts</button>
                    <button class="tag-chip">#gratitude</button>
                    <button class="tag-chip">#adventure</button>
                    <button class="tag-chip">#reflection</button>
                </div>
            </div>

            <!-- Entries Feed -->
            <div class="discover-feed">
                <!-- Entry Card 1 -->
                <article class="discover-card">
                    <div class="discover-card-header">
                        <div class="author-info">
                            <img src="https://via.placeholder.com/40" alt="Author" class="author-avatar">
                            <div class="author-details">
                                <h3 class="author-name">Sarah Johnson</h3>
                                <span class="author-username">@sarahj</span>
                            </div>
                        </div>
                        <button class="follow-btn">Follow</button>
                    </div>
                    
                    <div class="discover-card-content">
                        <div class="entry-meta">
                            <span class="entry-date"><i class="fa-solid fa-calendar"></i> November 28, 2024</span>
                            <span class="entry-time"><i class="fa-solid fa-clock"></i> 2 hours ago</span>
                        </div>
                        <h2 class="discover-entry-title">Finding Peace in Nature</h2>
                        <p class="discover-entry-text">
                            Today I spent the entire afternoon in the mountains. There's something incredibly calming about being surrounded by nature. The sound of the wind through the trees, the birds singing, and the fresh air made me realize how important it is to disconnect from technology and reconnect with the world around us...
                        </p>
                        <div class="entry-tags">
                            <span class="tag">#nature</span>
                            <span class="tag">#peace</span>
                            <span class="tag">#mindfulness</span>
                        </div>
                    </div>
                    
                    <div class="discover-card-footer">
                        <button class="action-btn">
                            <i class="fa-solid fa-heart"></i>
                            <span>234</span>
                        </button>
                        <button class="action-btn">
                            <i class="fa-solid fa-comment"></i>
                            <span>18</span>
                        </button>
                        <button class="action-btn">
                            <i class="fa-solid fa-bookmark"></i>
                        </button>
                        <button class="action-btn">
                            <i class="fa-solid fa-share"></i>
                        </button>
                    </div>
                </article>

                <!-- Entry Card 2 -->
                <article class="discover-card">
                    <div class="discover-card-header">
                        <div class="author-info">
                            <img src="https://via.placeholder.com/40" alt="Author" class="author-avatar">
                            <div class="author-details">
                                <h3 class="author-name">Michael Chen</h3>
                                <span class="author-username">@mchen</span>
                            </div>
                        </div>
                        <button class="follow-btn following">Following</button>
                    </div>
                    
                    <div class="discover-card-content">
                        <div class="entry-meta">
                            <span class="entry-date"><i class="fa-solid fa-calendar"></i> November 27, 2024</span>
                            <span class="entry-time"><i class="fa-solid fa-clock"></i> 5 hours ago</span>
                        </div>
                        <h2 class="discover-entry-title">My Coffee Journey</h2>
                        <p class="discover-entry-text">
                            Started experimenting with different brewing methods today. From French press to pour-over, each method brings out unique flavors in the beans. It's amazing how something as simple as coffee can be such an art form. The patience required teaches you to slow down and appreciate the process...
                        </p>
                        <div class="entry-tags">
                            <span class="tag">#coffee</span>
                            <span class="tag">#hobby</span>
                            <span class="tag">#learning</span>
                        </div>
                    </div>
                    
                    <div class="discover-card-footer">
                        <button class="action-btn liked">
                            <i class="fa-solid fa-heart"></i>
                            <span>189</span>
                        </button>
                        <button class="action-btn">
                            <i class="fa-solid fa-comment"></i>
                            <span>24</span>
                        </button>
                        <button class="action-btn">
                            <i class="fa-solid fa-bookmark"></i>
                        </button>
                        <button class="action-btn">
                            <i class="fa-solid fa-share"></i>
                        </button>
                    </div>
                </article>

                <!-- Entry Card 3 -->
                <article class="discover-card">
                    <div class="discover-card-header">
                        <div class="author-info">
                            <img src="https://via.placeholder.com/40" alt="Author" class="author-avatar">
                            <div class="author-details">
                                <h3 class="author-name">Emma Williams</h3>
                                <span class="author-username">@emmaw</span>
                            </div>
                        </div>
                        <button class="follow-btn">Follow</button>
                    </div>
                    
                    <div class="discover-card-content">
                        <div class="entry-meta">
                            <span class="entry-date"><i class="fa-solid fa-calendar"></i> November 26, 2024</span>
                            <span class="entry-time"><i class="fa-solid fa-clock"></i> Yesterday</span>
                        </div>
                        <h2 class="discover-entry-title">Gratitude List</h2>
                        <p class="discover-entry-text">
                            Taking a moment to write down everything I'm grateful for today: my health, supportive friends, a roof over my head, and the opportunity to pursue my dreams. Sometimes we get so caught up in what we don't have that we forget to appreciate what we do have. This practice has truly changed my perspective...
                        </p>
                        <div class="entry-tags">
                            <span class="tag">#gratitude</span>
                            <span class="tag">#positivity</span>
                            <span class="tag">#mindset</span>
                        </div>
                    </div>
                    
                    <div class="discover-card-footer">
                        <button class="action-btn">
                            <i class="fa-solid fa-heart"></i>
                            <span>412</span>
                        </button>
                        <button class="action-btn">
                            <i class="fa-solid fa-comment"></i>
                            <span>56</span>
                        </button>
                        <button class="action-btn saved">
                            <i class="fa-solid fa-bookmark"></i>
                        </button>
                        <button class="action-btn">
                            <i class="fa-solid fa-share"></i>
                        </button>
                    </div>
                </article>

                <!-- Load More Button -->
                <div class="load-more-container">
                    <button class="btn btn-primary">Load More Entries</button>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('js/navigation.js') }}"></script>
    <script src="{{ asset('js/discover.js') }}"></script>
</body>
</html>