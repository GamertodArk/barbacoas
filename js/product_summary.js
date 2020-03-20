let PS_error_msg_wrap = __('PS-error-msg-wrap');
let increaseA = __('increase_amount');
let decreaseA = __('decrease_amount');

let increaseD = __('increase_days');
let decreaseD = __('decrease_days');
let amountD = __('amount_days');

let time_lapse = __('time-lapse');
let time_lapse_amount = __('time-lapse-amount');

let amountC = __('amount_counter');
let basketBtn = __('basket_btn');
let fav = __('heart');

// increaseD.addEventListener('click', e => {
// 	let value = amountD.value != '' ? parseInt(amountD.value) : 0;
// 	if (value < 29) {
// 		amountD.value = (value + 1);
// 	}
// });
//
// decreaseD.addEventListener('click', e => {
// 	let value = amountD.value != '' ? parseInt(amountD.value) : 0;
// 	if (value != 0) {
// 		amountD.value = (value - 1);
// 	}
// });



increaseA.addEventListener('click', e => {
	// increase_product_amount
	let result = increase_product_amount(increaseA, amountC);
	if (false != result) {
		amountC.value = result;
	}
});

decreaseA.addEventListener('click', e => {
	let currentCounter = amountC.value != '' ? parseInt(amountC.value) : 0;
	if (currentCounter != 0) {
		let newCounter = (currentCounter - 1);
		amountC.value = newCounter;
	}
});

basketBtn.addEventListener('click', e => {
	let id = basketBtn.getAttribute('data-product-id');

	let data = {
		'product': {
			'id': id,
			'amount': amountC.value,
			'time': {
				'time_lapse': time_lapse.value,
				'time_lapse_amount': (time_lapse_amount.value == 0) ? 1 : parseInt(time_lapse_amount.value)
			}
		},
		'message': {
			'error_msg_wrap': PS_error_msg_wrap
		},
		'dom': {
			'cesta_btn': basketBtn
		}
	}

	add_to_basket(data);
});

fav.addEventListener('click', e => {
	let id = fav.getAttribute('data-product-id');
	let url = `${site_url}members/add_to_favorites/${id}`;

	let fetchInit = {
		method: 'POST',
		body: 'data=test',
		headers:{
			'Content-Type': 'application/x-www-form-urlencoded'
		}
	}

	fetch(url, fetchInit)
		.then(response => response.text())
		.then(data => {
			console.log(data);

			// Disable button
			fav.classList.add('disable');
			fav.setAttribute('id', 'heart-disable');
		})
});
