let btn = __("sub_btn");
let name = __("name");

btn.addEventListener('click', e => {
	e.preventDefault();

	// console.log(__("name-error"));

	let inputs = ['name', 'username','lastname', 'email', 'pass', 'pass2'];

	for (var i = inputs.length - 1; i >= 0; i--) {
		// inputs[i]
		if (__(inputs[i]).value == "") {
			__(`${inputs[i]}-error`).style.opacity = 1;
			__(`${inputs[i]}-error`).innerHTML = "Este campo es abligatorio";
		}else if(__(inputs[i]).value.length < 8) {
			__(`${inputs[i]}-error`).style.opacity = 1;
			__(`${inputs[i]}-error`).innerHTML = "Este campo debe tener minimo 8 caracteres";		
		}else {
			__(`${inputs[i]}-error`).style.opacity = 0;
		}
	}

	// checking password equality
	if (__("pass").value != __("pass2").value) {
		__("pass2-error").innerHTML = "Las contraseñas no coinciden";
		__("pass2-error").style.opacity = 1;
	}else { __("pass2-error").style.opacity = 0; }

	// Name validation
	// if (name.value == "") {
	// 	__("name-error").style.display = "inline";
	// 	__("name-error").innerHTML = "Este campo es abligatorio";
	// }else if(name.value.length < 8) {
	// 	__("name-error").style.display = "inline";
	// 	__("name-error").innerHTML = "Este campo debe tener minimo 8 caracteres";		
	// }else {
	// 	__("name-error").style.display = "none";
	// }

	// alert("Hello World");
});