<?php
/**
 * METALSTAR — Homepage
 * Displays hero video, trailer, chapter grid, podcasts section.
 */

// Page variables for header
$page_title       = 'Metalstar | A Post-Apocalyptic Sci-Fi Novel by Aaron Hill';
$page_description = 'Set in the 24th century, Metalstar follows Sarah, a clone wielding a powerful electrostatic cannon, John, another clone, and Jayk, a survivor of the Dark Epoch, as they fight to reclaim Earth from alien invaders.';
$page_keywords    = 'Metalstar, science fiction, post-apocalyptic, novel, Aaron Hill, clones, aliens, Dark Epoch';
$page_image       = '/assets/images/metalstar-og.webp';
$page_url         = 'https://metalstar.us/';
$canonical_url    = 'https://metalstar.us/';
$page_type        = 'home';
$body_class       = 'page-home';

require __DIR__ . '/inc/header.php';
?>

    <!-- Hero Section — Full Viewport Video Background -->
    <section class="hero" id="hero">
        <!-- Loading Overlay -->
        <div class="hero-loader" id="heroLoader">
            <img src="/assets/images/Metalstar-Vectorr.png" alt="Metalstar" class="loader-logo">
            <div class="loader-bar-track">
                <div class="loader-bar-fill" id="loaderBarFill"></div>
            </div>
            <span class="loader-text" id="loaderText">Loading</span>
        </div>
        <video class="hero-video" autoplay muted loop playsinline poster="/assets/images/Jayk-Desert.webp">
            <source src="/assets/video/Metalstar-Trailer-Website.mp4" type="video/mp4">
        </video>
        <div class="hero-text">
            <span class="hero-title">METALSTAR</span>
            <span class="hero-author">Aaron Hill</span>
        </div>
    </section>

    <!-- Trailer Section -->
    <section class="trailer-section" id="trailer">
        <div class="trailer-inner">
            <img src="/assets/images/Metalstar-Vectorr.png" alt="Metalstar" class="trailer-logo">
            <p class="trailer-label">OFFICIAL MOVIE TRAILER</p>
            <div class="trailer-embed">
                <video class="trailer-video" preload="none" poster="/assets/images/Jayk-Desert.webp">
                    <source src="/assets/video/Metalstar-Offical-Movie-Trailer.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <button class="trailer-play-btn" id="trailerPlayBtn" aria-label="Play trailer">
                    <svg viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="40" cy="40" r="38" stroke="white" stroke-width="3" opacity="0.8"/>
                        <polygon points="32,24 58,40 32,56" fill="white" opacity="0.9"/>
                    </svg>
                </button>
            </div>
        </div>
    </section>

    <!-- Chapter Grid -->
    <section class="chapters-section" id="chapters">
        <h2 class="section-heading">CHAPTERS</h2>
        <div class="chapter-grid">
            <?php foreach ($chapters as $num => $ch): ?>
            <article class="chapter-card" data-chapter="<?= $num ?>">
                <a href="/<?= htmlspecialchars($ch['slug']) ?>/">
                    <div class="chapter-card-image" style="background-image: url('/assets/images/<?= htmlspecialchars($ch['card_image'] ?? $ch['image'] ?? '') ?>');">
                        <div class="chapter-card-gradient"></div>
                        <div class="chapter-card-content">
                            <h3 class="chapter-card-title"><?= htmlspecialchars($ch['title']) ?></h3>
                            <div class="chapter-card-bottom">
                                <span class="chapter-card-number">Chapter <?= htmlspecialchars($ch['number']) ?></span>
                                <span class="chapter-card-share" aria-label="Share">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/>
                                        <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </article>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Podcasts Section -->
    <section class="podcasts-section" id="podcasts">
        <h2 class="section-heading">PODCASTS</h2>
        <p class="podcasts-subtitle">The Sinister Plots Podcast: Metalstar Deep Dives</p>
        <div class="podcast-grid">
            <div class="podcast-card">
                <div class="podcast-video"><iframe src="https://www.youtube.com/embed/hAa8GOzKdgc" title="Metalstar Chapter One Review" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen loading="lazy"></iframe></div>
                <p class="podcast-label">Chapter One: Dark Epoch</p>
            </div>
            <div class="podcast-card">
                <div class="podcast-video"><iframe src="https://www.youtube.com/embed/OVGVNSPqQUY" title="Metalstar Chapter Two Review" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen loading="lazy"></iframe></div>
                <p class="podcast-label">Chapter Two: Sour Ichor</p>
            </div>
            <div class="podcast-card">
                <div class="podcast-video"><iframe src="https://www.youtube.com/embed/I2RBqsmKhtw" title="Metalstar Chapter Three Review" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen loading="lazy"></iframe></div>
                <p class="podcast-label">Chapter Three: Wachichu</p>
            </div>
            <div class="podcast-card">
                <div class="podcast-video"><iframe src="https://www.youtube.com/embed/_4OhMm_0MRk" title="Metalstar Chapter Four Review" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen loading="lazy"></iframe></div>
                <p class="podcast-label">Chapter Four: Sky Reapers</p>
            </div>
            <div class="podcast-card">
                <div class="podcast-video"><iframe src="https://www.youtube.com/embed/bCIRtyd9KMU" title="Metalstar Chapter Five Review" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen loading="lazy"></iframe></div>
                <p class="podcast-label">Chapter Five: Baroque Fantasia</p>
            </div>
            <div class="podcast-card">
                <div class="podcast-video"><iframe src="https://www.youtube.com/embed/vHeECAzwqMc" title="Metalstar Chapter Six Review" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen loading="lazy"></iframe></div>
                <p class="podcast-label">Chapter Six: Secret Weapon</p>
            </div>
            <div class="podcast-card">
                <div class="podcast-video"><iframe src="https://www.youtube.com/embed/kY0wCjCVBtk" title="Metalstar Chapter Seven Review" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen loading="lazy"></iframe></div>
                <p class="podcast-label">Chapter Seven: Sid Mantelis</p>
            </div>
            <div class="podcast-card">
                <div class="podcast-video"><iframe src="https://www.youtube.com/embed/Af9np9NwQvw" title="Metalstar Chapter Eight Review" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen loading="lazy"></iframe></div>
                <p class="podcast-label">Chapter Eight: New Beginnings</p>
            </div>
            <div class="podcast-card">
                <div class="podcast-video"><iframe src="https://www.youtube.com/embed/qiDj3_do96E" title="Metalstar Chapter Nine Review" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen loading="lazy"></iframe></div>
                <p class="podcast-label">Chapter Nine: Charged Particles</p>
            </div>
            <div class="podcast-card">
                <div class="podcast-video"><iframe src="https://www.youtube.com/embed/cFkwKXivya0" title="Metalstar Chapter Ten Review" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen loading="lazy"></iframe></div>
                <p class="podcast-label">Chapter Ten: Solos</p>
            </div>
            <div class="podcast-card">
                <div class="podcast-video"><iframe src="https://www.youtube.com/embed/y8ds9EfolcI" title="Metalstar Chapter Eleven Review" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen loading="lazy"></iframe></div>
                <p class="podcast-label">Chapter Eleven: Wasteland</p>
            </div>
            <div class="podcast-card">
                <div class="podcast-video"><iframe src="https://www.youtube.com/embed/k4IE6Q8XQII" title="Metalstar Chapter Twelve Review" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen loading="lazy"></iframe></div>
                <p class="podcast-label">Chapter Twelve: The Free City</p>
            </div>
            <div class="podcast-card">
                <div class="podcast-video"><iframe src="https://www.youtube.com/embed/sHc-dpRcK9s" title="Metalstar Chapter Thirteen Review" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen loading="lazy"></iframe></div>
                <p class="podcast-label">Chapter Thirteen: The Prophecy</p>
            </div>
        </div>
    </section>

<?php require __DIR__ . '/inc/footer.php'; ?>
