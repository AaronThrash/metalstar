<?php
if (!defined('METALSTAR')) { define('METALSTAR', true); }
require_once __DIR__ . '/chapter-data.php';

// Determine current page for meta
$page_title       = $page_title ?? 'Metalstar | A Post-apocalyptic Sci-Fi Mythology';
$page_description = $page_description ?? 'Set in the 24th century, Metalstar follows Sarah, a clone wielding a powerful electrostatic cannon, John, another clone, and Jayk, a survivor of the Dark Epoch, as they fight to reclaim Earth from alien invaders.';
$page_keywords    = $page_keywords ?? 'Metalstar, science fiction, graphic novel, post-apocalyptic, Aaron Hill';
$page_image       = $page_image ?? '/assets/images/metalstar-og.webp';
$page_url         = $page_url ?? 'https://metalstar.us/';
$canonical_url    = $canonical_url ?? $page_url;
$body_class       = $body_class ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($page_title) ?></title>
    <meta name="description" content="<?= htmlspecialchars($page_description) ?>">
    <meta name="keywords" content="<?= htmlspecialchars($page_keywords) ?>">
    <meta name="author" content="Aaron Hill">
    <link rel="canonical" href="<?= htmlspecialchars($canonical_url) ?>">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= htmlspecialchars($page_title) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($page_description) ?>">
    <meta property="og:image" content="<?= htmlspecialchars($page_image) ?>">
    <meta property="og:url" content="<?= htmlspecialchars($page_url) ?>">
    <meta property="og:site_name" content="Metalstar">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= htmlspecialchars($page_title) ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($page_description) ?>">
    <meta name="twitter:image" content="<?= htmlspecialchars($page_image) ?>">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400;1,600&family=Inter:wght@300;400;500;600&family=Montserrat:wght@800;900&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="/assets/css/main.css?v=<?= time() ?>">
    <?php if (!empty($extra_css)): ?>
    <link rel="stylesheet" href="/assets/css/<?= $extra_css ?>?v=<?= time() ?>">
    <?php endif; ?>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/assets/images/favicon.png">

    <!-- Microsoft Clarity -->
    <script type="text/javascript">
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "vi2kitwv8x");
    </script>

    <!-- Google Analytics (GA4) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-DEZ27DYZSS"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-DEZ27DYZSS');
    </script>
</head>
<body class="<?= htmlspecialchars($body_class) ?>">

    <!-- Navigation — hidden on homepage, hidden on chapter pages (desktop only) -->
    <?php if ($body_class !== 'page-home'): ?>
    <nav class="site-nav <?= $body_class === 'page-chapter' ? 'chapter-nav-mobile-only' : '' ?>" id="siteNav">
        <div class="nav-inner">
            <a href="/" class="nav-logo">
                <img src="/assets/images/Metalstar-Vectorr.png" alt="Metalstar" class="nav-logo-img">
            </a>
            <div class="nav-links" id="navLinks">
                <a href="/#chapters">Chapters</a>
                <a href="/about">About</a>
                <a href="/summary">Summary</a>
                <a href="/prologue">Prologue</a>
                <button class="dark-mode-toggle" id="darkModeToggle" aria-label="Toggle dark mode">
                    <span class="toggle-icon">◑</span>
                </button>
            </div>
            <button class="nav-hamburger" id="navHamburger" aria-label="Menu">
                <span></span><span></span><span></span>
            </button>
        </div>
    </nav>
    <?php endif; ?>

    <main class="<?= htmlspecialchars($body_class) ?>">
