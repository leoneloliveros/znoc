<div class="main-title">
Crear Usuario
</div>

<div style="display:flex; justify-content: center;">
<div class="card-style w-60">
  <div class="general">

<div class="row frame">


    <div class="col-md-4 col-body">
        <div class="form-group">
            <label class="form-label" for="">Cedula</label>
            <input type="input" class="styleInp form-input required-field"  id="id_users">
        </div>
    </div>

      <div class="col-md-4 col-body">
        <div class="form-group">
            <label class="form-label" for="">Nombres</label>
            <input type="input" class="styleInp form-input required-field" id="nombres">
        </div>
      </div>

      <div class="col-md-4 col-body">
        <div class="form-group">
            <label class="form-label" for="">Apellidos</label>
            <input type="input" class="styleInp  form-input required-field" id="apellidos">
            <input type="hidden" class="styleInp" id="contrasena" value="abc123">
            <input type="hidden" class="styleInp" id="imagen" value="default">
            <input type="hidden" class="styleInp" id="action" value="insert">
        </div>
      </div>



    <div class="col-md-6 col-body">
        <div class="form-group">
            <label class="form-label" for="">Email</label>
            <input type="email" class="styleInp form-input required-field" id="email">
        </div>
    </div>


        <div class="col-md-6 col-body">
          <div class="form-group">
            <label class="form-label" for="">Numero Contacto</label>
            <input type="input" class="styleInp form-input required-field" id="num_contacto">
          </div>
        </div>



        <div class="col-md-6 col-body">
          <div class="form-group">
            <label class="form-label" for="">Area</label>
            <select name="" id="area" class="styleInp form-input required-field">
              <option value=""></option>
            </select>
          </div>
        </div>


    <div class="col-md-6 col-body">
        <div class="form-group">
            <label class="form-label" for="">Role</label>
            <select name="" id="role" class="styleInp form-input required-field">
                <option value=""></option>
            </select>
        </div>
    </div>


    <div class="col-md-12 col-body">
        <div class="wrap" style="margin: auto;">
          <button class="btnx" id="newUser">Guardar</button>
          <button class="btnx1" id="deleteUser" style="display: none;">Eliminar</button>
          <img src="https://www.dropbox.com/s/qfu4871umzhlcfo/check_arrow_2.svg?dl=1" alt="">
          <svg width="66px" height="66px">
            <circle class="circle_2" stroke-position="outside" stroke-width="3" fill="none" cx="34" cy="33" r="29" stroke="#1ECD97"></circle>
          </svg>
        </div>
    </div>

</div>
</div>
</div>
</div>
