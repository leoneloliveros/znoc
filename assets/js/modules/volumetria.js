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
            
            volumetria.faoc = [0,{'T1':0,'T2':0,'T3':0,'T11':0}];
            volumetria.faob = [0,{'T1':0,'T2':0,'T3':0,'T11':0}];
            volumetria.fapp = [0,{'T1':0,'T2':0,'T3':0,'T11':0}];
            volumetria.fee = [0,{'T1':0,'T2':0,'T3':0,'T11':0}];
            volumetria.fi = [0,{'T1':0,'T2':0,'T3':0,'T11':0}];
            volumetria.foip = [0,{'T1':0,'T2':0,'T3':0,'T11':0}];
            // volumetria.faoc[0]= 0, volumetria.faob[0]=0, volumetria.fapp[0]=0, volumetria.fee[0]=0, volumetria.fi[0]=0, volumetria.foip[0]=0;
            // volumetria.faoc[1]={'T1':[],'T2':[],'T3':[],'T11':[]};
            // volumetria.faob[1]={'T1':[],'T2':[],'T3':[],'T11':[]};
            // volumetria.fapp[1]={'T1':[],'T2':[],'T3':[],'T11':[]};
            // volumetria.fee[1]={'T1':[],'T2':[],'T3':[],'T11':[]};
            // volumetria.fi[1]={'T1':[],'T2':[],'T3':[],'T11':[]};
            // volumetria.foip[1]={'T1':[],'T2':[],'T3':[],'T11':[]};

            var nel = [];
            $.each(obj, function (i, val) { 
              
              if(val.DESCRIPTION.toUpperCase().includes('volumetria.FAOC:')){
                  volumetria.faoc[0] +=1 ;
                  const horario = volumetria.getSchedule(val.CREATIONDATE.substr(11,5),val.CREATEDBY);
                  // volumetria.faoc[1][horario].push(val.CREATIONDATE.substr(11,5));
                  volumetria.faoc[1][horario] += 1;
              }else if(val.DESCRIPTION.toUpperCase().includes('volumetria.FAOB:')){
                  volumetria.faob[0] +=1 ;
                  const horario = volumetria.getSchedule(val.CREATIONDATE.substr(11,5),val.CREATEDBY);
                  // volumetria.faob[1][horario].push(val.CREATIONDATE.substr(11,5));
                  volumetria.faob[1][horario] += 1;
              }else if(val.DESCRIPTION.toUpperCase().includes('volumetria.FAPP:')){
                  volumetria.fapp[0] +=1 ;
                  const horario = volumetria.getSchedule(val.CREATIONDATE.substr(11,5),val.CREATEDBY);
                  // volumetria.fapp[1][horario].push(val.CREATIONDATE.substr(11,5));
                  volumetria.fapp[1][horario] += 1;
              }else if(val.DESCRIPTION.toUpperCase().includes('volumetria.FOIP:')){
                  volumetria.foip[0] +=1 ;
                  const horario = volumetria.getSchedule(val.CREATIONDATE.substr(11,5),val.CREATEDBY);
                  // volumetria.foip[1][horario].push(val.CREATIONDATE.substr(11,5));
                  volumetria.foip[1][horario] += 1;
              }else if(val.DESCRIPTION.toUpperCase().includes('volumetria.FEE:')){
                  volumetria.fee[0] += 1;
                  const horario = volumetria.getSchedule(val.CREATIONDATE.substr(11,5),val.CREATEDBY);
                  // volumetria.fee[1][horario].push(val.CREATIONDATE.substr(11,5));
                  volumetria.fee[1][horario] += 1;
              }else if(val.DESCRIPTION.toUpperCase().includes('volumetria.FI:')){
                  volumetria.fi[0] += 1;
                  const horario = volumetria.getSchedule(val.CREATIONDATE.substr(11,5),val.CREATEDBY);
                  // volumetria.fi[1][horario].push(val.CREATIONDATE.substr(11,5));
                  volumetria.fi[1][horario] += 1;
              }else{
                nel.push(val.DESCRIPTION);
              }
              
            });

            $('#FAOCBadge').text(volumetria.faoc[0]);
            $('#FAOBBadge').text(volumetria.faob[0]);
            $('#FAPPBadge').text(volumetria.fapp[0]);
            $('#FEEBadge').text(volumetria.fee[0]);
            $('#FIBadge').text(volumetria.fi[0]);
            $('#FOIPBadge').text(volumetria.foip[0]);

            $('#T1faoc').text(volumetria.faoc[1].T1);
            $('#T2faoc').text(volumetria.faoc[1].T2);
            $('#T3faoc').text(volumetria.faoc[1].T3);
            $('#T11faoc').text(volumetria.faoc[1].T11);
            $('#T1faob').text(volumetria.faob[1].T1);
            $('#T2faob').text(volumetria.faob[1].T2);
            $('#T3faob').text(volumetria.faob[1].T3);
            $('#T11faob').text(volumetria.faob[1].T11);
            $('#T1fapp').text(volumetria.fapp[1].T1);
            $('#T2fapp').text(volumetria.fapp[1].T2);
            $('#T3fapp').text(volumetria.fapp[1].T3);
            $('#T11fapp').text(volumetria.fapp[1].T11);
            $('#T1fee').text(volumetria.fee[1].T1);
            $('#T2fee').text(volumetria.fee[1].T2);
            $('#T3fee').text(volumetria.fee[1].T3);
            $('#T11fee').text(volumetria.fee[1].T11);
            $('#T1fi').text(volumetria.fi[1].T1);
            $('#T2fi').text(volumetria.fi[1].T2);
            $('#T3fi').text(volumetria.fi[1].T3);
            $('#T11fi').text(volumetria.fi[1].T11);
            $('#v1foip').text(volumetria.foip[1].T1);
            $('#v2foip').text(volumetria.foip[1].T2);
            $('#v3foip').text(volumetria.foip[1].T3);
            $('#v11foip').text(volumetria.foip[1].T11);
            
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
      if (creador.toUpperCase() == 'ECM0139D') {
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
      alert("a")
    },
  }
  volumetria.init();
});