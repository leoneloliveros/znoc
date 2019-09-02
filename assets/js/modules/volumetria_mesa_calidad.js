$(function () {
    mesa_calidad = {
        init: function () {
            mesa_calidad.events();
            mesa_calidad.getNemonicosFixedAccordingDate();
        },

        events: function () {
            $(`#newDate`).click(mesa_calidad.getNemonicosFixedAccordingDate);
            $(`#excelVol`).click(mesa_calidad.createExcelFixed);
        },

        getNemonicosFixedAccordingDate: function () {
            if ($("#fDesde").val() <= $("#fHasta").val()) {
                $("#newDate,#fDesde, #fHasta").attr('disabled', true);
                $("#fDesde, #fHasta").css({'border-color': '#cccccc', 'box-shadow': 'unset'});
                helper.showLoading();
                $("span.badge").html('<i class="fas fa-spinner fa-spin"></i>');
                $.post(base_url + "Reportes/c_getNemonicosQualityTabledAccordingDate", {
                    desde: $(`#fDesde`).val(),
                    hasta: $(`#fHasta`).val(),
                },
                        function (data) {
                            const obj = JSON.parse(data);
//                            console.log(obj);
                            $.each(obj, function (i, val) {
                                $('#' + val.nemonicos + '_id').html(val.total_incidentes);
                            });
                            $("#fDesde, #fHasta,#newDate").attr('disabled', false);
                            helper.hideLoading();
                        },
                        );
            } else {
                helper.miniAlertN('Error, La <u>Fecha Inicio</u> debe ser menor o igual a la <u>Fecha Fin</u>', 'error', '2500');
                $("#fDesde, #fHasta").css({
                    'border-color': '#d01818',
                    'box-shadow': '0 0 0 3px #ff000066'
                });
            }
        },

        createExcelFixed: function () {
            // window.open(base_url + "Reportes/excelVolumetrias");
            var desde = $(`#fDesde`).val();
            var hasta = $(`#fHasta`).val();
            window.open(base_url + "Reportes/excelVolumetriasMesaCalidad/" + desde + "/" + hasta);

        },
    }
    mesa_calidad.init();
});