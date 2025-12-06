/* ------------------------------------------------------
   TIME GREETING SYSTEM
---------------------------------------------------------*/

// Returns a greeting based on current hour
function getTimeBasedGreeting(date = new Date()) {
    const hour = date.getHours();

    if (hour < 12) return "Good Morning";
    if (hour < 18) return "Good Afternoon";
    return "Good Evening";
}

// Immediately log greeting to console
(function () {
    console.log(`${getTimeBasedGreeting()}, viewing payslip!`);
})();

/* ------------------------------------------------------
   UI GREETING DISPLAY
---------------------------------------------------------*/

// Smooth fade-in animation for greeting text
function fadeInElement(el, duration = 500) {
    el.style.opacity = 0;
    el.style.transition = `opacity ${duration}ms ease`;
    requestAnimationFrame(() => (el.style.opacity = 1));
}

// Inserts greeting text inside a UI container
function displayGreeting(elementId) {
    const el = document.getElementById(elementId);
    if (!el) return;

    el.textContent = `${getTimeBasedGreeting()}, viewing payslip!`;
    fadeInElement(el, 600);
}

/* ------------------------------------------------------
   NOTIFICATION POPUP
---------------------------------------------------------*/

function showNotification(message, duration = 3000) {
    const banner = document.createElement("div");
    banner.classList.add("notification-banner");

    banner.textContent = message;

    // Set styles via JS (kept minimal)
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

    document.body.appendChild(banner);

    // Fade in
    requestAnimationFrame(() => (banner.style.opacity = "1"));

    // Remove after duration
    setTimeout(() => {
        banner.style.opacity = "0";
        setTimeout(() => banner.remove(), 300);
    }, duration);
}

/* ------------------------------------------------------
   AUTO EXECUTION ON PAGE LOAD
---------------------------------------------------------*/

document.addEventListener("DOMContentLoaded", () => {
    // Auto-greeting inside the page
    displayGreeting("greeting-banner");

    // Optional popup notification (comment out if not needed)
    // showNotification("Payslip loaded successfully!");
});
