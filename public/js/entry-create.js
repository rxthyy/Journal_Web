// Tags management
const tags = [];

function addTag(tagText) {
    const tag = tagText.trim().toLowerCase().replace(/^#/, '');
    
    if (tag && !tags.includes(tag) && tags.length < 10) {
        tags.push(tag);
        renderTags();
        updateTagsHidden();
    }
}

function removeTag(tagText) {
    const index = tags.indexOf(tagText);
    if (index > -1) {
        tags.splice(index, 1);
        renderTags();
        updateTagsHidden();
    }
}

function renderTags() {
    const tagsDisplay = document.getElementById('tagsDisplay');
    tagsDisplay.innerHTML = tags.map(tag => `
        <div class="tag-item">
            #${tag}
            <button type="button" class="tag-remove" onclick="removeTag('${tag}')">×</button>
        </div>
    `).join('');
}

function updateTagsHidden() {
    // Remove old hidden inputs
    document.querySelectorAll('input[name="tags[]"]').forEach(input => input.remove());
    
    // Add new hidden inputs
    const form = document.getElementById('entryForm');
    tags.forEach(tag => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'tags[]';
        input.value = tag;
        form.appendChild(input);
    });
}

window.removeTag = removeTag;

// Tag input handler
const tagsInput = document.getElementById('entryTags');
if (tagsInput) {
    tagsInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' || e.key === ',') {
            e.preventDefault();
            addTag(this.value);
            this.value = '';
        }
    });
}

// Suggested tags
document.querySelectorAll('.tag-suggestion').forEach(button => {
    button.addEventListener('click', function() {
        const tag = this.getAttribute('data-tag');
        addTag(tag);
    });
});

// Mood selector
const moodButtons = document.querySelectorAll('.mood-btn');
const moodInput = document.getElementById('moodInput');

moodButtons.forEach(button => {
    button.addEventListener('click', function() {
        moodButtons.forEach(btn => btn.classList.remove('selected'));
        this.classList.add('selected');
        moodInput.value = this.getAttribute('data-mood');
    });
});

// Title character count
const titleInput = document.getElementById('entryTitle');
const titleCount = document.getElementById('titleCount');

if (titleInput && titleCount) {
    titleInput.addEventListener('input', function() {
        const length = this.value.length;
        titleCount.textContent = `${length}/100`;
        if (length > 90) {
            titleCount.style.color = '#ef4444';
        } else {
            titleCount.style.color = '';
        }
    });
}

// Content word count
const contentArea = document.getElementById('entryContent');
const wordCount = document.getElementById('wordCount');

if (contentArea && wordCount) {
    contentArea.addEventListener('input', function() {
        const text = this.value.trim();
        const words = text.split(/\s+/).filter(word => word.length > 0);
        wordCount.textContent = `${words.length} words`;
    });
}