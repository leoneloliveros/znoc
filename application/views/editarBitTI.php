<div class="main-title">
  Editar Bitácora Turno Integral
</div>
<div class="card-style">
  <div class="general frame">

    <div class="">
      <input id="id_bitacora" type="hidden" post-datos="id" name="id_bitacora" value="<?= $info[0]->id;?>">
    </div>

<!-- <?php var_dump($info); ?> -->
    <div class="col-md-4 col-body">
      <div class="form-group">
        <label class="form-label" for="ingeniero">Ingeniero</label>
        <input type="text" post-data = "ingeniero" post-datos = "ingeniero" class="form-control form-input required-field act" value="<?php echo $this->session->userdata('name'); ?>" id="ingeniero" readonly>
      </div>
    </div>

    <div class="col-md-4 col-body">
      <div class="form-group">
        <label class="form-label" for="fechaInicio2">Fecha y Hora Inicio</label>
        <input type="text" post-datos = "fecha_hora_solicitud" class="form-control form-input required-field act" id="fechaInicio2" value="<?= $info[0]->fecha_hora_solicitud;?>">
      </div>
    </div>

    <div class="col-md-4 col-body ">
      <div class="form-group">
        <label class="form-label" for="solicitante">Solicitante</label>
        <input list="solicitantes"  post-datos = "solicitante"  id="solicitante" class="form-control  form-input required-field" type="text"  value="<?=$info[0]->solicitante?>">
          <datalist id="solicitantes">
            <option value=""></option>
            <option value="HERNANDO ARGUMERO"></option>
            <option value="FRAY ARIAS"></option>
            <option value="DIEGO PUENTES"></option>
            <option value="OSCAR BARRERA"></option>
            <option value="JULIAN GIRONZA"></option>
            <option value="JUAN PABLO LANCHEROS"></option>
            <option value="OTRO: Escriba cual..."></option>
          </datalist>
      </div>
    </div>

    <div class="col-md-4 col-body">
      <div class="form-group">
        <label class="form-label" for="incidente2">Incidente</label>
        <input type="text" post-datos = "incidente"  class="form-control  form-input required-field act" id="incidente2" value="<?=$info[0]->incidente?>">
      </div>
    </div>

    <div class="col-md-4 col-body">
      <div class="form-group">
        <label class="form-label" for="medio">Medio</label>
        <select  id="medio" post-datos = "medio"  class="form-control  form-input required-field">
          <option value="<?= $info[0]->medio ?>"selected><?= $info[0]->medio ?></option>
          <option value="chat">CHAT</option>
          <option value="correo">CORREO</option>
          <option value="llamada">LLAMADA</option>
        </select>
      </div>
    </div>

    <div class="col-md-4 col-body">
      <div class="form-group">
        <label class="form-label"for="tipificacion">Tipificación</label>
        <input list="tipificaciones" post-datos = "tipificacion"  id="tipificacion" class="form-control  form-input required-field" type="text" value="<?= $info[0]->tipificacion?>">
          <datalist id="tipificaciones">
            <option value=""></option>
            <option value="Apertura de TK"></option>
            <option value="Revisión de elemento de red"></option>
            <option value="Reclamación"></option>
            <option value="Seguimiento"></option>
            <option value="Revisión de zona"></option>
            <option value="OTRO: Escriba cual..."></option>
          </datalist>
      </div>
    </div>

    <!-- <div class="col-md-4 col-body">
      <div class="form-group">
        <label class="form-label" for="turno2">Turno</label>
        <select  id="turno2" post-datos = "turno"  class="form-control form-input required-field">
          <option value="<?= $info[0]->turno?>" selected><?= $info[0]->turno?></option>
          <option value="T1">T1</option>
          <option value="T2">T2</option>
          <option value="T3">T3</option>
          <option value="T4">T4</option>
          <option value="T5">T5</option>
        </select>
      </div>
    </div> -->

    <div class="col-md-4 col-body">
      <div class="form-group">
        <label class="form-label" for="nemonico2">Nemonico</label>
        <select  id="nemonico2" post-datos = "nemonicon"  class="form-control  form-input required-field">
          <option value="<?= $info[0]->nemonicon?>" selected><?= $info[0]->nemonicon?></option>
          <option value="MC_AICT5">MC_AICT5</option>
          <option value="MC_GORGT4">MC_GORGT4</option>
          <option value="MC_GPT5">MC_GPT5</option>
          <option value="MC_RPT1">MC_RPT1</option>
          <option value="MC_RPT2">MC_RPT2</option>
          <option value="MC_RPT3">MC_RPT3</option>
          <option value="MC_T&PT1">MC_T&PT1</option>
          <option value="MC_T&PT2">MC_T&PT2</option>
          <option value="MC_T&P_SOCT1">MC_T&P_SOCT1</option>
          <option value="MC_T&P_SOCT2">MC_T&P_SOCT2</option>
          <option value="MC_T&P_SOCT3">MC_T&P_SOCT3</option>
        </select>
      </div>
    </div>

    <div class="col-md-4 col-body ">
      <div class="form-group">
        <label class="form-label" for="fechaRespuesta">Fecha y Hora Respuesta</label>
        <input type="text" post-datos = "fecha_hora_respuesta"  class="form-control form-input required-field act" id="fechaRespuesta" value="<?= $info[0]->fecha_hora_respuesta?>">
      </div>
    </div>

    <div class="col-md-4 col-body ">
      <div class="form-group">
        <label class="form-label" for="tiempoRespuesta">Tiempo de Respuesta</label>
        <input type="text" post-datos = "tiempo_respuesta"  class="form-control form-input required-field act" id="tiempoRespuesta" value="<?= $info[0]->tiempo_respuesta?>">
      </div>
    </div>

    <div class="col-md-4 col-body ">
      <div class="form-group">
        <label class="form-label" for="observaciones2">Observaciones</label>
        <textarea class="form-control form-input required-field" post-datos = "observaciones"  id="observaciones2" rows="1"><?= $info[0]->observaciones?></textarea>
      </div>
    </div>

    <div class="col-md-4 col-body ">
      <div class="form-group">
        <label class="form-label" for="resumenSolicitud">Resumen de solicitud</label>
        <textarea class="form-control form-input required-field" post-datos = "resumen_solicitud"  id="resumenSolicitud" rows="1"><?= $info[0]->resumen_solicitud?></textarea>
      </div>
    </div>

    <div class="col-md-12 col-body">
      <div class="wrap" style="margin: auto;">
        <button class="btnx" id="EditBitTurnoIntegral">Actualizar Bitacora T.I-S</button>
        <img src="https://www.dropbox.com/s/qfu4871umzhlcfo/check_arrow_2.svg?dl=1" alt="">
        <svg width="66px" height="66px">
          <circle class="circle_2" stroke-position="outside" stroke-width="3" fill="none" cx="34" cy="33" r="29" stroke="#1ECD97"></circle>
        </svg>
      </div>
    </div>

  </div>
</div>
