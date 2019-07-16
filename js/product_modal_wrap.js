let counter = __('counter');
let moreBtn = __('more_btn');
let lessBtn = __('less_btn');
let closeBtn = __('close_btn');
let productWrap = __('product_wrap');
let productWrapper = __('product_wrapper');
let viewBtn = document.getElementsByClassName('view_item_btn');

// // Show product modal
for (var i = 0; i < viewBtn.length; i++) {
	
	viewBtn[i].addEventListener('click', e => {
		productWrap.classList.add('show');
		productWrap.classList.remove('hide');
		productWrapper.style.display = 'flex';
	});
}

// Close the product modal
closeBtn.addEventListener('click', e => {
	productWrap.classList.add('hide');
	productWrap.classList.remove('show');
	productWrapper.style.display = 'none';
});

// Increase counter
moreBtn.addEventListener('click', e => {
	let currentCounter = parseInt(counter.getAttribute('data-counter'));
	if (currentCounter <= 998) {}
	let newCounter = (currentCounter + 1);
	console.log(newCounter);
	counter.setAttribute('data-counter', newCounter);
	counter.innerHTML = newCounter;
});

// Decrease counter
lessBtn.addEventListener('click', e => {
	let currentCounter = parseInt(counter.getAttribute('data-counter'));
	if (currentCounter != 0) {
		let newCounter = (currentCounter - 1);
		console.log(newCounter);
		counter.setAttribute('data-counter', newCounter);
		counter.innerHTML = newCounter;
	}
});