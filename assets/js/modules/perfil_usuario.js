var viewModel = {};
viewModel.fileData = ko.observable({
    dataURL: ko.observable(),
    // can add "fileTypes" observable here, and it will override the "accept" attribute on the file input
    // fileTypes: ko.observable('.xlsx,image/png,audio/*')
});
viewModel.multiFileData = ko.observable({
    dataURLArray: ko.observableArray()
});
viewModel.onClear = function(fileData) {
    Swal.fire({
        title: 'Está Seguro?',
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirmar!'
    }).then((result) => {
        if (result.value) {
            fileData.clear && fileData.clear();
        }
    })
};
viewModel.debug = function() {
    window.viewModel = viewModel;
//    console.log(ko.toJSON(viewModel));
    debugger;
};
viewModel.onInvalidFileDrop = function(failedFiles) {
    var fileNames = [];
    for (var i = 0; i < failedFiles.length; i++) {
        fileNames.push(failedFiles[i].name);
    }
    var message = 'Extención Invalida: ' + fileNames.join(', ');
    swal(message, 'La imagen debe ser .jpg', 'info')
    console.error(message);
};
ko.applyBindings(viewModel);

$(function() {
    perfil = {
        init: function() {
            perfil.events();
        },

        //Eventos de la ventana.
        events: function() {
            /****************************************inicio eventos del formulario****************************************/
            // darle focus al input anterior al label para que se haga la animacion si problema
            $('#form_crear_crq').on('click', 'label.formulario_label', function() {
                $(this).prev().focus();
            })
            $('.formulario_input').keyup(perfil.fijar_label);
            $('.formulario_select').change(perfil.add_label);
            /****************************************fin eventos del formulario****************************************/
            $('#confirmar').click(perfil.validar_password);// validar si el password de validacion es correcto
            $('#send_form').click(perfil.realizar_cambios);


        },

        // funcion para fijar label cuando se escribe algo
        fijar_label: function() {
            if ($(this).val().length > 0) {
                $(this).next().addClass('fijar');
            } else {
                $(this).next().removeClass('fijar');
            }
        },

        //para crear el label en el caso de los selects
        add_label: function() {
            if ($(this).val() == '') {
                $(this).next().remove();
            } else {
                if (!$(this).next().hasClass('formulario_label')) {
                    $(this).after(`<label for="" class="formulario_label fijar">${$(this).data('label')}</label>`);
                }
            }

        },

        // Funcion para validar si un password existe
        validar_password: function() {
            const pass = $('#old_password').val();
            $.post(base_url + 'User/validate_pass', {
                pass: pass
            }, function(data) {
                res = JSON.parse(data);
                if (res == 1) {
                    $('#rest_form_content').show();
                    $('#old_password').attr('disabled', true);
                    $('#confirmar').attr('disabled', true);
                } else {
                    helper.miniAlert('password incorrecto');
                }
            });

        },

        // Validacion y envio de cambios realizados por el usuario
        realizar_cambios: function(){
            const new_pass = $('#new_password').val();
            const new_pass2 = $('#new_password_2').val();
            const file = document.getElementById('form_file').files;
            let enviar = true;

            // Si no realizó ningun cambio
            if (new_pass == '' && new_pass2 == '' && file.length == 0) {
                helper.miniAlert('No realizaste ningún cambio', 'warning' );
                enviar = false;
            }
            else if(new_pass != '' || new_pass2 != ''){
                if (new_pass != new_pass2) {
                    helper.miniAlert('Las contraseñas no coinciden', 'error');
                    enviar = false;
                } 
            }

            if (enviar) {
                $('#form_configurar_perfil').submit();
            } 



        },

    };
    perfil.init();
});