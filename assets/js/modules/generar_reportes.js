$(function () {
    reporte = {
        consecutivo: 1,

        init: function () {
            reporte.events();
        },

        events: function () {
            $('#generateReport').click(reporte.generateReport);
            $('#esquema').change(reporte.loadTablesBySchema);
            $('#tabla').change(reporte.loadColumnByTable);
            $('#exportExcel').click(reporte.exportExcelReport);
            $('#enable_conditions').change(reporte.enableConditions);
//            $('#columnas_conditions').change(reporte.columnasConditions);
            $('#columnas').multiselect({
                includeSelectAllOption: true,
            });

        },


        loadTablesBySchema: function () {
            helper.showLoading();
            reporte.clearSelect('tabla');
            reporte.clearSelect('columnas');

            var schema = $('#esquema').val();

            $.post(base_url + "Reportes/c_getTablesBySchema", {
                schema: schema,
            },
                    function (data) {
                        const obj = JSON.parse(data);
//                        console.log(obj);
                        $.each(obj, function (i, val) {
                            var valor = (schema == 'maximo') ? val.Tables_in_maximo : val.Tables_in_reportes;
                            $('#tabla').append('<option value="' + valor + '">' + valor + '</option>');
                        });

                    }
            );

            helper.hideLoading();
        },
        // Funcion para darle animacion a los Label del id= "#containerConditions_"
        inputAnimations: function() {
            $('input').focus(function(){
                $(this).parents('.form-group').addClass('focused');
            });
            $('input').blur(function(){
                var inputValue = $(this).val();
                if ( inputValue == "" ) {
                    $(this).removeClass('filled');
                    $(this).parents('.form-group').removeClass('focused');
                } else {
                    $(this).addClass('filled');
                }
            });

            $('select').focus(function(){
                $(this).parents('.form-group').addClass('focused');
            });

            $('select').blur(function(){
                var selectValue = $(this).val();
                if ( selectValue == "" ) {
                    $(this).removeClass('filled');
                    $(this).parents('.form-group').removeClass('focused');
                } else {
                    $(this).addClass('filled');
                }
            });

            $('textarea').focus(function(){
                $(this).parents('.form-group').addClass('focused');
            });
            $('textarea').blur(function(){
                var selectValue = $(this).val();
                if ( selectValue == "" ) {
                    $(this).removeClass('filled');
                    $(this).parents('.form-group').removeClass('focused');
                } else {
                    $(this).addClass('filled');
                }
            });

        },

        loadColumnByTable: function () {
            helper.showLoading();
            reporte.clearSelect('columnas');
            reporte.clearSelect('columnas_conditions_1');

            var schema = $('#esquema').val();
            var table = $('#tabla').val();

            $.post(base_url + "Reportes/c_getColumnsByTable", {
                schema: schema,
                table: table,
            },
                    function (data) {
                        const obj = JSON.parse(data);
//                        console.log(obj);
                        $.each(obj, function (i, val) {
                            $('#columnas').append('<option value="' + val.Field + '">' + val.Field + '</option>');
                            $('#columnas_conditions_1').append('<option data-set="' + val.Type + '" value="' + val.Field + '">' + val.Field + '</option>');
                        });

                        $('#columnas').multiselect('destroy').removeData().multiselect({
                            includeSelectAllOption: true,
                        });

                    }
            );

            helper.hideLoading();
        },

        clearSelect: function (select_id) {
            $('#' + select_id + ' option').each(function () {
                if ($(this).val() != '') {
                    $(this).remove();
                }
            });
        },

        generateReport: function () {
          helper.showLoading();
            if (reporte.tblReport) {
                var tabla = reporte.tblReport;
                tabla.destroy();
            }

            var columns = $('#columnas').val();
            var schema = $('#esquema').val();
            var table = $('#tabla').val();
            var query = "";
            var where = "";

            if (columns != '' && schema != '' && table != '') {
                helper.showLoading();
                $('#columnas, #esquema, #tabla').removeClass("err");
                var columns2 = columns.toString();

                if ($('#enable_conditions').prop('checked')) {
                    const campos = $("div.containerConditions input,div.containerConditions select").not('.isLike');
                    var is_like;
                    where = " WHERE ";
                    $.each(campos, function (i, element) {
                        var clase = $(element).attr('class').replace("styleInp ", "");
                        switch (clase) {
                            case 'columnas_conditions':
                                var type_column = $('#' + $(element).attr("id") + ' option:selected').attr('data-set').replace(/[^a-z\s]/gi, '');
                                switch (type_column) {
                                    case 'varchar':
                                    case 'text':
                                    case 'int':
                                    case 'bigint':
                                    case 'decimal':
                                    case 'double':
                                        where += $(element).val();
                                        break;

                                    case 'datetime':
                                    case 'timestamp':
                                    case 'date':
                                        where += `DATE_FORMAT(${$(element).val()}, '%Y-%m-%d') `;
                                        break;
                                }

                                break;

                            case 'conditional':
                                var opc_conditional = $(element).val();
                                switch (opc_conditional) {
                                    case 'texto_igual_que':
                                    case 'numero_igual_que':
                                    case 'fecha_gual_que':
                                        where += " = ";
                                        is_like = false;
                                        break;

                                    case 'texto_diferente_que':
                                    case 'numero_diferente_que':
                                    case 'fecha_diferente_que':
                                        where += " != ";
                                        is_like = false;
                                        break;

                                    case 'numero_mayor_que':
                                        where += " > ";
                                        is_like = false;
                                        break;

                                    case 'numero_menor_que':
                                        where += " < ";
                                        is_like = false;
                                        break;

                                    case 'numero_mayor_igual_que':
                                    case 'fecha_desde':
                                        where += " >= ";
                                        is_like = false;
                                        break;

                                    case 'numero_menor_igual_que':
                                    case 'fecha_antes':
                                        where += " <= ";
                                        is_like = false;
                                        break;

                                    case 'fecha_entre':
                                        where += " BETWEEN ";
                                        is_like = false;
                                        break;

                                    case 'texto_que_contenga':
                                        where += " LIKE ";
                                        is_like = true;
                                        break;

                                    case 'texto_que_no_contenga':
                                        where += " NOT LIKE ";
                                        is_like = true;
                                        break;
                                }
                                break;

                            case 'valores':
                                if (is_like) {
                                    where += "'%" + $(element).val() + "%' OR ";
                                } else {
                                    where += "'" + $(element).val() + "' AND ";
                                }
                                break;
                        }
                    });

                    if ($(".isLike").length > 0) {
                        const campos2 = $(".isLike");
                        where += " (";
                        $.each(campos2, function (i, element) {
                            var clase = $(element).attr('class').replace("styleInp ", "").replace(" isLike", "");
                            switch (clase) {
                                case 'columnas_conditions':
                                    where += $(element).val();
                                    break;

                                case 'conditional':
                                    var opc_conditional = $(element).val();
                                    switch (opc_conditional) {
                                        case 'texto_que_contenga':
                                            where += " LIKE ";
                                            break;

                                        case 'texto_que_no_contenga':
                                            where += " NOT LIKE ";
                                            break;
                                    }
                                    break;

                                case 'valores':
                                    where += "'%" + $(element).val() + "%' OR ";
                                    break;
                            }

                        });
                        where = where.substr(0, where.length - 3);
                        where += ")";
                    } else {
                        where = where.substr(0, where.length - 4);
                    }
                }


                query = "SELECT " + columns + " FROM " + schema + "." + table + where;
                console.log(query);

                $('#query').val(query);
                $('#colums').val(columns2);
//            console.log(query);

                $.post(base_url + "Reportes/c_getGenerateReport", {

                    query: query,
                    columns: columns,
                },
                        function (data) {
                            const obj = JSON.parse(data);
//                        console.log(obj);
                            $('#head').html(obj.thead);
                            $('#body').html(obj.tbody);
                            reporte.tblReport = $('#tblReport').DataTable();
                            $('#container').css("display", "block");

                        }
                ).done(function() {
                  $('#tblReport_filter').append('<br><br>')
                  $('#tblReport_length').addClass('report-label')
                  $('#tblReport_filter').addClass('report-label')
                  $('#tblReport_length').children().children().addClass('form-input')
                  $('#tblReport_filter').children().children().addClass('form-input')

                  helper.hideLoading()
                });

            } else {
                $('#columnas, #esquema, #tabla').addClass('err');
                helper.miniAlert('los campos Esquema, Tabla y Columnas no deben estar vacios', 'warning');
                helper.hideLoading();
            }

        },

        exportExcelReport: function () {
            var query = helper.encode($('#query').val());
            var colums = helper.encode($('#colums').val());
            var name_report = helper.encode($('#nombreReporte').val());
            window.open(base_url + "Reportes/excelGenerateReport/" + query + "/" + colums + "/" + name_report, '_blank');
        },

        enableConditions: function () {
            if ($(this).prop('checked')) {
                $('.containerConditions').css("display", "block");
            } else {
                $('.containerConditions').css("display", "none");
            }

        },

        columnasConditions: function (consecutive) {
            reporte.clearSelect('conditional_' + consecutive);
            $('#containerValCondition_' + consecutive).empty();
            var type_column = $('#columnas_conditions_' + consecutive + ' option:selected').attr('data-set').replace(/[^a-z\s]/gi, '');
            var conditional = "";
            switch (type_column) {
                case 'varchar':
                case 'text':
                    conditional = `
                    <option value="texto_igual_que">Igual que</option>
                    <option value="texto_diferente_que">Diferente que</option>
                    <option value="texto_que_contenga">Que contenga</option>
                    <option value="texto_que_no_contenga">Que no contenga</option>
                    `;
                    break;

                case 'datetime':
                case 'timestamp':
                case 'date':
                    conditional = `
                    <option value="fecha_gual_que">De la fecha</option>
                    <option value="fecha_diferente_que">Diferente a la fecha</option>
                    <option value="fecha_desde">Desde la fecha</option>
                    <option value="fecha_antes">Antes de la fecha</option>
                    <option value="fecha_entre">Entre las fechas</option>
                    `;
                    break;

                case 'int':
                case 'bigint':
                case 'decimal':
                case 'double':
                    conditional = `
                    <option value="numero_igual_que">Igual que</option>
                    <option value="numero_diferente_que">Diferente que</option>
                    <option value="numero_mayor_que">Mayor que</option>
                    <option value="numero_menor_que">Menor que</option>
                    <option value="numero_mayor_igual_que">Mayor o igual que</option>
                    <option value="numero_menor_igual_que">Menor o igual que</option>
                    `;
                    break;
            }

            $('#conditional_' + consecutive).append(conditional);
        },

        inputConditional: function (consecutive) {
            $('#containerValCondition_' + consecutive).empty();
            var type_conditional = $('#conditional_' + consecutive).val().split('_');
            var container = "";

            switch (type_conditional[0]) {
                case 'texto':
                case 'numero':
                    container = `
                    <div class="col-md-4 col-body">
                      <div class="form-group">
                        <label class="form-label">Valor: </label>
                        <input type="text" class="styleInp valores form-input required-field" id="valores_${consecutive}">
                      </div>
                    </div>
                    `;
                    break;

                case 'fecha':
                    if (type_conditional[1] == 'entre') {
                        container = `
                        <div class="col-sm-3 form-group">
                            <label>Valor 1</label>
                            <input type="date" class="styleInp valores">
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>Valor 1</label>
                            <input type="date" class="styleInp valores">
                        </div>
                        `;
                    } else {
                        container = `

                        <div class="col-md-4 col-body">
                          <div class="form-group">
                              <label class="form-label">Fecha:</label>
                              <input type="date" class="styleInp valores form-input required-field">
                            </div>
                        </div>
                        `;
                    }

                    break;
            }


            $('#containerValCondition_' + consecutive).append(container);

            var conditional = $('#conditional_' + consecutive).val();
//            $(".isLike").removeClass("isLike");
            if (conditional == 'texto_que_contenga' || conditional == 'texto_que_no_contenga') {
                $('#columnas_conditions_' + consecutive).addClass('isLike');
                $('#conditional_' + consecutive).addClass('isLike');
                $('#valores_' + consecutive).addClass('isLike');
            } else {
                $('#columnas_conditions_' + consecutive).removeClass('isLike');
                $('#conditional_' + consecutive).removeClass('isLike');
                $('#valores_' + consecutive).removeClass('isLike');
            }
      reporte.inputAnimations();
        },

        addConditions: function () {
            var anterior = reporte.consecutivo;
            reporte.consecutivo++;

            var container = `
            <div class="col-sm-12 t-a-c containerConditions panel panel-default" id="containerConditions_${reporte.consecutivo}">

                <div class="col-sm-12 form-group m-t-25">
                    <button class="btn btn-success" style="margin-left: 90%;" ><i class="far fa-plus-square"></i></button>
                    <button class="btn btn-danger" onclick="reporte.removeConditions(${reporte.consecutivo});"><i class="far fa-minus-square"></i></button>
                </div>

                <div class="col-md-4 col-body">
                    <div class="form-group">
                    <label class="form-label" for="columnas_conditions_${reporte.consecutivo}">Columna a condicionar</label>
                    <select id="columnas_conditions_${reporte.consecutivo}" class="styleInp columnas_conditions form-input required-field" onchange="reporte.columnasConditions(${reporte.consecutivo});">
                        <option value="">Seleccione...</option>
                    </select>
                </div>
              </div>

                  <div class="col-md-4 col-body">
                    <div class="form-group">
                      <label class="form-label" for="conditional_${reporte.consecutivo}">Condicionales</label>
                      <select name="" id="conditional_${reporte.consecutivo}" class="styleInp conditional form-input required-field" onchange="reporte.inputConditional(${reporte.consecutivo});">
                        <option value="">Seleccione...</option>
                      </select>
                    </div>
                  </div>

                <div id="containerValCondition_${reporte.consecutivo}"></div>

            </div>
            `;
//            console.log(container);
            $(`#containerConditions_${anterior}`).after(container);
            $('#columnas_conditions_1 option').clone().appendTo(`#columnas_conditions_${reporte.consecutivo}`);
            reporte.inputAnimations();

        },

        removeConditions: function (consecutive) {
            $(`#containerConditions_${consecutive}`).remove();
        }

    }
    reporte.init();

});
