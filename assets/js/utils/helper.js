$(function () {
    helper = {
        init: function () {
            helper.events();
        },

        //Eventos de la ventana.
        events: function () {

        },

        // convierte una fecha al formato yyy-mm-dd
        formatDate: function (date) {
            var d = new Date(date),
                    month = '' + (d.getMonth() + 1),
                    day = '' + d.getDate(),
                    year = d.getFullYear();
            // console.log("day", day);
            // console.log("month", month);



            // if (month.length == '2' && day.length == '2') {
            //     day = parseInt(day) + 1;
            // }

            if (month.length < 2)
                month = '0' + month;

            if (day.length < 2)
                day = '0' + day;

            // console.log("day", day);
            // console.log("month", month);
            // console.log("year", year);

            return [year, month, day].join('-');
        },

        // Muestra un pequeño mensaje (alert) en la parte superior derecha comunicando que se canceló la accion
        miniAlert: function (title = 'Acción Cancelada', tipo = 'error') {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            toast({
                type: tipo,
                title: title
            });
        },

        // muestra un alert y al confirmar se refresca la pantalla
        alert_refresh: function (title = 'ok', text = 'Se realizó con exito', type = 'success') {
            swal({
                title: title,
                html: text,
                type: type,
                position: 'top-end',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'continuar!'
            }).then((result) => {
                location.reload();
            })
        },

        // Función que permite pintar la tabla con los campos de busqueda
        // Los parametros son: Data que recibe los datos, columns: los números de columns en la tabla, IdTabke: Es el id de la tabla a pintar
        // ordenColumn:posicion para organizar las columnas y el ordenBy: la informacion se va a organizar de forma ascendente
        configTableSearchColumn: function (data, columns, idTable, ordenColumn, ordenBy = "asc", numeric = 0) {

            return {
                initComplete: function () {
                    $('#' + idTable + ' tfoot th').each(function () {
                        $(this).html('<input type="text" placeholder="Buscar" />');
                    });
                    var r = $('#' + idTable + ' tfoot tr');
                    r.find('th').each(function () {
                        $(this).css('padding', 8);
                    });
                    $('#' + idTable + ' thead').append(r);
                    $('#search_0').css('text-align', 'center');

                    // DataTable
                    var table = $('#' + idTable).DataTable();

                    // Apply the search
                    table.columns().every(function () {
                        var that = this;

                        $('input', this.footer()).on('keyup change', function () {
                            if (that.search() !== this.value) {
                                that.search(this.value).draw();
                            }
                        });
                    });
                },
                data: data,
                columns: columns,
                "language": {
                    "url": base_url + "/assets/plugins/datatables/lang/es.json"
                },
                dom: 'Blfrtip',
                buttons: [
                    {
                        text: 'Excel <span class="fa fa-file-excel-o"></span>',
                        className: 'btn-cami_cool',
                        extend: 'excel',
                        title: 'ZOLID EXCEL',
                        filename: 'zolid ' + fecha_actual
                    },
                    {
                        text: 'Imprimir <span class="fa fa-print"></span>',
                        className: 'btn-cami_cool',
                        extend: 'print',
                        title: 'Reporte Zolid',
                    }
                ],
                select: true,
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                ordering: true,
                columnDefs: [{
                        // targets: -1,
                        // visible: false,
                        defaultContent: "",
                        // targets: -1,
                        orderable: false,
                    }],

                // si no se envia la columna ni la direccion de ordenamiento se ordenará como viene por defecto los datos de la consulta
                order: (ordenColumn == '' && ordenBy == '') ? [] : [[ordenColumn, ordenBy]],

                "aoColumnDefs": [
                    {"sType": "numeric", "aTargets": [numeric]}
                ],

        }
        },

        // yyyy-mm-dd
        sumar_o_restar_dias_a_fecha: function (fecha, dias = 1) {
            const cant_dias = dias * 86400000;
            const separado = fecha.split('-');
            const fecha_base = new Date(separado[ 0 ], separado[ 1 ] - 1, separado[ 2 ]);
            return new Date(fecha_base.getTime() + cant_dias);
        },

        // funcion que retona los datos del usuario que está en session
        // recibe el atributo de la session que se desea retornar
        // si no se le envia un argumento retorna todos los valores
        inSession: function (clave = false) {
            var retornar;
            $.ajaxSetup({async: false});
            $.post(base_url + '/User/getSessionValues',
                    {
                        clave: clave
                    }
            ,
                    function (data) {
                        const res = JSON.parse(data);
                        retornar = res;
                    });
            return retornar;
        },

        // funcion que retorna una caneda de texto de respuesta para la funcion processData de los loads
        // recibe el objeto data que retorna la funcion processData de los loads
        mensaje_respuesta_load: function (data) {
            let html = '';
            $.each(data, function (index, value) {
                if (index != 'row' && index != 'data') {
                    if (typeof value === 'object') {
                        if (value.length > 0) {
                            html += index.split("_").join(" ") + "<br><pre>";
                            $.each(value, function (index2, value2) {
                                html += value2 + ",";
                            });
                            html += "</pre><br>";
                        }
                    } else {
                        html += index.split("_").join(" ") + "<br><pre>" + value + "</pre><br>";
                    }
                }
            });

            return html;
        },

        miniAlertN: function (title = 'Acción Cancelada', tipo = 'error', time = '1500') {
            Swal.fire({
                position: 'top-end',
                type: tipo,
                title: title,
                showConfirmButton: false,
                timer: time
            });
        },

        // cierra el modal de alerta de carga
        // si se le pasa la clase, aplicalá los estilos al determinado selectdor
        // si se el e
        hideLoading: function (segundos = '.8') {
            if (segundos[ 0 ] == '.') {
                var miliseg = segundos.split('.')[ 1 ] + '00';
            } else {
                var miliseg = segundos * 1000;
            }
            $(".loadingInfo").css({'animation': segundos + 's ocultar ease', 'border-top-left-radius': '5px', 'border-top': '1px solid black'});
            $(".loadingInfo span").css('border-top-left-radius', '5px');
            setTimeout(() => {
                $(".loadingInfo").remove();
            }, miliseg);
        },

        // muestra el mensaje de cargando
        // el mensaje que se mostrará en la ventana emergente
        showLoading: function (msj = 'Cargando...') {
            if (!$('.loadingInfo').length) {
                $('body').append(`
            <div class="loadingInfo">
                <!-- MODAL DE ALERTA DE CARGA, SE ACCEDE A EL USANDO  EL $(".loadingInfo").show(); -->
                <!-- PARA CERRARLO, USAR helper.hideLoading() -->
                <span></span>
                <i class="fab fa-gg-circle fa-fw fa-spin" aria-hidden="true"></i>
            </div>`);
                $(".loadingInfo span").html(msj)
            } else {
                alert("se está intentando abrir más de una ventana emergente de animación de carga");
        }
        },

        // nos dirá cuantos días tiene un mes
        // se le pasa el número del mes que se quiere saber el No. de Días
        numDiasSegunMes: function (numMes, anio = new Date().getFullYear()) {

            var dias = 0;
            var divisible = anio % 4;

            // (año divisible por 4) Y ((año no divisible por 100) O (año divisible por 400)
            switch (parseInt(numMes)) {
                case 1: // Enero
                case 3: // Marzo
                case 5: // Mayo
                case 7: // Julio
                case 8: // Agosto
                case 10: // Octubre
                case 12: // Diciembre
                    dias = 31;
                    break;
                case 2: // Febrero
                    if (divisible == 0 && (divisible != 100 || anio % 400 == 0)) {
                        dias = 29; //es bisiesto el año
                    } else {
                        dias = 28; //no es bisiesto el año
                    }
                    break;


                case 4: // Abril
                case 6: // Junio
                case 9: // Septiembre
                case 11: // Noviembre
                    dias = 30;
                    break;
                default:
                    dias = "no se ingresó un número de mes Válido"
                    break;
            }

            return dias;
        },

        // calcula cuánto tiempo ha pasado de una fecha a otra
        // se le pasan las fechas la cuales desea hacer la conversion
        // el rango de tiempo es para especificar en qué formato quiere que se lo devuelva (DIAS, MESES, ETC)
        calcularRangoDeFechas: function (fDesde, fHasta, rangoTiempo) {
            switch (rangoTiempo) {
                case 'dias':
                    var fechaini = new Date(fDesde);
                    var fechafin = new Date(fHasta);
                    var diasdif = fechafin.getTime() - fechaini.getTime();
                    var contdias = Math.round(diasdif / (1000 * 60 * 60 * 24));
                    break;
            }
            return contdias;
        },

        // private property
        _keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",

        // public method for encoding
        encode: function (input) {
            var output = "";
            var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
            var i = 0;

            input = helper._utf8_encode(input);

            while (i < input.length) {

                chr1 = input.charCodeAt(i++);
                chr2 = input.charCodeAt(i++);
                chr3 = input.charCodeAt(i++);

                enc1 = chr1 >> 2;
                enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
                enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
                enc4 = chr3 & 63;

                if (isNaN(chr2)) {
                    enc3 = enc4 = 64;
                } else if (isNaN(chr3)) {
                    enc4 = 64;
                }

                output = output +
                        this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) +
                        this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);

            }

            return output;
        },

        // public method for decoding
        decode: function (input) {
            var output = "";
            var chr1, chr2, chr3;
            var enc1, enc2, enc3, enc4;
            var i = 0;

            input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

            while (i < input.length) {

                enc1 = this._keyStr.indexOf(input.charAt(i++));
                enc2 = this._keyStr.indexOf(input.charAt(i++));
                enc3 = this._keyStr.indexOf(input.charAt(i++));
                enc4 = this._keyStr.indexOf(input.charAt(i++));

                chr1 = (enc1 << 2) | (enc2 >> 4);
                chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
                chr3 = ((enc3 & 3) << 6) | enc4;

                output = output + String.fromCharCode(chr1);

                if (enc3 != 64) {
                    output = output + String.fromCharCode(chr2);
                }
                if (enc4 != 64) {
                    output = output + String.fromCharCode(chr3);
                }

            }

            output = helper._utf8_decode(output);

            return output;

        },

        // private method for UTF-8 encoding
        _utf8_encode: function (string) {
            string = string.replace(/\r\n/g, "\n");
            var utftext = "";

            for (var n = 0; n < string.length; n++) {

                var c = string.charCodeAt(n);

                if (c < 128) {
                    utftext += String.fromCharCode(c);
                } else if ((c > 127) && (c < 2048)) {
                    utftext += String.fromCharCode((c >> 6) | 192);
                    utftext += String.fromCharCode((c & 63) | 128);
                } else {
                    utftext += String.fromCharCode((c >> 12) | 224);
                    utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                    utftext += String.fromCharCode((c & 63) | 128);
                }

            }

            return utftext;
        },

        // private method for UTF-8 decoding
        _utf8_decode: function (utftext) {
            var string = "";
            var i = 0;
            var c = c1 = c2 = 0;

            while (i < utftext.length) {

                c = utftext.charCodeAt(i);

                if (c < 128) {
                    string += String.fromCharCode(c);
                    i++;
                } else if ((c > 191) && (c < 224)) {
                    c2 = utftext.charCodeAt(i + 1);
                    string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
                    i += 2;
                } else {
                    c2 = utftext.charCodeAt(i + 1);
                    c3 = utftext.charCodeAt(i + 2);
                    string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
                    i += 3;
                }

            }

            return string;
        }

    };
    helper.init();
});
