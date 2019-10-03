<script type="text/javascript">
  var id_user ="<?= $this->session->userdata('id')?>";
</script>
<div class="main-title">
Crear Rol
</div>

<div style="display:flex; justify-content: center;">
  <div class="card-style w-60">
      <div class="general">

        <div class="col-md-6 col-sm-offset-3">
          <div class="form-group">
            <label class="form-label col-sm-offset-5" for="" style="font-size:18px" >Area</label>
            <input type="input" class="form-control form-input required-field" style="font-size:20px" value="<?php if (strrpos( $nombre_area,"_")) {echo str_replace('-',' ',substr( $nombre_area, strrpos( $nombre_area,"_")+1));}else {echo str_replace('%20',' ', $nombre_area);};?>"
            id="area" disabled>
          </div>
        </div>

        <input type="hidden" name="<?= $nombre_area ?>" value="<?= $nombre_area ?>" id="trueArea">


        <div class="col-md-6 col-body">
            <div class="form-group">
                <label class="form-label" for="">Nuevo Rol</label>
                <input type="input" class="styleInp form-input required-field"  id="newRol">
            </div>
        </div>

        <div class="col-md-6 col-body">
            <div class="form-group">
              <label class="form-label">Descripcion de Rol</label>
              <input  id="descripcionRol" class="form-input required-field" type="text">
            </div>
        </div>

        <div class="col-md-12 col-body">
          <div class="wrap" style="margin: auto;">
            <button class="btnx" id="postRol">Crear Rol</button>
            <img src="https://www.dropbox.com/s/qfu4871umzhlcfo/check_arrow_2.svg?dl=1" alt="">
            <svg width="66px" height="66px">
              <circle class="circle_2" stroke-position="outside" stroke-width="3" fill="none" cx="34" cy="33" r="29" stroke="#1ECD97"></circle>
            </svg>
          </div>
        </div>

      </div>
  </div>
</div>
