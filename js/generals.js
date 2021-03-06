// Constants
const site_url = 'http://127.0.0.1/barbacoas/';


function __(id) {
	return document.getElementById(id);
}

function increase_number(numb) {
	return numb + 1;
}

function decrease_number(numb) {
	return numb - 1;
}

function increase_product_amount(btn, counter) {
	let maxCounter = btn.getAttribute('data-max-amount');
	let currentCounter = counter.value != '' ? parseInt(counter.value) : 0;
	// console.log(currentCounter);
	if (currentCounter < maxCounter) {
		let newCounter = (currentCounter + 1);
		// console.log(newCounter);
		// counter.value = newCounter;
		return newCounter;
	}else {
		return false;
	}
}

function insert_product_to_basket_dom(data) {
	let i = document.createElement('i');
	let p = document.createElement('p');
	let a = document.createElement('a');
	let img = document.createElement('div');
	let div = document.createElement('div');
	let divData = document.createElement('div');
	let span = document.createElement('span');
	let wrapper = document.getElementById('items_basket');
	let product_title = document.createTextNode('Producto añadido a la cesta');
	// let product_title = document.createTextNode(data.product_title);

	img.classList.add('img');
	div.appendChild(img);

	a.innerHTML = 'Ver producto';
	a.setAttribute('href', "");

	divData.classList.add('data');
	div.classList.add('shopping-item');
	div.setAttribute('data-product-id', data.product_id);

	span.classList.add('remove-item');
	// span.setAttribute('onclick', 'delete_from_basket(this)');
	span.setAttribute('onclick', `delete_from_basket(${data.product_id}, this.parentNode)`);

	i.classList.add('fas');
	i.classList.add('fa-times');

	p.appendChild(product_title);
	divData.appendChild(p);
	divData.appendChild(a);
	div.appendChild(divData);

	span.appendChild(i);
	div.appendChild(span);

	wrapper.appendChild(div);


	/*** items_basket the notification counter in the shopping basket icon ***/
	let counter = __('shopping_basket_counter'); // Get dom element
	let counter_amount = counter.getAttribute('data-basket-counter'); // Get products amount
	counter_amount++; // Increase the amount counter by one
	counter.setAttribute('data-basket-counter', counter_amount); // Update the data attribute
	counter.innerHTML = counter_amount; // Put the new amount in dom
	counter.classList.remove('hide'); // Show dom element if it's hidden
}

function add_to_basket(data) {
	// let id = data.product.id
	let url = `${site_url}products/add_product_to_basket/${data.product.id}`;

	let productData = {
		'id': data.product.id,
		'amount': data.product.amount,
		'time': {
			'time_lapse': data.product.time.time_lapse,
			'time_lapse_amount': data.product.time.time_lapse_amount
		}
	};

	let fetchInit = {
		method: 'POST',
		body: `data=${JSON.stringify(productData)}`,
		headers:{
			'Content-Type': 'application/x-www-form-urlencoded'
		}
	}

	fetch(url, fetchInit)
		.then(response => response.json())
		.then(json => {
			// console.log(json);

			if (json.error) {
				if (json.code == 0) {
					// User not logged in
					// Show error warning
					data.message.error_msg_wrap.style.display = 'block';
					error_msg.innerHTML = 'Tienes que iniciar sesion para añadir productos a la cesta de compra';
				}else if(json.code == 1) {
					// Some unknown error
					console.log(json.error_msg);
					data.message.error_msg_wrap.style.display = 'block';
					error_msg.innerHTML = 'Ocurrio un error, intente de nuevo';
				}
			}else {
				if (json.code == 2) {
					if (__('basket_empty_msg')) { __('basket_empty_msg').style.display = 'none'; }
					// Product added successfully
					insert_product_to_basket_dom(json);
					data.dom.cesta_btn.innerHTML = 'Producto Añadido a la cesta';
				}else {
					// Product aready in basket
					data.dom.cesta_btn.innerHTML = 'Producto ya esta en la cesta';
				}
			}
		})
}

function reduce_notifications_nav_counter(counter) {
	let currentAmount = parseInt(counter.getAttribute('data-notifi-counter'));

	if (currentAmount > 0) {

		let newAmount = currentAmount - 1;
		if (newAmount > 0) {
			// If there are still notifications, update the counter
			counter.setAttribute('data-notifi-counter', newAmount);
			// counter.innerHTML = newAmount;
		}else {
			// If there are not more notifications, hide the counter
			counter.classList.add('hide');
		}

	}
}
