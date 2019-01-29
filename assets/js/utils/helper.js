$(function() {
    helper = {
        init: function() {
            helper.events();
        },

        //Eventos de la ventana.
        events: function() {

        },

        // convierte una fecha al formato yyy-mm-dd
        formatDate: function(date) {
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
        miniAlert: function(title = 'Acción Cancelada', tipo = 'error') {
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
        alert_refresh: function(title = 'ok', text = 'Se realizó con exito', type = 'success') {
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

        // Alerta de cargando gif, PARA SER CERRADO DEBE USARSE EL METODO swal.close()
        alertLoading: function(title = 'Por favor!', msj = 'No cierre ni actualice esta ventana hasta que termine el proceso' , gif = true){
            const imge = (gif) ? `<img src="${base_url}/assets/images/cargando.gif" alt="" />` : '';
            swal({
                title: title,
                html: `<h4>${msj}</h4>
                 ${imge}
                `,
                onOpen: () => {
                    swal.showLoading();
                },
                allowOutsideClick: false // al darle clic fuera se cierra el alert
            });
        },


        // Función que permite pintar la tabla con los campos de busqueda
        // Los parametros son: Data que recibe los datos, columns: los números de columns en la tabla, IdTabke: Es el id de la tabla a pintar
        // ordenColumn:posicion para organizar las columnas y el ordenBy: la informacion se va a organizar de forma ascendente
        configTableSearchColumn: function(data, columns, idTable, ordenColumn, ordenBy = "asc", numeric = 0) {

            return {
                initComplete: function() {
                    $('#' + idTable + ' tfoot th').each(function() {
                        $(this).html('<input type="text" placeholder="Buscar" />');
                    });
                    var r = $('#' + idTable + ' tfoot tr');
                    r.find('th').each(function() {
                        $(this).css('padding', 8);
                    });
                    $('#' + idTable + ' thead').append(r);
                    $('#search_0').css('text-align', 'center');

                    // DataTable
                    var table = $('#' + idTable).DataTable();

                    // Apply the search
                    table.columns().every(function() {
                        var that = this;

                        $('input', this.footer()).on('keyup change', function() {
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
        sumar_o_restar_dias_a_fecha: function(fecha, dias = 1) {
            const cant_dias = dias * 86400000;
            const separado = fecha.split('-');
            const fecha_base = new Date(separado[0], separado[1] - 1, separado[2]);
            return new Date(fecha_base.getTime() + cant_dias);
        },

        // funcion que retona los datos del usuario que está en session
        // recibe el atributo de la session que se desea retornar
        // si no se le envia un argumento retorna todos los valores
        inSession: function(clave = false) {
            var retornar;
            $.ajaxSetup({async: false});
            $.post(base_url + '/User/getSessionValues',
                    {
                        clave: clave
                    }
            ,
                    function(data) {
                        const res = JSON.parse(data);
                        retornar = res;
                    });
            return retornar;
        },

        // funcion que retorna una caneda de texto de respuesta para la funcion processData de los loads
        // recibe el objeto data que retorna la funcion processData de los loads
        mensaje_respuesta_load: function(data) {
            let html = '';
            $.each(data, function(index, value) {
                if (index != 'row' && index != 'data') {
                    if (typeof value === 'object') {
                        if (value.length > 0) {
                            html += index.split("_").join(" ") + "<br><pre>";
                            $.each(value, function(index2, value2) {
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
        }

    };
    helper.init();
});
