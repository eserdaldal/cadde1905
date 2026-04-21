// Miras page-specific scripts
document.addEventListener('DOMContentLoaded', () => {
    const items = document.querySelectorAll('.miras-timeline__item');
    if (!items.length) {
        return;
    }

    items.forEach((el) => el.classList.add('reveal-on-scroll'));

    if (!('IntersectionObserver' in window)) {
        items.forEach((el) => el.classList.add('is-visible'));
        return;
    }

    const observer = new IntersectionObserver(
        (entries, obs) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    obs.unobserve(entry.target);
                }
            });
        },
        { root: null, rootMargin: '0px 0px -10% 0px', threshold: 0.15 }
    );

    items.forEach((el) => observer.observe(el));
});
