area = {
  init: function () {
    area.events();

    $.post(base_url + 'Areas/getUsers',
    {$users:$('#responsableArea').val()}
  ).done(function(data){
    var datos = JSON.parse(data);
    // console.log(datos);
    // $('#responsableArea').val(datos.nombres)
    var select = document.getElementById('responsableArea')
     for (var i = 0; i < datos.length; i++) {
         $('#users').append('<option>' + datos[i].nombres + '</option>')
     }

  })

  // $.post(base_url + 'Areas/getIdUser',
  // {idUsers:$('#idUser').val()})
// ).done(function(data){
//   var datos= JSON.parse(data);
//   $('#idUser').val()
// })

  },
  events: function() {
    $("#newArea").on("click",area.validateForm);
    //
    // var activarRol = false;
    // $('#newRol').on('click', function(){
    //    activarRol = ( activarRol == true) ? false : true ;
    //   if ( activarRol === true) {
    //     $('#roles').attr('style', 'display:  block;');
    //   }else {
    //     $('#roles').attr('style', 'display:  none;');
    //   }
    // });

    $('#responsableArea').change(function() {
// alert('JSJDFGF')
      $.post(base_url + 'Areas/getIdUser',
      {idUsers:$('#responsableArea').val()}
    ).done(function (data) {
      var datos = JSON.parse(data);
      console.log(datos);

      $('#idUser').val(datos[0].id_users);
    });

    })

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
          area.getFormData();
      } else {
          helper.miniAlert('El campo (Nombre del Area) es obligatorio','error',3000)
        }

  },

  getFormData:() =>{
    var areaNueva = area.newArea().then(data=>{

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
                     title: 'El Area a sido creada con exito',
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

 newArea:()=>{
   return new Promise((resolve,reject) => {
        datosArea = {
          nombreArea : $('#area').val(),
          responsableArea : $('#responsableArea').val(),
          id_user : $('#idUser').val(),
        }
        const url= base_url+'Areas/saveArea'
         const opts = {guardarArea:datosArea}
        $.post(url, opts, function (data) {
          resolve(data)
        }
      ).fail(()=>reject(1))
   })
  },

//
// getuser:()=>{
//   return new Promise((resolve,reject)=>{
//     usuarios = {
//       responsableArea : $('#responsableArea').val(),
//       id_user : id_user,
//     }
//     const url= 'Areas/getUsers'
//     const opts = {guardarArea:datosArea}
//
//   })
// }


//   otroRol: () => {
//
//         var iCnt = 0;
//
// // Crear un elemento div añadiendo estilos CSS
//         var container = $(document.createElement('div')).addClass('form-input');
//
//         $('#btAdd').click(function() {
//             if (iCnt <= 19) {
//
//                 iCnt = iCnt + 1;
//                 // Añadir caja de texto.
//                 $(container).append(`
//                   <div class="col-md-6">
//                   <input class="input" id="tb${iCnt}"
//                   value="" />
//                   </div>        `);
//
//
//  $('#main').after(container);
//             }
//             else {      //se establece un limite para añadir elementos, 20 es el limite
//
//                 $(container).append('<label>Limite Alcanzado</label>');
//                 $('#btAdd').attr('class', 'bt-disable');
//                 $('#btAdd').attr('disabled', 'disabled');
//
//             }
//         });
//
//         $('#btRemove').click(function() {   // Elimina un elemento por click
//             if (iCnt != 0) { $('#tb' + iCnt).remove(); iCnt = iCnt - 1; }
//
//             if (iCnt == 0) { $(container).empty();
//
//                 $(container).remove();
//                 $('#btSubmit').remove();
//                 $('#btAdd').removeAttr('disabled');
//                 $('#btAdd').attr('class', 'bt')
//
//             }
//         });
//
//         $('#btRemoveAll').click(function() {    // Elimina todos los elementos del contenedor
//
//             $(container).empty();
//             $(container).remove();
//             $('#btSubmit').remove(); iCnt = 0;
//             $('#btAdd').removeAttr('disabled');
//             $('#btAdd').attr('class', 'bt');
//
//         });
//     },
}
area.init();
