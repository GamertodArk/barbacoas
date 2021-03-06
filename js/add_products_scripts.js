let count = __('count');
let inputFile = __('file');
// let titleInput = __('title');
let decrese = __('less_btn');
let increse = __('more_btn');
let dropzone = __('dropzone');
let submitBtn = __('submit_btn');
let galleryName = 'gallery_wrap';
// let descInput = __('description');
let disableBtn = true;
let enable_permission = [];
let files;
var counter = 1;
var success = [];

/**
* This function decreases the amonut of products in the form
*/
decrese.addEventListener('click', e => {
	if (count.value != 0) {
		count.value = decrease_number(parseInt(count.value));
	}
});

/**
* This function increases the amonut of products in the form
*/
increse.addEventListener('click', e => {
	if (parseInt(count.value) < 999) {
		count.value = increase_number(parseInt(count.value));
	}else if(count.value == '') {
		count.value = 1;
	}
});


/**
* This function inserts the wrapper for the pictures thumbnails
*/
function insert_thumnail_wrapper(parent) {
	if (! __(galleryName)) {
		let div = document.createElement('div');
		div.setAttribute('id', galleryName);
		div.classList.add(galleryName);
		dropzone.appendChild(div);
	}
}


/**
* This function show an error message over an input
*/
function show_error(input, msg) {
	__(input).style.opacity = 1;
	__(input).innerHTML = msg;
}

/**
* This function hides an already shown error message of an input
*/
function hide_error(input) {
	__(input).style.opacity = 0;
}

function enable_btn(permission) {

	if (! enable_permission.includes(permission)) {
		enable_permission.push(permission);
	}

	if (enable_permission.length == 3) {
		// console.log('enable');
		disableBtn = false;
		submitBtn.classList.remove('disable');
	}
}


/**
* This function takes all images as a parameter and loop through all of them
* and load a thumbnail for every one of them
*/
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

inputFile.addEventListener('change', e => {
	if (e.target.files.length > 4) {
		inputFile.value = '';
		show_error('dropzone-error','Solo puedes elegir hasta un maximo de 4 imagenes');
	}else {
		insert_thumnail_wrapper(dropzone);
		load_preview(e.target.files);
		hide_error('dropzone-error');
		enable_btn('files-success');
	}
});


	['title', 'description'].forEach(elem => {

		let min = (elem == 'title' ? 6 : 15);
		let max = (elem == 'title' ? 110 : 500); 

		console.log(elem);

		// Trigger this event every time the user press a new
		// character in the inputs
		__(elem).addEventListener('keypress', event => {

			console.log('event triggered');

			// If input is empty
			if (__(elem).value == '') {
				let msg = 'Este campo es abligatorio';
				show_error(`${elem}-error`, msg);
			}else {

				// If input value is too small
				if (__(elem).value.length < min) {
					// let msg = `La minima cantidad de caracteres es ${min} y la maxima es ${max}`;
					let msg = `Debe de haber un minimo de ${min} caracteres`;
					show_error(`${elem}-error`, msg);

				// If input value is too big
				}else if(__(elem).value.length > max) {
					let msg = `Solo puede haber un maximo de ${min} caracteres`;
					show_error(`${elem}-error`, msg);

				// Hide error inputs
				}else {
					hide_error(`${elem}-error`);
					enable_btn(`${elem}-success`);
				}

			}

		});
	});

submitBtn.addEventListener('click', e => {
	if (disableBtn) {
		e.preventDefault();
		console.log('disable');
	}
});