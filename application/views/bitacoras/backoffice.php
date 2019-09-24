<div class="main-title">
  BackOffice
</div>

<div class="card-style">
<div class="general">

    <div class="col-md-4 col-body">
        <div class="form-group">
        <label class="form-label" for="ingeniero">Ingeniero</label>
        <select id="ingeniero" class="form-input required-field" type="text">
          <option></option>
          <option>MILENA VILLARRAGA</option>
          <option>DOMINGO GARCIA</option>
          <option>ADRIANA PINZON</option>
          <option>CAMILO SOPO</option>
          <option>DANILO GONZALEZ</option>
          <option>ARNOLD ROMERO</option>
          <option>LUIS EDUARDO CAICEDO </option>
          <option>LEONARDO VARGAS</option>
          <option>WILSON OVIEDO </option>
          <option>RUBEN FLOREZ</option>
          <option>ROBINSON LOPEZ</option>
          <option>MIGAN GALBAN</option>
          <option>JAIME CASANOVA</option>
        </select>
        </div>
    </div>


    <div class="col-md-4 col-body">
        <div class="form-group">
          <label class="form-label" for="fecha">Fecha</label>
          <input class="form-input required-field" type="text" id="fecha"/>
        </div>
    </div>


    <div class="col-md-4 col-body">
        <div class="form-group">
        <label class="form-label" for="horario">Horario</label>
        <select id="horario" class="form-input required-field" type="text">
          <option></option>
          <option>06:00 - 14:00</option>
          <option>14:00 - 22:00</option>
          <option>22:00 - 06:00</option>
          <option>08:00 - 18:00</option>
          <option>06:00 - 16:30</option>
          <option>14:00 - 23:30</option>
        </select>
        </div>
    </div>



    <div class="col-md-4 col-body">
        <div class="form-group">
        <label class="form-label" for="ticket">Ticket</label>
        <input id="ticket" class="form-input required-field" type="text" />
        </div>
    </div>


    <div class="col-md-4 col-body">
        <div class="form-group">
        <label class="form-label" for="tarea">Tarea</label>
        <input id="tarea" class="form-input required-field" type="text" />
        </div>
    </div>


    <div class="col-md-4 col-body">
        <div class="form-group">
        <label class="form-label" for="estacion">Estación</label>
        <input list="estacionList" id="estacion" class="form-input required-field" type="text">
<datalist id="estacionList" >
<option value="">Seleccione</option>



</datalist>
        </div>
    </div>



    <div class="col-md-4 col-body">
        <div class="form-group">
          <label class="form-label" for="prioridad">Prioridad</label>
          <select id="prioridad" class="form-input required-field" type="text">
            <option></option>
            <option>1-1</option>
            <option>1-2</option>
            <option>2</option>
            <option>3</option>
          </select>
        </div>
    </div>



    <div class="col-md-4 col-body">
        <div class="form-group">
          <label class="form-label" for="tipoDeServicio">Tipo de Servicio</label>
            <select id="tipoDeServicio" class="form-input required-field" type="text">
            <option></option>
            <option>GSM</option>
            <option>UMTS</option>
            <option>LTE</option>
            <option>GSM-LTE</option>
            <option>GSM-UMTS</option>
            <option>GSM-UMTS-LTE</option>
            <option>UMTS-LTE</option>
            <option>INTERCONEXIONES</option>
            <option>RECHAZO DE LLAMADAS</option>
            <option>MASIVA</option>
            <option>ESCUELITA</option>
            <option>TRONCAL</option>
            <option>CAV</option>
            <option>VM</option>
          </select>
        </div>
    </div>


    <div class="col-md-4 col-body">
        <div class="form-group">
          <label class="form-label" for="detalleDeActividad">Detalle de Actividad</label>
            <select id="detalleDeActividad" class="form-input required-field" type="text">
              <option></option>
              <option>INTERMITENCIA</option>
              <option>FUERA DE SERVICIO</option>
              <option>SOPORTE A CAMPO</option>
              <option>PERFORMANCE MOVIL</option>
              <option>SOPORTE GESTION</option>
              <option>VM</option>
          </select>
        </div>
    </div>


    <div class="col-md-4 col-body">
        <div class="form-group">
        <label class="form-label" for="regional">Regional</label>
        <input id="regional" class="form-input required-field" type="text" />
        </div>
    </div>


    <div class="col-md-4 col-body">
        <div class="form-group">
        <label class="form-label" for="ciudad">Ciudad</label>
        <input id="ciudad" class="form-input required-field" type="text" />
        </div>
    </div>


    <div class="col-md-4 col-body">
        <div class="form-group">
          <label class="form-label" for="entradaDelTicket">Entrada del Ticket</label>
            <select id="entradaDelTicket" class="form-input required-field" type="text">
            <option></option>
            <option>FRONT</option>
            <option>IRAN</option>
            <option>CAMPO</option>
            <option>IPRAN</option>
            <option>SDH</option>
            <option>MC</option>
            <option>CORE</option>
          </select>
        </div>
    </div>


    <div class="col-md-4 col-body">
        <div class="form-group">
          <label class="form-label" for="fechaYHoraIngresoTarea">Hora Ingreso Tarea</label>
          <input id="fechaYHoraIngresoTarea" class="form-input required-field" type="text">
        </div>
    </div>


    <div class="col-md-4 col-body">
        <div class="form-group">
          <label class="form-label" for="horaInicioTrabajo">Hora Inicio Trabajo</label>
          <input id="horaInicioTrabajo" class="form-input required-field" type="text">
        </div>
    </div>



    <div class="col-md-4 col-body">
        <div class="form-group">
          <label class="form-label" for="horaFinalTrabajo">Hora Final Trabajo</label>
          <input id="horaFinalTrabajo" class="form-input required-field" type="text">
        </div>
    </div>


    <div class="col-md-4 col-body">
        <div class="form-group">
          <label class="form-label" for="tiempoRevision">Tiempo Revisión</label>
          <input id="tiempoRevision" readonly value="" class="form-input required-field" type="text">
        </div>
    </div>



    <div class="col-md-4 col-body">
        <div class="form-group">
          <label class="form-label" for="destinoDelTicket">Destino del Ticket</label>
            <select id="destinoDelTicket" class="form-input required-field" type="text">
            <option></option>
            <option>ENERGIA</option>
            <option>CAMPO</option>
            <option>CANCELADO</option>
            <option>CERRADO</option>
            <option>PENDIENTE</option>
            <option>IPRAN</option>
            <option>SDH</option>
            <option>CORE</option>
            <option>MESA CALIDAD</option>
            <option>RAN</option>
            <option>PERFORMANCE MOVIL</option>
            <option>FRONT</option>
            <option>COORDINADOR</option>
            <option>SOPORTE TELEFONICO</option>
            <option>REASIGNADO SIN TRABAJAR</option>
            <option>OTROS OPERADORES</option>
            <option>NOC DATOS</option>
          </select>
        </div>
    </div>


    <div class="col-md-4 col-body">
        <div class="form-group">
          <label class="form-label" for="seguimiento">Seguimiento</label>
            <select id="seguimiento" class="form-input required-field" type="text">
            <option></option>
            <option>N/A</option>
            <option>SEGUIMIENTO-1</option>
            <option>SEGUIMIENTO-2</option>
            <option>SEGUIMIENTO-3</option>
            <option>SEGUIMIENTO-4</option>
            <option>SEGUIMIENTO-5</option>
            <option>SEGUIMIENTO-6</option>
            <option>SEGUIMIENTO-7</option>
            <option>SEGUIMIENTO-8</option>
            <option>SEGUIMIENTO-9</option>
            <option>SEGUIMIENTO-10</option>
          </select>
        </div>
    </div>



    <div class="col-md-4 col-body">
        <div class="form-group">
          <label class="form-label" for="causaDeFalla">Causa de Falla</label>
            <select id="causaDeFalla" class="form-input required-field" type="text">
            <option></option>
            <option>ENERGIA</option>
            <option>CONFIGURACION</option>
            <option>HARDWARE </option>
            <option>TRANSMISION</option>
            <option>TRABAJO NO REPORTADO</option>
            <option>CODIGO SERVICIO </option>
            <option>INTERFERENCIA</option>
            <option>DEGRADACIÓN </option>
          </select>
        </div>
    </div>



    <div class="col-md-4 col-body">
        <div class="form-group">
        <label class="form-label" for="diagnosticoTicket">Diagnostico Ticket</label>
        <input id="diagnosticoTicket" class="form-input required-field" type="text" />
        </div>
    </div>



    <div class="col-md-4 col-body">
        <div class="form-group">
          <label class="form-label" for="tipoDeSoporte">Tipo de Soporte</label>
            <select id="tipoDeSoporte" class="form-input required-field" type="text">
              <option></option>
              <option>VALIDACION DE RUTA</option>
              <option>VALIDACION DE ENLACE</option>
              <option>VALIDACION DE SERVICIO</option>
              <option>VALIDACION DE GESTION</option>
              <option>N/A</option>
          </select>
        </div>
    </div>



    <div class="col-md-4 col-body">
        <div class="form-group">
          <label class="form-label" for="ticketMalGestionadoTMG">(ticket mal gestionado) TMG</label>
            <select id="ticketMalGestionadoTMG" class="form-input required-field" type="text">
            <option></option>
            <option>TMG-1</option>
            <option>TMG-2</option>
            <option>TMG-3</option>
            <option>TMG-4</option>
            <option>TMG-5</option>
            <option>TMG-6</option>
            <option>TMG-7</option>
            <option>TMG-8</option>
            <option>TMG-9</option>
            <option>TMG-10</option>
            <option>N/A</option>
          </select>
        </div>
    </div>



    <div class="col-md-4 col-body">
        <div class="form-group">
          <label class="form-label" for="areaDirigidaTMG">Area a la que va dirigida el TMG</label>
            <select id="areaDirigidaTMG" class="form-input required-field" type="text">
            <option></option>
            <option>FRONT</option>
            <option>IRAN</option>
            <option>CAMPO</option>
            <option>IPRAN</option>
            <option>SDH</option>
            <option>CORE</option>
            <option>N/A</option>
          </select>
        </div>
    </div>



    <div class="col-md-4 col-body">
        <div class="form-group">
          <label class="form-label" for="rutaSinDocumentarRSD">(ruta sin documentar) RSD</label>
            <select id="rutaSinDocumentarRSD" class="form-input required-field" type="text">
            <option></option>
              <option>SIN DOCUMENTAR</option>
              <option>DOCUMENTADA</option>
              <option>N/A</option>
          </select>
        </div>
    </div>


    <div class="col-md-4 col-body">
        <div class="form-group">
          <label class="form-label" for="rutaDesactializadaRD">(ruta desactualizada) RD</label>
            <select id="rutaDesactializadaRD" class="form-input required-field" type="text">
            <option></option>
            <option>ACTUALIZADA</option>
            <option>DESACTUALIZADA</option>
            <option>N/A</option>
          </select>
        </div>
    </div>


    <div class="col-md-4 col-body">
        <div class="form-group">
          <label class="form-label" for="checkDeExcluido">Check de Excluido</label>
            <select id="checkDeExcluido" class="form-input required-field" type="text">
              <option></option>
              <option>SI</option>
              <option>N/A</option>
          </select>
        </div>
    </div>



    <div class="col-md-4 col-body">
        <div class="wrap" style="margin: auto;">
            <button id="submit-logbook" type="submit">Guardar</button>
            <img src="https://www.dropbox.com/s/qfu4871umzhlcfo/check_arrow_2.svg?dl=1" alt="">
            <svg width="66px" height="66px">
            <circle class="circle_2" stroke-position="outside" stroke-width="3" fill="none" cx="34" cy="33" r="29" stroke="#1ECD97"></circle>
            </svg>
        </div>
    </div>
    <!-- </form> -->


</div>
</div>



<script src="<?= base_url("assets/plugins/sweetalert2/sweetalert2.all.js") ?>"></script>
<script src="<?= base_url("assets/js/backoffice.js?v" . validarEnProduccion())?>"></script>
