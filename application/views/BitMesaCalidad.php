<div class="main-title">
  Bitácora Mesa De Calidad
</div>
<div class="card-style">
  <div class="general frame">

      <div class="col-md-12">
        <div class=" col-md-4 col-sm-offset-4">
          <div class="form-group">
            <label class="form-label" for="bitacora">Tipo de Bitacora</label>
            <select  id="bitacora" class="form-input required-field act">
              <option value=""></option>
              <option value="BITACORA GENERAL">BITACORA GENERAL</option>
              <option value="TURNO INTEGRAL-SOLICITUDES">TURNO INTEGRAL-SOLICITUDES</option>
            </select>
          </div>
        </div>
      </div>

      <div class="col-md-4 col-body">
        <div class="form-group">
          <label class="form-label" for="ingeniero">Ingeniero</label>
          <input type="text" post-data = "ingeniero" post-datos = "ingeniero" class="form-control form-input required-field act" value="<?php echo $this->session->userdata('name'); ?>" id="ingeniero" readonly>
        </div>
      </div>

    <div class="generalForm" id="generalForm">

        <div class="col-md-4 col-body">
          <div class="form-group">
            <label class="form-label" for="fechaInicio">Fecha y Hora Inicio</label>
            <input type="text" post-data = "fecha_hora_inicio" class="form-control form-input required-field act" id="fechaInicio">
          </div>
        </div>

      <div class="col-md-4 col-body">
          <div class="form-group">
            <label class="form-label" for="fechaFin">Fecha y Hora Fin</label>
            <input type="text" post-data = "fecha_hora_fin" class="form-control form-input required-field act" id="fechaFin">
          </div>
        </div>

        <div class="col-md-4 col-body">
          <div class="form-group">
            <label class="form-label" for="duracion">Duracion</label>
            <input type="text" post-data = "duracion" class="form-control form-input required-field act" id="duracion">
          </div>
        </div>

        <div class="col-md-4 col-body">
          <div class="form-group">
            <label class="form-label" for="actividad">Actividad</label>
            <select  id="actividad" post-data = "actividad" class="form-control form-input required-field">
              <option value=""></option>
              <option value="GESTION T&P">GESTION T&P</option>
              <option value="REPORTES">REPORTES</option>
              <option value="OFENSORES">OFENSORES</option>
              <option value="GESTION PROBLEMAS">GESTION PROBLEMAS</option>
              <option value="CONTROL DE CALIDAD">CONTROL DE CALIDAD</option>
            </select>
          </div>
        </div>

        <div class="col-md-4 col-body" id="Nreport" hidden>
          <div class="form-group">
            <label class="form-label" for="NombreDelReporte">Nombre del Reporte</label>
            <input type="text" post-data = "nombre_reporte" class="form-control form-input" id="NombreDelReporte">
          </div>
        </div>

        <!-- <div class="col-md-4 col-body">
          <div class="form-group">
            <label class="form-label" for="turno">Turno</label>
            <select  id="turno" post-data = "turno" class="form-control form-input required-field">
              <option value=""></option>
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
            <label class="form-label" for="nemonico">Nemonico</label>
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

        <!-- <div class="col-md-4 col-body removeR">
          <div class="form-group">
            <label class="form-label" for="idAlarma">ID Alarma</label>
            <input type="text" post-data = "id_alarma" class="form-control  form-input required-field act" id="idAlarma">
          </div>
        </div> -->

        <div class="col-md-4 col-body">
          <div class="form-group">
            <label class="form-label" for="incidente">Incidente</label>
            <input list="incidents" type="text" post-data = "incidente" class="form-control  form-input required-field act" id="incidente">
            <datalist id="incidents">
              <option value=""></option>
              <option value="N.A"></option>
            </datalist>
          </div>
        </div>


        <div class="col-md-4 col-body removeR">
          <div class="form-group">
            <label class="form-label" for="tarea">Tarea</label>
            <input list="tareas" type="text" post-data = "tarea" class="form-control form-input required-field act" id="tarea">
            <datalist id="tareas">
              <option value=""></option>
              <option value="N.A"></option>
            </datalist>
          </div>
        </div>

        <div class="col-md-4 col-body removeR" id="tk-remove">
          <div class="form-group">
            <label class="form-label" for="tkcreado">Tk Creado / Tas creada</label>
            <input list="tksCreados" type="text" post-data = "tk_creado" class="form-control  form-input required-field act" id="tkcreado">
            <datalist id="tksCreados">
              <option value=""></option>
              <option value="N.A"></option>
            </datalist>
          </div>
        </div>

        <div class="col-md-4 col-body removeR">
          <div class="form-group">
            <label class="form-label" for="fmasiva">Falla Masiva</label>
            <select  id="fmasiva" post-data = "falla_masiva" class="form-control  form-input required-field">
              <option value=""></option>
              <option value="SI">SI</option>
              <option value="NO">NO</option>
              <option value="N.A">N.A</option>
            </select>
          </div>
        </div>

        <div class="col-md-4 col-body removeR">
          <div class="form-group">
            <label class="form-label" for="causalCierre">Cusal De Cierre</label>
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

        <div class="col-md-4 col-body">
          <div class="form-group">
            <label class="form-label" for="estado">Estado</label>
            <input list="esatdos" post-data = "estado" id="estado" class="form-control  form-input required-field" type="text">
              <datalist id="esatdos">
                <option value=""></option>
                <option value="Escalado a campo"></option>
                <option value="Escalado a BO"></option>
                <option value="Cierre"></option>
                <option value="Pendiente"></option>
                <option value="OTRO: Escriba cual..."></option>
              </datalist>
          </div>
        </div>

        <div class="col-md-4 col-body removeR">
          <div class="form-group">
            <label class="form-label" for="degradacionAbis">Degradacion por Packet Abis</label>
            <select  id="degradacionAbis" post-data = "degradacion_por_packet_abis" class="form-control form-input required-field">
              <option value=""></option>
              <option value="Si">Si</option>
              <option value="No">No</option>
            </select>
          </div>
        </div>

        <div class="col-md-4 col-body ">
          <div class="form-group">
            <label class="form-label" for="observaciones">Observaciones</label>
            <textarea class="form-control form-input" post-data = "obaservaciones" id="observaciones" rows="1"></textarea>
          </div>
        </div>

        <div class="col-md-4 col-body" id="active" hidden>
          <div class="form-group">
            <label class="form-label" for="resumen">Resumen</label>
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

    <div class="formTurnoIntegral" id="formTurnoIntegral" hidden>

      <div class="col-md-4 col-body">
        <div class="form-group">
          <label class="form-label" for="fechaInicio2">Fecha y Hora Inicio</label>
          <input type="text" post-datos = "fecha_hora_solicitud" class="form-control form-input required-field act" id="fechaInicio2">
        </div>
      </div>

      <div class="col-md-4 col-body ">
        <div class="form-group">
          <label class="form-label" for="solicitante">Solicitante</label>
          <input list="solicitantes"  post-datos = "solicitante"  id="solicitante" class="form-control  form-input required-field" type="text">
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
          <input type="text" post-datos = "incidente"  class="form-control  form-input required-field act" id="incidente2">
        </div>
      </div>

      <div class="col-md-4 col-body">
        <div class="form-group">
          <label class="form-label" for="medio">Medio</label>
          <select  id="medio" post-datos = "medio"  class="form-control  form-input required-field">
            <option value=""></option>
            <option value="chat">CHAT</option>
            <option value="correo">CORREO</option>
            <option value="llamada">LLAMADA</option>
          </select>
        </div>
      </div>

      <div class="col-md-4 col-body">
        <div class="form-group">
          <label class="form-label"for="tipificacion">Tipificación</label>
          <input list="tipificaciones" post-datos = "tipificacion"  id="tipificacion" class="form-control  form-input required-field" type="text">
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
            <option value=""></option>
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

      <div class="col-md-4 col-body ">
        <div class="form-group">
          <label class="form-label" for="fechaRespuesta">Fecha y Hora Respuesta</label>
          <input type="text" post-datos = "fecha_hora_respuesta"  class="form-control form-input required-field act" id="fechaRespuesta">
        </div>
      </div>

      <div class="col-md-4 col-body ">
        <div class="form-group">
          <label class="form-label" for="tiempoRespuesta">Tiempo de Respuesta</label>
          <input type="text" post-datos = "tiempo_respuesta"  class="form-control form-input required-field act" id="tiempoRespuesta">
        </div>
      </div>

      <div class="col-md-4 col-body ">
        <div class="form-group">
          <label class="form-label" for="observaciones2">Observaciones</label>
          <textarea class="form-control form-input required-field" post-datos = "observaciones"  id="observaciones2" rows="1"></textarea>
        </div>
      </div>

      <div class="col-md-4 col-body ">
        <div class="form-group">
          <label class="form-label" for="resumenSolicitud">Resumen de solicitud</label>
          <textarea class="form-control form-input required-field" post-datos = "resumen_solicitud"  id="resumenSolicitud" rows="1"></textarea>
        </div>
      </div>

      <div class="col-md-12 col-body">
        <div class="wrap" style="margin: auto;">
          <button class="btnx" id="saveTurnoIntegral">Crear Bitacora T.I-S</button>
          <img src="https://www.dropbox.com/s/qfu4871umzhlcfo/check_arrow_2.svg?dl=1" alt="">
          <svg width="66px" height="66px">
            <circle class="circle_2" stroke-position="outside" stroke-width="3" fill="none" cx="34" cy="33" r="29" stroke="#1ECD97"></circle>
          </svg>
        </div>
      </div>

    </div>

  </div>
</div>
