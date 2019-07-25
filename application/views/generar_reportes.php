<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
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