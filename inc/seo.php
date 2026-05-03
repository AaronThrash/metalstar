<?php
/**
 * SEO and Schema Markup Output — Metalstar Custom Site
 *
 * Ported from WordPress version. Single source of truth for all JSON-LD schema.
 * Generates Organization, Person/Author, Book, CreativeWorkSeries, WebSite,
 * WebPage, Chapter (with ReadAction + citation + Quotation), ItemList, BreadcrumbList.
 *
 * Expects these variables set before include:
 *   $page_title       - string
 *   $page_description - string
 *   $page_keywords    - string
 *   $page_url         - string (full URL)
 *   $page_image       - string (path or full URL)
 *   $page_type        - string: 'home', 'chapter', 'page'
 *   $chapters         - array from chapter-data.php
 *
 * For chapters additionally:
 *   $chapter           - array (single chapter from $chapters)
 *   $chapter_num       - int (chapter key)
 *   $content_html      - string (chapter body HTML)
 *
 * @package metalstar
 * @version 3.0.0
 * @updated 2026-02-25
 */

// Resolve image URL
$schema_image = $page_image ?? '/assets/images/metalstar-og.webp';
if (strpos($schema_image, 'http') !== 0) {
    $schema_image = 'https://metalstar.us' . $schema_image;
}

$schemas = [];

// =========================================================================
// 1. ORGANIZATION (Global — every page)
// =========================================================================
$schemas[] = [
    '@context'    => 'https://schema.org',
    '@type'       => 'Organization',
    'additionalType' => [
        'https://en.wikipedia.org/wiki/Independent_publishing',
    ],
    '@id'         => 'https://metalstar.us/#organization',
    'name'        => 'Metalstar',
    'url'         => 'https://metalstar.us/',
    'description' => 'Metalstar is an epic science fiction graphic novel and prose series by Aaron Hill, 37 years in the making. Set in a post-apocalyptic world where humanity struggles to survive alien invasion, it weaves mythology, religion, and the hero\'s journey into a lyrical dirge for a civilization lost.',
    'foundingDate'=> '1989',
    'founder'     => [
        '@type' => 'Person',
        '@id'   => 'https://metalstar.us/#author',
        'name'  => 'Aaron Hill',
    ],
    'logo'        => [
        '@type' => 'ImageObject',
        'url'   => 'https://metalstar.us/assets/images/Metalstar-Vectorr.png',
    ],
    'sameAs'      => [],
];

// =========================================================================
// 2. AUTHOR (Global — every page)
// =========================================================================
$schemas[] = [
    '@context'    => 'https://schema.org',
    '@type'       => 'Person',
    'additionalType' => [
        'https://en.wikipedia.org/wiki/Novelist',
        'https://en.wikipedia.org/wiki/Graphic_novel',
    ],
    '@id'         => 'https://metalstar.us/#author',
    'name'        => 'Aaron Hill',
    'url'         => 'https://metalstar.us/',
    'description' => 'Author and artist behind Metalstar, a science fiction graphic novel and prose series begun in 1989. A lifelong fan of comics, mythology, and digital artwork.',
    'knowsAbout'  => [
        'Science Fiction',
        'Graphic Novels',
        'Mythology',
        'Joseph Campbell',
        'Hero\'s Journey',
        'Digital Art',
        'World Building',
        'Post-Apocalyptic Fiction',
    ],
];

// =========================================================================
// 3. BOOK (Global — the core creative work)
// =========================================================================
$schemas[] = [
    '@context'      => 'https://schema.org',
    '@type'         => 'Book',
    'additionalType' => [
        'https://en.wikipedia.org/wiki/Science_fiction',
        'https://en.wikipedia.org/wiki/Post-apocalyptic_fiction',
        'https://en.wikipedia.org/wiki/Cymatics',
        'https://en.wikipedia.org/wiki/Hero%27s_journey',
        'https://en.wikipedia.org/wiki/Graphic_novel',
        'https://en.wikipedia.org/wiki/Clone_(genetics)',
    ],
    '@id'           => 'https://metalstar.us/#book',
    'name'          => 'Metalstar',
    'alternateName' => 'Metalstar: An Epic Sci-fi Mythology',
    'author'        => [ '@id' => 'https://metalstar.us/#author' ],
    'publisher'     => [ '@id' => 'https://metalstar.us/#organization' ],
    'url'           => 'https://metalstar.us/',
    'genre'         => [
        'Science Fiction',
        'Post-Apocalyptic',
        'Graphic Novel',
        'Epic Fantasy',
    ],
    'inLanguage'    => 'en',
    'description'   => 'In a world ravaged by alien invasion and terraforming, three unlikely heroes, a wanderer with no memory, a clone with a dead woman\'s past, and a Marine from a forgotten era, must unite to reclaim humanity\'s future. Metalstar is an epic science fiction saga that weaves post-apocalyptic survival with mythology, religion, music, and the timeless structure of the hero\'s journey.',
    'keywords'      => 'metalstar, science fiction, graphic novel, post-apocalyptic, alien invasion, clone, hero journey, mythology, Joseph Campbell, prose novel, Aaron Hill',
    'copyrightYear' => 1989,
    'copyrightHolder' => [ '@id' => 'https://metalstar.us/#author' ],
    'dateCreated'   => '1989',
    'about'         => [
        'Alien invasion and human resistance',
        'Identity and memory',
        'The hero\'s journey',
        'Religion and power',
        'Music as a metaphor for lost civilization',
        'Cloning and consciousness',
        'Mythology and animism',
    ],
    'isSimilarTo'   => [
        [
            '@type' => 'Book',
            'name'  => 'The Road',
            'author' => [ '@type' => 'Person', 'name' => 'Cormac McCarthy' ],
        ],
        [
            '@type' => 'Book',
            'name'  => 'Children of Men',
            'author' => [ '@type' => 'Person', 'name' => 'P.D. James' ],
        ],
        [
            '@type' => 'Book',
            'name'  => 'Station Eleven',
            'author' => [ '@type' => 'Person', 'name' => 'Emily St. John Mandel' ],
        ],
        [
            '@type' => 'Book',
            'name'  => 'Annihilation',
            'author' => [ '@type' => 'Person', 'name' => 'Jeff VanderMeer' ],
        ],
        [
            '@type' => 'Book',
            'name'  => 'Wool',
            'alternateName' => 'Silo',
            'author' => [ '@type' => 'Person', 'name' => 'Hugh Howey' ],
        ],
    ],
];

// =========================================================================
// 4. CREATIVE WORK SERIES (Global — defines reading order)
// =========================================================================
$series_episodes = [];
foreach ($chapters as $pos => $ch) {
    $episode = [
        '@type'      => 'Episode',
        'name'       => 'Chapter ' . $ch['number'] . ': ' . $ch['title'],
        'url'        => 'https://metalstar.us/' . $ch['slug'] . '/',
        'position'   => $pos,
        'partOfSeries' => [ '@id' => 'https://metalstar.us/#series' ],
    ];
    if (!empty($ch['description'])) {
        $episode['description'] = $ch['description'];
    }
    $series_episodes[] = $episode;
}

$schemas[] = [
    '@context'    => 'https://schema.org',
    '@type'       => 'CreativeWorkSeries',
    '@id'         => 'https://metalstar.us/#series',
    'name'        => 'Metalstar',
    'description' => 'An epic science fiction prose series by Aaron Hill. Read free online, chapter by chapter.',
    'author'      => [ '@id' => 'https://metalstar.us/#author' ],
    'publisher'   => [ '@id' => 'https://metalstar.us/#organization' ],
    'genre'       => [ 'Science Fiction', 'Post-Apocalyptic', 'Epic Fantasy' ],
    'inLanguage'  => 'en',
    'url'         => 'https://metalstar.us/',
    'isAccessibleForFree' => true,
    'hasPart'     => $series_episodes,
];

// =========================================================================
// 5. WEBSITE (Global — every page)
// =========================================================================
$schemas[] = [
    '@context'        => 'https://schema.org',
    '@type'           => 'WebSite',
    '@id'             => 'https://metalstar.us/#website',
    'url'             => 'https://metalstar.us/',
    'name'            => 'Metalstar | A Sci-Fi Novel by Aaron Hill',
    'description'     => 'Read Metalstar online: an epic science fiction graphic novel and prose series by Aaron Hill. New chapters published regularly.',
    'publisher'       => [ '@id' => 'https://metalstar.us/#organization' ],
];

// =========================================================================
// 6. PAGE-SPECIFIC SCHEMA
// =========================================================================

$page_type = $page_type ?? 'page';

if ($page_type === 'home') {
    // --- Homepage: ItemList of chapters ---
    $chapter_items = [];
    foreach ($chapters as $pos => $ch) {
        $chapter_items[] = [
            '@type'    => 'ListItem',
            'position' => $pos,
            'name'     => 'Chapter ' . $ch['number'] . ': ' . $ch['title'],
            'url'      => 'https://metalstar.us/' . $ch['slug'] . '/',
        ];
    }
    $schemas[] = [
        '@context'        => 'https://schema.org',
        '@type'           => 'ItemList',
        'name'            => 'Metalstar Chapters',
        'description'     => 'All published chapters of Metalstar by Aaron Hill — read free online',
        'itemListElement' => $chapter_items,
    ];

} elseif ($page_type === 'chapter' && isset($chapter)) {
    // --- Chapter page ---
    $word_count = str_word_count(strip_tags($content_html ?? ''));
    $today = date('c');

    // WebPage
    $schemas[] = [
        '@context'         => 'https://schema.org',
        '@type'            => 'WebPage',
        '@id'              => $page_url . '#webpage',
        'url'              => $page_url,
        'headline'         => $page_title,
        'name'             => $page_title,
        'description'      => $chapter['description'] ?? $page_description,
        'isPartOf'         => [ '@id' => 'https://metalstar.us/#website' ],
        'mainEntityOfPage' => $page_url,
        'keywords'         => $chapter['keywords'] ?? $page_keywords,
        'image'            => [ '@type' => 'ImageObject', 'url' => $schema_image ],
    ];

    // Chapter
    $chapter_schema = [
        '@context'         => 'https://schema.org',
        '@type'            => 'Chapter',
        '@id'              => $page_url . '#chapter',
        'name'             => $page_title,
        'headline'         => $page_title,
        'description'      => $chapter['description'] ?? $page_description,
        'url'              => $page_url,
        'isPartOf'         => [ '@id' => 'https://metalstar.us/#book' ],
        'author'           => [ '@id' => 'https://metalstar.us/#author' ],
        'wordCount'        => $word_count,
        'inLanguage'       => 'en',
        'isAccessibleForFree' => true,
        'position'         => $chapter_num,
        'partOfSeries'     => [
            '@type' => 'CreativeWorkSeries',
            '@id'   => 'https://metalstar.us/#series',
        ],
        'mainEntityOfPage' => [
            '@type' => 'WebPage',
            '@id'   => $page_url . '#webpage',
        ],
        'potentialAction'  => [
            '@type'   => 'ReadAction',
            'target'  => [
                '@type'       => 'EntryPoint',
                'urlTemplate' => $page_url,
            ],
            'expectsAcceptanceOf' => [
                '@type'         => 'Offer',
                'category'      => 'free',
                'availableAtOrFrom' => [
                    '@type' => 'WebSite',
                    '@id'   => 'https://metalstar.us/#website',
                ],
            ],
        ],
    ];

    if (!empty($chapter['keywords'])) {
        $chapter_schema['keywords'] = $chapter['keywords'];
    }
    if (!empty($chapter['image'])) {
        $chapter_schema['image'] = [
            '@type' => 'ImageObject',
            'url'   => 'https://metalstar.us/assets/images/' . $chapter['image'],
        ];
    }
    if (!empty($chapter['quote'])) {
        $chapter_schema['citation'] = $chapter['quote'];
    }

    $schemas[] = $chapter_schema;

    // Quotation schema (if quote exists)
    if (!empty($chapter['quote'])) {
        $quotation_schema = [
            '@context' => 'https://schema.org',
            '@type'    => 'Quotation',
            '@id'      => $page_url . '#epigraph',
            'text'     => $chapter['quote'],
            'isPartOf' => [ '@id' => $page_url . '#chapter' ],
        ];
        if (!empty($chapter['quote_author'])) {
            $quotation_schema['creator'] = [
                '@type' => 'Person',
                'name'  => $chapter['quote_author'],
            ];
        }
        $schemas[] = $quotation_schema;
    }

} else {
    // --- Regular page (About, Summary, Prologue) ---
    $schemas[] = [
        '@context'         => 'https://schema.org',
        '@type'            => 'WebPage',
        '@id'              => $page_url . '#webpage',
        'url'              => $page_url,
        'headline'         => $page_title,
        'name'             => $page_title,
        'description'      => $page_description,
        'isPartOf'         => [ '@id' => 'https://metalstar.us/#website' ],
        'mainEntityOfPage' => $page_url,
        'image'            => [ '@type' => 'ImageObject', 'url' => $schema_image ],
    ];
}

// =========================================================================
// 7. BREADCRUMBS (Inner pages)
// =========================================================================
if ($page_type !== 'home') {
    $breadcrumbs = [
        [
            '@type'    => 'ListItem',
            'position' => 1,
            'name'     => 'Home',
            'item'     => 'https://metalstar.us/',
        ],
        [
            '@type'    => 'ListItem',
            'position' => 2,
            'name'     => $page_title,
            'item'     => $page_url,
        ],
    ];

    $schemas[] = [
        '@context'        => 'https://schema.org',
        '@type'           => 'BreadcrumbList',
        'itemListElement' => $breadcrumbs,
    ];
}

// =========================================================================
// OUTPUT
// =========================================================================
echo "\n<script type=\"application/ld+json\">\n";
echo json_encode($schemas, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
echo "\n</script>\n";
