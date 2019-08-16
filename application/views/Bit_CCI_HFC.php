<div class="main-title">
  CCI Y HFC
</div>

<div class="card-style">
<div class="general frame">


      <div class="col-md-4 col-body">
        <div class="form-group">
          <label class="form-label" for="">Tipo Bitacora</label>
          <select class="styleInp form-input required-field" id="typeBinnacle">
            <option value=""></option>
            <option value="CCI">CCI</option>
            <option value="HFC">HFC</option>
          </select>
        </div>
      </div>

      <div class="col-md-4 col-body">
        <div class="form-group">
        <label class="form-label" for="">Prioridad</label>
          <select class="styleInp form-input required-field" id="typeP">
            <option value=""></option>
            <option value="P1">P1</option>
            <option value="P2">P2</option>
            <option value="P3">P3</option>
          </select>
        </div>
      </div>

      <div class="col-md-4 col-body">
        <div class="form-group">
        <label class="form-label" for="incident">INCIDENTE</label>
          <input type="text" class="styleInp form-input required-field" id="incident">
          <input type="hidden" id="iniAct">
          <input type="hidden" id="finAct">
        </div>
      </div>



      <div class="col-md-4 col-body">
       <div class="form-group">
        <label class="form-label" for="">INGENIERO</label>
          <select class="styleInp form-input required-field" id="engineer">
            <option value=""> </option>
          </select>
       </div>
      </div>


      <div class="col-md-4 col-body">
       <div class="form-group">
        <label class="form-label" for="">FECHA INICIO</label>
          <input class="styleInp form-input required-field" type="input" id="beginDate">
       </div>
      </div>


      <div class="col-md-4 col-body">
        <div class="form-group">
          <label class="form-label" for="">FECHA FINAL</label>
            <input type="input" class="styleInp form-input required-field" id="endDate">
        </div>
      </div>


      <div class="col-md-4 col-body">
        <div class="form-group">
        <label class="form-label" for="">ESTADO DEL INC</label>
          <select class="styleInp form-input required-field" id="INCStatus">
            <option value="">Seleccione...</option>
            <option value="ABIERTO">ABIERTO</option>
            <option value="ASIGNADO">ASIGNADO</option>
            <option value="EN PROCESO">EN PROCESO</option>
            <option value="PENDIENTE">PENDIENTE</option>
            <option value="RESUELTO">RESUELTO</option>
            <option value="CERRADO">CERRADO</option>
            <option value="CANCELADO">CANCELADO</option>
          </select>
        </div>
      </div>

      <div class="col-md-4 col-body">
        <div class="form-group">
        <label class="form-label" for="">ACTIVIDAD</label>
          <select class="styleInp form-input required-field" id="activity">
            <option value=""></option>
            <option value="APERTURA INC FRONT">APERTURA INC FRONT</option>
            <option value="CREACIÓN DE TAS (BO HFC)">CREACIÓN DE TAS (BO HFC)</option>
            <option value="VALIDACIÓN">VALIDACIÓN</option>
            <option value="REASIGNACIÓN (SOLO FRONT)">REASIGNACIÓN (SOLO FRONT)</option>
            <option value="CONTROL CALIDAD">CONTROL CALIDAD</option>
            <option value="CREACIÓN DE OT">CREACIÓN DE OT</option>
            <option value="QC CREADA">QC CREADA</option>
            <option value="FALLA EN CONTROL DE CALIDAD POR CGE">FALLA EN CONTROL DE CALIDAD POR CGE</option>
            <option value="YA GESTIONADO">YA GESTIONADO</option>
          </select>
        </div>
      </div>



      <div class="col-md-4 col-body">
        <div class="form-group">
          <label for="" class="form-label">OT CERRADA SIN CAUSAS DE CIERRE</label>
          <input type="text" class="styleInp form-input required-field" id="OTCCC">
            <!-- <textarea class="styleInp" id="OTCCC" cols="30" rows="5"></textarea> -->
        </div>
      </div>





      <div class="col-12 col-body">
        <table  border="1" style="margin-top: 5%; width: 100%;">


            <div class="col-md-4 col-body position-relative form-group">
              <label class="switch">
                <input type="checkbox" name="" id="flowErr" class="form-check-input">
                <span class="slider round"></span>
              </label>
              <span class="checkbox-initial">
                ERROR DE FLUJO
                </span>
            </div>


            <div class="col-md-4 col-body position-relative form-group">
              <label class="switch">
                <input type="checkbox" name="" id="ErrWfm" class="form-check-input">
                <span class="slider round"></span>
              </label>
              <span class="checkbox-initial">
                ERROR  DE WFM
                </span>
            </div>


            <div class="col-md-4 col-body position-relative form-group">
              <label class="switch">
                <input type="checkbox" name="" id="tqnExit" class="form-check-input">
                <span class="slider round"></span>
              </label>
              <span class="checkbox-initial">
                TAS QC NO EXITOSO
              </span>
            </div>


            <div class="col-md-4 col-body position-relative form-group">
              <label class="switch">
                <input type="checkbox" name="" id="pymes" class="form-check-input">
                <span class="slider round"></span>
              </label>
              <span class="checkbox-initial">
                PYMES
              </span>
            </div>


            <div class="col-md-4 col-body position-relative form-group">
              <label class="switch">
                <input type="checkbox" name="" id="MC" class="form-check-input">
                <span class="slider round"></span>
              </label>
              <span class="checkbox-initial">
                MAL CATEGORIZADOS
              </span>
            </div>

          </table>
      </div>

      <div class="col-md-4 col-body">
        <div class="form-group">
        <label class="form-label" for="">OBSERVACIÓN</label>
          <textarea class="styleInp form-input required-field" id="obs" cols="30" rows="5"></textarea>
        </div>
      </div>


        <div class="col-md-4 col-body">
          <div class="wrap" style="margin: auto;">
          <button class="btnx"  id="newLogBook">Guardar</button>
          <img src="https://www.dropbox.com/s/qfu4871umzhlcfo/check_arrow_2.svg?dl=1" alt="">
          <svg width="66px" height="66px">
            <circle class="circle_2" stroke-position="outside" stroke-width="3" fill="none" cx="34" cy="33" r="29" stroke="#1ECD97"></circle>
          </svg>
         </div>
        </div>

</div>
</div>
<script src="<?= base_url("assets/plugins/sweetalert2/sweetalert2.all.js") ?>"></script>
