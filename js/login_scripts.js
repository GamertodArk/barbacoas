let btn = __('login_btn');
let email = __('email');
let pass = __('pass');
let fields = ['email', 'pass'];
let permissions = [];

btn.addEventListener('click', e => {
	e.preventDefault();

	// Show modal wrap 
	__('loading-modal-wrap').style.display = 'flex';
	__('error-message').style.opacity = 0;


	// Check for the fields
	for (var i = 0; i < fields.length; i++) {
		if (__(fields[i]).value == '') {
			__(`${fields[i]}-error`).style.opacity = 1;
			__(`${fields[i]}-error`).innerHTML = 'Este campo es necesario';
		}else {
			permissions.push(`${fields[i]}-success`);
			__(`${fields[i]}-error`).innerHTML = '';
			__(`${fields[i]}-error`).style.opacity = 0;
		}
	}

	if (permissions.length == 2) {

		let json = {
			email: __('email').value,
			password: __('pass').value
		}

		fetch('verify', {
			method: 'POST',
			body: `data=${JSON.stringify(json)}`,
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			}
		})
		.then(response => response.json())
		.then(json => {
			if (json.error) {
				// Mostrar mensaje de error
				// o redireccionar al usuario
				__('error-message').style.opacity = 1;
				__('loading-modal-wrap').style.display = 'none';
			}else {
				window.location.href = 'done';
			}

			console.log(json);
		})
		.catch(err => console.log(err.message));

	}else {
		permissions = [];
		__('loading-modal-wrap').style.display = 'none';
	}
});