<?php
/**
 * Dynamic XML Sitemap for Metalstar
 * Generates sitemap from chapter-data.php
 */
header('Content-Type: application/xml; charset=UTF-8');

require __DIR__ . '/inc/chapter-data.php';

$baseUrl = 'https://metalstar.us';
$today = date('Y-m-d');

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?= $baseUrl ?>/</loc>
        <lastmod><?= $today ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc><?= $baseUrl ?>/about/</loc>
        <lastmod><?= $today ?></lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc><?= $baseUrl ?>/summary/</loc>
        <lastmod><?= $today ?></lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc><?= $baseUrl ?>/prologue/</loc>
        <lastmod><?= $today ?></lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
<?php foreach ($chapters as $ch): ?>
    <url>
        <loc><?= $baseUrl ?>/<?= htmlspecialchars($ch['slug']) ?>/</loc>
        <lastmod><?= $today ?></lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.9</priority>
    </url>
<?php endforeach; ?>
</urlset>
