<script src="<?= base_url('assets/plugins/moments/moment.min.js'); ?>"></script>

<div class="main-title">
Consultar Bitacoras (Front Office)
</div>

<style>
.valD::placeholder{
color: black;
text-align: center;
}

input{
text-align: center;
}
</style>


<div style="display:flex; justify-content: center;">
<div class="card-style w-60">
  <div class="general">

    <div class="m-content frame" id="exportContent" style=" padding-bottom:50px;">

      <div class="row">

        <form id="" class="" action="<?= base_url('Exports/Reporte')?>" method="post">

          <div class="col-md-6 position-relative switch-container ">
            <div class="form-group">
              <label class="form-label"> Tipo de bitácora</label>
              <select id="areaExport" name="opcion" class="form-control getAreas form-input required-field">
                <option value="">Seleccione...</option>
              </select>
            </div>
          </div>


          <div class="switch-container col-md-4 position-relative form-group">
            <label class="switch">
              <input id="toggleDate" class="checkbox  form-check-input" type="checkbox" value="" >
              <span class="slider round"></span>
            </label>
            <span class="checkbox-initial">
              Filtro inicio de actividad:
            </span>
          </div>


          <div class="col-md-6 col-body">
            <div class="form-group">
              <label class="form-label">Desde:</label>
              <input type="" id="fechaInicio" class="formu inicio form-control form-input required-field" placeholder="Fecha inicio" name="fechaIni" value="" disabled>
            </div>
          </div>

          <div class="col-md-6 col-body">
            <div class="form-group">
              <label class="form-label">Hasta:</label>
              <input type="" id="fechaFin" class="formu fin form-control form-input required-field" placeholder="Fecha fin" name="fechaFin" value="" disabled>
            </div>
          </div>

          <div class="col-md-12 col-body">
            <div class="wrap" style="margin: auto;">
              <button type="submit" id="buscar" class="btnx" >Buscar</button>
              <div id="contenedor_busqueda">
                <img src="https://www.dropbox.com/s/qfu4871umzhlcfo/check_arrow_2.svg?dl=1">
                <svg width="66px" height="66px">
                  <circle class="circle_2" stroke-position="outside" stroke-width="3" fill="none" cx="34" cy="33" r="29" stroke="#1ECD97"></circle>
                </svg>
              </div>
            </div>
          </div>

        </form>
      </div>
    </div>


  </div>
</div>
</div>
