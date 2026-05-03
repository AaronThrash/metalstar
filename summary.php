<?php
$page_title       = 'Summary | Metalstar';
$page_description = 'The premise and exegesis of Metalstar — a science fiction saga set in the 24th century about humanity\'s fight against alien invaders.';
$page_keywords    = 'Metalstar, summary, premise, exegesis, science fiction, Aaron Hill';
$page_url         = 'https://metalstar.us/summary/';
$canonical_url    = 'https://metalstar.us/summary/';
$body_class       = 'page-inner';
$extra_css        = 'pages.css';

require __DIR__ . '/inc/header.php';
?>

    <div class="page-header">
        <p class="page-read-time">~ 2 MIN READ</p>
        <h1 class="page-title">SUMMARY</h1>
    </div>

    <div class="page-content">
        <h2>Premise</h2>
        <p>Set in the 24th century, Metalstar follows Sarah, a clone who becomes the lone wielder of a powerful electrostatic cannon after losing her left arm to the Sky Reapers: deadly creatures reshaping Earth with gardens of alien vegetation.</p>
        <p>Joined by John, another clone, and Jayk, a survivor of the Dark Epoch, she is chosen to defend the planet when guardian aliens known as the Nephelum bestow on them the Metal Stars: extraordinary devices that tap zero-point energy, the vast power found in the space between atoms.</p>

        <div class="summary-image">
            <img src="/assets/images/Jayk-Flying-Sword-Attack.webp" alt="Jayk in a flying sword attack">
        </div>

        <h2>Exegesis</h2>
        <p>The aliens in Metalstar, as with many creatures of horror tales and Romantic literature, embody the id. They are projections of the collective unconscious and of humanity's fascination with its own capacity for dark wishes and deeds. Throughout mythology and fiction, monsters opposing humans are the most familiar way of dramatizing doubling: the two aspects of the same character, light and shadow. Science fiction inherits this tradition, often casting alien races in the role of the monster.</p>
        <p>Metalstar mirrors Promethean mythology. Prometheus stole fire from the gods and gave it to mortals, becoming the champion of humankind. In this story, however, the "gods" themselves offer the fire to humans in the form of the Metal Stars. The monsters, represented by the aliens, turn against their creators in a bid to aid their newfound counterparts, the humans, forming an alliance grounded in mutual suffering.</p>
        <p>It is always possible to reduce a work of literature to its basic psychic components. Often we send our monsters out to do the work that we, as writers, cannot perform ourselves. At a deeper level, their actions express the emotional intentions of the authors. In Metalstar, the aliens are a literal translation of those humans who seek to harm the planet and cannot find balance or harmony with nature; the great robber barons of history.</p>
        <p>In this configuration, the humans become the champions of the downtrodden and the masses. They represent the larger share of humanity: the disenfranchised, those who lack the power to effect real change. They call on the aid of "gods", beings stronger than themselves, to help restore the balance of power. Bearing more than a passing resemblance to the French Revolution, the story embodies patterns found throughout history whenever a stronger power seeks to dominate a weaker force.</p>
    </div>

<?php
$schema_blocks = [[
    '@context' => 'https://schema.org',
    '@type'    => 'WebPage',
    'name'     => 'Metalstar Summary',
    'url'      => 'https://metalstar.us/summary/',
    'author'   => ['@type' => 'Person', 'name' => 'Aaron Hill'],
]];
require __DIR__ . '/inc/footer.php';
?>
