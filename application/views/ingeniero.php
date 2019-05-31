<!--*********************  Modulo de pestañas en Backlog  *********************-->
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#assign_table">Asignadas</a></li>
    <li class=""><a data-toggle="tab" href="#total_table" id="pestana_total">Total</a></li>
</ul>

<!--*********************  Contendio de la pestaña  por asignacion  *********************-->
<div class="tab-content" id="bandejas_seccion">

    <div id="assign_table" class="tab-pane fade in active">

        <div align="center">
            <div class="form-inline">
                <div class="form-group">
                    <label for="search_date_asignadas">Fecha Asignación:</label>
                    <input type="date" class="form-control" id="search_date_asignadas" value="<?= date('Y-m-d') ?>" >
                    <button class="btn btn-success" id="btn_search_asignadas">Buscar</button>
                </div>
            </div>
        </div><br>
        


        <table id="tabla_asignadas" class="table table-hover table-bordered table-striped dataTable_camilo" style="width: 100%">
            <tfoot> <tr> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> </tr> </tfoot>
        </table>
    </div>


    <!--*********************  Contendio de la pestaña de total *********************-->
    <div id="total_table" class="tab-pane fade">
        <table id="tabla_total" class="table table-hover table-bordered table-striped dataTable_camilo" style="width: 100%">
            <tfoot> <tr> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> </tr> </tfoot>
        </table>
    </div>
</div>

<!--------------------- FORMULARIO DEL MODAL PARA CIERRE DE CRQ --------------------->
<div class="modal modal-primary fade" id="mdl_cierre_crq">
    <div class="modal-dialog modal-lg">
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