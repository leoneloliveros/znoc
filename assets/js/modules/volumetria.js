$(function(){
  volumetria = {
    init: function(){
      volumetria.events();
      volumetria.getNemonicosAccordingDate();
    },

    events: function(){
      $(`#newDate`).click(volumetria.getNemonicosAccordingDate);
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
            
            var faoc = [0,{'T1':0,'T2':0,'T3':0,'T11':0}];
            var faob = [0,{'T1':0,'T2':0,'T3':0,'T11':0}];
            var fapp = [0,{'T1':0,'T2':0,'T3':0,'T11':0}];
            var fee = [0,{'T1':0,'T2':0,'T3':0,'T11':0}];
            var fi = [0,{'T1':0,'T2':0,'T3':0,'T11':0}];
            var foip = [0,{'T1':0,'T2':0,'T3':0,'T11':0}];
            // faoc[0]= 0, faob[0]=0, fapp[0]=0, fee[0]=0, fi[0]=0, foip[0]=0;
            // faoc[1]={'T1':[],'T2':[],'T3':[],'T11':[]};
            // faob[1]={'T1':[],'T2':[],'T3':[],'T11':[]};
            // fapp[1]={'T1':[],'T2':[],'T3':[],'T11':[]};
            // fee[1]={'T1':[],'T2':[],'T3':[],'T11':[]};
            // fi[1]={'T1':[],'T2':[],'T3':[],'T11':[]};
            // foip[1]={'T1':[],'T2':[],'T3':[],'T11':[]};

            var nel = [];
            $.each(obj, function (i, val) { 
              
              if(val.DESCRIPTION.toUpperCase().includes('FAOC:')){
                  faoc[0] +=1 ;
                  const horario = volumetria.getSchedule(val.CREATIONDATE.substr(11,5),val.CREATEDBY);
                  // faoc[1][horario].push(val.CREATIONDATE.substr(11,5));
                  faoc[1][horario] += 1;
              }else if(val.DESCRIPTION.toUpperCase().includes('FAOB:')){
                  faob[0] +=1 ;
                  const horario = volumetria.getSchedule(val.CREATIONDATE.substr(11,5),val.CREATEDBY);
                  // faob[1][horario].push(val.CREATIONDATE.substr(11,5));
                  faob[1][horario] += 1;
              }else if(val.DESCRIPTION.toUpperCase().includes('FAPP:')){
                  fapp[0] +=1 ;
                  const horario = volumetria.getSchedule(val.CREATIONDATE.substr(11,5),val.CREATEDBY);
                  // fapp[1][horario].push(val.CREATIONDATE.substr(11,5));
                  fapp[1][horario] += 1;
              }else if(val.DESCRIPTION.toUpperCase().includes('FOIP:')){
                  foip[0] +=1 ;
                  const horario = volumetria.getSchedule(val.CREATIONDATE.substr(11,5),val.CREATEDBY);
                  // foip[1][horario].push(val.CREATIONDATE.substr(11,5));
                  foip[1][horario] += 1;
              }else if(val.DESCRIPTION.toUpperCase().includes('FEE:')){
                  fee[0] += 1;
                  const horario = volumetria.getSchedule(val.CREATIONDATE.substr(11,5),val.CREATEDBY);
                  // fee[1][horario].push(val.CREATIONDATE.substr(11,5));
                  fee[1][horario] += 1;
              }else if(val.DESCRIPTION.toUpperCase().includes('FI:')){
                  fi[0] += 1;
                  const horario = volumetria.getSchedule(val.CREATIONDATE.substr(11,5),val.CREATEDBY);
                  // fi[1][horario].push(val.CREATIONDATE.substr(11,5));
                  fi[1][horario] += 1;
              }else{
                nel.push(val.DESCRIPTION);
              }
              
            });

            $('#FAOCBadge').text(faoc[0]);
            $('#FAOBBadge').text(faob[0]);
            $('#FAPPBadge').text(fapp[0]);
            $('#FEEBadge').text(fee[0]);
            $('#FIBadge').text(fi[0]);
            $('#FOIPBadge').text(foip[0]);

            $('#T1faoc').text(faoc[1].T1);
            $('#T2faoc').text(faoc[1].T2);
            $('#T3faoc').text(faoc[1].T3);
            $('#T11faoc').text(faoc[1].T11);
            $('#T1faob').text(faob[1].T1);
            $('#T2faob').text(faob[1].T2);
            $('#T3faob').text(faob[1].T3);
            $('#T11faob').text(faob[1].T11);
            $('#T1fapp').text(fapp[1].T1);
            $('#T2fapp').text(fapp[1].T2);
            $('#T3fapp').text(fapp[1].T3);
            $('#T11fapp').text(fapp[1].T11);
            $('#T1fee').text(fee[1].T1);
            $('#T2fee').text(fee[1].T2);
            $('#T3fee').text(fee[1].T3);
            $('#T11fee').text(fee[1].T11);
            $('#T1fi').text(fi[1].T1);
            $('#T2fi').text(fi[1].T2);
            $('#T3fi').text(fi[1].T3);
            $('#T11fi').text(fi[1].T11);
            $('#T1foip').text(foip[1].T1);
            $('#T2foip').text(foip[1].T2);
            $('#T3foip').text(foip[1].T3);
            $('#T11foip').text(foip[1].T11);
            
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
  }
  volumetria.init();
});