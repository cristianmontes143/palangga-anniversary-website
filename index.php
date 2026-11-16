
<?php
// ==========================================
// PERSONAL DETAILS
// ==========================================
$herName = "PALANGGA";
$anniversaryDate = "2026-11-18";

// ==========================================
// AUTOMATICALLY LOAD 45 PHOTOS
// Put photo1.jpg to photo45.jpg in photos/
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

// Escape HTML safely
function e(string $value): string {
    return htmlspecialchars($value, ENT_QUOTES, "UTF-8");
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

    <!-- EXTERNAL CSS FILE -->
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
            <a class="nav-link" href="#memories">Our memories</a>
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

<!-- ANNIVERSARY COUNTDOWN - TOP -->
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

        <!-- OPEN AND CLOSE BUTTONS -->
        <div class="envelope-buttons">
            <button
                class="open-letter-button"
                id="openLetter"
                type="button"
                aria-controls="envelope"
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
                        <?php foreach ($photos as $index => $photo): ?>
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

    <!-- ANNIVERSARY JAVASCRIPT SETTING -->
    <script>
        window.ANNIVERSARY_DATE =
            <?= json_encode($anniversaryDate) ?>;
    </script>

    <!-- EXTERNAL JAVASCRIPT FILE -->
    <script src="assets/js/script.js"></script>

</body>
</html>
