let tableRoles;

// Initializes the plugin with options

document.addEventListener('DOMContentLoaded', function(){
    tableRoles = $('#tableRoles').DataTable({
		"aProcessing":true,
		"aServerSide":true,
		"ajax":{
			"url": `ajax/get_roles`,
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
			{"data":"description"},
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

	$('#formRol').validate({
		rules: {
			nameRole: {
				required: true,
				minlength: 3
			},
			descriptionRole: {
				required: true,
				minlength: 5
			},
			selectStatusRole: {
				required: true
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

	$('#formRol').on('submit', addRol);
	function addRol(event) {
		event.preventDefault();

		let form    = $('#formRol'),
		hook        = 'bee_hook',
		action      = 'add',
		data        = new FormData(form.get(0)),
		intRol = $("#idRole").value;
		data.append('hook', hook);
		data.append('action', action);

		// Campos Invalidos
		if(document.querySelector('.is-invalid')) {
			toastr.error('Hay campos que son invalidos en el formulario.', '¡Upss!');
			return;
		}

		// AJAX
		$.ajax({
		url: `ajax/add_role`,
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
			$('#rolesModal').modal("hide");
			$('#tableRoles').DataTable().ajax.reload();
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

	document.querySelector("#idRole").value = "";
	document.querySelector('#titleModal').innerHTML = "Nuevo Modulo";
	document.getElementById('headerModal').classList.replace("bg-gradient-info", "bg-gradient-dark");
	document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-success");
	document.querySelector('#btnText').innerHTML = "Guardar";
	document.querySelector("#formRol").reset();
	$(".select2bs4").change();
	$('#rolesModal').modal('show');
};

function fntEditRol(idrole) {
	// rowTable = element.parentNode.parentNode.parentNode; 
	$('#titleModal').html("Editar Rol");
	$('#headerModal').removeClass("bg-gradient-dark").addClass('bg-gradient-info');
	$("#formRol").trigger('reset');
	$('#btnActionForm').removeClass("btn-success").addClass("btn-info");
	$('#btnText').html("Actualizar");

	let hook    = 'bee_hook',
	action      = 'load',
	idRole = idrole
	wrapper     = $('#rolesModal');

	$.ajax({
		url: `ajax/show_role`,
		type: 'POST',
		dataType: 'json',
		cache: false,
		data: {
		hook, action, idRole
	},
	beforeSend: function() {
		wrapper.waitMe({effect : 'win8'});
	}
	}).done(function(res) {
	if(res.status === 201) {

		$("#idRole").val(res.data.id);
		$("#nameRole").val(res.data.name);
		$("#descriptionRole").val(res.data.description);
		$("#selectStatusRole").val(res.data.status);

		$(".select2bs4").change();
		$('#rolesModal').modal('show');
	} else {
		toastr.error(res.msg, '¡Upss!');
	}
	}).fail(function(err) {
		toastr.error('Hubo un error en la petición', '¡Upss!');
	}).always(function() {
		wrapper.waitMe('hide');
	})
}

function fntDelRol(idrole) {
	Swal.fire({
		title: 'Eliminar Rol',
		text: "¿Realmente quieres eliminar este Rol?",
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
			idRole = idrole;
			// AJAX
			$.ajax({
				url: `ajax/delete_role`,
				type: 'POST',
				dataType: 'json',
				cache: false,
				data: {
					hook, action , idRole
				}
			}).done(function(res) {
				if(res.status === 201) {
					toastr.success(res.msg, '¡Bien!');
					$('#tableRoles').DataTable().ajax.reload();
				} else {
					toastr.error(res.msg, '¡Upsss!');
				}
			}).fail(function(err) {
				toastr.error('Hubo un error en la petición', '¡Upss!');
			});
		}
	});
}

function fntPermisos(idrol){

    // let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    // let ajaxUrl = `${base_url}Permisos/getPermisosRol/${idrol}`;
    // request.open("GET",ajaxUrl,true);
    // request.send();

    // request.onreadystatechange = function(){
    //     if(request.readyState == 4 && request.status == 200){
    //         document.querySelector('#contentAjax').innerHTML = request.responseText;
    //         $('.modalPermisos').modal('show');
    //         document.querySelector('#formPermisos').addEventListener('submit',fntSavePermisos,false);

    //         tableRoles.ajax.reload(function(){});

    //     }
    // }

	$('#modalPermisos').modal('show');
};
