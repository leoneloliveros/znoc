<div class="main-title">
Crear Area Y Rol
</div>

<div style="display:flex; justify-content: center;">
  <div class="card-style w-60">
      <div class="general">

        <div class="col-md-6 col-body">
            <div class="form-group">
                <label class="form-label" for="">Nombre del Area</label>
                <input type="input" class="styleInp form-input required-field"  id="area">
            </div>
        </div>

        <div class="col-md-6 col-body">
            <div class="form-group">
                <label class="form-label" for="">Responsable del Area</label>
                <input type="input" class="styleInp form-input required-field"  id="responsableArea">
            </div>
        </div>

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
<script src="<?= base_url("assets\js\areas.js?v=" . validarEnProduccion()) ?>"></script>
