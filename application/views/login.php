<!DOCTYPE html>
<html >
    <head>
        <meta charset="UTF-8">
        <title>ZOLID ON AIR LOGIN</title>
        <!--   ICONO PAGINA    -->
        <link rel="icon" href="<?= base_url('assets/images/title_icon.png'); ?>">
        <link rel="stylesheet" href="<?= base_url('assets/plugins/sweetalert-master/dist/sweetalert.css'); ?>" />
        <link rel="stylesheet" href="<?= base_url('assets/css/login/reset.min.css'); ?>" />
        <link rel="stylesheet" href="<?= base_url('assets/css/login/stylelogin.css'); ?>">
        <script type="text/javascript" src="<?= base_url('assets/plugins/jquery/jquery.min.js'); ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/plugins/sweetalert-master/dist/sweetalert.min.js'); ?>"></script>
        <script type="text/javascript" charset="utf-8" async defer>
            //Funcion para mostrar mensaje de error de validacion de datos
            function showMessage() {
                swal({
                    title: "Error de autentificación!",
                    text: "Por favor verificar los datos",
                    type: "error",
                    confirmButtonText: "Ok"
                });
            }
        </script>
    </head>
    <body>
        <div id="warp">
            <H2></H2>
            <form id="formu" method="post">
                <div class="admin">
                    <div class="rota">
                        <h1>ZOLID</h1>
                        <input id="id_usuario" type="number" name="username" value="" placeholder="# Identificación" required/><br/>
                        <input id="password" type="password" name="contrasena" value="" placeholder="Password" required/>
                         
                    </div>
                </div>
                <div class="cms">
                    <div class="roti">
                        <h1>ZTE</h1>
                        <button type="submit" class="button" id="valid" name="valid" onclick = "this.form.action = '<?= base_url('User/validate_credentials'); ?>'">Login</button><br />

             <p><a href="#">ZTE</a> <a>And</a> <a href="#">ZTE Colombia</a></p>

                    </div>
                </div>
            </form>
        </div>

        <?php
        if (isset($error)) {
            echo '<script type="text/javascript">showMessage();</script>';
        }
        ?>
        <?php

           $msj = $this->session->flashdata('msj');
           // print_r($msj);
           // if ($msj == 'ok') {

           //     echo "se creo correctamente ";
           // }else{
           //  echo "no se creo ";
           // }
         ?>
        <!--   ANIMACION DE LOGIN   -->
        <script src="<?= base_url('assets/js/login.js'); ?>"></script>
    </body>
</html>
