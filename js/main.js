import '../sass/main.scss'
import $ from 'jquery';
import AOS from 'aos';

window.sajo = {
    menu: (el) => {
        $(el).toggleClass('open');
    }
}

function initAosOnce() {
    if (window.__sajoAosInit) return;
    window.__sajoAosInit = true;

    AOS.init({
        once: true,
        mirror: false,
        offset: 70,
        easing: 'cubic-bezier(0.16, 1, 0.3, 1)',
        disable: () => window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initAosOnce, { once: true });
} else {
    initAosOnce();
}