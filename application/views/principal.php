<!--*********************  Modulo de pestañas en Backlog  *********************-->
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#assign_table">Asignadas</a></li>
    <li class=""><a data-toggle="tab" href="#pending_table">Pendientes</a></li>
    <li class=""><a data-toggle="tab" href="#total_table" id="pestana_total">Total</a></li>
</ul>


<!--*********************  Contendio de la pestaña  por asignacion  *********************-->
<div class="tab-content" id="bandejas_seccion">

    <div id="assign_table" class="tab-pane fade in active">
        <table id="tabla_asignadas" class="table table-hover table-bordered table-striped dataTable_camilo" style="width: 100%">
            <tfoot> <tr> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> </tr> </tfoot>
        </table>
    </div>
    <!--*********************  Contendio de la pestaña de servicios pendientes *********************-->
    <div id="pending_table" class="tab-pane fade">
        <div class="container">
            <table id="tabla_pendientes" class="table table-hover table-bordered table-striped dataTable_camilo" width="100%">
                <tfoot> <tr>    <th></th> <th></th> <th></th> <th></th>    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!--*********************  Contendio de la pestaña de total *********************-->
    <div id="total_table" class="tab-pane fade">
        <table id="tabla_total" class="table table-hover table-bordered table-striped dataTable_camilo" style="width: 100%">
            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<!--------------------- FORMULARIO DEL MODAL PARA CIERRE DE CRQ --------------------->
<div class="modal modal-primary fade" id="mdl_cierre_crq">
    <div class="modal-dialog modal-lg2">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">

                <!-- <div class="container m-w-100">
                  <form class="form form-inline" role="form">
                    <div class="form-group col-xs-12 col-sm-6">
                      <label for="InputFieldA" class="col-xs-4">Field A</label>
                      <div class="col-xs-8">
                        <select name="nombre" id="nombre" class="form-control input_ex">
                            <option value="">Seleccione</option>
                            <option value="1">Opcion 1</option>
                            <option value="1">Opcion 1</option>
                            <option value="1">Opcion 1</option>
                            <option value="1">Opcion 1</option>
                            <option value="1">Opcion 1</option>
                            <option value="1">Opcion 1</option>
                        </select>
                      </div>
                    </div>



                   
                     
                    







                    <div class="form-group col-xs-12 col-sm-6">
                      <label for="InputFieldB" class="col-xs-4">Field B</label>
                      <div class="col-xs-8">
                        <input type="text" class="form-control input_ex" id="InputFieldB" placeholder="InputFieldB">
                      </div>
                    </div>

                    <div class="form-group col-xs-12 col-sm-6">
                      <label for="InputFieldC" class="col-xs-4">Field C</label>
                      <div class="col-xs-8">
                        <input type="text" class="form-control input_ex" id="InputFieldC" placeholder="InputFieldC">
                      </div>
                    </div>

                  </form>
                </div> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline" id="save_changes">Guardar Cambios</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>



<div id="id_modal" class="modal modal-primary fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">X</button>
                <h3 class="modal-title" id="modal_title"></h3>
            </div>
            <div class="modal-body" id="prueba">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class='glyphicon glyphicon-remove'></i>&nbsp;Cancelar</button>
                <button type="button" class="btn btn-success" id="modal_enviar"><i class='glyphicon glyphicon-send'></i>&nbsp;enviar</button>
            </div>
        </div>
    </div>
</div>