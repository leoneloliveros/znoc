
$('#consult').on('click', function() {
    $('#tetd1').addClass('active').attr('style', 'display:block');
    $('#tetd2').addClass('active').attr('style', 'display:block');
    $('#tetd3').addClass('active').attr('style', 'display:block');
    $('#graficos_esc_dt').attr('style', 'display:block');
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
        $.post(base_url + "Front_Office_Movil/KPI/getetdinfo", {
                    inicial: fechaInicio,
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
                        

                        
                    Highcharts.chart('tetd1', {
                        chart: {
                            type: 'column'
                        },
                        colors: [
                            '#5ac858',
                            '#ff4c4c',
                            '#ffa524'
                        ],
                        title: {
                            text: 'TIEMPO DE ESCALAMIENTO + TIEMPO DETECION FO MOVIL P1'
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
cargar(url, element);
function cargar(url, element)
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
                    });//Cierre del highchart
    Highcharts.chart('tetd2',{
        chart: {
                            type: 'column'
                        },
                        colors: [
                            '#5ac858',
                            '#ff4c4c',
                            '#ffa524'
                        ],
                        title: {
                            text: 'TIEMPO DE ESCALAMIENTO + TIEMPO DETECION FO MOVIL P2'
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
cargar(url, element);
function cargar(url, element)
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
                            {
        type: 'spline',
        name: 'Cumplimiento',
        data: averageP2,
        marker: {
            lineWidth: 2,
            lineColor: Highcharts.getOptions().colors[3],
            fillColor: 'white'
        }
    }
                        ],
    });//Cierre del segundo highchart
    Highcharts.chart('tetd3', {
        chart: {
                            type: 'column'
                        },
                        colors: [
                            '#5ac858',
                            '#ff4c4c',
                            '#ffa524'
                        ],
                        title: {
                            text: 'TIEMPO DE ESCALAMIENTO + TIEMPO DETECION FO MOVIL P3'
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
cargar(url, element);
function cargar(url, element)
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
                            },
                            {
        type: 'spline',
        name: 'Cumplimiento',
        data: averageP3,
        marker: {
            lineWidth: 2,
            lineColor: Highcharts.getOptions().colors[3],
            fillColor: 'white'
        }
    }
                        ],
    });//Cierre del tercer highchart
 });//Cierre de data
$('#graficos_esc_dt').on('click', function(){
    $('#container_grahp_tetd').toggle();
});
});//Cierre del boton consultar


