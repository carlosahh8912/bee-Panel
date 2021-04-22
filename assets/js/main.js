// Dark mode del template
const swdm = document.querySelector('#customSwitch3');
const dmicon = document.querySelector('#dm-icon');

swdm.addEventListener('click', () => {
  document.body.classList.toggle('dark-mode');
  swdm.setAttribute('checked', "");

  if(document.body.classList.contains('dark-mode')){
    localStorage.setItem('dark-mode', 'true');
    dmicon.classList.remove('fa-sun');
    dmicon.classList.add('fa-moon');
    document.querySelector('.custom-control-label').classList.add('text-info');
    document.querySelector('.custom-control-label').classList.remove('text-warning');
  }else{
    localStorage.setItem('dark-mode', 'false');
    dmicon.classList.add('fa-sun');
    dmicon.classList.remove('fa-moon');
    document.querySelector('.custom-control-label').classList.add('text-warning');
    document.querySelector('.custom-control-label').classList.remove('text-info');
  }
});

if(localStorage.getItem('dark-mode') === 'true'){
  document.body.classList.add('dark-mode');
  swdm.setAttribute('checked', "");
  dmicon.classList.remove('fa-sun');
  dmicon.classList.add('fa-moon');
  document.querySelector('.custom-control-label').classList.add('text-info');
  document.querySelector('.custom-control-label').classList.remove('text-warning');
}else{
  document.body.classList.remove('dark-mode');
  swdm.removeAttribute('checked', "");
  dmicon.classList.add('fa-sun');
  dmicon.classList.remove('fa-moon');
  document.querySelector('.custom-control-label').classList.add('text-warning');
  document.querySelector('.custom-control-label').classList.remove('text-info');
}


$(document).ready(function() {

  // Toast para notificaciones
  // toastr.warning('My name is Inigo Montoya. You killed my father, prepare to die!');

  // Waitme
  // $('body').waitMe({effect : 'orbit'});
  
  /**
   * Alerta para confirmar una acción establecida en un link o ruta específica
   */
  $('body').on('click', '.confirmar', function(e) {
    e.preventDefault();

    let url = $(this).attr('href');

    // Redirección a la URL del enlace
    Swal.fire({
      title: 'Salir de la página actual',
      text: "¿Estás seguro?",
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location = url;
        return true;
      }
    });
    
    return true;
  });

  /**
   * Inicializa summernote el editor de texto avanzado para textareas
   */
  if ($('.summernote').length !== 0) {
    $('.summernote').summernote({
      placeholder: 'Escribe en este campo...',
      tabsize: 2,
      height: 300
    });
  }

  $('.select2').select2()

  //Initialize Select2 Elements
  $('.select2bs4').select2({
    theme: 'bootstrap4'
  })

  $(".datatable").DataTable({
    
    "responsive": true, 
    "lengthChange": false, 
    "autoWidth": false,
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

  }).buttons().container().appendTo('.datatable_wrapper .col-md-6:eq(0)');


  ////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////
  ///////// NO REQUERIDOS, SOLO PARA EL PROYECTO DEMO DE GASTOS E INGRESOS
  ////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////
  
  // Agregar un movimiento
  // $('.bee_add_movement').on('submit', bee_add_movement);
  // function bee_add_movement(event) {
  //   event.preventDefault();

  //   var form    = $('.bee_add_movement'),
  //   hook        = 'bee_hook',
  //   action      = 'add',
  //   data        = new FormData(form.get(0)),
  //   type        = $('#type').val(),
  //   description = $('#description').val(),
  //   amount      = $('#amount').val();
  //   data.append('hook', hook);
  //   data.append('action', action);

  //   // Validar que este seleccionada una opción type
  //   if(type === 'none') {
  //     toastr.error('Selecciona un tipo de movimiento válido', '¡Upss!');
  //     return;
  //   }

  //   // Validar description
  //   if(description === '' || description.length < 5) {
  //     toastr.error('Ingresa una descripción válida', '¡Upss!');
  //     return;
  //   }

  //   // Validar amount
  //   if(amount === '' || amount <= 0) {
  //     toastr.error('Ingresa un monto válido', '¡Upss!');
  //     return;
  //   }

    // AJAX
  //   $.ajax({
  //     url: 'ajax/bee_add_movement',
  //     type: 'post',
  //     dataType: 'json',
  //     contentType: false,
  //     processData: false,
  //     cache: false,
  //     data : data,
  //     beforeSend: function() {
  //       form.waitMe();
  //     }
  //   }).done(function(res) {
  //     if(res.status === 201) {
  //       toastr.success(res.msg, '¡Bien!');
  //       form.trigger('reset');
  //       bee_get_movements();
  //     } else {
  //       toastr.error(res.msg, '¡Upss!');
  //     }
  //   }).fail(function(err) {
  //     toastr.error('Hubo un error en la petición', '¡Upss!');
  //   }).always(function() {
  //     form.waitMe('hide');
  //   })
  // }

  // // Cargar movimientos
  // bee_get_movements();
  // function bee_get_movements() {
  //   var wrapper = $('.bee_wrapper_movements'),
  //   hook        = 'bee_hook',
  //   action      = 'load';

  //   if (wrapper.length === 0) {
  //     return;
  //   }

  //   $.ajax({
  //     url: 'ajax/bee_get_movements',
  //     type: 'POST',
  //     dataType: 'json',
  //     cache: false,
  //     data: {
  //       hook, action
  //     },
  //     beforeSend: function() {
  //       wrapper.waitMe();
  //     }
  //   }).done(function(res) {
  //     if(res.status === 200) {
  //       wrapper.html(res.data);
  //     } else {
  //       toastr.error(res.msg, '¡Upss!');
  //       wrapper.html('');
  //     }
  //   }).fail(function(err) {
  //     toastr.error('Hubo un error en la petición', '¡Upss!');
  //     wrapper.html('');
  //   }).always(function() {
  //     wrapper.waitMe('hide');
  //   })
  // }

  // // Actualizar un movimiento
  // $('body').on('dblclick', '.bee_movement', bee_update_movement);
  // function bee_update_movement(event) {
  //   var li              = $(this),
  //   id                  = li.data('id'),
  //   hook                = 'bee_hook',
  //   action              = 'get',
  //   add_form            = $('.bee_add_movement'),
  //   wrapper_update_form = $('.bee_wrapper_update_form');

  //   // AJAX
  //   $.ajax({
  //     url: 'ajax/bee_update_movement',
  //     type: 'POST',
  //     dataType: 'json',
  //     cache: false,
  //     data: {
  //       hook, action, id
  //     },
  //     beforeSend: function() {
  //       wrapper_update_form.waitMe();
  //     }
  //   }).done(function(res) {
  //     if(res.status === 200) {
  //       wrapper_update_form.html(res.data);
  //       add_form.hide();
  //     } else {
  //       toastr.error(res.msg, '¡Upss!');
  //     }
  //   }).fail(function(err) {
  //     toastr.error('Hubo un error en la petición', '¡Upss!');
  //   }).always(function() {
  //     wrapper_update_form.waitMe('hide');
  //   })
  // }

  // $('body').on('submit', '.bee_save_movement', bee_save_movement);
  // function bee_save_movement(event) {
  //   event.preventDefault();

  //   var form    = $('.bee_save_movement'),
  //   hook        = 'bee_hook',
  //   action      = 'update',
  //   data        = new FormData(form.get(0)),
  //   type        = $('select[name="type"]', form).val(),
  //   description = $('input[name="description"]', form).val(),
  //   amount      = $('input[name="amount"]', form).val(),
  //   add_form            = $('.bee_add_movement');
  //   data.append('hook', hook);
  //   data.append('action', action);

  //   // Validar que este seleccionada una opción type
  //   if(type === 'none') {
  //     toastr.error('Selecciona un tipo de movimiento válido', '¡Upss!');
  //     return;
  //   }

  //   // Validar description
  //   if(description === '' || description.length < 5) {
  //     toastr.error('Ingresa una descripción válida', '¡Upss!');
  //     return;
  //   }

  //   // Validar amount
  //   if(amount === '' || amount <= 0) {
  //     toastr.error('Ingresa un monto válido', '¡Upss!');
  //     return;
  //   }

  //   // AJAX
  //   $.ajax({
  //     url: 'ajax/bee_save_movement',
  //     type: 'post',
  //     dataType: 'json',
  //     contentType: false,
  //     processData: false,
  //     cache: false,
  //     data : data,
  //     beforeSend: function() {
  //       form.waitMe();
  //     }
  //   }).done(function(res) {
  //     if(res.status === 200) {
  //       toastr.success(res.msg, '¡Bien!');
  //       form.trigger('reset');
  //       form.remove();
  //       add_form.show();
  //       bee_get_movements();
  //     } else {
  //       toastr.error(res.msg, '¡Upss!');
  //     }
  //   }).fail(function(err) {
  //     toastr.error('Hubo un error en la petición', '¡Upss!');
  //   }).always(function() {
  //     form.waitMe('hide');
  //   })
  // }

  // // Borrar un movimiento
  // $('body').on('click', '.bee_delete_movement', bee_delete_movement);
  // function bee_delete_movement(event) {
  //   var boton   = $(this),
  //   id          = boton.data('id'),
  //   hook        = 'bee_hook',
  //   action      = 'delete',
  //   wrapper     = $('.bee_wrapper_movements');

  //   if(!confirm('¿Estás seguro?')) return false;

  //   $.ajax({
  //     url: 'ajax/bee_delete_movement',
  //     type: 'POST',
  //     dataType: 'json',
  //     cache: false,
  //     data: {
  //       hook, action, id
  //     },
  //     beforeSend: function() {
  //       wrapper.waitMe();
  //     }
  //   }).done(function(res) {
  //     if(res.status === 200) {
  //       toastr.success(res.msg, 'Bien!');
  //       bee_get_movements();
  //     } else {
  //       toastr.error(res.msg, '¡Upss!');
  //     }
  //   }).fail(function(err) {
  //     toastr.error('Hubo un error en la petición', '¡Upss!');
  //   }).always(function() {
  //     wrapper.waitMe('hide');
  //   })
  // }

  // // Guardar o actualizar opciones
  // $('.bee_save_options').on('submit', bee_save_options);
  // function bee_save_options(event) {
  //   event.preventDefault();

  //   var form = $('.bee_save_options'),
  //   data     = new FormData(form.get(0)),
  //   hook     = 'bee_hook',
  //   action   = 'add';
  //   data.append('hook', hook);
  //   data.append('action', action);

  //   // AJAX
  //   $.ajax({
  //     url: 'ajax/bee_save_options',
  //     type: 'post',
  //     dataType: 'json',
  //     contentType: false,
  //     processData: false,
  //     cache: false,
  //     data : data,
  //     beforeSend: function() {
  //       form.waitMe();
  //     }
  //   }).done(function(res) {
  //     if(res.status === 200 || res.status === 201) {
  //       toastr.success(res.msg, '¡Bien!');
  //       bee_get_movements();
  //     } else {
  //       toastr.error(res.msg, '¡Upss!');
  //     }
  //   }).fail(function(err) {
  //     toastr.error('Hubo un error en la petición', '¡Upss!');
  //   }).always(function() {
  //     form.waitMe('hide');
  //   })
  // }
});