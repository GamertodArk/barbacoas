let count = __('count');
let fileInput = __('file');
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
		// parent.appendChild(div);
		dropzone.appendChild(div);

	}
}

function process_images(files) {
	insert_thumnail_wrapper();

	[].forEach.call(files, file => {
		if ( /\.(jpe?g|png|gif)$/i.test(file.name) && counter <= 4 ) {
			counter++;
			load_preview2(file);
			send_file();
		}
	});
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

function send_file(file) {

	let data = new FormData();
	data.append('file', file);
	data.append('test', 'valueTest');

	let options = {
		method: 'POST',
		// headers: {
		// 	'Content-Type': 'multipart/form-data'
		// },
		body: data
	}

	fetch('upload_picture', options)
	.then(response => response.text())
	.then(text => console.log(text));

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

	// insert_thumnail_wrapper(dropzone);
	// load_preview(e.dataTransfer.files);
	process_images(e.dataTransfer.files);
});

dropzone.addEventListener('dragover', e => {
	e.preventDefault();
	dropzone.classList.add('dragover');
});

dropzone.addEventListener('dragleave', e => {
	e.preventDefault();
	dropzone.classList.remove('dragover');
});

fileInput.addEventListener('change', e => {
	// insert_thumnail_wrapper(dropzone);
	// load_preview(e.target.files);
	process_images(e.target.files);	
});