$(function () {
    volumetria = {
        init: function () {
            volumetria.events();
            volumetria.getNemonicosAccordingDate();
        },

        events: function () {
            $(`#newDate`).click(volumetria.getNemonicosAccordingDate);
            $(`#excelVol`).click(volumetria.createExcel);
        },

        getNemonicosAccordingDate: function () {
            if ($("#fDesde").val() <= $("#fHasta").val()) {
                $("#newDate,#fDesde, #fHasta").attr('disabled', true);
                $("#fDesde, #fHasta").css({'border-color': '#cccccc', 'box-shadow': 'unset'});
                helper.showLoading();
                $("span.badge").html('<i class="fas fa-spinner fa-spin"></i>');
                $.post(base_url + "Reportes/c_getNemonicosCCAccordingDate", {
                    desde: $(`#fDesde`).val(),
                    hasta: $(`#fHasta`).val(),
                },
                        function (data) {
                            const obj = JSON.parse(data);
                            volumetria.dataVoltria = {
                                'prueb': {'T1': [], 'T2': [], 'T3': [], 'T11': []},
                                'lider': {'T1': [], 'T2': [], 'T3': [], 'T11': []},
                                'rutin': {'T1': [], 'T2': [], 'T3': [], 'T11': []},
                                'reg': {'T1': [], 'T2': [], 'T3': [], 'T11': []},
                                'rec': {'T1': [], 'T2': [], 'T3': [], 'T11': []},
                                'ie': {'T1': [], 'T2': [], 'T3': [], 'T11': []},
                            }

                            var nel = [];
                            $.each(obj, function (i, val) {

                                if (val.DESCRIPTION.toUpperCase().includes('CCPYR_PRUEB')) {
                                    const horario = volumetria.getSchedule(val.CREATIONDATE.substr(11, 5), val.CREATEDBY);
                                    val['tipoT'] = horario;
                                    volumetria.dataVoltria.prueb[horario].push(val);
                                } else if (val.DESCRIPTION.toUpperCase().includes('CCPYR_LIDER')) {
                                    const horario = volumetria.getSchedule(val.CREATIONDATE.substr(11, 5), val.CREATEDBY);
                                    val['tipoT'] = horario;
                                    volumetria.dataVoltria.lider[horario].push(val);
                                } else if (val.DESCRIPTION.toUpperCase().includes('CCPYR_RUTIN')) {
                                    const horario = volumetria.getSchedule(val.CREATIONDATE.substr(11, 5), val.CREATEDBY);
                                    val['tipoT'] = horario;
                                    volumetria.dataVoltria.rutin[horario].push(val);
                                } else if (val.DESCRIPTION.toUpperCase().includes('CCCOM_REG')) {
                                    const horario = volumetria.getSchedule(val.CREATIONDATE.substr(11, 5), val.CREATEDBY);
                                    val['tipoT'] = horario;
                                    volumetria.dataVoltria.reg[horario].push(val);
                                } else if (val.DESCRIPTION.toUpperCase().includes('CCREC_REC')) {
                                    const horario = volumetria.getSchedule(val.CREATIONDATE.substr(11, 5), val.CREATEDBY);
                                    val['tipoT'] = horario;
                                    volumetria.dataVoltria.rec[horario].push(val);
                                } else if (val.DESCRIPTION.toUpperCase().includes('CCREC_IE')) {
                                    const horario = volumetria.getSchedule(val.CREATIONDATE.substr(11, 5), val.CREATEDBY);
                                    val['tipoT'] = horario;
                                    volumetria.dataVoltria.ie[horario].push(val);
                                } else {
                                    nel.push(val.DESCRIPTION);
                                }

                            });



                            $('#PRUEBBadge').text(Object.keys(volumetria.dataVoltria.prueb.T1).length + Object.keys(volumetria.dataVoltria.prueb.T2).length + Object.keys(volumetria.dataVoltria.prueb.T3).length + Object.keys(volumetria.dataVoltria.prueb.T11).length);
                            $('#LIDERBadge').text(Object.keys(volumetria.dataVoltria.lider.T1).length + Object.keys(volumetria.dataVoltria.lider.T2).length + Object.keys(volumetria.dataVoltria.lider.T3).length + Object.keys(volumetria.dataVoltria.lider.T11).length);
                            $('#RUTINBadge').text(Object.keys(volumetria.dataVoltria.rutin.T1).length + Object.keys(volumetria.dataVoltria.rutin.T2).length + Object.keys(volumetria.dataVoltria.rutin.T3).length + Object.keys(volumetria.dataVoltria.rutin.T11).length);
                            $('#REGBadge').text(Object.keys(volumetria.dataVoltria.reg.T1).length + Object.keys(volumetria.dataVoltria.reg.T2).length + Object.keys(volumetria.dataVoltria.reg.T3).length + Object.keys(volumetria.dataVoltria.reg.T11).length);
                            $('#RECBadge').text(Object.keys(volumetria.dataVoltria.rec.T1).length + Object.keys(volumetria.dataVoltria.rec.T2).length + Object.keys(volumetria.dataVoltria.rec.T3).length + Object.keys(volumetria.dataVoltria.rec.T11).length);
                            $('#IEBadge').text(Object.keys(volumetria.dataVoltria.ie.T1).length + Object.keys(volumetria.dataVoltria.ie.T2).length + Object.keys(volumetria.dataVoltria.ie.T3).length + Object.keys(volumetria.dataVoltria.ie.T11).length);

                            $('#T1prueb').text(Object.keys(volumetria.dataVoltria.prueb.T1).length);
                            $('#T2prueb').text(Object.keys(volumetria.dataVoltria.prueb.T2).length);
                            $('#T3prueb').text(Object.keys(volumetria.dataVoltria.prueb.T3).length);
                            $('#T11prueb').text(Object.keys(volumetria.dataVoltria.prueb.T11).length);
                            $('#T1lider').text(Object.keys(volumetria.dataVoltria.lider.T1).length + Object.keys(volumetria.dataVoltria.lider.T2).length + Object.keys(volumetria.dataVoltria.lider.T3).length + Object.keys(volumetria.dataVoltria.lider.T11).length);
                            $('#T2lider').text('0');
                            //   $('#T2lider').text(Object.keys(volumetria.dataVoltria.lider.T2).length);
                            $('#T3lider').text(Object.keys(volumetria.dataVoltria.lider.T3).length);
                            $('#T11lider').text(Object.keys(volumetria.dataVoltria.lider.T11).length);
                            $('#T1rutin').text(Object.keys(volumetria.dataVoltria.rutin.T1).length);
                            $('#T2rutin').text(Object.keys(volumetria.dataVoltria.rutin.T2).length);
                            $('#T3rutin').text(Object.keys(volumetria.dataVoltria.rutin.T3).length);
                            $('#T11rutin').text(Object.keys(volumetria.dataVoltria.rutin.T11).length);
                            $('#T1reg').text(Object.keys(volumetria.dataVoltria.reg.T1).length);
                            $('#T2reg').text(Object.keys(volumetria.dataVoltria.reg.T2).length);
                            $('#T3reg').text(Object.keys(volumetria.dataVoltria.reg.T3).length);
                            $('#T11reg').text(Object.keys(volumetria.dataVoltria.reg.T11).length);
                            $('#T1rec').text(Object.keys(volumetria.dataVoltria.rec.T1).length + Object.keys(volumetria.dataVoltria.rec.T2).length + Object.keys(volumetria.dataVoltria.rec.T3).length + Object.keys(volumetria.dataVoltria.rec.T11).length);

                            //   $('#T2rec').text(Object.keys(volumetria.dataVoltria.rec.T2).length);
                            $('#T2rec').text('0');
                            $('#T3rec').text(Object.keys(volumetria.dataVoltria.rec.T3).length);
                            $('#T11rec').text(Object.keys(volumetria.dataVoltria.rec.T11).length);
                            $('#T1ie').text(Object.keys(volumetria.dataVoltria.ie.T1).length + Object.keys(volumetria.dataVoltria.ie.T2).length + Object.keys(volumetria.dataVoltria.ie.T3).length + Object.keys(volumetria.dataVoltria.ie.T11).length);
                            $('#T2ie').text('0');
                            $('#T3ie').text(Object.keys(volumetria.dataVoltria.ie.T3).length);
                            $('#T11ie').text(Object.keys(volumetria.dataVoltria.ie.T11).length);

//                            $(`#totalNemonicos`).text(Object.keys(obj).length);
                            var subtotal = Object.keys(obj).length;

                            volumetria.getNemonicosAccordingDateV2(subtotal);
                            
                            $("#fDesde, #fHasta,#newDate").attr('disabled', false);


//                            helper.hideLoading();
                        }
                );
            } else {
                helper.miniAlertN('Error, La fecha <u>DESDE</u> debe ser menor o igual a la fecha <u>HASTA</u>', 'error', '2500');
                $("#fDesde, #fHasta").css({
                    'border-color': '#d01818',
                    'box-shadow': '0 0 0 3px #ff000066'
                });
            }
        },

        getSchedule: function (hora, creador) {
            if (creador.toUpperCase() == 'ECM0139H') {
                return 'T11';
            } else {
                if (hora >= '06:01' && hora <= '14:00') {
                    return 'T1';
                } else if (hora >= '14:01' && hora <= '22:00') {
                    return 'T2';
                } else {
                    return 'T3';
                }
            }
        },

        createExcel: function () {

            // window.open(base_url + "Reportes/excelVolumetrias");
            $.post(base_url + "Reportes/enviarDatosExcel", {
                data: JSON.stringify(volumetria.dataVoltria),
            },
                    ).done(function () {
                window.open(base_url + "Reportes/excelVolumetrias");
            });

        },

        getNemonicosAccordingDateV2: function (contador) {
            $.post(base_url + "Reportes/c_getNemonicosCCAccordingDateV2", {
                    desde: $(`#fDesde`).val(),
                    hasta: $(`#fHasta`).val(),
                },
                        function (data) {
                            const obj = JSON.parse(data);
                            volumetria.dataVoltria = {
                                'torre': {'T1': [], 'T2': [], 'T3': [], 'T5': [], 'T11': []},
                                'mail': {'T1': [], 'T2': [], 'T3': [], 'T5': [], 'T11': []},
                                'chat': {'T1': [], 'T2': [], 'T3': [], 'T5': [], 'T11': []},
                                'cci': {'T1': [], 'T2': [], 'T3': [], 'T5': [], 'T11': []},
                                'oop': {'T1': [], 'T2': [], 'T3': [], 'T5': [], 'T11': []},
                                'prq': {'T1': [], 'T2': [], 'T3': [], 'T5': [], 'T11': []},
                            }

                            var nel = [];
                            $.each(obj, function (i, val) {
                                if (val.DESCRIPTION.toUpperCase().includes('TG:S')) {
                                    const horario = volumetria.getScheduleV2(val.CREATEDATE.substr(11, 5), val.DESCRIPTION);
                                    val['tipoT'] = horario;
                                    volumetria.dataVoltria.torre[horario].push(val);
                                } else if (val.DESCRIPTION.toUpperCase().includes('CCCOM_MAIL')) {
                                    const horario = volumetria.getScheduleV2(val.CREATEDATE.substr(11, 5), val.DESCRIPTION);
                                    val['tipoT'] = horario;
                                    volumetria.dataVoltria.mail[horario].push(val);
                                } else if (val.DESCRIPTION.toUpperCase().includes('CCCOM_CHATS')) {
                                    const horario = volumetria.getScheduleV2(val.CREATEDATE.substr(11, 5), val.DESCRIPTION);
                                    val['tipoT'] = horario;
                                    volumetria.dataVoltria.chat[horario].push(val);
                                } else if (val.DESCRIPTION.toUpperCase().includes('CCREC_CCI')) {
                                    const horario = volumetria.getScheduleV2(val.CREATEDATE.substr(11, 5), val.DESCRIPTION);
                                    val['tipoT'] = horario;
                                    volumetria.dataVoltria.cci[horario].push(val);
                                } else if (val.DESCRIPTION.toUpperCase().includes('CCREC_SON')) {
                                    const horario = volumetria.getScheduleV2(val.CREATEDATE.substr(11, 5), val.DESCRIPTION);
                                    val['tipoT'] = horario;
                                    volumetria.dataVoltria.oop[horario].push(val);
                                } else if (val.DESCRIPTION.toUpperCase().includes('TGR:')) {
                                    const horario = volumetria.getScheduleV2(val.CREATEDATE.substr(11, 5), val.DESCRIPTION);
                                    val['tipoT'] = horario;
                                    volumetria.dataVoltria.torre[horario].push(val);
                                } else if (val.DESCRIPTION.toUpperCase().includes('CCREC_OOP')) {
                                    const horario = volumetria.getScheduleV2(val.CREATEDATE.substr(11, 5), val.DESCRIPTION);
                                    val['tipoT'] = horario;
                                    volumetria.dataVoltria.oop[horario].push(val);
                                } else if (val.DESCRIPTION.toUpperCase().includes('CCREC_PQR')) {
                                    const horario = volumetria.getScheduleV2(val.CREATEDATE.substr(11, 5), val.DESCRIPTION);
                                    val['tipoT'] = horario;
                                    volumetria.dataVoltria.prq[horario].push(val);
                                } else {
                                    nel.push(val.DESCRIPTION);
                                }

                            });



                            $('#TORREBadge').text(Object.keys(volumetria.dataVoltria.torre.T1).length + Object.keys(volumetria.dataVoltria.torre.T2).length + Object.keys(volumetria.dataVoltria.torre.T3).length + Object.keys(volumetria.dataVoltria.torre.T5).length + Object.keys(volumetria.dataVoltria.torre.T11).length);
                            $('#MAILBadge').text(Object.keys(volumetria.dataVoltria.mail.T1).length + Object.keys(volumetria.dataVoltria.mail.T2).length + Object.keys(volumetria.dataVoltria.mail.T3).length + Object.keys(volumetria.dataVoltria.mail.T5).length + Object.keys(volumetria.dataVoltria.mail.T11).length);
                            $('#CHATBadge').text(Object.keys(volumetria.dataVoltria.chat.T1).length + Object.keys(volumetria.dataVoltria.chat.T2).length + Object.keys(volumetria.dataVoltria.chat.T3).length + Object.keys(volumetria.dataVoltria.chat.T5).length + Object.keys(volumetria.dataVoltria.chat.T11).length);
                            $('#CCIBadge').text(Object.keys(volumetria.dataVoltria.cci.T1).length + Object.keys(volumetria.dataVoltria.cci.T2).length + Object.keys(volumetria.dataVoltria.cci.T3).length + Object.keys(volumetria.dataVoltria.cci.T5).length + Object.keys(volumetria.dataVoltria.cci.T11).length);
                            $('#OOPBadge').text(Object.keys(volumetria.dataVoltria.oop.T1).length + Object.keys(volumetria.dataVoltria.oop.T2).length + Object.keys(volumetria.dataVoltria.oop.T3).length + Object.keys(volumetria.dataVoltria.oop.T5).length + Object.keys(volumetria.dataVoltria.oop.T11).length);
                            $('#PRQBadge').text(Object.keys(volumetria.dataVoltria.prq.T1).length + Object.keys(volumetria.dataVoltria.prq.T2).length + Object.keys(volumetria.dataVoltria.prq.T3).length + Object.keys(volumetria.dataVoltria.prq.T5).length + Object.keys(volumetria.dataVoltria.prq.T11).length);

                            $('#T1torre').text(Object.keys(volumetria.dataVoltria.torre.T1).length);
                            $('#T2torre').text(Object.keys(volumetria.dataVoltria.torre.T2).length);
                            $('#T3torre').text(Object.keys(volumetria.dataVoltria.torre.T3).length);
                            $('#T5torre').text(Object.keys(volumetria.dataVoltria.torre.T5).length);
                            $('#T11torre').text(Object.keys(volumetria.dataVoltria.torre.T11).length);
                            
                            $('#T1mail').text(Object.keys(volumetria.dataVoltria.mail.T1).length);
                            $('#T2mail').text(Object.keys(volumetria.dataVoltria.mail.T2).length);
                            $('#T3mail').text(Object.keys(volumetria.dataVoltria.mail.T3).length);
                            
                            $('#T1chat').text(Object.keys(volumetria.dataVoltria.chat.T1).length);
                            $('#T2chat').text(Object.keys(volumetria.dataVoltria.chat.T2).length);
                            $('#T3chat').text(Object.keys(volumetria.dataVoltria.chat.T3).length);
                            $('#T4chat').text('0');
                            
                            $('#T1cci').text(Object.keys(volumetria.dataVoltria.cci.T1).length);
                            $('#T2cci').text(Object.keys(volumetria.dataVoltria.cci.T2).length);
                            $('#T3cci').text('0');
                            $('#T4cci').text('0');
                            
                            $('#T1oop').text(Object.keys(volumetria.dataVoltria.oop.T1).length);
                            $('#T2oop').text(Object.keys(volumetria.dataVoltria.oop.T2).length);
                            $('#T3oop').text('0');
                            $('#T4oop').text('0');
                            
                            $('#T5prq').text(Object.keys(volumetria.dataVoltria.prq.T5).length);
                            $('#T6prq').text('0');
                            $('#T7prq').text('0');
                            $('#T8prq').text('0');

                            var total = contador + Object.keys(obj).length;
                            $(`#totalNemonicos`).text(total);
                            
                            helper.hideLoading();

   
                        }
                );
        
        },
        
        getScheduleV2: function (hora, descripcion) {
            if (descripcion.toUpperCase().includes('TGT11S') || descripcion.toUpperCase().includes('TGT11R')) {
                return 'T11';
            } else {
                if (descripcion.toUpperCase().includes('TGT5') || descripcion.toUpperCase().includes('TGT5R')) {
                    return 'T5';
                } else if (hora >= '06:01' && hora <= '14:00') {
                    return 'T1';
                } else if (hora >= '14:01' && hora <= '22:00') {
                    return 'T2';
                } else {
                    return 'T3';
                }
            }
        },
        
    }
    volumetria.init();
});