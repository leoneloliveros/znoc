$(function(){
    generalReport = {
      init: function(){
        generalReport.events();
      },
  
      events: function(){
        $(`#reportButton`).click(generalReport.getReportAccordingOption);
        $(`#excelVol`).click(generalReport.createExcel);
      },
  
      getReportAccordingOption: function(){
        $("#newDate,#fDesde, #fHasta, #selection").attr('disabled', true);
        $("#fDesde, #fHasta").css({ 'border-color': '#cccccc', 'box-shadow': 'unset' });
        helper.showLoading();
        switch($("#selection").val()) {
            case '0':
                $.post(base_url + "GeneralReports/c_getDataFromMaximoWorkInfo", {
                    desde: $(`#fDesde`).val(),
                    hasta: $(`#fHasta`).val(),
                  }).done(function(){
                    $("#newDate,#fDesde, #fHasta, #selection").attr('disabled', false);
                    helper.hideLoading();
                    window.open(base_url + "GeneralReports/excelWorkInfo");
                });
                    
                      
              break;
            case '1':
              // code block
              break;
            case '2':
                    $.post(base_url + "GeneralReports/c_getDataFromTiemposNOCEste", {
                        desde: $(`#fDesde`).val(),
                        hasta: $(`#fHasta`).val(),
                      }).done(function(){
                        $("#newDate,#fDesde, #fHasta, #selection").attr('disabled', false);
                        helper.hideLoading();
                        window.open(base_url + "GeneralReports/excelTiemposNOCEste");
                    });
            break;
            case '3':
                    $.post(base_url + "GeneralReports/c_getDataFromTiemposNOCEste", {
                        desde: $(`#fDesde`).val(),
                        hasta: $(`#fHasta`).val(),
                      }).done(function(){
                        $("#newDate,#fDesde, #fHasta, #selection").attr('disabled', false);
                        helper.hideLoading();
                        window.open(base_url + "GeneralReports/excelTiemposNOCEste");
                    });
            break;
            case '4':
                    $.post(base_url + "GeneralReports/c_getDataFromTiempoFija", {
                        desde: $(`#fDesde`).val(),
                        hasta: $(`#fHasta`).val(),
                      }).done(function(){
                        $("#newDate,#fDesde, #fHasta, #selection").attr('disabled', false);
                        helper.hideLoading();
                        window.open(base_url + "GeneralReports/excelTiempoFija");
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
        ).done(function(){
          window.open(base_url + "Reportes/excelgeneralReports");
        });
        
      },
    }
    generalReport.init();
  });