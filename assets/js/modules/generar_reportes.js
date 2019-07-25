$(function () {
    reporte = {
        init: function () {
            reporte.events();
        },

        events: function () {
            $('#generateReport').click(reporte.generateReport);
            $('#esquema').change(reporte.loadTablesBySchema);
            $('#tabla').change(reporte.loadColumnByTable);
            $('#columnas').multiselect({
                includeSelectAllOption: true,
            });
            $('#exportExcel').click(reporte.exportExcelReport);
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
        },
        
        exportExcelReport: function () {
            var query = helper.encode($('#query').val());
            var colums = helper.encode($('#colums').val());
            var name_report = $('#nombreReporte').val();
            window.open(base_url + "Reportes/excelGenerateReport/" + query + "/" + colums + "/" + name_report, '_blank');
        },

    }
    reporte.init();
});