<script src="<?= base_url('assets\js\styles-for-generate-report.js'); ?>"></script>
<link rel="stylesheet" href="<?= base_url('assets\css\styles-for-generate-report.css'); ?>">


<div class="main-title">
Generar Reporte
</div>

<style>
.valD::placeholder{
  color: black;
  text-align: center;
}

input{
  text-align: center;
}
.swal2-popup{
    margin: 8% 25%!important;
}
</style>


<div class="card-style">
<div class="general frame">

    <div class="col-md-4 col-body">
        <div class="form-group">
          <label class="form-label" for="esquema">Nombre del Reporte</label>
          <input type="text" class="styleInp form-input required-field" id="nombreReporte">
        </div>
    </div>

        <div class="col-md-4 col-body">
          <div class="form-group">
            <label class="form-label" for="esquema">Esquema</label>
            <select name="" id="esquema" class="styleInp form-input required-field">
              <option value=""></option>
              <option value="reportes">reportes</option>
              <option value="maximo">maximo</option>
            </select>
          </div>
        </div>

        <div class="col-md-4 col-body style-report-table">
          <div class="form-group">
            <label class="form-label" for="tabla">Tabla</label>
            <select name="" id="tabla" class="styleInp form-input required-field">
              <option value=""></option>
            </select>
          </div>
        </div>

        <div class="col-md-4 col-body">
          <div class="form-group">
            <label class=" report-label" for="columnas">Columnas</label>
            <select  class="styleInp" id="columnas" multiple="multiple">
                <!--<option value="">Seleccione...</option>-->
            </select>
            <input type="hidden" class="styleInp" id="query">
            <input type="hidden" class="styleInp" id="colums">
          </div>
        </div>


        <div class="col-md-4 col-body position-relative form-group">
          <label class="switch">
            <input type="checkbox"  id="enable_conditions" class="form-check-input">
            <span class="slider round"></span>
            </label>
            <span class="checkbox-initial  report-label">
              Agregar condiciones?
                </span>
                  </div>


        <div class="col-md-4 form-group" style="margin-top: -40px;">
          <div class="wrap" style="margin: center;">
            <button class="btnx" id="generateReport">Generar Reporte</button>
            <img src="https://www.dropbox.com/s/qfu4871umzhlcfo/check_arrow_2.svg?dl=1" alt="">
            <svg width="66px" height="66px">
              <circle class="circle_2" stroke-position="outside" stroke-width="3" fill="none" cx="34" cy="33" r="29" stroke="#1ECD97"></circle>
            </svg>
          </div>
        </div>


    <div class="col-sm-12 t-a-c containerConditions panel panel-default" id="containerConditions_1" style="display: none;">

        <div class="col-sm-12 form-group m-t-25">
            <button class="btn btn-success" style="margin-left: 98%;" onclick="reporte.addConditions();"><i class="far fa-plus-square"></i></button>
        </div>

        <div class="col-md-4 col-body">
          <div class="form-group">
            <label class="form-label" for="columnas_conditions_1">Columna a condicionar</label>
            <select id="columnas_conditions_1" class="styleInp columnas_conditions form-input required-field" onchange="reporte.columnasConditions(1);">
                <option value="">Seleccione...</option>
            </select>
          </div>
        </div>

        <div class="col-md-4 col-body">
          <div class="form-group">
            <label class="form-label" for="conditional_1">Condicionales</label>
            <select name="" id="conditional_1" class="styleInp conditional form-input required-field" onchange="reporte.inputConditional(1);">
                <option value="">Seleccione...</option>
            </select>
          </div>
        </div>

        <div id="containerValCondition_1" ></div>
    </div>



    <div class="col-md-12 col-body">
      <hr>
        <div class="col-sm-12" id="container" style="display: none;">
          <center>
            <table border="1" id="tblReport" style="border-radius:10px;">

                <thead id="head">
                </thead>
                <tbody id="body">
                </tbody>
            </table>
          </center>

            <div class="col-md-12 col-body">
              <div class="wrap" style="margin: auto;">
                <button id="exportExcel" class="btnx" class="exportExcel"><i class="far fa-file-excel"></i> Generar Excel</button>
                <img src="https://www.dropbox.com/s/qfu4871umzhlcfo/check_arrow_2.svg?dl=1" alt="">
                  <svg width="66px" height="66px">
                    <circle class="circle_2" stroke-position="outside" stroke-width="3" fill="none" cx="34" cy="33" r="29" stroke="#1ECD97"></circle>
                  </svg>
              </div>
            </div>

        </div>
    </div>


</div>
</div>

<!-- <script>

var activarboton = false;
$('#generateReport').on('click', function(){
     activarboton  = ( activarboton == true) ? false : true ;
    if ( activarboton == true) {
        $('#generateReport').parent().attr('style', 'display: none;');
    } else {
        $('#generateReport').parent().attr('style', 'display:  block;');
    };
});


</script> -->
