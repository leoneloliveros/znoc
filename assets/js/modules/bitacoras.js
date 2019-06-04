$(function () {
  ccihfc = {
    init: function () {
      ccihfc.events();
    },

    events: function () {
      $('#newLogBook').click(ccihfc.validateData);
    },

    validateData: function () {
      $(".err").removeClass("err");
      const campos = $("div.frame input,div.frame select, div.frame textarea");
      var vacios = [];
      var data = {};
      $.each(campos, function (i, element) {
        if ($(element).prop("type") != "checkbox") {
          if ($(element).val() == null || $(element).val() == '' || $(element).val() == ' ' || $(element).val() == '  ') {
            vacios.push($(element).attr("id"));
          }else{
            data[$(element).attr("id")] = $(element).val();
          }
        }else{
          if ($(element).prop('checked')) {
            data[$(element).attr("id")] = "X";
          }
        }

      });
      console.log(data);
      if (vacios.length != 0) {
        $.each(vacios, function (i, id) { 
          $(`#${id}`).addClass('err');
        });
        swal({
          "html" : "¡No puede dejar los campo en rojo vacios!",
          "type":"error"
        });
        console.log("vacios",vacios);

      }else{
        ccihfc.saveLogBook(data);
      }
      
    },

    
    saveLogBook: function(bitacora){
      $.post(base_url + "Bitacoras/saveCCIHFC", {data: JSON.stringify(bitacora)},
        function (bool) {
          let msj = '';
          if (bool) 
            msj = ['Se guardó la bitácora.','success'];
          else 
            msj = ['Hubo un error inesperado.','error'];
            
          
          swal({
            "html" : msj[0],
            "type": msj[1]
          }).then(()=>{
            location.reload();
          });
          
        },
      );
    },


  }
  ccihfc.init();
});