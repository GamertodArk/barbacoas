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

function glide_structure(div_class = 'glide', imgs = null) {

	// Main div
	let glide = document.createElement('div');
	glide.classList.add(div_class);
	glide.setAttribute('id', div_class);

	// Arrows
	let arrows = document.createElement('div');
	arrows.classList.add(`${div_class}__arrows`);
	arrows.setAttribute('data-glide-el', 'controls');

	let arrow_left = document.createElement('button');
	arrow_left.classList.add(`${div_class}__arrow`);
	arrow_left.classList.add(`${div_class}__arrow--left`);
	arrow_left.setAttribute('data-glide-dir', '<');

	let arrow_right = document.createElement('button');
	arrow_right.classList.add(`${div_class}__arrow`);
	arrow_right.classList.add(`${div_class}__arrow--right`);
	arrow_right.setAttribute('data-glide-dir', '>');

	// Icons
	let icons_arrow_left = document.createElement('i');
	icons_arrow_left.classList.add('fas');
	icons_arrow_left.classList.add('fa-arrow-left');

	let icons_arrow_right = document.createElement('i');
	icons_arrow_right.classList.add('fas');
	icons_arrow_right.classList.add('fa-arrow-right');	

	// Bullets
	let bullets = document.createElement('div');
	bullets.classList.add(`${div_class}__bullets`);
	bullets.setAttribute('data-glide-el', 'controls[nav]');

	for (var i = imgs.length - 1; i >= 0; i--) {
		// imgs[i]
		let bullet_item = document.createElement('button');
		bullet_item.classList.add(`${div_class}__bullet`);
		bullet_item.setAttribute('data-glide-dir', '=' + i);

		bullets.appendChild(bullet_item);
	}

	// Track
	let track = document.createElement('div');
	track.classList.add(`${div_class}__track`);
	track.setAttribute('data-glide-el', 'track');

	let slides = document.createElement('ul');
	slides.classList.add(`${div_class}__slides`);

	for (var i = imgs.length - 1; i >= 0; i--) {
		// imgs[i]
		let slide_item = document.createElement('li');
		slide_item.classList.add(`${div_class}__slide`);

		let img = document.createElement('img');
		img.setAttribute('src', `${site_url}img/products/${imgs[i]}`);

		slide_item.appendChild(img);
		slides.appendChild(slide_item);
	}

	// Append Everything
	glide.appendChild(arrows);
	glide.appendChild(bullets);
	glide.appendChild(track);

	arrows.appendChild(arrow_left);
	arrows.appendChild(arrow_right);

	arrow_left.appendChild(icons_arrow_left);
	arrow_right.appendChild(icons_arrow_right);

	track.appendChild(slides);


	// Remove old glide class if exists
	if (__(div_class)) {__(div_class).parentNode.removeChild(__(div_class));}

	// Insert glide div in dom
	__('product_modal_left_data').appendChild(glide);
}
// glide_structure('glide', [1,2,3,4,5]);

function insert_data_to_modal(data) {
	let productTitle = __('product_title');
	let productDesc = __('product_desc');
	let moreBtnMaxAmount = __('more_btn');


	productTitle.innerHTML = data.title;
	productDesc.innerHTML = data.description;
	cestaBtn.setAttribute('data-product-id', data.id);
	moreBtnMaxAmount.setAttribute('data-max-amount', data.amount);

	// console.log(data.images);
	glide_structure('glide', data.images);
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