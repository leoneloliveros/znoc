$(document).ready(function() {

    //Esquema
    var Bitacora = {

        //Inicializa las funciones escritas en este atributo
        init:function(){
            $('#loader').hide();
            $('.spinner-loader').hide();
            Bitacora.inputAnimations();
            Bitacora.formatDateInputs();
            Bitacora.events();
            Bitacora.estaciones();
            Bitacora.fechaActual();
            Bitacora.inputsAbiertos();
        },


        estaciones: function(){
          $.post(
            base_url+'Bitacoras/showdepartamento',
          function (data) {
            var almacenamiento = JSON.parse(data)
            // console.log(almacenamiento[0].sigla);
            var select = document.getElementById('estacion')
             for (var i = 0; i < almacenamiento.length; i++) {
               $('#estacionList').append('<option>' + almacenamiento[i].sigla + '</option>')
             }

          }
        )
        },

        events: function(){

            $('#estacion').change(function() {
              // alert('dsds');
              $.post(
                base_url+'Bitacoras/getDepartaments',
              {departamento:$('#estacion').val().substr(0,4)},
            ).done(function (data) {
              var datos = JSON.parse(data);
              // console.log(obj);
              var obj = datos[0];
              $('#regional').val(obj.region);
              $('#ciudad').val(obj.departamento);
            });

            })
            $("#horaFinalTrabajo").on("change", Bitacora.fechas);
            $("#submit-logbook").on("click", Bitacora.validateForm);
        },
        inputAnimations: function() {
            $('input').focus(function(){
                $(this).parents('.form-group').addClass('focused');
            });
            $('input').blur(function(){
                var inputValue = $(this).val();
                if ( inputValue == "" ) {
                    $(this).removeClass('filled');
                    $(this).parents('.form-group').removeClass('focused');
                } else {
                    $(this).addClass('filled');
                }
            });

            $('select').focus(function(){
                $(this).parents('.form-group').addClass('focused');
            });

            $('select').blur(function(){
                var selectValue = $(this).val();
                if ( selectValue == "" ) {
                    $(this).removeClass('filled');
                    $(this).parents('.form-group').removeClass('focused');
                } else {
                    $(this).addClass('filled');
                }
            });

            $('textarea').focus(function(){
                $(this).parents('.form-group').addClass('focused');
            });
            $('textarea').blur(function(){
                var selectValue = $(this).val();
                if ( selectValue == "" ) {
                    $(this).removeClass('filled');
                    $(this).parents('.form-group').removeClass('focused');
                } else {
                    $(this).addClass('filled');
                }
            });

        },


        formatDateInputs: function() {
            $('#fecha').mask("99/99/9999");
            $('#fechaYHoraIngresoTarea').mask("99/99/9999 99:99");
            $('#horaInicioTrabajo').mask("99:99");
            $('#horaFinalTrabajo').mask("99:99");
        },
        validateForm: function(){
            $('.required-field').each(function() {
                var val = $('#' + this.id ).val();
                if (val === "") {
                    $('#' + this.id ).addClass('form-input-error');
                } else {
                    $('#' + this.id ).removeClass('form-input-error');
                }
            });
            var flag = true;
            $('.required-field').each(function() {
                if ($('#' + this.id).hasClass("form-input-error")) {
                    flag = false;
                }
            });
            if (flag) {
                Bitacora.getFormData();
            } else {
                Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: 'Faltan Campos por Llenar!',
                footer: 'Revisa los campos en rojo'
                })
            }
        },
        getFormData: function() {
            $('.spinner-loader').show();
            $('.spinner-loader').attr('style',  'background-color:rgba(255,255,255,0.4)');
            $('#loader').show();
            datosBitacora = {
                'ingeniero' : $('#ingeniero').val(),
                'fecha'     : $('#fecha').val(),
                'horario'   : $('#horario').val(),
                'ticket'    : $('#ticket').val(),
                'tarea'     : $('#tarea').val(),
                'estacion'  : $('#estacion').val(),
                'prioridad' : $('#prioridad').val(),
                'tipoDeServicio' : $('#tipoDeServicio').val(),
                'detalleDeActividad'     : $('#detalleDeActividad').val(),
                'regional' : $('#regional').val(),
                'ciudad' : $('#ciudad').val(),
                'entradaDelTicket' : $('#entradaDelTicket').val(),
                'fechaYHoraIngresoTarea' : $('#fechaYHoraIngresoTarea').val(),
                'horaInicioTrabajo' : $('#horaInicioTrabajo').val(),
                'horaFinalTrabajo' : $('#horaFinalTrabajo').val(),
                'tiempoRevision' : $('#tiempoRevision').val(),
                'destinoDelTicket' : $('#destinoDelTicket').val(),
                'seguimiento' : $('#seguimiento').val(),
                'causaDeFalla' : $('#causaDeFalla').val(),
                'diagnosticoTicket' : $('#diagnosticoTicket').val(),
                'tipoDeSoporte' : $('#tipoDeSoporte').val(),
                'ticketMalGestionadoTMG' : $('#ticketMalGestionadoTMG').val(),
                'areaDirigidaTMG' : $('#areaDirigidaTMG').val(),
                'rutaSinDocumentarRSD' : $('#rutaSinDocumentarRSD').val(),
                'rutaDesactializadaRD' : $('#rutaDesactializadaRD').val(),
                'checkDeExcluido' : $('#checkDeExcluido').val(),
            }
            $.post(
                base_url+'Bitacoras/saveWorkLogBackOffice',
                {datosBitacora : datosBitacora })
                .done(function(data) {
                    $('#loader').hide();
                    $('.spinner-loader').hide();
                    if (data == 'false') {
                        swal({
                            title: 'Error!',
                            text: 'hubo un error en el guardado, intentelo de nuevo.',
                            type: 'error'
                        })
                    } else {
                        Swal.fire({
                            position: 'center',
                            type: 'success',
                            title: 'La información ha sido guardada',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        window.setTimeout(function(){ location.reload(true); } ,1500);

                        //
                    }
                });

        },
    fechas: function(){
    let f1= document.querySelector('#fechaYHoraIngresoTarea').value;
    let f2 = document.querySelector('#horaFinalTrabajo').value;

    console.log(f1 + " " + f2);
    const fecha1 = moment( f1, 'DD/MM/YYYY HH:mm');
    const fecha2 = moment( f2,  'HH:mm');
    console.log(fecha2.diff(fecha1, 'minutes')/60);
    let diferencia =(fecha2.diff(fecha1,'minutes')/60);


    // const now = moment();
     let tiempoDeHoras = document.getElementById('tiempoRevision');
     tiempoDeHoras.value = diferencia.toFixed(2);
},
fechaActual: ()=>{
document.querySelector('#fecha').value =  moment().format('DD/MM/YYYY');
document.querySelector('#fechaYHoraIngresoTarea').value = moment().format('DD/MM/YYYY HH:mm:ss');
},
inputsAbiertos:()=>{
   var x = document.getElementsByClassName("required-field");
   for (i = 0; i < x.length; i++) {
     if (x[i].value != "") {
       x[i].classList.add("filled");
       x[i].parentElement.classList.add("focused");
     }
   }
 },



    }
    Bitacora.init();
});
