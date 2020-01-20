let btn = __("sub_btn");
let name = __("name");
let loading_modal = __("loading-modal-wrap");

btn.addEventListener('click', e => {
	e.preventDefault();

	// Show loading modal
	loading_modal.style.display = 'flex';


	// This array hold all the inputs permissions
	let permisos = [];


	let long_inputs = ['username', 'email', 'pass', 'pass2'];
	let short_input = ['name', 'lastname'];

	for (var i = long_inputs.length - 1; i >= 0; i--) {

		if (__(long_inputs[i]).value == "") {
			__(`${long_inputs[i]}-error`).style.opacity = 1;
			__(`${long_inputs[i]}-error`).innerHTML = "Este campo es abligatorio";
		}else if(__(long_inputs[i]).value.length < 8) {
			__(`${long_inputs[i]}-error`).style.opacity = 1;
			__(`${long_inputs[i]}-error`).innerHTML = "Este campo debe tener minimo 8 caracteres";		
		}else {
			permisos.push(`${long_inputs}-success`);
			__(`${long_inputs[i]}-error`).style.opacity = 0;
		}
	}

	for (var i = 0; i < short_input.length; i++) {
		short_input[i]
		if (__(short_input[i]).value == "") {
			__(`${short_input[i]}-error`).style.opacity = 1;
			__(`${short_input[i]}-error`).innerHTML = "Este campo es abligatorio";
		}else if(__(short_input[i]).value.length < 2) {
			__(`${short_input[i]}-error`).style.opacity = 1;
			__(`${short_input[i]}-error`).innerHTML = "Este campo debe tener minimo 2 caracteres";		
		}else {
			permisos.push(`${long_inputs}-success`);
			__(`${short_input[i]}-error`).style.opacity = 0;
		}
	}

	// checking password equality
	if (__("pass").value != __("pass2").value) {
		__("pass2-error").innerHTML = "Las contraseñas no coinciden";
		__("pass2-error").style.opacity = 1;
	}else { 
		permisos.push(`${long_inputs}-success`);
		__("pass2-error").style.opacity = 0; 
	}

	// Validating location
	let loca_vali = ['countryId', 'stateId', 'cityId'];

	for (var i = 0; i < loca_vali.length; i++) {
		if (__(loca_vali[i]).value == "") {
			__("location-error").style.opacity = 1;
			__("location-error").innerHTML = "Selecione un pais, un estado y una ciudad";
		}else {
			permisos.push(`${long_inputs}-success`);
			__("location-error").style.opacity = 0;
		}
	}

	
	if (permisos.length == 10) {
	
		let json = {
			name: __("name").value,
			lastname: __('lastname').value,
			email: __('email').value,
			username: __('username').value,
			password: __('pass').value,
			country: __('countryId').value,
			state: __('stateId').value,
			city: __('cityId').value
		}

		// Send data to server
		fetch(`addUser`, {
			method: 'POST',
			body: `data=${JSON.stringify(json)}`,
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			}
		})
			.then(response => response.json())
			.then(json => {

				if (json.error) {
					loading_modal.style.display = 'none';
					__(`${json.field}-error`).style.opacity = 1;
					__(`${json.field}-error`).innerHTML = json.message;

				}else {window.location = 'done'}
			})
			.catch(error => console.log(error.message));

	}else {
		loading_modal.style.display = 'none';
	}

	// Clean all permissions
	permisos = [];
});