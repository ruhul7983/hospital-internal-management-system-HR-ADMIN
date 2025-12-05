// Time-based greeting
function getTimeBasedGreeting(date = new Date()) {
    const hour = date.getHours();
    if (hour < 12) return "Good Morning";
    if (hour < 18) return "Good Afternoon";
    return "Good Evening";
}

// Console log
(function () {
    console.log(`${getTimeBasedGreeting()}, viewing payslip!`);
})();

// Show greeting in UI
function displayGreeting(elementId) {
    const el = document.getElementById(elementId);
    if (!el) return;
    el.textContent = `${getTimeBasedGreeting()}, viewing payslip!`;
}

// Optional notification popup
function showNotification(message, duration = 3000) {
    const banner = document.createElement("div");
    banner.textContent = message;

    banner.style.position = "fixed";
    banner.style.top = "20px";
    banner.style.right = "20px";
    banner.style.padding = "12px 18px";
    banner.style.background = "#1a73e8";
    banner.style.color = "#fff";
    banner.style.borderRadius = "8px";
    banner.style.boxShadow = "0 4px 12px rgba(0,0,0,0.15)";
    banner.style.zIndex = 9999;
    banner.style.fontFamily = "Inter, Segoe UI, Arial";
    banner.style.fontSize = "15px";

    document.body.appendChild(banner);
    setTimeout(() => banner.remove(), duration);
}
