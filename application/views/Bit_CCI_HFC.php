<div class="row frame">
    <div class="col-sm-12 t-a-c">

        <div class="col-sm-2 form-group">
            <label for="">Tipo Bitacora</label>
            <select class="styleInp" id="typeBinnacle">
                <option value="">Seleccione...</option>
                <option value="CCI">CCI</option>
                <option value="HFC">HFC</option>
            </select>
        </div>
        
        <div class="col-sm-2 form-group">
            <label for="">Prioridad</label>
            <select class="styleInp" id="typeP">
                <option value="">Seleccione...</option>
                <option value="P1">P1</option>
                <option value="P2">P2</option>
                <option value="P3">P3</option>
            </select>
        </div>

        <div class="col-sm-3 form-group">
            <label for="incident">INCIDENTE</label>
            <input type="text" class="styleInp" id="incident">
            <input type="hidden" id="iniAct">
            <input type="hidden" id="finAct">
        </div>

        <div class="col-sm-3 form-group">
            <label for="">INGENIERO</label>
            <select class="styleInp" id="engineer">
                <option value="">Seleccione...</option>
            </select>
        </div>

        <div class="col-sm-2 form-group">
            <label for="">FECHA INICIO</label>
            <input type="input" class="styleInp" id="beginDate">
        </div>
    </div>

    <div class="col-sm-12 t-a-c">

        <div class="col-sm-4 form-group">
            <label for="">FECHA FINAL</label>
            <input type="input" class="styleInp" id="endDate">
        </div>

        <div class="col-sm-4 form-group">
            <label for="">ESTADO DEL INC</label>
            <select class="styleInp" id="INCStatus">
                <option value="">Seleccione...</option>
                <option value="ABIERTO">ABIERTO</option>
                <option value="ASIGNADO">ASIGNADO</option>
                <option value="EN PROCESO">EN PROCESO</option>
                <option value="PENDIENTE">PENDIENTE</option>
                <option value="RESUELTO">RESUELTO</option>
                <option value="CERRADO">CERRADO</option>
                <option value="CANCELADO">CANCELADO</option>
            </select>
        </div>

        <div class="col-sm-4 form-group">
            <label for="">ACTIVIDAD</label>
            <select class="styleInp" id="activity">
                <option value="">Seleccione...</option>
                <option value="APERTURA INC FRONT">APERTURA INC FRONT</option>
                <option value="CREACIÓN DE TAS (BO HFC)">CREACIÓN DE TAS (BO HFC)</option>
                <option value="VALIDACIÓN">VALIDACIÓN</option>
                <option value="REASIGNACIÓN (SOLO FRONT)">REASIGNACIÓN (SOLO FRONT)</option>
                <option value="CONTROL CALIDAD">CONTROL CALIDAD</option>
                <option value="CREACIÓN DE OT">CREACIÓN DE OT</option>
                <option value="QC CREADA">QC CREADA</option>
                <option value="FALLA EN CONTROL DE CALIDAD POR CGE">FALLA EN CONTROL DE CALIDAD POR CGE</option>
                <option value="YA GESTIONADO">YA GESTIONADO</option>
            </select>
        </div>
    </div>

    <div class="col-sm-6 t-a-c form-group">
        <label for="">OBSERVACIÓN</label>
        <textarea class="styleInp" id="obs" cols="30" rows="5"></textarea>
    </div>


    <div class="col-sm-6 t-a-c form-group">
        <table border="1" style="margin-top: 5%; width: 100%;">
            <tbody>
                <tr>
                    <td>
                        <label>ERROR DE FLUJO</label> <br>
                        <input type="checkbox" name="" id="flowErr">
                    </td>
                    <td>
                        <label>ERROR  DE WFM</label> <br>
                        <input type="checkbox" name="" id="ErrWfm">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>TAS QC NO EXITOSO</label> <br>
                        <input type="checkbox" name="" id="tqnExit">
                    </td>
                    <td>
                        <label>PYMES</label> <br>
                        <input type="checkbox" name="" id="pymes">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>MAL CATEGORIZADOS</label> <br>
                        <input type="checkbox" name="" id="MC">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="col-sm-12 t-a-c">
        <div class="col-sm-6">
            <label for="">OT CERRADA SIN CAUSAS DE CIERRE</label>
            <input type="text" class="styleInp" id="OTCCC">
            <!--<textarea class="styleInp" id="OTCCC" cols="30" rows="5"></textarea>-->
        </div>
        
<!--        <div class="col-sm-6">
            <label for="">UNI/BIDI</label>
            <select name="" id="uni_bidi" class="styleInp">
                <option value="">Seleccione</option>
                <option value="BIDIRECCIONAL">BIDIRECCIONAL</option>
                <option value="UNIDIRECCIONAL">UNIDIRECCIONAL</option>
            </select>
        </div>-->
    </div>
    <div class="col-sm-12 t-a-c">
        <button class="btnx" id="newLogBook">Guardar</button>
    </div>

</div>