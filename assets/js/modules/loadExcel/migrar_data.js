$(function() {
    function bs_input_file() {
        $(".input-file").before(
                function() {
                    if (!$(this).prev().hasClass('input-ghost')) {
                        var element = $("<input type='file' class='input-ghost' style='visibility:hidden; height:0'>");
                        element.attr("name", $(this).attr("name"));
                        element.change(function() {
                            element.next(element).find('input').val((element.val()).split('\\').pop());
                        });
                        $(this).find("button.btn-choose").click(function() {
                            element.click();
                        });
                        $(this).find("button.btn-reset").click(function() {
                            element.val(null);
                            $(this).parents(".input-file").find('input').val('');
                        });
                        $(this).find('input').css("cursor", "pointer");
                        $(this).find('input').mousedown(function() {
                            $(this).parents('.input-file').prev().click();
                            return false;
                        });
                        return element;
                    }
                }
        );
    }
    bs_input_file();

    var vista = {
        exec: false,
        init: function() {
            vista.events();
        },
        events: function() {
            $('#formFile_onair').on('submit', vista.vistaFile);
            $('#formFile_comentarios').on('submit', vista.vistaFile);
        },
        vistaFile: function(e) {
            app.stopEvent(e);
            var form = $(this);
            var button = form.find('button:submit');  //$('#btn_subir_excel-data');

            vista.barra_progreso = form.find('div.progress-bar');
            vista.controlador = button.data('controlador');

            var input = form.find('input:file');
            if (input[0].files.length == 0) {
                input.trigger('click');
                return;
            }
            button.html('<span class="fa fa-fw fa-spin fa-refresh"></span> Subiendo...');
            button.prop('disabled', true);
            vista.uploadFile(input[0], button);
        },

        uploadFile: function(input, button) {
            app.uploadFile(`${vista.controlador}/uploadFile`, input, ["xlsx"]["xls"])
                    .progress(function(progress) {

                        //Plajear barrita de progreso...
                        button.html('<span class="fa fa-fw fa-spin fa-refresh"></span> Subiendo (' + progress + ')...');
                    })
                    .complete(function(response) {
                        button.html('<span class="fa fa-fw fa-spin fa-refresh"></span> Procesando').prop('disabled', false);
                        if (response.code > 0) {
                            swal("Correcto", "Se ha subido correctamente el archivo, haga clic a continuación en el botón ok para iniciar la lectura y carga del archivo que acaba de subir en el sistema.", "success")
                                    .then(function() {
                                        vista.processData(response.data, alert);
                                        $(input).val('');
                                        // swal({
                                        //     title: 'Por favor!',
                                        //     html: `<h4>No cierre ni actualice esta ventana hasta que termine el proceso</h4>
                                        //      <img src="${base_url}/assets/images/cargando.gif" alt="" />
                                        //     `,
                                        //     onOpen: () => {
                                        //         swal.showLoading();
                                        //     },
                                        //     allowOutsideClick: false // al darle clic fuera se cierra el alert
                                        // });

                                    });
                        } else {
                            swal("Error", response.message, "error");
                        }
                    })
                    .errorExtension(function(file) {
                        swal("Error", "Extención de archivo no permitida, solo se permiten archivos de extención XLSX y XLS", "error");
                    })
                    .start();
        },
        limit: 1500,
        // limit: 100,
        indexTemp: 0,
        index: 2,
        linesFile: -1,
        actualProcess: null,
        sleepTime: 2000,
        selec: 0,
        export: 0,

        controlador: '',
        cantidad_lineas: 0,
        num_proceso: 0,
        iteracion: 0,
        barra_progreso: '',

        nuevos: 0,
        modificadas: 0,
        no_existe: 0,
        errores: '',
        getLinesFile: function(data, callback) {
            app.post(`${vista.controlador}/countLinesFile`, {
                file: data.path
            }).success(function(response) {
                vista.cantidad_lineas = response.data.sheet1;
                var v = app.successResponse(response);
                if (v) {
                    if (response.data.notNumerirc <= 0) {
                        vista.linesFile = (parseInt(response.data.sheet1));
                        vista.export = (parseInt(response.data.export));
                        callback();
                    } else {
                        if (response.data.notNumerirc != 999999999) {
                            let msj = "El excel cargado no tiene el formato correcto, por favor verificar el Id-On Air las siguientes lineas del excel<br><pre>";
                            $.each(response.data.lineError, function(index, value) {
                                msj += value + ",";
                            });
                            msj += "</pre>";
                            helper.alert_refresh('Error', msj, 'error');
                        } else {
                            let msj = "El excel cargado no tiene el formato correcto, por favor verificar que se esta cargando el excel de actualizacion de data<br>";
                            helper.alert_refresh('Error', msj, 'error');
                        }
                    }
                } else {
                    swal("Error", "No hay lineas que procesar en el archivo.", "error");
                }
            }).error(function(error) {
                console.error(error);
            }).send();
        },
        showProgress: function() {
            var progress = $('#progressProcessImportData');
            progress.removeClass('hidden');
            var i = (vista.indexTemp) + 2;
            $('#lblProgressInformation').removeClass('hidden').html((i) + ' de ' + (vista.linesFile - 2) + ' líneas procesadas.');
            var progressValue = Math.round(((i) / (vista.linesFile - 2)) * 100);
            if (progressValue > 100) {
                progressValue = 100;
            }

            $('#btnUploadFile').html('<i class="fa fa-fw fa-spin fa-refresh"></i> Procesando (' + progressValue + '%)');
            //        progress.find('.progress-bar').html(progressValue + '%').css('width', progressValue + '%').attr('title', progressValue + '% de progreso.');
        },
        processData: function(data, alert) {
            vista.actualProcess = 1; //Procesando data...
            if (vista.linesFile < 0) {
                vista.getLinesFile(data, function() {
                    vista.processData(data, alert);
                });
                return;
            }
            // funcion para llenar las barras de progreso
            vista.pintar_barra_progreso();

            vista.showProgress();
            app.post(`${vista.controlador}/processData`, {
                file: data.path,
                index: vista.index,
                limit: vista.limit,
                export: vista.export
            })
                    .complete(function() {})
                    .success(function(response) {
                        vista.nuevos += parseInt(response.data.nuevos);
                        vista.modificadas += parseInt(response.data.modificadas);
                        vista.no_existe += parseInt(response.data.no_existe);
                        vista.errores += response.data.errores;


                        if (response.code == 2) {
                            swal({
                                type: 'success',
                                title: 'Data Actualizada!',
                                html: `Nuevos = ${vista.nuevos}<br>Actualizados = ${vista.modificadas}<br>Sin insertar:${vista.no_existe}<br>Errores:<br><pre>${vista.errores}</pre>`
                            }).then((result) => {
                                if (result.value) {
                                    location.reload();
                                }

                            });
                            return;
                        }
                        var v = app.validResponse(response);
                        if (v) {
                            vista.index += response.data.row;
                            vista.indexTemp += response.data.row;
                            vista.selec += response.data.seleccionados;
//                            console.log(vista.selec);
                            window.setTimeout(function() {
                                vista.processData(data, alert);
                            }, vista.sleepTime);
                        } else {
                            swal("Error", "Lo sentimos, no se pudo procesar el archivo que ha subido.", "error");
                        }
                    })
                    .error(function(e) {
                        swal("Error", "Lo sentimos se ha producido un error inesperado al procesar el archivo que ha subido.", "error");
                    })
                    .send();
        },
        fillNA: function() {
            return "Indefinido";
        },

        // Pintar las barras de progreso de los load files
        pintar_barra_progreso: function() {
            vista.iteracion++;
            var veces = parseInt(vista.cantidad_lineas / vista.limit);
            if (vista.cantidad_lineas % vista.limit > 0) {
                veces++;
            }
            var porcenta = ((vista.iteracion * 100) / veces);
            vista.barra_progreso.css('width', porcenta + '%');
            vista.barra_progreso.html(Math.round(porcenta) + '%');
        },
    };

    vista.init();
});