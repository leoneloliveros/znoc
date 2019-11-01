editar = {
  init:()=>{
    editar.events();
    editar.formatDateInputs();
    editar.inputsAbiertos();
    editar.CalculofechasTI_S();
  },
  events:()=>{
      $("#fechaRespuesta").on("change", editar.CalculofechasTI_S);
      $("#EditBitTurnoIntegral").on("click", editar.validateForm);
  },
  formatDateInputs: function() {
      $('#fechaInicio2, #fechaRespuesta').mask("99/99/9999 99:99",{placeholder: "--/--/----   --:--"});
      document.querySelector('#fechaInicio2').value =  moment().format('DD/MM/YYYY HH:mm');
      document.querySelector('#fechaRespuesta').value =  moment().format('DD/MM/YYYY HH:mm');
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
      if (totalMinutos<0) {
        totalMinutos = 60+totalMinutos;
      }
      var duracion = document.querySelector('#tiempoRespuesta')
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

          var bitacora = editar.ActualizarTI()
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
              // timer: 1500
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

    ActualizarTI: ()=>{
      return new Promise ((resolve,reject) =>{
        var info = document.querySelectorAll('[post-datos]')

                 datosBitacoraTI = {}
                 for (var i = 0; i < info.length; i++) {
                 var titulos = info[i].getAttribute('post-datos')
                 var datos = info[i].value
                 datosBitacoraTI[titulos] = datos
                 // console.log(datosBitGeneral);
            }
            // console.log(datosBitGeneral);
            // debugger;
            const url = base_url + 'BitacoraMC/updateBitTI'
            const opts = {datosBitacoraTI:datosBitacoraTI}
            $.post(url, opts, function (data){
              resolve(data)
            }).fail(()=>reject(1))
      })
    },


}
editar.init();
