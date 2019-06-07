$(function(){
  volumetria = {
    init: function(){
      volumetria.events();
      volumetria.getNemonicosAccordingDate();
    },

    events: function(){
      $(`#newDate`).click(volumetria.getNemonicosAccordingDate);
      $(`#excelVol`).click(volumetria.createExcel);
    },

    getNemonicosAccordingDate: function(){
      if ($("#fDesde").val() <= $("#fHasta").val()) {
        $("#newDate,#fDesde, #fHasta").attr('disabled', true);
        $("#fDesde, #fHasta").css({ 'border-color': '#cccccc', 'box-shadow': 'unset' });
        helper.showLoading();
        $("span.badge").html('<i class="fas fa-spinner fa-spin"></i>');
        $.post(base_url + "Reportes/c_getNemonicosAccordingDate", {
          desde: $(`#fDesde`).val(),
          hasta: $(`#fHasta`).val(),
        },
          function (data) {
            const obj = JSON.parse(data);
            volumetria.dataVoltria = {
              'faoc': {'T1':[],'T2':[],'T3':[],'T11':[]},
              'faob': {'T1':[],'T2':[],'T3':[],'T11':[]},
              'fapp': {'T1':[],'T2':[],'T3':[],'T11':[]},
              'fee': {'T1':[],'T2':[],'T3':[],'T11':[]},
              'fi': {'T1':[],'T2':[],'T3':[],'T11':[]},
              'foip': {'T1':[],'T2':[],'T3':[],'T11':[]},
            }

            var nel = [];
            $.each(obj, function (i, val) { 
              
              if(val.DESCRIPTION.toUpperCase().includes('FAOC:')){
                  const horario = volumetria.getSchedule(val.CREATIONDATE.substr(11,5),val.CREATEDBY);
                  val['tipoT'] = horario;
                  volumetria.dataVoltria.faoc[horario].push(val);
              }else if(val.DESCRIPTION.toUpperCase().includes('FAOB:')){
                  const horario = volumetria.getSchedule(val.CREATIONDATE.substr(11,5),val.CREATEDBY);
                  val['tipoT'] = horario;
                  volumetria.dataVoltria.faob[horario].push(val);
              }else if(val.DESCRIPTION.toUpperCase().includes('FAPP:')){
                  const horario = volumetria.getSchedule(val.CREATIONDATE.substr(11,5),val.CREATEDBY);
                  val['tipoT'] = horario;
                  volumetria.dataVoltria.fapp[horario].push(val);
              }else if(val.DESCRIPTION.toUpperCase().includes('FOIP:')){
                  const horario = volumetria.getSchedule(val.CREATIONDATE.substr(11,5),val.CREATEDBY);
                  val['tipoT'] = horario;
                  volumetria.dataVoltria.foip[horario].push(val);
              }else if(val.DESCRIPTION.toUpperCase().includes('FEE:')){
                  const horario = volumetria.getSchedule(val.CREATIONDATE.substr(11,5),val.CREATEDBY);
                  val['tipoT'] = horario;
                  volumetria.dataVoltria.fee[horario].push(val);
              }else if(val.DESCRIPTION.toUpperCase().includes('FI:')){
                  const horario = volumetria.getSchedule(val.CREATIONDATE.substr(11,5),val.CREATEDBY);
                  val['tipoT'] = horario;
                  volumetria.dataVoltria.fi[horario].push(val);
              }else{
                nel.push(val.DESCRIPTION);
              }
              
            });           
            
            

            $('#FAOCBadge').text(Object.keys(volumetria.dataVoltria.faoc.T1).length+Object.keys(volumetria.dataVoltria.faoc.T2).length+Object.keys(volumetria.dataVoltria.faoc.T3).length+Object.keys(volumetria.dataVoltria.faoc.T11).length);
            $('#FAOBBadge').text(Object.keys(volumetria.dataVoltria.faob.T1).length+Object.keys(volumetria.dataVoltria.faob.T2).length+Object.keys(volumetria.dataVoltria.faob.T3).length+Object.keys(volumetria.dataVoltria.faob.T11).length);
            $('#FAPPBadge').text(Object.keys(volumetria.dataVoltria.fapp.T1).length+Object.keys(volumetria.dataVoltria.fapp.T2).length+Object.keys(volumetria.dataVoltria.fapp.T3).length+Object.keys(volumetria.dataVoltria.fapp.T11).length);
            $('#FEEBadge').text(Object.keys(volumetria.dataVoltria.fee.T1).length+Object.keys(volumetria.dataVoltria.fee.T2).length+Object.keys(volumetria.dataVoltria.fee.T3).length+Object.keys(volumetria.dataVoltria.fee.T11).length);
            $('#FIBadge').text(Object.keys(volumetria.dataVoltria.fi.T1).length+Object.keys(volumetria.dataVoltria.fi.T2).length+Object.keys(volumetria.dataVoltria.fi.T3).length+Object.keys(volumetria.dataVoltria.fi.T11).length);
            $('#FOIPBadge').text(Object.keys(volumetria.dataVoltria.foip.T1).length+Object.keys(volumetria.dataVoltria.foip.T2).length+Object.keys(volumetria.dataVoltria.foip.T3).length+Object.keys(volumetria.dataVoltria.foip.T11).length);
            
            $('#T1faoc').text(Object.keys(volumetria.dataVoltria.faoc.T1).length);
            $('#T2faoc').text(Object.keys(volumetria.dataVoltria.faoc.T2).length);
            $('#T3faoc').text(Object.keys(volumetria.dataVoltria.faoc.T3).length);
            $('#T11faoc').text(Object.keys(volumetria.dataVoltria.faoc.T11).length);
            $('#T1faob').text(Object.keys(volumetria.dataVoltria.faob.T1).length);
            $('#T2faob').text(Object.keys(volumetria.dataVoltria.faob.T2).length);
            $('#T3faob').text(Object.keys(volumetria.dataVoltria.faob.T3).length);
            $('#T11faob').text(Object.keys(volumetria.dataVoltria.faob.T11).length);
            $('#T1fapp').text(Object.keys(volumetria.dataVoltria.fapp.T1).length);
            $('#T2fapp').text(Object.keys(volumetria.dataVoltria.fapp.T2).length);
            $('#T3fapp').text(Object.keys(volumetria.dataVoltria.fapp.T3).length);
            $('#T11fapp').text(Object.keys(volumetria.dataVoltria.fapp.T11).length);
            $('#T1fee').text(Object.keys(volumetria.dataVoltria.fee.T1).length);
            $('#T2fee').text(Object.keys(volumetria.dataVoltria.fee.T2).length);
            $('#T3fee').text(Object.keys(volumetria.dataVoltria.fee.T3).length);
            $('#T11fee').text(Object.keys(volumetria.dataVoltria.fee.T11).length);
            $('#T1fi').text(Object.keys(volumetria.dataVoltria.fi.T1).length);
            $('#T2fi').text(Object.keys(volumetria.dataVoltria.fi.T2).length);
            $('#T3fi').text(Object.keys(volumetria.dataVoltria.fi.T3).length);
            $('#T11fi').text(Object.keys(volumetria.dataVoltria.fi.T11).length);
            $('#T1foip').text(Object.keys(volumetria.dataVoltria.foip.T1).length);
            $('#T2foip').text(Object.keys(volumetria.dataVoltria.foip.T2).length);
            $('#T3foip').text(Object.keys(volumetria.dataVoltria.foip.T3).length);
            $('#T11foip').text(Object.keys(volumetria.dataVoltria.foip.T11).length);
            
            $(`#totalNemonicos`).text(Object.keys(obj).length);
            
            $("#fDesde, #fHasta,#newDate").attr('disabled', false);
            helper.hideLoading();
          },
        );
      }else {
        helper.miniAlertN('Error, La fecha <u>DESDE</u> debe ser menor o igual a la fecha <u>HASTA</u>', 'error', '2500');
        $("#fDesde, #fHasta").css({
            'border-color': '#d01818',
            'box-shadow': '0 0 0 3px #ff000066'
        });
      }
    },

    
    getSchedule: function(hora,creador){
      if (creador.toUpperCase() == 'ECM0139H') {
        return 'T11';
      }else{
        if (hora >= '06:01' && hora <= '14:00') {
          return 'T1';
        }else if(hora >= '14:01' && hora <= '22:00'){
          return 'T2';
        }else{
          return 'T3';
        }
      }
    },

    
    createExcel: function(){
      
      // window.open(base_url + "Reportes/excelVolumetrias");
      $.post(base_url + "Reportes/enviarDatosExcel", {
        data: JSON.stringify(volumetria.dataVoltria),
      },
      ).done(function(){
        window.open(base_url + "Reportes/excelVolumetrias");
      });
      
    },
  }
  volumetria.init();
});