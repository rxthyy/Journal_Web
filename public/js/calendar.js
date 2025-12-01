// ===== CALENDAR FUNCTIONALITY WITH DEBUG =====
(function() {
    'use strict';
    
    console.log('Calendar script starting...');
    
    let currentDate = new Date();
    const monthNames = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
    ];

    // Get today's date for sample data
    const today = new Date();
    const currentYear = today.getFullYear();
    const currentMonth = today.getMonth() + 1;

    // Sample entry data - dynamically generated for current month
    const sampleEntries = {
        [`${currentYear}-${String(currentMonth).padStart(2, '0')}-01`]: [
            { id: 1, title: 'New Month, New Goals', preview: 'Setting my intentions...', privacy: 'public', tags: ['goals'] }
        ],
        [`${currentYear}-${String(currentMonth).padStart(2, '0')}-05`]: [
            { id: 2, title: 'Midweek Check-in', preview: 'Reflecting on progress...', privacy: 'private', tags: ['reflection'] }
        ],
        [`${currentYear}-${String(currentMonth).padStart(2, '0')}-10`]: [
            { id: 3, title: 'Weekend Plans', preview: 'Excited for the weekend...', privacy: 'friends', tags: ['weekend'] }
        ],
        [`${currentYear}-${String(currentMonth).padStart(2, '0')}-15`]: [
            { id: 4, title: 'Halfway Through', preview: 'Already halfway...', privacy: 'public', tags: ['progress'] },
            { id: 5, title: 'Evening Gratitude', preview: 'Three things I am grateful for...', privacy: 'private', tags: ['gratitude'] }
        ],
        [`${currentYear}-${String(currentMonth).padStart(2, '0')}-20`]: [
            { id: 6, title: 'Learning Something New', preview: 'Picked up a new skill...', privacy: 'public', tags: ['learning'] }
        ],
        [`${currentYear}-${String(currentMonth).padStart(2, '0')}-25`]: [
            { id: 7, title: 'Family Time', preview: 'Quality time with loved ones...', privacy: 'private', tags: ['family'] }
        ],
        [`${currentYear}-${String(currentMonth).padStart(2, '0')}-${String(today.getDate()).padStart(2, '0')}`]: [
            { id: 8, title: 'Today\'s Entry', preview: 'What a day it has been!...', privacy: 'public', tags: ['daily'] },
            { id: 9, title: 'Evening Reflection', preview: 'Taking time to reflect...', privacy: 'private', tags: ['reflection'] }
        ]
    };

    // Get elements
    const monthPicker = document.getElementById('month-picker');
    const yearElement = document.getElementById('year');
    const prevYearBtn = document.getElementById('prev-year');
    const nextYearBtn = document.getElementById('next-year');
    const calendarDays = document.querySelector('.calendar-days');
    const monthList = document.querySelector('.month-list');
    const fabBtn = document.getElementById('fabBtn');
    const dayModal = document.getElementById('dayModal');
    const modalClose = document.getElementById('modalClose');
    const modalTitle = document.getElementById('modalTitle');
    const modalBody = document.getElementById('modalBody');
    const createEntryBtn = document.getElementById('createEntryBtn');

    // Initialize calendar
    function initCalendar() {
        console.log('Initializing calendar...');
        currentDate = new Date(today.getFullYear(), today.getMonth(), 1);
        generateCalendar(currentDate.getMonth(), currentDate.getFullYear());
        generateMonthList();
        updateStats();
        console.log('Calendar initialized successfully!');
    }

    // Generate calendar days
    function generateCalendar(month, year) {
        if (!calendarDays) {
            console.error('Calendar days element not found!');
            return;
        }
        
        calendarDays.innerHTML = '';
        
        // Update header
        if (monthPicker) monthPicker.textContent = monthNames[month];
        if (yearElement) yearElement.textContent = year;
        
        // Get first day of month and number of days
        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        const daysInPrevMonth = new Date(year, month, 0).getDate();
        
        // Previous month's trailing days
        for (let i = firstDay - 1; i >= 0; i--) {
            const dayElement = createDayElement(daysInPrevMonth - i, 'prev-month', year, month - 1);
            calendarDays.appendChild(dayElement);
        }
        
        // Current month's days
        const todayDate = new Date();
        for (let day = 1; day <= daysInMonth; day++) {
            const isToday = day === todayDate.getDate() && 
                           month === todayDate.getMonth() && 
                           year === todayDate.getFullYear();
            
            const dayElement = createDayElement(day, isToday ? 'current-day' : '', year, month);
            calendarDays.appendChild(dayElement);
        }
        
        // Next month's leading days
        const totalCells = calendarDays.children.length;
        const remainingCells = totalCells % 7 === 0 ? 0 : 7 - (totalCells % 7);
        
        for (let day = 1; day <= remainingCells; day++) {
            const dayElement = createDayElement(day, 'next-month', year, month + 1);
            calendarDays.appendChild(dayElement);
        }
        
        updateStats();
    }

    // Create day element
    function createDayElement(day, className, year, month) {
        const dayElement = document.createElement('div');
        dayElement.classList.add('calendar-day');
        if (className) dayElement.classList.add(className);
        
        const dayNumber = document.createElement('span');
        dayNumber.textContent = day;
        dayElement.appendChild(dayNumber);
        
        // Check for entries and add indicators
        if (className !== 'prev-month' && className !== 'next-month') {
            const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
            const entries = sampleEntries[dateStr];
            
            if (entries && entries.length > 0) {
                dayElement.classList.add('has-entry');
                
                const indicators = document.createElement('div');
                indicators.classList.add('entry-indicators');
                
                entries.slice(0, 3).forEach(entry => {
                    const dot = document.createElement('span');
                    dot.classList.add('entry-dot', `${entry.privacy}-dot`);
                    indicators.appendChild(dot);
                });
                
                dayElement.appendChild(indicators);
            }
            
            // Add click event
            dayElement.addEventListener('click', () => {
                openDayModal(year, month, day, entries);
            });
            
            if (entries && entries.length > 0) {
                const titles = entries.map(e => e.title).join(', ');
                dayElement.setAttribute('title', titles);
            }
        }
        
        return dayElement;
    }

    // Open day modal
    function openDayModal(year, month, day, entries) {
        if (!dayModal) {
            alert(`Date: ${monthNames[month]} ${day}, ${year}\nEntries: ${entries ? entries.length : 0}`);
            return;
        }
        
        const dateStr = `${monthNames[month]} ${day}, ${year}`;
        modalTitle.textContent = entries && entries.length > 0 
            ? `Entries for ${dateStr}` 
            : `No entries for ${dateStr}`;
        
        modalBody.innerHTML = '';
        
        if (entries && entries.length > 0) {
            entries.forEach(entry => {
                const entryDiv = document.createElement('div');
                entryDiv.classList.add('modal-entry');
                entryDiv.innerHTML = `
                    <div class="modal-entry-header">
                        <h3 class="modal-entry-title">${entry.title}</h3>
                        <div class="modal-entry-privacy">
                            <i class="fa-solid fa-${getPrivacyIcon(entry.privacy)}"></i>
                            <span>${entry.privacy}</span>
                        </div>
                    </div>
                    <p class="modal-entry-preview">${entry.preview}</p>
                    <div class="modal-entry-tags">
                        ${entry.tags.map(tag => `<span class="tag">#${tag}</span>`).join('')}
                    </div>
                `;
                
                entryDiv.addEventListener('click', () => {
                    });
                
                modalBody.appendChild(entryDiv);
            });
        } else {
            modalBody.innerHTML = `
                <div class="empty-day-message">
                    <i class="fa-solid fa-calendar-plus"></i>
                    <p>No entries yet for this day.</p>
                    <p>Click the button below to create your first entry!</p>
                </div>
            `;
        }
        
        if (createEntryBtn) {
            createEntryBtn.onclick = () => {
                const formattedDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
            };
        }
        
        dayModal.classList.add('show');
    }

    // Close modal
    function closeDayModal() {
        if (dayModal) dayModal.classList.remove('show');
    }

    // Get privacy icon
    function getPrivacyIcon(privacy) {
        const icons = { 'public': 'globe', 'friends': 'user-group', 'private': 'lock' };
        return icons[privacy] || 'globe';
    }

    // Update stats
    function updateStats() {
        const monthEntries = document.getElementById('monthEntries');
        const currentStreak = document.getElementById('currentStreak');
        
        if (!monthEntries) return;
        
        const month = currentDate.getMonth();
        const year = currentDate.getFullYear();
        
        let monthCount = 0;
        Object.keys(sampleEntries).forEach(dateStr => {
            const entryDate = new Date(dateStr);
            if (entryDate.getMonth() === month && entryDate.getFullYear() === year) {
                monthCount += sampleEntries[dateStr].length;
            }
        });
        
        monthEntries.textContent = monthCount;
        
        let streak = 0;
        let checkDate = new Date(today);
        while (true) {
            const dateStr = checkDate.toISOString().split('T')[0];
            if (sampleEntries[dateStr]) {
                streak++;
                checkDate.setDate(checkDate.getDate() - 1);
            } else {
                break;
            }
        }
        
        currentStreak.textContent = streak;
    }

    // Generate month list
    function generateMonthList() {
        if (!monthList) return;
        
        monthList.innerHTML = '';
        monthNames.forEach((month, index) => {
            const monthElement = document.createElement('div');
            monthElement.textContent = month;
            monthElement.addEventListener('click', () => {
                currentDate.setMonth(index);
                generateCalendar(currentDate.getMonth(), currentDate.getFullYear());
                monthList.classList.remove('show');
            });
            monthList.appendChild(monthElement);
        });
    }

    // Event listeners
    if (monthPicker) {
        monthPicker.addEventListener('click', () => {
            if (monthList) monthList.classList.toggle('show');
        });
    }

    if (prevYearBtn) {
        prevYearBtn.addEventListener('click', () => {
            currentDate.setFullYear(currentDate.getFullYear() - 1);
            generateCalendar(currentDate.getMonth(), currentDate.getFullYear());
        });
    }

    if (nextYearBtn) {
        nextYearBtn.addEventListener('click', () => {
            currentDate.setFullYear(currentDate.getFullYear() + 1);
            generateCalendar(currentDate.getMonth(), currentDate.getFullYear());
        });
    }

    if (fabBtn) {
        fabBtn.addEventListener('click', () => {
        });
    }

    if (modalClose) {
        modalClose.addEventListener('click', closeDayModal);
    }

    if (dayModal) {
        dayModal.addEventListener('click', (e) => {
            if (e.target === dayModal) closeDayModal();
        });
    }

    document.addEventListener('click', (e) => {
        if (monthPicker && monthList && !monthPicker.contains(e.target) && !monthList.contains(e.target)) {
            monthList.classList.remove('show');
        }
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && dayModal && dayModal.classList.contains('show')) {
            closeDayModal();
        }
    });

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initCalendar);
    } else {
        initCalendar();
    }
    
    // Modal elements
const entryModal = document.getElementById('entryModal');
const entryModalClose = document.getElementById('entryModalClose');
const entryDateInput = document.getElementById('entryDate');

// Open modal when a day is clicked
document.querySelectorAll('.calendar-day').forEach(day => {
    day.addEventListener('click', function() {
        const date = this.dataset.date; // make sure each day div has data-date="YYYY-MM-DD"
        entryDateInput.value = date; // fill hidden input
        entryModal.style.display = 'block';
    });
});

// Close modal
entryModalClose.addEventListener('click', function() {
    entryModal.style.display = 'none';
});

// Close when clicking outside modal
window.addEventListener('click', function(e) {
    if (e.target == entryModal) {
        entryModal.style.display = 'none';
    }
});

})();