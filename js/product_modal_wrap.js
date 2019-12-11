let counter = __('counter');
let moreBtn = __('more_btn');
let lessBtn = __('less_btn');
let closeBtn = __('close_btn');
let cestaBtn = __('add_cesta_btn');
let productWrap = __('product_wrap');

let error_msg = __('error-msg');
let error_msg_wrap = __('error-msg-wrap');
// let basket_empty_msg = __('basket_empty_msg');

let modalWrap = __('modal-background');
let modalLoadingBox = __('loading-wrap')
let viewBtns = [...document.getElementsByClassName('view_item_btn')];


// function insert_product_to_basket_dom(data) {
// 	let i = document.createElement('i');
// 	let h3 = document.createElement('h3');
// 	let div = document.createElement('div');
// 	let span = document.createElement('span');
// 	let wrapper = document.getElementById('basket_items_wrap');
// 	let product_title = document.createTextNode(data.product_title);

// 	div.classList.add('shopping-item');
// 	div.setAttribute('data-product-id', data.product_id);

// 	span.classList.add('remove-item');
// 	span.setAttribute('onclick', 'delete_from_basket(this)');

// 	i.classList.add('fas');
// 	i.classList.add('fa-times');

// 	span.appendChild(i);
// 	h3.appendChild(product_title);
// 	div.appendChild(h3);
// 	div.appendChild(span);

// 	wrapper.appendChild(div);
// }

function insert_data_to_modal(data) {
	let productTitle = __('product_title');
	let productDesc = __('product_desc');
	let moreBtnMaxAmount = __('more_btn');


	productTitle.innerHTML = data.title;
	productDesc.innerHTML = data.description;
	cestaBtn.setAttribute('data-product-id', data.id);
	moreBtnMaxAmount.setAttribute('data-max-amount', data.amount);
}


// Loop through all item btns
viewBtns.forEach(elem => {
	elem.addEventListener('click', e => {
		// Show the modal wrap
		modalWrap.style.display = 'flex';

		cestaBtn.innerHTML = 'AÑADIR A LA CESTA';

		// Get the clicked product id
		let product_id = parseInt(elem.parentNode.getAttribute('data-product-id'));

		// Prepare fetch get the clicked product info
		let url = `http://127.0.0.1/barbacoas/products/get_product_data/${product_id}`;
		let fetchInit = {
			method: 'POST',
			body: 'data=test',
			headers:{
				'Content-Type': 'application/x-www-form-urlencoded'
			}
		}

		fetch(url, fetchInit)
			.then(response => response.json())
			.then(json => {

				// console.log(json);

				// Updata data in modal
				insert_data_to_modal(json);

				// Hide loading box
				modalLoadingBox.classList.add('hide');
				modalLoadingBox.addEventListener('transitionend', e => {
					modalLoadingBox.style.display = 'none';
				});

				// Start the glidejs gallery
				new Glide('.glide').mount();
			});
	});
});

// Close the product modal
closeBtn.addEventListener('click', e => {
	modalLoadingBox.classList.remove('hide');
	modalLoadingBox.style.display = 'flex';
	modalWrap.style.display = 'none';
});

// Increase counter
moreBtn.addEventListener('click', e => {
	// let maxCounter = moreBtn.getAttribute('data-max-amount');
	// let currentCounter = counter.value != '' ? parseInt(counter.value) : 0;
	// if (currentCounter < maxCounter) {
	// 	let newCounter = (currentCounter + 1);
	// 	counter.value = newCounter;
	// }
	// console.log();
	let result = increase_product_amount(moreBtn, counter);
	if (false != result) {
		counter.value = result;
	}
});

// Decrease counter
lessBtn.addEventListener('click', e => {
	let currentCounter = counter.value != '' ? parseInt(counter.value) : 0;
	if (currentCounter != 0) {
		let newCounter = (currentCounter - 1);
		counter.value = newCounter;
	}
});

// Add product to the shopping basket btn
cestaBtn.addEventListener('click', function (e) {
	let id = this.getAttribute('data-product-id');

	let data = {
		'product': {
			'id': id,
			'amount': counter.value
		},
		'message': {
			'error_msg_wrap': error_msg_wrap
		},
		'dom': {
			'cesta_btn': cestaBtn
		}
	}

	add_to_basket(data);

	// let url = `${site_url}products/add_product_to_basket/${id}`;

	// let data = {
	// 	'id': id,
	// 	'amount': 
	// };

	// let fetchInit = {
	// 	method: 'POST',
	// 	body: `data=${JSON.stringify(data.product)}`,
	// 	headers:{
	// 		'Content-Type': 'application/x-www-form-urlencoded'
	// 	}
	// }

	// fetch(url, fetchInit)
	// 	.then(response => response.json())
	// 	.then(json => {

	// 		// console.log(json);

	// 		if (json.error) {
	// 			if (json.code == 0) {
	// 				// User not logged in
	// 				// Show error warning
	// 				error_msg_wrap.style.display = 'block';
	// 				error_msg.innerHTML = 'Tienes que iniciar sesion para añadir productos a la cesta de compra';
	// 			}else if(json.code == 1) {
	// 				// Some unknown error
	// 				console.log(json.error_msg);
	// 				error_msg_wrap.style.display = 'block';
	// 				error_msg.innerHTML = 'Ocurrio un error, intente de nuevo';					
	// 			}
	// 		}else {
	// 			if (json.code == 2) {
	// 				if (__('basket_empty_msg')) { __('basket_empty_msg').style.display = 'none'; }
	// 				// Product added successfully
	// 				insert_product_to_basket_dom(json);
	// 				cestaBtn.innerHTML = 'Producto Añadido a la cesta';
	// 			}else {
	// 				// Product aready in basket
	// 				cestaBtn.innerHTML = 'Producto ya esta en la cesta';					
	// 			}
	// 		}
	// 	})
});