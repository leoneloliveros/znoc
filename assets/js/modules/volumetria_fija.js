$(function(){
  volumetria_fija = {
    init: function(){
      volumetria_fija.events();
      volumetria_fija.getNemonicosFixedAccordingDate();
    },

    events: function(){
      $(`#newDate`).click(volumetria_fija.getNemonicosFixedAccordingDate);
      $(`#excelVol`).click(volumetria_fija.createExcelFixed);
    },

    getNemonicosFixedAccordingDate: function(){
      if ($("#fDesde").val() <= $("#fHasta").val()) {
        $("#newDate,#fDesde, #fHasta").attr('disabled', true);
        $("#fDesde, #fHasta").css({ 'border-color': '#cccccc', 'box-shadow': 'unset' });
        helper.showLoading();
        $("span.badge").html('<i class="fas fa-spinner fa-spin"></i>');
        $.post(base_url + "Reportes/c_getNemonicosFixedAccordingDate", {
          desde: $(`#fDesde`).val(),
          hasta: $(`#fHasta`).val(),
        },
          function (data) {
            const obj = JSON.parse(data);
            volumetria_fija.dataVoltria = {
              'fohfc': {'T1':[],'T2':[],'T3':[],'T11':[]},
              'foip': {'T1':[],'T2':[],'T3':[],'T11':[]},
              'foinf': {'T1':[],'T2':[],'T3':[],'T11':[]},
              'fotv': {'T1':[],'T2':[],'T3':[],'T11':[]},
              'pilototv': {'T1':[],'T2':[],'T3':[],'T11':[]},
              'fosmu': {'T1':[],'T2':[],'T3':[],'T11':[]},
            }

            var nel = [];
            $.each(obj, function (i, val) { 
              
              if(val.DESCRIPTION.toUpperCase().includes('FOHFC:')){
                  const horario = volumetria_fija.getSchedule(val.CREATIONDATE.substr(11,5),val.CREATEDBY);
                  val['tipoT'] = horario;
                  volumetria_fija.dataVoltria.fohfc[horario].push(val);
              }else if(val.DESCRIPTION.toUpperCase().includes('FOIP:')){
                  const horario = volumetria_fija.getSchedule(val.CREATIONDATE.substr(11,5),val.CREATEDBY);
                  val['tipoT'] = horario;
                  volumetria_fija.dataVoltria.foip[horario].push(val);
              }else if(val.DESCRIPTION.toUpperCase().includes('FOINF:')){
                  const horario = volumetria_fija.getSchedule(val.CREATIONDATE.substr(11,5),val.CREATEDBY);
                  val['tipoT'] = horario;
                  volumetria_fija.dataVoltria.foinf[horario].push(val);
              }else if(val.DESCRIPTION.toUpperCase().includes('FOTV:')){
                  const horario = volumetria_fija.getSchedule(val.CREATIONDATE.substr(11,5),val.CREATEDBY);
                  val['tipoT'] = horario;
                  volumetria_fija.dataVoltria.fotv[horario].push(val);
              }else if(val.DESCRIPTION.toUpperCase().includes('PILOTO TV:')){
                  const horario = volumetria_fija.getSchedule(val.CREATIONDATE.substr(11,5),val.CREATEDBY);
                  val['tipoT'] = horario;
                  volumetria_fija.dataVoltria.pilototv[horario].push(val);
              }else if(val.DESCRIPTION.toUpperCase().includes('FOSMU:')){
                  const horario = volumetria_fija.getSchedule(val.CREATIONDATE.substr(11,5),val.CREATEDBY);
                  val['tipoT'] = horario;
                  volumetria_fija.dataVoltria.fosmu[horario].push(val);
              }else{
                nel.push(val.DESCRIPTION);
              }
              
            });           
            
            

            $('#FOHFCBadge').text(Object.keys(volumetria_fija.dataVoltria.fohfc.T1).length+Object.keys(volumetria_fija.dataVoltria.fohfc.T2).length+Object.keys(volumetria_fija.dataVoltria.fohfc.T3).length+Object.keys(volumetria_fija.dataVoltria.fohfc.T11).length);
            $('#FOIPBadge').text(Object.keys(volumetria_fija.dataVoltria.foip.T1).length+Object.keys(volumetria_fija.dataVoltria.foip.T2).length+Object.keys(volumetria_fija.dataVoltria.foip.T3).length+Object.keys(volumetria_fija.dataVoltria.foip.T11).length);
            $('#FOINFBadge').text(Object.keys(volumetria_fija.dataVoltria.foinf.T1).length+Object.keys(volumetria_fija.dataVoltria.foinf.T2).length+Object.keys(volumetria_fija.dataVoltria.foinf.T3).length+Object.keys(volumetria_fija.dataVoltria.foinf.T11).length);
            $('#FOTVBadge').text(Object.keys(volumetria_fija.dataVoltria.fotv.T1).length+Object.keys(volumetria_fija.dataVoltria.fotv.T2).length+Object.keys(volumetria_fija.dataVoltria.fotv.T3).length+Object.keys(volumetria_fija.dataVoltria.fotv.T11).length);
            $('#PILOTOTVBadge').text(Object.keys(volumetria_fija.dataVoltria.pilototv.T1).length+Object.keys(volumetria_fija.dataVoltria.pilototv.T2).length+Object.keys(volumetria_fija.dataVoltria.pilototv.T3).length+Object.keys(volumetria_fija.dataVoltria.pilototv.T11).length);
            $('#FOSMUBadge').text(Object.keys(volumetria_fija.dataVoltria.fosmu.T1).length+Object.keys(volumetria_fija.dataVoltria.fosmu.T2).length+Object.keys(volumetria_fija.dataVoltria.fosmu.T3).length+Object.keys(volumetria_fija.dataVoltria.fosmu.T11).length);
            
            $('#T1fohfc').text(Object.keys(volumetria_fija.dataVoltria.fohfc.T1).length);
            $('#T2fohfc').text(Object.keys(volumetria_fija.dataVoltria.fohfc.T2).length);
            $('#T3fohfc').text(Object.keys(volumetria_fija.dataVoltria.fohfc.T3).length);
            $('#T11fohfc').text(Object.keys(volumetria_fija.dataVoltria.fohfc.T11).length);
            
            $('#T1foip').text(Object.keys(volumetria_fija.dataVoltria.foip.T1).length);
            $('#T2foip').text(Object.keys(volumetria_fija.dataVoltria.foip.T2).length);
            $('#T3foip').text(Object.keys(volumetria_fija.dataVoltria.foip.T3).length);
            $('#T11foip').text(Object.keys(volumetria_fija.dataVoltria.foip.T11).length);
            
            $('#T1foinf').text(Object.keys(volumetria_fija.dataVoltria.foinf.T1).length);
            $('#T2foinf').text(Object.keys(volumetria_fija.dataVoltria.foinf.T2).length);
            $('#T3foinf').text(Object.keys(volumetria_fija.dataVoltria.foinf.T3).length);
            $('#T11foinf').text(Object.keys(volumetria_fija.dataVoltria.foinf.T11).length);
            
            $('#T1fotv').text(Object.keys(volumetria_fija.dataVoltria.fotv.T1).length);
            $('#T2fotv').text(Object.keys(volumetria_fija.dataVoltria.fotv.T2).length);
            $('#T3fotv').text(Object.keys(volumetria_fija.dataVoltria.fotv.T3).length);
            $('#T11fotv').text(Object.keys(volumetria_fija.dataVoltria.fotv.T11).length);
            
            $('#T1pilototv').text(Object.keys(volumetria_fija.dataVoltria.pilototv.T1).length);
            $('#T2pilototv').text(Object.keys(volumetria_fija.dataVoltria.pilototv.T2).length);
            $('#T3pilototv').text(Object.keys(volumetria_fija.dataVoltria.pilototv.T3).length);
            $('#T11pilototv').text(Object.keys(volumetria_fija.dataVoltria.pilototv.T11).length);
            
            $('#T1fosmu').text(Object.keys(volumetria_fija.dataVoltria.fosmu.T1).length);
            $('#T2fosmu').text(Object.keys(volumetria_fija.dataVoltria.fosmu.T2).length);
            $('#T3fosmu').text(Object.keys(volumetria_fija.dataVoltria.fosmu.T3).length);
            $('#T11fosmu').text(Object.keys(volumetria_fija.dataVoltria.fosmu.T11).length);
            
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

    
    createExcelFixed: function(){
      
      // window.open(base_url + "Reportes/excelVolumetrias");
      $.post(base_url + "Reportes/enviarDatosExcelVolumetriasFija", {
        data: JSON.stringify(volumetria_fija.dataVoltria),
      },
      ).done(function(){
        window.open(base_url + "Reportes/excelVolumetriasFija");
      });
      
    },
  }
  volumetria_fija.init();
});