area = {
  init: function () {
    area.events();
    area.tooltips();
    area.inputsAbiertos();
    area.getUsers();

  },
  events: function() {
    $("#newArea").on("click",area.validateForm);

    $('#responsableArea').change(function() {
    //   $.post(base_url + 'Areas/getIdUser',
    //   {idUsers:$('#responsableArea').val()}
    // ).done(function (data) {
    //   var datos = JSON.parse(data);
    //   console.log(datos);
    //   $('#idUser').val(datos[0].id_users);
    // });
    $('#idUser').val($('#responsableArea').val());

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
      var expresion = /([\'\".,/:;+_-])/i;
      cadena = document.getElementById('area').value
      if (cadena.match(expresion)) {
        helper.miniAlert('No se permiten caracteres Especiales');
        return false;
      }
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
      var nombreArea = $('#area').val()
        datosArea = {
          nombreArea : nombreArea.replace(/ /gi,"-"),
        }

        datosManager ={
          area :"Dilo_"+nombreArea.replace(/ /gi,"-"),
          user_id:$('#idUser').val(),
        }
        const url= base_url+'Areas/saveArea'
         const opts = {guardarArea:datosArea,guardarManager:datosManager }
        $.post(url, opts, function (data) {
          resolve(data)
        }
      ).fail(()=>reject(1))
   })
  },

  tooltips: () => {
  $('[data-toggle="tooltip"]').tooltip()
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

getUsers: ()=> {
  $.post(base_url + 'Areas/getUsers',
  {$users:$('#responsableArea').val()}
 ).done(function(data){
  var datos = JSON.parse(data);
  // console.log(datos);
  // $('#responsableArea').val(datos.nombres)
  var select = document.getElementById('responsableArea')
   for (var i = 0; i < datos.length; i++) {
       $('#users').append('<option value="' + datos[i].id_users + '" label = "'+datos[i].nombresUsuarios +'"></option>')
   }

 })
},

}
area.init();
