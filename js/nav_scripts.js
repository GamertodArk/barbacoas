// Shopping basket scripts

let shoppingBasket = __('shopping-basket');
let basketTriangle = __('basket_triangle');
let basketItemsWrap = __('basket_items_wrap');
let hidden = true;

// Hide/Show shopping basket list in nav
shoppingBasket.addEventListener('click', e => {
	if (hidden) {
		hidden = false;
		basketTriangle.style.display = 'block';
		basketItemsWrap.style.display = 'block';
	}else {
		hidden = true;
		basketTriangle.style.display = 'none';
		basketItemsWrap.style.display = 'none';
	}
});

// When the user clicks anywhere in the page, hide the shipping basket list
window.addEventListener('click', e => {
	try {	
		if (e.target.id != 'shopping-basket-icon') {
			hidden = true;
			basketTriangle.style.display = 'none';
			basketItemsWrap.style.display = 'none';
		}
	}catch (e) {
		// Do nothing
	}
});