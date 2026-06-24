// JS for partial: faqs\n
function toggleFaq(btn) {
	const item = btn.parentElement;
	const open = item.classList.contains('open');

	document.querySelectorAll('.faq-item.open').forEach(el => el.classList.remove('open'));
	if (!open) item.classList.add('open');
}

window.toggleFaq = toggleFaq;