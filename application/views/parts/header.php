<?php
$this->load->helper('camilo');
$img_user_session = $this->session->userdata('imagen');
$rol_user_session = $this->session->userdata('role');
$active_sidebar = (isset($active_sidebar) && $active_sidebar) ? '' : 'sidebar-collapse';
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?= $title ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/helper-class.css') ?>">



        <!-- jQuery 3 -->
        <script src="<?= base_url('assets2/bower_components/jquery/dist/jquery.min.js'); ?>"></script>
        <!-- jQuery Mask -->
        <script src="<?= base_url('assets/plugins/jQuery-Mask/src/jquery.mask.js'); ?>"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="<?= base_url('assets2/bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
        <!-- AdminLTE App -->
        <script src="<?= base_url('assets2/dist/js/adminlte.min.js'); ?>"></script>

        <!-- **********************************************datatables *********************************************-->
        <script src="<?= base_url('assets/plugins/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js') ?>"></script>

        <script src="<?= base_url('assets/plugins/datatables/js/dataTables.bootstrap.js?v=1.0') ?>"></script>

        <?php if ($this->uri->segment(2) == 'crear') : ?>
            <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/formulario_crear.css') ?>">
        <?php endif ?>

        <?php if ($this->uri->segment(1) == 'User') : ?>
            <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/datatables_camilo.css?v=' . validarEnProduccion()); ?>">
        <?php endif ?>

        <?php if ($this->uri->segment(2) == 'generar_reportes') : ?>
              <link rel="stylesheet" href="<?= base_url("assets/css/remake_styles.css?v=" . validarEnProduccion()) ?>">
        <?php endif ?>

        <?php if ($this->uri->segment(2) == 'perfil') : ?>
            <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/knockout-file-bindings.css'); ?>">
            <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/formulario_crear.css') ?>">
        <?php endif ?>

        <?php if ($this->uri->segment(1) == 'Bitacoras' || $this->uri->segment(2) == 'crear_usuarios') : ?>
            <link rel="stylesheet" href="<?= base_url("assets/css/remake_styles.css?v=" . validarEnProduccion()) ?>">
        <?php endif ?>

        <?php if ($this->uri->segment(1) == 'Areas') : ?>
            <link rel="stylesheet" href="<?= base_url("assets/css/remake_styles.css?v=" . validarEnProduccion()) ?>">
        <?php endif ?>

        <link rel="icon" href="<?= base_url('assets/img/logo_zte.png'); ?>">
        <link rel="stylesheet" href="<?= base_url('assets2/bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?= base_url('assets2/bower_components/fontawesome-free-5.9.0/css/all.css'); ?>">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?= base_url('assets2/bower_components/Ionicons/css/ionicons.min.css'); ?>">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?= base_url('assets2/dist/css/AdminLTE.min.css'); ?>">

        <link rel="stylesheet" href="<?= base_url('assets2/dist/css/skins/skin-blue.min.css'); ?>">
        <!-- generales del proyecto -->
        <link rel="stylesheet" href="<?= base_url('assets/css/generales.css'); ?>">
        <script src="<?= base_url("assets/js/modules/moment.min.js") ?>"></script>
        <!--Estilos del proyecto-->
        <link rel="stylesheet" href="<?= base_url ('assets/css/remake_styles.css');?>">

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>


    <body class="hold-transition skin-blue sidebar-mini <?= $active_sidebar ?>">
        <div class="wrapper">

            <!-- Main Header -->
            <header class="main-header" style="position:fixed; width:100%;">

                <!-- Logo -->
                <a href="#" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>Z</b>TE</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Z</b>OLID</span>
                </a>

                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top" role="navigation" style="text-align: center">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="fas fa-align-justify" data-toggle="push-menu" role="button" style="color:white;float:left;margin: 18px 12px 0px;">
                        <span class="sr-only">Toggle navigation</span>
                    </a>

                    <span class="title-proyect"><b>ZNOC</b></span>
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- Messages: style can be found in dropdown.less-->


                            <!-- ******************************seccion de mensajes nuevos ******************************-->
                            <!-- <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                              <i class="fa fa-envelope-o"></i>
                              <span class="label label-success">4</span>
                            </a>

                            <ul class="dropdown-menu">
                              <li class="header">You have 4 messages</li>
                              <li>
                                <ul class="menu">
                                    <a href="#">
                                      <div class="pull-left">
                                        <img src="<?= base_url('assets2/dist/img/user2-160x160.jpg'); ?>" class="img-circle" alt="User Image">
                                      </div>
                                      <h4>
                                        Support Team
                                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                      </h4>
                                      <p>Why not buy a new awesome theme?</p>
                                    </a>
                                  </li>
                                </ul>
                              </li>
                              <li class="footer"><a href="#">See All Messages</a></li>
                            </ul>
                          </li> -->
                            <!-- /.messages-menu -->

                            <!-- ******************************Notifications Menu ******************************-->
                            <!-- <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                              <i class="fa fa-bell-o"></i>
                              <span class="label label-warning">10</span>
                            </a>
                            <ul class="dropdown-menu">
                              <li class="header">You have 10 notifications</li>
                              <li>
                                <ul class="menu">
                                    <a href="#">
                                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                    </a>
                                  </li>
                                </ul>
                              </li>
                              <li class="footer"><a href="#">View all</a></li>
                            </ul>
                          </li> -->

                            <!-- ****************************************Tasks Menu**************************************** -->
                            <!-- <li class="dropdown tasks-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                              <i class="fa fa-flag-o"></i>
                              <span class="label label-danger">9</span>
                            </a>
                            <ul class="dropdown-menu">
                              <li class="header">You have 9 tasks</li>
                              <li>
                                <ul class="menu">
                                  <li>
                                    <a href="#">
                                      <h3>
                                        Design some buttons
                                        <small class="pull-right">20%</small>
                                      </h3>
                                      <div class="progress xs">
                                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                          <span class="sr-only">20% Complete</span>
                                        </div>
                                      </div>
                                    </a>
                                  </li>
                                </ul>
                              </li>
                              <li class="footer">
                                <a href="#">View all tasks</a>
                              </li>
                            </ul>
                          </li> -->



                            <!-- User Account Menu -->
                            <li class="dropdown user user-menu" id="perLi">
                                <!-- Menu Toggle Button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <!-- The user image in the navbar-->
                                    <img src="<?= base_url("assets2/dist/img/usuarios/$img_user_session.jpg"); ?>" class="user-image" alt="User Image">
                                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                    <span class="hidden-xs"><?= $this->session->userdata('name') ?></span>
                                </a>
                                <ul class="dropdown-menu" style="box-shadow: 0px 1px 4px -1px black">
                                    <!-- The user image in the menu -->
                                    <li class="user-header">
                                        <img src="<?= base_url("assets2/dist/img/usuarios/$img_user_session.jpg"); ?>" class="img-circle" alt="User Image">

                                        <p>
                                            <?= $this->session->userdata('name') ?>
                                            <small><?= strtoupper($this->session->userdata('role')); ?> <b><?= $this->session->userdata('proyecto') ?></b></small>
                                        </p>
                                    </li>
                                    <!-- Menu Body -->
                                    <li class="user-body">
                                        <div class="row">
                                            <div class="col-xs-4 text-center">
                                                <!-- <a href="#">Followers</a> -->
                                            </div>
                                            <div class="col-xs-4 text-center">
                                                <!-- <a href="#">Sales</a> -->
                                            </div>
                                            <div class="col-xs-4 text-center">
                                                <!-- <a href="#">Friends</a> -->
                                            </div>
                                        </div>
                                        <!-- /.row -->
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="<?= base_url('User/perfil') ?>" class="btn btn-default btn-flat"><i class="fas fa-cogs"></i> </i> Perfil</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="<?= base_url('User/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
                                        </div>

                                          <!-- crear Area  y roles -->

                                        <div class="" id="generate_areas" style="">
                                            <a href="<?= base_url('Areas') ?>" style="margin-left: 25px">
                                                <i class="fas fa-layer-group"></i>
                                                <span>Areas</span>
                                            </a>
                                        </div>
                                            <!--Fin crear Area  y roles -->
                                    </li>
                                </ul>
                            </li>
                            <!-- Control Sidebar Toggle Button -->
                            <li>
                                <a href="#" data-toggle="control-sidebar"><i class="fas fa-cogs"></i></i></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar" style="position:fixed;">

                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">

                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel" style="display:none;">
                        <div class="pull-left image">
                            <img src="<?= base_url("assets2/dist/img/usuarios/$img_user_session.jpg"); ?>" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p><?= $this->session->userdata('name') ?></p>
                            <!-- Status -->
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    </div>
                    <!-- /.row -->
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-left">
                            <a href="<?= base_url('User/perfil') ?>" class="btn btn-default btn-flat"><i class="fas fa-cogs"></i> </i> Perfil</a>
                        </div>
                        <div class="pull-right">
                            <a href="<?= base_url('User/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
                        </div>
                    </li>
                    </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <!-- <li>
                      <a href="#" data-toggle="control-sidebar"><i class="fas fa-cogs"></i></i></a>
                    </li> -->
                    </ul>
                    </div>
                    </nav>
                    </header>
                    <!-- Left side column. contains the logo and sidebar -->
                    <aside class="main-sidebar" style="position:fixed;">

                        <!-- sidebar: style can be found in sidebar.less -->
                        <section class="sidebar">

                            <!-- Sidebar user panel (optional) -->
                            <div class="user-panel" style="display:none;">
                                <div class="pull-left image">
                                    <img src="<?= base_url("assets2/dist/img/usuarios/$img_user_session.jpg"); ?>" class="img-circle" alt="User Image">
                                </div>
                                <div class="pull-left info">
                                    <p><?= $this->session->userdata('name') ?></p>
                                    <!-- Status -->
                                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                                </div>
                            </div>



                            <!-- Sidebar Menu -->
                            <ul class="sidebar-menu" data-widget="tree">
                                <li class="header">MENÚ DE NAVEGACIÓN</li>
                                <!-- Optionally, you can add icons to the links -->
                                <li id="principal">
                                    <a href="<?= base_url("User/principal") ?>">
                                        <i class="fa fa-home"></i>
                                        <span>Principal</span>
                                    </a>
                                </li>
                                <li id="Reportes">
                                    <a href="<?= base_url("GeneralReports/showReports") ?>">
                                        <i class="fas fa-file-excel"></i>
                                        <span>Reportes</span>
                                    </a>
                                </li>

          <!-- <li><a href="#"><i class="fa fa-id-badge"></i> <span>Agenda</span></a></li> -->
                                <li class="treeview" id="areali">
                                    <a href="#">
                                        <i class="fab fa-adn"></i>
                                        <span>Área</span>
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li class="treeview">
                                            <a href="#">
                                                <i class="fab fa-buromobelexperte"></i>&nbsp;&nbsp;
                                                <span>Front Office Móvil</span>
                                                <span class="pull-right-container">
                                                    <i class="fa fa-angle-left pull-right"></i>
                                                </span>
                                            </a>
                                            <ul class="treeview-menu">
                                                <li>
                                                    <a href="<?= base_url('Reportes/volumetria') ?>">
                                                        <i class="fab fa-audible"></i>&nbsp;&nbsp;
                                                        <span>Volumetrías</span>
                                                    </a>
                                                </li>
                                                <li id="slali">
                                                    <a href="<?= base_url('Reportes/reporte_sla') ?>">
                                                        <i class="fas fa-calendar"></i>&nbsp;&nbsp;
                                                        <span>SLA</span>
                                                    </a>
                                                </li>
                                                <li id="">
                                                    <a href="<?= base_url('Front_Office_Movil/KPI/Control') ?>">
                                                        <i class="fas fa-calendar"></i>&nbsp;&nbsp;
                                                        <span>Control KPI</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <!-- *****************SUB NIVEL***************** -->
                                        <li>
                                        <li class="treeview">
                                            <a href="#">
                                                <i class="fas fa-tools"></i>&nbsp;&nbsp;
                                                <span>Customer Care</span>
                                                <span class="pull-right-container">
                                                    <i class="fa fa-angle-left pull-right"></i>
                                                </span>
                                            </a>
                                            <ul class="treeview-menu">
                                                <li id="volumetria_cc">
                                                    <a href="<?= base_url('Reportes/volumetria_cc') ?>">
                                                        <i class="fab fa-audible"></i>&nbsp;&nbsp;
                                                        <span>Volumetría</span></a>
                                                </li>
                                                <li id="slaliCustomer">
                                                    <a href="<?= base_url('Reportes/reporte_sla_customer') ?>">
                                                        <i class="fas fa-calendar"></i>&nbsp;&nbsp;
                                                        <span>SLA</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="treeview">
                                            <a href="#">
                                                <i class="fab fa-buromobelexperte"></i>&nbsp;&nbsp;
                                                <span>Front Office Fija</span>
                                                <span class="pull-right-container">
                                                    <i class="fa fa-angle-left pull-right"></i>
                                                </span>
                                            </a>
                                            <ul class="treeview-menu">
                                                <li id="vol_fija">
                                                    <a href="<?= base_url('Reportes/volumetria_fija') ?>">
                                                        <i class="fab fa-audible"></i>&nbsp;&nbsp;
                                                        <span>Volumetrías</span>
                                                    </a>
                                                </li>
                                                <li id="slali">
                                                    <a href="<?= base_url('Reportes/reporte_sla_fija') ?>">
                                                        <i class="fas fa-calendar"></i>&nbsp;&nbsp;
                                                        <span>SLA</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="treeview">
                                            <a href="#">
                                                <i class="fab fa-buromobelexperte"></i>&nbsp;&nbsp;
                                                <span>Mesa de Calidad</span>
                                                <span class="pull-right-container">
                                                    <i class="fa fa-angle-left pull-right"></i>
                                                </span>
                                            </a>
                                            <ul class="treeview-menu">
                                                <li id="vol_fija">
                                                    <a href="<?= base_url('Reportes/volumetria_mesa_calidad') ?>">
                                                        <i class="fab fa-audible"></i>&nbsp;&nbsp;
                                                        <span>Volumetrías</span>
                                                    </a>
                                                </li>
                                            <!-- Bitacora Mesa e Calidad  -->
                                                <li id="bitacora_mc">
                                                    <a href="<?= base_url('BitacoraMC') ?>">
                                                        <i class="fas fa-clipboard-list"></i>&nbsp;&nbsp;
                                                        <span>Crear Bitacoras</span>
                                                    </a>
                                                </li>
                                            <!--Fin Bitacora Mesa e Calidad  -->
                                            <!-- Consultar Bitacora Mesa e Calidad  -->
                                            <li id="bitacora_mc">
                                                <a href="<?= base_url('BitacoraMC/ConsultarBitacorasMC') ?>">
                                                    <i class="fas fa-search"></i>&nbsp;&nbsp;
                                                    <span>Consultar Bitacora</span>
                                                </a>
                                            </li>
                                            <!-- Fin Consultar Bitacora Mesa e Calidad  -->

                                            </ul>
                                        </li>

                                </li>
                            </ul>
                            </li>

                            <!-- <li class="treeview" id="areali">
                                <a href="">
                                  <i class="fab fa-buromobelexperte"></i>
                                  <span>nombre</span>
                                  <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                  </span>
                                </a>
                                <ul class="treeview-menu">
                                  <li id="">
                                    <a href=""><span></span>
                                  </li>
                                  <li id="">
                                    <a href=""><span></span>
                                  </li>
                                </ul>
                              </li> -->

        <!-- <i class="fab fa-audible"></i>&nbsp;&nbsp; -->


                            <li class="treeview" id="bitac">
                                <a href="#">
                                    <i class="fas fa-clipboard-list"></i>
                                    <span>Crear Bitácoras</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li id="ccili">
                                        <a href="<?= base_url('Bitacoras/ccihfc') ?>"><span>CCI Y HFC</span></a>
                                    </li>
                                    <li id="fOli">
                                        <a href="<?= base_url('Bitacoras/frontEndBookLogs') ?>"><span>FrontOffice</span></a>
                                    </li>
                                    <li id="ccili">
                                        <a href="<?= base_url('Bitacoras/getBackOfficeView') ?>"><span>Back Office</span></a>
                                    </li>
                                </ul>
                            </li>
                            <li class="treeview" id="bitac-export">
                                <a href="#">
                                    <i class="fas fa-search"></i>
                                    <span>Consultar Bitacoras</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li id="bitac-front-office">
                                        <a href="<?= base_url('Bitacoras/export') ?>">
                                            <i class="fas fa-file-download"></i>&nbsp;&nbsp;
                                            <span>Front Office</span>
                                        </a>
                                    </li>
                                    <li id="bitac-cci-hfc">
                                        <a href="<?= base_url('Bitacoras/exportCciHfc') ?>">
                                            <i class="fas fa-file-download"></i></i>&nbsp;&nbsp;
                                            <span>CCI Y HFC</span>
                                        </a>
                                    </li>
                                    <li id="bitac-cci-hfc">
                                        <a href="<?= base_url('Bitacoras/exportBitacoraBO') ?>">
                                            <i class="fas fa-file-download"></i></i>&nbsp;&nbsp;
                                            <span>Back Office</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!--<li class="" id="malla">
                                    <a href="<?= base_url('Bitacoras/export') ?>">
                                        <i class="fas fa-search"></i>
                                        <span>Consultar Bitacoras</span>
                                    </a>
                                </li>-->
                            <li class="" id="malla">
                                <a href="<?= base_url('Malla') ?>">
                                    <i class="fas fa-edit"></i>
                                    <span>Malla</span>
                                </a>
                            </li>
                            <?php if ($this->session->userdata('lider_area')) : ?>
                                <li class="" id="createUser">
                                    <a href="<?= base_url('User/crear_usuarios') ?>">
                                        <i class="fas fa-user-plus"></i>
                                        <span>Crear Usuarios</span>
                                    </a>
                                </li>
                            <?php endif ?>
                            <li class="" id="createReport">
                                <a href="<?= base_url('Reportes/generar_reportes') ?>">
                                    <i class="fas fa-file-download"></i>
                                    <span>Generar Reporte</span>
                                </a>
                            </li>





                            </ul>
                            <!-- /.sidebar-menu -->
                        </section>
                        <!-- /.sidebar -->
                    </aside>

                    <!-- Content Wrapper. Contains page content -->
                    <div class="content-wrapper"style="margin-top:7vh;">
                        <div class="spinner-loader"></div>
                        <!-- Content Header (Page header) -->
                        <!-- <section class="content-header">
                            <h1>
                                <?= $header[0] ?>
                                <small><?= $header[1] ?></small>
                            </h1>
                            <ol class="breadcrumb">
                                <li><a href="#"><i class="fas fa-tachometer-alt"></i> <?= $title ?></a></li>
                                <li class="active">Here</li>
                            </ol>
                        </section> -->

                        <!-- Main content -->
                        <section class="content container-fluid contenedorMaestro">
