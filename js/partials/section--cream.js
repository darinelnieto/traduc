// JS for partial: section--cream\n
const processBlock = document.getElementById('processBlock');

if (processBlock) {
	processBlock.classList.add('in-view');
	processBlock.querySelectorAll('.pstep').forEach(s => s.classList.add('is-done'));
}