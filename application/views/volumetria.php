<div class="row datesRange">
    <div class="col-sm-3 col-sm-offset-3">
        <label for="fDesde"><b>Fecha Inicio</b></label>
        <input type="date" id="fDesde" value="<?= $f_actual ?>" class="form-control">
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
          <span>FAOC:</span>&nbsp;&nbsp;<span class="badge" id="FAOCBadge">56787</span>
        </th>
        <th colspan="4">
          <span>FAOB:</span>&nbsp;&nbsp;<span class="badge" id="FAOBBadge">56787</span>
        </th>
        <th colspan="4">
          <span>FAPP:</span>&nbsp;&nbsp;<span class="badge" id="FAPPBadge">56787</span>
        </th>
        <th colspan="4">
          <span>FEE:</span> &nbsp;&nbsp;<span class="badge" id="FEEBadge">56787</span>
        </th>
        <th colspan="4">
          <span>FI:</span> &nbsp;&nbsp;<span class="badge" id="FIBadge">56787</span>
        </th>
        <th colspan="4">
          <span>FOIP:</span>&nbsp;&nbsp;<span class="badge" id="FOIPBadge">56787</span>
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
        <span id="T1faoc" class="badge timesT"><i class="fas fa-spinner fa-spin"></i></span>
      </th>
      <th>
        <span id="T2faoc" class="badge timesT">x</span>
      </th>
      <th>
        <span id="T3faoc" class="badge timesT">x</span>
      </th>
      <th>
        <span id="T11faoc" class="badge timesT">x</span>
      </th>
      <th>
        <span id="T1faob" class="badge timesT">x</span>
      </th>
      <th>
        <span id="T2faob" class="badge timesT">x</span>
      </th>
      <th>
        <span id="T3faob" class="badge timesT">x</span>
      </th>
      <th>
        <span id="T11faob" class="badge timesT">x</span>
      </th>
      <th>
        <span id="T1fapp" class="badge timesT">x</span>
      </th>
      <th>
        <span id="T2fapp" class="badge timesT">x</span>
      </th>
      <th>
        <span id="T3fapp" class="badge timesT">x</span>
      </th>
      <th>
        <span id="T11fapp" class="badge timesT">x</span>
      </th>
      <th>
        <span id="T1fee" class="badge timesT">x</span>
      </th>
      <th>
        <span id="T2fee" class="badge timesT">x</span>
      </th>
      <th>
        <span id="T3fee" class="badge timesT">x</span>
      </th>
      <th>
        <span id="T11fee" class="badge timesT">x</span>
      </th>
      <th>
        <span id="T1fi" class="badge timesT">x</span>
      </th>
      <th>
        <span id="T2fi" class="badge timesT">x</span>
      </th>
      <th>
        <span id="T3fi" class="badge timesT">x</span>
      </th>
      <th>
        <span id="T11fi" class="badge timesT">x</span>
      </th>
      <th>
        <span id="T1foip" class="badge timesT">x</span>
      </th>
      <th>
        <span id="T2foip" class="badge timesT">x</span>
      </th>
      <th>
        <span id="T3foip" class="badge timesT">x</span>
      </th>
      <th>
        <span id="T11foip" class="badge timesT">x</span>
      </th>
      </thead>
      <tbody>

      </tbody>
    </table>
  </div>
</div>