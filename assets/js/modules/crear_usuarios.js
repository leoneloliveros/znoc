$(function () {
    usuario = {
        init: function () {
            usuario.events();
            usuario.loadAreasToCharge();
            helper.hideLoading();
        },

        events: function () {
            $('#newUser').click(usuario.validateData);
            $('#deleteUser').click(usuario.deleteUser);
            $('#area').change(usuario.loadRolesByArea);
            $("#id_users").on('blur', usuario.validateCedula);
        },

        validateData: function () {
            $(".err").removeClass("err");
            const campos = $("div.frame input,div.frame select, div.frame textarea");
            var vacios = [];
            var data = {};
            $.each(campos, function (i, element) {
                if ($(element).prop("type") != "checkbox") {
                    if ($(element).val() == null || $(element).val() == '' || $(element).val() == ' ' || $(element).val() == '  ') {
                        vacios.push($(element).attr("id"));
                    } else {
                        data[$(element).attr("id")] = $(element).val();
                    }
                }

            });
//            console.log(data);
            if (vacios.length != 0) {
                $.each(vacios, function (i, id) {
                    $(`#${id}`).addClass('err');
                });
                swal({
                    "html": "¡No puede dejar los campo en rojo vacios!",
                    "type": "error"
                });
//                console.log("vacios", vacios);

            } else {
                usuario.saveNewUser(data);
            }

        },

        saveNewUser: function (bitacora) {
            $.post(base_url + "User/c_saveUser", {data: JSON.stringify(bitacora)},
                    function (bool) {
                        let msj = '';
                        if (bool) {
                            msj = ['Usuario creado corectamente.', 'success'];
                        } else {
                            msj = ['Hubo un error inesperado.', 'error'];
                        }

                        swal({
                            "html": msj[0],
                            "type": msj[1]
                        }).then(() => {
                            location.reload();
                        });

                    }
            );
        },

        loadAreasToCharge: function () {
          helper.showLoading();

            $.post(base_url + "User/c_getAreasToCharge", {
                //parametros
            },
                    function (data) {
                        const obj = JSON.parse(data);

                        $.each(obj, function (i, val) {
                            $('#area').append('<option value="' + val.area + '">' + val.texto + '</option>');
                        });


                    }
            );

        },

        loadRolesByArea: function () {
            helper.showLoading();

            $('#role option').each(function () {
                if ($(this).val() != '') {
                    $(this).remove();
                }
            });

            $.post(base_url + "User/c_getRolesByArea", {
                area: $('#area').val(),
            },
                    function (data) {
                        const obj = JSON.parse(data);

                        $.each(obj, function (i, val) {
                            $('#role').append('<option value="' + val.id + '">' + val.name + '</option>');
                        });

                           helper.hideLoading();
                    }
            );

            helper.hideLoading();
        },

        validateCedula: function () {
            helper.showLoading();

            $.post(base_url + "User/c_validateCedula", {
                id_user: $('#id_users').val()
            },
                    function (data) {
                        const obj = JSON.parse(data);

                        if (obj.length == 1) {
//                            console.log(obj[0]);
                            $('#nombres').val(obj[0].nombres);
                            $('#apellidos').val(obj[0].apellidos);
                            $('#email').val(obj[0].email);
                            $('#num_contacto').val(obj[0].num_contacto);
                            $('#contrasena').val(obj[0].contrasena);
                            $('#imagen').val(obj[0].imagen);
                            $('#action').val('update');
                            $('#deleteUser').css("display", "inline");
                        } else {
                            $('#nombres').val('');
                            $('#apellidos').val('');
                            $('#email').val('');
                            $('#num_contacto').val('');
                            $('#contrasena').val('abc123');
                            $('#imagen').val('default');
                            $('#action').val('insert');
                            $('#deleteUser').css("display", "none");
                        }

                    }
            );

            helper.hideLoading();
        },

        deleteUser: function () {
            $.post(base_url + "User/c_deleteUser", {
                id_user: $('#id_users').val()
            },
                    function (bool) {
                        let msj = '';
                        if (bool) {
                            msj = ['Usuario eliminado corectamente.', 'success'];
                        } else {
                            msj = ['Hubo un error inesperado.', 'error'];
                        }

                        swal({
                            "html": msj[0],
                            "type": msj[1]
                        }).then(() => {
                            location.reload();
                        });

                    }
            );
        },

    }
    usuario.init();
});
