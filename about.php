<?php
$page_title       = 'About | Metalstar';
$page_description = 'Learn about Aaron Hill and the story behind Metalstar, a science fiction saga decades in the making.';
$page_keywords    = 'Metalstar, Aaron Hill, about, science fiction, author';
$page_url         = 'https://metalstar.us/about/';
$canonical_url    = 'https://metalstar.us/about/';
$body_class       = 'page-inner';
$extra_css        = 'pages.css';

require __DIR__ . '/inc/header.php';
?>

    <div class="page-header">
        <p class="page-read-time">~ 2 MIN READ</p>
        <h1 class="page-title">ABOUT</h1>
    </div>

    <div class="page-content">
        <div class="about-layout">
            <div class="about-text">
                <h2>Aaron Hill</h2>
                <p>Hi! My name is Aaron and I have been working on Metalstar for many years now. It began in 1989 as a comic book, the idea for which came to me in a dream (as many ideas do). In the years that progressed I lost my original drawings and manuscripts when the apartment in which I lived flooded. I was able to rescue a few and put them in storage until my life slowed down enough for me to continue writing. Once again, while in storage, the remaining manuscripts and artwork were destroyed in a flood. Crestfallen and under the belief that the universe was against me, I stopped working on it for over a decade.</p>
                <p>Haunted by the dream and fueled by the desire to continue writing, I took back up the pen and started working. This time, I have been able to keep everything on a computer. In 2009 I started writing Metalstar as my status updates on Facebook and then created a page that I updated frequently. It has been my passion and my dream to complete the story and publish it one day. I have not given myself a timetable or date for completion, which annoys some of my readers on Facebook; however I have forced myself to try to write more often and in greater length in order to finish it sooner.</p>
                <p>Metalstar is a science fiction story based on a dystopian future world in which aliens have invaded the planet and set designs on reengineering the Earth to be a more suitable environment for their kind. Several characters from different walks of life have joined forces to overcome the alien invasion and through the use of the Metal Stars fight back to regain control of the nearly desolate Earth inhabited by sporadic underground colonies situated between vast desert-like voids.</p>
            </div>
            <div class="about-image">
                <img src="/assets/images/Aaron-Hill.png" alt="Aaron Hill">
            </div>
        </div>

        <p>It is a saga of the year 2134 and beyond. John, Jayk and Sarah live out the story of the Metal Stars, powerful devices capable of transforming sound into energy, through the retelling of their adventure by an unknown narrator. Each new post is another chapter in the continuing saga of Metalstar as it develops.</p>

        <p class="about-cta">Have a question about the story? Want to share a thought? Drop a line.</p>

        <form class="contact-form" id="contactForm">
            <input type="text" name="name" placeholder="Your name" required>
            <input type="email" name="email" placeholder="Your email" required>
            <textarea name="message" placeholder="Your message" rows="6" required></textarea>
            <button type="submit" class="btn-send">Send</button>
        </form>
    </div>

<?php
$schema_blocks = [[
    '@context' => 'https://schema.org',
    '@type'    => 'AboutPage',
    'name'     => 'About Metalstar',
    'url'      => 'https://metalstar.us/about/',
    'author'   => ['@type' => 'Person', 'name' => 'Aaron Hill'],
]];
require __DIR__ . '/inc/footer.php';
?>
