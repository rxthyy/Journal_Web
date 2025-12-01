// ===== CALENDAR WITH MODAL FUNCTIONALITY =====
(function() {
    'use strict';
    
    let currentDate = new Date();
    let selectedDate = null; // Store the selected date
    const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    
    // Get elements
    const monthPicker = document.getElementById('month-picker');
    const yearElement = document.getElementById('year');
    const prevYearBtn = document.getElementById('prev-year');
    const nextYearBtn = document.getElementById('next-year');
    const calendarDays = document.querySelector('.calendar-days');
    const monthList = document.querySelector('.month-list');
    const fabBtn = document.getElementById('fabBtn');
    const dayModal = document.getElementById('dayModal');
    const entryModal = document.getElementById('entryModal');
    const modalClose = document.getElementById('modalClose');
    const entryModalClose = document.getElementById('entryModalClose');
    const modalTitle = document.getElementById('modalTitle');
    const modalBody = document.getElementById('modalBody');
    const entryDateInput = document.getElementById('entryDate');
    
    console.log('Calendar modal script loaded');
    console.log('Elements:', { fabBtn: !!fabBtn, dayModal: !!dayModal, entryModal: !!entryModal });
    
    // Sample data (will be replaced with real data from database)
    const today = new Date();
    let monthlyEntries = {};

    function initCalendar() {
        currentDate = new Date(today.getFullYear(), today.getMonth(), 1);
        loadMonthEntries(currentDate.getFullYear(), currentDate.getMonth());
        generateMonthList();
        updateStats();
        console.log('Calendar initialized');
    }

    function loadMonthEntries(year, month) {
        fetch(`/calendar/entries-month?year=${year}&month=${month + 1}`)
            .then(res => res.json())
            .then(data => {
                monthlyEntries = data;
                generateCalendar(month, year);
            })
            .catch(err => console.error("Month load failed:", err));
    }
    
    
    function generateCalendar(month, year) {
        if (!calendarDays) return;
        
        calendarDays.innerHTML = '';
        if (monthPicker) monthPicker.textContent = monthNames[month];
        if (yearElement) yearElement.textContent = year;
        
        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        const daysInPrevMonth = new Date(year, month, 0).getDate();
        
        // Previous month days
        for (let i = firstDay - 1; i >= 0; i--) {
            const dayElement = createDayElement(daysInPrevMonth - i, 'prev-month', year, month - 1);
            calendarDays.appendChild(dayElement);
        }
        
        // Current month days
        const todayDate = new Date();
        for (let day = 1; day <= daysInMonth; day++) {
            const isToday = day === todayDate.getDate() && 
                           month === todayDate.getMonth() && 
                           year === todayDate.getFullYear();
            const dayElement = createDayElement(day, isToday ? 'current-day' : '', year, month);
            calendarDays.appendChild(dayElement);
        }
        
        // Next month days
        const totalCells = calendarDays.children.length;
        const remainingCells = totalCells % 7 === 0 ? 0 : 7 - (totalCells % 7);
        for (let day = 1; day <= remainingCells; day++) {
            const dayElement = createDayElement(day, 'next-month', year, month + 1);
            calendarDays.appendChild(dayElement);
        }
        
        updateStats();
    }
    
    function createDayElement(day, className, year, month) {
        const dayElement = document.createElement('div');
        dayElement.classList.add('calendar-day');
        if (className) dayElement.classList.add(className);
        
        const dayNumber = document.createElement('span');
        dayNumber.textContent = day;
        dayElement.appendChild(dayNumber);
        
        if (className !== 'prev-month' && className !== 'next-month') {
            const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
            const entries = monthlyEntries[dateStr];
            
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
            
            dayElement.addEventListener('click', () => {
                console.log('Day clicked:', dateStr);
                openDayModal(year, month, day, entries, dateStr);
            });
        }
        
        return dayElement;
    }
    
    function openDayModal(year, month, day, entries, dateStr) {
        selectedDate = dateStr;
    
        const displayDate = `${monthNames[month]} ${day}, ${year}`;
        modalTitle.textContent = `Loading entries for ${displayDate}...`;
        modalBody.innerHTML = `<p>Loading...</p>`;
        dayModal.classList.add('show');
    
        fetch(`/calendar/entries/${dateStr}`)
            .then(res => res.json())
            .then(data => {
                modalTitle.textContent = data.length
                    ? `Entries for ${displayDate}`
                    : `No entries for ${displayDate}`;
    
                modalBody.innerHTML = '';
    
                if (!data.length) {
                    modalBody.innerHTML = `
                        <div class="empty-day-message">
                            <i class="fa-solid fa-calendar-plus"></i>
                            <p>No entries yet.</p>
                        </div>
                    `;
                    return;
                }
    
                data.forEach(entry => {
                    const div = document.createElement('div');
                    div.classList.add('modal-entry');
                    div.innerHTML = `
                        <div class="modal-entry-header">
                            <h3>${entry.title}</h3>
                            <span>${entry.privacy}</span>
                        </div>
                        <p>${entry.content}</p>
                        <small>${entry.created_at} ${entry.mood ? '• ' + entry.mood : ''}</small>
                    `;
                    modalBody.appendChild(div);
                });
            });
    }
    
    
    function closeDayModal() {
        if (dayModal) dayModal.classList.remove('show');
    }
    
    function openEntryModal(date) {
        console.log('Opening entry modal for date:', date);
        
        if (!entryModal) {
            console.error('Entry modal not found!');
            return;
        }
        
        // Set the date in the hidden input
        if (entryDateInput) {
            entryDateInput.value = date || new Date().toISOString().split('T')[0];
            console.log('Date set in form:', entryDateInput.value);
        }
        
        entryModal.classList.add('show');
    }
    
    function closeEntryModal() {
        if (entryModal) entryModal.classList.remove('show');
    }
    
    function getPrivacyIcon(privacy) {
        const icons = { 'public': 'globe', 'friends': 'user-group', 'private': 'lock' };
        return icons[privacy] || 'globe';
    }
    
    function updateStats() {
        const monthEntries = document.getElementById('monthEntries');
        const currentStreak = document.getElementById('currentStreak');
        if (!monthEntries) return;
        
        // This will be replaced with real data from database
        monthEntries.textContent = '0';
        currentStreak.textContent = '0';
    }
    
    function generateMonthList() {
        if (!monthList) return;
        monthList.innerHTML = '';
        monthNames.forEach((month, index) => {
            const monthElement = document.createElement('div');
            monthElement.textContent = month;
            monthElement.addEventListener('click', () => {
                currentDate.setMonth(index);
                loadMonthEntries(currentDate.getFullYear(), currentDate.getMonth());
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
    
    // FAB button opens entry modal for today
    if (fabBtn) {
        fabBtn.addEventListener('click', (e) => {
            e.preventDefault();
            console.log('FAB clicked');
            openEntryModal(new Date().toISOString().split('T')[0]);
        });
    }
    
    // Create Entry button in day modal - use event delegation
    if (dayModal) {
        dayModal.addEventListener('click', (e) => {
            if (e.target.id === 'createEntryBtn' || e.target.closest('#createEntryBtn')) {
                e.preventDefault();
                console.log('Create entry button clicked');
                closeDayModal();
                openEntryModal(selectedDate || new Date().toISOString().split('T')[0]);
            }
        });
    }
    
    // Close modals
    if (modalClose) {
        modalClose.addEventListener('click', closeDayModal);
    }
    
    if (entryModalClose) {
        entryModalClose.addEventListener('click', closeEntryModal);
    }
    
    // Close modal on backdrop click
    if (dayModal) {
        dayModal.addEventListener('click', (e) => {
            if (e.target === dayModal) closeDayModal();
        });
    }
    
    if (entryModal) {
        entryModal.addEventListener('click', (e) => {
            if (e.target === entryModal) closeEntryModal();
        });
    }
    
    // Close month picker when clicking outside
    document.addEventListener('click', (e) => {
        if (monthPicker && monthList && !monthPicker.contains(e.target) && !monthList.contains(e.target)) {
            monthList.classList.remove('show');
        }
    });
    
    // Keyboard shortcuts
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeDayModal();
            closeEntryModal();
            if (monthList) monthList.classList.remove('show');
        }
    });
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initCalendar);
    } else {
        initCalendar();
    }
})();