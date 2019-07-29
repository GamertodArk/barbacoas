let count = __('count');
let decrese = __('less_btn');
let increse = __('more_btn');
let dropzone = __('dropzone');

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
 
function insert_thumnail_wrapper(parent) {
	let div = document.createElement('div');
	div.setAttribute('id', 'gallery_wrap');
	div.classList.add('gallery_wrap');
	parent.appendChild(div);
}

function load_preview(files) {

	for (var i = 0; i < files.length; i++) {

		// Image
		let img = new Image();
		img.style.width = '100%';
		// img.height = 100;
		// img.width = 100;


		// Thumnail
		let thumnail = document.createElement('div');
		thumnail.setAttribute('id', 'thumnail');
		thumnail.classList.add('thumnail');


		var reader  = new FileReader();

		reader.addEventListener("load", function () {
			img.src = reader.result;
		}, false);

		if (files[i]) {
			reader.readAsDataURL(files[i]);
			thumnail.appendChild(img);
			__('gallery_wrap').appendChild(thumnail);
		}
	}
}


dropzone.addEventListener('drop', e => {
	e.preventDefault();
	dropzone.classList.remove('dragover');

	insert_thumnail_wrapper(dropzone);
	load_preview(e.dataTransfer.files);
});

dropzone.addEventListener('dragover', e => {
	e.preventDefault();
	dropzone.classList.add('dragover');
});

dropzone.addEventListener('dragleave', e => {
	e.preventDefault();
	dropzone.classList.remove('dragover');
});