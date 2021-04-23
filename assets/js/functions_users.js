let tableUsers;

document.addEventListener('DOMContentLoaded', function(){
    tableUsers = $('#tableUsers').DataTable({
		"aProcessing":true,
		"aServerSide":true,
		"ajax":{
			"url": `users/verTodos`,
			"dataSrc":""
		},
		"columns":[
			{"data":"id"},
			{"data":"nombre"},
			{"data":"apellido"},
			{"data":"correo"},
            {"data":"nombrerol"},
            {"data":"estatus"},
            {"data":"opciones"}
		],
		"responsive": true, 
		"lengthChange": false, 
		"autoWidth": false,
		"bDestroy":true,
		'buttons': [
			{
				"extend": "copyHtml5",
				"text": "<i class='far fa-copy'></i> Copiar",
				"titleAttr":"Copiar",
				"className": "btn bg-gradient-secondary"
			},{
				"extend": "excelHtml5",
				"text": "<i class='fas fa-file-excel'></i> Excel",
				"titleAttr":"Esportar a Excel",
				"className": "btn bg-gradient-success"
			},{
				"extend": "pdfHtml5",
				"text": "<i class='fas fa-file-pdf'></i> PDF",
				"titleAttr":"Esportar a PDF",
				"className": "btn bg-gradient-danger"
			},{
				"extend": "csvHtml5",
				"text": "<i class='fas fa-file-csv'></i> CSV",
				"titleAttr":"Esportar a CSV",
				"className": "btn bg-gradient-info"
			},{
				"extend": "colvis",
				"text": "<i class='fas fa-columns'></i> Columnas",
				"titleAttr":"Columnas visibles",
				"className": "btn bg-gradient-warning"
			}
		],
		'dom': 'lBfrtip',
		"language":{
			"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
		}

	}).buttons().container().appendTo('#tableRoles_wrapper .col-md-6:eq(0)');

	let formUser = document.querySelector("#formUser");
	formUser.onsubmit = function(e){
		e.preventDefault();

		let intRol = document.querySelector("#idUser").value,
		strNombre = document.querySelector('#txtNombreUser').value,
		strApellido = document.querySelector('#txtApellidoUser').value,
		strEmail = document.querySelector('#txtEmail').value,
		intStatus = document.querySelector('#selectEstatusUser').value,
		intTipousuario = document.querySelector('#selectRolUser').value,
		strPassword = document.querySelector('#txtPassword').value;
		
		// Validar description
		if(strNombre === '' || strNombre.length < 4) {
			toastr.error('El campo Nombre es requerido, ingresa un nombre que sea valido.', '¡Upss!');
		return;
		}
		// Validar description
		if(strApellido === '' || strDescripcion.length < 4) {
			toastr.error('Ingresa un apellido valido.', '¡Upss!');
		return;
		}
		// Validar Estatus
		if(intStatus === '' || intStatus < 0) {
			toastr.error('Selecciona el estatus del usuario.', '¡Upss!');
			return;
		}

		let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		let ajaxUrl = `roles/post_agregar`;
		let formData = new FormData(formRol);
		request.open("POST",ajaxUrl,true);
		request.send(formData);
		request.onreadystatechange = function(){
			$('#formRol').waitMe();
			
			if (request.readyState == 4 && request.status == 200) {

				let objData = JSON.parse(request.responseText);

				if (objData.status < 205) {
					$('#formRol').waitMe('hide');
					$('#rolesModal').modal("hide");
					formRol.reset();
					toastr.success(objData.msg, '¡Bien!');
					$('#tableRoles').DataTable().ajax.reload();
				}else{
					toastr.error(objData.msg, '¡Upss!');
					$('#formRol').waitMe('hide');
				}
				
			}
		}
	}
});

window.addEventListener('load', function(){
	getUserRoles();
}, false);

function openModal(){

	document.querySelector("#idUser").value = "";
	document.querySelector('#titleModal').innerHTML = "Nuevo Usario";
	document.getElementById('headerModal').classList.replace("bg-info", "bg-dark");
	document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-success");
	document.querySelector('#btnText').innerHTML = "Guardar";
	document.querySelector("#formUser").reset();

	$('#userModal').modal('show');
};


function getUserRoles() {
	let wrapper = $('#selectTipoUser'),
	hook        = 'bee_hook',
	action      = 'load';

	$.ajax({
		url: 'roles/get_roles',
		type: 'POST',
		dataType: 'json',
		cache: false,
		data: {
		hook, action
	},
	beforeSend: function() {
		// wrapper.waitMe();
	}
	}).done(function(res) {
		if(res.status === 200) {
			wrapper.html(res.data);
			wrapper.val(1);
		} else {
			toastr.error(res.msg, '¡Upss!');
			wrapper.html('');
		}
	}).fail(function(err) {
		toastr.error('Hubo un error en la petición', '¡Upss!');
		wrapper.html('');
	}).always(function() {
		// wrapper.waitMe('hide');
	})
}

function fntView(iduser){

	let hook    = 'bee_hook',
	action      = 'load',
	wrapper     = $('#modalViewUser');

	$.ajax({
		url: `users/get_user/${iduser}`,
		type: 'POST',
		dataType: 'json',
		cache: false,
		data: {
		hook, action
	},
	beforeSend: function() {
		wrapper.waitMe();
	}
	}).done(function(res) {
		if(res.status === 201) {
			let estadoUsuario = res.data.estatus == 1 ? 
			'<span class="badge badge-success py-2 px-3">Activo</span>' : 
			'<span class="badge badge-danger py-2 px-3">Inactivo</span>';

			$("#celId").html(res.data.clave);
			$("#celNombre").html(`${res.data.nombre} ${res.data.apellido}`);
			$("#celEmail").html(res.data.correo);
			$("#celTipo").html(res.data.nombrerol);
			$("#celEstatus").html(estadoUsuario);
			$("#celFecha").html(res.data.registro); 
			$("#celIp").html(res.data.ip_address); 
			$("#celExplorer").html(res.data.os_user); 
			$("#celOs").html(res.data.explorer_user); 
			$("#celIngreso").html(res.data.ingreso); 

			$('#modalViewUser').modal('show');
		} else {
			toastr.error(res.msg, '¡Upss!');
			// wrapper.html('');
		}
	}).fail(function(err) {
		toastr.error('Hubo un error en la petición', '¡Upss!');
	}).always(function() {
		wrapper.waitMe('hide');
	})
}