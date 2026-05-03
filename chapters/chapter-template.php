<?php
/**
 * METALSTAR — Chapter Template
 *
 * Reusable template included by individual chapter files.
 *
 * Usage (e.g., chapters/chapter-one.php):
 *   <?php
 *   $chapter_num = 1;
 *   $chapter_content_file = __DIR__ . '/content/chapter-one.html';
 *   require __DIR__ . '/chapter-template.php';
 *
 * Expects:
 *   $chapter_num          — integer key into $chapters array
 *   $chapter_content_file — path to the raw HTML content file
 */

require_once dirname(__DIR__) . '/inc/chapter-data.php';

// Validate chapter exists
if (!isset($chapters[$chapter_num])) {
    http_response_code(404);
    $page_title = '404 — Chapter Not Found | Metalstar';
    $body_class = 'page-404';
    require dirname(__DIR__) . '/inc/header.php';
    echo '<div class="page-404">';
    echo '<h1>404</h1>';
    echo '<p>This chapter doesn\'t exist yet. The wasteland stretches on.</p>';
    echo '<a href="/" class="btn">Return to base</a>';
    echo '</div>';
    require dirname(__DIR__) . '/inc/footer.php';
    exit;
}

$chapter = $chapters[$chapter_num];
$adjacent = get_adjacent_chapters($chapter_num);

// Load content for reading time estimation
$content_html = '';
if (file_exists($chapter_content_file)) {
    $content_html = file_get_contents($chapter_content_file);
}
$read_time = reading_time($content_html);

// Set page variables for header
$page_title       = 'Chapter ' . $chapter['number'] . ': ' . $chapter['title'] . ' | Metalstar';
$page_description = $chapter['description'];
$page_keywords    = $chapter['keywords'];
$page_image       = !empty($chapter['image'])
    ? '/assets/images/' . $chapter['image']
    : '/assets/images/metalstar-og.webp';
$page_url         = 'https://metalstar.us/' . $chapter['slug'] . '/';
$canonical_url    = $page_url;
$page_type        = 'chapter';
$body_class       = 'page-chapter';
$extra_css        = 'chapters.css';
$extra_js         = 'reading-nav.js';

require dirname(__DIR__) . '/inc/header.php';
?>

    <!-- Reading Progress Bar -->
    <div class="reading-progress" id="readingProgress"></div>

    <!-- Floating Menu Button (desktop chapter pages) -->
    <button class="floating-menu-btn" id="floatingMenuBtn" aria-label="Open navigation menu">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
    </button>

    <!-- Slide-out Navigation Panel -->
    <div class="slideout-overlay" id="slideoutOverlay"></div>
    <nav class="slideout-nav" id="slideoutNav" aria-label="Site navigation">
        <button class="slideout-close" id="slideoutClose" aria-label="Close navigation">✕</button>
        <a href="/" class="slideout-link">Home</a>
        <a href="/about/" class="slideout-link">About</a>
        <a href="/summary/" class="slideout-link">Summary</a>
        <a href="/prologue/" class="slideout-link">Prologue</a>
        <div class="slideout-divider"></div>
        <span class="slideout-heading">Chapters</span>
        <?php foreach ($chapters as $ch): ?>
        <a href="/<?= htmlspecialchars($ch['slug']) ?>/" class="slideout-link slideout-chapter<?= ($ch['slug'] === $chapter['slug']) ? ' slideout-active' : '' ?>"><?= htmlspecialchars($ch['number'] . '. ' . $ch['title']) ?></a>
        <?php endforeach; ?>
    </nav>

    <!-- Chapter Header -->
    <header class="chapter-header">
        <span class="chapter-number">Chapter <?= htmlspecialchars($chapter['number']) ?></span>
        <h1 class="chapter-title"><?= htmlspecialchars($chapter['title']) ?></h1>
    </header>

    <?php if (!empty($chapter['quote'])): ?>
    <!-- Chapter Epigraph -->
    <blockquote class="chapter-epigraph">
        <p><?= htmlspecialchars($chapter['quote']) ?></p>
        <?php if (!empty($chapter['quote_author'])): ?>
        <cite><?= htmlspecialchars($chapter['quote_author']) ?></cite>
        <?php endif; ?>
    </blockquote>
    <?php endif; ?>

    <!-- Reading Time -->
    <div class="chapter-reading-time"><?= $read_time ?></div>

    <?php if (!empty($chapter['image'])): ?>
    <!-- Featured Image -->
    <div class="chapter-featured-image">
        <img src="/assets/images/<?= htmlspecialchars($chapter['image']) ?>"
             alt="<?= htmlspecialchars('Chapter ' . $chapter['number'] . ': ' . $chapter['title']) ?>"
             width="720"
             height="450"
             loading="eager">
    </div>
    <?php endif; ?>

    <!-- Chapter Content -->
    <article class="chapter-content">
        <?php
        if ($content_html) {
            echo $content_html;
        } else {
            echo '<p><em>Chapter content coming soon.</em></p>';
        }
        ?>
    </article>

    <!-- Chapter Navigation -->
    <nav class="chapter-nav" aria-label="Chapter navigation">
        <?php if ($adjacent['prev']): ?>
        <a href="/<?= htmlspecialchars($adjacent['prev']['slug']) ?>/" class="chapter-nav-link prev">
            <span class="chapter-nav-label"><span class="arrow">←</span> Previous Chapter</span>
            <span class="chapter-nav-title"><?= htmlspecialchars($adjacent['prev']['title']) ?></span>
        </a>
        <?php else: ?>
        <div class="chapter-nav-spacer"></div>
        <?php endif; ?>

        <?php if ($adjacent['next']): ?>
        <a href="/<?= htmlspecialchars($adjacent['next']['slug']) ?>/" class="chapter-nav-link next">
            <span class="chapter-nav-label">Next Chapter <span class="arrow">→</span></span>
            <span class="chapter-nav-title"><?= htmlspecialchars($adjacent['next']['title']) ?></span>
        </a>
        <?php else: ?>
        <div class="chapter-nav-spacer"></div>
        <?php endif; ?>
    </nav>

<?php require dirname(__DIR__) . '/inc/footer.php'; ?>
