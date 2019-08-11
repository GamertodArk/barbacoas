let count = __('count');
let inputFile = __('file');
// let titleInput = __('title');
let decrese = __('less_btn');
let increse = __('more_btn');
let dropzone = __('dropzone');
let submitBtn = __('submit_btn');
let galleryName = 'gallery_wrap';
// let descInput = __('description');
let files;
var counter = 1;
var success = [];

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

function show_error(input, msg) {
	__(input).style.opacity = 1;
	__(input).innerHTML = msg;
}

function insert_thumnail_wrapper(parent) {
	if (! __(galleryName)) {
		let div = document.createElement('div');
		div.setAttribute('id', galleryName);
		div.classList.add(galleryName);
		dropzone.appendChild(div);
	}
}

function process_images(files) {
	insert_thumnail_wrapper();

}

function load_preview2(file) {

	// Thumnail
	let thumnail = document.createElement('div');
	thumnail.setAttribute('id', 'thumnail');
	thumnail.classList.add('thumnail');

    var reader = new FileReader();
    
    reader.addEventListener("load", function() {
      var image = new Image();
      image.height = 100;
      image.title  = file.name;
      image.src    = this.result;
      thumnail.appendChild(image);
	__(galleryName).appendChild(thumnail);

    });
    
    reader.readAsDataURL(file);
}

function load_preview(files) {

	[].forEach.call(files, file => {


		// Make sure `file.name` matches our extensions criteria
	    if (/\.(jpe?g|png|gif)$/i.test(file.name)) {

	    	// Limitamos a un maximo de 4 imagenes por producto
	    	if (counter <= 4) {
	    	
	    		// Increase counter
	    		counter++;

				// Thumnail
				let thumnail = document.createElement('div');
				thumnail.setAttribute('id', 'thumnail');
				thumnail.classList.add('thumnail');

			    var reader = new FileReader();
			    
			    reader.addEventListener("load", function() {
			      var image = new Image();
			      image.height = 100;
			      image.title  = file.name;
			      image.src    = this.result;
			      thumnail.appendChild(image);
				__(galleryName).appendChild(thumnail);

			    });
			    
			    reader.readAsDataURL(file);

	    	}
	    }
	});
}


dropzone.addEventListener('drop', e => {
	e.preventDefault();
	dropzone.classList.remove('dragover');

	insert_thumnail_wrapper(dropzone);
	load_preview(e.dataTransfer.files);
	files = e.dataTransfer.files;
});

dropzone.addEventListener('dragover', e => {
	e.preventDefault();
	dropzone.classList.add('dragover');
});

dropzone.addEventListener('dragleave', e => {
	e.preventDefault();
	dropzone.classList.remove('dragover');
});

inputFile.addEventListener('change', e => {
	insert_thumnail_wrapper(dropzone);
	load_preview(e.target.files);
	files = e.target.files;
});

submitBtn.addEventListener('click', e => {
	e.preventDefault();
	

	// Check title/description existance and length
	['title', 'description'].forEach(e => {

		let min = (e == 'title' ? 6 : 15);
		let max = (e == 'title' ? 110 : 500); 

		if (__(e).value == '') {
			let msg = 'Este campo es abligatorio';
			show_error(`${e}-error`, msg);
		}else {
			if (__(e).value.length < min || __(e).value.length > max) {
				let msg = `La minima cantidad de caracteres es ${min} y la maxima es ${max}`;
				show_error(`${e}-error`, msg)
			}else {
				success.push(e);
			}
		}

	});

	// Count check
	if (count.value < 1 || count.value > 999) {
		let msg = 'La cantidad minima es 1 y la maxima es 999';
		show_error('amount-error', msg);
	}

	console.log(files);

	// // Check images
	// if (files.length < 1) {

	// }
});