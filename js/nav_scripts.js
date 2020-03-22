let user_btn = __('user_btn');
let user_btn_buttons = __('user_btn_children');

let shoppingBasket = __('shopping-basket');
let basketTriangle = __('basket_triangle');
let basketItemsWrap = __('basket_items_wrap');
let shoppingBasket_counter = __('shopping_basket_counter');
let hidden = true;
let hidden2 = true;


// Update amount counter in shopping basket icon
function update_shopping_basket_icon_counter(action) {
	if (action == 'decrease') {
		let counter_amount = shoppingBasket_counter.getAttribute('data-basket-counter'); // Get products amount

		// If there's only one product in the shopping basket, hide the counter before updating the dom
		if (counter_amount == 1) {
			shoppingBasket_counter.classList.add('hide');
		}

		counter_amount--; // Decrease the amount counter by one
		shoppingBasket_counter.setAttribute('data-basket-counter', counter_amount); // Update the data attribute
		shoppingBasket_counter.innerHTML = counter_amount; // Put the new amount in dom
	}
}

function hide_another(content) {
	if (content == 'shopping_basket') {
		hidden = true;
		basketTriangle.style.display = 'none';
		basketItemsWrap.style.display = 'none';
	}else if(content == 'user_btns') {
		hidden2 = true;
		user_btn_buttons.style.display = 'none';
	}
}

// Hide/Show shopping basket list in nav
shoppingBasket.addEventListener('click', e => {

	// Hide the user btn when the user clicks the shopping basket icon
	hide_another('user_btns');

	if (hidden) {
		hidden = false;
		basketTriangle.style.display = 'block';
		basketItemsWrap.style.display = 'block';
	}else if(e.target.id == 'shopping-basket-icon' && !hidden) {
		hidden = true;
		basketTriangle.style.display = 'none';
		basketItemsWrap.style.display = 'none';
	}
});


user_btn.addEventListener('click', e => {

	// Hide the shopping basket dropdown when user click the user btn
	hide_another('shopping_basket');

	if (hidden2) {
		hidden2 = false;
		user_btn_buttons.style.display = 'block';
	}else {
		hidden2 = true;
		user_btn_buttons.style.display = 'none';
	}
});

function delete_from_basket(id, item, icon) {

	let url = `http://127.0.0.1/barbacoas/products/delete_from_basket/${id}`;
	let fetchInit = {
		method: 'POST',
		body: 'data=test',
		headers:{
			'Content-Type': 'application/x-www-form-urlencoded'
		}
	}

	fetch(url, fetchInit)
		.then(response => response.text())
		.then(text => {
			item.parentNode.removeChild(item);

			if (icon) {
				let items = document.getElementsByClassName('shopping-item');
				for (var i = items.length - 1; i >= 0; i--) {
					items[i].getAttribute('data-product-id') == id ? items[i].parentNode.removeChild(items[i]) : '';
				}
			}

			// Reduce the number in the shopping basket icon in the nav
			update_shopping_basket_icon_counter('decrease');
		})
}
