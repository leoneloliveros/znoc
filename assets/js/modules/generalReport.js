$(function () {
    generalReport = {
        init: function () {
            generalReport.events();
            generalReport.getReportsDB();
        },

        events: function () {
            $(`#reportButton`).click(generalReport.getReportAccordingOption);
            $(`#reportButton2`).click(generalReport.getReportAccordingOption2);
            $(`#excelVol`).click(generalReport.createExcel);
        },

        getReportAccordingOption: function () {
            $("#newDate,#fDesde, #fHasta, #selection").attr('disabled', true);
            $("#fDesde, #fHasta").css({'border-color': '#cccccc', 'box-shadow': 'unset'});
            helper.showLoading();
            switch ($("#selection").val()) {
                case '0':
                    $.post(base_url + "GeneralReports/c_getControlTicket", {
                        desde: $(`#fDesde`).val(),
                        hasta: $(`#fHasta`).val(),
                    }).done(function () {
                        $("#newDate,#fDesde, #fHasta, #selection").attr('disabled', false);
                        helper.hideLoading();
                        window.open(base_url + "GeneralReports/excelControlTicket");
                    });


                    break;
                case '1':
                    // code block
                    break;
                case '2':
                    $.post(base_url + "GeneralReports/c_getDataFromIncidentesFija", {
                        desde: $(`#fDesde`).val(),
                        hasta: $(`#fHasta`).val(),
                    }).done(function () {
                        $("#newDate,#fDesde, #fHasta, #selection").attr('disabled', false);
                        helper.hideLoading();
                        window.open(base_url + "GeneralReports/excelIncidentesFija");
                    });
                    break;
                case '3':
                    $.post(base_url + "GeneralReports/c_getDataFromTiemposNOCEste", {
                        desde: $(`#fDesde`).val(),
                        hasta: $(`#fHasta`).val(),
                    }).done(function () {
                        $("#newDate,#fDesde, #fHasta, #selection").attr('disabled', false);
                        helper.hideLoading();
                        window.open(base_url + "GeneralReports/excelTiemposNOCEste");
                    });
                    break;
                case '4':
                    $.post(base_url + "GeneralReports/c_getDataFromTiempoFija", {
                        desde: $(`#fDesde`).val(),
                        hasta: $(`#fHasta`).val(),
                    }).done(function () {
                        $("#newDate,#fDesde, #fHasta, #selection").attr('disabled', false);
                        helper.hideLoading();
                        window.open(base_url + "GeneralReports/excelTiempoFija");
                    });
                    break;
                case '5':
                    $.post(base_url + "GeneralReports/c_getDataFromWorkInfo", {
                        desde: $(`#fDesde`).val(),
                        hasta: $(`#fHasta`).val(),
                    }).done(function () {
                        $("#newDate,#fDesde, #fHasta, #selection").attr('disabled', false);
                        helper.hideLoading();
                        window.open(base_url + "GeneralReports/excelWorkInfoMesaCalidad");
                    });
                    break;
                case '6':
                    $.post(base_url + "GeneralReports/c_getDataFromAlarmasAutomatismo", {
                        desde: $(`#fDesde`).val(),
                        hasta: $(`#fHasta`).val(),
                    }).done(function () {
                        $("#newDate,#fDesde, #fHasta, #selection").attr('disabled', false);
                        helper.hideLoading();
                        window.open(base_url + "GeneralReports/excelAlarmasAutomatismo");
                    });
                    break;
                case '7':
                    $.post(base_url + "GeneralReports/c_getDataFromTareasFOPerformance", {
                        desde: $(`#fDesde`).val(),
                        hasta: $(`#fHasta`).val(),
                    }).done(function () {
                        $("#newDate,#fDesde, #fHasta, #selection").attr('disabled', false);
                        helper.hideLoading();
                        window.open(base_url + "GeneralReports/excelTareasFOPerformance");
                    });
                    break;
                case '8':
                    $.post(base_url + "GeneralReports/c_getTiempoAtencion", {
                        desde: $(`#fDesde`).val(),
                        hasta: $(`#fHasta`).val(),
                    }).done(function () {
                        $("#newDate,#fDesde, #fHasta, #selection").attr('disabled', false);
                        helper.hideLoading();
                        window.open(base_url + "GeneralReports/excelTiempoAtencion");
                    });
                    break;
                case '9':
                    $.post(base_url + "GeneralReports/c_getGestionPerformance", {
                        desde: $(`#fDesde`).val(),
                        hasta: $(`#fHasta`).val(),
                    }).done(function () {
                        $("#newDate,#fDesde, #fHasta, #selection").attr('disabled', false);
                        helper.hideLoading();
                        window.open(base_url + "GeneralReports/excelGestionPerformance");
                    });
            break;
            case '10':
              $.post(base_url + "GeneralReports/c_getCambiosVentanasMantenimiento", {
                  desde: $(`#fDesde`).val(),
                  hasta: $(`#fHasta`).val(),
                }).done(function(){
                  $("#newDate,#fDesde, #fHasta, #selection").attr('disabled', false);
                  $('#loader').hide();
                  $('.spinner-loader').hide();
                  window.open(base_url + "GeneralReports/excelCambiosVentanasMantenimiento");
              });
            break;
            case '11':
              $.post(base_url + "GeneralReports/c_getIncidentesCerrados", {
                  desde: $(`#fDesde`).val(),
                  hasta: $(`#fHasta`).val(),
                }).done(function(){
                  $("#newDate,#fDesde, #fHasta, #selection").attr('disabled', false);
                  $('#loader').hide();
                  $('.spinner-loader').hide();
                  window.open(base_url + "GeneralReports/excelIncidentesCerrados");
              });
            break;
            default:
              // code block
          }
      },
  
      
      getSchedule: function(hora,creador){
      },
  
      
      createExcel: function(){
        
        // window.open(base_url + "Reportes/excelgeneralReports");
        $.post(base_url + "Reportes/enviarDatosExcel", {
          data: JSON.stringify(generalReport.dataVoltria),
        },
    ).done(function () {
window.open(base_url + "Reportes/excelgeneralReports");
});

},

getReportAccordingOption2: function () {
var fDesde = helper.encode($(`#fDesde`).val());
var fHasta = helper.encode($(`#fHasta`).val());
var selection = helper.encode($(`#selection`).val());
window.open(base_url + "GeneralReports/excelReportSelect/" + fDesde + "/" + fHasta + "/" + "/" + selection);

},

getReportsDB: function () {
helper.showLoading();
$.post(base_url + "GeneralReports/c_getReportsDB", {
// parametros
},
    function (data) {
        const obj = JSON.parse(data);
//                        console.log(obj);
        $.each(obj, function (i, val) {
            $('#selection').append('<option value="' + val.id_reportes + '">' + val.nombre_reporte + '</option>');
        });

    }
);
helper.hideLoading();
    }
}
generalReport.init();
    
})

