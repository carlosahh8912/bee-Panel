function controlTag(e){
	tecla = (document.all) ? e.keyCode : e.which;
	if (tecla==8) return true;
	else if(tecla==0||tecla==9) return true;
	patron =/[0-9\s]/;
	n = String.fromCharCode(tecla);
	return patron.test(n);
}

function testText(txtString){
	let stringText = new RegExp(/^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/);
	if (stringText.test(txtString)) {
		return true;
	}else{
		return false;
	}
}

function testEntero(intCant){
	let intCantidad = new RegExp(/^([0-9])*$/);
	if (intCantidad.test(intCant)) {
		return true;
	}else{
		return false;
	}
}

function fntEmailValidate(email){
	let stringEmail = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);
	if (stringEmail.test(email) == false) {
		return false;
	}else{
		return true;
	}
}


function fntValidText(){
	let validText = document.querySelectorAll(".validText");
	validText.forEach(function(validText){
		validText.addEventListener('keyup', function(){
			let inputValue = this.value;
			if (!testText(inputValue)) {
				this.classList.add('is-invalid');
			}else{
				this.classList.remove('is-invalid');
			}
		});
	});
}

function fntValidNumber(){
	let validNumber = document.querySelectorAll(".validNumber");
	validNumber.forEach(function(validNumber){
		validNumber.addEventListener('keyup', function(){
			let inputValue = this.value;
			if (!testEntero(inputValue)) {
				this.classList.add('is-invalid');
			}else{
				this.classList.remove('is-invalid');
			}
		});
	});
}

function fntValidEmail(){
	let validEmail = document.querySelectorAll(".validEmail");
	validEmail.forEach(function(validEmail){
		validEmail.addEventListener('keyup', function(){
			let inputValue = this.value;
			if (!fntEmailValidate(inputValue)) {
				this.classList.add('is-invalid');
				// this.insertAdjacentHTML('afterend', '<small class="form-text text-danger">Correo no valido.</small>');
			}else{
				this.classList.remove('is-invalid');
				// document.querySelector('.form-text').remove();
			}
		});
	});
}

window.addEventListener('load', function(){
	fntValidText();
	fntValidNumber();
	fntValidEmail();
}, false);


// Dark mode del template
const swdm = document.querySelector('#customSwitch3');
const dmicon = document.querySelector('#dm-icon');

function dark(){
	document.body.classList.add('dark-mode');
	swdm.setAttribute('checked', "");
	dmicon.classList.remove('fa-sun');
	dmicon.classList.add('fa-moon');
	document.querySelector('.custom-control-label').classList.add('text-info');
	document.querySelector('.custom-control-label').classList.remove('text-warning');
}
function ligth(){
	document.body.classList.remove('dark-mode');
	swdm.removeAttribute('checked', "");
	dmicon.classList.add('fa-sun');
	dmicon.classList.remove('fa-moon');
	document.querySelector('.custom-control-label').classList.add('text-warning');
	document.querySelector('.custom-control-label').classList.remove('text-info');
}
function darkMode(){
	if(window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches){
		dark();
	}else{
		ligth();
	}
}

if(localStorage.getItem('dark-mode') === 'true'){
	dark();
}else{
	ligth();
}

swdm.addEventListener('click', () => {
	document.body.classList.toggle('dark-mode');
	swdm.setAttribute('checked', "");

	if(document.body.classList.contains('dark-mode')){
		localStorage.setItem('dark-mode', 'true');
		dark();
	}else{
		localStorage.setItem('dark-mode', 'false');
		ligth();
	}
});
