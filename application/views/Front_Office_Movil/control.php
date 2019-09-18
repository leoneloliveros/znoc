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
                <input type="checkbox" class="form-check-input" id="solohora">
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

<div id="content-gaphs">
<div id="grahp_prio" style="display: none;">
<div class="" style="display: flex; width: 100%; align-items: center; margin-top: 50px; flex-wrap: wrap;">
        <div class="col-md-8 margin-bottom" id="P1" style=" margin-bottom: 30px; width: 70%;"></div>
        <div class="col-md-8 margin-bottom" id="P2" style=" margin-bottom: 30px; width: 70%"></div>
        <div class="col-md-8 margin-bottom" id="P3" style=" margin-bottom: 30px; width:70%"></div>
    </div>
</div>


    <div id="container_grahp_tetd" style="display: none;">
      <div class="" style="display: flex; width: 100%; align-items: center; margin-top: 50px; flex-wrap: wrap;">
        <div class="col-md-8 margin-bottom " id="tetd1" style="margin-bottom: 30px; width: 70%;"></div>
        <div class="col-md-8 margin-bottom " id="tetd2" style="margin-bottom: 30px; width: 70%;"></div>
        <div class="col-md-8 margin-bottom " id="tetd3" style="margin-bottom: 30px; width: 70%;"></div>
      </div>
    </div>

    <div id="container_graphic" style="display: none;">
      <div class="" style="display: flex; width: 100%; align-items: center; margin-top: 50px; flex-wrap: wrap;">
        <div class="col-md-8 margin-bottom " id="tiempo_det1" style=" margin-bottom: 30px; width: 70%;"></div>
        <div class="col-md-8 margin-bottom " id="tiempo_det2" style=" margin-bottom: 30px; width: 70%;"></div>
        <div class="col-md-8 margin-bottom " id="tiempo_det3" style=" margin-bottom: 30px; width: 70%;"></div>
      </div>
    </div>

  </div>

    <div class="col-md-12" id="container-graph4" style=" margin-bottom: 30px; width:50%"></div>
    <div class="col-md-12" id="container-result" style="display: flex;"></div>



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


<!-- New view styles-->
<link rel="stylesheet" href="<?= base_url ('assets/css/remake_styles.css');?>">

<script type="text/javascript" src="<?= base_url('assets/plugins/hightchart/code/highcharts.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/plugins/moments/moment.min.js');?>"></script>
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
var checks=$("#areas input[type='checkbox']:checked").length;
var sql23 = "";
var click=1;
var nuevaurl="";
$('#consult').on('click', function(e) {
    helper.showLoading();
    $('#graficos_deteccion').attr('style', 'display:block');
    $("#graficos_esc_dt").attr('style', 'display:block');
    eliminarcontenidourl(); 
        function eliminarcontenidourl(){
        if (click) {
          click+=1;
          console.log("cantidad de clicks"+" "+click);

        }
        else{
          console.log("No hubo click");
        }
        if (click>2) {

          /*url.replace(fechaInicio,' ');
          url.replace(fechaFinal,' ');
          url.replace(condicion,' ');*/
          console.log("Hubo mas de dos clicks");
        }
      }
      validarcheckhoras();
      function validarcheckhoras(){
        if ($("input[type='checkbox'][id='solohora']").prop("checked")) {
          graficarhoras(e);

        }//Cierre del if para el switch cuando este seleccionado
        else{
          peticiongraficas(e);
        }
      }//Cierre de la funcion validar checkhoras
  });

//----------------INICIO DE FUNCIONES PARA GRAFICAS NORMALES---------------
  function peticiongraficas(e){
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
      var fechaInicio = $('#fechaInicio').val();
      var fechaFinal = $('#fechaFinal').val();
      var condicion=sql23;
      condicion=sql23.replace(/ /g,'_');
      condicion=condicion.replace(/'/g,"-");
      condicion=condicion.replace(/%/g,"=");
      var url = base_url + 'Front_Office_Movil/KPI/cargarInfo' + '/' + moment(fechaInicio, 'DD/MM/YYYY').format('YYYY-MM-DD') + '/' + moment(fechaFinal, 'DD/MM/YYYY').format('YYYY-MM-DD') + '/' + condicion ;
      console.log(url);
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
        var erTable_FO_table;
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
      getescalamiento();
      getdeteccion();
      getescaladetec();
      function getescalamiento(){
        $('#prioridad1').addClass('active');
        $('#prioridad2').addClass('active');
        $('#prioridad3').addClass('active');
        $('#graficos_pri').attr('style', 'display:block');
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
                category.push(obj[i].the_date);
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

        });
        $('#graficos_pri').on('click', function(){
          $('#content-gaphs .active').removeClass('active');
            $("#grahp_prio ").addClass('active');
        });
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
                            var fecha = this.category
                            var nuevaFecha = fecha.split('/').reverse().join('-')
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
      }//Cierre de la funcion getescalamiento
      function getdeteccion(){
        $('#tiempo_det1').addClass('active');
        $('#tiempo_det2').addClass('active');
        $('#tiempo_det3').addClass('active');
        /*$('#container_graphic').attr('style', 'display:block');*/
        $.post(base_url + "Front_Office_Movil/KPI/getdetinfo", {
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
                // category.push(fechaInicio) ;
                // category.push(fechaInicio) ;
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
        });
        $('#graficos_deteccion').on('click', function(){
            $("#container_graphic").toggle();
        });
        function insertarGrafica(numero, pasaron, noPasaron, average, category, sql23) {
    Highcharts.chart("tiempo_det" + numero, {
        chart: {
            type: 'column'
        },
        colors: [
            '#5ac858',
            '#ff4c4c',
            '#ffa524'
        ],
        title: {
            text: 'TIEMPO DE DETECCION FO MOVIL ' + 'P' + numero
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
                            var fecha = this.category
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
      }//Cierre de la funcion getdeteccion
      function getescaladetec(){
        $('#tetd1').addClass('active');
        $('#tetd2').addClass('active');
        $('#tetd3').addClass('active');
        /*$('#container_grahp_tetd').attr('style', 'display:block');*/
        $.post(base_url + "Front_Office_Movil/KPI/getetdinfo", {
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
                // category.push(fechaInicio) ;
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
        });
        $('#graficos_esc_dt').on('click', function(){
            $("#container_grahp_tetd").toggle();
        });
        function insertarGrafica(numero, pasaron, noPasaron, average, category, sql23) {
    Highcharts.chart("tetd" + numero, {
        chart: {
            type: 'column'
        },
        colors: [
            '#5ac858',
            '#ff4c4c',
            '#ffa524'
        ],
        title: {
            text: 'TIEMPO DE ESCALAMIENTO + TIEMPO DE DETECCION FO MOVIL ' + 'P' + numero
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
                            var fecha = this.category
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
      }//Cierre de la funcion getescaladetec
}//Cierre de la funcion peticion graficas

//-----------------FIN DE LAS FUNCIONES PARA GRAFICAS NORMALES--------------


//----------------INICIO DE LAS FUNCIONES PARA GRAFICAS SEGUN HORAS---------
function graficarhoras(e){
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
                          sql23 = ""
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
      var fechaInicio = $('#fechaInicio').val();
      var fechaFinal = $('#fechaFinal').val();
      var condicion=sql23;
      condicion=sql23.replace(/ /g,'_');
      condicion=condicion.replace(/'/g,"-");
      condicion=condicion.replace(/%/g,"=");
      var url = base_url + 'Front_Office_Movil/KPI/cargarInfo' + '/' + moment(fechaInicio, 'DD/MM/YYYY').format('YYYY-MM-DD') + '/' + moment(fechaFinal, 'DD/MM/YYYY').format('YYYY-MM-DD') + '/' + condicion ;
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
        var erTable_FO_table;
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
      getescalamientohoras();
      getdeteccionhoras();
      getescaladetechoras();
      function getescalamientohoras(){
        $('#P1').addClass('active');
        $('#P2').addClass('active');
        $('#P3').addClass('active');
        $('#graficos_pri').attr('style', 'display:block');
        $.post(base_url + "Front_Office_Movil/KPI/getgraphinfohoras",{
                inicio:fechaInicio,
                condicion:sql23,
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
            var obj1 = JSON.parse(data);
            function gethoras(obj){
              var arreglo=[];
              for(i=0; i<=23;i++){
                var aux= obj.filter(info=>(info.hora==i));
                if (aux.length==0) {
                  arreglo.push(
                    {"the_date": obj[0].the_date ,"total": "0","hora": "0","P1_PASARON": "0","P1_TOTAL":"0","P2_PASARON":"0","P2_TOTAL":"0","P3_PASARON":"0","P3_TOTAL":"0"}
                    );
                }
                else{
                  arreglo.push(aux[0]);
                }
              }
              return arreglo;
            }

            obj = gethoras(obj1);
            
            for (i = 0; i < obj.length; i++) {
                category.push(obj[i].the_date);
                pasaronP1.push(Number(obj[i].P1_PASARON));
                noPasaronP1.push(obj[i].P1_TOTAL - obj[i].P1_PASARON);
                if (obj[i].P1_TOTAL != 0) { 
                averageP1.push((obj[i].P1_PASARON * 100) / obj[i].P1_TOTAL);
                } else {
                  averageP1.push(0);
                }
                pasaronP2.push(Number(obj[i].P2_PASARON));
                noPasaronP2.push(obj[i].P2_TOTAL - obj[i].P2_PASARON);
                if (obj[i].P2_TOTAL != 0) { 
                averageP2.push((obj[i].P2_PASARON * 100) / obj[i].P2_TOTAL);
                } else {
                  averageP2.push(0);
                }
                pasaronP3.push(Number(obj[i].P3_PASARON));
                noPasaronP3.push(obj[i].P3_TOTAL - obj[i].P3_PASARON);
                if (obj[i].P3_TOTAL != 0) { 
                averageP3.push((obj[i].P3_PASARON * 100) / obj[i].P3_TOTAL);
                } else {
                  averageP3.push(0);
                }

            }

            insertarGrafica(1, pasaronP1, noPasaronP1, averageP1, category, sql23);
            insertarGrafica(2, pasaronP2, noPasaronP2, averageP2, category, sql23);
            insertarGrafica(3, pasaronP3, noPasaronP3, averageP3, category, sql23);
          });
          $('#graficos_pri').on('click', function(){
            $("#grahp_prio").toggle();
        });
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
            categories: ["00:00", "01:00", "02:00", "03:00", "04:00", "05:00", "06:00", "07:00", "08:00", "09:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00", "17:00", "18:00", "19:00", "20:00", "21:00", "22:00", "23:00"]
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
                            var fecha = $('#fechaInicio').val();
                            var nuevaFecha = fecha.split('/').reverse().join('-')
                            var condicion = this.sql23;
                            var hora= this.category;
                            condicion=sql23.replace(/ /g,'_');
                            condicion=condicion.replace(/'/g,"-");
                            condicion=condicion.replace(/%/g,"=");
                            var url = base_url + 'Front_Office_Movil/KPI/loadmodalhoras' + '/' + nuevaFecha + '/' + numero + '/' + condicion + '/' + hora;
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
                    },
                }
                ],
                
    });
  }

      }//Cierre de la funcion getescalamientohoras
      function getdeteccionhoras(){
        $('#tiempo_det1').addClass('active');
        $('#tiempo_det2').addClass('active');
        $('#tiempo_det3').addClass('active');
        /*$('#container_graphic').attr('style', 'display:block');*/
        $.post(base_url + "Front_Office_Movil/KPI/getdetechoras",{
                inicio:fechaInicio,
                condicion:sql23,
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
            var obj1 = JSON.parse(data);
            function gethoras(obj){
              var arreglo=[];
              for(i=0; i<=23;i++){
                var aux= obj.filter(info=>(info.hora==i));
                if (aux.length==0) {
                  arreglo.push(
                    {"the_date": obj[0].the_date ,"total": "0","hora": "0","P1_PASARON": "0","P1_TOTAL":"0","P2_PASARON":"0","P2_TOTAL":"0","P3_PASARON":"0","P3_TOTAL":"0"}
                    );
                }
                else{
                  arreglo.push(aux[0]);
                }
              }
              return arreglo;
            }

            obj = gethoras(obj1);
            
            for (i = 0; i < obj.length; i++) {
                category.push(obj[i].the_date);
                pasaronP1.push(Number(obj[i].P1_PASARON));
                noPasaronP1.push(obj[i].P1_TOTAL - obj[i].P1_PASARON);
                if (obj[i].P1_TOTAL != 0) { 
                averageP1.push((obj[i].P1_PASARON * 100) / obj[i].P1_TOTAL);
                } else {
                  averageP1.push(0);
                }
                pasaronP2.push(Number(obj[i].P2_PASARON));
                noPasaronP2.push(obj[i].P2_TOTAL - obj[i].P2_PASARON);
                if (obj[i].P2_TOTAL != 0) { 
                averageP2.push((obj[i].P2_PASARON * 100) / obj[i].P2_TOTAL);
                } else {
                  averageP2.push(0);
                }
                pasaronP3.push(Number(obj[i].P3_PASARON));
                noPasaronP3.push(obj[i].P3_TOTAL - obj[i].P3_PASARON);
                if (obj[i].P3_TOTAL != 0) { 
                averageP3.push((obj[i].P3_PASARON * 100) / obj[i].P3_TOTAL);
                } else {
                  averageP3.push(0);
                }

            }

            insertarGrafica(1, pasaronP1, noPasaronP1, averageP1, category, sql23);
            insertarGrafica(2, pasaronP2, noPasaronP2, averageP2, category, sql23);
            insertarGrafica(3, pasaronP3, noPasaronP3, averageP3, category, sql23);
          });
          $('#graficos_deteccion').on('click', function(){
            $("#container_graphic").toggle();
        });
          function insertarGrafica(numero, pasaron, noPasaron, average, category, sql23) {
    Highcharts.chart("tiempo_det" + numero, {
        chart: {
            type: 'column'
        },
        colors: [
            '#5ac858',
            '#ff4c4c',
            '#ffa524'
        ],
        title: {
            text: 'TIEMPO DE DETECCION FO MOVIL ' + 'P' + numero
        },
        xAxis: {
            categories: ["00:00", "01:00", "02:00", "03:00", "04:00", "05:00", "06:00", "07:00", "08:00", "09:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00", "17:00", "18:00", "19:00", "20:00", "21:00", "22:00", "23:00"]
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
                            var fecha = $('#fechaInicio').val();
                            var nuevaFecha = fecha.split('/').reverse().join('-')
                            var condicion = this.sql23;
                            var hora= this.category;
                            condicion=sql23.replace(/ /g,'_');
                            condicion=condicion.replace(/'/g,"-");
                            condicion=condicion.replace(/%/g,"=");
                            var url = base_url + 'Front_Office_Movil/KPI/loadmodalhoras' + '/' + nuevaFecha + '/' + numero + '/' + condicion + '/' + hora;
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
                    },
                }
                ],
                
    });
  }
      }//Cierre de la funcion getdeteccionhoras
      function getescaladetechoras(){
        $('#tetd1').addClass('active');
        $('#tetd2').addClass('active');
        $('#tetd3').addClass('active');
        /*$('#container_grahp_tetd').attr('style', 'display:block');*/
        $.post(base_url + "Front_Office_Movil/KPI/getEDhoras",{
                inicio:fechaInicio,
                condicion:sql23,
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
            var obj1 = JSON.parse(data);
            function gethoras(obj){
              var arreglo=[];
              for(i=0; i<=23;i++){
                var aux= obj.filter(info=>(info.hora==i));
                if (aux.length==0) {
                  arreglo.push(
                    {"the_date": obj[0].the_date ,"total": "0","hora": "0","P1_PASARON": "0","P1_TOTAL":"0","P2_PASARON":"0","P2_TOTAL":"0","P3_PASARON":"0","P3_TOTAL":"0"}
                    );
                }
                else{
                  arreglo.push(aux[0]);
                }
              }
              return arreglo;
            }

            obj = gethoras(obj1);
            
            for (i = 0; i < obj.length; i++) {
                category.push(obj[i].the_date);
                pasaronP1.push(Number(obj[i].P1_PASARON));
                noPasaronP1.push(obj[i].P1_TOTAL - obj[i].P1_PASARON);
                if (obj[i].P1_TOTAL != 0) { 
                averageP1.push((obj[i].P1_PASARON * 100) / obj[i].P1_TOTAL);
                } else {
                  averageP1.push(0);
                }
                pasaronP2.push(Number(obj[i].P2_PASARON));
                noPasaronP2.push(obj[i].P2_TOTAL - obj[i].P2_PASARON);
                if (obj[i].P2_TOTAL != 0) { 
                averageP2.push((obj[i].P2_PASARON * 100) / obj[i].P2_TOTAL);
                } else {
                  averageP2.push(0);
                }
                pasaronP3.push(Number(obj[i].P3_PASARON));
                noPasaronP3.push(obj[i].P3_TOTAL - obj[i].P3_PASARON);
                if (obj[i].P3_TOTAL != 0) { 
                averageP3.push((obj[i].P3_PASARON * 100) / obj[i].P3_TOTAL);
                } else {
                  averageP3.push(0);
                }

            }

            insertarGrafica(1, pasaronP1, noPasaronP1, averageP1, category, sql23);
            insertarGrafica(2, pasaronP2, noPasaronP2, averageP2, category, sql23);
            insertarGrafica(3, pasaronP3, noPasaronP3, averageP3, category, sql23);
          });
          $('#graficos_esc_dt').on('click', function(){
            $("#container_grahp_tetd").toggle();
        });
          function insertarGrafica(numero, pasaron, noPasaron, average, category, sql23) {
    Highcharts.chart("tetd" + numero, {
        chart: {
            type: 'column'
        },
        colors: [
            '#5ac858',
            '#ff4c4c',
            '#ffa524'
        ],
        title: {
            text: 'TIEMPO DE ESCALAMIENTO + TIEMPO DETECCION FO MOVIL' + 'P' + numero
        },
        xAxis: {
            categories: ["00:00", "01:00", "02:00", "03:00", "04:00", "05:00", "06:00", "07:00", "08:00", "09:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00", "17:00", "18:00", "19:00", "20:00", "21:00", "22:00", "23:00"]
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
                            var fecha = $('#fechaInicio').val();
                            var nuevaFecha = fecha.split('/').reverse().join('-')
                            var condicion = this.sql23;
                            var hora= this.category;
                            condicion=sql23.replace(/ /g,'_');
                            condicion=condicion.replace(/'/g,"-");
                            condicion=condicion.replace(/%/g,"=");
                            var url = base_url + 'Front_Office_Movil/KPI/loadmodalhoras' + '/' + nuevaFecha + '/' + numero + '/' + condicion + '/' + hora;
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
                    },
                }
                ],
                
    });
  }
      }

          
}//Cierre de la funcion graficarhoras

//-----------------------FIN DE FUNCIONES PARA GRAFICAS SEGUN HORA----------
</script>
<script src="<?= base_url("assets/js/backoffice.js?v" . validarEnProduccion())?>"></script>
