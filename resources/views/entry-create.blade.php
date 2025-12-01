<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Create Entry - Daily Log</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('img/pen-logo.svg') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="light">
    <!-- Navigation -->

    <!-- Create Entry Section -->
    <section class="entry-create-section">
        <div class="container">
            <div class="entry-create-container">
                <!-- Header -->
                <div class="create-header">
                    <a href="{{ route('calendar') }}" class="back-btn">
                        <i class="fa-solid fa-arrow-left"></i> Back
                    </a>
                    <h1 class="create-title">Write Your Entry</h1>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Entry Form -->
                <form class="entry-form" id="entryForm" action="{{ route('entry.store') }}" method="POST">
                    @csrf
                    
                    <!-- Date Picker -->
                    <div class="form-group">
                        <label for="entryDate" class="form-label">
                            <i class="fa-solid fa-calendar"></i> Entry Date
                        </label>
                        <input type="date" id="entryDate" name="entry_date" class="form-input" 
                               value="{{ $date }}" required>
                    </div>

                    <!-- Title -->
                    <div class="form-group">
                        <label for="entryTitle" class="form-label">
                            <i class="fa-solid fa-heading"></i> Title
                        </label>
                        <input type="text" id="entryTitle" name="title" class="form-input" 
                               placeholder="Give your entry a title..." maxlength="100" required>
                        <span class="char-count" id="titleCount">0/100</span>
                    </div>

                    <!-- Content -->
                    <div class="form-group">
                        <label for="entryContent" class="form-label">
                            <i class="fa-solid fa-pen"></i> Your Story
                        </label>
                        <textarea id="entryContent" name="content" class="form-textarea-plain" 
                                  rows="15" placeholder="Write your entry here..." required></textarea>
                        <span class="word-count" id="wordCount">0 words</span>
                    </div>

                    <!-- Tags -->
                    <div class="form-group">
                        <label for="entryTags" class="form-label">
                            <i class="fa-solid fa-tags"></i> Tags
                        </label>
                        <div class="tags-input-container">
                            <div class="tags-display" id="tagsDisplay"></div>
                            <input type="text" id="entryTags" class="tags-input" 
                                   placeholder="Add tags (press Enter or comma)">
                        </div>
                        <input type="hidden" name="tags[]" id="tagsHidden">
                        <div class="suggested-tags">
                            <span class="suggested-label">Suggested:</span>
                            <button type="button" class="tag-suggestion" data-tag="daily">daily</button>
                            <button type="button" class="tag-suggestion" data-tag="thoughts">thoughts</button>
                            <button type="button" class="tag-suggestion" data-tag="gratitude">gratitude</button>
                            <button type="button" class="tag-suggestion" data-tag="reflection">reflection</button>
                            <button type="button" class="tag-suggestion" data-tag="personal">personal</button>
                        </div>
                    </div>

                    <!-- Mood Selector -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-solid fa-face-smile"></i> How are you feeling?
                        </label>
                        <div class="mood-selector">
                            <button type="button" class="mood-btn" data-mood="happy" title="Happy">😊</button>
                            <button type="button" class="mood-btn" data-mood="excited" title="Excited">🤗</button>
                            <button type="button" class="mood-btn" data-mood="calm" title="Calm">😌</button>
                            <button type="button" class="mood-btn" data-mood="thoughtful" title="Thoughtful">🤔</button>
                            <button type="button" class="mood-btn" data-mood="sad" title="Sad">😢</button>
                            <button type="button" class="mood-btn" data-mood="tired" title="Tired">😴</button>
                            <button type="button" class="mood-btn" data-mood="stressed" title="Stressed">😰</button>
                            <button type="button" class="mood-btn" data-mood="grateful" title="Grateful">🙏</button>
                        </div>
                        <input type="hidden" name="mood" id="moodInput">
                    </div>

                    <!-- Privacy Settings -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-solid fa-lock"></i> Privacy
                        </label>
                        <div class="privacy-options">
                            <label class="privacy-option">
                                <input type="radio" name="privacy" value="public" checked>
                                <div class="privacy-card">
                                    <i class="fa-solid fa-globe"></i>
                                    <span class="privacy-title">Public</span>
                                    <span class="privacy-desc">Anyone can see this entry</span>
                                </div>
                            </label>
                            
                            <label class="privacy-option">
                                <input type="radio" name="privacy" value="friends">
                                <div class="privacy-card">
                                    <i class="fa-solid fa-user-group"></i>
                                    <span class="privacy-title">Friends Only</span>
                                    <span class="privacy-desc">Only your followers can see</span>
                                </div>
                            </label>
                            
                            <label class="privacy-option">
                                <input type="radio" name="privacy" value="private">
                                <div class="privacy-card">
                                    <i class="fa-solid fa-lock"></i>
                                    <span class="privacy-title">Private</span>
                                    <span class="privacy-desc">Only you can see this entry</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Additional Options -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-solid fa-sliders"></i> Additional Options
                        </label>
                        <div class="additional-options">
                            <label class="checkbox-option">
                                <input type="checkbox" name="allow_comments" value="1" checked>
                                <span>Allow comments</span>
                            </label>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="create-actions">
                        <button type="submit" class="btn btn-primary btn-large">
                            <i class="fa-solid fa-paper-plane"></i> Publish Entry
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script src="{{ asset('js/navigation.js') }}"></script>
    <script src="{{ asset('js/entry-create.js') }}"></script>
</body>
</html>