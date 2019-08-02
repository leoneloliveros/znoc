<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<div class="row frame">
    <div class="col-sm-12 t-a-c">
        <div class="col-sm-4 form-group">
            <label for="esquema">Nombre del Reporte</label>
            <input type="text" class="styleInp" id="nombreReporte">
        </div>
    </div>
    <div class="col-sm-12 t-a-c">
        <div class="col-sm-4 form-group">
            <label for="esquema">Esquema</label>
            <select name="" id="esquema" class="styleInp">
                <option value="">Seleccione...</option>
                <option value="reportes">reportes</option>
                <option value="maximo">maximo</option>
            </select>
        </div>
        <div class="col-sm-4 form-group">
            <label for="tabla">Tabla</label>
            <select name="" id="tabla" class="styleInp">
                <option value="">Seleccione...</option>
            </select>
        </div>
        <div class="col-sm-4 form-group">
            <label for="columnas" style="width: 100%;">Columnas</label>
            <select id="columnas" class="styleInp" multiple="multiple">
                <!--<option value="">Seleccione...</option>-->
            </select>
            <input type="hidden" class="styleInp" id="query">
            <input type="hidden" class="styleInp" id="colums">
        </div>
    </div>
    <div class="col-sm-12 t-a-c">
        <div class="col-sm-4 form-group">
            <div class="checkbox">
                <label>
                    <input type="checkbox" data-toggle="toggle" id="enable_conditions" data-on="Si" data-off="No">
                    Agregar condiciones?
                </label>
            </div>
        </div>
    </div>
    <div class="col-sm-12 t-a-c containerConditions panel panel-default" id="containerConditions_1" style="display: none;">
        <div class="col-sm-12 form-group m-t-25">
            <button class="btn btn-success" style="margin-left: 98%;" onclick="reporte.addConditions();"><i class="far fa-plus-square"></i></button>
        </div>
        <div class="col-sm-3 form-group">
            <label for="columnas_conditions_1">Columna a condicionar</label>
            <select id="columnas_conditions_1" class="styleInp" onchange="reporte.columnasConditions(1);">
                <option value="">Seleccione...</option>
            </select>
        </div>
        <div class="col-sm-3 form-group">
            <label for="conditional_1">Condicionales</label>
            <select name="" id="conditional_1" class="styleInp" onchange="reporte.inputConditional(1);">
                <option value="">Seleccione...</option>
            </select>
        </div>
        <div id="containerValCondition_1">
            
        </div>
    </div>

    <div class="col-sm-12 t-a-c">
        <button class="btnx" id="generateReport">Generar Reporte</button>
    </div>
</div>

<div class="row m-t-20">
    <div class="col-sm-12" id="container" style="display: none;">
        <table border="1" id="tblReport">
            <thead id="head">
            <thead>
            <tbody id="body">
            </tbody>
        </table>
        <div class="row">
            <div class="col-sm-12">
                <button id="exportExcel" class="exportExcel"><i class="far fa-file-excel"></i> Generar Excel</button>
            </div>
        </div>
    </div>
</div>