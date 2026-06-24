// JS for partial: header\n
const nav = document.getElementById('nav');
const mobileMenuBtn = document.querySelector('.bar-menu-movil');
const headerNav = document.querySelector('.header-nav');
let mobileMenuCloseTimer = null;

function isMobileHeader() {
    return window.innerWidth <= 768;
}

function closeMobileHeaderMenu() {
    if (!mobileMenuBtn || !headerNav) return;

    if (mobileMenuCloseTimer) {
        clearTimeout(mobileMenuCloseTimer);
    }

    mobileMenuBtn.classList.remove('active');
    headerNav.style.opacity = '0';
    headerNav.style.transform = 'translateY(-8px)';
    headerNav.style.pointerEvents = 'none';
    mobileMenuCloseTimer = window.setTimeout(() => {
        headerNav.style.display = 'none';
    }, 260);
}

function openMobileHeaderMenu() {
    if (!mobileMenuBtn || !headerNav) return;

    if (mobileMenuCloseTimer) {
        clearTimeout(mobileMenuCloseTimer);
    }

    mobileMenuBtn.classList.add('active');
    headerNav.style.display = 'block';
    requestAnimationFrame(() => {
        headerNav.style.opacity = '1';
        headerNav.style.transform = 'translateY(0)';
        headerNav.style.pointerEvents = 'auto';
    });
}

function resetHeaderMenuForDesktop() {
    if (!mobileMenuBtn || !headerNav) return;

    if (!isMobileHeader()) {
        mobileMenuBtn.classList.remove('active');
        if (mobileMenuCloseTimer) {
            clearTimeout(mobileMenuCloseTimer);
        }
        headerNav.style.removeProperty('display');
        headerNav.style.removeProperty('opacity');
        headerNav.style.removeProperty('transform');
        headerNav.style.removeProperty('pointer-events');
        headerNav.style.removeProperty('transition');
    }
}

if (mobileMenuBtn && headerNav) {
    headerNav.style.transition = 'opacity .26s ease, transform .26s ease';
    mobileMenuBtn.addEventListener('click', () => {
        if (!isMobileHeader()) return;

        const isOpen = mobileMenuBtn.classList.contains('active');
        if (isOpen) {
            closeMobileHeaderMenu();
        } else {
            openMobileHeaderMenu();
        }
    });

    window.addEventListener('resize', resetHeaderMenuForDesktop);

    headerNav.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
            if (isMobileHeader()) closeMobileHeaderMenu();
        });
    });
}

window.addEventListener('scroll', () => {
    const y = window.scrollY;
    if (nav) nav.classList.toggle('scrolled', y > 30);
});

const secs = ['inicio','como-funciona','servicios','nosotros','contacto'];
const navAs = document.querySelectorAll('.nav__links a:not(.btn)');
if (navAs.length) {
    window.addEventListener('scroll', () => {
        const y = window.scrollY + 90;
        let cur = '';
        secs.forEach(id => {
            const el = document.getElementById(id);
            if (el && y >= el.offsetTop) cur = id;
        });
        navAs.forEach(a => {
            const active = a.getAttribute('href') === '#' + cur;
            a.style.color = active ? 'var(--verde)' : '';
            a.style.fontWeight = active ? '600' : '';
        });
    });
}