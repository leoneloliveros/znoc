rol = {
  init: () => {
    rol.events();
    rol.inputsAbiertos();
  },
  events: ()=> {
  $("#postRol").on("click",rol.validateForm);
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
  validateForm: ()=>{
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

          rol.getFormDataRol();

      } else {
          helper.miniAlert('LLena los campos en rojo','error',3000)
        }

  },

  getFormDataRol:() =>{

    var rolNuevo = rol.postRol().then(data=>{
// alert('sdfgbnmh');
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
                     title: 'El Rol a sido creada con exito',
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

    postRol: ()=>{
      return new Promise((resolve,reject)=>{
      datosRol = {
        nemeRol: $('#newRol').val(),
        area: $('#trueArea').val(),
        descriptionRol: $('#descripcionRol').val(),
      }
      console.log(datosRol);
      const url = base_url+'Areas/postRol'
      const obj = {nuevoRol:datosRol}
      $.post(url, obj, function (data) {
        resolve(data)
      }).fail(()=>reject(1))
    })
  },

}
rol.init();
