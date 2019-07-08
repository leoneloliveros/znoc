<div class="row datesRange">
    <div class="col-sm-3 col-sm-offset-3">
        <label for="fDesde"><b>Fecha Inicio</b></label>
        <!--<input type="date" id="fDesde" value="<?= $f_inicio ?>" class="form-control">-->
        <input type="date" id="fDesde" value="<?= $f_inicio ?>" class="form-control">
    </div>
    <div class="col-sm-3">
        <label for="fHasta"><b>Fecha Fin</b></label>
        <input type="date" id="fHasta" value="<?= $f_actual ?>" class="form-control">
    </div>

    <div class="col-sm-12" style="margin-top:1em;">
        <button id="newDate" class="btn-cami_cool">Buscar</button>
    </div>
</div>

<div class="row">
  <div class="col-sm-12">

    <table border="1" id="table_slas" class="table">
    </table>
  </div>
</div>
<div id="grafica_r" style="width: 800px;">
</div>
