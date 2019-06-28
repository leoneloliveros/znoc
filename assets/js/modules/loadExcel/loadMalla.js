$(function() {
    var loadMalla = {
        urlbase: $('body').attr('data-base'),
        exec: false,
        init: function() {
            loadMalla.events();
        },
        events: function() {
            $('#formFileUploadMalla').on('submit', loadMalla.vistaFile);
            //        $('#btnUploadFile').on('click', loadMalla.vistaFile);
        },
        vistaFile: function(e) {
            app.stopEvent(e);
            var form = $(this);
            var button = $('#btn_subir_malla-data');
            var input = form.find('input:file');
            if (input[0].files.length == 0) {
                input.trigger('click');
                return;
            }
            button.html('<span class="fa fa-fw fa-spin fa-refresh"></span> Subiendo...');
            button.prop('disabled', true);
            loadMalla.uploadFile(input[0], button);
        },
        onChangeFile: function(e) {
            if (!e) {
                return;
            }
            var input = e.target;
            loadMalla.uploadFile(input);
        },
        uploadFile: function(input, button) {
            app.uploadFile("LoadMalla/uploadFile", input, ["xlsx"]["xls"])
                    .progress(function(progress) {
                        //Plajear barrita de progreso...
                        button.html('<span class="fa fa-fw fa-spin fa-refresh"></span> Subiendo (' + progress + ')...');
                    })
                    .complete(function(response) {
                        button.html('<span class="fa fa-fw fa-spin fa-refresh"></span> Procesando').prop('disabled', false);
                        if (response.code > 0) {
                            swal("Correcto", "Se ha subido correctamente el archivo, haga clic a continuación en el botón ok para iniciar la lectura y carga del archivo que acaba de subir en el sistema.", "success").then(function() {
                                loadMalla.processData(response.data, alert);
                                $(input).val('');
                                swal({
                                    title: 'Por favor!',
                                    html: `<h4>No cierre ni actualice esta ventana hasta que termine el proceso</h4>
                                     <img src="${base_url}/assets/images/cargando.gif" alt="" />
                                    `,
                                    onOpen: () => {
                                        swal.showLoading();
                                    },
                                    allowOutsideClick: false // al darle clic fuera se cierra el alert
                                });

                            });
                        } else {
                            swal("Error", response.message, "error").then(function(){
                                location.reload(true);
                            });
                        }
                    })
                    .errorExtension(function(file) {
                        swal("Error", "Extención de archivo no permitida, solo se permiten archivos de extención XLSX y XLS", "error");
                    })
                    .start();
        },


        limit: 1500,
        indexTemp: 0,
        index: 2,
        linesFile: -1,
        actualProcess: null,
        sleepTime: 2000,
        selec: 0,


        // nuevos: 0,
        // modificadas: 0,
        // borradas: 0,
        // errores: '',

        getLinesFile: function(data, callback) {
            app.post('LoadMalla/countLinesFile', {
                file: data.path
            }).success(function(response) {
                console.log(response);
                var v = app.successResponse(response);
                if (v) {
                    if (response.data.notNumerirc <= 0) {
                        loadMalla.linesFile = (parseInt(response.data.sheet1));
                        loadMalla.export = (parseInt(response.data.export));
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
                            let msj = "El excel cargado no tiene el formato correcto, por favor verificar que se esta cargando el excel de asignaciones<br>";
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
            var i = (loadMalla.indexTemp) + 2;
            $('#lblProgressInformation').removeClass('hidden').html((i) + ' de ' + (loadMalla.linesFile - 2) + ' líneas procesadas.');
            var progressValue = Math.round(((i) / (loadMalla.linesFile - 2)) * 100);
            if (progressValue > 100) {
                progressValue = 100;
            }
            $('#btnUploadFile').html('<i class="fa fa-fw fa-spin fa-refresh"></i> Procesando (' + progressValue + '%)');
            //        progress.find('.progress-bar').html(progressValue + '%').css('width', progressValue + '%').attr('title', progressValue + '% de progreso.');
        },
        processData: function(data, alert) {
            loadMalla.actualProcess = 1; //Procesando data...
            if (loadMalla.linesFile < 0) {
                loadMalla.getLinesFile(data, function() {
                    loadMalla.processData(data, alert);
                });
                return;
            }

            loadMalla.showProgress();
            app.post('LoadMalla/processData', {
                file: data.path,
                index: loadMalla.index,
                limit: loadMalla.limit,
            })
                    .complete(function() {})
                    .success(function(response) {
                        console.log("response ProcessData", response);
                        loadMalla.nuevos += parseInt(response.data.nuevos);
                        loadMalla.modificadas += parseInt(response.data.modificadas);
                        loadMalla.borradas += parseInt(response.data.borradas);
                        loadMalla.errores += response.data.errores;

                        if (response.code == 2) {

                            let html = helper.mensaje_respuesta_load(response.data);

                            swal({
                                type: 'success',
                                title: 'Archivo Procesado!',
                                html: html
                            }).then((result) => {
                                if (result.value) {
                                    location.reload();
                                }

                            });
                            return;
                        }
                        var v = app.validResponse(response);
                        if (v) {
                            loadMalla.index += response.data.row;
                            loadMalla.indexTemp += response.data.row;
                            loadMalla.selec += response.data.seleccionados;
                            console.log(loadMalla.selec);
                            window.setTimeout(function() {
                                loadMalla.processData(data, alert);
                            }, loadMalla.sleepTime);
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
        }
    };

    loadMalla.init();
});