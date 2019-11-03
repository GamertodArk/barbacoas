// Shopping basket scripts

let shoppingBasket = __('shopping-basket');
let basketTriangle = __('basket_triangle');
let basketItemsWrap = __('basket_items_wrap');
let hidden = true;

// Hide/Show shopping basket list in nav
shoppingBasket.addEventListener('click', e => {
	// console.log(e);

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

// When the user clicks anywhere in the page, hide the shipping basket list
// window.addEventListener('click', e => {
// 	try {	
// 		if (e.target.id != 'shopping-basket-icon') {
// 			hidden = true;
// 			basketTriangle.style.display = 'none';
// 			basketItemsWrap.style.display = 'none';
// 		}
// 	}catch (e) {
// 		// Do nothing
// 	}
// });

function delete_from_basket(id, item, icon) {
	// let id = btn.parentNode.getAttribute('data-product-id');
	// let id = id;
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
			// console.log(text);
			// btn.parentNode.parentNode.removeChild(btn.parentNode);
			item.parentNode.removeChild(item);

			if (icon) {
				
				let items = document.getElementsByClassName('shopping-item');
				for (var i = items.length - 1; i >= 0; i--) {
					items[i].getAttribute('data-product-id') == id ? items[i].parentNode.removeChild(items[i]) : '';
				}
				console.log(items);
			}
		})
}