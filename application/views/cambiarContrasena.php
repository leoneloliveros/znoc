<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/login/estilosCContrasena.css'); ?>">
    <title>Cambiar Contaseña</title>
    <link rel="icon" href="<?= base_url('assets/images/title_icon.png'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/sweetalert-master/dist/sweetalert.css'); ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/plugins/bootstrap/css/bootstrap.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/plugins/font-awesome/css/font-awesome.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/plugins/font-awesome/css/font-awesome.min.css') ?>" />
    <script type="text/javascript" src="<?= base_url('assets/plugins/jquery/jquery.min.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/plugins/sweetalert-master/dist/sweetalert.min.js'); ?>"></script>
</head>

<body>
    <div class="contenedor">
        <div class="encabezado">
            <h3> <?= strtoupper($usuario->role) . ' ' . $usuario->nombres . ' ' . $usuario->apellidos ?></h3>
        </div>
        <div class="fomulario">
            <form action="CambioContra" onsubmit="return validacion()" method="POST">
                <div class="col-sm-12" style="padding:unset">
                    <input type="password" placeholder="New Password" id="inpUno" name="inpUno">
                    <span class="showPass"><i class="fa fa-eye" aria-hidden="true"></i></span>
                </div>
                <div class="col-sm-12" style="padding:unset">
                    <input type="password" placeholder="Confirm New Password" id="inpDos" name="inputDos">
                    <span class="showPass"><i class="fa fa-eye" aria-hidden="true"></i></span>
                </div>
                <input type="submit" value="Cambiar Contraseña">
                <input type="hidden" name="id" value="<?= $usuario->id_users ?>">
                <p id="recom"><b> RECOMENDACIÓN: </b> Clave mínimo de 8 caracteres, el uso de numeros y mayusculas hara su contraseña mas segura.</p>
            </form>
        </div>
        <div class="parrafos">
            <p><b>Se requiere un cambio de contraseña</b> Para poder usar la aplicación, primero debe cambiar su contraseña por defecto., se le recomienda una contraseña segura para cuidar la integridad suya y la de la empresa.</p>
            <!-- <p><b>Cambio de contraseña OBLIGATORIO</b>, si no cambia la contraseña no podrá ingresar a la plataforma, se le recomienda una contraseña segura para cuidar la integridad suya y la de la empresa.</p> -->
        </div>
        <!-- <div class="alerts">
            <p>Si ya hiciste el cambio de contraseña por favor ignora este formulario y vuelve a la pagina de inicio. </p>
        </div> -->
    </div>
    <script>
        var f = true;
        $('.showPass').click(function() {
            var input = $(this).siblings();
            if (f) {
                input.attr('type', 'text');
                $(this).children().removeClass('fa-eye');
                $(this).children().addClass('fa-eye-slash');
                f = false;
            } else {
                input.attr('type', 'password');
                $(this).children().removeClass('fa-eye-slash');
                $(this).children().addClass('fa-eye');
                f = true;
            }

        });

        function validacion(e) {
            let inpUno = document.getElementById('inpUno').value;
            let inpDos = document.getElementById('inpDos').value;

            if ((inpUno == null || inpUno == "") || (inpDos == null || inpDos == "")) {
                swal({
                    title: "Error de autentificación!",
                    text: "Dejaste campos sin llenar",
                    type: "error",
                    confirmButtonText: "Ok"
                });
                return false;
            }
            if (inpUno != inpDos) {
                swal({
                    title: "Error de autentificación!",
                    text: "Verifica que hayas escrito la misma contraseña en los dos campos",
                    type: "error",
                    confirmButtonText: "Ok"
                });
                return false;
            }
            if (inpUno.length <= 7) {
                swal({
                    title: "Error de autentificación!",
                    text: "Tu contraseña debe tener mas de 7 caracteres",
                    type: "error",
                    confirmButtonText: "Ok"
                });

                return false;
            }
            return true;
        }
    </script>
</body>

</html>