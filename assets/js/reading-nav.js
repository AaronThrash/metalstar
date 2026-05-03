/**
 * Metalstar Reading Navigation
 *
 * Floating scroll widget: up/down chevrons + progress %.
 * Auto-save bookmark + resume toast.
 */

(function () {
    'use strict';

    // Only run on chapter pages
    if (!document.body.classList.contains('page-chapter')) return;

    var nav = null;
    var darkToggle = null;
    var progressEl = null;
    var scrollTimeout = null;
    var hideTimeout = null;
    var saveTimeout = null;
    var HIDE_DELAY = 1500;
    var SAVE_DELAY = 2000;
    var BOOKMARK_KEY = 'ms-bookmark-' + window.location.pathname;
    var THEME_KEY = 'metalstar-theme';

    function getScrollPercent() {
        var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        var docHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        if (docHeight <= 0) return 0;
        return Math.round((scrollTop / docHeight) * 100);
    }

    function showWidgets() {
        nav.classList.add('visible');
        if (darkToggle) darkToggle.classList.add('visible');
    }

    function hideWidgets() {
        nav.classList.remove('visible');
        if (darkToggle) darkToggle.classList.remove('visible');
    }

    function resetHideTimer() {
        if (hideTimeout) clearTimeout(hideTimeout);
        hideTimeout = setTimeout(hideWidgets, HIDE_DELAY);
    }

    function updateProgress() {
        if (!nav || !progressEl) return;
        var percent = getScrollPercent();
        progressEl.textContent = percent + '%';

        if (percent > 2) {
            showWidgets();
            resetHideTimer();
        } else {
            hideWidgets();
            if (hideTimeout) clearTimeout(hideTimeout);
        }
    }

    function scrollUp() {
        window.scrollBy({ top: -(window.innerHeight * 0.85), behavior: 'smooth' });
    }

    function scrollDown() {
        window.scrollBy({ top: window.innerHeight * 0.85, behavior: 'smooth' });
    }

    function createNav() {
        var docHeight = document.documentElement.scrollHeight;
        var viewHeight = document.documentElement.clientHeight;
        if (docHeight <= viewHeight + 100) return;

        nav = document.createElement('div');
        nav.className = 'ms-reading-nav';
        nav.setAttribute('role', 'navigation');
        nav.setAttribute('aria-label', 'Reading navigation');

        // Up button
        var upBtn = document.createElement('button');
        upBtn.className = 'ms-nav-up';
        upBtn.setAttribute('aria-label', 'Scroll up');
        var upChevron = document.createElement('span');
        upChevron.className = 'ms-chevron';
        upBtn.appendChild(upChevron);
        upBtn.addEventListener('click', scrollUp);

        // Progress
        progressEl = document.createElement('div');
        progressEl.className = 'ms-reading-progress';
        progressEl.textContent = '0%';

        // Down button
        var downBtn = document.createElement('button');
        downBtn.className = 'ms-nav-down';
        downBtn.setAttribute('aria-label', 'Scroll down');
        var downChevron = document.createElement('span');
        downChevron.className = 'ms-chevron';
        downBtn.appendChild(downChevron);
        downBtn.addEventListener('click', scrollDown);

        nav.appendChild(upBtn);
        nav.appendChild(progressEl);
        nav.appendChild(downBtn);
        document.body.appendChild(nav);

        updateProgress();
    }

    // === DARK MODE TOGGLE ===

    function createDarkToggle() {
        darkToggle = document.createElement('button');
        darkToggle.className = 'ms-dark-toggle';
        darkToggle.setAttribute('aria-label', 'Toggle dark mode');
        darkToggle.textContent = document.body.classList.contains('light-mode') ? '☀️' : '🌙';

        darkToggle.addEventListener('click', function () {
            document.body.classList.toggle('light-mode');
            var isLight = document.body.classList.contains('light-mode');
            localStorage.setItem(THEME_KEY, isLight ? 'light' : 'dark');
            darkToggle.textContent = isLight ? '☀️' : '🌙';
        });

        document.body.appendChild(darkToggle);
    }

    // === BOOKMARK SYSTEM ===

    function saveBookmark() {
        var percent = getScrollPercent();
        if (percent > 3) {
            localStorage.setItem(BOOKMARK_KEY, JSON.stringify({
                percent: percent,
                scrollY: window.pageYOffset || document.documentElement.scrollTop,
                timestamp: Date.now()
            }));
        } else {
            localStorage.removeItem(BOOKMARK_KEY);
        }
    }

    function showResumeToast(bookmark) {
        var toast = document.createElement('div');
        toast.className = 'ms-resume-toast';
        toast.innerHTML = 'Pick up where you left off? (' + bookmark.percent + '%)';

        var dismissed = false;
        var dismissTimer = null;

        function dismissToast() {
            if (dismissed) return;
            dismissed = true;
            toast.classList.remove('visible');
            setTimeout(function () { toast.remove(); }, 300);
            if (dismissTimer) clearTimeout(dismissTimer);
            window.removeEventListener('scroll', scrollDismiss);
        }

        function scrollDismiss() {
            if (getScrollPercent() > 10) dismissToast();
        }

        toast.addEventListener('click', function () {
            if (dismissed) return;
            var docHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            var targetY = (bookmark.percent / 100) * docHeight;
            window.scrollTo({ top: targetY, behavior: 'smooth' });
            dismissToast();
        });

        document.body.appendChild(toast);
        requestAnimationFrame(function () {
            requestAnimationFrame(function () {
                toast.classList.add('visible');
            });
        });

        window.addEventListener('scroll', scrollDismiss, { passive: true });
        dismissTimer = setTimeout(dismissToast, 10000);
    }

    function checkBookmark() {
        var saved = localStorage.getItem(BOOKMARK_KEY);
        if (!saved) return;
        try {
            var bookmark = JSON.parse(saved);
            var sevenDays = 7 * 24 * 60 * 60 * 1000;
            if (bookmark.percent > 5 && bookmark.percent < 98 &&
                (Date.now() - bookmark.timestamp) < sevenDays) {
                setTimeout(function () { showResumeToast(bookmark); }, 800);
            }
        } catch (e) {
            localStorage.removeItem(BOOKMARK_KEY);
        }
    }

    // === INIT ===

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function () {
            createNav();
            createDarkToggle();
            checkBookmark();
        });
    } else {
        createNav();
        createDarkToggle();
        checkBookmark();
    }

    window.addEventListener('scroll', function () {
        if (scrollTimeout) return;
        scrollTimeout = setTimeout(function () {
            updateProgress();
            scrollTimeout = null;
        }, 50);

        if (!saveTimeout) {
            saveTimeout = setTimeout(function () {
                saveBookmark();
                saveTimeout = null;
            }, SAVE_DELAY);
        }
    }, { passive: true });

    window.addEventListener('resize', function () { updateProgress(); }, { passive: true });
    window.addEventListener('beforeunload', saveBookmark);

    /* ------------------------------------------------------------------
       Floating Menu Button + Slide-out Nav (desktop chapter pages)
       ------------------------------------------------------------------ */
    var menuBtn = document.getElementById('floatingMenuBtn');
    var slideoutNav = document.getElementById('slideoutNav');
    var slideoutOverlay = document.getElementById('slideoutOverlay');
    var slideoutClose = document.getElementById('slideoutClose');

    if (menuBtn && slideoutNav) {
        // Show/hide menu button on scroll (same logic as dark mode toggle)
        var menuHideTimer;
        function showMenuBtn() {
            if (window.scrollY > 100) {
                menuBtn.classList.add('visible');
                clearTimeout(menuHideTimer);
                menuHideTimer = setTimeout(function () {
                    if (!slideoutNav.classList.contains('open')) {
                        menuBtn.classList.remove('visible');
                    }
                }, 2000);
            } else {
                menuBtn.classList.remove('visible');
            }
        }

        window.addEventListener('scroll', showMenuBtn, { passive: true });

        function openSlideout() {
            slideoutNav.classList.add('open');
            slideoutOverlay.classList.add('open');
            menuBtn.classList.add('visible');
            clearTimeout(menuHideTimer);
        }

        function closeSlideout() {
            slideoutNav.classList.remove('open');
            slideoutOverlay.classList.remove('open');
        }

        menuBtn.addEventListener('click', openSlideout);
        slideoutClose.addEventListener('click', closeSlideout);
        slideoutOverlay.addEventListener('click', closeSlideout);

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && slideoutNav.classList.contains('open')) {
                closeSlideout();
            }
        });
    }
})();
