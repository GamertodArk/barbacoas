let count = __('count');
let decrese = __('less_btn');
let increse = __('more_btn');
let dropzone = __('dropzone');
let galleryName = 'gallery_wrap';
var counter = 1;

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
	if (! __(galleryName)) {
		let div = document.createElement('div');
		div.setAttribute('id', galleryName);
		div.classList.add(galleryName);
		parent.appendChild(div);
	}
}

function load_preview(files) {

	for (var i = 0; i < files.length; i++) {

		if (counter <= 4)  {
			counter++;
			console.log(counter);

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
				__(galleryName).appendChild(thumnail);
				// dropzone.appendChild
			}
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