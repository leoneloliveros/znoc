$(function () {
    bitacorasCciHfc = {
        init: function () {
            bitacorasCciHfc.events();
            $(`#fechaInicio, #fechaFin`).mask('00/00/0000', {placeholder: "--/--/--"});
        },

        events: function () {
            $('#buscar').click(bitacorasCciHfc.exportarBitacora);
            $('#toggleDate').click(() => {
                if ($('#toggleDate').prop('checked')) {
                    // alert('Seleccionado');
                    $(`#fechaInicio, #fechaFin`).attr('disabled', false);
                } else {
                    $(`#fechaInicio, #fechaFin`).attr('disabled', true);
                }
                document.getElementById('forExport').reset();
            });
        },
        
        exportarBitacora: function () {
            if ($('#areaExport').val() == "") {
                helper.miniAlert('Seleccione una opcion a Expotar.');
                return false;
            } else {
                if ($('#toggleDate').prop('checked') && $(`#fechaInicio, #fechaFin`).val() == "") {
                    helper.miniAlert('Seleccione un rango de fechas o desactive el filtro.');
                    return false;
                }
            }
        },
    }
    bitacorasCciHfc.init();
});
