Bitacora = {
  init: () => {
    Bitacora.envents();
    Bitacora.disabledInitial();
    Bitacora.formatDateInputs();
    Bitacora.inputsAbiertos();
    Bitacora.fechaActual();

  },
  disabledInitial:()=>{
    divs = document.querySelectorAll(".generalForm input, .generalForm select, .generalForm textarea");
      for (i = 0; i < divs.length; i++) {
        divs[i].disabled = true;
      }
  },
  envents: () => {
    $('#actividad').change(function() {
      var actividad = document.querySelector('#actividad').value;
        if (actividad === 'OFENSORES') {
            Bitacora.activeOfensores();
            document.querySelector('#Nreport').setAttribute('style', 'display:none;');
            document.querySelector('#NombreDelReporte').classList.remove('required-field')
        }else if (actividad === 'REPORTES') {
          Bitacora.activeReportes();
          document.querySelector('#active').setAttribute('style', 'display:none;');
          document.querySelector('#resumen').classList.remove('required-field')
        }else {
          document.querySelector('#active').setAttribute('style', 'display:none;');
          document.querySelector('#resumen').classList.remove('required-field')
          $('.remove').css('display' ,'block');
          $('#causalCierre, #idAlarma, #tarea, #fmasiva, #degradacionAbis').addClass('required-field')


          document.querySelector('#Nreport').setAttribute('style', 'display:none;');
          document.querySelector('#NombreDelReporte').classList.remove('required-field')
          $('.remove').css('display' ,'block');
          $('#tkcreado, #causalCierre, #tarea, #fmasiva, #degradacionAbis').addClass('required-field')
        }

    });

    $('#causalCierre').change(function() {
      Bitacora.alertsForCDC();
    });
      Bitacora.changeofBinnacle()

      $("#saveGeneral").on("click",()=>{Bitacora.validateForm('generalForm')});
      $("#saveTurnoIntegral").on("click",()=>{Bitacora.validateForm('formTurnoIntegral')});
      $("#fechaFin").on("change", Bitacora.Calculofechas);
      $("#fechaRespuesta").on("change", Bitacora.CalculofechasTI_S);
    },


  changeofBinnacle: () =>{
    $('#bitacora').change(function() {
      var tipoDeBitacora = document.querySelector('#bitacora').value
      if (tipoDeBitacora == 'TURNO INTEGRAL-SOLICITUDES') {
        // alert('general')
        document.querySelector('#generalForm').style.display = "none";
        document.querySelector('#formTurnoIntegral').style.display = "block";
      }else if (tipoDeBitacora == 'BITACORA GENERAL') {
        // alert('integral')
        document.querySelector('#generalForm').style.display = "block";
        document.querySelector('#formTurnoIntegral').style.display = "none";
      }else {
        Bitacora.desbloqueardisables();
        Bitacora.fechaActual();
      }
        Bitacora.desbloqueardisables();
        Bitacora.fechaActual();
    });
  },
  inputsAbiertos:()=>{
     var x =  document.querySelectorAll("input, select, textarea");
     for (i = 0; i < x.length; i++) {
        if (x[i].value != "") {
          x[i].classList.add("filled");
          x[i].parentElement.classList.add("focused");
        }else{
         x[i].classList.remove("filled");
         x[i].parentElement.classList.remove("focused");
	      }
     }
    },
   formatDateInputs: function() {
       $('#fechaInicio, #fechaFin, #fechaInicio2 , #fechaRespuesta,#dateInitial, #finalDay').mask("99/99/9999 99:99",{placeholder: "--/--/----   --:--"});
   },

    activeOfensores: () => {
        document.querySelector('#active').setAttribute('style', 'display:block;');
        document.querySelector('#resumen').classList.add('required-field')
        $('.remove').css('display' ,'none');
        $('#causalCierre, #idAlarma, #tarea, #fmasiva, #degradacionAbis').removeClass('required-field')
    },

    activeReportes: () => {

  document.querySelector('#Nreport').setAttribute('style', 'display:block;');
  document.querySelector('#NombreDelReporte').classList.add('required-field')
  $('.removeR').css('display' ,'none');
  $('#tkcreado, #causalCierre, #tarea, #fmasiva, #degradacionAbis').removeClass('required-field')

},



  desbloqueardisables: () =>{
      var bitacora =  document.querySelector('#bitacora').value;
   if (bitacora === 'BITACORA GENERAL' || bitacora === 'TURNO INTEGRAL-SOLICITUDES') {
     divs = document.querySelectorAll(".generalForm input, .formTurnoIntegral input, .generalForm select, .formTurnoIntegral select, .generalForm textarea, .formTurnoIntegral textarea");
       for (i = 0; i < divs.length; i++) {
         divs[i].disabled = false;
       }
   }else {
     divs = document.querySelectorAll(".generalForm input, .formTurnoIntegral input, .generalForm select, .formTurnoIntegral select, .generalForm textarea, .formTurnoIntegral textarea");
       for (i = 0; i < divs.length; i++) {
         divs[i].disabled = true;
         divs[i].value = "";
       }
       Bitacora.inputsAbiertos();
       Bitacora.activeOfensores();
     }
   },

   alertsForCDC: ()=>{
     let options = document.querySelector('#causalCierre').value
     switch (options) {
        case '1':
        helper.miniAlert("Se relaciona tk de Falla con ID: XXXXXXX por ofensor particular.", 'warning','6000');
        break;
        case '2':
        helper.miniAlert("Se relaciona tk de Falla Generado con ID: XXXX por ofensor particular", 'warning','6000');
        break;
        case '3':
        helper.miniAlert("Falla en la NE se trabaja bajo el tk con ID: XXXXX.", 'warning','6000');
        break;
        case '4':
        helper.miniAlert("Se presentó afectación desde las 14:00 del 06/08/2019 hasta las19:00 del 06/08/2019 con normalidad al momento de la revisión.", 'warning','6000');
        break;
        case '5':
        helper.miniAlert("Se presenta falla masiva desde el 01-01-2018 con el tk XXXXXXXX", 'warning','6000');
        break;
        case '6':
        helper.miniAlert("Comportamiento esperado posterior a trabajo realizado con ID: XXXXXXXX.", 'warning','6000');
        break;
        case '7':
        helper.miniAlert("Se evidencia comportamiento de acuerdo a histórico.", 'warning','6000');
        break;
        case '8':
        helper.miniAlert("Se presenta afectación causada por congestión se relacionan ofensores (Lo relacionamos especialmente con comportamiento de los KPI para días festivos).", 'warning','6000');
        break;
        case '9':
        helper.miniAlert("La degradación corresponde a ofensor en estado no comercial.", 'warning','6000');
        break;
        case '10':
        helper.miniAlert("Se presenta falla masiva escalada bajo INC.", 'warning','6000');
        break;
        default:
        helper.miniAlert("No aplica", 'warning');
      }

   },

   validateForm: function(template){
       $(`div#${template} .required-field`).each(function() {
           var val = $('#' + this.id ).val();
           if (val === "") {
               $('#' + this.id ).addClass('form-input-error');
           } else {
               $('#' + this.id ).removeClass('form-input-error');
           }
       });
       var flag = true;
       $(`div#${template} .required-field`).each(function() {
           if ($('#' + this.id).hasClass("form-input-error")) {
               flag = false;
           }
       });
       if (flag) {
           Bitacora.getFormData(template);
       } else {
           helper.miniAlert('Revise los campos en rojo','error',3000)
         }

   },

   getFormData:(template) =>{

        if (template =='generalForm') {
          var bitacora = Bitacora.saveGeneral()
        }

        if (template =='formTurnoIntegral') {
          var bitacora = Bitacora.saveTurnoIntegral()
        }

         bitacora.then(data=>{

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
             title: 'La bitacora ha sido creada con exito',
             showConfirmButton: false,
             timer: 1500
           });
           window.setTimeout(function(){ location.reload(true); } ,1800);
         }

       }).catch(data=>{
         swal({
           title: 'Error!',
           text: 'hubo un en la conexion.',
           type: 'error'
         })
       });
  },

   saveGeneral: ()=>{
     return new Promise ((resolve,reject) =>{
       var info = document.querySelectorAll('[post-data]')
                datosBitGeneral = {}
                for (var i = 0; i < info.length; i++) {
                var titulos = info[i].getAttribute('post-data')
                var datos = info[i].value
                datosBitGeneral[titulos] = datos
                // console.log(datosBitGeneral);
           }
           // console.log(datosBitGeneral);
           const url = base_url + 'BitacoraMC/saveBinnacle'
           const opts = {datosBitGeneral:datosBitGeneral}
           $.post(url, opts, function (data){
             resolve(data)
           }).fail(()=>reject(1))
     })
   },

   saveTurnoIntegral: () => {
     return new Promise((resolve,reject)=>{
       var info = document.querySelectorAll('[post-datos]')
       datosBitacoraTI = {}
       for (var i = 0; i < info.length; i++) {
         var titulos = info[i].getAttribute('post-datos')
         var datos = info[i].value
         datosBitacoraTI[titulos] = datos
         console.log(datosBitacoraTI);
        }
        const url = base_url + 'BitacoraMC/saveBitTI'
        const opts = {datosBitacoraTI2:datosBitacoraTI}
        $.post(url, opts, function (data){
          resolve(data)
        }).fail(()=>reject(1))
     })
   },

   Calculofechas: function(){
     var fechaIncio = document.getElementById('fechaInicio').value
     var fechaFin = document.getElementById('fechaFin').value
     var fecha1 = moment( fechaIncio, 'DD/MM/YYYY HH:mm');
     var fecha2 = moment( fechaFin, 'DD/MM/YYYY HH:mm');
     var minutosF1 = fechaIncio.substring((fechaIncio.length-2))
     var minutosF2 = fechaFin.substring((fechaFin.length-2))
     var minutosF1N = parseInt(minutosF1)
     var minutosF2N = parseInt(minutosF2)
     var totalMinutos= minutosF2N - minutosF1N
     var duracion = document.querySelector('#duracion')
     var diferencia = (fecha2.diff(fecha1, 'hours') +' '+ 'Horas' + ' ' + totalMinutos + ' ' + 'Minutos' )
     duracion.value = diferencia;
   },

   CalculofechasTI_S: function(){
     var fechaIncio = document.getElementById('fechaInicio2').value
     var fechaFin = document.getElementById('fechaRespuesta').value
     var fecha1 = moment( fechaIncio, 'DD/MM/YYYY HH:mm');
     var fecha2 = moment( fechaFin, 'DD/MM/YYYY HH:mm');
     var minutosF1 = fechaIncio.substring((fechaIncio.length-2))
     var minutosF2 = fechaFin.substring((fechaFin.length-2))
     var minutosF1N = parseInt(minutosF1)
     var minutosF2N = parseInt(minutosF2)
     var totalMinutos= minutosF2N - minutosF1N
     var duracion = document.querySelector('#tiempoRespuesta')
     var diferencia = (fecha2.diff(fecha1, 'hours') +' '+ 'Horas' + ' ' + totalMinutos + ' ' + 'Minutos' )
     duracion.value = diferencia;
   },
   fechaActual: ()=>{
     document.querySelector('#fechaInicio').value =  moment().format('DD/MM/YYYY HH:mm');
     document.querySelector('#fechaFin').value =  moment().format('DD/MM/YYYY HH:mm');
     document.querySelector('#fechaInicio2').value =  moment().format('DD/MM/YYYY HH:mm');
   },


}

Bitacora.init();
