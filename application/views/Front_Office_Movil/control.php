<div class="main-title" style="width: 60%;">
    <span>
    Control KPI
    </span>
    <span id='subtitle'>
    <i class="fas fa-code-branch"></i> Front Office Movil
    </span>

</div>

<div style="display:flex; justify-content: center;">
    <div class="card-style w-60">
        <div class="general">

            <div class="switch-container col-md-6 col-body position-relative form-group">
                <label class="switch">
                <input type="checkbox" class="form-check-input">
                <span id="onlyDateInitial" class="slider round"></span>
                </label>
                <span class="checkbox-initial">
                    Solo Fecha de Inicio
                </span>
            </div>

<!-- ****************************************************Boton de activacion areas*****************************************************-->
            <div class="switch-container col-md-6 position-relative col-body form-group">
                <label class="switch">
                <input type="checkbox" class="form-check-input">
                <span id="bitacoras-none" class="slider round"></span>
                </label>
                <span class="checkbox-initial">
                  Seleccionar Area
                </span>
            </div>
<!-- ****************************************************Fin Boton de activacion areas*****************************************************-->

                <div class="col-md-6 col-body">
                    <div class="form-group">
                    <label class="form-label" for="ticket">Fecha Inicial</label>
                    <input id="fechaInicio" class="form-input required-field" type="text" />
                    </div>
                </div>

                <div class="col-md-6 col-body">
                    <div class="form-group">
                    <label class="form-label" for="ticket">Fecha Final</label>
                    <input id="fechaFinal" class="form-input required-field" type="text" />
                    </div>
                </div>


<!-- ****************************************************Botones de areas*****************************************************-->

              <div id="areas" class="disable"  style="display:none;">
                  <div class="col-md-4 col-body position-relative">
                    <div class="form-group" >
                      <label class="switch">
                        <input type="checkbox" name="foenergia" class="form-check-input" id="foenergia">
                      <span class="slider round "></span>
                      <span class="checkbox-initial" >
                        FOENERGIA
                      </span>
                      </label>

                    </div>
                  </div>

                <div class="col-md-4 col-body position-relative">
                  <div class="form-group"  >
                    <label class="switch">
                      <input type="checkbox" name="foservicio" id="foservicio" >
                    <span class="slider round"></span>
                    </label>
                    <span class="checkbox-initial">
                      FOSERVICIO
                    </span>
                  </div>
                </div>

                <div class="col-md-4 col-body position-relative">
                  <div class="form-group"  >
                    <label class="switch">
                      <input type="checkbox" name="intermitencia" id="intermitencia">
                    <span class="slider round"></span>
                    </label>
                    <span class="checkbox-initial">
                      INTERMITENCIA
                    </span>
                  </div>
                </div>

                <div class="col-md-4 col-body position-relative">
                  <div class="form-group"  >
                    <label class="switch">
                      <input type="checkbox" name="plataforma" id="plataforma">
                    <span class="slider round"></span>
                    </label>
                    <span class="checkbox-initial">
                      PLATAFORMA
                    </span>
                  </div>
                </div>
                <div class="col-md-4 col-body position-relative" >
                  <div class="form-group" >
                    <label class="switch">
                      <input type="checkbox" name="todas" id="todas" checked>
                    <span class="slider round"></span>
                    </label>
                    <span class="checkbox-initial">
                      TODAS
                    </span>
                  </div>
                </div>


            </div>
<!-- ****************************************************Fin Botones de areas*****************************************************-->


            <div class="col-md-12 col-body">
                <div class="wrap" style="margin: auto;">
                    <button id="consult" type="submit" onclick="">Consultar</button>
                    <img src="https://www.dropbox.com/s/qfu4871umzhlcfo/check_arrow_2.svg?dl=1" alt="">
                    <svg width="66px" height="66px">
                    <circle class="circle_2" stroke-position="outside" stroke-width="3" fill="none" cx="34" cy="33" r="29" stroke="#1ECD97"></circle>
                    </svg>
                </div>
            </div>
        </div>
    </div>


</div>
<button id="graficos_pri" class="btn btn-warning grafico-pri" style="display: none;">Tiempos de Escalamiento</button>
<button id="graficos_deteccion" class="btn btn-danger graficos_deteccion" style="display: none;">Tiempos de Deteccion</button>
<button id="graficos_esc_dt" class="btn btn-success graficos_esc_dt" style="display: none;">Tiempo de Escalamiento + Tiempo de Deteccion</button>
<div id="grahp_prio" style="display: none;">
<div class="" style="display: flex; width: 100%; align-items: center; margin-top: 50px; flex-wrap: wrap;">
        <div class="col-md-12" id="P1" style=" margin-bottom: 30px; width: 70%;"></div>
        <div class="col-md-12" id="P2" style=" margin-bottom: 30px; width: 70%"></div>
        <div class="col-md-12" id="P3" style=" margin-bottom: 30px; width:70%"></div>
    </div>
</div>
    <div id="container_graphic" style="background: #26D8B2; display: none;">
        <div class="col-md-12" id="tiempo_det" style=" margin-bottom: 30px; width: 70%;"></div>
        <div class="col-md-12" id="tiempo_det2" style=" margin-bottom: 30px; width: 70%;"></div>
        <div class="col-md-12" id="tiempo_det3" style=" margin-bottom: 30px; width: 70%;"></div>
    </div>
    <div id="container_grahp_tetd" style="background: #26D8B2; display: none;">
        <div class="col-md-12" id="tetd1" style="margin-bottom: 30px; width: 70%;"></div>
        <div class="col-md-12" id="tetd2" style="margin-bottom: 30px; width: 70%;"></div>
        <div class="col-md-12" id="tetd3" style="margin-bottom: 30px; width: 70%;"></div>
    </div>
    <div class="col-md-12" id="container-graph4" style=" margin-bottom: 30px; width:50%"></div>
    <div class="col-md-12" id="container-result" style="display: flex;"></div>
</div>


<div id="modalInfo" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Detalle</h4>
      </div>
      <div class="modal-body" id="insert-content">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


</div>
<!-- <div id="container-graph" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div> -->


<!-- New view styles  -->
<link rel="stylesheet" href="<?= base_url ('assets/css/remake_styles.css');?>">

<script type="text/javascript" src="<?= base_url('assets/plugins/hightchart/code/highcharts.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/plugins/moments/moment.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/tiempo_deteccion.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/escala_deteccion.js');?>"></script>
<!-- <script type="text/javascript" src="<?=base_url('assets/js/modules/bitacoras.js');?>"></script> -->


<script>
$('#loader').hide();
$('.spinner-loader').hide();
var queryValue = "";
$('#fechaFinal').mask("99/99/9999");
$('#fechaInicio').mask("99/99/9999");

var activeInitialButton = false;
$('#onlyDateInitial').on('click', function(){
    activeInitialButton = (activeInitialButton == true) ? false : true ;
    if (activeInitialButton == true) {
        $('#fechaFinal').parent().attr('style', 'display: none;');
    } else {
        $('#fechaFinal').parent().attr('style', 'display:  block;');
    };

});
function test() {
    if (activeInitialButton == true) {
    // $('#fechaInicio').on('blur', function() {
        $('#fechaFinal').val($('#fechaInicio').val());
    // });
    }
};
//*********************************************Funcion para mostar y ocultar botones de areas***************************************************//
var activarArea = false;

$('#bitacoras-none').on('click', function(){
  activarArea = (activarArea == true) ? false : true ;
  if (activarArea === true) {
    $('#areas').attr('style', 'display:  block;');
  }else {
    $('#areas').attr('style', 'display:  none;');
  }
});


// ********************************************Fin Funcion para mostar y ocultar botones de areas****************************************************//
$(function(){
setInterval(test, 1000);
});


//Validacion para que solo sea seleccionable un checkbox
$('#areas   input[type=checkbox]').change(function(){
    if ($(this).is(':checked')) {
        $('#areas input[type="checkbox"]').not(this).prop('checked', false);
    }else {
      $('#todas').not(this).prop('checked', true);
    }
});//Cierre del checkbox


$('#consult').on('click', function(e) {
    helper.showLoading();

      var foservicio=$("#areas input[type='checkbox'][id='foservicio']:checked"); // Esto parece que no va
      var intermitencia=$("#areas input[type='checkbox'][id='intermitencia']:checked"); // Esto parece que no va
      var checks=$("#areas input[type='checkbox']:checked").length;
      var sql23 = "";

      getarea(e);
      function getarea(e){
          if (checks==0) {
              Swal.fire({
                  type: 'error',
                  title: 'Error',
                  text: 'No se seleciono ningun area',
                  })
              setTimeout("location.reload(true);", e);
          } else {

              var areas=$("#areas input[type='checkbox']:checked")
              for (i=0; i < areas.length; i++) {
                  console.log(areas[i].name);
                  switch (areas[i].name) {
                      case 'plataforma':
                          sql23 += "DESCRIPTION LIKE '%FAPP:%' OR DESCRIPTION LIKE '%FOIP:%'";
                      break;
                      case 'intermitencia':
                          sql23 += "DESCRIPTION LIKE '%FI:%'";
                      break;
                      case 'foservicio':
                          sql23 += "DESCRIPTION LIKE '%FAOC:%' OR DESCRIPTION LIKE '%FAOB:%'";
                      break;
                      case 'foenergia':
                          sql23 += "DESCRIPTION LIKE '%FEE:%'";
                      break;
                      case 'todas':
                          sql23 += "DESCRIPTION LIKE '%FEE:%' OR DESCRIPTION LIKE '%FAOC:%' OR DESCRIPTION LIKE '%FAOB:%' OR DESCRIPTION LIKE '%FI:%' OR DESCRIPTION LIKE '%FAPP:%' OR DESCRIPTION LIKE '%FOIP:%'";
                          break;
                      default:
                          break;
                  }
                   if(i != areas.length - 1) {
                      sql23 += " OR ";
                  };
              }
          }
      }

      $('#prioridad1').addClass('active');
      $('#prioridad2').addClass('active');
      $('#prioridad3').addClass('active');
      $('#graficos_pri').attr('style', 'display:block');

          var fechaInicio = $('#fechaInicio').val();
          var fechaFinal = $('#fechaFinal').val();

          var url = base_url + 'Front_Office_Movil/KPI/cargarInfo' + '/' + moment(fechaInicio, 'DD/MM/YYYY').format('YYYY-MM-DD') + '/' + moment(fechaFinal, 'DD/MM/YYYY').format('YYYY-MM-DD') ;
          var element = document.getElementById('container-result');
          load(url, element);
          function load(url, element)
          {
              req = new XMLHttpRequest();
              req.open("GET", url, false);
              req.send(null);
              element.innerHTML = req.responseText;
              createDatatable(url);
          }


          function createDatatable(link) {
              if (erTable_FO_table) {
                  var tabla = erTable_FO_table;
                  tabla.destroy();
              }
              erTable_FO_table = $("#FO_table").DataTable({
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
                      d.dt_name = "FO_table"
                      }
                  },
                  "drawCallback":function( settings, json){
                      queryValue = settings['json']['query'];
                  }
              });
          };

        $.post(base_url + "Front_Office_Movil/KPI/getGraphInfo", {
            inicio: fechaInicio,
            final: fechaFinal,
            condicion: sql23,
        }).done(function(data){
            var category = [];
            var pasaronP1 = [];
            var averageP1 = [];
            var noPasaronP1 = [];
            var pasaronP2 = [];
            var averageP2 = [];
            var noPasaronP2 = [];
            var pasaronP3 = [];
            var averageP3 = [];
            var noPasaronP3 = [];
            helper.hideLoading();
            var obj = JSON.parse(data);
            for (i = 0; i < obj.length; i++) {
                category.push(obj[i].the_date) ;

                pasaronP1.push(Number(obj[i].P1_PASARON));
                noPasaronP1.push(obj[i].P1_TOTAL - obj[i].P1_PASARON);
                averageP1.push((obj[i].P1_PASARON * 100) / obj[i].P1_TOTAL);

                pasaronP2.push(Number(obj[i].P2_PASARON));
                noPasaronP2.push(obj[i].P2_TOTAL - obj[i].P2_PASARON);
                averageP2.push((obj[i].P2_PASARON * 100) / obj[i].P2_TOTAL);

                pasaronP3.push(Number(obj[i].P3_PASARON));
                noPasaronP3.push(obj[i].P3_TOTAL - obj[i].P3_PASARON);
                averageP3.push((obj[i].P3_PASARON * 100) / obj[i].P3_TOTAL);
            }




            insertarGrafica(1, pasaronP1, noPasaronP1, averageP1, category, sql23);
            insertarGrafica(2, pasaronP2, noPasaronP2, averageP2, category, sql23);
            insertarGrafica(3, pasaronP3, noPasaronP3, averageP3, category, sql23);






            // window.open(base_url + "Front_Office_Movil/KPI/exportIncidentsFO");
        });

        $('#graficos_pri').on('click', function(){
            $("#grahp_prio").toggle();
        });


        $('#export-excel').on('click', function() {
          helper.showLoading();

                  $.post(base_url + "Front_Office_Movil/KPI/getIncidentsFO", {
                      query: queryValue.replace('LIMIT 10','')
                    }).done(function(){
                      helper.hideLoading();
                      window.open(base_url + "Front_Office_Movil/KPI/exportIncidentsFO");
                  });


        });

        $('#FO_table_filter').prepend('<i class="fas fa-search" id="search-icon"></i>');
        $('#FO_table_filter input').attr('id', 'search-input');

        let active = false;
        $('.contenedorMaestro').on('click', function(e){
            if(e.target.id === 'search' || e.target.id === 'search-input' || e.target.id === 'search-icon') {
                if(!active) {
                $('#FO_table_filter').addClass('active');
                // $('#modal_table_filter').addClass('active');
                $('#search-input').addClass('active');
                $('#search-icon').addClass('active');
                active = true;
                }
            } else {
                $('#FO_table_filter').removeClass('active');
                // $('#modal_table_filter').removeClass('active');
            $('#search-input').removeClass('active');
            $('#search-icon').removeClass('active');
            active = false;
            }
        });
  });



// numero = 1 o 2 o 3

  function insertarGrafica(numero, pasaron, noPasaron, average, category, sql23) {
    Highcharts.chart("P" + numero, {
        chart: {
            type: 'column'
        },
        colors: [
            '#5ac858',
            '#ff4c4c',
            '#ffa524'
        ],
        title: {
            text: 'TIEMPO DE ESCALAMIENTO FO MOVIL ' + 'P' + numero
        },
        xAxis: {
            categories: category
        },
        yAxis: {
            min: 0,
            title: {
                text: '# Incidentes'
            }
        },
        tooltip: {
            pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
            shared: true
        },
        plotOptions: {
            column: {
                stacking: 'percent',
                dataLabels: {
                    enabled: true,
                    style: {
                        textOutline: 0
                    }
                }
            },
            series: {
                cursor: 'pointer',
                point: {
                    events: {
                        click: function () {
                            helper.showLoading();

                            var fecha = this.category;
                            var condicion = this.sql23;
                            condicion=sql23.replace(/ /g,'_');
                            condicion=condicion.replace(/'/g,"-");
                            condicion=condicion.replace(/%/g,"=");

                            var url = base_url + 'Front_Office_Movil/KPI/loadModal' + '/' + fecha + '/' + numero + '/' + condicion;
                            var element = document.getElementById('insert-content');
                            load(url, element);
                            function load(url, element) {
                                req = new XMLHttpRequest();
                                req.open("GET", url, false);
                                req.send(null);
                                element.innerHTML = req.responseText;
                                createDatatable(url);
                                helper.hideLoading();
                            }


                            function createDatatable(link) {
                                erTable_modal_table = $("#modal_table").DataTable({
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
                                            d.dt_name = "modal_table"
                                        }
                                    },
                                    "drawCallback": function( settings, json){
                                                        queryValue = settings['json']['query'];
                                                    }
                                });
                            }

                            $('#modalInfo').modal('show');
                            $('#export-excel-modal').on('click', function() {
                                helper.showLoading();
                                $.post(base_url + "Front_Office_Movil/KPI/getIncidentsFO", {
                                    query: queryValue.replace('LIMIT 10','')
                                }).done(function(){
                                    helper.hideLoading();
                                    window.open(base_url + "Front_Office_Movil/KPI/exportIncidentsFO");
                                });
                            });
                            $('#modal_table_filter').prepend('<i class="fas fa-search" id="search-icon"></i>');
                            $('#modal_table_filter input').attr('id', 'search-input-modal');
                            let active = false;
                            $('#modalInfo').on('click', function(e){
                                if(e.target.id === 'search' || e.target.id === 'search-input-modal' || e.target.id === 'search-icon') {
                                    if(!active) {
                                        $('#FO_table_filter').addClass('active');
                                        $('#modal_table_filter').addClass('active');
                                        $('#search-input-modal').addClass('active');
                                        $('#search-icon').addClass('active');
                                        active = true;
                                    }
                                } else {
                                    $('#FO_table_filter').removeClass('active');
                                    $('#modal_table_filter').removeClass('active');
                                    $('#search-input-modal').removeClass('active');
                                    $('#search-icon').removeClass('active');
                                    active = false;
                                }
                            });


                        }
                    }
                }
            }
        },
        series: [{
                    name: 'SI',
                    data: pasaron
                }, {
                    name: 'NO',
                    data: noPasaron
                },
                {
                    type: 'spline',
                    name: 'Cumplimiento',
                    data: average,
                    marker: {
                        lineWidth: 2,
                        lineColor: Highcharts.getOptions().colors[3],
                        fillColor: 'white'
                    }
                }
                ],
    });
  }
</script>
<script src="<?= base_url("assets/js/backoffice.js?v" . validarEnProduccion())?>"></script>
