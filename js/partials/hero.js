// JS for partial: hero\n
// Sutil parallax para el documento del hero
const heroDoc = document.querySelector('.hero__doc');
if (heroDoc) {
	window.addEventListener('mousemove', (e) => {
	const x = (e.clientX / window.innerWidth - 0.5) * 12;
	const y = (e.clientY / window.innerHeight - 0.5) * 8;
	heroDoc.style.transform = `translateY(calc(-50% + ${y}px)) translateX(${x}px)`;
	});
}