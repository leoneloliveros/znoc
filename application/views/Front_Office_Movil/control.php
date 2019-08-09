
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
<div class="" style="display: flex; width: 100%; align-items: center; margin-top: 50px; flex-wrap: wrap;">
    <div class="col-md-12" id="prioridad1" style=" margin-bottom: 30px; width: 70%;"></div>
    <div class="col-md-12" id="prioridad2" style=" margin-bottom: 30px; width: 70%"></div>
    <div class="col-md-12" id="prioridad3" style=" margin-bottom: 30px; width:70%"></div>
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

<script>
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
        $('#loader').show();
        $('.spinner-loader').show();
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

            $('#loader').hide();
            $('.spinner-loader').hide();
        }


        function createDatatable(link) {
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
                            text: 'Prioridad 1'
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
                            text: 'Prioridad 2'
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
                            text: 'Prioridad 3'
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
<script src="<?= base_url("assets/js/backoffice.js?v" . validarEnProduccion())?>"></script>
