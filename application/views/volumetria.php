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
        <th>T1</th>
        <th>T2</th>
        <th>T3</th>
        <th>T11</th>
        <th>T1</th>
        <th>T2</th>
        <th>T3</th>
        <th>T11</th>
        <th>T1</th>
        <th>T2</th>
        <th>T3</th>
        <th>T11</th>
        <th>T1</th>
        <th>T2</th>
        <th>T3</th>
        <th>T11</th>
        <th>T1</th>
        <th>T2</th>
        <th>T3</th>
        <th>T11</th>
        <th>T1</th>
        <th>T2</th>
        <th>T3</th>
        <th>T11</th>
      </thead>
      <tbody>

      </tbody>
    </table>
  </div>
</div>
<div class="row fontInherit">
    <div class="col-sm-4">
        <label for="">Total Actividades Asiganadas: </label>
        <span class="badge" id="totalAsiganadas" style="padding: 7px 16px;
        font-size: 18px;background: #0aa1d4;">
        
      </span>
    </div>
    <div class="col-sm-4">
        <label for="">Total Actividades Ejecutadas: </label>
        <span class="badge" id="totalActExecuted" style="padding: 7px 16px;
        font-size: 18px;background: #57e057cc;">
        
      </span>
    </div>
    <div class="col-sm-4">
        <label for="">Total Actividades Sin Ejecutar: </label>
        <span class="badge" id="totalActNoExc" style="padding: 7px 16px;
        font-size: 18px; background: #ff4747bf;">
        
      </span>
    </div>
</div>