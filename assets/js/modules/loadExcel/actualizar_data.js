$(function() {
    // index = {
    //     init: function() {
    //         index.events();
    //         index.show_hour();

    //     },

    //     //Eventos de la ventana.
    //     events: function() {
    //         $('.w3-sidebar').on('click', 'a#btn_actualizar_data', index.show_name);
    //     },

    //     show_hour: function() {
    //         $.post(base_url + 'Temp/getLastDateTemp',
    //                 {

    //                 },
    //                 function(data) {
    //                     var hour = JSON.parse(data);
    //                     $('#hora_actualizacion').append('<h6 class="h6-il">Ultima actualizacion </h6>' + hour);
    //                 });

    //     },

    //     // muestra alert con el input-name de la tabla a generar
    //     show_name: function(e) {

    //         $.post(base_url + 'Temp/temp_validate',
    //                 {
    //                     // param1: 'value1'
    //                 },
    //                 function(data) {
    //                     var new_table = JSON.parse(data);

    //                     swal({
    //                         title: '¿Actualizar data?',
    //                         html: `
    //          <div id="pasos" class="div_pasos" role="alert">
    //        <button id="btn_como" type="button" class="btn_como glyphicon glyphicon-question-sign btn btn-success"></button>
    //      </div>
    //          <pre class="letras_pasos"><code>${new_table}</code></pre>`,
    //                         type: 'warning',
    //                         showCancelButton: true,
    //                         cancelButtonText: 'Cancelar',
    //                         confirmButtonColor: '#3085d6',
    //                         cancelButtonColor: '#d33',
    //                         confirmButtonText: 'OK!'
    //                     }).then((result) => {
    //                         if (result.value) {
    //                             // segundo alert para confirmacion
    //                             swal({
    //                                 title: '¿Se exportó correctamente?',
    //                                 html: `
    //                      Al oprimir <strong>SI</strong> se generarán todos los cambios
    //                  `,
    //                                 type: 'question',
    //                                 showCancelButton: true,
    //                                 cancelButtonText: 'Cancelar',
    //                                 confirmButtonColor: '#3085d6',
    //                                 cancelButtonColor: '#d33',
    //                                 confirmButtonText: 'SI!'
    //                             }).then((si) => {
    //                                 if (si.value) {
    //                                     // codigo para actualiozar la data
    //                                     index.validar_exitoso(new_table);

    //                                 } else {
    //                                     //eliminar si existe la tabla temporal
    //                                     index.eliminar_temp_si_existe(new_table);
    //                                     const toast = swal.mixin({
    //                                         toast: true,
    //                                         position: 'top-end',
    //                                         showConfirmButton: false,
    //                                         timer: 3000
    //                                     });
    //                                     toast({
    //                                         type: 'error',
    //                                         title: 'Acción Cancelada'
    //                                     });
    //                                 }
    //                             });
    //                         } else {
    //                             //eliminar si existe la tabla temporal
    //                             index.eliminar_temp_si_existe(new_table);
    //                         }
    //                     });

    //                     $('#btn_como').on('click', index.show_steps);
    //                 });
    //     },
    //     // Validacion si fue exitosa la exportada
    //     validar_exitoso: function(tabla) {

    //         swal({
    //             title: 'Por favor!',
    //             html: `<h4>No cierre ni actualice esta ventana hasta que termine el proceso</h4>
    //  <img src="${base_url}/assets/images/cargando.gif" alt="" />
    // `,
    //             onOpen: () => {
    //                 swal.showLoading();
    //             },
    //             allowOutsideClick: false // al darle clic fuera se cierra el alert
    //         });

    //         $.post(base_url + 'Temp/exist_table',
    //                 {
    //                     tabla: tabla
    //                 },
    //                 function(data) {
    //                     var res = JSON.parse(data);
    //                     swal.close();
    //                     if (typeof res == 'object') {
    //                         // si es  indefinido se hizo bien el proceso
    //                         if (typeof res.error == 'undefined') {
    //                             swal({
    //                                 type: 'success',
    //                                 title: 'Data Actualizada!',
    //                                 html: `Nuevos = ${res.nuevos}<br>Actualizados = ${res.actualizados}<br>Eliminados:${res.borrados}<br>Errores:<br><pre>${res.errores}</pre>`
    //                             }).then((result) => {
    //                                 if (result.value) {
    //                                     location.reload();
    //                                 }

    //                             });

    //                         } else {
    //                             swal('Advertencia', 'No se realizó ninguna modificación', 'warning');
    //                         }

    //                     } else {
    //                         if (res == -1) {
    //                             swal('ERROR', 'La tabla no fue exportada correctamente', 'error');
    //                         } else if (res == -2) {
    //                             swal('ERROR', 'La tabla exportada no tiene registros validos', 'error');
    //                         }
    //                     }

    //                 });
    //     },

    //     //al darle click al boton con el signo de interrogacion en la pantalla de lider, saldran los pasos de como exportar la data de acces a mysql
    //     show_steps: function() {
    //         var flag = 0;

    //         $("#pasos").append("<br><br><li>Primero tendra que copiar el codigo que se encuentra en la barra de abajo.</li><br>",
    //                 "<li>El siguiente paso, es pegar ese codigo en Access, para eso deberá ir a la pestaña de 'External &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Data'/'Data Externa'.</li><br>",
    //                 "<li>Debera seleccionar el apartado 'Mas'/'More' y escoger la opcion 'ODBC Database'.</li><br>",
    //                 "<li>Pegará el codigo en la barra y le dará clic a 'ok', esto abrirá una ventana emergente.</li><br>",
    //                 "<li>En esta ventana en la parte superior, Escogerá la pestaña de 'Machine Data Sourse'.</li><br>",
    //                 "<li>Por último dará clic a 'ZOLID' y luego 'ok'.</li><br><br>");
    //         var flag = 1;
    //         if (flag == 1) {
    //             $('#btn_como').attr('disabled', true);
    //         }
    //     },

    //     // para eliminar una tabla de la bd
    //     eliminar_temp_si_existe: function(tabla) {
    //         $.post(base_url + 'Temp/js_drop_table_temp', {tabla: tabla});
    //     },

    // };
    //    index.init();
    var vista = {
        urlbase: $('body').attr('data-base'),
        exec: false,
        init: function() {
            vista.events();
        },
        events: function() {
            $('#formFileUpload').on('submit', vista.vistaFile);
            //        $('#btnUploadFile').on('click', vista.vistaFile);
        },
        vistaFile: function(e) {
            app.stopEvent(e);
            var form = $(this);
            var button = $('#btn_subir_excel-data');
            var input = form.find('input:file');
            if (input[0].files.length == 0) {
                input.trigger('click');
                return;
            }
            button.html('<span class="fa fa-fw fa-spin fa-refresh"></span> Subiendo...');
            button.prop('disabled', true);
            vista.uploadFile(input[0], button);
        },
        onChangeFile: function(e) {
            if (!e) {
                return;
            }
            var input = e.target;
            vista.uploadFile(input);
        },
        uploadFile: function(input, button) {
            app.uploadFile("LoadInformation/uploadFile", input, ["xlsx"]["xls"])
                    .progress(function(progress) {
                        //Plajear barrita de progreso...
                        button.html('<span class="fa fa-fw fa-spin fa-refresh"></span> Subiendo (' + progress + ')...');
                    })
                    .complete(function(response) {
                        button.html('<span class="fa fa-fw fa-spin fa-refresh"></span> Procesando').prop('disabled', false);
                        if (response.code > 0) {
                            swal("Correcto", "Se ha subido correctamente el archivo, haga clic a continuación en el botón ok para iniciar la lectura y carga del archivo que acaba de subir en el sistema.", "success").then(function() {
                                vista.processData(response.data, alert);
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
                            swal("Error", response.message, "error");
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
            app.post('LoadInformation/countLinesFile', {
                file: data.path
            }).success(function(response) {
                console.log(response);
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

            vista.showProgress();
            app.post('LoadInformation/processData', {
                file: data.path,
                index: vista.index,
                limit: vista.limit,
                export: vista.export
            })
                    .complete(function() {})
                    .success(function(response) {
                        vista.nuevos += parseInt(response.data.nuevos);
                        vista.modificadas += parseInt(response.data.modificadas);
                        vista.borradas += parseInt(response.data.borradas);
                        vista.errores += response.data.errores;


                        if (response.code == 2) {
                            swal({
                                type: 'success',
                                title: 'Data Actualizada!',
                                html: `Nuevos = ${vista.nuevos}<br>Actualizados = ${vista.modificadas}<br>Eliminados:${vista.borradas}<br>Errores:<br><pre>${vista.errores}</pre>`
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
                            console.log(vista.selec);
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
        }
    };

    vista.init();
});