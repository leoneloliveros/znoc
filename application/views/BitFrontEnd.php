<style>
.valD::placeholder{
  color: black;
  text-align: center;
}

input{
  text-align: center;
}
</style>
<div class="m-content frame">
  <div class="row">
    <div class="form-group col-sm-offset-4 col-md-4">
      <label for="tipo_bitacora">Tipo de bitácora</label>
      <select id="tipo_bitacora" class="form-control">
        <option selected>Seleccione...</option>
        <option data-id="1" value="energias">Energía</option>
        <option data-id="2" value="intermitencias">Intermitencias</option>
        <option data-id="3" value="plataformas">Plataforma</option>
        <option data-id="4" value="servicios">Servicios</option>
      </select>
    </div>
  </div>
  <div class="generalFields">
    <hr>
    <div class="row">
      <div class="form-group col-md-4 input-group-sm">
        <label for="inicio_alarma">Inicio Alarma</label>
        <input type="text" class="form-control valD" id="inicio_alarma" placeholder="Ingrese fecha y hora">
      </div>
      <div class="form-group col-md-4 input-group-sm">
        <label for="creacion_tk">Creación TK</label>
        <input type="text" class="form-control valD" id="creacion_tk" placeholder="Ingrese fecha y hora">
      </div>
      <div class="form-group col-md-4 input-group-sm">
        <label for="inicio_actividad">Inicio Actividad</label>
        <input type="text" class="form-control valD" id="inicio_actividad" placeholder="Ingrese fecha y hora">
      </div>
    </div>

    <div class="row">
      <div class="form-group col-md-4 input-group-sm">
        <label for="fin_actividad">Fin Actividad</label>
        <input type="text" class="form-control valD" id="fin_actividad" placeholder="Ingrese fecha y hora">
      </div>
      <div class="form-group col-md-4 input-group-sm">
        <label for="tiempo_atencion">Tiempo Atención</label>
        <input type="text" class="form-control" id="tiempo_atencion" disabled>
      </div>
      <div class="form-group col-md-4 input-group-sm">
        <label for="tipo_actividad">Tipo de Actividad</label>
        <select class="form-control" id="tipo_actividad">
          <option value="">Seleccione...</option>
          <option value="APERTURA">APERTURA</option>
          <option value="SEGUIMIENTO">SEGUIMIENTO</option>
          <option value="CIERRE">CIERRE</option>
          <option value="ATENCIÓN LLAMADA">ATENCIÓN LLAMADA</option>
          <option value="REVISIÓN MAIL">REVISIÓN MAIL</option>
        </select>
      </div>
    </div>

    <div class="row">
      <div class="form-group col-md-4 input-group-sm">
        <label for="estado">Estado</label>
        <select id="estado" class="form-control">
          <option value="">Seleccione...</option>
          <option value="ABIERTO">ABIERTO</option>
          <option value="ASIGNADO">ASIGNADO</option>
          <option value="EN PROGRESO">EN PROGRESO</option>
          <option value="PENDIENTE ">PENDIENTE </option>
          <option value="RESUELTO">RESUELTO</option>
          <option value="CERRADO ">CERRADO </option>
          <option value="CANCELADO">CANCELADO</option>
        </select>
      </div>
      <div class="form-group col-md-4 input-group-sm">
        <label for="num_tk_incidente">Tk incidente</label>
        <input type="text" class="form-control" id="num_tk_incidente" placeholder="Ingrese número">
      </div>
      <div class="form-group col-md-4 input-group-sm">
        <label for="descripcion">Descripción</label>
        <textarea class="form-control" id="descripcion" placeholder=""></textarea>
      </div>
    </div>


    <div class="row">
      <div class="form-group col-md-4 input-group-sm">
        <label for="id_users">Ingeniero</label>
        <select id="id_users" class="form-control">
          <option value="">Seleccione...</option>
        </select>
      </div>
      <div class="form-group col-md-4 input-group-sm">
      <label for="cedulaBitacora">Cédula</label>
      <input type="text" class="form-control" id="cedulaBitacora" disabled>
    </div>
      <div class="form-group col-md-4 input-group-sm">
        <label for="turno">Turno</label>
        <select id="turno" class="form-control">
          <option value="">Seleccione...</option>
          <option value="T1">T1 (06:00 - 14:00)</option>
          <option value="T2">T2 (14:00 - 22:00)</option>
          <option value="T3">T3 (22:00 - 06:00)</option>
        </select>
      </div>
    </div>
    
    <div class="row">
      <div class="form-group col-md-4 input-group-sm">
        <label for="ot_tarea">OT / Tarea</label>
        <input type="text" class="form-control" id="ot_tarea" placeholder="Ingrese un número...">
      </div>
      <div class="form-group col-md-4 input-group-sm">
        <label for="area_asignacion">Área asignación</label>
        <input type="text" class="form-control" id="area_asignacion" placeholder="Ingrese área...">
      </div>
      <div class="form-group col-md-4 input-group-sm">
        <label for="responsable">Responsable</label>
        <input type="textArea" class="form-control" id="responsable" placeholder="Ingrese el nombre del responsable">
      </div>
    </div>
    
    <div class="row">
      <div class="form-group col-md-4 input-group-sm">
        <label for="caso_de_uso">Caso de Uso</label>
        <select id="caso_de_uso" class="form-control">
          <option value="">Seleccione...</option>
        </select>
      </div>
      <div class="form-group col-md-4 input-group-sm">
        <label for="prioridad">Prioridad</label>
        <select id="prioridad" class="form-control">
          <option value="">Seleccione...</option>
          <option value="ALTA">ALTA</option>
          <option value="MEDIA">MEDIA </option>
          <option value="BAJO">BAJO</option>
        </select>
      </div>
      <div class="form-group col-md-4 input-group-sm">
        <label for="estaciones_afectadas">Estaciones Afectadas</label>
        <select id="estaciones_afectadas" class="form-control">
          <option value="">Seleccione...</option>
          <option value="0 a 3">0 a 3</option>
          <option value="4 a 20">4 a 20</option>
          <option value="MAYOR A 20">MAYOR A 20</option>
        </select>
      </div>
    </div>
    
    <div class="row">
      <div class="form-group col-md-4 input-group-sm">
        <label for="estaciones_afectadas_descripcion">Estaciones Afectadas Descripción</label>
        <input type="textArea" class="form-control" id="estaciones_afectadas_descripcion" placeholder="">
      </div>
      <div class="form-group col-md-4 input-group-sm">
        <label for="tipo_incidente">Tipo de Incidente</label>
        <select id="tipo_incidente" class="form-control">
          <option value="">Seleccione...</option>
          <option value="INTERMITENCIA">INTERMITENCIA</option>
          <option value="PERFORMANCE">PERFORMANCE</option>
          <option value="NOTIFICACIÓN">NOTIFICACIÓN</option>
          <option value="INCIDENTE">INCIDENTE</option>
        </select>
      </div>

    </div>

  </div>

  <hr>

  <div id="validate_selection" class="row">

  </div>

  <button id="saveBookLog" class="btn btn-primary">Subir Bitácora</button>
</div>