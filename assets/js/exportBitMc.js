exportar = {
  init: () => {
  exportar.events();
  },
  events: ()=> {
    var activeInitialButton = false;
    $('#filtroFehca').on('click', function(){
      // alert('Si funciona')
        activeInitialButton = (activeInitialButton == true) ? false : true ;
        if (activeInitialButton == true) {
            $('#finalDay').parent().attr('style', 'display: none;');
            $('#finalDay').val($('#dateInitial').val());
        } else {
            $('#finalDay').parent().attr('style', 'display:  block;');
        };

      });

      $('#showDataTable').on('click', exportar.validateForm)

  },

  tipoDeBitacora: ()=>{
    var tipoDeBitacora =  document.querySelector('#bitacoras').value
    exportar.showDataTable(tipoDeBitacora)
  },

  showDataTable: (tipoBitacora)=> {
  var queryValue = "";
  var fechaInicio = document.querySelector('#dateInitial').value
  var fechaFin = document.querySelector('#finalDay').value

  var fechas = moment(fechaInicio, 'DD/MM/YYYY').format('YYYY-MM-DD') + '/' + moment(fechaFin, 'DD/MM/YYYY HH:mm').format('YYYY-MM-DD') ;
  var url = base_url + 'BitacoraMC/cargarBitacoraMc/' + fechas + '/' + tipoBitacora
// console.log(tipoBitacora);
  var element = document.getElementById('container-result');
  // console.log(fechas);

  load(url, element);
  function load(url, element)
  {
      req = new XMLHttpRequest();
      req.open("GET", url, false);
      req.send(null);
      element.innerHTML = req.responseText;
      createDatatable(url, tipoBitacora);
      $('#loader').hide();
      $('.spinner-loader').hide();
  }

  function createDatatable (link, tipoBitacora) {
      if (tipoBitacora =='general') {
        var bitacoras = 'bitacoraMC'
      }else if (tipoBitacora =='turno_integral') {
          var bitacoras = 'bitacoraTI'
      }
      bitacora = $("#bitacoraMC, #bitacoraTI").DataTable({
          processing: true,
          serverSide: true,
          "scrollX": true,

          "searching": true,
          dom: 'frtip',
          select: true,
          "oLanguage": {
          "oPaginate": {
              "sPrevious": "<i class='fas fa-backward'></i>", // This is the link to the previous page
              "sNext": "<i class='fas fa-forward'></i>", // This is the link to the next page
          }
      },

          searchDelay: 500,
          autoWidth: false,
          ajax: {
              url: link,
              type: "POST",
              data: function (d, dt) {
              d.dt_name = bitacoras
              }
          },
          "drawCallback": function( settings, json){
                              queryValue = settings['json']['query'];
                              // console.log(queryValue);
                          }
      });
  }
  $('#export-excel-mc').on('click', function() {
    // console.log(fechas);
    helper.showLoading();
    var parametrosFechas = fechas;

            $.post(base_url + "BitacoraMC/getIncidentsMC", {
                query: queryValue.replace('LIMIT 10','')
              }).done(function(){
                helper.hideLoading();
                window.open(base_url + "BitacoraMC/exportIncidentsMC/" + parametrosFechas );
            });
  });
  $('#bitacoraMC_filter, #bitacoraTI_filter').prepend('<i class="fas fa-search" id="search-icon"></i>');
  $('#bitacoraMC_filter input, #bitacoraTI_filter input').attr('id', 'search-input');
  let active = false;
  $('.contenedorMaestro').on('click', function(e){
      if(e.target.id === 'search' || e.target.id === 'search-input' || e.target.id === 'search-icon') {
          if(!active) {
          $('#bitacoraMC_filter, #bitacoraTI_filter').addClass('active');
          $('#bitacoraMC_filter, #bitacoraTI_filter').addClass('active');
          $('#search-input').addClass('active');
          $('#search-icon').addClass('active');
          active = true;
          }
      } else {
          $('#bitacoraMC_filter, #bitacoraTI_filter').removeClass('active');
          $('#bitacoraMC_filter, #bitacoraTI_filter').removeClass('active');
      $('#search-input').removeClass('active');
      $('#search-icon').removeClass('active');
      active = false;
      }
  });

  $('#export-excel-ti').on('click', function() {
    // console.log(fechas);
    helper.showLoading();
    var parametrosFechas = fechas;

            $.post(base_url + "BitacoraMC/getIncidentsTI", {
                query: queryValue.replace('LIMIT 10','')
              }).done(function(){
                helper.hideLoading();
                window.open(base_url + "BitacoraMC/exportIncidentsTI/" + parametrosFechas );
            });
  });

  },

  validateForm: function () {

      if ($('#bitacoras').val() == "") {
          helper.miniAlert('Seleccione una opcion a Expotar.');
          return false;
      } else if ($('#finalDay, #dateInitial').val() == "") {
              helper.miniAlert('Seleccione un rango de fechas.');
              return false;
          }else {
            exportar.tipoDeBitacora()
          }
  },


}
exportar.init();
