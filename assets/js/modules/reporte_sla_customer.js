$(function () {
    slas_customer = {
        init: function () {
            slas_customer.events();
            slas_customer.getInfoReportSlas();
        },

        events: function () {
            $(`#newDate`).click(slas_customer.getInfoReportSlas);
        },

        getInfoReportSlas: function () {
            if ($("#fDesde").val() <= $("#fHasta").val()) {
                $("#newDate,#fDesde, #fHasta").attr('disabled', true);
                $("#fDesde, #fHasta").css({'border-color': '#cccccc', 'box-shadow': 'unset'});
                helper.showLoading();

                $.post(base_url + "Reportes/c_getInfoReportSlasCustomer", {
                    desde: $(`#fDesde`).val(),
                    hasta: $(`#fHasta`).val(),
                },
                        function (data) {
                            const obj = JSON.parse(data);
                            $("#newDate,#fDesde, #fHasta").attr('disabled', false);
                            helper.hideLoading();
                            slas_customer.printTableReportSlas(obj);
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
            if (slas_customer.table_slas_customer) {
                var tabla = slas_customer.table_slas_customer;
                tabla.clear().draw();
                tabla.rows.add(data);
                tabla.columns.adjust().draw();
                return;
            }
            // nombramos la variable para la tabla y llamamos la configuiracion que se encuentra en /assets/js/modules/helper.js
            slas_customer.table_slas_customer = $('#table_slas_customer').DataTable(slas_customer.configTableSimple(data, [
                {title: "coordinación", data: "coordinacion"},
                {title: "Mayor 5 días", data: "mayor_5_dias"},
                {title: "Menor 5 días", data: "menor_5_dias"},
                {title: "Mayor 3 días", data: "mayor_3_dias"},
                {title: "menor 3 días", data: "menor_3_dias"},
                {title: "Total Incidentes", data: "total_incidentes"},
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
                        action: slas_customer.downloadReportSlasCustomer,
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

        downloadReportSlasCustomer: function () {
            var desde = $('#fDesde').val();
            var hasta = $('#fHasta').val();
//            window.location.href = base_url + "/Reportes/excelCustomerCareSlas/" + desde + "/" + hasta;
            window.open(base_url + "Reportes/excelCustomerCareSlas/" + desde + "/" + hasta, '_blank');
        },
    }
    slas_customer.init();
});