let tableUsers;
let rowTable;

document.addEventListener('DOMContentLoaded', function(){
    tableUsers = $('#tableUsers').DataTable({
		"aProcessing":true,
		"aServerSide":true,
		"ajax":{
			"url": `ajax/get_users`,
			"type": "post",
			"data":{
				"action" : "get",
				"hook" : "bee_hook"
			},
			"dataSrc":""
		},
		"columns":[
			{"data":"id"},
			{"data":"name"},
			{"data":"lastname"},
			{"data":"email"},
            {"data":"nombrerol"},
            {"data":"status"},
            {"data":"options"}
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
				"className": "btn btn-secondary"
			},{
				"extend": "excelHtml5",
				"text": "<i class='fas fa-file-excel'></i> Excel",
				"titleAttr":"Esportar a Excel",
				"className": "btn btn-success"
			},{
				"extend": "pdfHtml5",
				"text": "<i class='fas fa-file-pdf'></i> PDF",
				"titleAttr":"Esportar a PDF",
				"className": "btn btn-danger"
			},{
				"extend": "csvHtml5",
				"text": "<i class='fas fa-file-csv'></i> CSV",
				"titleAttr":"Esportar a CSV",
				"className": "btn btn-info"
			},{
				"extend": "colvis",
				"text": "<i class='fas fa-columns'></i> Columnas",
				"titleAttr":"Columnas visibles",
				"className": "btn btn-warning"
			}
		],
		'dom': 'lBfrtip',
		"language":{
			"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
		}

	}).buttons().container().appendTo('#tableRoles_wrapper .col-md-6:eq(0)');

	$('#formUser').validate({
		rules: {
			nameUser: {
				required: true,
				minlength: 2
			},
			lastnameUser: {
				required: true,
				minlength: 3
			},
			passwordUser: {
				// required: true,
				// minlength: 4
			},
			emailUser: {
				required: true,
				email: true
			},
			selectRoleUser: {
				required: true
			},
			selectEstatusUser: {
				required: true
			},
			claveUser:{
				number: true
			}
		},
		errorElement: 'span',
		errorPlacement: function (error, element) {
			error.addClass('invalid-feedback');
			element.closest('.form-group').append(error);
		},
		highlight: function (element, errorClass, validClass) {
			$(element).addClass('is-invalid');
		},
		unhighlight: function (element, errorClass, validClass) {
			$(element).removeClass('is-invalid');
		}
	});

	$('#formUser').on('submit', addUser);
	function addUser(event) {
		event.preventDefault();

		let form    = $('#formUser'),
		hook        = 'bee_hook',
		action      = 'add',
		data        = new FormData(form.get(0)),
		idUser = $("#idUser").val();
		data.append('hook', hook);
		data.append('action', action);

		// Campos Invalidos
		if(document.querySelector('.is-invalid')) {
			toastr.error('Hay campos que son invalidos en el formulario.', '¡Upss!');
			return;
		}

		// AJAX
		$.ajax({
		url: `ajax/add_user`,
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
	get_user_roles();
}, false);

function openModal(){

	document.querySelector("#idUser").value = "";
	document.querySelector('#titleModal').innerHTML = "Nuevo Usario";
	document.getElementById('headerModal').classList.replace("bg-info", "bg-dark");
	document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-success");
	document.querySelector('#btnText').innerHTML = "Guardar";
	document.querySelector("#formUser").reset();
	$(".select2bs4").change();
	$('#userModal').modal('show');
};


function get_user_roles() {
	let wrapper = $('#selectRoleUser'),
	hook        = 'bee_hook',
	action      = 'load';

	$.ajax({
		url: 'ajax/get_user_roles',
		type: 'POST',
		dataType: 'json',
		cache: false,
		data: {
		hook, action
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
	})
}

function fntView(iduser){

	let hook    = 'bee_hook',
	action      = 'load',
	idUser = iduser,
	wrapper     = $('#modalViewUser');

	$.ajax({
		url: `ajax/get_user`,
		type: 'POST',
		dataType: 'json',
		cache: false,
		data: {
		hook, action, idUser
	},
	beforeSend: function() {
		wrapper.waitMe();
	}
	}).done(function(res) {
		if(res.status === 201) {
			let estadoUsuario = res.data.status == 'active' ? 
			'<span class="badge badge-pill badge-success py-2 px-3">Activo</span>' : 
			'<span class="badge badge-pill badge-danger py-2 px-3">Inactivo</span>';

			$("#celId").html(res.data.clave);
			$("#celNombre").html(`${res.data.name} ${res.data.lastname}`);
			$("#celEmail").html(res.data.correo);
			$("#celTipo").html(res.data.role_name);
			$("#celEstatus").html(estadoUsuario);
			$("#celFecha").html(res.data.registro); 
			$("#celIp").html(res.data.ip_address); 
			$("#celExplorer").html(res.data.browser_user); 
			$("#celOs").html(res.data.os_user); 
			$("#celIngreso").html(res.data.date_login); 

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

function fntEditUser(iduser) {
	// rowTable = element.parentNode.parentNode.parentNode; 
	$('#titleModal').html("Editar Usuario");
	$('#headerModal').removeClass("bg-dark").addClass('bg-info');
	$('#btnActionForm').removeClass("btn-success").addClass("btn-info");
	$('#btnText').html("Actualizar");

	let hook    = 'bee_hook',
	action      = 'load',
	idUser = iduser,
	wrapper     = $('#modalViewUser');

	$.ajax({
		url: `ajax/get_user`,
		type: 'POST',
		dataType: 'json',
		cache: false,
		data: {
		hook, action, idUser
	},
	beforeSend: function() {
		wrapper.waitMe({effect : 'win8'});
	}
	}).done(function(res) {
	if(res.status === 201) {

		$("#idUser").val(res.data.id);
		$("#claveUser").val(res.data.clave);
		$("#nameUser").val(res.data.name);
		$("#lastnameUser").val(res.data.lastname);
		$("#emailUser").val(res.data.email);
		$("#selectRoleUser").val(res.data.id_rol);
		$("#selectStatusUser").val(res.data.status);
		
		$(".select2bs4").change();
		$('#userModal').modal('show');
	} else {
		toastr.error(res.msg, '¡Upss!');
	}
	}).fail(function(err) {
		toastr.error('Hubo un error en la petición', '¡Upss!');
	}).always(function() {
		wrapper.waitMe('hide');
	})
}

function fntDelUser(iduser) {
	Swal.fire({
		title: 'Eliminar Usuario',
		text: "¿Realmente quieres eliminar este Usuario?",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Si, Eliminar',
		cancelButtonText: 'No, Cancelar'
	}).then((result) => {
		
		if (result.isConfirmed) {
			let hook        = 'bee_hook',
			action      = 'delete',
			idUser = iduser;
			// AJAX
			$.ajax({
				url: `ajax/delete_user`,
				type: 'POST',
				dataType: 'json',
				cache: false,
				data: {
					hook, action , idUser
				}
			}).done(function(res) {
				if(res.status === 201) {
					Swal.fire("¡Eliminar!", res.msg , "success");
					$('#tableUsers').DataTable().ajax.reload();
				} else {
					Swal.fire("¡Atención!", res.msg , "error");
				}
			}).fail(function(err) {
				toastr.error('Hubo un error en la petición', '¡Upss!');
			});
		}
	});
}
