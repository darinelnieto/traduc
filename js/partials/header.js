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
// Call to action event
$('.whatsapp-chat').on('click', function(e){
	e.preventDefault();
    var destinationUrl = $(this).attr('href');
    gtag_report_conversion(destinationUrl);
});
function gtag_report_conversion(url) {
    var redirected = false;

    function navigate() {
        if (!redirected) {
            redirected = true;
            if (typeof url !== 'undefined' && url) {
                window.open(url, '_blank');
            }
        }
    }

    // Temporizador de respaldo por si la red retrasa el callback
    var timer = setTimeout(navigate, 500);

    gtag('event', 'conversion', {
        'send_to': 'AW-18345180587/MGqVCIbj_J8dEKv71KtE',
        'value': 1.0,
        'currency': 'COP',
        'transport': 'beacon',
        'event_callback': function () {
            clearTimeout(timer);
            navigate();
        }
    });

    return false;
}