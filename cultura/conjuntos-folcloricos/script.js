// Initialize Lucide icons
lucide.createIcons();

// Intersection Observer for reveal animations
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('active');
            observer.unobserve(entry.target);
        }
    });
}, { threshold: 0.1 });

// Observe all reveal-up elements
document.querySelectorAll('.reveal-up').forEach(el => {
    observer.observe(el);
});

// Initialize on page load
window.onload = () => {
    lucide.createIcons();
};
