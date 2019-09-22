let counter = __('counter');
let moreBtn = __('more_btn');
let lessBtn = __('less_btn');
let closeBtn = __('close_btn');
let productWrap = __('product_wrap');


let modalWrap = __('modal-background');
let modalLoadingBox = __('loading-wrap')
let viewBtns = [...document.getElementsByClassName('view_item_btn')];


function insert_data_to_modal(data) {
	let productTitle = __('product_title');
	let productDesc = __('product_desc');
	let moreBtnMaxAmount = __('more_btn');

	productTitle.innerHTML = data.title;
	productDesc.innerHTML = data.description;
	moreBtnMaxAmount.setAttribute('data-max-amount', data.amount);
}


// Loop through all item btns
viewBtns.forEach(elem => {
	elem.addEventListener('click', e => {
		// Show the modal wrap
		modalWrap.style.display = 'flex';

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
	let maxCounter = moreBtn.getAttribute('data-max-amount');
	let currentCounter = counter.value != '' ? parseInt(counter.value) : 0;
	if (currentCounter < maxCounter) {
		let newCounter = (currentCounter + 1);
		counter.value = newCounter;
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