editar = {
  init:()=>{
    editar.envents();
    editar.inputsAbiertos();
    editar.activityChange();
    editar.formatDateInputs();
    editar.fechaActual();
    editar.Calculofechas();
  },
  envents:()=>{
    $('#actividad').change(function() {
        editar.activityChange();
        editar.inputsAbiertos();
    });
    $("#editGeneralBinnacle").on("click",editar.validateForm);
    $('#causalCierre').change(function() {
      editar.alertsForCDC();
    });
    $("#fechaFin").on("change", editar.Calculofechas);
  },
  formatDateInputs: function() {
      $('#fechaInicio, #fechaFin').mask("99/99/9999 99:99",{placeholder: "--/--/----   --:--"});
  },
  fechaActual: ()=>{
    document.querySelector('#fechaInicio').value =  moment().format('DD/MM/YYYY HH:mm');
    document.querySelector('#fechaFin').value =  moment().format('DD/MM/YYYY HH:mm');
  },

  inputsAbiertos:()=>{
     var x =  document.querySelectorAll("input, select, textarea");
     for (i = 0; i < x.length; i++) {
        if (x[i].value != "") {
          x[i].classList.add("filled");
          // console.log(x[i].parentElement);
          x[i].parentElement.classList.add("focused");
        }else{
         x[i].classList.remove("filled");
         x[i].parentElement.classList.remove("focused");
        }
     }
    },
    activityChange:()=>{
      var actividad = document.querySelector('#actividad').value;
       if (actividad == 'OFENSORES'  || actividad == 'GESTION PROBLEMAS' || actividad == 'CONTROL DE CALIDAD' || actividad == 'REPORTES') {
         $('.removeR').css('display' ,'none');
         $('#idAlarma, #causalCierre, #tarea, #fmasiva, #degradacionAbis').removeClass('required-field filled').val("")
         $('#idAlarma, #causalCierre, #tarea, #fmasiva, #degradacionAbis').parent().removeClass('focused');
         if (actividad == 'OFENSORES') {
           // alert('si llego a ofensores')
           $('#active').css('display','block');
           $('#resumen').addClass('required-field')
           $('#tk-remove').css('display' ,'block');
         } if (actividad != 'OFENSORES') {
           $('#active').css('display','none');
           $('#resumen').removeClass('required-field filled ').val("");
           $('#resumen').parent().removeClass('focused');
           $('#tk-remove').css('display' ,'none');
           $('#tkcreado').removeClass('required-field filled').val("");
           $('#tkcreado').parent().removeClass('focused');
         }if (actividad == 'REPORTES') {
           $('#tk-remove').css('display' ,'none');
           $('#tkcreado').removeClass('required-field filled').val("");
           $('#tkcreado').parent().removeClass('focused');
           $('#Nreport').css('display','block');
           $('#NombreDelReporte').addClass('required-field')
         } if (actividad != 'REPORTES') {
           $('#tk-remove').css('display' ,'block');
           $('#tkcreado').addClass('required-field');
           $('#Nreport').css('display','none');
           $('#NombreDelReporte').removeClass('required-field filled').val("");
           $('#NombreDelReporte').parent().removeClass('focused');
         }if (actividad == 'GESTION PROBLEMAS' || actividad == 'CONTROL DE CALIDAD') {
           $('#tk-remove').css('display' ,'none');
           $('#tkcreado').removeClass('required-field filled').val("");
           $('#tkcreado').parent().removeClass('focused');
         }

         }else {
           $('.removeR').css('display' ,'block');
           $('#idAlarma, #causalCierre, #tarea, #fmasiva, #degradacionAbis, #tkcreado').addClass('required-field');

           $('#active').css('display','none');
           $('#resumen').removeClass('required-field filled ').val("");
           $('#resumen').parent().removeClass('focused');

           $('#tk-remove').css('display' ,'block');
           $('#tkcreado').addClass('required-field');

           $('#Nreport').css('display','none');
           $('#NombreDelReporte').removeClass('required-field filled').val("");
           $('#NombreDelReporte').parent().removeClass('focused');
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
      if (totalMinutos<0) {
        totalMinutos = 60+totalMinutos;
      }
      var duracion = document.querySelector('#duracion')
      var diferencia = (fecha2.diff(fecha1, 'hours') +' '+ 'Horas' + ' ' + totalMinutos + ' ' + 'Minutos' )
      duracion.value = diferencia;
    },

    validateForm: function(){
        $(`.required-field`).each(function() {
            var val = $('#' + this.id ).val();
            if (val === "") {
                $('#' + this.id ).addClass('form-input-error');
            } else {
                $('#' + this.id ).removeClass('form-input-error');
            }
        });
        var flag = true;
        $(`.required-field`).each(function() {
            if ($('#' + this.id).hasClass("form-input-error")) {
                flag = false;
            }
        });
        if (flag) {
            editar.getFormData();
        } else {
            helper.miniAlert('Revise los campos en rojo','error',3000)
          }

    },
    getFormData:() =>{

           var bitacora = editar.ActualizarGeneral()
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
            // console.log('test', data);
            Swal.fire({
              position: 'center',
              type: 'success',
              title: 'La bitacora ha sido actualizada con exito',
              showConfirmButton: false,
              timer: 1500
            });
            // window.setTimeout(function(){ location.reload(true); } ,1800);
            window.location=(base_url +  "BitacoraMC/ConsultarBitacorasMC")
          }

        }).catch(data=>{
          swal({
            title: 'Error!',
            text: 'hubo un en la conexion.',
            type: 'error'
          })
        });
   },

    ActualizarGeneral: ()=>{
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
            // debugger;
            const url = base_url + 'BitacoraMC/updateBitGeneral'
            const opts = {datosBitGeneral:datosBitGeneral}
            $.post(url, opts, function (data){
              resolve(data)
            }).fail(()=>reject(1))
      })
    },

}
editar.init();
