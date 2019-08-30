<script src="<?= base_url('assets/plugins/moments/moment.min.js'); ?>"></script>

<div class="main-title">
  FrontOffice
</div>

<style>
.valD::placeholder{
  color: black;
  text-align: center;
}

input{
  text-align: center;
}
.swal2-popup{
    margin: 8% 25%!important;
}
</style>

<div class="card-style">
  <div class="general frame">


    <div class="m-content frame" id="createContent" style="">

      <div class="row form-group">
        <div class="col-sm-offset-4 col-md-4">
          <label class="form-label" for="tipo_bitacora">Tipo de bitácora</label>
          <select id="tipo_bitacora" class="form-control getAreas form-input required-field">
            <option selected>Seleccione...</option>
          </select>
        </div>
      </div>

      <form class="" id="formu">
        <div class="generalFields">
            <hr>


            <div class="row">

                <div class="col-md-4 col-body">
                  <div class="form-group">
                    <label class="form-label" for="inicio_actividad">Inicio Actividad</label>
                    <input type="text" class="form-input required-field form-control valD" id="inicio_actividad" placeholder="Ingrese fecha y hora">
                  </div>
                </div>

                <div class="col-md-4 col-body">
                  <div class="form-group">
                    <label class="form-label" for="fin_actividad">Fin Actividad</label>
                    <input type="text" class="form-input required-field form-control valD" id="fin_actividad" placeholder="Ingrese fecha y hora">
                  </div>
                </div>

                <div class="col-md-4 col-body">
                  <div class="form-group">
                    <label class="form-label" for="tipo_actividad">Tipo de Actividad</label>
                    <select class="form-control form-input required-field" id="tipo_actividad">
                      <option value="">Seleccione...</option>
                      <option value="APERTURA">APERTURA</option>
                      <option value="SEGUIMIENTO">SEGUIMIENTO</option>
                      <option value="CIERRE">CIERRE</option>
                      <option value="ATENCIÓN LLAMADA">ATENCIÓN LLAMADA</option>
                      <option value="REVISIÓN MAIL">REVISIÓN MAIL</option>
                    </select>
                  </div>
                </div>


              </div>

            <div class="row">

              <div class="col-md-4 col-body">
                <div class="form-group">
                  <label class="form-label" for="estado">Estado</label>
                  <select id="estado" class="form-control form-input required-field">
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
              </div>

              <div class="col-md-4 col-body">
                <div class="form-group">
                  <label class="form-label" for="num_tk_incidente">Tk incidente</label>
                  <input type="text" class="form-control form-input required-field" id="num_tk_incidente" placeholder="Ingrese número">
                </div>
              </div>

              <div class="col-md-4 col-body">
                <div class="form-group">
                  <label class="form-label" for="descripcion">Descripción</label>
                  <textarea class="form-control form-input required-field" id="descripcion" placeholder=""></textarea>
                </div>
              </div>
            </div>



            <div class="row">

              <div class="col-md-4 col-body">
                <div class="form-group">
                  <label class="form-label" for="id_users">Ingeniero</label>
                  <input type="text" class="form-control form-input required-field" id="cedulaBitacora" value="<?php echo $this->session->userdata('name'); ?>" disabled>
                </div>
              </div>

              <div class="col-md-4 col-body">
                <div class="form-group">
                  <label class="form-label" for="cedulaBitacora">Cédula</label>
                  <input type="text" class="form-control form-input required-field" id="id_users" value="<?php echo $this->session->userdata('id'); ?>" disabled>
                </div>
              </div>

              <div class="col-md-4 col-body">
                <div class="form-group">
                <label class="form-label" for="turno">Turno</label>
                  <select  id="turno" class="form-control  form-input required-field">
                    <option value="">Seleccione...</option>
                    <option value="T1">T1 (06:00 - 14:00)</option>
                    <option value="T2">T2 (14:00 - 22:00)</option>
                    <option value="T3">T3 (22:00 - 06:00)</option>
                    <option value="T11">T11 (8:00 – 17:00)</option>
                  </select>
                </div>
              </div>

            </div>



            <div class="row">

              <div class="col-md-4 col-body">
                <div class="form-group">
                  <label class="form-label" for="ot_tarea">OT / Tarea</label>
                  <input type="text" class="form-control form-input required-field" id="ot_tarea" placeholder="Ingrese un número...">
                </div>
              </div>

              <div class="col-md-4 col-body">
                <div class="form-group">
                  <label class="form-label" for="area_asignacion">Área asignación</label>
                  <input type="text" class="form-control form-input required-field" id="area_asignacion" placeholder="Ingrese área...">
                </div>
              </div>

              <div class="form-group col-md-4 input-group-sm">
                <div class="form-group">
                  <label class="form-label" for="responsable">Responsable</label>
                  <input type="textArea" class="form-control form-input required-field  " id="responsable" placeholder="Ingrese el nombre del responsable">
                </div>
              </div>

            </div>



            <div class="row">

              <div class="col-md-4 col-body">
                <div class="form-group">
                  <label class="form-label" for="caso_de_uso">Caso de Uso</label>
                  <select id="caso_de_uso" class="form-control form-input required-field">
                    <option value="">Seleccione...</option>
                  </select>
                </div>
              </div>

              <div class="col-md-4 col-body">
                <div class="form-group">
                  <label class="form-label" for="prioridad">Prioridad</label>
                  <select id="prioridad" class="form-control form-input required-field">
                    <option value="">Seleccione...</option>
                    <option value="ALTA">ALTA</option>
                    <option value="MEDIA">MEDIA </option>
                    <option value="BAJO">BAJO</option>
                  </select>
                </div>
              </div>

              <div class="col-md-4 col-body">
                <div class="form-group">
                  <label class="form-label" for="estaciones_afectadas">Estaciones Afectadas</label>
                  <select id="estaciones_afectadas" class="form-control form-input required-field">
                    <option value="">Seleccione...</option>
                    <option value="0 a 3">0 a 3</option>
                    <option value="4 a 20">4 a 20</option>
                    <option value="MAYOR A 20">MAYOR A 20</option>
                  </select>
                </div>
              </div>

            </div>

            <div class="row">

              <div class="col-md-4 col-body">
                <div class="form-group">
                  <label class="form-label" for="tipo_incidente">Tipo de Incidente</label>
                  <select id="tipo_incidente" class="form-control form-input required-field">
                    <option value="">Seleccione...</option>
                    <option value="INTERMITENCIA">INTERMITENCIA</option>
                    <option value="PERFORMANCE">PERFORMANCE</option>
                    <option value="NOTIFICACIÓN">NOTIFICACIÓN</option>
                    <option value="INCIDENTE">INCIDENTE</option>
                  </select>
                </div>
              </div>


              </div>
              </div>
              <div id="validate_selection"></div>

            </form>






    </div>
    <div class="col-md-12 col-body">
      <div class="wrap" style="margin: auto;">
        <button id="saveBookLog" class="btnx">Subir Bitácora</button>
        <img src="https://www.dropbox.com/s/qfu4871umzhlcfo/check_arrow_2.svg?dl=1" alt="">
        <svg width="66px" height="66px">
          <circle class="circle_2" stroke-position="outside" stroke-width="3" fill="none" cx="34" cy="33" r="29" stroke="#1ECD97"></circle>
        </svg>
      </div>
    </div>

  </div>
</div>
</div>
