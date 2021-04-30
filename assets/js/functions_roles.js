let tableRoles;

// Initializes the plugin with options

document.addEventListener('DOMContentLoaded', function(){
    tableRoles = $('#tableRoles').DataTable({
		"aProcessing":true,
		"aServerSide":true,
		"ajax":{
			"url": `Roles/verRoles`,
			"dataSrc":""
		},
		"columns":[
			{"data":"id"},
			{"data":"nombre"},
			{"data":"descripcion"},
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

	// let formRol = document.querySelector("#formRol");

	$('#formRol').on('submit', addRol);
	function addRol(event) {
		event.preventDefault();

		let form    = $('#formRol'),
		hook        = 'bee_hook',
		action      = 'add',
		data        = new FormData(form.get(0)),
		intRol = $("#idRol").value,
		strNombre = $('#txtNombreRol').val(),
		strDescripcion = $('#txtDescripcionRol').val(),
		intStatus = $('#estatusRol').val();
		data.append('hook', hook);
		data.append('action', action);

		// Validar description
		if(strNombre === '' || strNombre.length < 2) {
			toastr.error('El campo Nombre es requerido, ingresa un nombre que sea valido para el Rol.', '¡Upss!');
		return;
		}
		// Validar description
		if(strDescripcion === '' || strDescripcion.length < 4) {
			toastr.error('Ingresa una descripción válida.', '¡Upss!');
		return;
		}
		// Validar Estatus
		if(intStatus === '' || intStatus < 0) {
			toastr.error('Selecciona el estatus del Rol.', '¡Upss!');
			return;
		}

		// AJAX
		$.ajax({
		url: `roles/post_agregar`,
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

	document.querySelector("#idRol").value = "";
	document.querySelector('#titleModal').innerHTML = "Nuevo Rol";
	document.getElementById('headerModal').classList.replace("bg-info", "bg-dark");
	document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-success");
	document.querySelector('#btnText').innerHTML = "Guardar";
	document.querySelector("#formRol").reset();

	$('#rolesModal').modal('show');
};

function fntEditRol(idrol){

	document.querySelector('#titleModal').innerHTML = "Actualizar Rol";
	document.getElementById('headerModal').classList.replace("bg-dark", "bg-info");
	document.querySelector('#btnActionForm').classList.replace("btn-success", "btn-info");
	document.querySelector('#btnText').innerHTML = "Actualizar";

	let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	let ajaxUrl = `roles/ver/${idrol}`;
	request.open("GET", ajaxUrl, true);
	request.send();

	request.onreadystatechange = function(){
		if (request.readyState == 4 && request.status == 200) {

			let objData = JSON.parse(request.responseText);

			if (objData.status) {

				document.querySelector("#idRol").value = objData.data.id;
				document.querySelector("#txtNombreRol").value = objData.data.nombre;
				document.querySelector("#txtDescripcionRol").value = objData.data.descripcion;

				let optionSelect;
				let htmlSelected;

				if (objData.data.estatus == 1) {
					optionSelect = '<option value="1" selected>Activo</option>';
					htmlSelected = `${optionSelect}
									<option value="2" class="">Inactivo</option>`;
				}else{
					optionSelect = '<option value="2" selected>Inactivo</option>';
					htmlSelected = `${optionSelect}
									<option value="1" class="">Activo</option>`;
				}

				document.querySelector("#estatusRol").innerHTML = htmlSelected;
				$('#rolesModal').modal('show');
			}else{
				toastr.error(objData.msg, '¡Upss!');
			}
		}
	}
};

function fntDelRol(idrol){

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

			let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			let ajaxUrl = `Roles/borrar`;
			let strData = `idRol=${idrol}`;
			request.open("POST", ajaxUrl, true);
			request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			request.send(strData);

			request.onreadystatechange = function(){
			
				if (request.readyState == 4 && request.status == 200) {

					let objData = JSON.parse(request.responseText);

					if (objData.status < 205) {

						Swal.fire("Eliminar", objData.msg, "success");

						$('#tableRoles').DataTable().ajax.reload();
						
					}else{

						toastr.error(objData.msg, '¡Upss!');

						$('#tableRoles').DataTable().ajax.reload();

					}
				}
			}
		}
	});
};

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
