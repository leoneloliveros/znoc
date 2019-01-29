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
    if (confirm('Are you sure?')) {
        fileData.clear && fileData.clear();
    }
};
viewModel.debug = function() {
    window.viewModel = viewModel;
    console.log(ko.toJSON(viewModel));
    debugger;
};
viewModel.onInvalidFileDrop = function(failedFiles) {
    var fileNames = [];
    for (var i = 0; i < failedFiles.length; i++) {
        fileNames.push(failedFiles[i].name);
    }
    var message = 'Invalid file type: ' + fileNames.join(', ');
    alert(message)
    console.error(message);
};
ko.applyBindings(viewModel);


$(function () {
    perfil = {
        init: function () {
            perfil.events();
        },

        //Eventos de la ventana.
        events: function () {
            /****************************************inicio eventos del formulario****************************************/
            // darle focus al input anterior al label para que se haga la animacion si problema
            $('#form_crear_crq').on('click' , 'label.formulario_label', function(){ $(this).prev().focus(); })
            $('.formulario_input').keyup(perfil.fijar_label);
            $('.formulario_select').change(perfil.add_label);
            /****************************************fin eventos del formulario****************************************/
            $('#confirmar').click(perfil.validar_password);



        },

        // funcion para fijar label cuando se escribe algo
        fijar_label: function(){
            if ($(this).val().length > 0) {
                $(this).next().addClass('fijar');
            } else {
                $(this).next().removeClass('fijar');
            }
        },

        //para crear el label en el caso de los selects
        add_label: function(){
            if ($(this).val() == '')  {
                $(this).next().remove();
            } else {
                if (!$(this).next().hasClass('formulario_label')) {
                    $(this).after(`<label for="" class="formulario_label fijar">${$(this).data('label')}</label>`);
                }
            }
            
        },

        // Funcion para validar si un password existe
        validar_password: function(){
            const pass = $('#old_password').val();
            $.post(base_url + 'User/validate_pass', {pass: pass}, function(data) {
                res = JSON.parse(data);
                if (res == 1) {
                    $('#rest_form_content').show();
                    $('#old_password').attr('disabled', true);
                    $('#confirmar').attr('disabled', true);
                } else {
                    helper.miniAlert('pasword incorrecto');
                }
            });


        },

    };
    perfil.init();
});