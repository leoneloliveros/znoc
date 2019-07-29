<div class="row frame">
    <div class="col-sm-12 t-a-c">
        <div class="col-sm-4 form-group">
            <label for="">Cedula</label>
            <input type="input" class="styleInp" id="id_users">
        </div>
        <div class="col-sm-4 form-group">
            <label for="">Nombres</label>
            <input type="input" class="styleInp" id="nombres">
        </div>
        <div class="col-sm-4 form-group">
            <label for="">Apellidos</label>
            <input type="input" class="styleInp" id="apellidos">
            <input type="hidden" class="styleInp" id="contrasena" value="abc123">
            <input type="hidden" class="styleInp" id="imagen" value="default">
            <input type="hidden" class="styleInp" id="action" value="insert">
        </div>
    </div>

    <div class="col-sm-12 t-a-c">
        <div class="col-sm-4">
            <label for="">Email</label>
            <input type="email" class="styleInp" id="email">
        </div>

        <div class="col-sm-4">
            <label for="">Numero Contacto</label>
            <input type="input" class="styleInp" id="num_contacto">
        </div>

        <div class="col-sm-4">
            <label for="">Area</label>
            <select name="" id="area" class="styleInp">
                <option value="">Seleccione...</option>
            </select>
        </div>
    </div>

    <div class="col-sm-12 t-a-c">
        <div class="col-sm-4">
            <label for="">Role</label>
            <select name="" id="role" class="styleInp">
                <option value="">Seleccione...</option>
            </select>
        </div>
    </div>

    <div class="col-sm-12 t-a-c">
        <button class="btnx" id="newUser">Guardar</button>
        <button class="btnx1" id="deleteUser" style="display: none;">Eliminar</button>
    </div>

</div>