let count = __('count');
let decrese = __('less_btn');
let increse = __('more_btn');

decrese.addEventListener('click', e => {
	if (count.value != 0) {
		count.value = decrease_number(parseInt(count.value));
	}
});

increse.addEventListener('click', e => {
	if (parseInt(count.value) < 999) {
		count.value = increase_number(parseInt(count.value));
	}else if(count.value == '') {
		count.value = 1;
	}
});