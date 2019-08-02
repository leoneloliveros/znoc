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

        loadColumnByTable: function () {
            helper.showLoading();
            reporte.clearSelect('columnas');
            reporte.clearSelect('columnas_conditions');

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
            if (reporte.tblReport) {
                var tabla = reporte.tblReport;
                tabla.destroy();
            }

            var columns = $('#columnas').val();
            var schema = $('#esquema').val();
            var table = $('#tabla').val();
            var query = "";

            if (columns != '' && schema != '' && table != '') {
                $('#columnas, #esquema, #tabla').removeClass("err");
                helper.showLoading();
                var columns2 = columns.toString();
                query = "SELECT " + columns + " FROM " + schema + "." + table + " limit 1000";

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
                );

                helper.hideLoading();
            } else {
                $('#columnas, #esquema, #tabla').addClass('err');
                helper.miniAlert('los campos Esquema, Tabla y Columnas no deben estar vacios', 'warning');
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
                    <div class="col-sm-4 form-group">
                        <label>Valor</label>
                        <input type="text" class="styleInp valores">
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
                        <div class="col-sm-6 form-group">
                            <label>Valor</label>
                            <input type="date" class="styleInp valores">
                        </div>
                        `;
                    }

                    break;
            }

            $('#containerValCondition_' + consecutive).append(container);
        },

        addConditions: function () {
            var anterior = reporte.consecutivo;
            reporte.consecutivo++;

            var container = `
            <div class="col-sm-12 t-a-c containerConditions panel panel-default" id="containerConditions_${reporte.consecutivo}">
                <div class="col-sm-12 form-group m-t-25">
                    <button class="btn btn-success" style="margin-left: 90%;" onclick="reporte.addConditions();"><i class="far fa-plus-square"></i></button>
                    <button class="btn btn-danger" onclick="reporte.removeConditions(${reporte.consecutivo});"><i class="far fa-minus-square"></i></button>
                </div>
                <div class="col-sm-3 form-group">
                    <label for="columnas_conditions_${reporte.consecutivo}">Columna a condicionar</label>
                    <select id="columnas_conditions_${reporte.consecutivo}" class="styleInp" onchange="reporte.columnasConditions(${reporte.consecutivo});">
                        <option value="">Seleccione...</option>
                    </select>
                </div>
                <div class="col-sm-3 form-group">
                    <label for="conditional_${reporte.consecutivo}">Condicionales</label>
                    <select name="" id="conditional_${reporte.consecutivo}" class="styleInp" onchange="reporte.inputConditional(${reporte.consecutivo});">
                        <option value="">Seleccione...</option>
                    </select>
                </div>
                <div id="containerValCondition_${reporte.consecutivo}">

                </div>
            </div>
            `;
//            console.log(container);
            $(`#containerConditions_${anterior}`).after(container);
            $('#columnas_conditions_1 option').clone().appendTo(`#columnas_conditions_${reporte.consecutivo}`);
        },

        removeConditions: function (consecutive) {
            $(`#containerConditions_${consecutive}`).remove();
        }

    }
    reporte.init();
});