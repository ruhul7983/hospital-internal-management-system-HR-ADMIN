// ================================
// Utility: Get Greeting By Time
// ================================
function getTimeBasedGreeting(date = new Date()) {
    const hour = date.getHours();

    if (hour < 12) return "Good Morning";
    if (hour < 18) return "Good Afternoon";
    return "Good Evening";
}

// ================================
// Log Greeting to Console
// ================================
function logGreeting() {
    const greeting = getTimeBasedGreeting();
    console.log(`${greeting}, viewing payslip!`);
}

logGreeting();


// ================================
// Optional: Display greeting in UI
// ================================

// Call this function if you want the greeting to appear on the webpage.
// Example usage: displayGreeting("greeting-text")

function displayGreeting(elementId) {
    const el = document.getElementById(elementId);

    if (!el) {
        console.warn(`Element with ID "${elementId}" not found.`);
        return;
    }

    el.textContent = `${getTimeBasedGreeting()}, viewing payslip!`;
}



// ================================
// Optional: Create notification banner
// ================================
function showNotification(message, duration = 3000) {
    const banner = document.createElement("div");
    banner.textContent = message;

    // banner styling
    banner.style.position = "fixed";
    banner.style.top = "20px";
    banner.style.right = "20px";
    banner.style.padding = "12px 18px";
    banner.style.background = "#1a73e8";
    banner.style.color = "#fff";
    banner.style.borderRadius = "8px";
    banner.style.boxShadow = "0 4px 12px rgba(0,0,0,0.15)";
    banner.style.zIndex = "9999";
    banner.style.fontFamily = "Segoe UI, Arial, sans-serif";
    banner.style.fontSize = "15px";

    document.body.appendChild(banner);

    setTimeout(() => banner.remove(), duration);
}

// Example:
// showNotification("Payslip loaded successfully!");
