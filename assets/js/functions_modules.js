let tableModules;

document.addEventListener('DOMContentLoaded', function(){
    tableModules = $('#tableModules').DataTable({
		"aProcessing":true,
		"aServerSide":true,
		"ajax":{
			"url": `modules/get_modules`,
			"dataSrc":""
		},
		"columns":[
			{"data":"id"},
			{"data":"nombre"},
			{"data":"icon"},
			{"data":"url"},
            {"data":"nombre_url"},
            {"data":"hijos"},
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

	$('#formModules').on('submit', addUser);
	function addUser(event) {
		event.preventDefault();

		let form    = $('#formModules'),
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
		url: `modules/add_module`,
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
			$('#modulesModal').modal("hide");
			$('#tableModules').DataTable().ajax.reload();
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

function openModal(){

	document.querySelector("#idModule").value = "";
	document.querySelector('#titleModal').innerHTML = "Nuevo Modulo";
	document.getElementById('headerModal').classList.replace("bg-info", "bg-dark");
	document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-success");
	document.querySelector('#btnText').innerHTML = "Guardar";
	document.querySelector("#formModule").reset();
	$(".select2bs4").change();
	$('#moduleModal').modal('show');
};
