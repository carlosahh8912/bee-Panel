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
			toastr.error('Hay campos que son invalidos en el formulario.', '¡Upss!');
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
			toastr.success(res.msg, '¡Bien!');
			form.trigger('reset');
			$('#moduleModal').modal("hide");
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
	document.getElementById('headerModal').classList.replace("bg-gradient-info", "bg-gradient-dark");
	document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-success");
	document.querySelector('#btnText').innerHTML = "Guardar";
	document.querySelector("#formModule").reset();
	$(".select2bs4").change();
	$('#moduleModal').modal('show');
};

function fntEditModule(idproduct) {
	// rowTable = element.parentNode.parentNode.parentNode; 
	$('#titleModal').html("Editar Modulo");
	$('#headerModal').removeClass("bg-gradient-primary").addClass('bg-gradient-success');
	$("#formModule").trigger('reset');
	$('#btnActionForm').removeClass("btn-gradient-primary").addClass("btn-gradient-success");
	$('#btnText').html("Actualizar");

	let hook    = 'bee_hook',
	action      = 'load',
	wrapper     = $('#productModal');

	$.ajax({
		url: `ajax/show_product/${idproduct}`,
		type: 'POST',
		dataType: 'json',
		cache: false,
		data: {
		hook, action
	},
	beforeSend: function() {
		wrapper.waitMe({effect : 'facebook'});
	}
	}).done(function(res) {
	if(res.status === 201) {

		$("#idProduct").val(res.data.id);
		$("#nameProduct").val(res.data.description);
		$("#costProduct").val(res.data.cost);
		$("#priceProduct").val(res.data.price);
		$("#dateProduct").val(res.data.shopping_at);
		$("#addressProduct").val(res.data.address);
		$("#SelectProductBrand").val(res.data.id_brand);
		$("#selectProductStatus").val(res.data.status);

		$(".select2").change();
		$('#productModal').modal('show');
	} else {
		toastr.error(res.msg, '¡Upss!');
	}
	}).fail(function(err) {
		toastr.error('Hubo un error en la petición', '¡Upss!');
	}).always(function() {
		wrapper.waitMe('hide');
	})
}

function fntDelProduct(idproduct) {
	Swal.fire({
		title: 'Eliminar Producto',
		text: "¿Realmente quieres eliminar este Producto?",
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
			idProduct = idproduct;
			// AJAX
			$.ajax({
				url: `ajax/delete_product`,
				type: 'POST',
				dataType: 'json',
				cache: false,
				data: {
					hook, action , idProduct
				}
			}).done(function(res) {
				if(res.status === 200) {
					Swal.fire("¡Eliminar!", res.msg , "success");
					$('#productsTable').DataTable().ajax.reload();
				} else {
					Swal.fire("¡Atención!", res.msg , "error");
				}
			}).fail(function(err) {
				toastr.error('Hubo un error en la petición', '¡Upss!');
			});
		}
	});
}