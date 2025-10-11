// Live Date and Time in Philippines Time
function updateDateTime() {
    const now = new Date();
    const phTime = new Date(now.toLocaleString("en-US", {timeZone: "Asia/Manila"}));
    
    const dateOptions = {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    };
    
    const timeOptions = {
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: true
    };
    
    const dateElement = document.getElementById('live-date');
    const timeElement = document.getElementById('live-time');
    
    if (dateElement && timeElement) {
        dateElement.textContent = phTime.toLocaleDateString('en-US', dateOptions);
        timeElement.textContent = phTime.toLocaleTimeString('en-US', timeOptions);
    }
}

// Initialize time when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    updateDateTime();
    setInterval(updateDateTime, 1000);
});