$(function () {
    crear = {
        init: function () {
            crear.events();
        },

        //Eventos de la ventana.
        events: function () {
        	/****************************************inicio eventos del formulario****************************************/
        	// darle focus al input anterior al label para que se haga la animacion si problema
        	$('#form_crear_crq').on('click' , 'label.formulario_label', function(){ $(this).prev().focus(); })
        	$('.formulario_input').keyup(crear.fijar_label);
        	$('.formulario_select').change(crear.add_label);
        	/****************************************fin eventos del formulario****************************************/
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

    };
    crear.init();
});