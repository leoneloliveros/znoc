exportar = {
  init: () => {
  exportar.events();
  },
  events: ()=> {

  },

  showDataTable: ()=> {
  var fechaInicio = document.querySelector('#dateInitial').value
  var fechaFin = document.querySelector('#finalDay').value

  var fechas = moment(fechaInicio, '')
  var url = base_url + 'Bitacoras/cargarBitacoraBO' + '/' + moment(fechaInicio, 'DD/MM/YYYY').format('YYYY-MM-DD') + '/' + moment(fechaFinal, 'DD/MM/YYYY').format('YYYY-MM-DD') ;

  },

}
exportar.init();
