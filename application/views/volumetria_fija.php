<div class="row datesRange">
    <div class="col-sm-3 col-sm-offset-3">
        <label for="fDesde"><b>Fecha Inicio</b></label>
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

        <table border="1">
            <thead>
            <th colspan="24">NEMÓNICOS: <span class="badge" id="totalNemonicos"></span></th>
            </thead>
            <thead>
            <th colspan="4">
                <span>FOHFC:</span>&nbsp;&nbsp;<span class="badge" id="FOHFCBadge"></span>
            </th>
            <th colspan="4">
                <span>FOIP:</span>&nbsp;&nbsp;<span class="badge" id="FOIPBadge"></span>
            </th>
            <th colspan="4">
                <span>FOINF:</span>&nbsp;&nbsp;<span class="badge" id="FOINFBadge"></span>
            </th>
            <th colspan="4">
                <span>FOTV:</span> &nbsp;&nbsp;<span class="badge" id="FOTVBadge"></span>
            </th>
            <th colspan="4">
                <span>PILOTO TV:</span> &nbsp;&nbsp;<span class="badge" id="PILOTOTVBadge"></span>
            </th>
            <th colspan="4">
                <span>FOSMU:</span>&nbsp;&nbsp;<span class="badge" id="FOSMUBadge"></span>
            </th>
            </thead>
            <thead>
            <th>
                <span>T1</span>
            </th>
            <th>
                <span>T2</span>
            </th>
            <th>
                <span>T3</span>
            </th>
            <th>
                <span>T11</span>
            </th>
            <th>
                <span>T1</span>
            </th>
            <th>
                <span>T2</span>
            </th>
            <th>
                <span>T3</span>
            </th>
            <th>
                <span>T11</span>
            </th>
            <th>
                <span>T1</span>
            </th>
            <th>
                <span>T2</span>
            </th>
            <th>
                <span>T3</span>
            </th>
            <th>
                <span>T11</span>
            </th>
            <th>
                <span>T1</span>
            </th>
            <th>
                <span>T2</span>
            </th>
            <th>
                <span>T3</span>
            </th>
            <th>
                <span>T11</span>
            </th>
            <th>
                <span>T1</span>
            </th>
            <th>
                <span>T2</span>
            </th>
            <th>
                <span>T3</span>
            </th>
            <th>
                <span>T11</span>
            </th>
            <th>
                <span>T1</span>
            </th>
            <th>
                <span>T2</span>
            </th>
            <th>
                <span>T3</span>
            </th>
            <th>
                <span>T11</span>
            </th>
            </thead>
            <thead>
            <th>
                <span id="T1fohfc" class="badge timesT"></span>
            </th>
            <th>
                <span id="T2fohfc" class="badge timesT"></span>
            </th>
            <th>
                <span id="T3fohfc" class="badge timesT"></span>
            </th>
            <th>
                <span id="T11fohfc" class="badge timesT"></span>
            </th>
            <th>
                <span id="T1foip" class="badge timesT"></span>
            </th>
            <th>
                <span id="T2foip" class="badge timesT"></span>
            </th>
            <th>
                <span id="T3foip" class="badge timesT"></span>
            </th>
            <th>
                <span id="T11foip" class="badge timesT"></span>
            </th>
            <th>
                <span id="T1foinf" class="badge timesT"></span>
            </th>
            <th>
                <span id="T2foinf" class="badge timesT"></span>
            </th>
            <th>
                <span id="T3foinf" class="badge timesT"></span>
            </th>
            <th>
                <span id="T11foinf" class="badge timesT"></span>
            </th>
            <th>
                <span id="T1fotv" class="badge timesT"></span>
            </th>
            <th>
                <span id="T2fotv" class="badge timesT"></span>
            </th>
            <th>
                <span id="T3fotv" class="badge timesT"></span>
            </th>
            <th>
                <span id="T11fotv" class="badge timesT"></span>
            </th>
            <th>
                <span id="T1pilototv" class="badge timesT"></span>
            </th>
            <th>
                <span id="T2pilototv" class="badge timesT"></span>
            </th>
            <th>
                <span id="T3pilototv" class="badge timesT"></span>
            </th>
            <th>
                <span id="T11pilototv" class="badge timesT"></span>
            </th>
            <th>
                <span id="T1fosmu" class="badge timesT"></span>
            </th>
            <th>
                <span id="T2fosmu" class="badge timesT"></span>
            </th>
            <th>
                <span id="T3fosmu" class="badge timesT"></span>
            </th>
            <th>
                <span id="T11fosmu" class="badge timesT"></span>
            </th>
            </thead>
            <tbody>

            </tbody>
        </table>
        <div class="row">
            <div class="col-sm-12">
                <button id="excelVol" class="exportExcel"><i class="far fa-file-excel"></i> Generar Excel</button>
            </div>
        </div>
    </div>
</div>