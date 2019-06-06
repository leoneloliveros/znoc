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
                {title: "Urgencia alta, impacto alto", data: "alta_alta_20_min"},
                {title: "Urgencia alta, impacto medio", data: "alta_media_40_min"},
                {title: "Medias", data: "medias_60"},
                {title: "Bajas", data: "bajas_80"},
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
    }
    slas.init();
});