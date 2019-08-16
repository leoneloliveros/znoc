$(function () {
    ccihfc = {
        init: function () {
            ccihfc.events();
            ccihfc.loadEngineersBackOffice();
        },

        events: function () {
            $('#newLogBook').click(ccihfc.validateData);
            $('#beginDate,#endDate').mask("99/99/9999 99:99", {placeholder: "--/--/---- --:--"});
            $("#beginDate,#typeP").on('change', ccihfc.calculateFinalHour);
            $(".styleInp").on('blur', ccihfc.calculateDateIni);
        },

        validateData: function () {
            var hoy = new Date();
            $("#finAct").val(ccihfc.formatDate(hoy.getTime()));
            
            $(".err").removeClass("err");
            const campos = $("div.frame input,div.frame select, div.frame textarea");
            var vacios = [];
            var data = {};
            $.each(campos, function (i, element) {
                if ($(element).prop("type") != "checkbox") {
                    if ($(element).val() == null || $(element).val() == '' || $(element).val() == ' ' || $(element).val() == '  ') {
                        vacios.push($(element).attr("id"));
                    } else {
                        data[$(element).attr("id")] = $(element).val();
                    }
                } else {
                    if ($(element).prop('checked')) {
                        data[$(element).attr("id")] = "X";
                    }
                }

            });
//            console.log(data);
            if (vacios.length != 0) {
                $.each(vacios, function (i, id) {
                    $(`#${id}`).addClass('err');
                });
                swal({
                    "html": "¡No puede dejar los campo en rojo vacios!",
                    "type": "error"
                });
//                console.log("vacios", vacios);

            } else {
                ccihfc.saveLogBook(data);
            }

        },

        saveLogBook: function (bitacora) {
            $.post(base_url + "Bitacoras/saveCCIHFC", {data: JSON.stringify(bitacora)},
                    function (bool) {
                        let msj = '';
                        if (bool) {
                            msj = ['Se guardó la bitácora.', 'success'];
                        } else {
                            msj = ['Hubo un error inesperado.', 'error'];
                        }

                        swal({
                            "html": msj[0],
                            "type": msj[1]
                        }).then(() => {
                            location.reload();
                        });

                    },
                    );
        },

        loadEngineersBackOffice: function () {
            /*helper.showLoading();*/

            $.post(base_url + "Bitacoras/c_getEngineersByAreaAndRol", {
                rol: 'ingeniero',
                area: 'Dilo_BackOffice',
            },
                    function (data) {
                        const obj = JSON.parse(data);

                        $.each(obj, function (i, val) {
                            $('#engineer').append('<option value="' + val.id_users + '">' + val.ingeniero + '</option>');
                        });

                        /*helper.hideLoading();*/
                    }
            );

        },

        calculateFinalHour: function () {
            var beginDate = $("#beginDate").val();
            var typeP = $("#typeP").val();
            var minutos = 0;
            if (beginDate != '' && typeP != '') {

                switch (typeP) {
                    case 'P1':
//                        minutos = 147;
                        minutos = 2.75;
                        break;
                    case 'P2':
                        minutos = 5.116667;
                        break;
                    case 'P3':
                        minutos = 8.75;
                        break;
                }

                var res = ccihfc.sumar_minutos_a_fecha(beginDate, minutos);
                $('#endDate').val(res);
            }

        },

        sumar_minutos_a_fecha: function (fecha, minutos = 1) {
            var hoy = new Date(fecha);
            var minutosEnMilisegundos = 1000 * 60 * 60 * minutos;
            var suma = hoy.getTime() + minutosEnMilisegundos; //getTime devuelve milisegundos de esa fecha
            var fechaNueva = ccihfc.formatDate(suma);
            return fechaNueva;
        },

        // convierte una fecha al formato yyy-mm-dd
        formatDate: function (date) {
            var d = new Date(date),
                    month = '' + (d.getMonth() + 1),
                    day = '' + d.getDate(),
                    year = d.getFullYear(),
                    hour = d.getHours(),
                    minute = d.getMinutes();
            // console.log("day", day);
            // console.log("month", month);
            if (month.length < 2)
                month = '0' + month;
            if (day.length < 2)
                day = '0' + day;
            // console.log("day", day);
            // console.log("month", month);
            // console.log("year", year);

//            return [year, month, day].join('-');
            return day + '/' + month + '/' + year + ' ' + hour + ':' + minute;
        },
        

        calculateDateIni:function () {
            if (!$("#iniAct").hasClass("ini_form")) {
                var hoy = new Date();
                $("#iniAct").val(ccihfc.formatDate(hoy.getTime()));
                $("#iniAct").addClass("ini_form");
            }
        }
    }
    ccihfc.init();
});