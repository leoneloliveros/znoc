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
        $.post(base_url + "Reportes/c_getNemonicosAccordingDate", {
          desde: $(`#fDesde`).val(),
          hasta: $(`#fHasta`).val(),
        },
          function (data) {
            const obj = JSON.parse(data);
            volumetria.dataVoltria = {
              'faoc': [{'T1':0,'T2':0,'T3':0,'T11':0},[]],
              'faob': [{'T1':0,'T2':0,'T3':0,'T11':0},[]],
              'fapp': [{'T1':0,'T2':0,'T3':0,'T11':0},[]],
              'fee': [{'T1':0,'T2':0,'T3':0,'T11':0},[]],
              'fi': [{'T1':0,'T2':0,'T3':0,'T11':0},[]],
              'foip': [{'T1':0,'T2':0,'T3':0,'T11':0},[]],
            }
            // volumetria.faoc[0]= 0, volumetria.faob[0]=0, volumetria.fapp[0]=0, volumetria.fee[0]=0, volumetria.fi[0]=0, volumetria.foip[0]=0;
            // volumetria.faoc[1]={'T1':[],'T2':[],'T3':[],'T11':[]};
            // volumetria.faob[1]={'T1':[],'T2':[],'T3':[],'T11':[]};
            // volumetria.fapp[1]={'T1':[],'T2':[],'T3':[],'T11':[]};
            // volumetria.fee[1]={'T1':[],'T2':[],'T3':[],'T11':[]};
            // volumetria.fi[1]={'T1':[],'T2':[],'T3':[],'T11':[]};
            // volumetria.foip[1]={'T1':[],'T2':[],'T3':[],'T11':[]};

            var nel = [];
            $.each(obj, function (i, val) { 
              
              if(val.DESCRIPTION.toUpperCase().includes('FAOC:')){
                  const horario = volumetria.getSchedule(val.CREATIONDATE.substr(11,5),val.CREATEDBY);
                  // volumetria.faoc[1][horario].push(val.CREATIONDATE.substr(11,5));
                  volumetria.dataVoltria.faoc[0][horario] += 1;
                  volumetria.dataVoltria.faoc[1].push(val);
              }else if(val.DESCRIPTION.toUpperCase().includes('FAOB:')){
                  const horario = volumetria.getSchedule(val.CREATIONDATE.substr(11,5),val.CREATEDBY);
                  // volumetria.faob[1][horario].push(val.CREATIONDATE.substr(11,5));
                  volumetria.dataVoltria.faob[0][horario] += 1;
                  volumetria.dataVoltria.faob[1].push(val);
              }else if(val.DESCRIPTION.toUpperCase().includes('FAPP:')){
                  const horario = volumetria.getSchedule(val.CREATIONDATE.substr(11,5),val.CREATEDBY);
                  // volumetria.fapp[1][horario].push(val.CREATIONDATE.substr(11,5));
                  volumetria.dataVoltria.fapp[0][horario] += 1;
                  volumetria.dataVoltria.fapp[1].push(val);
              }else if(val.DESCRIPTION.toUpperCase().includes('FOIP:')){
                  const horario = volumetria.getSchedule(val.CREATIONDATE.substr(11,5),val.CREATEDBY);
                  // volumetria.foip[1][horario].push(val.CREATIONDATE.substr(11,5));
                  volumetria.dataVoltria.foip[0][horario] += 1;
                  volumetria.dataVoltria.foip[1].push(val);
              }else if(val.DESCRIPTION.toUpperCase().includes('FEE:')){
                  const horario = volumetria.getSchedule(val.CREATIONDATE.substr(11,5),val.CREATEDBY);
                  // volumetria.fee[1][horario].push(val.CREATIONDATE.substr(11,5));
                  volumetria.dataVoltria.fee[0][horario] += 1;
                  volumetria.dataVoltria.fee[1].push(val);
              }else if(val.DESCRIPTION.toUpperCase().includes('FI:')){
                  const horario = volumetria.getSchedule(val.CREATIONDATE.substr(11,5),val.CREATEDBY);
                  // volumetria.fi[1][horario].push(val.CREATIONDATE.substr(11,5));
                  volumetria.dataVoltria.fi[0][horario] += 1;
                  volumetria.dataVoltria.fi[1].push(val);
              }else{
                nel.push(val.DESCRIPTION);
              }
              
            });           

            $('#FAOCBadge').text(volumetria.dataVoltria.faoc[1].length);
            $('#FAOBBadge').text(volumetria.dataVoltria.faob[1].length);
            $('#FAPPBadge').text(volumetria.dataVoltria.fapp[1].length);
            $('#FEEBadge').text(volumetria.dataVoltria.fee[1].length);
            $('#FIBadge').text(volumetria.dataVoltria.fi[1].length);
            $('#FOIPBadge').text(volumetria.dataVoltria.foip[1].length);

            $('#T1faoc').text(volumetria.dataVoltria.faoc[0].T1);
            $('#T2faoc').text(volumetria.dataVoltria.faoc[0].T2);
            $('#T3faoc').text(volumetria.dataVoltria.faoc[0].T3);
            $('#T11faoc').text(volumetria.dataVoltria.faoc[0].T11);
            $('#T1faob').text(volumetria.dataVoltria.faob[0].T1);
            $('#T2faob').text(volumetria.dataVoltria.faob[0].T2);
            $('#T3faob').text(volumetria.dataVoltria.faob[0].T3);
            $('#T11faob').text(volumetria.dataVoltria.faob[0].T11);
            $('#T1fapp').text(volumetria.dataVoltria.fapp[0].T1);
            $('#T2fapp').text(volumetria.dataVoltria.fapp[0].T2);
            $('#T3fapp').text(volumetria.dataVoltria.fapp[0].T3);
            $('#T11fapp').text(volumetria.dataVoltria.fapp[0].T11);
            $('#T1fee').text(volumetria.dataVoltria.fee[0].T1);
            $('#T2fee').text(volumetria.dataVoltria.fee[0].T2);
            $('#T3fee').text(volumetria.dataVoltria.fee[0].T3);
            $('#T11fee').text(volumetria.dataVoltria.fee[0].T11);
            $('#T1fi').text(volumetria.dataVoltria.fi[0].T1);
            $('#T2fi').text(volumetria.dataVoltria.fi[0].T2);
            $('#T3fi').text(volumetria.dataVoltria.fi[0].T3);
            $('#T11fi').text(volumetria.dataVoltria.fi[0].T11);
            $('#T1foip').text(volumetria.dataVoltria.foip[0].T1);
            $('#T2foip').text(volumetria.dataVoltria.foip[0].T2);
            $('#T3foip').text(volumetria.dataVoltria.foip[0].T3);
            $('#T11foip').text(volumetria.dataVoltria.foip[0].T11);
            
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
      console.log(volumetria.dataVoltria);
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