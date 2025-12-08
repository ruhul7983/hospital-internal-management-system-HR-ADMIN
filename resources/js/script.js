/* ------------------------------------------------------
   TIME-BASED GREETING
---------------------------------------------------------*/

// Returns greeting text based on current hour
function getTimeBasedGreeting(date = new Date()) {
    const hour = date.getHours();

    if (hour < 12) return "Good Morning";
    if (hour < 18) return "Good Afternoon";
    return "Good Evening";
}

// Log to console instantly
(() => {
    console.log(`${getTimeBasedGreeting()}, viewing payslip!`);
})();

/* ------------------------------------------------------
   GREETING UI DISPLAY
---------------------------------------------------------*/

// Smooth fade-in animation
function fadeInElement(el, duration = 500) {
    if (!el) return;
    el.style.opacity = 0;
    el.style.transition = `opacity ${duration}ms ease`;
    requestAnimationFrame(() => (el.style.opacity = 1));
}

// Inserts greeting text into banner area
function displayGreeting(elementId) {
    const el = document.getElementById(elementId);
    if (!el) return;

    el.textContent = `${getTimeBasedGreeting()}, viewing payslip!`;
    fadeInElement(el, 600);
}

/* ------------------------------------------------------
   SIMPLE NOTIFICATION BANNER (Optional)
---------------------------------------------------------*/

function showNotification(message, duration = 3000) {
    const banner = document.createElement("div");
    banner.classList.add("notification-banner");

    Object.assign(banner.style, {
        position: "fixed",
        top: "20px",
        right: "20px",
        padding: "12px 18px",
        background: "#1a73e8",
        color: "#fff",
        borderRadius: "10px",
        boxShadow: "0 4px 12px rgba(0,0,0,0.12)",
        zIndex: "9999",
        fontFamily: "Inter, Segoe UI, Arial",
        fontSize: "15px",
        opacity: "0",
        transition: "opacity 0.3s ease"
    });

    banner.textContent = message;
    document.body.appendChild(banner);

    // Fade in
    requestAnimationFrame(() => (banner.style.opacity = "1"));

    // Fade out + remove
    setTimeout(() => {
        banner.style.opacity = "0";
        setTimeout(() => banner.remove(), 300);
    }, duration);
}

/* ------------------------------------------------------
   AUTO INITIALIZATION
---------------------------------------------------------*/

document.addEventListener("DOMContentLoaded", () => {
    // Place greeting inside greeting banner
    displayGreeting("greeting-banner");

    // Optional: comment out if not needed
    // showNotification("Payslip loaded successfully!");
});
