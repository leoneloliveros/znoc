<script type="text/javascript">
  var id_user ="<?= $this->session->userdata('id')?>";
</script>
<div class="main-title">
Crear Area Y Rol
</div>

<div style="display:flex; justify-content: center;">
  <div class="card-style w-60">
      <div class="general">

        <div class="switch-container col-md-12 col-body position-relative form-group">
            <label class="switch">
            <input type="checkbox" class="form-check-input">
            <span id="newRol" class="slider round"></span>
            </label>
            <span class="checkbox-initial">
                Agregar roles
            </span>
        </div>

        <div class="col-md-6 col-body">
            <div class="form-group">
                <label class="form-label" for="">Nombre del Area</label>
                <input type="input" class="styleInp form-input required-field"  id="area">
            </div>
        </div>

        <div class="col-md-6 col-body">
            <div class="form-group">
              <label class="form-label">Responsable del Area</label>
              <input list="users" id="responsableArea" class="form-input required-field" type="text">
                <datalist id="users">
                  <option value="">Seleccione</option>
                </datalist>
            </div>
        </div>

        <input type="hidden" name="" value="" id="idUser">




        <div class="col-md-12 col-body">
          <div class="wrap" style="margin: auto;">
            <button class="btnx" id="newArea">Crear Area</button>
            <img src="https://www.dropbox.com/s/qfu4871umzhlcfo/check_arrow_2.svg?dl=1" alt="">
            <svg width="66px" height="66px">
              <circle class="circle_2" stroke-position="outside" stroke-width="3" fill="none" cx="34" cy="33" r="29" stroke="#1ECD97"></circle>
            </svg>
          </div>
        </div>

      </div>
  </div>
</div>
