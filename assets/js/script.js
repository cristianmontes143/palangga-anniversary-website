document.addEventListener("DOMContentLoaded", () => {
    const envelope = document.getElementById("envelope");
    const openButton = document.getElementById("openLetter");
    const hint = document.getElementById("envelopeHint");

    openButton?.addEventListener("click", () => {
        const isOpen = envelope.classList.toggle("open");
        openButton.innerHTML = isOpen ? 'Close my letter <span>♡</span>' : 'Open my letter <span>♡</span>';
        hint.textContent = isOpen ? "Every word is from my heart." : "A little surprise is waiting inside";
        openButton.setAttribute("aria-expanded", String(isOpen));
    });

    // Countdown switches to a count-up after the anniversary date.
    const target = new Date(`${window.ANNIVERSARY_DATE}T00:00:00`);
    const ids = ["days", "hours", "minutes", "seconds"];
    const message = document.getElementById("anniversaryMessage");

    function updateCountdown() {
        const now = new Date();
        const isPast = now >= target;
        let diff = Math.abs(target - now);
        const days = Math.floor(diff / 86400000);
        diff %= 86400000;
        const hours = Math.floor(diff / 3600000);
        diff %= 3600000;
        const minutes = Math.floor(diff / 60000);
        const seconds = Math.floor((diff % 60000) / 1000);
        [days, hours, minutes, seconds].forEach((value, index) => {
            document.getElementById(ids[index]).textContent = String(value).padStart(2, "0");
        });
        message.textContent = isPast
            ? "Every day since then is another reason to be grateful for you. ❤️"
            : "Until we celebrate another beautiful chapter together…";
    }
    updateCountdown();
    setInterval(updateCountdown, 1000);

    // Tap a photo to see it larger.
    const lightbox = document.getElementById("lightbox");
    const lightboxImage = document.getElementById("lightboxImage");
    const closeButton = document.getElementById("lightboxClose");
    document.querySelectorAll(".photo-open img").forEach((img) => {
        img.closest("button").addEventListener("click", () => {
            lightboxImage.src = img.src;
            lightboxImage.alt = img.alt;
            lightbox.hidden = false;
            closeButton.focus();
        });
    });
    function closeLightbox() {
        lightbox.hidden = true;
        lightboxImage.src = "";
    }
    closeButton.addEventListener("click", closeLightbox);
    lightbox.addEventListener("click", (event) => {
        if (event.target === lightbox) closeLightbox();
    });
    document.addEventListener("keydown", (event) => {
        if (event.key === "Escape" && !lightbox.hidden) closeLightbox();
    });
});
