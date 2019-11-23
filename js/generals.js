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