
document.addEventListener("DOMContentLoaded", () => {

    // ==========================================
    // LOVE LETTER ENVELOPE: OPEN AND CLOSE
    // ==========================================

    const envelope = document.getElementById("envelope");
    const openButton = document.getElementById("openLetter");
    const closeButton = document.getElementById("closeLetter");
    const hint = document.getElementById("envelopeHint");

    function openLetter() {
        if (!envelope) return;

        envelope.classList.add("open");

        if (openButton) {
            openButton.hidden = true;
            openButton.setAttribute("aria-expanded", "true");
        }

        if (closeButton) {
            closeButton.hidden = false;
        }

        if (hint) {
            hint.textContent = "Every word is from my heart. ❤️";
        }
    }

    function closeLetter() {
        if (!envelope) return;

        envelope.classList.remove("open");

        if (openButton) {
            openButton.hidden = false;
            openButton.setAttribute("aria-expanded", "false");
        }

        if (closeButton) {
            closeButton.hidden = true;
        }

        if (hint) {
            hint.textContent = "A little surprise is waiting inside";
        }
    }

    openButton?.addEventListener("click", openLetter);
    closeButton?.addEventListener("click", closeLetter);


    // ==========================================
    // ORIGINAL ANNIVERSARY COUNTDOWN
    // Changes to count-up after anniversary date
    // ==========================================

    const anniversaryDate = window.ANNIVERSARY_DATE;

    if (anniversaryDate) {
        const target = new Date(`${anniversaryDate}T00:00:00`);

        const daysElement = document.getElementById("days");
        const hoursElement = document.getElementById("hours");
        const minutesElement = document.getElementById("minutes");
        const secondsElement = document.getElementById("seconds");
        const message = document.getElementById("anniversaryMessage");

        function updateCountdown() {
            const now = new Date();
            const isPast = now >= target;

            let difference = Math.abs(target - now);

            const days = Math.floor(difference / 86400000);
            difference %= 86400000;

            const hours = Math.floor(difference / 3600000);
            difference %= 3600000;

            const minutes = Math.floor(difference / 60000);
            const seconds = Math.floor((difference % 60000) / 1000);

            if (daysElement) {
                daysElement.textContent = String(days).padStart(2, "0");
            }

            if (hoursElement) {
                hoursElement.textContent = String(hours).padStart(2, "0");
            }

            if (minutesElement) {
                minutesElement.textContent = String(minutes).padStart(2, "0");
            }

            if (secondsElement) {
                secondsElement.textContent = String(seconds).padStart(2, "0");
            }

            if (message) {
                message.textContent = isPast
                    ? "Every day since then is another reason to be grateful for you. ❤️"
                    : "Until we celebrate another beautiful chapter together…";
            }
        }

        updateCountdown();
        setInterval(updateCountdown, 1000);
    }


    // ==========================================
    // NEXT ANNIVERSARY COUNTDOWN
    // Automatically finds the next November 18
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
                dateElement.textContent =
                    nextAnniversaryTarget.toLocaleDateString("en-US", {
                        month: "long",
                        day: "numeric",
                        year: "numeric"
                    });
            }
        }

        function updateNextCountdown() {
            const now = new Date();

            if (now >= nextAnniversaryTarget) {
                calculateNextAnniversary();
            }

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

            nextButton.setAttribute(
                "aria-expanded",
                String(!nextContainer.hidden)
            );

            if (!nextContainer.hidden) {
                updateNextCountdown();
            }
        });

        updateNextCountdown();
        setInterval(updateNextCountdown, 1000);
    }


    // ==========================================
    // FUTURE ANNIVERSARY LETTER
    // Unlocks on November 18, 2027
    // ==========================================

    const futureSection = document.getElementById("futureLetter");

    if (futureSection) {

        const unlockDateString = futureSection.dataset.unlockDate;

        const unlockDate = new Date(
            `${unlockDateString}T00:00:00`
        );

        const lockedContent = document.getElementById("futureLocked");
        const unlockedContent = document.getElementById("futureUnlocked");
        const unlockDateLabel = document.getElementById("futureUnlockDate");

        const futureDays = document.getElementById("futureDays");
        const futureHours = document.getElementById("futureHours");
        const futureMinutes = document.getElementById("futureMinutes");
        const futureSeconds = document.getElementById("futureSeconds");

        if (unlockDateLabel) {
            unlockDateLabel.textContent =
                unlockDate.toLocaleDateString("en-US", {
                    month: "long",
                    day: "numeric",
                    year: "numeric"
                });
        }

        function updateFutureLetter() {

            const now = new Date();
            const difference = unlockDate - now;

            // UNLOCK THE LETTER WHEN THE DATE ARRIVES
            if (difference <= 0) {

                if (lockedContent) {
                    lockedContent.hidden = true;
                }

                if (unlockedContent) {
                    unlockedContent.hidden = false;
                }

                return;
            }

            // KEEP THE LETTER LOCKED
            if (lockedContent) {
                lockedContent.hidden = false;
            }

            if (unlockedContent) {
                unlockedContent.hidden = true;
            }

            const days = Math.floor(difference / 86400000);
            const hours = Math.floor((difference / 3600000) % 24);
            const minutes = Math.floor((difference / 60000) % 60);
            const seconds = Math.floor((difference / 1000) % 60);

            if (futureDays) {
                futureDays.textContent = String(days).padStart(2, "0");
            }

            if (futureHours) {
                futureHours.textContent = String(hours).padStart(2, "0");
            }

            if (futureMinutes) {
                futureMinutes.textContent = String(minutes).padStart(2, "0");
            }

            if (futureSeconds) {
                futureSeconds.textContent = String(seconds).padStart(2, "0");
            }
        }

        updateFutureLetter();
        setInterval(updateFutureLetter, 1000);
    }


    // ==========================================
    // PHOTO GALLERY LIGHTBOX
    // ==========================================

    const lightbox = document.getElementById("lightbox");
    const lightboxImage = document.getElementById("lightboxImage");
    const lightboxClose = document.getElementById("lightboxClose");

    if (lightbox && lightboxImage && lightboxClose) {

        document.querySelectorAll(".photo-open").forEach((button) => {

            button.addEventListener("click", () => {

                const img = button.querySelector("img");

                if (!img) return;

                lightboxImage.src = img.src;
                lightboxImage.alt = img.alt;

                lightbox.hidden = false;
                lightboxClose.focus();
            });
        });

        function closeLightbox() {
            lightbox.hidden = true;
            lightboxImage.src = "";
        }

        lightboxClose.addEventListener("click", closeLightbox);

        lightbox.addEventListener("click", (event) => {
            if (event.target === lightbox) {
                closeLightbox();
            }
        });

        document.addEventListener("keydown", (event) => {
            if (event.key === "Escape" && !lightbox.hidden) {
                closeLightbox();
            }
        });
    }

});
