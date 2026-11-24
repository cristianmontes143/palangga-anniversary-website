<?php
// ==========================================
// PERSONAL DETAILS
// ==========================================
$herName = "PALANGGA";
$anniversaryDate = "2026-11-18";
$futureAnniversaryDate = "2027-11-18";
$relationshipStartDate = "2024-11-18";

// ==========================================
// TIMELINE MILESTONES
// ==========================================
$timeline = [
    [
        "date" => "August 20, 2024",
        "title" => "The Beginning of Our Story",
        "description" => "Our first picture together and our first semi-BBQ date — a sweet little memory I’ll always cherish. ❤️🥰",
        "image" => "pic1.png"
    ],
    [
        "date" => "November 18, 2024",
        "title" => "Day One: Officially Together",
        "description" => "The day we chose each other, marking the official start of our beautiful forever journey.",
        "image" => ""
    ],
    [
        "date" => "November 18, 2025",
        "title" => "1st Anniversary",
        "description" => "Our first anniversary, filled with simple yet unforgettable memories and a love that makes every moment special. Here’s to many more years together! ❤️🥹",
        "image" => "pic2.jpg"
    ],
    [
        "date" => "November 18, 2026",
        "title" => "2nd Anniversary — Another Chapter Together",
        "description" => "Two years of growing, laughing, loving, and standing by each other through everything. I will always choose you, palangga! ❤️✨",
        "image" => ""
    ]
];

// ==========================================
// AUTOMATICALLY LOAD PHOTOS
// ==========================================
$photos = [];

for ($i = 1; $i <= 45; $i++) {
    $file = "photo{$i}.jpg";

    if (is_file(__DIR__ . "/photos/" . $file)) {
        $photos[] = [
            "id" => $i,
            "file" => $file,
            "caption" => "Our beautiful memory #{$i}"
        ];
    }
}

// ==========================================
// LOAD STORED LOVE LOCKS FROM SERVER
// ==========================================
$locksFile = __DIR__ . "/data/locks.json";
$serverLocks = [];

if (is_file($locksFile)) {
    $content = file_get_contents($locksFile);
    if ($content !== false) {
        $decoded = json_decode($content, true);
        if (is_array($decoded)) {
            $serverLocks = $decoded;
        }
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
<html lang="en" data-theme="daylight">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#fff4f7">
    <meta name="description" content="A romantic, interactive anniversary gift website made with all my love for PALANGGA.">

    <title>For <?= e($herName) ?> — With All My Heart & Soul ♡</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Dancing+Script:wght@600;700&family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,500&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Sacramento&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <!-- SCROLL PROGRESS BAR -->
    <div class="scroll-progress-container" aria-hidden="true">
        <div class="scroll-progress-bar" id="scrollProgressBar">
            <span class="scroll-heart">♥</span>
        </div>
    </div>

    <!-- AMBIENT PARTICLES CANVAS -->
    <canvas id="ambientCanvas" class="ambient-canvas" aria-hidden="true"></canvas>

    <!-- FLOATING BACKGROUND GLOW HEARTS -->
    <div class="ambient-hearts" aria-hidden="true">
        <span>♡</span>
        <span>♥</span>
        <span>♡</span>
        <span>♥</span>
        <span>♡</span>
        <span>♥</span>
        <span>♡</span>
        <span>♥</span>
    </div>

    <!-- STICKY TOP NAVIGATION -->
    <nav class="top-nav" id="mainNav">
        <div class="nav-inner">
            <a class="brand" href="#home">
                <span class="brand-heart">♥</span> Our Little Forever
            </a>

            <div class="nav-controls-mobile">
                <button
                    class="theme-toggle-btn"
                    id="themeToggleBtnMobile"
                    type="button"
                    title="Toggle Candlelight Night Mode"
                    aria-label="Toggle Candlelight Night Mode"
                >
                    <span class="theme-icon">✨</span>
                </button>
                <button
                    class="menu-toggle"
                    id="menuToggle"
                    type="button"
                    aria-label="Open navigation menu"
                    aria-expanded="false"
                    aria-controls="navMenu"
                >
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>

            <div class="nav-menu" id="navMenu">
                <a class="nav-link" href="#home">Home</a>
                <a class="nav-link" href="#counter">Our Story</a>
                <a class="nav-link" href="#letter">Love Letter</a>
                <a class="nav-link" href="#openWhen">Open When...</a>
                <a class="nav-link" href="#loveJar">Love Jar</a>
                <a class="nav-link" href="#timeline">Timeline</a>
                <a class="nav-link" href="#memories">Memories</a>
                <a class="nav-link" href="#quiz">Our Quiz</a>
                <a class="nav-link" href="#loveLock">Love Lock</a>
                <a class="nav-special" href="#futureLetter">Our Future ♡</a>

                <div class="nav-actions-desktop">
                    <button
                        class="theme-toggle-btn"
                        id="themeToggleBtn"
                        type="button"
                        title="Toggle Candlelight Starlight Mode"
                        aria-label="Toggle Candlelight Starlight Mode"
                    >
                        <span class="theme-icon">🌙</span>
                        <span class="theme-label">Candlelight</span>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <header class="hero" id="home">
        <div class="hero-decorative-elements" aria-hidden="true">
            <div class="hero-flower flower-one">✿</div>
            <div class="hero-flower flower-two">✿</div>
            <div class="hero-sparkle sparkle-one">✨</div>
            <div class="hero-sparkle sparkle-two">✨</div>
            <div class="hero-sparkle sparkle-three">💖</div>
        </div>

        <div class="hero-content">
            <div class="hero-badge">
                <span class="badge-icon">♥</span>
                <span class="badge-text">MADE WITH ALL MY LOVE, JUST FOR YOU</span>
                <span class="badge-icon">♥</span>
            </div>

            <h1 class="hero-title">
                For my one &amp; only<br>
                <span class="her-name-highlight"><?= e($herName) ?></span>
            </h1>

            <p class="hero-copy">
                A little corner of the internet, dedicated entirely to us — to celebrate every smile,
                every sweet hug, every memory, and every single second I get to spend loving you.
            </p>

            <div class="hero-buttons">
                <a class="primary-button hero-btn" href="#letter">
                    Open Your Love Letter <span>💌</span>
                </a>
                <button type="button" class="secondary-button hero-btn" id="heroPlayMusicBtn">
                    <span class="btn-music-icon">🎵</span> Play Our Song
                </button>
                <a class="tertiary-button hero-btn" href="#memories">
                    View Memories <span>📸</span>
                </a>
            </div>

            <div class="hero-quick-stats">
                <div class="stat-pill">
                    <span class="stat-icon">🗓️</span>
                    <span class="stat-label">Together Since:</span>
                    <strong>Nov 18, 2024</strong>
                </div>
                <div class="stat-pill">
                    <span class="stat-icon">⏳</span>
                    <span class="stat-label">Time Loved:</span>
                    <strong id="heroDaysPill">-- Days</strong>
                </div>
                <div class="stat-pill">
                    <span class="stat-icon">♾️</span>
                    <span class="stat-label">Promise:</span>
                    <strong>Hangtod sa Hangtod</strong>
                </div>
            </div>

            <div class="scroll-cue">
                <span class="scroll-cue-text">Scroll to explore our love story</span>
                <span class="scroll-cue-arrow">↓</span>
            </div>
        </div>
    </header>

    <main>

        <!-- OUR LOVE COUNTER -->
        <section class="anniversary-section top-anniversary" id="counter">
            <div class="countdown-decoration decoration-left" aria-hidden="true">♡</div>
            <div class="countdown-decoration decoration-right" aria-hidden="true">♥</div>

            <div class="section-wrap anniversary-content">
                <p class="eyebrow">♡ EVERY SECOND WITH YOU IS A TREASURE ♡</p>

                <h2>Our Journey So Far</h2>

                <p class="anniversary-date">
                    Loving you since November 18, 2024
                </p>

                <div class="countdown-divider" aria-hidden="true">
                    <span></span>
                    ♥
                    <span></span>
                </div>

                <p id="anniversaryMessage" class="anniversary-message">
                    Every beat of my heart belongs to you, palangga...
                </p>

                <div class="countdown" id="countdown" aria-live="off">
                    <div class="countdown-box">
                        <strong id="days">0</strong>
                        <span>Days Together</span>
                    </div>

                    <div class="countdown-box">
                        <strong id="hours">0</strong>
                        <span>Hours</span>
                    </div>

                    <div class="countdown-box">
                        <strong id="minutes">0</strong>
                        <span>Minutes</span>
                    </div>

                    <div class="countdown-box">
                        <strong id="seconds">0</strong>
                        <span>Seconds</span>
                    </div>
                </div>

                <div class="love-milestone-badges">
                    <div class="milestone-badge">
                        <span class="badge-num" id="milestoneWeeks">--</span>
                        <span class="badge-desc">Weeks of Smiles</span>
                    </div>
                    <div class="milestone-badge">
                        <span class="badge-num" id="milestoneHours">--</span>
                        <span class="badge-desc">Hours of Loving You</span>
                    </div>
                    <div class="milestone-badge">
                        <span class="badge-num">1</span>
                        <span class="badge-desc">Only Choice: You</span>
                    </div>
                </div>

                <p class="countdown-love">
                    And still counting... Every sunrise, every midnight, every quiet breath,
                    I will always choose you. I love you endlessly, PALANGGA! ♡
                </p>
            </div>
        </section>

        <!-- INTERACTIVE OPEN WHEN... LETTERS -->
        <section class="open-when-section section-wrap" id="openWhen">
            <div class="section-heading">
                <p class="eyebrow">♡ SPECIAL LETTERS FOR EVERY MOOD ♡</p>
                <h2>"Open When..." Envelopes</h2>
                <p class="section-subtitle">
                    Whenever you feel a certain way, tap the matching envelope. I wrote these specifically for your heart.
                </p>
            </div>

            <div class="open-when-grid">
                <!-- Card 1 -->
                <div class="open-when-card" data-letter="miss-me">
                    <div class="ow-envelope-icon">💌</div>
                    <span class="ow-tag">Comfort</span>
                    <h3>Open when you miss me</h3>
                    <p>When the distance feels a little too heavy and you just want my hug.</p>
                    <button type="button" class="ow-open-btn">Unseal Letter ♡</button>
                </div>

                <!-- Card 2 -->
                <div class="open-when-card" data-letter="bad-day">
                    <div class="ow-envelope-icon">🌸</div>
                    <span class="ow-tag">Safe Space</span>
                    <h3>Open when you're stressed or tired</h3>
                    <p>For the days when the world is exhausting and you need reminding how strong you are.</p>
                    <button type="button" class="ow-open-btn">Unseal Letter ♡</button>
                </div>

                <!-- Card 3 -->
                <div class="open-when-card" data-letter="laugh">
                    <div class="ow-envelope-icon">✨</div>
                    <span class="ow-tag">Smile Booster</span>
                    <h3>Open when you need a smile</h3>
                    <p>A little dose of joy, silly memories, and reasons you make my world light up.</p>
                    <button type="button" class="ow-open-btn">Unseal Letter ♡</button>
                </div>

                <!-- Card 4 -->
                <div class="open-when-card" data-letter="doubt">
                    <div class="ow-envelope-icon">💖</div>
                    <span class="ow-tag">Forever True</span>
                    <h3>Open when you doubt my love</h3>
                    <p>When you feel insecure or overthinking. A reminder that you are my only one.</p>
                    <button type="button" class="ow-open-btn">Unseal Letter ♡</button>
                </div>
            </div>
        </section>

        <!-- LOVE LETTER SECTION -->
        <section class="letter-section section-wrap" id="letter">
            <div class="section-heading">
                <p class="eyebrow">A MESSAGE FROM MY HEART</p>
                <h2>Something I want you to always remember</h2>
                <p class="section-subtitle">
                    Take your time, my love. Tap the wax seal to open.
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
                                <strong>Hi, Palangga! Happy Anniversary! ❤️</strong>
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
                                    I love you so much, palangga. Happy Anniversary, baby! ❤️
                                </strong>
                                Here's to forever with you.
                                Ikaw gihapon, ikaw ra gihapon, hangtod sa hangtod. ❤️
                            </p>

                            <p class="script signature">Forever yours, ♡</p>
                        </div>
                    </div>

                    <div class="envelope-front"></div>
                    <div class="envelope-flap"></div>
                    <div class="envelope-seal" id="envelopeSeal">♥</div>
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
                    Tap the glowing seal or button to open
                </p>
            </div>
        </section>

        <!-- REASONS WHY I LOVE YOU JAR -->
        <section class="love-jar-section section-wrap" id="loveJar">
            <div class="section-heading">
                <p class="eyebrow">♡ LITTLE REASONS, INFINITE LOVE ♡</p>
                <h2>"Why I Love You" Jar</h2>
                <p class="section-subtitle">
                    There are a million reasons why my heart chose you. Tap the jar or the button to draw a sweet reason!
                </p>
            </div>

            <div class="love-jar-container">
                <div class="love-jar-interactive" id="jarElement" role="button" tabindex="0" aria-label="Tap to draw a love note">
                    <div class="jar-lid"></div>
                    <div class="jar-neck">
                        <div class="jar-ribbon">🎀</div>
                    </div>
                    <div class="jar-glass">
                        <div class="jar-hearts-inside" aria-hidden="true">
                            <span class="j-heart j-h1">💖</span>
                            <span class="j-heart j-h2">💕</span>
                            <span class="j-heart j-h3">💘</span>
                            <span class="j-heart j-h4">💓</span>
                            <span class="j-heart j-h5">💗</span>
                            <span class="j-heart j-h6">💝</span>
                        </div>
                        <div class="jar-glow"></div>
                        <div class="jar-label">
                            <span>PALANGGA</span>
                            <small>Love Notes</small>
                        </div>
                    </div>
                </div>

                <div class="love-jar-card-display">
                    <div class="love-note-card" id="loveNoteCard">
                        <div class="note-pin">📌</div>
                        <span class="note-number" id="noteNumber">Reason #1</span>
                        <p class="note-text" id="noteText">
                            "The way your smile instantly melts away all the tiredness in my day. You are my peaceful sanctuary. ❤️"
                        </p>
                        <div class="note-tags">
                            <span class="note-heart-icon">♥</span>
                            <span id="noteCategory">My Heart's Favorite</span>
                        </div>
                    </div>

                    <div class="jar-controls">
                        <button type="button" class="primary-button jar-draw-btn" id="drawReasonBtn">
                            Draw Another Reason <span>✨</span>
                        </button>
                        <p class="jar-counter-text" id="jarCounterText">
                            Discovered 1 of 30 sweet reasons ♡
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- INTERACTIVE COUPLE QUIZ -->
        <section class="quiz-section section-wrap" id="quiz">
            <div class="section-heading">
                <p class="eyebrow">♡ A PLAYFUL MOMENT FOR US ♡</p>
                <h2>The Palangga Love Quiz</h2>
                <p class="section-subtitle">
                    How well do you know our little memories and funny quirks? Answer these 5 sweet questions!
                </p>
            </div>

            <div class="quiz-card" id="quizContainer">
                <div class="quiz-progress-bar-wrap">
                    <div class="quiz-progress-fill" id="quizProgressFill" style="width: 20%;"></div>
                </div>

                <div class="quiz-content" id="quizContent">
                    <span class="quiz-q-num" id="quizQNum">Question 1 of 5</span>
                    <h3 class="quiz-question" id="quizQuestion">
                        Where did our very first semi-date take place?
                    </h3>

                    <div class="quiz-options" id="quizOptions">
                        <!-- Options injected via JavaScript -->
                    </div>

                    <div class="quiz-feedback" id="quizFeedback" hidden></div>
                </div>

                <div class="quiz-controls">
                    <button type="button" class="quiz-next-btn" id="quizNextBtn" disabled>
                        Next Question →
                    </button>
                </div>
            </div>
        </section>

        <!-- OUR LOVE STORY TIMELINE -->
        <section class="timeline-section section-wrap" id="timeline">
            <div class="section-heading">
                <p class="eyebrow">♡ EVERY MOMENT MATTERS ♡</p>
                <h2>Our Love Story Timeline</h2>
                <p class="section-subtitle">
                    Every chapter, every milestone, and every step that made our bond unbreakable.
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
                                <div class="timeline-image-wrap">
                                    <img
                                        class="timeline-image"
                                        src="<?= e($imagePath) ?>"
                                        alt="<?= e($item["title"]) ?>"
                                        loading="lazy"
                                    >
                                    <span class="timeline-zoom-hint">🔍 Tap to enlarge</span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <p class="timeline-ending script">
                And our story is still being written… hangtod sa hangtod ♡
            </p>
        </section>

        <!-- OUR MEMORIES: 45 PHOTOS GALLERY -->
        <section class="memories-section" id="memories">
            <div class="section-wrap">
                <div class="section-heading">
                    <p class="eyebrow">LITTLE MOMENTS, BIG LOVE</p>
                    <h2>Our Photo Gallery</h2>
                    <p class="section-subtitle">
                        Every single photo is a piece of my favorite happiness. Tap any photo to open our interactive gallery!
                    </p>
                </div>

                <!-- GALLERY CONTROLS -->
                <div class="gallery-toolbar">
                    <div class="gallery-filters">
                        <button type="button" class="filter-btn active" data-filter="all">All Photos (<?= count($photos) ?>)</button>
                        <button type="button" class="filter-btn" data-filter="liked">Favorites <span id="likedCountBadge">0</span></button>
                    </div>

                    <div class="gallery-actions">
                        <button type="button" class="random-memory-btn" id="randomMemoryBtn">
                            🎲 Surprise Memory
                        </button>
                    </div>
                </div>

                <div class="photo-grid" id="photoGrid">
                    <?php if (count($photos) > 0): ?>
                        <?php foreach ($photos as $index => $photo): ?>
                            <figure class="photo-card" data-photo-id="<?= e((string)$photo["id"]) ?>" data-photo-index="<?= $index ?>">
                                <div class="photo-heart-badge" title="Loved memory">♥</div>
                                <button
                                    class="photo-open"
                                    type="button"
                                    aria-label="View <?= e($photo["caption"]) ?>"
                                    data-index="<?= $index ?>"
                                >
                                    <img
                                        src="photos/<?= e($photo["file"]) ?>"
                                        alt="<?= e($photo["caption"]) ?>"
                                        loading="lazy"
                                    >
                                </button>

                                <figcaption class="photo-card-footer">
                                    <span class="photo-caption-text"><?= e($photo["caption"]) ?></span>
                                    <button
                                        type="button"
                                        class="photo-like-btn"
                                        aria-label="Like this photo"
                                        data-photo-id="<?= e((string)$photo["id"]) ?>"
                                    >
                                        <span class="like-icon">♡</span>
                                        <span class="like-counter">0</span>
                                    </button>
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
                    ✨ <?= count($photos) ?> beautiful memories, one endless love story. Tap any photo to view in high resolution! ❤️
                </p>
            </div>
        </section>

        <!-- ANNIVERSARY LOVE LOCK WALL -->
        <section class="love-lock-section section-wrap" id="loveLock">
            <div class="section-heading">
                <p class="eyebrow">♡ ETERNAL PROMISES &amp; WISHES ♡</p>
                <h2>Our Anniversary Love Lock Bridge</h2>
                <p class="section-subtitle">
                    Just like the Pont des Arts in Paris, hang a golden padlock engraved with our love. Write a wish and lock it forever!
                </p>
            </div>

            <div class="love-lock-container">
                <div class="love-lock-bridge" id="lockBridge">
                    <div class="bridge-fairy-lights" aria-hidden="true">
                        <span>✨</span><span>✨</span><span>✨</span><span>✨</span><span>✨</span><span>✨</span>
                    </div>
                    <div class="locks-display-grid" id="locksGrid">
                        <?php foreach ($serverLocks as $lock): ?>
                            <div class="love-lock-item lock-<?= e($lock['style'] ?? 'rose-gold') ?>">
                                <div class="lock-shackle"></div>
                                <div class="lock-body">
                                    <span class="lock-heart-icon">♥</span>
                                    <strong class="lock-names"><?= e($lock['names'] ?? 'Me & Palangga') ?></strong>
                                    <p class="lock-wish"><?= e($lock['wish'] ?? '') ?></p>
                                    <small class="lock-date"><?= e($lock['date'] ?? '') ?></small>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- ADD A NEW LOCK FORM -->
                <div class="add-lock-card">
                    <h3>Hang a New Padlock ♡</h3>
                    <p class="add-lock-desc">Write a sweet anniversary promise or secret wish for us:</p>

                    <form id="addLockForm" class="lock-form">
                        <div class="form-group">
                            <label for="lockWishInput">Our Wish or Promise:</label>
                            <input
                                type="text"
                                id="lockWishInput"
                                maxlength="90"
                                placeholder="e.g. Traveling the world hand-in-hand together ❤️"
                                required
                            >
                        </div>

                        <div class="form-row">
                            <div class="form-group flex-1">
                                <label for="lockInitialsInput">Engraving:</label>
                                <input
                                    type="text"
                                    id="lockInitialsInput"
                                    maxlength="20"
                                    value="Me & Palangga"
                                    required
                                >
                            </div>
                            <div class="form-group flex-1">
                                <label for="lockColorSelect">Padlock Style:</label>
                                <select id="lockColorSelect">
                                    <option value="rose-gold">Rose Gold Heart</option>
                                    <option value="golden-sun">Golden Shine</option>
                                    <option value="ruby-passion">Ruby Velvet</option>
                                    <option value="lavender-dream">Sweet Lavender</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="primary-button hang-lock-btn">
                            Lock Our Love Forever <span>🔒♥</span>
                        </button>
                    </form>
                </div>
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

        <!-- FUTURE ANNIVERSARY LETTER -->
        <section
            class="future-letter-section section-wrap"
            id="futureLetter"
            data-unlock-date="<?= e($futureAnniversaryDate) ?>"
        >
            <div class="future-letter-card">
                <p class="eyebrow">♡ A MESSAGE FROM OUR FUTURE ♡</p>

                <h2>A Sealed Letter for Our Next Chapter</h2>

                <p class="future-letter-intro">
                    I wrote something special for you, my love. This little time-capsule surprise
                    is waiting for our next milestone day.
                </p>

                <!-- LOCKED CONTENT -->
                <div class="future-locked" id="futureLocked">
                    <div class="future-lock-icon" aria-hidden="true">🔒</div>

                    <h3>Our future letter is sealed</h3>

                    <p>
                        Come back on November 18, 2027, to unseal the message
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

                    <h3>Happy Anniversary, my love!</h3>

                    <p class="future-letter-greeting script">
                        My dearest <?= e($herName) ?>,
                    </p>

                    <div class="future-letter-message">
                        <p>
                            Happy Anniversary, palangga! ❤️
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
                            Here's to us, and to all the years
                            still waiting for us. ❤️
                        </p>
                    </div>

                    <p class="script future-letter-signature">
                        Forever yours, ♡
                    </p>
                </div>
            </div>
        </section>

        <!-- PROMISE SECTION -->
        <section class="promise-section section-wrap">
            <div class="promise-card">
                <span class="big-heart" aria-hidden="true">♡</span>
                <p class="eyebrow">ONE THING I'LL ALWAYS MEAN</p>

                <h2>
                    I would choose you<br>
                    <em>again and again.</em>
                </h2>

                <p>
                    No matter how many pages life turns, through storms and sunshine,
                    I hope I get to hold your hand and write every single chapter with you.
                </p>

                <span class="script promise-signoff">
                    I love you, <?= e($herName) ?>.
                </span>
            </div>
        </section>

    </main>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="footer-inner">
            <p>
                Handcrafted with infinite love, just for <strong><?= e($herName) ?></strong>
                <span class="footer-heart">♥</span>
            </p>
            <p class="footer-sub">
                Our Little Forever &bull; Since November 18, 2024 &bull; Hangtod sa Hangtod
            </p>
            <a href="#home" class="back-to-top">Back to the top ↑</a>
        </div>
    </footer>

    <!-- OPEN WHEN MODAL DIALOG -->
    <div class="ow-modal" id="owModal" role="dialog" aria-modal="true" aria-labelledby="owModalTitle" hidden>
        <div class="ow-modal-backdrop" id="owModalBackdrop"></div>
        <div class="ow-modal-box">
            <button class="ow-modal-close" id="owModalClose" type="button" aria-label="Close letter">×</button>
            <div class="ow-modal-seal">💌</div>
            <span class="ow-modal-badge" id="owModalBadge">Comfort</span>
            <h3 class="ow-modal-title" id="owModalTitle">Open When You Miss Me</h3>
            <div class="ow-modal-body" id="owModalBody">
                <!-- Content injected dynamically -->
            </div>
            <div class="ow-modal-footer">
                <button type="button" class="primary-button ow-modal-ok-btn" id="owModalOkBtn">
                    Fold and Keep Safe ♡
                </button>
            </div>
        </div>
    </div>

    <!-- PHOTO LIGHTBOX WITH CAROUSEL NAVIGATION -->
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

        <button
            class="lightbox-nav lightbox-prev"
            id="lightboxPrev"
            type="button"
            aria-label="Previous photo"
        >
            &#10094;
        </button>

        <div class="lightbox-content-wrap">
            <img id="lightboxImage" src="" alt="">
            <div class="lightbox-caption-bar">
                <span class="lightbox-counter" id="lightboxCounter">1 / <?= count($photos) ?></span>
                <span class="lightbox-caption" id="lightboxCaption">Our beautiful memory</span>
                <button type="button" class="lightbox-like-btn" id="lightboxLikeBtn" aria-label="Like this photo">
                    <span class="lb-like-icon">♡</span>
                    <span class="lb-like-count">0</span>
                </button>
            </div>
        </div>

        <button
            class="lightbox-nav lightbox-next"
            id="lightboxNext"
            type="button"
            aria-label="Next photo"
        >
            &#10095;
        </button>
    </div>

    <!-- FLOATING ROMANTIC MUSIC PLAYER -->
    <div class="floating-music-player" id="floatingMusicPlayer">
        <button
            class="music-player-toggle"
            id="musicPlayerToggle"
            type="button"
            aria-label="Toggle background music player"
            title="Our Romantic Music Box"
        >
            <span class="vinyl-disc" id="vinylDisc">
                <span class="vinyl-center">♥</span>
            </span>
            <span class="player-toggle-icon" id="playerToggleIcon">🎵</span>
            <span class="music-wave-bars" id="musicWaveBars" aria-hidden="true">
                <span class="m-bar"></span>
                <span class="m-bar"></span>
                <span class="m-bar"></span>
            </span>
        </button>

        <div class="music-player-card" id="musicPlayerCard" hidden>
            <div class="player-card-header">
                <span class="player-badge">OUR MUSIC BOX</span>
                <button type="button" class="player-card-close" id="playerCardClose" aria-label="Minimize player">×</button>
            </div>
            <div class="player-song-info">
                <strong class="player-song-title">Can't Help Falling in Love</strong>
                <span class="player-song-artist">Romantic Music Box Melodies ♡</span>
            </div>
            <div class="player-controls">
                <button type="button" class="player-btn-main" id="playerPlayPauseBtn">
                    <span id="playerPlayPauseIcon">▶</span>
                </button>
                <div class="player-volume-wrap">
                    <span class="vol-icon" id="volIcon">🔊</span>
                    <input
                        type="range"
                        id="playerVolume"
                        min="0"
                        max="1"
                        step="0.05"
                        value="0.6"
                        aria-label="Volume control"
                    >
                </div>
            </div>
            <p class="player-note">Relax and let the sweet chords play as you read... ❤️</p>
        </div>
    </div>

    <!-- FLOATING "SEND A VIRTUAL HUG & KISS" ACTION BUTTON -->
    <div class="floating-hug-widget" id="floatingHugWidget">
        <button
            type="button"
            class="floating-hug-btn"
            id="sendHugBtn"
            aria-label="Send Palangga a virtual hug and kiss"
            title="Tap to send Palangga a sweet hug!"
        >
            <span class="hug-btn-icon">🤗</span>
            <span class="hug-btn-text">Send Hug ♡</span>
            <span class="hug-count-pill" id="hugCountPill">0</span>
        </button>
    </div>

    <!-- TOAST NOTIFICATION CONTAINER -->
    <div class="toast-container" id="toastContainer" aria-live="polite"></div>

    <!-- JAVASCRIPT CONFIGURATION -->
    <script>
        window.ANNIVERSARY_DATE = <?= json_encode($anniversaryDate) ?>;
        window.FUTURE_ANNIVERSARY_DATE = <?= json_encode($futureAnniversaryDate) ?>;
        window.RELATIONSHIP_START = <?= json_encode($relationshipStartDate) ?>;
        window.HER_NAME = <?= json_encode($herName) ?>;
        window.PHOTOS_DATA = <?= json_encode($photos) ?>;
        window.INITIAL_LOCKS = <?= json_encode($serverLocks) ?>;
    </script>

    <script src="assets/js/script.js"></script>

</body>
</html>
