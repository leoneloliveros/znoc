$(function () {
    slas = {
        init: function () {
            slas.events();
            slas.getInfoReportSlas();
        },

        events: function () {
            $(`#newDate`).click(slas.getInfoReportSlas);
        },

        getInfoReportSlas: function () {
            if ($("#fDesde").val() <= $("#fHasta").val()) {
                $("#newDate,#fDesde, #fHasta").attr('disabled', true);
                $("#fDesde, #fHasta").css({'border-color': '#cccccc', 'box-shadow': 'unset'});
                helper.showLoading();

                $.post(base_url + "Reportes/c_getInfoReportSlas", {
                    desde: $(`#fDesde`).val(),
                    hasta: $(`#fHasta`).val(),
                },
                        function (data) {
                            const obj = JSON.parse(data);
                            $("#newDate,#fDesde, #fHasta").attr('disabled', false);
                            helper.hideLoading();
                            slas.printTableReportSlas(obj);
                            slas.getgrafica(obj);//llamada a la funcion para obtener la grafica
                        }
                );
            } else {
                helper.miniAlertN('Error, La fecha <u>DESDE</u> debe ser menor o igual a la fecha <u>HASTA</u>', 'error', '2500');
                $("#fDesde, #fHasta").css({
                    'border-color': '#d01818',
                    'box-shadow': '0 0 0 3px #ff000066'
                });
            }
        },
        printTableReportSlas: function (data) {
            if (slas.table_slas) {
                var tabla = slas.table_slas;
                tabla.clear().draw();
                tabla.rows.add(data);
                tabla.columns.adjust().draw();
                return;
            }
            // nombramos la variable para la tabla y llamamos la configuiracion que se encuentra en /assets/js/modules/helper.js
            slas.table_slas = $('#table_slas').DataTable(slas.configTableSimple(data, [
                {title: "coordinación", data: "coordinacion"},
                {title: "Urgencia alta, impacto alto<br>< = 20 min", data: "alta_alta_20_min"},
                {title: "Urgencia alta, impacto alto<br>> 20 min", data: "alta_alta_20_max"},
                {title: "Urgencia alta, impacto medio<br><= 40 min ", data: "alta_media_40_min"},
                {title: "Urgencia alta, impacto medio<br>> 40 min ", data: "alta_media_40_max"},
                {title: "Medias<br><= 60 Min", data: "medias_60_min"},
                {title: "Medias<br>> 60 Min", data: "medias_60_max"},
                {title: "Bajas<br><= 80 min", data: "bajas_80_min"},
                {title: "Bajas<br>> 80 min", data: "bajas_80_max"},
                {title: "Sin prioridad", data: "nulos"},
                {title: "Total incidentes", data: "total_incidentes"},
            ]));
        },

        configTableSimple: function (data, columns, onDraw) {
            return {
                data: data,
                columns: columns,
                "language": {
                    "url": base_url + "/assets/plugins/datatables/lang/es.json"
                },
                dom: 'Blfrtip',
                "searching": false,
                "paging": false,
                "ordering": false,
                "info": false,
                buttons: [
                    {
                        text: 'Excel <i class="fas fa-file-excel"></i>',
                        className: 'btn-cami_cool btn-special',
                        action: slas.downloadReportSlas,
                    },
                ],
                columnDefs: [{
                        defaultContent: "",
                        targets: -1,
                        orderable: false,
                    }],
                order: [
                    [0, 'asc']
                ],
                drawCallback: onDraw
            }
        },

        downloadReportSlas: function () {
            var desde = $('#fDesde').val();
            var hasta = $('#fHasta').val();
            window.location.href = base_url + "/Reportes/excelTiempoEscalamientoMovil/" + desde + "/" + hasta;
        },
        getgrafica: function(obj){
            // Highcharts.chart('grafica_r', {
            //     chart: {
            //         type: 'column',
            //     },
            //     title: {
            //         text: 'Incidentes FAOB'
            //     },
            //     xAxis: {
            //         categories: ['Urgencia alta, impacto alto< = 20 min', 'Urgencia alta, impacto alto> 20 min', 'Urgencia alta, impacto medio> 40 min', 'Urgencia alta, impacto medio<=40' , 'Medias<= 60 Min', 'Medias> 60 Min', 'Bajas<= 80 min', 'Bajas> 80 min', 'Sin prioridad', 'Total incidentes'],
            //     },
            //     yAxis: {
            //         min: 0,
            //         title: {
            //             text: 'Total de incidentes'
            //         }
            //     },
            //     tooltip: {
            //         shared: true,
            //     },
            //     plotOptions: {
            //         column: {
            //             pointPadding: 0.2,
            //             borderWidth: 0
            //         }
            //     },
            //     series: [{
            //             name: 'Urgencia alta - impacto alto<=20 min',
            //             data: [slas.getaltminv(obj)],
            //             color: '#084c6f'

            //         }, {
            //             name: 'Urgencia alta - impacto alto > 20 min',
            //             data: [slas.getaltmaxv(obj)],
            //             color: '#1b771a'

            //         }, {
            //             name: 'Urgencia alta - impacto medio > 40 min',
            //             data: [slas.getaltmaxc(obj)],
            //             color: '#5313c3'
            //         }, {
            //             name: 'Urgencia alta, impacto medio<=40', 
            //             data: [slas.getaltminc(obj)], 
            //             color: '#8888dd'
            //         },{
            //             name: 'Medias <= 60 Min',
            //             data: [slas.getmedmin(obj)],
            //             color:'#a45ddc'
            //         }, {
            //             name: 'Medias > 60 Min',
            //             data: [slas.getmedmax(obj)],
            //             color: '#c2cccc'
            //         }, {
            //             name: 'Bajas <= 80 min',
            //             data: [slas.getbajmin(obj)],
            //             color: '#785269'
            //         }, {
            //             name: 'Bajas > 80 min',
            //             data: [slas.getbajmax(obj)],
            //             color: '#d458das'
            //         }, {
            //             name: 'Sin prioridad',
            //             data: [slas.getsinprio(obj)],
            //             color: '#55555d'
            //         }, {
            //             name: 'Total incidentes',
            //             data: [slas.getincit(obj)],
            //             color: '#8888ff'
            //         }]
            // });
            Highcharts.stockChart('grafica_r', {
                chart: {
                    events: {
                        load: function () {
            
                            // set up the updating of the chart each second
                            var series = this.series[0];
                            setInterval(function () {
                                var x = (new Date()).getTime(), // current time
                                    y = Math.round(Math.random() * 100);
                                series.addPoint([x, y], true, true);
                            }, 1000);
                        }
                    }
                },
            
                time: {
                    useUTC: false
                },
            
                rangeSelector: {
                    buttons: [{
                        count: 1,
                        type: 'minute',
                        text: '1M'
                    }, {
                        count: 5,
                        type: 'minute',
                        text: '5M'
                    }, {
                        type: 'all',
                        text: 'All'
                    }],
                    inputEnabled: false,
                    selected: 0
                },
            
                title: {
                    text: 'Live random data'
                },
            
                exporting: {
                    enabled: false
                },
            
                series: [{
                    name: 'Random data',
                    data: (function () {
                        // generate an array of random data
                        var data = [],
                            time = (new Date()).getTime(),
                            i;
            
                        for (i = -999; i <= 0; i += 1) {
                            data.push([
                                time + i * 1000,
                                Math.round(Math.random() * 100)
                            ]);
                        }
                        // console.log(data);
                        return data;
                    }())
                }]
            });
            
        },
        getincit: function(obj){
            for (propiedad in obj[0]){//recorre las propiedades del objeto FAOB
                var totincidint= parseInt(obj[0].total_incidentes);//pasa a entero la propiedad
//                console.log(totincidint);
            }
            return totincidint;
        },
        getsinprio: function(obj){
            for (propiedad in obj[0]){
                var sinprioint=parseInt(obj[0].nulos);
//                console.log(sinprioint);
            }
            return sinprioint;
        },
        getbajmax: function(obj){
            for (propiedad in obj[0]){
                var bajmax=parseInt(obj[0].bajas_80_max);
//                console.log(bajmax); 
            }
            return bajmax;
        },
        getbajmin: function(obj){
            for (propiedad in obj[0]){
                var bajmin=parseInt(obj[0].bajas_80_min);
//                console.log(bajmin);
            }
            return bajmin;
        },
        getmedmax: function(obj){
            for (propiedad in obj[0]){
                var medmax=parseInt(obj[0].medias_60_max);
//                console.log(medmax);
            }
            return medmax;
        },
        getmedmin: function(obj){
            for (propiedad in obj[0]){
                var medmin=parseInt(obj[0].medias_60_min);
//                console.log(medmin);
            }
            return medmin;
        },
        getaltminc: function(obj){
            for (propiedad in obj[0]){
                var altminc=parseInt(obj[0].alta_media_40_min);
//                console.log(altminc);
            }
            return altminc;
        },
        getaltmaxc: function(obj){
            for (propiedad in obj[0]){
                var altmaxc=parseInt(obj[0].alta_media_40_max);
//                console.log(altmaxc);
            }
            return altmaxc;
        },
        getaltmaxv: function(obj){
            for (propiedad in obj[0]){
                var altmaxv=parseInt(obj[0].alta_alta_20_max);
//                console.log(altmaxv);
            }
            return altmaxv;
        },
        getaltminv: function(obj){
            for (propiedad in obj[0]){
                var altminv=parseInt(obj[0].alta_alta_20_min);
//                console.log(altminv);
            }
            return altminv;
        },
    }
    slas.init();
});