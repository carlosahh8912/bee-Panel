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

	$('#formUser').on('submit', addUser);
	function addUser(event) {
		event.preventDefault();

		let form    = $('#formUser'),
		hook        = 'bee_hook',
		action      = 'add',
		data        = new FormData(form.get(0)),
		intRol = $("#idUser").val(),
		strClave = $('#txtClaveUser').val(),
		strNombre = $('#txtNombreUser').val(),
		strApellido = $('#txtApellidoUser').val(),
		strEmail = $('#txtEmail').val(),
		intEstatus = $('#selectEstatusUser').val(),
		intTipousuario = $('#selectTipoUser').val(),
		strPassword = $('#txtPassword').val();
		data.append('hook', hook);
		data.append('action', action);

		// Validar Nombre
		if(strNombre === '' || strNombre.length < 2) {
			toastr.error('El campo Nombre es requerido, ingresa un nombre que sea valido.', '¡Upss!');
		return;
		}
		// Validar Apellido
		if(strApellido === '' || strApellido.length < 2) {
			toastr.error('El campo Apellido es requerido, ingresa un apellido que sea valido.', '¡Upss!');
		return;
		}
		// Validar email
		if(strEmail === '') {
			toastr.error('El campo Email es requerido, ingresa un email que sea valido.', '¡Upss!');
		return;
		}
		// Validar Estatus
		if(intEstatus === '' || intEstatus < 0) {
			toastr.error('Selecciona el estatus del usuario.', '¡Upss!');
			return;
		}
		// Validar Rol
		if(intTipousuario === '' || intTipousuario < 0) {
			toastr.error('Selecciona el rol del usuario.', '¡Upss!');
			return;
		}

		// AJAX
		$.ajax({
		url: `users/post_agregar`,
		type: 'post',
		dataType: 'json',
		contentType: false,
		processData: false,
		cache: false,
		data : data,
		beforeSend: function() {
			form.waitMe({effect : 'win8'});
		}
		}).done(function(res) {
		if(res.status === 201) {
			toastr.success(res.msg, '¡Bien!');
			form.trigger('reset');
			$('#userModal').modal("hide");
			$('#tableUsers').DataTable().ajax.reload();
		} else {
			toastr.error(res.msg, '¡Upss!');
		}
		}).fail(function(err) {
		toastr.error('Hubo un error en la petición', '¡Upss!');
		}).always(function() {
		form.waitMe('hide');
		})
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