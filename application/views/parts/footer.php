<div id="loader">
<div  class='wrap1'>
  <div class='loader' id='lrd1'></div>
</div>
</div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
        <!-- Anything you want -->
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2019 <a href="#">ZTE Colombia</a>.</strong> All rights reserved.

</footer>

<script type="text/javascript">
    const base_url = "<?php echo base_url(); ?>";
    const formato_fecha = new Date();
    const fecha_actual = formato_fecha.getDate() + "-" + formato_fecha.getMonth() + "-" + formato_fecha.getFullYear();
</script>


<!--******************************* SIDEBAR DE LA DERECHA******************************* -->
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    Create the tabs
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    Tab panes
    <div class="tab-content">
        Home tab content
        <div class="tab-pane active" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
                <li>
                    <a href="javascript:;">
                        <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                            <p>Will be 23 on April 24th</p>
                        </div>
                    </a>
                </li>
            </ul>
            /.control-sidebar-menu

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
                <li>
                    <a href="javascript:;">
                        <h4 class="control-sidebar-subheading">
                            Custom Template Design
                            <span class="pull-right-container">
                                <span class="label label-danger pull-right">70%</span>
                            </span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                        </div>
                    </a>
                </li>
            </ul>
            /.control-sidebar-menu

        </div>
        /.tab-pane
        Stats tab content
        <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
        /.tab-pane
        Settings tab content
        <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
                <h3 class="control-sidebar-heading">General Settings</h3>

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Report panel usage
                        <input type="checkbox" class="pull-right" checked>
                    </label>

                    <p>
                        Some information about this general settings option
                    </p>
                </div>
                /.form-group
            </form>
        </div>
        /.tab-pane
    </div>
</aside>
<!-- Add the sidebar's background. This div must be placed
immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>

<script src="<?= base_url("assets/plugins/sweetalert2/sweetalert2.all.js") ?>"></script>
<!-- ********************************************** HELPER FUNCVIONES GLOBALES *********************************************-->
<script src="<?= base_url("assets/js/utils/helper.js?v=" . validarEnProduccion()) ?>"></script>


<!-- js para lider -->
<?php if ($this->uri->segment(1) == 'User' && $this->uri->segment(2) == 'principal' && $this->session->userdata('role') == 'lider' && $this->session->userdata('proyecto') == 'microondas'): ?>
    <script src="<?= base_url("assets/js/modules/lider.js?v=" . validarEnProduccion()) ?>"></script>
    <script src="<?= base_url("assets/js/modules/cerrar_crq_microondas.js?v=" . validarEnProduccion()) ?>"></script>
<?php endif ?>

<!-- js para ingeniero -->
<?php if ($this->uri->segment(1) == 'User' && $this->uri->segment(2) == 'principal' && $this->session->userdata('role') == 'ingeniero' && $this->session->userdata('proyecto') == 'microondas'): ?>
    <script src="<?= base_url("assets/js/modules/ingeniero.js?v=" . validarEnProduccion()) ?>"></script>
    <script src="<?= base_url("assets/js/modules/cerrar_crq_microondas.js?v=" . validarEnProduccion()) ?>"></script>
<?php endif ?>

<!-- js para cambios en perfil del usuario -->
<?php if ($this->uri->segment(1) == 'User' && $this->uri->segment(2) == 'perfil'): ?>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/knockout/3.1.0/knockout-min.js'></script>
    <script src="<?= base_url("assets/js/utils/knockout-file-bindings.js") ?>"></script>
    <script src="<?= base_url("assets/js/modules/perfil_usuario.js?v=" . validarEnProduccion()) ?>"></script>
<?php endif ?>



<!-- **********************************************datatables plus (excel ... ) *********************************************-->
<?php if ($this->uri->segment(1) == 'User' && $this->uri->segment(2) == 'principal'): ?>
    <script type="text/javascript" src="<?= base_url("assets/plugins/datatables/js/dataTables.buttons.min.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("assets/plugins/datatables/js/jszip.min.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("assets/plugins/datatables/js/pdfmake.min.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("assets/plugins/datatables/js/vfs_fonts.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("assets/plugins/datatables/js/buttons.html5.min.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("assets/plugins/datatables/js/buttons.print.min.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("assets/plugins/datatables/js/dataTables.select.min.js") ?>"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<?php endif ?>

<!-- js para lider -->
<?php if ($this->uri->segment(1) == 'Crq' && $this->uri->segment(2) == 'crear' && $this->session->userdata('role') == 'lider'): ?>
    <script src="<?= base_url("assets/js/modules/crear_crq.js?v=" . validarEnProduccion()) ?>"></script>
<?php endif ?>

<!-- **********************************************BITACORAS CCIHFC********************************************** -->
<?php if ($this->uri->segment(2) == 'ccihfc') : ?>
    <script src="<?= base_url("assets/plugins/jquery.mask.js") ?>" type="text/javascript"></script>
    <script src="<?= base_url("assets/js/modules/bitacoras.js?v=" . validarEnProduccion()) ?>"></script>
<?php endif ?>
<!-- **********************************************END BITACORAS CCIHFC********************************************** -->

<!-- **********************************************BITACORAS FRONTOFFICE********************************************** -->
<?php if ($this->uri->segment(2) === "frontEndBookLogs" ||$this->uri->segment(2) === "export" ): ?>
    <script type="text/javascript" src="<?= base_url('assets/js/modules/frontEndBookLog.js?v=' . validarEnProduccion()); ?>"></script>
<?php endif ?>
<!-- **********************************************END BITACORAS FRONTOFFICE********************************************** -->

<!-- **********************************************VOLUMETRÍAS********************************************** -->
<?php if ($this->uri->segment(2) === "volumetria"): ?>
    <script type="text/javascript" src="<?= base_url('assets/js/modules/volumetria.js'); ?>"></script>
<?php endif ?>
<?php if ($this->uri->segment(2) === "volumetria_cc"): ?>
    <script type="text/javascript" src="<?= base_url('assets/js/modules/volumetria_cc.js?v=' . validarEnProduccion()); ?>"></script>
<?php endif ?>
<!-- **********************************************FIN VOLUMETRÍAS********************************************** -->
<!-- **********************************************REPORTE SLAS********************************************** -->
<?php if ($this->uri->segment(2) === "reporte_sla"): ?>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
    <script type="text/javascript" src="<?= base_url('assets/plugins/hightchart/code/highcharts.js');?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/modules/reporte_sla.js?v=' . validarEnProduccion()); ?>"></script>
<?php endif ?>
<!-- **********************************************FIN REPORTE SLAS********************************************** -->
<!-- **********************************************REPORTE SLAS********************************************** -->
<?php if ($this->uri->segment(2) === "reporte_sla_customer"): ?>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/modules/reporte_sla_customer.js?v=' . validarEnProduccion()); ?>"></script>
<?php endif ?>
<?php if ($this->uri->segment(2) === "volumetria_fija"): ?>
    <script type="text/javascript" src="<?= base_url('assets/js/modules/volumetria_fija.js?v=' . validarEnProduccion()); ?>"></script>
<?php endif ?>

<?php if ($this->uri->segment(2) == 'crear_usuarios'): ?>
        <script src="<?= base_url("assets/js/modules/crear_usuarios.js?v=" . validarEnProduccion()) ?>"></script>
<?php endif ?>
<!-- **********************************************FIN REPORTE SLAS********************************************** -->

<?php if ($this->uri->segment(2) === "exportCciHfc"): ?>
    <script type="text/javascript" src="<?= base_url("assets/js/modules/consultar_cci_hfc.js?v=" . validarEnProduccion()); ?>"></script>
<?php endif ?>

    <script type="text/javascript">
    // para ponerle active al li seleccionado
    if ('<?= $sub_bar ?>') {
        $('#<?= $active ?>').parents('li').addClass('active');
    }
    $('#<?= $active ?>').addClass('active');
</script>
<!-- ****************************************************MAYA**************************************************** -->
<?php if ($this->uri->segment(1) == 'Malla'): ?>
        <script src="<?= base_url("assets/js/modules/loadExcel/loadMalla.js?v=" . validarEnProduccion()) ?>"></script>
<?php endif ?>

</body>
</html>
