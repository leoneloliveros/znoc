<div class="main-title">
Malla
</div>

<div class="card-style">
<div class="general frame">

<style media="screen">

table{
  background: unset;
  border: 1px solid #ddd;
  width: 100%;
  color: #333;
}
#menu_fixed{
  padding: 10px;
}
.contenedor.closed{
    background-color: #084c6f;
    border-color: transparent;
    width: 180px;
    height: 40px;
    box-shadow: 0px 0px 3px #333;
    border-radius: 15px 15px;
    text-align: center;
    padding-top: 10px;

}
.contenedor.closed:hover {
    background-color:#084c6fd4;

}
#btn_fixed{
  font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
  width: max-content;
  height: auto;
  color: #FFF;
  text-shadow: 0px 1px 1px #0c3565;
  cursor: pointer;
}
.btn_close_fixed{
  font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
}
#content_fixed{
  min-width: 200px;
  width: fit-content;
  text-align: -webkit-center;
  border-radius: 15px 15px;

}
</style>
<link href='<?= base_url('assets/css/btn_3d.css'); ?>' rel='stylesheet'>
<link href='<?= base_url('assets/plugins/full_calendar/lib/fullcalendar.min.css'); ?>' rel='stylesheet' />
<link href='<?= base_url('assets/plugins/full_calendar/lib/fullcalendar.print.min.css'); ?>' rel='stylesheet' media='print' />
<link href='<?= base_url('assets/css/malla_fullCalendar.css'); ?>' rel='stylesheet' />
<link href='<?= base_url('assets/plugins/full_calendar/scheduler.min.css'); ?>' rel='stylesheet' />
<script src='<?= base_url('assets/plugins/full_calendar/lib/moment.min.js'); ?>'></script>
<script src='<?= base_url('assets/plugins/full_calendar/lib/jquery.min.js'); ?>'></script>
<script src='<?= base_url('assets/plugins/full_calendar/'); ?>lib/jquery-ui.min.js'></script>
<script src='<?= base_url('assets/plugins/full_calendar/'); ?>lib/fullcalendar.min.js'></script>
<script src='<?= base_url('assets/plugins/full_calendar/scheduler.min.js'); ?>'></script>
<script src='<?= base_url('assets/plugins/full_calendar/demos/js/theme-chooser.js'); ?>'></script>
<div class="cont_btn_mdl_excel">
    <span class="btn_3d"  data-toggle='modal' data-target='#ModalLoadMalla'> <i class="fa fa-cloud-upload-alt" aria-hidden="true"></i> </span>
</div>

<div id='calendar'></div>
 </div>

<!-- *******************************menu stiky******************************* -->
<div class="contenedor closed draggable" id="content_fixed">
    <div id="btn_fixed" >
        <span class="rotate-90 text">
            <i class="glyphicon glyphicon-chevron-down"></i><span class="espaciomenu">Agregar</span>
        </span>
    </div>
    <div class="hidden" id="menu_fixed">
        <span id="btn_close_fixed">
            <i class="glyphicon glyphicon-chevron-up"></i> Cerrar
        </span>
        <div class="menu-fixed">
            <div id='external-events'>
                <legend class="f-s-12">
                    <strong>Malla entre semana</strong>
                    <span><div class='fc-event' id="event_a" data-color="#5c32bf69" data-franja="3:00-11:00">3:00-11:00</div></span> <!-- data-duration="120:00"  duracion del evento(largo del evento) -->
                    <span><div class='fc-event' id="event_b" data-color="#084c6fba" data-franja="6:00-14:00">6:00-14:00</div></span> <!-- data-duration="120:00"  duracion del evento(largo del evento) -->
                    <span><div class='fc-event' id="event_c" data-color="#ffff00" data-franja="7:00-16:00">7:00-16:00</div></span> <!-- data-duration="120:00"  duracion del evento(largo del evento) -->
                </legend>
                <legend class="f-s-12"><strong><!-- Malla fin de semana --></strong>
                    <span><div class='fc-event' id="event_a_f" data-color="#0070c0" data-franja="13:00-21:00">13:00-21:00</div></span> <!-- data-duration="120:00"  duracion del evento(largo del evento) -->
                    <span><div class='fc-event' id="event_b_f" data-color="#92d050" data-franja="11:00-20:00">11:00-20:00</div></span> <!-- data-duration="120:00"  duracion del evento(largo del evento) -->
                    <span><div class='fc-event' id="event_c_f" data-color="#ffc000" data-franja="8:00-17:00">8:00-17:00</div></span> <!-- data-duration="120:00"  duracion del evento(largo del evento) -->
                </legend>
                    <legend class="f-s-12"><strong>Eliminar malla</strong>
                    <span><div id="calendarTrash" class="class_remove_event calendar-trash"><img width="50px" height="50px" src="http://www.fireebok.com/images/resource/bettertrash/bettertrashicon_256.png" /></div></span>
                <div id="malla_adicional"></div>
                </legend>
                <div>
                    <button class="btn-large f-s-10" id="btn_add_horario">add horario especial <i class="fa fa-plus" aria-hidden="true"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- *******************************fin menu stiky******************************* -->

<!--*********************** modal actualizacion malla por excel*********************** -->
<div class="modal fade" id="ModalLoadMalla" tabindex="-1" role="dialog" aria-labelledby="ModalLoadMallaTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body modal-load-3">
                <div class="content">
                    <form method="post" enctype="multipart/form-data" id="formFileUploadMalla">
                        <div class="box">
                            <input type="file" name="idarchivo" id="file-malla" class="inputfile inputfile-4 hidden" data-multiple-caption="{count} files selected" multiple accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"/>
                            <label for="file-malla"><figure><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg></figure> <span>Choose a file...</span></label>
                        </div>
                        <button class="btn-cami_cool2" id="btn_subir_malla-data" type="submit"> Subir Archivo <span class="glyphicon glyphicon-ok"></span></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
  var ingenieros = <?php echo json_encode($ingenieros); ?>;
  const role_in_session = '<?php echo $this->session->userdata('role'); ?>';
</script>
<script src='<?= base_url('assets/js/modules/malla.js'); ?>'></script>



</div>
</div>
