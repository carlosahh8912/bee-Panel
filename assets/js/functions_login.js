// Dark mode del template
function dark(){
    document.body.classList.add('dark-mode');
}
function ligth(){
    document.body.classList.remove('dark-mode');
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



document.addEventListener('DOMContentLoaded', function(){
    if(document.querySelector('#loginForm')){
        $('#loginForm').validate({
            rules: {
                user: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 4
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
    }

    if(document.querySelector('#forgotPasswordForm')){
        $('#forgotPasswordForm').validate({
            rules: {
                emailUser: {
                    required: true,
                    email: true
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


        $('#forgotPasswordForm').on('submit', forgotPassword);
        function forgotPassword(event) {
            event.preventDefault();

            let form    = $('#forgotPasswordForm'),
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
            url: `${baseurl}ajax/forgot_password`,
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
                window.location.href = "/login";
            } else {
                toastr.error(res.msg, '¡Upss!');
            }
            }).fail(function(err) {
            toastr.error('Hubo un error en la petición', '¡Upss!');
            }).always(function() {
            form.waitMe('hide');
            })
        }
    }

    if(document.querySelector('#newPasswordForm')){
        $('#newPasswordForm').validate({
            rules: {
                emailUser: {
                    required: true,
                    email: true
                },
                tokenUser: {
                    required: true,
                    minlength: 32,
                    maxLength: 32
                },
                newPassword: {
                    required: true,
                    minlength: 4
                },
                retypePassword: {
                    required: true,
                    minlength: 4
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


        $("#retypePassword").on('keyup', validatePasswords);
        function validatePasswords(){

            let txtRetypePassword = $("#retypePassword"),
            txtNewPassword = $("#newPassword"),
            retypePassword = $("#retypePassword").val(),
            newPassword = $("#newPassword").val();

            if(newPassword !== retypePassword){
                txtRetypePassword.removeClass('is-valid').addClass('is-invalid');
                txtNewPassword.removeClass('is-valid');
            }else{
                txtRetypePassword.removeClass('is-invalid').addClass('is-valid');
                txtNewPassword.addClass('is-valid');
            }
        };
        


        $('#newPasswordForm').on('submit', forgotPassword);
        function forgotPassword(event) {
            event.preventDefault();

            let form    = $('#newPasswordForm'),
            hook        = 'bee_hook',
            action      = 'add',
            data        = new FormData(form.get(0)),
            retypePassword = $("#retypePassword").val(),
            newPassword = $("#newPassword").val();
            data.append('hook', hook);
            data.append('action', action);

            // Campos Invalidos
            if(document.querySelector('.is-invalid')) {
                toastr.error('Hay campos que son invalidos en el formulario.', '¡Upss!');
                return;
            }

            if(newPassword != retypePassword){
                toastr.error('Las contraseñas no coinsiden.', '¡Upss!');
                return;
            }

            // AJAX
            $.ajax({
            url: `${baseurl}ajax/recovery_password`,
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
                window.location.href = "/login";
            } else {
                toastr.error(res.msg, '¡Upss!');
            }
            }).fail(function(err) {
            toastr.error('Hubo un error en la petición', '¡Upss!');
            }).always(function() {
            form.waitMe('hide');
            })
        }
    }
    
});