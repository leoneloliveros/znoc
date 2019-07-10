<script src="<?= base_url('assets/plugins/moments/moment.min.js'); ?>"></script>
<style>
.valD::placeholder{
  color: black;
  text-align: center;
}

input{
  text-align: center;
}
</style>

<div class="m-content frame" id="exportContent" style=" padding-bottom:50px;">
  <div class="row">
    <form id="forExport" class="" action="<?= base_url('Exports/Reporte')?>" method="post">
    <div class="form-group col-sm-4">
      <h4><p>Tipo de bitácora</p></h4>
      <select id="areaExport" name="opcion" class="form-control getAreas">
        <option value="">Seleccione...</option>
      </select>
    </div>
    <div class="col-sm-1 col-sm-offset-3">
      <div class="checkbox">
        <label><input id="toggleDate" type="checkbox" value="" >Filtro inicio de actividad: </label>
      </div>
    </div>
    <div class="col-sm-2">
      <h4><p>Desde:</p></h4>
      <input type="" id="fechaInicio" class="formu inicio form-control" placeholder="Fecha inicio" name="fechaIni" value="" disabled>
    </div>
    <div class="col-sm-2">
      <h4><p>Hasta:</p></h4>
      <input type="" id="fechaFin" class="formu fin form-control" placeholder="Fecha fin" name="fechaFin" value="" disabled>
    </div>
  </div>
  <br>
  <div id="contenedor_busqueda" class="col-sm-2" style="">
    <button type="submit" id="buscar" class="btn btn-info col-sm-12" >Buscar</button>
  </form>
  </div>
</div>
</div>
