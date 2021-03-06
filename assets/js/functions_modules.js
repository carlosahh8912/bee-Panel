document.addEventListener('DOMContentLoaded', function(){
    $('#tableModules').DataTable({
		"aProcessing":true,
		"aServerSide":true,
		"ajax":{
			"url": `ajax/get_modules`,
			"type": "post",
			"data":{
				"action" : "get",
				"hook" : "bee_hook"
			},
			"dataSrc":"data"
		},
		"columns":[
			{"data":"id"},
			{"data":"name"},
			{"data":"icon"},
			{"data":"url"},
            {"data":"url_name"},
            {"data":"children"},
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

	$('#formModule').validate({
		rules: {
			nameModule: {
				required: true,
				minlength: 3
			},
			iconModule: {
				required: true,
				minlength: 5
			},
			urlModule: {
				required: true,
				minlength: 3
			},
			activeModule: {
				required: true,
				minlength: 3
			},
			selectTypeModule: {
				required: true
			},
			selectEstatusModule: {
				required: true
			}
		},
		messages: {
			nameModule: {
				required: "Nombre del Modulo requerido.",
				minlength: "El Nombre del Modulo debe ser mayor a 3 caracteres."
			},
			iconModule: {
				required: "El Icono del Modulo es requerido.",
				minlength: "El Icono debe ser mayor a 5 caracteres."
			},
			urlModule: {
				required: "La URL es requerida.",
				minlength: "La URL debe ser mayor a 3 caracteres."
			},
			activeModule: {
				required: "La URL activa es requerida.",
				minlength: "La URL activa debe ser mayor a 3 caracteres."
			},
			selectTypeModule: {
				required: "Selecciona un tipo de Modulo"
			},
			selectEstatusModule: {
				required: "Selecciona el estatus del Modulo."
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

	$('#formModule').on('submit', add_module);
	function add_module(event) {
		event.preventDefault();

		let form    = $('#formModule'),
		hook        = 'bee_hook',
		action      = 'add',
		data        = new FormData(form.get(0)),
		idModule = $("#idModule").val();
		data.append('hook', hook);
		data.append('action', action);

		// Campos Invalidos
		if(document.querySelector('.is-invalid')) {
			toastr.error('Hay campos que son invalidos en el formulario.', '??Upss!');
			return;
		}


		// AJAX
		$.ajax({
		url: `ajax/add_module`,
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
			toastr.success(res.msg, '??Bien!');
			form.trigger('reset');
			$('#moduleModal').modal("hide");
			$('#tableModules').DataTable().ajax.reload();
		} else {
			toastr.error(res.msg, '??Upss!');
		}
		}).fail(function(err) {
            toastr.error('Hubo un error en la petici??n', '??Upss!');
		}).always(function() {
            form.waitMe('hide');
		})
	}
});

function openModal(){

	document.querySelector("#idModule").value = "";
	document.querySelector('#titleModal').innerHTML = "Nuevo Modulo";
	document.getElementById('headerModal').classList.replace("bg-gradient-info", "bg-gradient-dark");
	document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-success");
	document.querySelector('#btnText').innerHTML = "Guardar";
	document.querySelector("#formModule").reset();
	$(".select2bs4").change();
	$('#moduleModal').modal('show');
};

function fntEditModule(idmodule) {
	// rowTable = element.parentNode.parentNode.parentNode; 
	$('#titleModal').html("Editar Modulo");
	$('#headerModal').removeClass("bg-gradient-primary").addClass('bg-gradient-success');
	$("#formModule").trigger('reset');
	$('#btnActionForm').removeClass("btn-gradient-primary").addClass("btn-gradient-success");
	$('#btnText').html("Actualizar");

	let hook    = 'bee_hook',
	action      = 'load',
	idModule = idmodule
	wrapper     = $('#moduleModal');

	$.ajax({
		url: `ajax/show_module`,
		type: 'POST',
		dataType: 'json',
		cache: false,
		data: {
		hook, action, idModule
	},
	beforeSend: function() {
		wrapper.waitMe({effect : 'win8'});
	}
	}).done(function(res) {
	if(res.status === 201) {

		$("#idModule").val(res.data.id);
		$("#nameModule").val(res.data.name);
		$("#iconModule").val(res.data.icon);
		$("#urlModule").val(res.data.url);
		$("#activeModule").val(res.data.url_name);
		$("#selectStatusModule").val(res.data.status);
		$("#selectTypeModule").val(res.data.treeview);

		$(".select2bs4").change();
		$('#moduleModal').modal('show');
	} else {
		toastr.error(res.msg, '??Upss!');
	}
	}).fail(function(err) {
		toastr.error('Hubo un error en la petici??n', '??Upss!');
	}).always(function() {
		wrapper.waitMe('hide');
	})
}

function fntDelModule(idmodule) {
	Swal.fire({
		title: 'Eliminar Modulo',
		text: "??Realmente quieres eliminar este Modulo?",
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
			idModule = idmodule;
			// AJAX
			$.ajax({
				url: `ajax/delete_module`,
				type: 'POST',
				dataType: 'json',
				cache: false,
				data: {
					hook, action , idModule
				}
			}).done(function(res) {
				if(res.status === 200) {
					Swal.fire("??Eliminar!", res.msg , "success");
					$('#tableModules').DataTable().ajax.reload();
				} else {
					Swal.fire("??Atenci??n!", res.msg , "error");
				}
			}).fail(function(err) {
				toastr.error('Hubo un error en la petici??n', '??Upss!');
			});
		}
	});
}