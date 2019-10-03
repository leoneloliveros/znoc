<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <div class="panel pane4-default">
    <div class="panel-body">
        <div class="panel panel-primary">

        <div class="panel-heading" style="height: 10vh; display: flex; align-items: center; justify-content: space-between;">
        <div class="" style="font-size: 20px;">
          <?php
          if (strrpos( $nombre_area,"_")) {
            echo str_replace('-',' ',substr( $nombre_area, strrpos( $nombre_area,"_")+1));
          }else {
            echo  str_replace('%20',' ', $nombre_area);
          }
          ?>

        </div>

        <div class="">
          <a href="<?= base_url('Areas/generateCordinator'). '/' . $nombre_area ?>" style="color: White;margin-right:20px;" data-toggle="tooltip" data-placement="bottom" title="Crear Cordinador">
            <i class="fas fa-user-tie fa-2x"></i>
          </a>

          <a href="<?= base_url('User/crear_usuarios') ?>" style="color: White; margin-right:20px;" data-toggle="tooltip" data-placement="bottom" title="Crear Usuario">
            <i class="fas fa-user-plus fa-2x"></i>
          </a>

          <a href="<?= base_url('Areas/generateRol'). '/' . $nombre_area ?>" style="color: White" data-toggle="tooltip" data-placement="bottom" title="Crear Rol">
            <i class="fas fa-user-tag fa-2x"></i>
          </a>


        </div>

        </div>

        <div class="panel-body" >
            <table class="table">
              <thead>

                <tr class="">
                  <th><h4 class="title-tables" style="margin-left:0px; text-align: left">Cordinadores</h4>
                  <?php
                    // var_dump($cordinadores);
                    foreach ($cordinadores as $key) {  ?>
                      <div class="form-group cor">
                          <h4 class="corB"><?php echo($key->nombre_cordinador); ?></h4>
                          <!-- <a href="#"><i class="fas fa-user-minus" style="margin-right:25px;"  data-toggle="tooltip" data-placement="bottom" title="Eliminar Cordinador"></i></a> -->
                      </div>
                  <?php } ?>
                </tr>

                <tr>
                  <th><h4 class="title-tables" style="margin-left:0px; text-align: left">Usuarios</h4>
                  <?php
                    // var_dump($cordinadores);
                    foreach ($usuarios as $key) {  ?>
                      <div class="form-group cor">
                          <h4 class="corB"><?php echo($key->nombres_usuarios); ?></h4>
                          <!-- <a href="#"><i class="fas fa-user-times" style="margin-right:25px"  data-toggle="tooltip" data-placement="bottom" title="Eliminar Usuario"></i></a> -->
                      </div>
                  <?php } ?>
                </tr>

                <tr>
                  <th><h4 class="title-tables" style="margin-left:0px; text-align: left">Roles</h4>
                  <?php
                    // var_dump($cordinadores);
                    foreach ($roles as $key) {  ?>
                      <div class="form-group cor">
                        <h4 class="corB"><?php echo($key->name); ?></h4>
                        <!-- <a href="#"><i class="fas fa-backspace" style="margin-right:25px;" data-toggle="tooltip" data-placement="bottom" title="Eliminar rol"></i></a> -->
                      </div>
                  <?php } ?>
                </tr>

              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
    <!-- <tbody>
                              <tr>
                                    <div  style="display: flex;  justify-content: space-between;">
                                      <th scope="col" style="text-align:center;"><strong>{{substr($value['subarea'], strrpos($value['subarea'],"_") + 1)}}</strong></th>
                                      <th scope="col"><span>
                                        <ul>

                                          <li style="list-style: none; padding-right: 15%; list-style: none; text-align: center;">
                                            {!! Form::open(array('route' => array('responsableDestroy', $value2->id ), 'method' => 'delete','onsubmit' =>" modifyTexttt(this); return false;")) !!}

                                            {{$value2->name}} <button data-toggle="tooltip" title="Delete coordinator" class="btn btn-default" type="submit" style="color: #f77777; cursor: pointer;"><i class="fas fa-user-times"></i></button>
                                            {!! Form::close() !!}
                                          </li>
                                        </ul>
                                      </span></th>
                                    <th scope="col" style="text-align:center;">
                                    {!! Form::open(array('route' => array('createCoordinator', $value['subarea']), 'method' => 'get')) !!}

                                        <button data-toggle="tooltip" title="Add Coordinator"   class="btn btn-info" type="submit"><i class="fas fa-user-ninja" style="color:white;"></i></button>
                                    {!! Form::close() !!}

                                    {!! Form::open(array('route' => array('areas.destroy', $value['id']), 'method' => 'delete','onsubmit' =>" modifyText(this); return false; ")) !!}


                                        <button class="btn btn-danger btn-sm"  type="submit" id="venito" name="button" value="delete"><i class="fas fa-trash-alt" aria-hidden="true"></i></button>

                                        {!! Form::close() !!}




                                        {!! Form::close() !!}
                                    </th>
                                    </div>
                                </tr>

                            </tbody> -->
