// JS for partial: blog-list\n
(() => {
// Carrusel
const track = document.getElementById('track');
if (!track) {
    return;
}

const slides = track.children.length;
if (!slides) {
    return;
}

let idx = 0;
const count = document.getElementById('count');
const progress = document.getElementById('progress');
const nextBtn = document.getElementById('next');
const prevBtn = document.getElementById('prev');
const carousel = document.getElementById('carousel');
const vp = document.querySelector('.carousel__viewport');
const pad = n => String(n).padStart(2, '0');

function render() {
    track.style.transform = `translateX(-${idx * 100}%)`;
    if (count) count.innerHTML = `<strong>${pad(idx + 1)}</strong><em> / ${pad(slides)}</em>`;
    if (progress) {
        progress.style.width = (100 / slides) + '%';
        progress.style.left = (idx * 100 / slides) + '%';
    }
}
function go(dir) { idx = (idx + dir + slides) % slides; render(); }
if (nextBtn) nextBtn.addEventListener('click', () => go(1));
if (prevBtn) prevBtn.addEventListener('click', () => go(-1));
document.addEventListener('keydown', e => {
    if (e.key === 'ArrowRight') go(1);
    if (e.key === 'ArrowLeft') go(-1);
});

// Swipe táctil
let startX = null;
if (vp) {
    vp.addEventListener('touchstart', e => startX = e.touches[0].clientX, { passive: true });
    vp.addEventListener('touchend', e => {
        if (startX === null) return;
        const dx = e.changedTouches[0].clientX - startX;
        if (Math.abs(dx) > 50) go(dx < 0 ? 1 : -1);
        startX = null;
    });
}

// Autoplay suave (se detiene al interactuar)
let timer = null;
if (slides > 1) {
    timer = setInterval(() => go(1), 7000);
}
const stop = () => {
    if (timer) {
        clearInterval(timer);
        timer = null;
    }
};
if (carousel) carousel.addEventListener('mouseenter', stop);
['click','touchstart','keydown'].forEach(ev => document.addEventListener(ev, stop, { once: true }));

if (slides <= 1) {
    if (nextBtn) nextBtn.setAttribute('disabled', 'disabled');
    if (prevBtn) prevBtn.setAttribute('disabled', 'disabled');
    if (progress) {
        progress.style.width = '100%';
        progress.style.left = '0';
    }
}

render();

})();