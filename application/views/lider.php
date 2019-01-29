<!--*********************  Modulo de pestañas en Backlog  *********************-->
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#assign_table">Asignadas</a></li>
    <li class=""><a data-toggle="tab" href="#pending_table">Pendientes</a></li>
    <li class=""><a data-toggle="tab" href="#total_table" id="pestana_total">Total</a></li>
</ul>


<!--*********************  Contendio de la pestaña  por asignacion  *********************-->
<div class="tab-content" id="pending_section">

    <div id="assign_table" class="tab-pane fade in active">
        <table id="tabla_asignadas" class="table table-hover table-bordered table-striped dataTable_camilo">
            <tfoot> <tr> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> </tr> </tfoot>
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
        <table id="tabla_total" class="table table-hover table-bordered table-striped dataTable_camilo">
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