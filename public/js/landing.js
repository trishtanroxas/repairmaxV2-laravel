document.addEventListener("DOMContentLoaded", function () {
    // --- FADE-IN SCROLL EFFECT ---
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.15
    };

    const scrollObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.remove("opacity-0", "translate-y-10");
                entry.target.classList.add("opacity-100", "translate-y-0");
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    const fadeElements = document.querySelectorAll(".fade-in-element");
    fadeElements.forEach(el => {
        el.classList.add("opacity-0", "translate-y-10", "transition-all", "duration-700", "ease-out");
        scrollObserver.observe(el);
    });
});