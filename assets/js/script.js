/**
 * =========================================================================
 * PALANGGA ANNIVERSARY WEBSITE - INTERACTIVE EXPERIENCE ENGINE
 * Handcrafted with infinite love & care for Palangga ❤️
 * =========================================================================
 */

document.addEventListener("DOMContentLoaded", () => {

    // ==========================================
    // 1. ROMANTIC WEB AUDIO API SYNTHESIZER
    // Music Box Melodies & Interactive Sound FX
    // ==========================================
    class RomanticMusicBox {
        constructor() {
            this.audioCtx = null;
            this.isPlaying = false;
            this.timerId = null;
            this.volume = 0.55;
            this.noteIndex = 0;
            this.masterGain = null;

            // Romance Chord Progression (Adapted Canon / Romantic Lullaby in C)
            // C -> G -> Am -> Em -> F -> C -> F -> G
            this.melodyNotes = [
                // Arpeggiated soft music box notes (frequencies in Hz)
                523.25, 659.25, 783.99, 1046.50, // C major
                392.00, 587.33, 783.99, 987.77,  // G major
                440.00, 523.25, 659.25, 880.00,  // A minor
                329.63, 493.88, 659.25, 783.99,  // E minor
                349.23, 523.25, 698.46, 880.00,  // F major
                523.25, 659.25, 783.99, 1046.50, // C major
                349.23, 440.00, 523.25, 698.46,  // F major
                392.00, 493.88, 587.33, 783.99,  // G major

                // Second Variation (Gentle Counter-melody)
                1046.50, 987.77, 880.00, 783.99,
                880.00, 783.99, 698.46, 659.25,
                698.46, 659.25, 587.33, 523.25,
                587.33, 659.25, 698.46, 783.99
            ];

            this.noteSpeedMs = 420;
            this.initDOM();
        }

        initAudioContext() {
            if (!this.audioCtx) {
                const AudioContext = window.AudioContext || window.webkitAudioContext;
                this.audioCtx = new AudioContext();

                this.masterGain = this.audioCtx.createGain();
                this.masterGain.gain.setValueAtTime(this.volume, this.audioCtx.currentTime);
                this.masterGain.connect(this.audioCtx.destination);
            }

            if (this.audioCtx.state === "suspended") {
                this.audioCtx.resume();
            }
        }

        playMusicBoxNote(freq) {
            if (!this.audioCtx || this.audioCtx.state !== "running") return;

            const now = this.audioCtx.currentTime;

            // Pure sine with gentle triangle harmonic to mimic vintage metal music box chime
            const osc = this.audioCtx.createOscillator();
            const oscHarmonic = this.audioCtx.createOscillator();
            const gain = this.audioCtx.createGain();

            osc.type = "sine";
            osc.frequency.setValueAtTime(freq, now);

            oscHarmonic.type = "triangle";
            oscHarmonic.frequency.setValueAtTime(freq * 2, now); // Octave overtone

            // Music box envelope: crisp percussive strike, long crystalline decay
            gain.gain.setValueAtTime(0, now);
            gain.gain.linearRampToValueAtTime(0.28, now + 0.015);
            gain.gain.exponentialRampToValueAtTime(0.0001, now + 1.6);

            osc.connect(gain);
            oscHarmonic.connect(gain);
            gain.connect(this.masterGain);

            osc.start(now);
            oscHarmonic.start(now);
            osc.stop(now + 1.65);
            oscHarmonic.stop(now + 1.65);
        }

        startMelody() {
            this.initAudioContext();
            this.isPlaying = true;
            this.updateUI();

            const playNext = () => {
                if (!this.isPlaying) return;

                const freq = this.melodyNotes[this.noteIndex];
                this.playMusicBoxNote(freq);

                this.noteIndex = (this.noteIndex + 1) % this.melodyNotes.length;
                this.timerId = setTimeout(playNext, this.noteSpeedMs);
            };

            playNext();
        }

        pauseMelody() {
            this.isPlaying = false;
            if (this.timerId) {
                clearTimeout(this.timerId);
                this.timerId = null;
            }
            this.updateUI();
        }

        toggleMelody() {
            if (this.isPlaying) {
                this.pauseMelody();
            } else {
                this.startMelody();
            }
        }

        setVolume(val) {
            this.volume = parseFloat(val);
            if (this.masterGain && this.audioCtx) {
                this.masterGain.gain.setValueAtTime(this.volume, this.audioCtx.currentTime);
            }
        }

        // Sound FX for interactive clicks
        playChime(pitch = "normal") {
            try {
                this.initAudioContext();
                if (!this.audioCtx) return;

                const now = this.audioCtx.currentTime;
                const osc = this.audioCtx.createOscillator();
                const gain = this.audioCtx.createGain();

                const freqMap = {
                    low: 523.25,
                    normal: 880.0,
                    high: 1318.51,
                    sparkle: 1760.0
                };

                osc.type = "sine";
                osc.frequency.setValueAtTime(freqMap[pitch] || 880, now);

                gain.gain.setValueAtTime(0, now);
                gain.gain.linearRampToValueAtTime(0.18, now + 0.01);
                gain.gain.exponentialRampToValueAtTime(0.0001, now + 0.55);

                osc.connect(gain);
                gain.connect(this.masterGain || this.audioCtx.destination);

                osc.start(now);
                osc.stop(now + 0.6);
            } catch (e) {
                // Audio context policy safe
            }
        }

        playSuccessFanfare() {
            try {
                this.initAudioContext();
                if (!this.audioCtx) return;

                const notes = [523.25, 659.25, 783.99, 1046.50];
                notes.forEach((freq, idx) => {
                    setTimeout(() => {
                        this.playMusicBoxNote(freq * 1.25);
                    }, idx * 130);
                });
            } catch (e) {
                // Audio context policy safe
            }
        }

        initDOM() {
            const toggleBtn = document.getElementById("musicPlayerToggle");
            const playerCard = document.getElementById("musicPlayerCard");
            const playPauseBtn = document.getElementById("playerPlayPauseBtn");
            const playPauseIcon = document.getElementById("playerPlayPauseIcon");
            const heroPlayBtn = document.getElementById("heroPlayMusicBtn");
            const volumeSlider = document.getElementById("playerVolume");
            const closeBtn = document.getElementById("playerCardClose");
            const vinyl = document.getElementById("vinylDisc");
            const waveBars = document.getElementById("musicWaveBars");

            this.dom = {
                toggleBtn, playerCard, playPauseBtn, playPauseIcon,
                heroPlayBtn, volumeSlider, closeBtn, vinyl, waveBars
            };

            toggleBtn?.addEventListener("click", () => {
                if (playerCard) {
                    playerCard.hidden = !playerCard.hidden;
                }
                this.playChime("normal");
            });

            closeBtn?.addEventListener("click", () => {
                if (playerCard) playerCard.hidden = true;
            });

            playPauseBtn?.addEventListener("click", () => {
                this.toggleMelody();
            });

            heroPlayBtn?.addEventListener("click", () => {
                if (!this.isPlaying) {
                    this.startMelody();
                }
                if (playerCard) playerCard.hidden = false;
                this.playChime("sparkle");
            });

            volumeSlider?.addEventListener("input", (e) => {
                this.setVolume(e.target.value);
            });
        }

        updateUI() {
            if (!this.dom) return;

            if (this.isPlaying) {
                if (this.dom.playPauseIcon) this.dom.playPauseIcon.textContent = "❚❚";
                if (this.dom.vinyl) this.dom.vinyl.classList.add("spinning");
                if (this.dom.waveBars) this.dom.waveBars.classList.add("active");
                if (this.dom.heroPlayBtn) {
                    this.dom.heroPlayBtn.innerHTML = '<span class="btn-music-icon">🎶</span> Playing Our Song';
                    this.dom.heroPlayBtn.classList.add("is-playing");
                }
            } else {
                if (this.dom.playPauseIcon) this.dom.playPauseIcon.textContent = "▶";
                if (this.dom.vinyl) this.dom.vinyl.classList.remove("spinning");
                if (this.dom.waveBars) this.dom.waveBars.classList.remove("active");
                if (this.dom.heroPlayBtn) {
                    this.dom.heroPlayBtn.innerHTML = '<span class="btn-music-icon">🎵</span> Play Our Song';
                    this.dom.heroPlayBtn.classList.remove("is-playing");
                }
            }
        }
    }

    const musicBox = new RomanticMusicBox();


    // ==========================================
    // 2. THEME CONTROLLER (Daylight / Starlight)
    // ==========================================
    const htmlElem = document.documentElement;
    const desktopThemeBtn = document.getElementById("themeToggleBtn");
    const mobileThemeBtn = document.getElementById("themeToggleBtnMobile");

    const savedTheme = localStorage.getItem("palangga_theme") || "daylight";
    applyTheme(savedTheme);

    function applyTheme(theme) {
        htmlElem.setAttribute("data-theme", theme);
        localStorage.setItem("palangga_theme", theme);

        const isNight = theme === "starlight";
        const icon = isNight ? "☀️" : "🌙";
        const label = isNight ? "Daylight" : "Candlelight";

        if (desktopThemeBtn) {
            desktopThemeBtn.querySelector(".theme-icon").textContent = icon;
            desktopThemeBtn.querySelector(".theme-label").textContent = label;
        }
        if (mobileThemeBtn) {
            mobileThemeBtn.querySelector(".theme-icon").textContent = icon;
        }
    }

    function toggleTheme() {
        const current = htmlElem.getAttribute("data-theme") || "daylight";
        const target = current === "daylight" ? "starlight" : "daylight";
        applyTheme(target);
        musicBox.playChime(target === "starlight" ? "low" : "sparkle");
        showToast(target === "starlight" ? "🌙 Candlelight Starlight Mode activated ♡" : "☀️ Daylight Blush Mode activated ♡");
    }

    desktopThemeBtn?.addEventListener("click", toggleTheme);
    mobileThemeBtn?.addEventListener("click", toggleTheme);


    // ==========================================
    // 3. SCROLL PROGRESS INDICATOR & STICKY SPY
    // ==========================================
    const scrollProgressBar = document.getElementById("scrollProgressBar");
    const navLinks = document.querySelectorAll(".nav-menu .nav-link");
    const sections = document.querySelectorAll("header[id], section[id]");

    window.addEventListener("scroll", () => {
        const scrollTop = window.scrollY || document.documentElement.scrollTop;
        const docHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrollPercent = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;

        if (scrollProgressBar) {
            scrollProgressBar.style.width = `${scrollPercent}%`;
        }

        // Highlight active navigation section
        let currentSectionId = "";
        sections.forEach(sec => {
            const secTop = sec.offsetTop - 120;
            const secHeight = sec.offsetHeight;
            if (scrollTop >= secTop && scrollTop < secTop + secHeight) {
                currentSectionId = sec.getAttribute("id");
            }
        });

        navLinks.forEach(link => {
            const href = link.getAttribute("href");
            if (href === `#${currentSectionId}`) {
                link.classList.add("active");
            } else {
                link.classList.remove("active");
            }
        });
    }, { passive: true });


    // ==========================================
    // 4. AMBIENT PARTICLES CANVAS (Petals & Sparkles)
    // ==========================================
    const canvas = document.getElementById("ambientCanvas");
    if (canvas) {
        const ctx = canvas.getContext("2d");
        let particles = [];
        let animationFrameId = null;
        let isTabActive = true;

        function resizeCanvas() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }
        resizeCanvas();
        window.addEventListener("resize", resizeCanvas, { passive: true });

        class AmbientParticle {
            constructor() {
                this.reset();
            }

            reset() {
                this.x = Math.random() * canvas.width;
                this.y = -20 - Math.random() * 50;
                this.size = 8 + Math.random() * 12;
                this.speedY = 0.6 + Math.random() * 1.2;
                this.speedX = (Math.random() - 0.5) * 0.9;
                this.angle = Math.random() * Math.PI * 2;
                this.rotationSpeed = (Math.random() - 0.5) * 0.02;
                this.opacity = 0.2 + Math.random() * 0.45;
                // Type: 0 = rose petal, 1 = star sparkle, 2 = heart
                this.type = Math.floor(Math.random() * 3);
            }

            update() {
                this.y += this.speedY;
                this.x += this.speedX + Math.sin(this.angle) * 0.4;
                this.angle += this.rotationSpeed;

                if (this.y > canvas.height + 25 || this.x < -30 || this.x > canvas.width + 30) {
                    this.reset();
                }
            }

            draw() {
                ctx.save();
                ctx.translate(this.x, this.y);
                ctx.rotate(this.angle);
                ctx.globalAlpha = this.opacity;

                if (this.type === 0) {
                    // Rose Petal
                    ctx.fillStyle = "#f8b7cb";
                    ctx.beginPath();
                    ctx.ellipse(0, 0, this.size, this.size * 0.55, 0, 0, Math.PI * 2);
                    ctx.fill();
                } else if (this.type === 1) {
                    // Sparkle Star
                    ctx.fillStyle = "#ffd580";
                    ctx.font = `${this.size * 0.9}px serif`;
                    ctx.textAlign = "center";
                    ctx.textBaseline = "middle";
                    ctx.fillText("✨", 0, 0);
                } else {
                    // Delicate Heart
                    ctx.fillStyle = "#e8789b";
                    ctx.font = `${this.size * 0.85}px serif`;
                    ctx.textAlign = "center";
                    ctx.textBaseline = "middle";
                    ctx.fillText("♥", 0, 0);
                }

                ctx.restore();
            }
        }

        const particleCount = window.innerWidth < 600 ? 18 : 36;
        for (let i = 0; i < particleCount; i++) {
            const p = new AmbientParticle();
            p.y = Math.random() * canvas.height; // Spread initially
            particles.push(p);
        }

        function animateCanvas() {
            if (!isTabActive) return;
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            for (let i = 0; i < particles.length; i++) {
                particles[i].update();
                particles[i].draw();
            }

            animationFrameId = requestAnimationFrame(animateCanvas);
        }
        animateCanvas();

        document.addEventListener("visibilitychange", () => {
            isTabActive = !document.hidden;
            if (isTabActive) animateCanvas();
            else if (animationFrameId) cancelAnimationFrame(animationFrameId);
        });
    }


    // ==========================================
    // 5. CLICK / TAP HEART & SPARKLE EXPLOSION
    // ==========================================
    document.addEventListener("click", (e) => {
        // Avoid spawning bursts over sliders or form inputs
        if (e.target.closest("input, select, textarea")) return;

        createHeartBurstAt(e.clientX, e.clientY);
    });

    function createHeartBurstAt(x, y) {
        const icons = ["♥", "♡", "💖", "✨", "🌸", "💕"];
        const count = 6;

        for (let i = 0; i < count; i++) {
            const heart = document.createElement("span");
            heart.className = "heart-burst";
            heart.textContent = icons[Math.floor(Math.random() * icons.length)];
            heart.style.left = `${x}px`;
            heart.style.top = `${y}px`;

            const moveX = (Math.random() - 0.5) * 160;
            const moveY = -40 - Math.random() * 90;
            const rotate = (Math.random() - 0.5) * 60;
            const scale = 0.8 + Math.random() * 0.7;

            heart.style.setProperty("--move-x", `${moveX}px`);
            heart.style.setProperty("--move-y", `${moveY}px`);
            heart.style.setProperty("--rotate-deg", `${rotate}deg`);
            heart.style.setProperty("--burst-scale", `${scale}`);

            document.body.appendChild(heart);
            setTimeout(() => heart.remove(), 1000);
        }
    }


    // ==========================================
    // 6. DESKTOP SPARKLE CURSOR TRAIL
    // ==========================================
    if (window.matchMedia("(pointer: fine)").matches) {
        let lastTrailTime = 0;
        document.addEventListener("mousemove", (e) => {
            const now = Date.now();
            if (now - lastTrailTime < 65) return;
            lastTrailTime = now;

            const sparkle = document.createElement("span");
            sparkle.className = "cursor-sparkle";
            sparkle.textContent = Math.random() > 0.4 ? "✦" : "♥";
            sparkle.style.left = `${e.clientX}px`;
            sparkle.style.top = `${e.clientY}px`;
            document.body.appendChild(sparkle);

            setTimeout(() => sparkle.remove(), 700);
        }, { passive: true });
    }


    // ==========================================
    // 7. TOAST NOTIFICATION UTILITY
    // ==========================================
    const toastContainer = document.getElementById("toastContainer");
    function showToast(message, duration = 3200) {
        if (!toastContainer) return;

        const toast = document.createElement("div");
        toast.className = "romantic-toast";
        toast.innerHTML = `<span class="toast-heart">♥</span> <span class="toast-text">${message}</span>`;
        toastContainer.appendChild(toast);

        setTimeout(() => toast.classList.add("visible"), 20);

        setTimeout(() => {
            toast.classList.remove("visible");
            setTimeout(() => toast.remove(), 400);
        }, duration);
    }


    // ==========================================
    // 8. MOBILE NAVIGATION MENU
    // ==========================================
    const menuToggle = document.getElementById("menuToggle");
    const navMenu = document.getElementById("navMenu");

    if (menuToggle && navMenu) {
        menuToggle.addEventListener("click", () => {
            const isOpen = navMenu.classList.toggle("active");
            menuToggle.setAttribute("aria-expanded", String(isOpen));
            menuToggle.setAttribute(
                "aria-label",
                isOpen ? "Close navigation menu" : "Open navigation menu"
            );
            musicBox.playChime("normal");
        });

        navMenu.querySelectorAll("a").forEach((link) => {
            link.addEventListener("click", () => {
                navMenu.classList.remove("active");
                menuToggle.setAttribute("aria-expanded", "false");
                menuToggle.setAttribute("aria-label", "Open navigation menu");
            });
        });
    }


    // ==========================================
    // 9. OUR LOVE COUNTER (Since Nov 18, 2024)
    // ==========================================
    const relationshipStartStr = window.RELATIONSHIP_START || "2024-11-18";
    const relationshipStart = new Date(`${relationshipStartStr}T00:00:00`);

    const daysElement = document.getElementById("days");
    const hoursElement = document.getElementById("hours");
    const minutesElement = document.getElementById("minutes");
    const secondsElement = document.getElementById("seconds");
    const heroDaysPill = document.getElementById("heroDaysPill");
    const milestoneWeeks = document.getElementById("milestoneWeeks");
    const milestoneHours = document.getElementById("milestoneHours");

    function updateLoveCounter() {
        const now = new Date();
        let difference = now.getTime() - relationshipStart.getTime();
        if (difference < 0) difference = 0;

        const totalSeconds = Math.floor(difference / 1000);
        const days = Math.floor(totalSeconds / 86400);
        const hours = Math.floor((totalSeconds % 86400) / 3600);
        const minutes = Math.floor((totalSeconds % 3600) / 60);
        const seconds = totalSeconds % 60;

        if (daysElement) daysElement.textContent = days.toLocaleString("en-US");
        if (hoursElement) hoursElement.textContent = String(hours).padStart(2, "0");
        if (minutesElement) minutesElement.textContent = String(minutes).padStart(2, "0");
        if (secondsElement) secondsElement.textContent = String(seconds).padStart(2, "0");

        if (heroDaysPill) heroDaysPill.textContent = `${days.toLocaleString("en-US")} Days`;
        if (milestoneWeeks) milestoneWeeks.textContent = Math.floor(days / 7).toLocaleString("en-US");
        if (milestoneHours) milestoneHours.textContent = Math.floor(totalSeconds / 3600).toLocaleString("en-US");
    }

    updateLoveCounter();
    setInterval(updateLoveCounter, 1000);


    // ==========================================
    // 10. LOVE LETTER ENVELOPE (Open & Close)
    // ==========================================
    const envelope = document.getElementById("envelope");
    const openButton = document.getElementById("openLetter");
    const closeButton = document.getElementById("closeLetter");
    const envelopeSeal = document.getElementById("envelopeSeal");
    const envelopeHint = document.getElementById("envelopeHint");

    function openLoveLetter() {
        if (!envelope) return;
        envelope.classList.add("open");

        if (openButton) {
            openButton.hidden = true;
            openButton.setAttribute("aria-expanded", "true");
        }
        if (closeButton) closeButton.hidden = false;
        if (envelopeHint) envelopeHint.textContent = "Every word is directly from my heart. ❤️";

        musicBox.playChime("sparkle");

        // Small heart celebration around envelope
        const rect = envelope.getBoundingClientRect();
        createHeartBurstAt(rect.left + rect.width / 2, rect.top + rect.height / 3);
    }

    function closeLoveLetter() {
        if (!envelope) return;
        envelope.classList.remove("open");

        if (openButton) {
            openButton.hidden = false;
            openButton.setAttribute("aria-expanded", "false");
        }
        if (closeButton) closeButton.hidden = true;
        if (envelopeHint) envelopeHint.textContent = "Tap the glowing seal or button to open";

        musicBox.playChime("low");
    }

    openButton?.addEventListener("click", openLoveLetter);
    envelopeSeal?.addEventListener("click", openLoveLetter);
    closeButton?.addEventListener("click", closeLoveLetter);


    // ==========================================
    // 11. "OPEN WHEN..." INTERACTIVE LETTERS
    // ==========================================
    const openWhenLetters = {
        "miss-me": {
            badge: "Warm Hug Inside",
            title: "Open When You Miss Me ♡",
            body: `
                <p class="ow-greeting">My sweetest Palangga,</p>
                <p>If you're reading this, maybe you're sitting alone and wishing I was right there next to you. Close your eyes for just five seconds, take a deep breath, and feel my arms wrapping tightly around you.</p>
                <p>Distance and busy days can never change the truth: <strong>you are the first thought on my mind every morning, and the softest prayer in my heart every night.</strong></p>
                <p>Whenever you miss me, look at the sky or listen to our song. No matter where we are, we share the same sky and the exact same heartbeat. I love you so much, baby. Always hold on to that!</p>
                <p class="ow-signature">Holding your hand forever,<br>Your Love ♡</p>
            `
        },
        "bad-day": {
            badge: "Safe Sanctuary",
            title: "Open When You're Stressed or Tired ♡",
            body: `
                <p class="ow-greeting">My brave Palangga,</p>
                <p>Today was heavy, wasn't it? Drop your shoulders, unclench your jaw, and take a long, gentle breath. You carried so much today, and I am so, so proud of you.</p>
                <p>It's completely okay to feel exhausted. You don't have to be strong all the time. Whenever the world feels overwhelming, remember that <strong>with me, you can just rest and be yourself.</strong></p>
                <p>Tomorrow is a new day with new grace. Rest well tonight, sleep safely, and remember that I am always in your corner, cheering for you and loving you without end.</p>
                <p class="ow-signature">Your peace & safe space,<br>Always here for you ♡</p>
            `
        },
        "laugh": {
            badge: "Little Sunshine",
            title: "Open When You Need a Smile ♡",
            body: `
                <p class="ow-greeting">Palangga kong pinalangga,</p>
                <p>Did you know that your laugh is literally my favorite sound in the whole universe? It's silly how just seeing your smile instantly erases my stress and makes my whole day 1,000% brighter.</p>
                <p>Remember that sweet BBQ date when we took our first photo? We were both so cute and full of hope, and look at us now — two years of making silly jokes, teasing each other, and falling deeper in love!</p>
                <p>So flash that beautiful smile for me right now! Yes, right this second! You are gorgeous, you are funny, and you have completely stolen my heart. Walay bawian! 😂❤️</p>
                <p class="ow-signature">Forever your number one fan,<br>With lots of giggles & kisses ♡</p>
            `
        },
        "doubt": {
            badge: "Unshakeable Truth",
            title: "Open When You Overthink or Doubt ♡",
            body: `
                <p class="ow-greeting">My dearest Palangga,</p>
                <p>If your mind is loud today and fears are trying to whisper doubts, hear this clearly and let it sink into your core: <strong>My choice is you. Always has been, always will be.</strong></p>
                <p>You don't need to be perfect to be loved by me. I love your quirks, your quiet moments, your laugh, your dreams, and everything that makes you who you are. We've weathered disagreements, but each one only proved that our foundation is built on genuine love.</p>
                <p>Ikaw ra gihapon akong pilion, adlaw-adlaw, hangtod sa hangtod. Nothing will shake that promise. You are irreplaceable in my life.</p>
                <p class="ow-signature">Endlessly and unconditionally,<br>Yours alone ♡</p>
            `
        }
    };

    const owModal = document.getElementById("owModal");
    const owModalTitle = document.getElementById("owModalTitle");
    const owModalBadge = document.getElementById("owModalBadge");
    const owModalBody = document.getElementById("owModalBody");
    const owModalClose = document.getElementById("owModalClose");
    const owModalOkBtn = document.getElementById("owModalOkBtn");
    const owModalBackdrop = document.getElementById("owModalBackdrop");

    document.querySelectorAll(".open-when-card").forEach(card => {
        card.addEventListener("click", () => {
            const letterKey = card.dataset.letter;
            const data = openWhenLetters[letterKey];
            if (!data) return;

            if (owModalTitle) owModalTitle.textContent = data.title;
            if (owModalBadge) owModalBadge.textContent = data.badge;
            if (owModalBody) owModalBody.innerHTML = data.body;

            if (owModal) {
                owModal.hidden = false;
                document.body.classList.add("modal-open");
            }
            musicBox.playChime("sparkle");
        });
    });

    function closeOwModal() {
        if (owModal) {
            owModal.hidden = true;
            document.body.classList.remove("modal-open");
        }
        musicBox.playChime("low");
    }

    owModalClose?.addEventListener("click", closeOwModal);
    owModalOkBtn?.addEventListener("click", closeOwModal);
    owModalBackdrop?.addEventListener("click", closeOwModal);


    // ==========================================
    // 12. "WHY I LOVE YOU" JAR (30 Sweet Reasons)
    // ==========================================
    const loveReasons = [
        { num: 1, cat: "My Peace", text: "The way your smile instantly melts away all the tiredness in my day. You are my peaceful sanctuary. ❤️" },
        { num: 2, cat: "Endless Care", text: "How genuinely you check up on me and care for my health, reminding me to eat and rest well. 🌸" },
        { num: 3, cat: "Sweet Memories", text: "The memory of our very first semi-BBQ date — so simple, yet the happiest beginning of my life. 🥰" },
        { num: 4, cat: "Unconditional", text: "How you stood patiently by my side even when I was at my lowest and struggling. Thank you, palangga. 🥺" },
        { num: 5, cat: "Your Laughter", text: "Imong katawa nga makatangtang sa tanang kabalaka. Hearing you genuinely happy is my favorite reward. ✨" },
        { num: 6, cat: "My Safe Haven", text: "Knowing that no matter how chaotic the world gets, I always have you to come home to. 🏡" },
        { num: 7, cat: "Cute Expressions", text: "The cute face you make when you're focusing, pouty, or teasing me. You're adorably captivating! 💕" },
        { num: 8, cat: "Stronger Together", text: "How we learn and grow after every misunderstanding, choosing forgiveness over pride every time. 🤝" },
        { num: 9, cat: "Your Kindness", text: "Your warm and thoughtful heart that cares so tenderly for the people you love. 💖" },
        { num: 10, cat: "Holding Hands", text: "The comforting warmth of your hand fitting perfectly into mine whenever we walk together. 👫" },
        { num: 11, cat: "My Inspiration", text: "You motivate me to work harder and become the best version of myself every single day. 🌟" },
        { num: 12, cat: "Late Night Talks", text: "Those peaceful, quiet conversations where we talk about anything and everything under the stars. 🌙" },
        { num: 13, cat: "Your Faith In Me", text: "How you believe in my dreams even during moments when I doubt my own abilities. 🌈" },
        { num: 14, cat: "Pure Comfort", text: "A single hug from you feels like being wrapped in the safest, warmest blanket on a cold rainy night. 🧸" },
        { num: 15, cat: "Shared Silence", text: "Being able to sit quietly beside you without needing to say a word, and still feeling completely fulfilled. ☕" },
        { num: 16, cat: "Your Beautiful Eyes", text: "The kindness and sparkle in your eyes when you look at me. It makes my heart skip a beat every time. 👀✨" },
        { num: 17, cat: "Our Silly Inside Jokes", text: "The funny nicknames and silly moments that only the two of us understand. 😂❤️" },
        { num: 18, cat: "Food Adventures", text: "Eating our favorite meals together — food always tastes a hundred times better when shared with you! 🍲" },
        { num: 19, cat: "Patience", text: "Your unending patience and understanding when I'm being stubborn or quiet. 🌷" },
        { num: 20, cat: "The Way You Say My Name", text: "Hearing you call me with that sweet, affectionate tone that belongs only to you. 💌" },
        { num: 21, cat: "Our Future", text: "How excited I get whenever I imagine growing old with you, rocking chairs and all. 👵👴" },
        { num: 22, cat: "Bisaya Sweetness", text: "Ikaw ra gyud ang naghatag ug tinud-anay nga kalinaw ug kalipay sa akong kasingkasing. 🌹" },
        { num: 23, cat: "Your Thoughtfulness", text: "The little unexpected messages you send just to remind me you're thinking of me. 📱❤️" },
        { num: 24, cat: "Little Details", text: "How you remember little things I mentioned off-hand weeks ago. It shows how deeply you listen. 🌻" },
        { num: 25, cat: "Supportive Soul", text: "Being my loudest cheerleader in life and celebrating all my small wins. 🏆" },
        { num: 26, cat: "Soft Hugs", text: "How you lean your head on my shoulder when you're cozy. It's the sweetest feeling on earth. 💫" },
        { num: 27, cat: "Forgiveness", text: "Your gracious heart that chooses to build bridges instead of walls whenever things get tough. 🕊️" },
        { num: 28, cat: "My True Best Friend", text: "You are not just the love of my life, you are my absolute best friend and partner in all things. 💎" },
        { num: 29, cat: "Our Forever Promise", text: "Because loving you is the easiest, most natural decision my heart has ever made. ♾️" },
        { num: 30, cat: "Simply You", text: "I love you simply because you are PALANGGA — my one, my only, hangtod sa hangtod. ❤️" }
    ];

    let discoveredReasons = JSON.parse(localStorage.getItem("palangga_discovered_reasons") || "[1]");
    let currentReasonIdx = 0;

    const jarElement = document.getElementById("jarElement");
    const drawReasonBtn = document.getElementById("drawReasonBtn");
    const noteCard = document.getElementById("loveNoteCard");
    const noteNumber = document.getElementById("noteNumber");
    const noteText = document.getElementById("noteText");
    const noteCategory = document.getElementById("noteCategory");
    const jarCounterText = document.getElementById("jarCounterText");

    function updateJarCounterDisplay() {
        if (jarCounterText) {
            jarCounterText.textContent = `Discovered ${discoveredReasons.length} of ${loveReasons.length} sweet reasons ♡`;
        }
    }
    updateJarCounterDisplay();

    function drawNewReason() {
        // Pick an index different from current
        let nextIdx;
        do {
            nextIdx = Math.floor(Math.random() * loveReasons.length);
        } while (nextIdx === currentReasonIdx && loveReasons.length > 1);

        currentReasonIdx = nextIdx;
        const item = loveReasons[currentReasonIdx];

        if (!discoveredReasons.includes(item.num)) {
            discoveredReasons.push(item.num);
            localStorage.setItem("palangga_discovered_reasons", JSON.stringify(discoveredReasons));
        }

        // Jar shaking animation
        if (jarElement) {
            jarElement.classList.remove("shaking");
            void jarElement.offsetWidth;
            jarElement.classList.add("shaking");
        }

        // Note card flip animation
        if (noteCard) {
            noteCard.classList.add("flipping");
            setTimeout(() => {
                if (noteNumber) noteNumber.textContent = `Reason #${item.num}`;
                if (noteCategory) noteCategory.textContent = item.cat;
                if (noteText) noteText.textContent = `"${item.text}"`;
                noteCard.classList.remove("flipping");
            }, 250);
        }

        updateJarCounterDisplay();
        musicBox.playChime("sparkle");

        if (discoveredReasons.length === loveReasons.length) {
            showToast("🎉 You've unlocked all 30 reasons why I love you! Every single one is true. ❤️");
        }
    }

    drawReasonBtn?.addEventListener("click", drawNewReason);
    jarElement?.addEventListener("click", drawNewReason);
    jarElement?.addEventListener("keydown", (e) => {
        if (e.key === "Enter" || e.key === " ") {
            e.preventDefault();
            drawNewReason();
        }
    });


    // ==========================================
    // 13. PLAYFUL COUPLE QUIZ
    // ==========================================
    const quizQuestions = [
        {
            q: "Where did our very first semi-date and first photo together take place?",
            options: [
                "At a fancy restaurant downtown",
                "At a cozy semi-BBQ date stall",
                "Inside a busy movie theater",
                "At a coffee shop by the beach"
            ],
            correct: 1,
            feedback: "Correct! That sweet semi-BBQ date on August 20, 2024 will forever be one of our most treasured memories! ❤️"
        },
        {
            q: "When did our official relationship journey officially begin?",
            options: [
                "November 18, 2024",
                "December 25, 2024",
                "August 20, 2024",
                "January 1, 2025"
            ],
            correct: 0,
            feedback: "Spot on, baby! November 18, 2024 was the unforgettable day our hearts officially chose forever! 🗓️✨"
        },
        {
            q: "When Palangga is having a difficult, stressful day, what is my #1 mission?",
            options: [
                "To give you space and disappear",
                "To tell you to just stop stressing",
                "To hug you tight, listen, and comfort your heart",
                "To play video games until morning"
            ],
            correct: 2,
            feedback: "Always! I will always be your safe haven, ready with tight hugs, warm ears, and infinite comfort. 🤗💖"
        },
        {
            q: "What is my absolute favorite thing about you?",
            options: [
                "Your genuine smile and your beautiful, kind heart",
                "The way you tease me and make me laugh",
                "How you support me through thick and thin",
                "All of the above — you are my whole world!"
            ],
            correct: 3,
            feedback: "1000% YES! Every single detail of who you are is loved, cherished, and treasured by me! 👑❤️"
        },
        {
            q: "How long will I continue choosing to love you?",
            options: [
                "Just for this year",
                "Only on special holidays",
                "Hangtod sa hangtod (Forever and ever without end)",
                "Until tomorrow morning"
            ],
            correct: 2,
            feedback: "Hangtod sa hangtod! Ikaw ra gihapon akong pilion, adlaw-adlaw, hangtod sa katapusan. I love you, Palangga! ♾️❤️"
        }
    ];

    let currentQ = 0;
    let quizScore = 0;
    let answeredCurrent = false;

    const quizProgressFill = document.getElementById("quizProgressFill");
    const quizQNum = document.getElementById("quizQNum");
    const quizQuestion = document.getElementById("quizQuestion");
    const quizOptions = document.getElementById("quizOptions");
    const quizFeedback = document.getElementById("quizFeedback");
    const quizNextBtn = document.getElementById("quizNextBtn");
    const quizContent = document.getElementById("quizContent");

    function renderQuestion() {
        answeredCurrent = false;
        const item = quizQuestions[currentQ];

        if (quizProgressFill) {
            const pct = ((currentQ + 1) / quizQuestions.length) * 100;
            quizProgressFill.style.width = `${pct}%`;
        }

        if (quizQNum) quizQNum.textContent = `Question ${currentQ + 1} of ${quizQuestions.length}`;
        if (quizQuestion) quizQuestion.textContent = item.q;
        if (quizFeedback) {
            quizFeedback.hidden = true;
            quizFeedback.className = "quiz-feedback";
        }
        if (quizNextBtn) {
            quizNextBtn.disabled = true;
            quizNextBtn.textContent = currentQ === quizQuestions.length - 1 ? "See Final Results ♡" : "Next Question →";
        }

        if (quizOptions) {
            quizOptions.innerHTML = "";
            item.options.forEach((optText, idx) => {
                const btn = document.createElement("button");
                btn.type = "button";
                btn.className = "quiz-opt-btn";
                btn.innerHTML = `<span class="opt-letter">${String.fromCharCode(65 + idx)}</span> <span class="opt-text">${optText}</span>`;
                btn.addEventListener("click", () => handleSelectOption(idx));
                quizOptions.appendChild(btn);
            });
        }
    }

    function handleSelectOption(selectedIdx) {
        if (answeredCurrent) return;
        answeredCurrent = true;

        const item = quizQuestions[currentQ];
        const buttons = quizOptions.querySelectorAll(".quiz-opt-btn");

        buttons.forEach((btn, idx) => {
            btn.disabled = true;
            if (idx === item.correct) {
                btn.classList.add("correct");
            } else if (idx === selectedIdx) {
                btn.classList.add("wrong");
            }
        });

        if (selectedIdx === item.correct) {
            quizScore++;
            musicBox.playSuccessFanfare();
            if (quizFeedback) {
                quizFeedback.textContent = item.feedback;
                quizFeedback.className = "quiz-feedback feedback-correct";
                quizFeedback.hidden = false;
            }
        } else {
            musicBox.playChime("low");
            if (quizFeedback) {
                quizFeedback.textContent = `Sweet try, my love! ${item.feedback}`;
                quizFeedback.className = "quiz-feedback feedback-wrong";
                quizFeedback.hidden = false;
            }
        }

        if (quizNextBtn) quizNextBtn.disabled = false;
    }

    quizNextBtn?.addEventListener("click", () => {
        if (currentQ < quizQuestions.length - 1) {
            currentQ++;
            renderQuestion();
        } else {
            renderQuizResults();
        }
    });

    function renderQuizResults() {
        if (!quizContent) return;

        musicBox.playSuccessFanfare();
        createHeartBurstAt(window.innerWidth / 2, window.innerHeight / 2);

        quizContent.innerHTML = `
            <div class="quiz-results-card">
                <div class="results-badge">🏆 PALANGGA LOVE CERTIFIED</div>
                <h3>Quiz Complete, My Love!</h3>
                <div class="results-score-circle">
                    <strong>${quizScore}/${quizQuestions.length}</strong>
                    <span>Perfect Score</span>
                </div>
                <p class="results-msg">
                    You know our journey by heart. Every question proved that what we have is pure, sweet, and unforgettable. I am blessed to have you in my life! ❤️
                </p>
                <button type="button" class="primary-button quiz-restart-btn" id="quizRestartBtn">
                    Play Quiz Again ♡
                </button>
            </div>
        `;

        if (quizNextBtn) quizNextBtn.hidden = true;

        document.getElementById("quizRestartBtn")?.addEventListener("click", () => {
            currentQ = 0;
            quizScore = 0;
            if (quizNextBtn) quizNextBtn.hidden = false;
            renderQuestion();
        });
    }

    renderQuestion();


    // ==========================================
    // 14. ANNIVERSARY LOVE LOCK BRIDGE
    // Persisted in localStorage
    // ==========================================
    const defaultLocks = [
        {
            id: 1,
            names: "Me & Palangga",
            wish: "To travel under starry skies and hold hands through every storm. ❤️",
            style: "rose-gold",
            date: "Nov 18, 2024"
        },
        {
            id: 2,
            names: "Forever Us",
            wish: "Building a home filled with endless laughter, sweet meals, and pure peace. 🏡",
            style: "golden-sun",
            date: "Nov 18, 2025"
        },
        {
            id: 3,
            names: "Palangga ♡",
            wish: "Ikaw ra gihapon hangtod sa hangtod. Atoa ni padayunon! ✨",
            style: "ruby-passion",
            date: "Nov 18, 2026"
        }
    ];

    const locksGrid = document.getElementById("locksGrid");
    const addLockForm = document.getElementById("addLockForm");
    const lockWishInput = document.getElementById("lockWishInput");
    const lockInitialsInput = document.getElementById("lockInitialsInput");
    const lockColorSelect = document.getElementById("lockColorSelect");

    function getSavedLocks() {
        const saved = localStorage.getItem("palangga_love_locks");
        return saved ? JSON.parse(saved) : defaultLocks;
    }

    function renderLocks() {
        if (!locksGrid) return;
        const locks = getSavedLocks();
        locksGrid.innerHTML = "";

        locks.forEach(lock => {
            const lockEl = document.createElement("div");
            lockEl.className = `love-lock-item lock-${lock.style}`;
            lockEl.innerHTML = `
                <div class="lock-shackle"></div>
                <div class="lock-body">
                    <span class="lock-heart-icon">♥</span>
                    <strong class="lock-names">${escapeHTML(lock.names)}</strong>
                    <p class="lock-wish">${escapeHTML(lock.wish)}</p>
                    <small class="lock-date">${escapeHTML(lock.date)}</small>
                </div>
            `;
            locksGrid.appendChild(lockEl);
        });
    }

    function escapeHTML(str) {
        const p = document.createElement("p");
        p.textContent = str;
        return p.innerHTML;
    }

    renderLocks();

    addLockForm?.addEventListener("submit", (e) => {
        e.preventDefault();

        const wish = lockWishInput?.value.trim();
        const names = lockInitialsInput?.value.trim() || "Me & Palangga";
        const style = lockColorSelect?.value || "rose-gold";

        if (!wish) return;

        const currentLocks = getSavedLocks();
        const now = new Date();
        const dateStr = now.toLocaleDateString("en-US", { month: "short", day: "numeric", year: "numeric" });

        const newLock = {
            id: Date.now(),
            names,
            wish,
            style,
            date: dateStr
        };

        currentLocks.push(newLock);
        localStorage.setItem("palangga_love_locks", JSON.stringify(currentLocks));

        renderLocks();
        lockWishInput.value = "";
        musicBox.playSuccessFanfare();
        showToast("🔒 Your love lock has been permanently engraved & hung on our bridge! ♡");

        // Scroll lock bridge into view smoothly
        document.getElementById("lockBridge")?.scrollIntoView({ behavior: "smooth", block: "center" });
    });


    // ==========================================
    // 15. PHOTO GALLERY, LIKES & CAROUSEL LIGHTBOX
    // ==========================================
    const photosData = window.PHOTOS_DATA || [];
    let photoLikes = JSON.parse(localStorage.getItem("palangga_photo_likes") || "{}");

    // Initialize like counts on photo cards
    function updatePhotoLikesDisplay() {
        let totalLiked = 0;
        document.querySelectorAll(".photo-card").forEach(card => {
            const id = card.dataset.photoId;
            const count = photoLikes[id] || 0;
            const likeBtn = card.querySelector(".photo-like-btn");
            const counterSpan = card.querySelector(".like-counter");

            if (counterSpan) counterSpan.textContent = count;
            if (count > 0) {
                likeBtn?.classList.add("has-liked");
                totalLiked++;
            } else {
                likeBtn?.classList.remove("has-liked");
            }
        });

        const likedCountBadge = document.getElementById("likedCountBadge");
        if (likedCountBadge) likedCountBadge.textContent = totalLiked;
    }
    updatePhotoLikesDisplay();

    // Like buttons click
    document.querySelectorAll(".photo-like-btn").forEach(btn => {
        btn.addEventListener("click", (e) => {
            e.stopPropagation();
            const id = btn.dataset.photoId;
            photoLikes[id] = (photoLikes[id] || 0) + 1;
            localStorage.setItem("palangga_photo_likes", JSON.stringify(photoLikes));

            updatePhotoLikesDisplay();
            musicBox.playChime("sparkle");

            const rect = btn.getBoundingClientRect();
            createHeartBurstAt(rect.left + rect.width / 2, rect.top);
        });
    });

    // Gallery Filters (All vs Liked)
    const filterButtons = document.querySelectorAll(".filter-btn");
    filterButtons.forEach(btn => {
        btn.addEventListener("click", () => {
            filterButtons.forEach(b => b.classList.remove("active"));
            btn.classList.add("active");

            const filter = btn.dataset.filter;
            document.querySelectorAll(".photo-card").forEach(card => {
                const id = card.dataset.photoId;
                const likes = photoLikes[id] || 0;

                if (filter === "liked") {
                    card.style.display = likes > 0 ? "block" : "none";
                } else {
                    card.style.display = "block";
                }
            });
            musicBox.playChime("normal");
        });
    });

    // Random memory button
    const randomMemoryBtn = document.getElementById("randomMemoryBtn");
    randomMemoryBtn?.addEventListener("click", () => {
        if (!photosData.length) return;
        const randomIdx = Math.floor(Math.random() * photosData.length);
        openLightboxAt(randomIdx);
        musicBox.playChime("sparkle");
        showToast("🎲 Opened a sweet surprise memory for you! ♡");
    });

    // LIGHTBOX CAROUSEL LOGIC
    const lightbox = document.getElementById("lightbox");
    const lightboxImage = document.getElementById("lightboxImage");
    const lightboxCaption = document.getElementById("lightboxCaption");
    const lightboxCounter = document.getElementById("lightboxCounter");
    const lightboxClose = document.getElementById("lightboxClose");
    const lightboxPrev = document.getElementById("lightboxPrev");
    const lightboxNext = document.getElementById("lightboxNext");
    const lightboxLikeBtn = document.getElementById("lightboxLikeBtn");

    let currentLightboxIdx = 0;

    function openLightboxAt(index) {
        if (!lightbox || !lightboxImage || !photosData[index]) return;
        currentLightboxIdx = index;
        const item = photosData[currentLightboxIdx];

        lightboxImage.src = `photos/${item.file}`;
        lightboxImage.alt = item.caption;

        if (lightboxCaption) lightboxCaption.textContent = item.caption;
        if (lightboxCounter) lightboxCounter.textContent = `${currentLightboxIdx + 1} / ${photosData.length}`;

        // Update like button in lightbox
        if (lightboxLikeBtn) {
            const count = photoLikes[item.id] || 0;
            lightboxLikeBtn.querySelector(".lb-like-count").textContent = count;
            if (count > 0) lightboxLikeBtn.classList.add("has-liked");
            else lightboxLikeBtn.classList.remove("has-liked");
        }

        lightbox.hidden = false;
        document.body.classList.add("lightbox-open");
    }

    function closeLightbox() {
        if (!lightbox) return;
        lightbox.hidden = true;
        if (lightboxImage) lightboxImage.src = "";
        document.body.classList.remove("lightbox-open");
    }

    function nextPhoto() {
        if (!photosData.length) return;
        currentLightboxIdx = (currentLightboxIdx + 1) % photosData.length;
        openLightboxAt(currentLightboxIdx);
    }

    function prevPhoto() {
        if (!photosData.length) return;
        currentLightboxIdx = (currentLightboxIdx - 1 + photosData.length) % photosData.length;
        openLightboxAt(currentLightboxIdx);
    }

    document.querySelectorAll(".photo-open").forEach(btn => {
        btn.addEventListener("click", () => {
            const idx = parseInt(btn.dataset.index, 10);
            if (!isNaN(idx)) openLightboxAt(idx);
        });
    });

    // Timeline images zoom
    document.querySelectorAll(".timeline-image-wrap").forEach(wrap => {
        wrap.addEventListener("click", () => {
            const img = wrap.querySelector("img");
            if (!img || !lightbox || !lightboxImage) return;

            lightboxImage.src = img.src;
            lightboxImage.alt = img.alt;
            if (lightboxCaption) lightboxCaption.textContent = img.alt;
            if (lightboxCounter) lightboxCounter.textContent = "Milestone Memory";

            lightbox.hidden = false;
            document.body.classList.add("lightbox-open");
        });
    });

    lightboxClose?.addEventListener("click", closeLightbox);
    lightboxNext?.addEventListener("click", (e) => {
        e.stopPropagation();
        nextPhoto();
        musicBox.playChime("normal");
    });
    lightboxPrev?.addEventListener("click", (e) => {
        e.stopPropagation();
        prevPhoto();
        musicBox.playChime("normal");
    });

    lightboxLikeBtn?.addEventListener("click", (e) => {
        e.stopPropagation();
        const item = photosData[currentLightboxIdx];
        if (!item) return;

        photoLikes[item.id] = (photoLikes[item.id] || 0) + 1;
        localStorage.setItem("palangga_photo_likes", JSON.stringify(photoLikes));

        updatePhotoLikesDisplay();
        lightboxLikeBtn.querySelector(".lb-like-count").textContent = photoLikes[item.id];
        lightboxLikeBtn.classList.add("has-liked");

        musicBox.playChime("sparkle");
        createHeartBurstAt(window.innerWidth / 2, window.innerHeight / 2);
    });

    lightbox?.addEventListener("click", (e) => {
        if (e.target === lightbox) closeLightbox();
    });

    // Keyboard navigation (Arrow keys + Esc)
    document.addEventListener("keydown", (e) => {
        if (lightbox && !lightbox.hidden) {
            if (e.key === "Escape") closeLightbox();
            if (e.key === "ArrowRight") nextPhoto();
            if (e.key === "ArrowLeft") prevPhoto();
        }
    });

    // Mobile swipe gestures for lightbox
    let touchStartX = 0;
    let touchEndX = 0;

    lightbox?.addEventListener("touchstart", (e) => {
        touchStartX = e.changedTouches[0].screenX;
    }, { passive: true });

    lightbox?.addEventListener("touchend", (e) => {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    }, { passive: true });

    function handleSwipe() {
        const threshold = 50;
        if (touchEndX < touchStartX - threshold) {
            nextPhoto(); // Swiped left -> Next
        } else if (touchEndX > touchStartX + threshold) {
            prevPhoto(); // Swiped right -> Prev
        }
    }


    // ==========================================
    // 16. VIRTUAL HUG & KISS BUTTON
    // ==========================================
    const sendHugBtn = document.getElementById("sendHugBtn");
    const hugCountPill = document.getElementById("hugCountPill");

    let hugsDelivered = parseInt(localStorage.getItem("palangga_hugs_delivered") || "0", 10);
    if (hugCountPill) hugCountPill.textContent = hugsDelivered;

    const hugMessages = [
        "Delivered a warm, tight cuddle to Palangga! 🤗❤️",
        "Sent 10,000 gentle forehead kisses! 💋✨",
        "A soft blanket of love just wrapped around you! 🧸💖",
        "Hug delivered! You are my greatest blessing, baby! 🥰",
        "Sent infinite comfort & sweet snuggles directly to your heart! 🌸"
    ];

    sendHugBtn?.addEventListener("click", (e) => {
        e.stopPropagation();
        hugsDelivered++;
        localStorage.setItem("palangga_hugs_delivered", String(hugsDelivered));
        if (hugCountPill) hugCountPill.textContent = hugsDelivered;

        musicBox.playSuccessFanfare();

        // Screen-wide heart shower
        for (let i = 0; i < 18; i++) {
            setTimeout(() => {
                const randX = Math.random() * window.innerWidth;
                const randY = window.innerHeight - 80 - Math.random() * 200;
                createHeartBurstAt(randX, randY);
            }, i * 40);
        }

        const msg = hugMessages[hugsDelivered % hugMessages.length];
        showToast(msg);
    });


    // ==========================================
    // 17. NEXT ANNIVERSARY COUNTDOWN
    // ==========================================
    const nextButton = document.getElementById("showNextAnniversary");
    const nextContainer = document.getElementById("nextCountdownContainer");

    if (nextButton && nextContainer) {
        let nextAnniversaryTarget;

        function calculateNextAnniversary() {
            const now = new Date();
            let year = now.getFullYear();
            nextAnniversaryTarget = new Date(year, 10, 18, 0, 0, 0);

            if (now >= nextAnniversaryTarget) {
                nextAnniversaryTarget = new Date(year + 1, 10, 18, 0, 0, 0);
            }

            const dateElement = document.getElementById("nextAnniversaryDate");
            if (dateElement) {
                dateElement.textContent = nextAnniversaryTarget.toLocaleDateString("en-US", {
                    month: "long",
                    day: "numeric",
                    year: "numeric"
                });
            }
        }

        function updateNextCountdown() {
            const now = new Date();
            if (now >= nextAnniversaryTarget) calculateNextAnniversary();

            const difference = nextAnniversaryTarget - now;
            const days = Math.floor(difference / 86400000);
            const hours = Math.floor((difference / 3600000) % 24);
            const minutes = Math.floor((difference / 60000) % 60);
            const seconds = Math.floor((difference / 1000) % 60);

            const nextDays = document.getElementById("nextDays");
            const nextHours = document.getElementById("nextHours");
            const nextMinutes = document.getElementById("nextMinutes");
            const nextSeconds = document.getElementById("nextSeconds");

            if (nextDays) nextDays.textContent = days;
            if (nextHours) nextHours.textContent = String(hours).padStart(2, "0");
            if (nextMinutes) nextMinutes.textContent = String(minutes).padStart(2, "0");
            if (nextSeconds) nextSeconds.textContent = String(seconds).padStart(2, "0");
        }

        calculateNextAnniversary();

        nextButton.addEventListener("click", () => {
            nextContainer.hidden = !nextContainer.hidden;
            nextButton.textContent = nextContainer.hidden
                ? "Count Down to Our Next Anniversary ♡"
                : "Hide Our Countdown ♡";

            nextButton.setAttribute("aria-expanded", String(!nextContainer.hidden));
            if (!nextContainer.hidden) updateNextCountdown();
            musicBox.playChime("normal");
        });

        updateNextCountdown();
        setInterval(updateNextCountdown, 1000);
    }


    // ==========================================
    // 18. FUTURE ANNIVERSARY LETTER (Time Capsule)
    // ==========================================
    const futureSection = document.getElementById("futureLetter");
    if (futureSection) {
        const unlockDateString = futureSection.dataset.unlockDate || "2027-11-18";
        const unlockDate = new Date(`${unlockDateString}T00:00:00`);

        const lockedContent = document.getElementById("futureLocked");
        const unlockedContent = document.getElementById("futureUnlocked");
        const unlockDateLabel = document.getElementById("futureUnlockDate");

        const futureDays = document.getElementById("futureDays");
        const futureHours = document.getElementById("futureHours");
        const futureMinutes = document.getElementById("futureMinutes");
        const futureSeconds = document.getElementById("futureSeconds");

        if (unlockDateLabel) {
            unlockDateLabel.textContent = unlockDate.toLocaleDateString("en-US", {
                month: "long",
                day: "numeric",
                year: "numeric"
            });
        }

        function updateFutureLetter() {
            const now = new Date();
            const difference = unlockDate - now;

            if (difference <= 0) {
                if (lockedContent) lockedContent.hidden = true;
                if (unlockedContent) unlockedContent.hidden = false;
                return;
            }

            if (lockedContent) lockedContent.hidden = false;
            if (unlockedContent) unlockedContent.hidden = true;

            const days = Math.floor(difference / 86400000);
            const hours = Math.floor((difference / 3600000) % 24);
            const minutes = Math.floor((difference / 60000) % 60);
            const seconds = Math.floor((difference / 1000) % 60);

            if (futureDays) futureDays.textContent = String(days).padStart(2, "0");
            if (futureHours) futureHours.textContent = String(hours).padStart(2, "0");
            if (futureMinutes) futureMinutes.textContent = String(minutes).padStart(2, "0");
            if (futureSeconds) futureSeconds.textContent = String(seconds).padStart(2, "0");
        }

        updateFutureLetter();
        setInterval(updateFutureLetter, 1000);
    }

    // Scroll reveal observer for silky smooth entrance animations
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("revealed");
            }
        });
    }, { threshold: 0.12 });

    document.querySelectorAll(".timeline-card, .photo-card, .open-when-card, .love-jar-container, .quiz-card, .promise-card, .next-anniversary-card").forEach(el => {
        el.classList.add("reveal-on-scroll");
        revealObserver.observe(el);
    });

});
