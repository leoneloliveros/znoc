
<link rel="stylesheet" href="<?= base_url("assets/css/bitacoras_new-style.css") ?>">
<style type="text/css">
    .loader{
        display: none;
    }
</style>
<div class="main-title" style="width: 60%;">
    <span>
    Control KPI
    </span>
    <span id='subtitle'>
    <i class="fas fa-code-branch"></i> Front Office Movil
    </span>
  
</div>

<div style="display:flex; justify-content: center;">
    <div class="card-style">
        <div class="general">
            <div class="switch-container col-md-12 position-relative form-group">
                <label class="switch">
                <input type="checkbox" class="form-check-input">
                <span id="onlyDateInitial" class="slider round"></span>
                </label>
                <span class="checkbox-initial">
                    Solo Fecha de Inicio
                </span>

            </div>
            <div>
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
            </div>
            <div class="col-md-12 col-body">
                <div class="wrap" style="margin: auto;">
                    <button id="consult" type="submit">Consultar</button>
                    <img src="https://www.dropbox.com/s/qfu4871umzhlcfo/check_arrow_2.svg?dl=1" alt="">
                    <svg width="66px" height="66px">
                    <circle class="circle_2" stroke-position="outside" stroke-width="3" fill="none" cx="34" cy="33" r="29" stroke="#1ECD97"></circle>
                    </svg>
                </div>
            </div>
        </div>
    </div>
    

</div>
<button id="graficos_deteccion" style="display: none;">Tiempos de deteccion</button>
<button id="graficos_esc_dt" style="display: none;">TE+TD</button>
<div class="" style="display: flex; width: 100%; align-items: center; margin-top: 50px; flex-wrap: wrap;">
        <div class="col-md-12" id="prioridad1" style=" margin-bottom: 30px; width: 70%;"></div>
        <div class="col-md-12" id="prioridad2" style=" margin-bottom: 30px; width: 70%"></div>
        <div class="col-md-12" id="prioridad3" style=" margin-bottom: 30px; width:70%"></div>
    </div>
    <div id="container_graphic" style="background: #26D8B2; display: none;">
        <div class="col-md-12" id="tiempo_det" style=" margin-bottom: 30px; width: 70%;"></div>
        <div class="col-md-12" id="tiempo_det2" style=" margin-bottom: 30px; width: 70%;"></div>
        <div class="col-md-12" id="tiempo_det3" style=" margin-bottom: 30px; width: 70%;"></div>
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

<!-- <div id="deteccionModal" class="modal fade bs-example-modal-lg" tabindex="-1" role='dialog'>
    <div class="modal-dialog modal-dialog modal-lg" role="dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4>Tiempo de deteccion y sus prioridades</h4>
            </div>
            <div class="modal-body" id="insertar-graficas"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>   
        </div>
    </div>
</div> -->
    

</div>
<!-- <div id="container-graph" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div> -->
<style>
    #fechaInicio{
        height: 77px;
    }
    #fechaFinal{
        height: 77px;
    }
    #container-result {
        /* display: none; */
        /* min-height: 500px; */
        height: auto;
        margin-top: 30px;
    }
    @media only screen and (max-width: 767px)  {
       .contenedorMaestro {
        margin-top: 80px;
       } 
    }

    .main-footer a {
        color:white;
        font-weight: bold;
    }
    

    .checkbox-initial {
        position: absolute;
        left: 74px;
        font-size: 17px;
        font-weight: 400;
        top: 2px;
        width: 85%;
        display: flex;
        justify-content: space-between;
    }
    .switch {
        position: relative;
        display: inline-block;
        width: 90px;
        height: 51px;
        margin: 0;
        }

        .switch input { 
        display: none;
        }

        #prioridad1.active, #prioridad2.active, #prioridad3.active, #tiempo_det.active, #tiempo_det2.active, #tiempo_det3.active {
            margin-bottom: 30px;
    width: 70%;
    overflow: hidden;
    position: relative;
    overflow: hidden;
    /* width: 772px; */
    /* height: 400px; */
    text-align: left;
    line-height: normal;
    z-index: 0;
    -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    background-color: #FFFFFF;
    box-shadow: 0 29px 32px -20px rgba(0,0,0,0.5), 0 4px 11px -3px rgba(0,0,0,0.25);
    padding: 20px;
    border-radius: 10px;
    margin-top: -50px;
    position: relative;
    /* z-index: 4; */
    transition: all 0.3s ease;
    margin: 30px 40px;
    /* min-height: 655px; */
    /* height: 100%; */
    margin-top: 10px;
        }

        .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #cdcdcd;
        transition: 0.4s;
        width: 54%;
            height: 54%;

        }

        .slider::before {
        position: absolute;
        content: "";
        height: 15px;
        width: 15px;
        left: 6px;
        bottom: 6px;
        background-color: #ffffff;
        transition: 0.4s;
        }

        input:checked + .slider {
        background-color: #4caf50;
        }

        input:focus + .slider {
        box-shadow: 0 0 1px #4caf50;
        }

        input:checked + .slider::before {
        transform: translateX(22px);
        }

        .slider.round {
        border-radius: 34px;
        }

        .slider.round::before {
        border-radius: 50%;
        }





        .wrap {
            top: 17px;
            height: 1px;
        }
        .wrap button{
            background: #1ECD97;
            color: white;
            box-shadow: 0 29px 32px -20px rgba(0,0,0,0.5), 0 4px 11px -3px rgba(0,0,0,0.25);
        }
        .wrap button:hover{
            background: #7e65c0;
            border: 2px solid #7e65c0;
            color: white;
        }
            .card-style{
                min-height: 164px;
                width: 60%;
                display: flex;
            justify-content: center;
            }

        #FO_table {
            color: black;
            background: white;
            border: none;
        }

        #FO_table_paginate{
            height: 0px;
        }
        #modal_table {
            color: black;
            background: white;
            border: none;
        }

        #modal_table_paginate{
            height: 0px;
        }
        #modal_table_next{
            display: block;
            position: absolute;
            top: 50%;
            right: -1%;
            box-shadow: 0 29px 32px -20px rgba(0,0,0,0.5), 0 4px 11px -3px rgba(0,0,0,0.25);
        }
        #modal_table_previous{
            display: block;
            position: absolute;
            top: 50%;
            left: -1%;
            box-shadow: 0 29px 32px -20px rgba(0,0,0,0.5), 0 4px 11px -3px rgba(0,0,0,0.25);
}

        li.paginate_button {
            display: none;
        }
        #FO_table_next{
            display: block;
            position: absolute;
            top: 50%;
            right: -1%;
            box-shadow: 0 29px 32px -20px rgba(0,0,0,0.5), 0 4px 11px -3px rgba(0,0,0,0.25);
        }
        #FO_table_previous{
            display: block;
            position: absolute;
            top: 50%;
            left: -1%;
            box-shadow: 0 29px 32px -20px rgba(0,0,0,0.5), 0 4px 11px -3px rgba(0,0,0,0.25);
}
        }

        
</style>
<script type="text/javascript" src="<?= base_url('assets/plugins/hightchart/code/highcharts.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/plugins/moments/moment.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/tiempo_deteccion.js');?>"></script>
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
$(function(){
setInterval(test, 1000);
});

$('#consult').on('click', function() {
    
    $('#prioridad1').addClass('active');
    $('#prioridad2').addClass('active');
    $('#prioridad3').addClass('active');
    /*$('#tiempo_det').addClass('active');
    $('#tiempo_det2').addClass('active');
    $('#tiempo_det3').addClass('active');*/
    $('#loader').show();
        $('.spinner-loader').show();
        var fechaInicio = $('#fechaInicio').val();
        var fechaFinal = $('#fechaFinal').val();

        var url = base_url + 'Front_Office_Movil/KPI/cargarInfo' + '/' + moment(fechaInicio, 'DD/MM/YYYY').format('YYYY-MM-DD') + '/' + moment(fechaFinal, 'DD/MM/YYYY').format('YYYY-MM-DD') ;
        var element = document.getElementById('container-result');
        /*recibirfechas(fechaInicio,fechaFinal,url,element);*/
        /*recibirdata();*/
        load(url, element);
        function load(url, element)
        {
            req = new XMLHttpRequest();
            req.open("GET", url, false);
            req.send(null);
            element.innerHTML = req.responseText;
            createDatatable(url);

            $('#loader').hide();
            $('.spinner-loader').hide();
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
        }


        $.post(base_url + "Front_Office_Movil/KPI/getGraphInfo", {
                    inicio: fechaInicio,
                    final: fechaFinal
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
                    $('#loader').hide();
                    $('.spinner-loader').hide();
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
                        

                        
                    Highcharts.chart('prioridad1', {
                        chart: {
                            type: 'column'
                        },
                        colors: [
                            '#5ac858',
                            '#ff4c4c',
                            '#ffa524'
                        ],
                        title: {
                            text: 'TIEMPO DE ESCALAMIENTO FO MOVIL P1'
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



$('#loader').show();
$('.spinner-loader').show();
var fecha = this.category;

var url = base_url + 'Front_Office_Movil/KPI/loadModal' + '/' + fecha  + '/1';
var element = document.getElementById('insert-content');
load(url, element);
function load(url, element)
{
req = new XMLHttpRequest();
req.open("GET", url, false);
req.send(null);
element.innerHTML = req.responseText;
createDatatable(url);

$('#loader').hide();
$('.spinner-loader').hide();
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
"drawCallback":function( settings, json){
queryValue = settings['json']['query'];
}
});
}

$('#modalInfo').modal('show');
$('#export-excel-modal').on('click', function() {
        $('#loader').show();
        $('.spinner-loader').show();
                $.post(base_url + "Front_Office_Movil/KPI/getIncidentsFO", {
                    query: queryValue.replace('LIMIT 10','')
                  }).done(function(){
                    $('#loader').hide();
                    $('.spinner-loader').hide();
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
                            data: pasaronP1
                            }, {
                                name: 'NO',
                                data: noPasaronP1
                            },
                            {
        type: 'spline',
        name: 'Cumplimiento',
        data: averageP1,
        marker: {
            lineWidth: 2,
            lineColor: Highcharts.getOptions().colors[3],
            fillColor: 'white'
        }
    }
                        ],
                    });

                    Highcharts.chart('prioridad2', {
                      
                        chart: {
                            type: 'column'
                        },
                        colors: [
                            '#5ac858',
                            '#ff4c4c',
                            '#ffa524'
                            
                            
                    ],
                        title: {
                            text: 'TIEMPO DE ESCALAMIENTO FO MOVIL P2'
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



$('#loader').show();
$('.spinner-loader').show();
var fecha = this.category;

var url = base_url + 'Front_Office_Movil/KPI/loadModal' + '/' + fecha  + '/2';
var element = document.getElementById('insert-content');
load(url, element);
function load(url, element)
{
req = new XMLHttpRequest();
req.open("GET", url, false);
req.send(null);
element.innerHTML = req.responseText;
createDatatable(url);

$('#loader').hide();
$('.spinner-loader').hide();
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
"drawCallback":function( settings, json){
queryValue = settings['json']['query'];
}
});
}

$('#modalInfo').modal('show');
$('#export-excel-modal').on('click', function() {
        $('#loader').show();
        $('.spinner-loader').show();
                $.post(base_url + "Front_Office_Movil/KPI/getIncidentsFO", {
                    query: queryValue.replace('LIMIT 10','')
                  }).done(function(){
                    $('#loader').hide();
                    $('.spinner-loader').hide();
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
                            data: pasaronP2
                        }, {
                            name: 'NO',
                            data: noPasaronP2
                        },
                        {type: 'spline',
        name: 'Cumplimiento',
        data: averageP2,
        marker: {
            lineWidth: 2,
            lineColor: Highcharts.getOptions().colors[3],
            fillColor: 'white'
        }
    }
                    ]
                    });



                    Highcharts.chart('prioridad3', {
                        chart: {
                            type: 'column'
                        },
                        colors: [
                            '#5ac858',
                            '#ff4c4c',
                            '#ffa524'
                            
                            
                    ],
                        title: {
                            text: 'TIEMPO DE ESCALAMIENTO FO MOVIL P3'
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



$('#loader').show();
$('.spinner-loader').show();
var fecha = this.category;

var url = base_url + 'Front_Office_Movil/KPI/loadModal' + '/' + fecha  + '/3';
var element = document.getElementById('insert-content');
load(url, element);
function load(url, element)
{
req = new XMLHttpRequest();
req.open("GET", url, false);
req.send(null);
element.innerHTML = req.responseText;
createDatatable(url);

$('#loader').hide();
$('.spinner-loader').hide();
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
"drawCallback":function( settings, json){
queryValue = settings['json']['query'];
}
});
}

$('#modalInfo').modal('show');
$('#export-excel-modal').on('click', function() {
        $('#loader').show();
        $('.spinner-loader').show();
                $.post(base_url + "Front_Office_Movil/KPI/getIncidentsFO", {
                    query: queryValue.replace('LIMIT 10','')
                  }).done(function(){
                    $('#loader').hide();
                    $('.spinner-loader').hide();
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
                            data: pasaronP3
                        }, {
                            name: 'NO',
                            data: noPasaronP3
                        }, {
                        type: 'spline',
        name: 'Cumplimiento',
        data: averageP3,
        marker: {
            lineWidth: 2,
            lineColor: Highcharts.getOptions().colors[3],
            fillColor: 'white'
        }
    }
                    ]
                    });

                    

                        
                    // window.open(base_url + "Front_Office_Movil/KPI/exportIncidentsFO");
                });


        $('#export-excel').on('click', function() {
        $('#loader').show();
        $('.spinner-loader').show();
                $.post(base_url + "Front_Office_Movil/KPI/getIncidentsFO", {
                    query: queryValue.replace('LIMIT 10','')
                  }).done(function(){
                    $('#loader').hide();
                    $('.spinner-loader').hide();
                    window.open(base_url + "Front_Office_Movil/KPI/exportIncidentsFO");
                });
                    
                      
    });




        
        $('#FO_table_filter').prepend('<i class="fas fa-search" id="search-icon"></i>');
        $('#FO_table_filter input').attr('id', 'search-input');
        
        // var l = $('#FO_table_filter label');
        // l.html(l.find('input'));
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

</script>



<style>
     body, .content-wrapper, .main-footer {
        background: #24C6DC;  /* fallback for old browsers */
background: -webkit-linear-gradient(to bottom, #514A9D, #24C6DC);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to bottom, #514A9D, #24C6DC); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

    }

    body {
        background: #504b9d;
    }


    .main-footer {
        background: #24c6dc;
    }

    #subtitle {
        font-size: 12px;


    }

    .main-title {
        width: 91% !important;
    display: flex;
    justify-content: space-between;
    align-items: center;
    }


    .table-new{
        margin: 0;
    }

    #FO_table tbody td, #modal_table tbody td {
    .td-some-name {: ;
    white-space: nowrap;
    width: 237px;
    vertical-align: top;
    }: ;
    white-space: nowrap;
    /* width: 307px; */
    vertical-align: top;
    padding: 10px;
}

#FO_table_processing, #modal_table_processing {
    display:none !important;
}


div#FO_table_filter, #modal_table_filter {
    height: 40px;
    width: 40px;
    border: solid 5px;
    border-radius: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 15PX;
    transition: 0.3s;
    position: absolute;
    top: -46px;
    left: 47px;
    cursor: pointer;
    color: white;
            }

            #modal_table_filter {
                color: black;
            }

            #insert-content {
                margin-top: 40px;
            }
            

            #search-input, #search-input-modal {
            height: 100%;
            width: 0px;
            font-size: 15px;
            font-weight: 600;
            background: none;
            color: #FFF;
            border: none;
            outline: 0;
            visibility: hidden;
            transition: 0.3s;
            
            }

            #search-input-modal {
                color: black
            }

            #FO_table_filter.active, #modal_table_filter.active {
            width: 209px;
            }

            #search-input.active, #search-input-modal.active {
            width: 209px;
            margin-left: 5px;
            visibility: visible;
            margin-top: 9px;
            margin-top: -19px;
            padding-right: 42px;
            }

             #search-icon.active {
                padding-left: 25px;
            }
            #FO_table_filter label, #modal_table_filter label {
                color: transparent;
            }

            #search-icon {
                padding-left: 28px;
            }

            input:-webkit-autofill,
input:-webkit-autofill:hover, 
input:-webkit-autofill:focus,
textarea:-webkit-autofill,
textarea:-webkit-autofill:hover,
textarea:-webkit-autofill:focus,
select:-webkit-autofill,
select:-webkit-autofill:hover,
select:-webkit-autofill:focus, #search-input:-webkit-autofill {
    transition: background-color 5000s ease-in-out 0s;
}
#search-input:-webkit-autofill {
    -webkit-text-fill-color: #fff !important;
}


#export-excel, #export-excel-modal{
    height: 40px;
    width: 40px;
    border: solid 5px;
    border-radius: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 15PX;
    transition: 0.3s;
    position: absolute;
    top: -45px;
    color: white;
    cursor: pointer;
}

#export-excel-modal {
    color: black;
    top: -30px;
}
</style>