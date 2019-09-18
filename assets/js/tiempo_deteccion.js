$("#graficos_deteccion").on('click', function(){
  revisioncheck();
  function revisioncheck(){
    if ($("input[type='checkbox'][id='solohora']").prop("checked")) {
          graficarhorasdeteccion();
          
        }
    else{
      graficarlasnormales();
    }
  }
});//Cierre boton deteccion
function graficarhorasdeteccion(){
  $('#tiempo_det1').addClass('active');
  $('#tiempo_det2').addClass('active');
  $('#tiempo_det3').addClass('active');
  $('#container_graphic').attr('style', 'display:block');
  var fechaInicio = $('#fechaInicio').val();
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
          });//Cierre de la funcion de data
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
                            var fecha = category[0];
                            var condicion = this.sql23;
                            var hora= this.category;
                            condicion=sql23.replace(/ /g,'_');
                            condicion=condicion.replace(/'/g,"-");
                            condicion=condicion.replace(/%/g,"=");
                            var url = base_url + 'Front_Office_Movil/KPI/loadmodalhoras' + '/' + fecha + '/' + numero + '/' + condicion + '/' + hora;
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
}//Cierre graficarhoras

function graficarlasnormales(){
  $('#tiempo_det1').addClass('active');
  $('#tiempo_det2').addClass('active');
  $('#tiempo_det3').addClass('active');
  $('#container_graphic').attr('style', 'display:block');
  var fechaInicio = $('#fechaInicio').val();
  var fechaFinal = $('#fechaFinal').val();
  $.post(base_url + "Front_Office_Movil/KPI/getdetinfo", {
            inicio: fechaInicio,
            final: fechaFinal,
            peticion: sql23,
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
}
