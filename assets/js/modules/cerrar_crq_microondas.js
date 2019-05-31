let lista_regiones       = [];
let lista_estados        = [];
let lista_motivos        = [];
let lista_area_asignadas = [];



$.post(base_url + 'Crq/js_get_listas', {}, function(data) {
    const obj = JSON.parse(data);
    lista_all_subredes   = obj.subredes;
    lista_regiones       = obj.regiones;
    // lista de estados
    lista_estados        = obj.estados;
    lista_motivos        = obj.motivos;
    lista_area_asignadas = obj.areas_asignadas;


});

/****************************Archivo para formulario en lider e ingeniero********************************/
$(function() {
    cerrar_mw = {
        init: function() {
            cerrar_mw.events();
            // cerrar_mw.funcion_cualquiera();

        },

        //Eventos de la ventana.
        events: function() {
            $('#bandejas_seccion').on('click', 'a.cerrar-crq', cerrar_mw.getDatosParaFormulario); // al darle click a opc de tabla
            $('#mdl_cierre_crq').on('change', 'select.llenar_regional', cerrar_mw.llenar_option_red); // llena las opciones de red segun la regional seleccionada
            $('#mdl_cierre_crq').on('change', 'select.llenar_red', cerrar_mw.llenar_option_subred); // llena las opciones de subred segun la red seleccionada
            $('#save_changes').click(cerrar_mw.guardar_cierre_crq)


        },

        // Obtener tabla y los datos para cerrar el crq
        getDatosParaFormulario: function() {

            const row = $(this).parents('tr'); // fila del evento 
            const tabla = row.parents('table'); // tabla del evento
            const table = $('#' + tabla.attr('id')).DataTable(); // objeto de Datatables
            const data = table.row(row).data(); // datos de la fila
            const form = cerrar_mw.form_construct_MW(data);
            $('#mdl_cierre_crq .modal-body').html(''); //limpiar el modal
            $('#mdl_cierre_crq .modal-body').append(form);

            //llenar selects de regional red y sebred si existen
            cerrar_mw.llenar_selects_red();
            cerrar_mw.llenar_selects_estados();
            $('#mdl_cierre_crq .modal-title').html(`Tarea tipo <b>${data.tipo_tarea}</b> del CRQ <b>${data.crq}</b>`);
            $('#mdl_cierre_crq').modal('show');

        },

        // Retornar el formulario para el modal armado
        form_construct_MW: function(data) {
            let form = `<div class="probar" style="
                                border: 1px solid #307095;
                                border-radius: 12px;
                                background: #60a4cc;
                                padding: 12px 0px;"><div class="container m-w-100">
                            <form class="form form-inline" role="form">
                                <input type="hidden" name="crq" id="crq" value="${data.crq}">
                                <input type="hidden" name="id_tipo_tareas" id="id_tipo_tareas" value="${data.id_tipo_tareas}">`;
            // validar si es tarea 56 para anexarle los campos de region
            if (data.tipo_tarea == '56' || (data.tipo_tarea == '48' && data.id_subred != null)) {

                if (data.tipo_tarea == '48') {
                    form += `
                            <div class="form-group col-xs-12 col-sm-6">
                                <label for="regional" class="col-xs-4">Regional</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control input_ex" value="${lista_all_subredes[data.id_subred - 1].regional}" disabled>
                                </div>
                            </div>

                            <div class="form-group col-xs-12 col-sm-6">
                                <label for="red" class="col-xs-4">Red</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control input_ex" value="${lista_all_subredes[data.id_subred - 1].red}" disabled>
                                </div>
                            </div>

                            <div class="form-group col-xs-12 col-sm-6">
                                <label for="id_subred" class="col-xs-4">Subred</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control input_ex" value="${lista_all_subredes[data.id_subred - 1].subred}" disabled>
                                </div>
                            </div> `;


                } else {
                    form += `<div class="form-group col-xs-12 col-sm-6">
                                <label for="regional" class="col-xs-4">Regional</label>
                                <div class="col-xs-8">
                                <select name="regional" id="regional" class="form-control input_ex llenar_regional validar_required">
                
                                </select>
                                </div>
                            </div>

                            <div class="form-group col-xs-12 col-sm-6">
                                <label for="red" class="col-xs-4">Red</label>
                                <div class="col-xs-8">
                                <select name="red" id="red" class="form-control input_ex llenar_red validar_required">
                
                                </select>
                                </div>
                            </div>

                            <div class="form-group col-xs-12 col-sm-6">
                                <label for="id_subred" class="col-xs-4">Subred</label>
                                <div class="col-xs-8">
                                <select name="id_subred" id="id_subred" class="form-control input_ex llenar_subred validar_required">
                
                                </select>
                                </div>
                            </div> `;
                }

            }

            form += `    
                        <div class="form-group col-xs-12 col-sm-6">
                            <label for="estado_tarea" class="col-xs-4">Estado</label>
                            <div class="col-xs-8">
                            <select name="estado_tarea" id="estado_tarea" class="form-control input_ex llenar_estado validar_required">
            
                            </select>
                            </div>
                        </div>

                        <div class="form-group col-xs-12 col-sm-6">
                            <label for="motivo_estado" class="col-xs-4">Motivo Estado</label>
                            <div class="col-xs-8">
                            <select name="motivo_estado" id="motivo_estado" class="form-control input_ex llenar_motivo_estado validar_required">
            
                            </select>
                            </div>
                        </div>

                        <div class="form-group col-xs-12 col-sm-6">
                            <label for="area_asignada" class="col-xs-4">Area Asignada</label>
                            <div class="col-xs-8">
                            <select name="area_asignada" id="area_asignada" class="form-control input_ex llenar_area_asignada">
            
                            </select>
                            </div>
                        </div>
                       </form>
                    </div></div>`;

            return form;
        },

        // llenar los selects de region red y subred
        llenar_selects_red: function() {
            $('.llenar_regional').html('');
            $('.llenar_regional').append('<option value="">SELECCIONE</option>')
            $.each(lista_regiones, function(i, item) {
                $('.llenar_regional').append(`
                    <option value="${item.regional}">${item.regional}</option>
                `)

            });
        },

        // llena las opciones de red segun la regional seleccionada
        llenar_option_red: function() {
            const seleccionado = $(this).val();
            $('.llenar_red').html('');
            $('.llenar_red').append('<option value="">SELECCIONE</option>');
            $.post(base_url + 'Crq/js_get_red_by_region', 
                {
                    region: seleccionado
                }, 
                function(data) {
                    const redes = JSON.parse(data);

                    $.each(redes, function(i, item) {
                        $('.llenar_red').append(`
                        <option value="${item.red}">${item.red}</option>
                    `)
                     });

                }
            );
            $('.llenar_subred').html('');

        },

        // llena las opciones de subred segun la red seleccionada
        llenar_option_subred: function(){
            const seleccionado = $(this).val();
            $('.llenar_subred').html('');
            $('.llenar_subred').append('<option value="">SELECCIONE</option>');
            $.post(base_url + 'Crq/js_get_subred_by_red', 
                {
                    red: seleccionado
                }, 
                function(data) {
                    const subredes = JSON.parse(data);

                    $.each(subredes, function(i, item) {
                        $('.llenar_subred').append(`
                            <option value="${item.id_subred}">${item.subred}</option>
                        `);
                    });

                }
            );
        },

        // llenar los selects de estados
        llenar_selects_estados: function(){
            cerrar_mw.append_generate_status(lista_estados, 'llenar_estado');
            cerrar_mw.append_generate_status(lista_motivos, 'llenar_motivo_estado');
            cerrar_mw.append_generate_status(lista_area_asignadas, 'llenar_area_asignada');
        },

        //
        append_generate_status: function(lista, clase){
            $(`.${clase}`).html('');
            $(`.${clase}`).append('<option value="">SELECCIONE</option>');
            $.each(lista, function(i, item) {
                $(`.${clase}`).append(`
                    <option value="${item.id_lista}">${item.valores}</option>
                `);
            });
        },

        // Guardar cambios de un formulario
        guardar_cierre_crq: function(){
            let bool = helper.validar_inputs_requeridos('mdl_cierre_crq');
            if (!bool) {
                helper.miniAlert('!Estos campos son requeridos¡');
                return;
            }
            const valores = $('#mdl_cierre_crq .form').serializeArray();
            console.log("valores", valores);
            $.post(base_url + 'Crq/js_save_cierre_crq', 
                {
                    data: valores
                }, 
                function(data) {
                    const obj = JSON.parse(data);
                    console.log("obj", obj);
                
            });
            
            
        },

        //
        funcion_cualquiera: function(){
            var objeto = [
                {
                    id_form: 'mi_formulario' ,
                    action: base_url + 'User/algo' ,
                    class_form : 'form  form-inline'
                },
                {
            
                    type: 'text',
                    id: 'item1',
                    name: 'item1',
                    placeholder: 'aca es',
                    label: 'el juan c',


                },
                {
            
                    type: 'date',
                    value: '',
                    class: 'fecha',
                    id: 'item2',
                    name: 'item2',
                    label: 'item2',


                },
                {
            
                    type: 'number',
                    value: '1502',
                    class: '',
                    id: 'item3',
                    name: 'item3',
                    placeholder: '',
                    label: 'item3',
                    disabled: 'true'


                },
                {
            
                    type: 'text',
                    value: '',
                    class: 'xxx',
                    id: 'item4',
                    name: 'item4',
                    placeholder: 'placerrrr',
                    label: 'el label',
                    readonly: 'true'
                },
                {
            
                    type: 'select',
                    class: 'select_clase',
                    id: 'item5',
                    name: 'item5',
                    label: 'mi select',
                },
                {
            
                    type: 'textarea',
                    value: '',
                    class: '',
                    id: 'ta',
                    name: 'ta',
                    label: 'el textarea',
                    placeholder: 'ingrese su texto'
                },
                

            ];


            var form = helper.crear_formulario(objeto);

            $('#id_modal').modal('show')


            $('#prueba').append(form);
        },


    };
    cerrar_mw.init();
});