/**
 * METALSTAR — Main JavaScript
 * Vanilla JS only. No frameworks, no jQuery.
 */

(function () {
    'use strict';

    /* ======================================================================
       Hero Video Loading Screen
       ====================================================================== */
    var heroVideo = document.querySelector('.hero-video');
    var heroLoader = document.getElementById('heroLoader');
    var loaderFill = document.getElementById('loaderBarFill');
    var loaderText = document.getElementById('loaderText');

    if (heroVideo && heroLoader) {
        var dots = 0;
        var dotTimer = setInterval(function () {
            dots = (dots + 1) % 4;
            if (loaderText) {
                loaderText.textContent = 'Loading' + '.'.repeat(dots);
            }
        }, 400);

        // Track buffering progress
        var progressTimer = setInterval(function () {
            if (heroVideo.buffered.length > 0) {
                var percent = (heroVideo.buffered.end(0) / heroVideo.duration) * 100;
                if (loaderFill) loaderFill.style.width = percent + '%';
            }
        }, 200);

        function dismissLoader() {
            clearInterval(dotTimer);
            clearInterval(progressTimer);
            if (loaderFill) loaderFill.style.width = '100%';
            setTimeout(function () {
                heroLoader.classList.add('loaded');
            }, 300);
        }

        // Dismiss when video starts playing
        heroVideo.addEventListener('playing', function () {
            dismissLoader();
        }, { once: true });

        // Fallback: dismiss after 8 seconds even if event doesn't fire
        setTimeout(function () {
            if (!heroLoader.classList.contains('loaded')) {
                dismissLoader();
            }
        }, 8000);

        // If video is already playing (cached)
        if (!heroVideo.paused && heroVideo.readyState >= 3) {
            dismissLoader();
        }
    }

    /* ======================================================================
       Dark Mode Toggle
       Default is dark. .light-mode class activates the light theme.
       ====================================================================== */
    const STORAGE_KEY = 'metalstar-theme';
    const toggle = document.getElementById('darkModeToggle');
    const body = document.body;

    function initTheme() {
        const saved = localStorage.getItem(STORAGE_KEY);
        if (saved === 'light') {
            body.classList.add('light-mode');
        }
        updateToggleIcon();
    }

    function updateToggleIcon() {
        if (!toggle) return;
        const icon = toggle.querySelector('.toggle-icon');
        if (!icon) return;
        icon.textContent = body.classList.contains('light-mode') ? '◐' : '◑';
    }

    if (toggle) {
        toggle.addEventListener('click', function () {
            body.classList.toggle('light-mode');
            const isLight = body.classList.contains('light-mode');
            localStorage.setItem(STORAGE_KEY, isLight ? 'light' : 'dark');
            updateToggleIcon();
        });
    }

    initTheme();

    /* ======================================================================
       Mobile Navigation — Hamburger Toggle
       ====================================================================== */
    const hamburger = document.getElementById('navHamburger');
    const navLinks = document.querySelector('.nav-links');
    let overlay = null;

    function createOverlay() {
        if (overlay) return overlay;
        overlay = document.createElement('div');
        overlay.className = 'nav-overlay';
        document.body.appendChild(overlay);
        overlay.addEventListener('click', closeNav);
        return overlay;
    }

    function openNav() {
        navLinks.classList.add('open');
        hamburger.classList.add('active');
        const ov = createOverlay();
        void ov.offsetWidth;
        ov.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeNav() {
        navLinks.classList.remove('open');
        hamburger.classList.remove('active');
        if (overlay) {
            overlay.classList.remove('active');
        }
        document.body.style.overflow = '';
    }

    if (hamburger) {
        hamburger.addEventListener('click', function () {
            const isOpen = navLinks.classList.contains('open');
            if (isOpen) {
                closeNav();
            } else {
                openNav();
            }
        });
    }

    if (navLinks) {
        navLinks.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', closeNav);
        });
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && navLinks && navLinks.classList.contains('open')) {
            closeNav();
        }
    });

    /* ======================================================================
       Trailer Play Button
       ====================================================================== */
    const trailerPlayBtn = document.getElementById('trailerPlayBtn');
    const trailerVideo = document.querySelector('.trailer-video');

    if (trailerPlayBtn && trailerVideo) {
        trailerPlayBtn.addEventListener('click', function () {
            trailerPlayBtn.classList.add('hidden');
            trailerVideo.play();
        });

        // Click video to pause and show play button again
        trailerVideo.addEventListener('click', function () {
            if (!trailerVideo.paused) {
                trailerVideo.pause();
                trailerPlayBtn.classList.remove('hidden');
            }
        });

        // Show play button again when video ends
        trailerVideo.addEventListener('ended', function () {
            trailerPlayBtn.classList.remove('hidden');
        });
    }

    /* ======================================================================
       Nav Auto-hide on Scroll (Homepage only)
       Shows nav when scrolling up or at top, hides when scrolling down
       ====================================================================== */
    const siteNav = document.getElementById('siteNav');
    const isHome = body.querySelector('.page-home') !== null || body.classList.contains('page-home');

    if (siteNav) {
        let lastScrollY = 0;
        let ticking = false;

        function updateNav() {
            const currentScrollY = window.scrollY;

            if (currentScrollY <= 100) {
                // Near top — always show
                siteNav.classList.remove('nav-hidden');
            } else if (currentScrollY > lastScrollY && currentScrollY > 200) {
                // Scrolling down & past threshold
                siteNav.classList.add('nav-hidden');
            } else if (currentScrollY < lastScrollY) {
                // Scrolling up
                siteNav.classList.remove('nav-hidden');
            }

            lastScrollY = currentScrollY;
            ticking = false;
        }

        window.addEventListener('scroll', function () {
            if (!ticking) {
                window.requestAnimationFrame(updateNav);
                ticking = true;
            }
        }, { passive: true });
    }

    /* ======================================================================
       Reading Progress Bar (Chapter pages)
       ====================================================================== */
    const progressBar = document.getElementById('readingProgress');

    if (progressBar) {
        function updateProgress() {
            const scrollTop = window.scrollY;
            const docHeight = document.documentElement.scrollHeight - window.innerHeight;
            if (docHeight <= 0) return;
            const progress = Math.min((scrollTop / docHeight) * 100, 100);
            progressBar.style.width = progress + '%';
        }

        window.addEventListener('scroll', updateProgress, { passive: true });
        updateProgress();
    }

})();
