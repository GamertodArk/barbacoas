let btn = __('login_btn');
let email = __('email');
let pass = __('pass');
let fields = ['email', 'pass'];

btn.addEventListener('click', e => {
	e.preventDefault();

	// Check for the fields
	for (var i = 0; i < fields.length; i++) {
		if (__(fields[i]).value == '') {
			__(`${fields[i]}-error`).style.opacity = 1;
			__(`${fields[i]}-error`).innerHTML = 'Este campo es necesario';
		}else {
			__(`${fields[i]}-error`).innerHTML = '';
			__(`${fields[i]}-error`).style.opacity = 0;
		}
	}

	
});