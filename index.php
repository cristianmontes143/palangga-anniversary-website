
<?php
// ==========================================
// PERSONAL DETAILS
// ==========================================
$herName = "PALANGGA";
$anniversaryDate = "2026-11-18";
$futureAnniversaryDate = "2027-11-18";

// ==========================================
// TIMELINE MILESTONES
// EDIT THESE ENTRIES WITH YOUR OWN MEMORIES
// Use photo filenames from your photos/ folder.
// Set image to "" if you don't want a photo.
// ==========================================
$timeline = [
    [
        "date" => "August 20, 2024",
        "title" => "The beginning of our story",
        "description" => "Our first picture together and our first semi-BBQ date — a sweet little memory I’ll always cherish. ❤️🥰",
        "image" => "pic1.png"
    ],
    [
        "date" => "November 18, 2025",
        "title" => "1st Annivesary",
        "description" => "Our first anniversary, filled with simple yet unforgettable memories and a love that makes every moment special. Here’s to many more years together! ❤️🥹",
        "image" => "pic2.jpg"
    ],
    [
        "date" => "November 18, 2026",
        "title" => "Another chapter together",
        "description" => "Add a special memory that made your relationship stronger.",
        "image" => ""
    ]
];

// ==========================================
// AUTOMATICALLY LOAD 45 PHOTOS
// ==========================================
$photos = [];

for ($i = 1; $i <= 45; $i++) {
    $file = "photo{$i}.jpg";

    if (is_file(__DIR__ . "/photos/" . $file)) {
        $photos[] = [
            "file" => $file,
            "caption" => "Our beautiful memory #{$i}"
        ];
    }
}

// Safely escape HTML
function e(string $value): string {
    return htmlspecialchars($value, ENT_QUOTES, "UTF-8");
}

// Validate timeline image filenames
function timelineImage(string $filename): string {
    $filename = basename($filename);

    if (
        $filename !== "" &&
        is_file(__DIR__ . "/photos/" . $filename)
    ) {
        return "photos/" . $filename;
    }

    return "";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#fff4f7">
    <meta name="description" content="A little anniversary surprise made with love.">

    <title>For <?= e($herName) ?> — With All My Love</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&family=Sacramento&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <!-- FLOATING HEARTS -->
    <div class="ambient-hearts" aria-hidden="true">
        <span>♡</span>
        <span>♥</span>
        <span>♡</span>
        <span>♥</span>
        <span>♡</span>
        <span>♥</span>
    </div>

    <!-- HERO SECTION -->
    <header class="hero" id="home">
        <nav class="top-nav">
            <a class="brand" href="#home">
                a little something <span>♡</span>
            </a>

            <div class="nav-links">
                <a class="nav-link" href="#timeline">Our story</a>
                <a class="nav-link" href="#memories">Our memories</a>
            </div>
        </nav>

        <div class="hero-content">
            <p class="eyebrow">MADE WITH LOVE, JUST FOR YOU</p>

            <h1>For my <span><?= e($herName) ?></span></h1>

            <p class="hero-copy">
                A little corner of the internet, made to remind you how loved you are.
            </p>

            <a class="primary-button" href="#letter">
                Open your letter <span>♡</span>
            </a>

            <div class="date-note">
                <span class="tiny-heart">♥</span>
                <span>
                    Our special day ·
                    <?= date("F j, Y", strtotime($anniversaryDate)) ?>
                </span>
                <span class="tiny-heart">♥</span>
            </div>
        </div>

        <div class="hero-flower flower-one" aria-hidden="true">✿</div>
        <div class="hero-flower flower-two" aria-hidden="true">✿</div>
    </header>

    <main>

        <!-- ORIGINAL ANNIVERSARY COUNTDOWN -->
        <section class="anniversary-section top-anniversary">
            <div class="countdown-decoration decoration-left">♡</div>
            <div class="countdown-decoration decoration-right">♥</div>

            <div class="section-wrap anniversary-content">
                <p class="eyebrow">♡ A SPECIAL DAY FOR US ♡</p>

                <h2>Our Love Story</h2>

                <p class="anniversary-date">
                    <?= date("F j, Y", strtotime($anniversaryDate)) ?>
                </p>

                <div class="countdown-divider">
                    <span></span>
                    ♥
                    <span></span>
                </div>

                <p id="anniversaryMessage" class="anniversary-message">
                    Counting down to our special day…
                </p>

                <div class="countdown" id="countdown" aria-live="polite">
                    <div class="countdown-box">
                        <strong id="days">--</strong>
                        <span>Days</span>
                    </div>

                    <div class="countdown-box">
                        <strong id="hours">--</strong>
                        <span>Hours</span>
                    </div>

                    <div class="countdown-box">
                        <strong id="minutes">--</strong>
                        <span>Minutes</span>
                    </div>

                    <div class="countdown-box">
                        <strong id="seconds">--</strong>
                        <span>Seconds</span>
                    </div>
                </div>

                <p class="countdown-love">
                    Every second brings me closer to another beautiful memory with you.
                </p>
            </div>
        </section>

        <!-- NEXT ANNIVERSARY COUNTDOWN -->
        <section class="next-anniversary-section section-wrap" id="nextAnniversary">
            <div class="next-anniversary-card">
                <p class="eyebrow">♡ OUR FOREVER JOURNEY ♡</p>

                <h2>Our Next Chapter</h2>

                <p class="next-anniversary-subtitle">
                    Another year, another beautiful chapter with you, palangga.
                </p>

                <button
                    type="button"
                    class="next-anniversary-button"
                    id="showNextAnniversary"
                    aria-expanded="false"
                    aria-controls="nextCountdownContainer"
                >
                    Count Down to Our Next Anniversary ♡
                </button>

                <div class="next-countdown-container" id="nextCountdownContainer" hidden>
                    <p class="next-anniversary-date" id="nextAnniversaryDate">
                        November 18, 2027
                    </p>

                    <div class="next-countdown">
                        <div class="next-countdown-box">
                            <strong id="nextDays">00</strong>
                            <span>Days</span>
                        </div>

                        <div class="next-countdown-box">
                            <strong id="nextHours">00</strong>
                            <span>Hours</span>
                        </div>

                        <div class="next-countdown-box">
                            <strong id="nextMinutes">00</strong>
                            <span>Minutes</span>
                        </div>

                        <div class="next-countdown-box">
                            <strong id="nextSeconds">00</strong>
                            <span>Seconds</span>
                        </div>
                    </div>

                    <p class="next-anniversary-message">
                        No matter how many years pass, ikaw gihapon akong pilion.
                        Here's to forever with you! ❤️
                    </p>
                </div>
            </div>
        </section>

        <!-- LOVE LETTER SECTION -->
        <section class="letter-section section-wrap" id="letter">
            <div class="section-heading">
                <p class="eyebrow">A MESSAGE FROM MY HEART</p>
                <h2>Something I want you to know</h2>
                <p class="section-subtitle">
                    Take your time, my love. This is for you.
                </p>
            </div>

            <div class="envelope-area">
                <div class="envelope" id="envelope">
                    <div class="envelope-back"></div>

                    <div class="letter-paper">
                        <div class="letter-inner">
                            <p class="script greeting">
                                My dearest <?= e($herName) ?>,
                            </p>

                            <p>
                                <strong>Hi, Palangga! Happy 2nd Anniversary! ❤️</strong>
                            </p>

                            <p>
                                You know na, palangga, I may not always find the perfect words
                                to explain how much you mean to me, but I hope you never doubt
                                how special you are in my life. You make my ordinary days brighter,
                                and even the simplest moments become memories nga gusto nako
                                i-keep forever. You are the love of my life, baby. Atoa ni
                                padayunon hangtod sa hangtod, okay? No matter what happens,
                                I hope it's always you and me.
                            </p>

                            <p>
                                Thank you for your love, sa pag-care, sa pag-amping nako always,
                                and for supporting me in everything. Thank you for your patience,
                                your laughter, and for always being someone nga akong masaligan.
                                Grateful kaayo ko nga naa ka sa akong kinabuhi. Thank you for
                                staying by my side, especially during my difficult times,
                                sa pag-support sa akoa bisan naa koy mga problema. You make me
                                feel loved, supported, and understood, and because of that,
                                mas nisamot pa akong paghigugma nimo.
                            </p>

                            <p>
                                We've had happy moments, silly moments, and even times nga
                                nag-away ta or wala nagkasinabot. But I believe those challenges
                                made our relationship stronger. Every problem taught us something,
                                helped us understand each other better, and reminded us nga love
                                isn't always about having perfect days. It's about choosing each
                                other even when things get difficult.
                            </p>

                            <p>
                                I don't promise nga every day will be perfect, but I promise
                                nga ikaw akong pilion always. I promise to listen to you,
                                understand you, grow with you, and love you with all my heart.
                                I hope we continue making beautiful memories together and building
                                a future filled with kindness, laughter, happiness, and endless love.
                            </p>

                            <p>
                                <strong>
                                    I love you so much, palangga. Happy 2nd Anniversary, baby! ❤️
                                </strong>
                                Two years down, and hopefully, forever to go.
                                Ikaw gihapon, ikaw ra gihapon, hangtod sa hangtod. ❤️
                            </p>

                            <p class="script signature">Forever yours, ♡</p>
                        </div>
                    </div>

                    <div class="envelope-front"></div>
                    <div class="envelope-flap"></div>
                    <div class="envelope-seal">♥</div>
                </div>

                <div class="envelope-buttons">
                    <button
                        class="open-letter-button"
                        id="openLetter"
                        type="button"
                        aria-controls="envelope"
                        aria-expanded="false"
                    >
                        Open my letter ♡
                    </button>

                    <button
                        class="open-letter-button"
                        id="closeLetter"
                        type="button"
                        aria-controls="envelope"
                        hidden
                    >
                        Close the envelope ♡
                    </button>
                </div>

                <p class="envelope-hint" id="envelopeHint">
                    A little surprise is waiting inside
                </p>
            </div>
        </section>

        <!-- FUTURE ANNIVERSARY LETTER -->
        <section
            class="future-letter-section section-wrap"
            id="futureLetter"
            data-unlock-date="<?= e($futureAnniversaryDate) ?>"
        >
            <div class="future-letter-card">
                <p class="eyebrow">♡ A MESSAGE FROM OUR FUTURE ♡</p>

                <h2>A Letter for Our 3rd Anniversary</h2>

                <p class="future-letter-intro">
                    I wrote something for you, my love. This little surprise
                    is waiting for our special day.
                </p>

                <!-- LOCKED CONTENT -->
                <div class="future-locked" id="futureLocked">
                    <div class="future-lock-icon" aria-hidden="true">♡</div>

                    <h3>Our future letter is still sealed</h3>

                    <p>
                        Come back on November 18, 2027, and open the message
                        I prepared for you.
                    </p>

                    <p class="future-unlock-date" id="futureUnlockDate">
                        November 18, 2027
                    </p>

                    <div class="future-countdown" aria-live="polite">
                        <div class="future-countdown-box">
                            <strong id="futureDays">--</strong>
                            <span>Days</span>
                        </div>
                        <div class="future-countdown-box">
                            <strong id="futureHours">--</strong>
                            <span>Hours</span>
                        </div>
                        <div class="future-countdown-box">
                            <strong id="futureMinutes">--</strong>
                            <span>Minutes</span>
                        </div>
                        <div class="future-countdown-box">
                            <strong id="futureSeconds">--</strong>
                            <span>Seconds</span>
                        </div>
                    </div>

                    <p class="future-lock-note">
                        A little patience, my love. Some surprises are worth waiting for. ❤️
                    </p>
                </div>

                <!-- UNLOCKED CONTENT -->
                <div class="future-unlocked" id="futureUnlocked" hidden>
                    <div class="future-unlocked-heart">♥</div>

                    <h3>Happy 3rd Anniversary, my love!</h3>

                    <p class="future-letter-greeting script">
                        My dearest <?= e($herName) ?>,
                    </p>

                    <!-- EDIT THIS LETTER WHEN YOU ARE READY -->
                    <div class="future-letter-message">
                        <p>
                            Happy 3rd Anniversary, palangga! ❤️
                        </p>

                        <p>
                            If you're reading this, another year has passed
                            and we're celebrating another beautiful chapter
                            of our love story.
                        </p>

                        <p>
                            Thank you for continuing this journey with me.
                            I hope we have grown, learned, laughed, and made
                            even more memories together.
                        </p>

                        <p>
                            I may not know everything our future holds,
                            but I hope we continue choosing each other,
                            supporting each other, and building a life
                            filled with love and happiness.
                        </p>

                        <p>
                            I love you so much, palangga.
                            Here's to our third year and to all the years
                            still waiting for us. ❤️
                        </p>
                    </div>

                    <p class="script future-letter-signature">
                        Forever yours, ♡
                    </p>
                </div>
            </div>
        </section>

        <!-- OUR LOVE STORY TIMELINE -->
        <section class="timeline-section section-wrap" id="timeline">
            <div class="section-heading">
                <p class="eyebrow">♡ EVERY MOMENT MATTERS ♡</p>
                <h2>Our Love Story Timeline</h2>
                <p class="section-subtitle">
                    Every chapter, every memory, and every moment that brought us here.
                </p>
            </div>

            <div class="timeline">
                <?php foreach ($timeline as $index => $item): ?>
                    <?php $imagePath = timelineImage($item["image"]); ?>

                    <article class="timeline-item">
                        <div class="timeline-marker" aria-hidden="true">
                            ♥
                        </div>

                        <div class="timeline-card">
                            <p class="timeline-date">
                                <?= e($item["date"]) ?>
                            </p>

                            <h3><?= e($item["title"]) ?></h3>

                            <p class="timeline-description">
                                <?= e($item["description"]) ?>
                            </p>

                            <?php if ($imagePath !== ""): ?>
                                <img
                                    class="timeline-image"
                                    src="<?= e($imagePath) ?>"
                                    alt="<?= e($item["title"]) ?>"
                                    loading="lazy"
                                >
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <p class="timeline-ending script">
                And our story is still being written… ♡
            </p>
        </section>

        <!-- OUR MEMORIES: 45 PHOTOS -->
        <section class="memories-section" id="memories">
            <div class="section-wrap">
                <div class="section-heading">
                    <p class="eyebrow">LITTLE MOMENTS, BIG LOVE</p>
                    <h2>Our memories</h2>
                    <p class="section-subtitle">
                        Every picture holds a moment I'm thankful for.
                    </p>
                </div>

                <div class="photo-grid">
                    <?php if (count($photos) > 0): ?>
                        <?php foreach ($photos as $photo): ?>
                            <figure class="photo-card">
                                <button
                                    class="photo-open"
                                    type="button"
                                    aria-label="View <?= e($photo["caption"]) ?>"
                                >
                                    <img
                                        src="photos/<?= e($photo["file"]) ?>"
                                        alt="<?= e($photo["caption"]) ?>"
                                        loading="lazy"
                                    >
                                </button>

                                <figcaption>
                                    <?= e($photo["caption"]) ?>
                                </figcaption>
                            </figure>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="photo-placeholder">
                            <span class="placeholder-heart">♡</span>
                            <strong>Your photos will appear here</strong>
                            <small>
                                Add photo1.jpg through photo45.jpg to the photos folder.
                            </small>
                        </div>
                    <?php endif; ?>
                </div>

                <p class="photo-tip">
                    45 little memories, one beautiful love story. ❤️
                </p>
            </div>
        </section>

        <!-- PROMISE SECTION -->
        <section class="promise-section section-wrap">
            <div class="promise-card">
                <span class="big-heart">♡</span>
                <p class="eyebrow">ONE THING I'LL ALWAYS MEAN</p>

                <h2>
                    I would choose you<br>
                    <em>again and again.</em>
                </h2>

                <p>
                    No matter how many pages life turns,
                    I hope I get to write the next chapters with you.
                </p>

                <span class="script promise-signoff">
                    I love you, <?= e($herName) ?>.
                </span>
            </div>
        </section>

    </main>

    <!-- FOOTER -->
    <footer class="footer">
        <p>
            Made with all my love, just for <?= e($herName) ?>
            <span>♥</span>
        </p>

        <a href="#home">Back to the top ↑</a>
    </footer>

    <!-- PHOTO LIGHTBOX -->
    <div
        class="lightbox"
        id="lightbox"
        role="dialog"
        aria-modal="true"
        aria-label="Photo preview"
        hidden
    >
        <button
            class="lightbox-close"
            id="lightboxClose"
            type="button"
            aria-label="Close photo preview"
        >
            ×
        </button>

        <img id="lightboxImage" src="" alt="">
    </div>

    <!-- JAVASCRIPT SETTINGS -->
    <script>
        window.ANNIVERSARY_DATE = <?= json_encode($anniversaryDate) ?>;
        window.FUTURE_ANNIVERSARY_DATE = <?= json_encode($futureAnniversaryDate) ?>;
    </script>

    <script src="assets/js/script.js"></script>

</body>
</html>
