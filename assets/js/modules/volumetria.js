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
            console.log('obj: ', obj);
            var faoc=0;
            var faob=0;
            var fapp=0;
            var fee=0;
            var fi=0;
            var foip=0;
            var nel = [];
            $.each(obj, function (i, val) { 
              
              switch (val.DESCRIPTION.substr(0,5)) {
                case 'FAOC:':
                  faoc +=1 ;
                  break;
              
                case 'FAOB:':
                  faob +=1 ;
                  break;
              
                case 'FAPP:':
                  fapp +=1 ;
                  break;
              
              
                case 'FOIP:':
                  foip +=1 ;
                  break;
              
                default:
                  switch (val.DESCRIPTION.substr(0,4)) {
                    case "FEE:":
                      fee += 1;
                      break;
                  
                    default:
                      fi += 1;
                      break;
                  }
                  // nel.push(val.DESCRIPTION);
                  break;
              }
              // if (val.DESCRIPTION.includes('FAOC:')) {
                
              //   console.log('obj: ', val.DESCRIPTION);
              // }
            });
            console.log('FAOC: ', faoc);
            console.log('FAOB: ', faob);
            console.log('FAPP: ', fapp);
            console.log('FEE: ', fee);
            console.log('FI: ', fi);
            console.log('FOIP: ', foip);
            $('#FAOCBadge').text(faoc);
            $('#FAOBBadge').text(faob);
            $('#FAPPBadge').text(fapp);
            $('#FEEBadge').text(fee);
            $('#FIBadge').text(fi);
            $('#FOIPBadge').text(foip);
            
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
  }
  volumetria.init();
});