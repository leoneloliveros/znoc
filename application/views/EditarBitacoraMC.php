<div class="main-title">
  Editar Bitácora Mesa De Calidad
</div>
<div class="card-style">
  <div class="general frame">

      <div class="col-md-4 col-body">
        <div class="form-group">
          <label class="form-label">Ingeniero</label>
          <input type="text" post-data = "ingeniero" post-datos = "ingeniero" class="form-control form-input required-field act" value="<?php echo $this->session->userdata('name'); ?>" id="ingeniero" readonly>
        </div>
      </div>

    <div class="generalForm" id="generalForm">

        <div class="col-md-4 col-body">
          <div class="form-group">
            <label class="form-label">Fecha y Hora Inicio</label>
            <input type="text" post-data = "fecha_hora_inicio" class="form-control form-input required-field act" id="fechaInicio">
          </div>
        </div>

      <div class="col-md-4 col-body">
          <div class="form-group">
            <label class="form-label">Fecha y Hora Fin</label>
            <input type="text" post-data = "fecha_hora_fin" class="form-control form-input required-field act" id="fechaFin">
          </div>
        </div>

        <div class="col-md-4 col-body">
          <div class="form-group">
            <label class="form-label">Duracion</label>
            <input type="text" post-data = "duracion" class="form-control form-input required-field act" id="duracion">
          </div>
        </div>

        <div class="col-md-4 col-body">
          <div class="form-group">
            <label class="form-label">Semana</label>
            <input type="text" post-data = "semana" class="form-control form-input required-field act" id="semana">
          </div>
        </div>

        <div class="col-md-4 col-body">
          <div class="form-group">
            <label class="form-label">Actividad</label>
            <select  id="actividad" post-data = "actividad" class="form-control form-input required-field">
              <option value=""></option>
              <option value="GESTION T&P">GESTION T&P</option>
              <option value="REPORTES">REPORTES</option>
              <option value="OFENSORES">OFENSORES</option>
              <option value="GESTION PROBLEMAS">GESTION PROBLEMAS</option>
              <option value="CONTROL DE CALIDAD">CONTROL DE CALIDAD</option>
              <option value="TURNO INTEGRAL">TURNO INTEGRAL</option>
            </select>
          </div>
        </div>

        <div class="col-md-4 col-body" id="Nreport" hidden>
          <div class="form-group">
            <label class="form-label">Nombre del Reporte</label>
            <input type="text" post-data = "nombre_reporte" class="form-control form-input" id="NombreDelReporte">
          </div>
        </div>

        <div class="col-md-4 col-body">
          <div class="form-group">
            <label class="form-label">Turno</label>
            <select  id="turno" post-data = "turno" class="form-control form-input required-field">
              <option value=""></option>
              <option value="T1">T1</option>
              <option value="T2">T2</option>
              <option value="T3">T3</option>
              <option value="T4">T4</option>
              <option value="T5">T5</option>
            </select>
          </div>
        </div>

        <div class="col-md-4 col-body">
          <div class="form-group">
            <label class="form-label">Nemonico</label>
            <select  id="nemonico" post-data = "nemonico" class="form-control  form-input required-field">
              <option value=""></option>
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

        <div class="col-md-4 col-body remove">
          <div class="form-group">
            <label class="form-label">ID Alarma</label>
            <input type="text" post-data = "id_alarma" class="form-control  form-input required-field act" id="idAlarma">
          </div>
        </div>

        <div class="col-md-4 col-body">
          <div class="form-group">
            <label class="form-label">Incidente</label>
            <input list="incidents" type="text" post-data = "incidente" class="form-control  form-input required-field act" id="incidente">
            <datalist id="incidents">
              <option value=""></option>
              <option value="N.A"></option>
            </datalist>
          </div>
        </div>


        <div class="col-md-4 col-body remove removeR">
          <div class="form-group">
            <label class="form-label">Tarea</label>
            <input list="tareas" type="text" post-data = "tarea" class="form-control form-input required-field act" id="tarea">
            <datalist id="tareas">
              <option value=""></option>
              <option value="N.A"></option>
            </datalist>
          </div>
        </div>

        <div class="col-md-4 col-body removeR">
          <div class="form-group">
            <label class="form-label">Tk Creado</label>
            <input list="tksCreados" type="text" post-data = "tk_creado" class="form-control  form-input required-field act" id="tkcreado">
            <datalist id="tksCreados">
              <option value=""></option>
              <option value="N.A"></option>
            </datalist>
          </div>
        </div>

        <div class="col-md-4 col-body remove removeR">
          <div class="form-group">
            <label class="form-label">Falla Masiva</label>
            <select  id="fmasiva" post-data = "falla_masiva" class="form-control  form-input required-field">
              <option value=""></option>
              <option value="SI">SI</option>
              <option value="NO">NO</option>
              <option value="N.A">N.A</option>
            </select>
          </div>
        </div>

        <div class="col-md-4 col-body remove removeR">
          <div class="form-group">
            <label class="form-label">Cusal De Cierre</label>
            <select  id="causalCierre" post-data = "causal_de_cierre" class="form-control  form-input required-field">
              <option value=""></option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
              <option value="N.A">N.A</option>
            </select>
          </div>
        </div>

        <div class="col-md-4 col-body ">
          <div class="form-group">
            <label class="form-label">Estado</label>
            <input list="esatdos" post-data = "estado" id="estado" class="form-control  form-input required-field" type="text">
              <datalist id="esatdos">
                <option value=""></option>
                <option value="Escalado a campo"></option>
                <option value="Escalado a BO"></option>
                <option value="Cierre"></option>
                <option value="OTRO: Escriba cual..."></option>
              </datalist>
          </div>
        </div>

        <div class="col-md-4 col-body remove removeR">
          <div class="form-group">
            <label class="form-label">Degradacion por Packet Abis</label>
            <select  id="degradacionAbis" post-data = "degradacion_por_packet_abis" class="form-control form-input required-field">
              <option value=""></option>
              <option value="Si">Si</option>
              <option value="No">No</option>
            </select>
          </div>
        </div>

        <div class="col-md-4 col-body ">
          <div class="form-group">
            <label class="form-label">Observaciones</label>
            <textarea class="form-control form-input" post-data = "obaservaciones" id="observaciones" rows="1"></textarea>
          </div>
        </div>

        <div class="col-md-4 col-body" id="active" hidden>
          <div class="form-group">
            <label class="form-label">Resumen</label>
            <textarea class="form-control form-input" post-data = "resumen" id="resumen" rows="1"></textarea>
          </div>
        </div>


        <div class="col-md-12 col-body">
          <div class="wrap" style="margin: auto;">
            <button class="btnx" id="saveGeneral">Crear Bitacora General</button>
            <img src="https://www.dropbox.com/s/qfu4871umzhlcfo/check_arrow_2.svg?dl=1" alt="">
            <svg width="66px" height="66px">
              <circle class="circle_2" stroke-position="outside" stroke-width="3" fill="none" cx="34" cy="33" r="29" stroke="#1ECD97"></circle>
            </svg>
          </div>
        </div>

    </div>

  </div>
</div>
