let user_btn = __('user_btn');
let user_btn_buttons = __('user_btn_children');

let shoppingBasket = __('shopping-basket');
let basketTriangle = __('basket_triangle');
let basketItemsWrap = __('basket_items_wrap');
let hidden = true;
let hidden2 = true;

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
		})
}