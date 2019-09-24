<div class="main-title">
Areas a cargo
</div>



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">

              <?php
              $searchedValue = $this->session->userdata('id'); // Value to search.
              $neededObject = array_filter(
                  $rol,
                  function ($e) use ($searchedValue) {
                    return $e->user_id == $searchedValue;
                  }
                );
                  // var_dump($neededObject);
                  if (!empty($neededObject)) { ?>
              <div class="panel-heading" style="display: flex;  justify-content: space-between; align-items: center;">
                <h2>Crear Area</h2>
                <a class="" data-toggle="tooltip" title="New Area" href="<?= base_url('Areas/generate_areas') ?>"><i class="fas fa-plus-square fa-2x"></i></a>
              </div>
            <?php } ?>

                <div class="panel-body">
                  <?php
                  // var_dump($rol);
                  foreach ($data as $key) { ?>
                    <div class="panel panel-primary">

                        <div class="panel-heading" style="height: 10vh; display: flex; flex-flow: row nowrap; align-items: center; justify-content: space-between; box-shadow: 0px 20px 5px 5px">

                            <h1 class="" style="font-size: 20px;"><?php echo ($key->area);?></h1>

                            <div class="">
                              <a href="<?= base_url('Areas/viewArea') ?>" style="color:white">
                                  <i class="fas fa-search" style="font-size: 30px" ></i>
                              </a>

                            </div>

                        </div>
                    </div>


                  <?php }?>

                </div>
            </div>
        </div>


    </div>

</div>
