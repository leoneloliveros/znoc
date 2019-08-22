
  <div class="main-title" style="width: 60%;">
      <span>
      Control KPI
      </span>
      <span id='subtitle'>
      <i class="fas fa-code-branch"></i> Front Office Movil
      </span>

  </div>

  <div style="display:flex; justify-content: center;">
      <div class="card-style w-60">
          <div class="general">

              <div class="switch-container col-md-6 col-body position-relative form-group" id="solohora">
                  <label class="switch">
                  <input type="checkbox" class="form-check-input">
                  <span id="onlyDateInitial" class="slider round"></span>
                  </label>
                  <span class="checkbox-initial">
                      Solo Fecha de Inicio
                  </span>
              </div>

  <!-- ****************************************************Boton de activacion areas*****************************************************-->
              <div class="switch-container col-md-6 col-body form-group">
                  <label class="switch">
                  <input type="checkbox" class="form-check-input">
                  <span id="bitacoras-none" class="slider round"></span>
                  </label>
                  <span class="checkbox-initial">
                    Seleccionar Area
                  </span>
              </div>
  <!-- ****************************************************Fin Boton de activacion areas*****************************************************-->

                  <div class="col-md-6 col-body">
                      <div class="form-group">
                      <label class="form-label" for="ticket">Fecha Inicial</label>
                      <input id="fechaInicio" class="form-input required-field" type="text" />
                      </div>
                  </div>


                  <div class="col-md-6 col-body">
                      <div class="form-group">
                      <label class="form-label" for="ticket">Fecha Final</label>
                      <input id="fechaFinal" class="form-input required-field" type="text" />
                      </div>
                  </div>

  <!-- ****************************************************Botones de areas*****************************************************-->

                <div id="areas"  style="display:none;">

                    <div class="col-md-4 col-body position-relative">
                      <div class="form-group" >
                        <label class="switch">
                          <input type="checkbox" name="foenergia" class="form-check-input" id="foenergia">
                        <span class="slider round "></span>
                        <span class="checkbox-initial" >
                          FOENERGIA
                        </span>
                        </label>

                      </div>
                    </div>


              <div id="areas" class="disable"  style="display:none;">
                  <div class="col-md-4 col-body position-relative">
                    <div class="form-group"  >
                      <label class="switch">
                        <input type="checkbox" name="foservicio" id="foservicio">
                      <span class="slider round"></span>
                      </label>
                      <span class="checkbox-initial">
                        FOSERVICIO
                      </span>
                    </div>
                  </div>

                  <div class="col-md-4 col-body position-relative">
                    <div class="form-group"  >
                      <label class="switch">
                        <input type="checkbox" name="intermitencia" id="intermitencia">
                      <span class="slider round"></span>
                      </label>
                      <span class="checkbox-initial">
                        INTERMITENCIA
                      </span>
                    </div>
                  </div>

      
                  <div class="col-md-4 col-body position-relative">
                    <div class="form-group"  >
                      <label class="switch">
                        <input type="checkbox" name="plataforma" id="plataforma">
                      <span class="slider round"></span>
                      </label>
                      <span class="checkbox-initial">
                        PLATAFORMA
                      </span>
                    </div>
                  </div>

                  <div class="col-md-4 col-body position-relative">
                    <div class="form-group" >
                      <label class="switch">
                        <input type="checkbox" name="todas" id="todas" checked>
                      <span class="slider round"></span>
                      </label>
                      <span class="checkbox-initial">
                        TODAS
                      </span>
                    </div>
                </div>
    
  <!-- ****************************************************Fin Botones de areas*****************************************************-->

            <div class="col-md-12 col-body">
                <div class="wrap" style="margin: auto;">
                    <button id="consult" type="submit" onclick="">Consultar</button>
                    <img src="https://www.dropbox.com/s/qfu4871umzhlcfo/check_arrow_2.svg?dl=1" alt="">
                    <svg width="66px" height="66px">
                    <circle class="circle_2" stroke-position="outside" stroke-width="3" fill="none" cx="34" cy="33" r="29" stroke="#1ECD97"></circle>
                    </svg>
                </div>
            </div>
        </div>
    </div>


</div>
<button id="graficos_pri" class="btn btn-warning grafico-pri" style="display: none;">Tiempos de Escalamiento</button>
<button id="graficos_deteccion" class="btn btn-danger graficos_deteccion" style="display: none;">Tiempos de Deteccion</button>
<button id="graficos_esc_dt" class="btn btn-success graficos_esc_dt" style="display: none;">Tiempo de Escalamiento + Tiempo de Deteccion</button>
<div id="grahp_prio" style="display: none;">
<div class="" style="display: flex; width: 100%; align-items: center; margin-top: 50px; flex-wrap: wrap;">
        <div class="col-md-12" id="P1" style=" margin-bottom: 30px; width: 70%;"></div>
        <div class="col-md-12" id="P2" style=" margin-bottom: 30px; width: 70%"></div>
        <div class="col-md-12" id="P3" style=" margin-bottom: 30px; width:70%"></div>
    </div>
</div>
    <div id="container_graphic" style="background: #26D8B2; display: none;">
        <div class="col-md-12" id="tiempo_det" style=" margin-bottom: 30px; width: 70%;"></div>
        <div class="col-md-12" id="tiempo_det2" style=" margin-bottom: 30px; width: 70%;"></div>
        <div class="col-md-12" id="tiempo_det3" style=" margin-bottom: 30px; width: 70%;"></div>
    </div>
    <div id="container_grahp_tetd" style="background: #26D8B2; display: none;">
        <div class="col-md-12" id="tetd1" style="margin-bottom: 30px; width: 70%;"></div>
        <div class="col-md-12" id="tetd2" style="margin-bottom: 30px; width: 70%;"></div>
        <div class="col-md-12" id="tetd3" style="margin-bottom: 30px; width: 70%;"></div>
    </div>
    <div class="col-md-12" id="container-graph4" style=" margin-bottom: 30px; width:50%"></div>
    <div class="col-md-12" id="container-result" style="display: flex;"></div>
</div>



  

  <div id="modalInfo" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog  modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Detalle</h4>
        </div>
        <div class="modal-body" id="insert-content">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->


  </div>
  <!-- <div id="container-graph" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div> -->


  <!-- New view styles  -->
  <link rel="stylesheet" href="<?= base_url ('assets/css/remake_styles.css');?>">



  <script type="text/javascript" src="<?= base_url('assets/plugins/hightchart/code/highcharts.js');?>"></script>
  <script type="text/javascript" src="<?=base_url('assets/plugins/moments/moment.min.js');?>"></script>
  <script type="text/javascript" src="<?=base_url('assets/js/tiempo_deteccion.js');?>"></script>
  <script type="text/javascript" src="<?=base_url('assets/js/escala_deteccion.js');?>"></script>
  <!-- <script type="text/javascript" src="<?=base_url('assets/js/modules/bitacoras.js');?>"></script> -->


  <script>
  $('#loader').hide();
  $('.spinner-loader').hide();
  var queryValue = "";
  $('#fechaFinal').mask("99/99/9999");
  $('#fechaInicio').mask("99/99/9999");

  var activeInitialButton = false;
  $('#onlyDateInitial').on('click', function(){
      activeInitialButton = (activeInitialButton == true) ? false : true ;
      if (activeInitialButton == true) {
          $('#fechaFinal').parent().attr('style', 'display: none;');
      } else {
          $('#fechaFinal').parent().attr('style', 'display:  block;');
      };


  });
  function test() {
      if (activeInitialButton == true) {
      // $('#fechaInicio').on('blur', function() {
          $('#fechaFinal').val($('#fechaInicio').val());
      // });
      }
  };
  //*********************************************Funcion para mostar y ocultar botones de areas***************************************************//
  var activarArea = false;

  $('#bitacoras-none').on('click', function(){
    activarArea = (activarArea == true) ? false : true ;
    if (activarArea === true) {
      $('#areas').attr('style', 'display:  block;');
    }else {
      $('#areas').attr('style', 'display:  none;');
    }


  });

  // ********************************************Fin Funcion para mostar y ocultar botones de areas****************************************************//

  $(function(){
  setInterval(test, 1000);
  });

  </script>
  <script src="<?= base_url("assets/js/backoffice.js?v" . validarEnProduccion())?>"></script>
