let user_btn = __('user_btn');
let user_btn_buttons = __('user_btn_children');

let shoppingBasket = __('shopping-basket');
let basketTriangle = __('basket_triangle');
let basketItemsWrap = __('basket_items_wrap');
let shoppingBasket_counter = __('shopping_basket_counter');

let hidden = true;
let hidden_user_btns = true;

// Notification variables
let notificationsTriangle = __('notifications-triangle');
let notificationsWrap = __('notification-items');
let notificationIcon = __('notification-icon-nav');
let hidden_notification = true;


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

/*
* This funtion hide the others list when you click in a hidden one.
* This function takes as argument the name of witch list event handler was called.
*/
function hide_others(source) {
	if (source == 'shopping_basket') { // Hide notifications and user_btns lists

		// User btns
		hidden_user_btns = true;
		user_btn_buttons.style.display = 'none';

		// Notitications
		hidden_notification = true;
		notificationsTriangle.style.display = 'none';
		notificationsWrap.style.display = 'none';
	}else if(source == 'user_btns') { // Hide shopping basket and notifications lists

		// Notitications
		hidden_notification = true;
		notificationsTriangle.style.display = 'none';
		notificationsWrap.style.display = 'none';

		// Shopping basket
		hidden = true;
		basketTriangle.style.display = 'none';
		basketItemsWrap.style.display = 'none';
	}else if(source == 'notifications') {// Hide shopping basket and user btns lists
		// Shopping basket
		hidden = true;
		basketTriangle.style.display = 'none';
		basketItemsWrap.style.display = 'none';

		// User btns
		hidden_user_btns = true;
		user_btn_buttons.style.display = 'none';
	}
}


function hide_another(content) {
	if (content == 'shopping_basket') {
		hidden = true;
		basketTriangle.style.display = 'none';
		basketItemsWrap.style.display = 'none';
	}else if(content == 'user_btns') {
		hidden_user_btns = true;
		user_btn_buttons.style.display = 'none';
	}
}

// Hide/Show shopping basket list in nav
shoppingBasket.addEventListener('click', e => {

	// Hide other open lists
	hide_others('shopping_basket');

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

// Hide show notificaion list in nav
notificationIcon.addEventListener('click', e => {

	// Hide other open lists
	hide_others('notifications');

	if (hidden_notification) {
		hidden_notification = false;
		notificationsTriangle.style.display = 'block';
		notificationsWrap.style.display = 'block';
	}else if(e.target.id == 'notification-icon-nav' && !hidden_notification) {
		hidden_notification = true;
		notificationsTriangle.style.display = 'none';
		notificationsWrap.style.display = 'none';
	}

});

// Hide show user btn lists
user_btn.addEventListener('click', e => {

	// Hide other open lists
	hide_others('user_btns');

	if (hidden_user_btns) {
		hidden_user_btns = false;
		user_btn_buttons.style.display = 'block';
	}else {
		hidden_user_btns = true;
		user_btn_buttons.style.display = 'none';
	}
});

function delete_from_basket(id, item, icon) {

	let url = `${site_url}products/delete_from_basket/${id}`;
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

function delete_notification(element) {
	let id = parseInt(element.getAttribute('data-notification-id'));
	let url = `${site_url}members/set_read_notification/${id}`;
	let notificationsCounter = __('notifications_counter');

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
			text == 'done' ? '' : console.log(text);

			element.parentNode.removeChild(element); // remove from notifications dropdown
			reduce_notifications_nav_counter(__('notifications_counter'));
 		});

}
