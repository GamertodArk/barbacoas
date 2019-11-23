let moreBtn = __('more_btn');
let lessBtn = __('less_btn');
let counter = __('counter');

moreBtn.addEventListener('click', e => {
	// increase_product_amount
	let result = increase_product_amount(moreBtn, counter);
	if (false != result) {
		counter.value = result;
	}
});

lessBtn.addEventListener('click', e => {
	let currentCounter = counter.value != '' ? parseInt(counter.value) : 0;
	if (currentCounter != 0) {
		let newCounter = (currentCounter - 1);
		counter.value = newCounter;
	}
});