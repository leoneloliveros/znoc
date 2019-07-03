<div class="row datesRange">
    <div class="col-sm-3 col-sm-offset-3">
        <label for="fDesde"><b>Fecha Inicio</b></label>
        <input type="date" id="fDesde" value="<?= $f_actual ?>" class="form-control">
    </div>
    <div class="col-sm-3">
        <label for="fHasta"><b>Fecha Fin</b></label>
        <input type="date" id="fHasta" value="<?= $f_actual ?>" class="form-control">
    </div>
    <div class="row col-sm-12" style="display: flex; justify-content: center;">
        <div class="col-sm-6">
            <label for="fHasta"><b>Reporte</b></label>
            <select class="form-control" name="" id="selection">
                <option value="0">Workinfo</option>
                <option value="1">Alarmas</option>
                <option value="2">Incidentes Fija</option>
                <option value="3">Tiempos NOC</option>
                <option value="4">Tiempos Fija</option>
            </select>
           
        </div>
    </div>

    <div class="col-sm-12" style="margin-top:1em;">
        <button id="reportButton" class="btn-cami_cool">Descargar</button>
    </div>
</div>

<script type="text/javascript" src="<?= base_url('assets/js/modules/generalReport.js'); ?>"></script>


