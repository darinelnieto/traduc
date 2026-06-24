// JS for partial: footer\n
const sticky = document.getElementById('stickyCta');

if (sticky) {
	const syncStickyVisibility = () => {
		sticky.classList.toggle('show', window.scrollY > 500);
	};

	window.addEventListener('scroll', syncStickyVisibility);
	syncStickyVisibility();
}