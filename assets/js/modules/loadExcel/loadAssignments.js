$(function() {
    var loadAssignment = {
        urlbase: $('body').attr('data-base'),
        exec: false,
        init: function() {
            loadAssignment.events();
        },
        events: function() {
            $('#formFileUploadAssign').on('submit', loadAssignment.vistaFile);
            //        $('#btnUploadFile').on('click', loadAssignment.vistaFile);
        },
        vistaFile: function(e) {
            app.stopEvent(e);
            var form = $(this);
            var button = $('#btn_subir_asignaciones-data');
            var input = form.find('input:file');
            if (input[0].files.length == 0) {
                input.trigger('click');
                return;
            }
            button.html('<span class="fa fa-fw fa-spin fa-refresh"></span> Subiendo...');
            button.prop('disabled', true);
            loadAssignment.uploadFile(input[0], button);
        },
        onChangeFile: function(e) {
            if (!e) {
                return;
            }
            var input = e.target;
            loadAssignment.uploadFile(input);
        },
        uploadFile: function(input, button) {
            app.uploadFile("LoadAssignments/uploadFile", input, ["xlsx"]["xls"])
                    .progress(function(progress) {
                        //Plajear barrita de progreso...
                        button.html('<span class="fa fa-fw fa-spin fa-refresh"></span> Subiendo (' + progress + ')...');
                    })
                    .complete(function(response) {
                        button.html('<span class="fa fa-fw fa-spin fa-refresh"></span> Procesando').prop('disabled', false);
                        if (response.code > 0) {
                            swal("Correcto", "Se ha subido correctamente el archivo, haga clic a continuación en el botón ok para iniciar la lectura y carga del archivo que acaba de subir en el sistema.", "success").then(function() {
                                loadAssignment.processData(response.data, alert);
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
        export: 0,

        nuevos: 0,
        modificadas: 0,
        borradas: 0,
        errores: '',
        getLinesFile: function(data, callback) {
            app.post('loadAssignments/countLinesFile', {
                file: data.path
            }).success(function(response) {
//                console.log(response);
                var v = app.successResponse(response);
                if (v) {
                    if (response.data.notNumerirc <= 0) {
                        loadAssignment.linesFile = (parseInt(response.data.sheet1));
                        loadAssignment.export = (parseInt(response.data.export));
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
            var i = (loadAssignment.indexTemp) + 2;
            $('#lblProgressInformation').removeClass('hidden').html((i) + ' de ' + (loadAssignment.linesFile - 2) + ' líneas procesadas.');
            var progressValue = Math.round(((i) / (loadAssignment.linesFile - 2)) * 100);
            if (progressValue > 100) {
                progressValue = 100;
            }
            $('#btnUploadFile').html('<i class="fa fa-fw fa-spin fa-refresh"></i> Procesando (' + progressValue + '%)');
            //        progress.find('.progress-bar').html(progressValue + '%').css('width', progressValue + '%').attr('title', progressValue + '% de progreso.');
        },
        processData: function(data, alert) {
            loadAssignment.actualProcess = 1; //Procesando data...
            if (loadAssignment.linesFile < 0) {
                loadAssignment.getLinesFile(data, function() {
                    loadAssignment.processData(data, alert);
                });
                return;
            }

            loadAssignment.showProgress();
            app.post('loadAssignments/processData', {
                file: data.path,
                index: loadAssignment.index,
                limit: loadAssignment.limit,
                export: loadAssignment.export,
                fecha_programacion: $('#ModalLoadAssignments #fecha_programacion').val()
            })
                    .complete(function() {})
                    .success(function(response) {
                        loadAssignment.nuevos += parseInt(response.data.nuevos);
                        loadAssignment.modificadas += parseInt(response.data.modificadas);
                        loadAssignment.borradas += parseInt(response.data.borradas);
                        loadAssignment.errores += response.data.errores;

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
                            loadAssignment.index += response.data.row;
                            loadAssignment.indexTemp += response.data.row;
                            loadAssignment.selec += response.data.seleccionados;
//                            console.log(loadAssignment.selec);
                            window.setTimeout(function() {
                                loadAssignment.processData(data, alert);
                            }, loadAssignment.sleepTime);
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

    loadAssignment.init();
});