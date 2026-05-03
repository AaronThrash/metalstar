<?php
/**
 * METALSTAR — 404 Page
 */
http_response_code(404);

$page_title       = '404 — Lost in the Wasteland | Metalstar';
$page_description = 'The page you\'re looking for doesn\'t exist.';
$page_url         = 'https://metalstar.us/404';
$canonical_url    = 'https://metalstar.us/';
$body_class       = 'page-error';

require __DIR__ . '/inc/header.php';
?>

    <div class="page-404">
        <h1>404</h1>
        <p>The wasteland stretches in every direction. There&rsquo;s nothing here.</p>
        <a href="/" class="btn">Return to base</a>
    </div>

<?php
$schema_blocks = [];
require __DIR__ . '/inc/footer.php';
?>
