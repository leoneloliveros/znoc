<!--*********************  Modulo de pestañas en Backlog  *********************-->
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#assign_table">Asignadas</a></li>
    <li class=""><a data-toggle="tab" href="#total_table" id="pestana_total">Total</a></li>
</ul>

<!--*********************  Contendio de la pestaña  por asignacion  *********************-->
<div class="tab-content">

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
            <tfoot> <tr> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> </tr> </tfoot>
        </table>
    </div>


    <!--*********************  Contendio de la pestaña de total *********************-->
    <div id="total_table" class="tab-pane fade">
        <table id="tabla_total" class="table table-hover table-bordered table-striped dataTable_camilo">
            <tfoot> <tr> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> </tr> </tfoot>
        </table>
    </div>
</div>