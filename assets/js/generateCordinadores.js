cordinador = {
  init: ()=> {
    cordinador.events();
  },
  events: ()=>{
    $("#postCordinador").on("click",cordinador.validateForm);
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
          cordinador.getFormDataCordinator();
      } else {
          helper.miniAlert('El campo (Nombre del Area) es obligatorio','error',3000)
        }

  },
  getFormDataCordinator:() =>{
    var nuevoCordinador = cordinador.newCordinador().then(data=>{

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
                     title: 'El Cordinador a sido agragado con exito',
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
 newCordinador:()=>{
   return new Promise((resolve,reject) => {
      var nombreArea = $('#area').val();
        datosCordinador ={
          area :"Dilo_"+nombreArea.replace(/ /gi,"-"),
          user_id:$('#idUser').val(),
        }
        const url= base_url+'Areas/saveCordinator'
         const opts = {guardarCordinador:datosCordinador}
        $.post(url, opts, function (data) {
          resolve(data)
        }
      ).fail(()=>reject(1))
   })
  },


}
cordinador.init();
