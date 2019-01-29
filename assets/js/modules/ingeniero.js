$(function () {
    ingeniero = {
    	lista: [],
        switch_total: false,

        init: function (lista) {
        	ingeniero.lista = lista;
            ingeniero.events();
            ingeniero.getListTable_asignadas();
        },

        //Eventos de la ventana.
        events: function () {
        	$('#btn_search_asignadas').click(ingeniero.getListTable_asignadas);
        	$('#pestana_total').click(ingeniero.getTablaTotalEng);
        
        },




        // trae informacion de la tabla asignadas por fecha
        getListTable_asignadas: function() {
            const search_date_asignadas = $('#search_date_asignadas').val();
            $.post(base_url + '/Crq/js_getListTable_asignadas', {
                    fecha : search_date_asignadas
                },
                // función que recibe los datos
                function(data) {
                    // convertir el json a objeto de javascript
                    const obj = JSON.parse(data);
                    ingeniero.printTableAsignadas(obj);
                }
            );
        },

        // trae la informacion para la tabla total
        getListTotalEng: function(){
        	helper.alertLoading('Cargando...','Espere Por Favor', false);
            $.post(base_url + 'Crq/js_getListTotal', 
            	{}, 
            	function(data) {
            		const obj = JSON.parse(data);
            		ingeniero.printTableTotalEng(obj.total);
           		}
            );
        },



        // Pintar tabla asignadas, destruirla y construirla si ya existe
        printTableAsignadas: function(data){
        	if (ingeniero.tabla_asignadas) {
                var tabla = ingeniero.tabla_asignadas;
                tabla.clear().draw();
                tabla.rows.add(data);
                tabla.columns.adjust().draw();
                return;
            }

            ingeniero.tabla_asignadas = $('#tabla_asignadas').DataTable(helper.configTableSearchColumn(data, [
                {title: "CRQ", data: "crq"},
                {title: "Tipo", data: "tipo_tarea"},
                {title: "Info Ejecución", data: "info_ejecucion"},
                // {title: "Fecha Asignación", data: "fecha_asignacion"},
                {title: "Solicitante Remedy", data: "solicitante_remedy"},
                {title: "Subred", data: "subred"},
                {title: "Fecha último Seguimiento", data: "fecha_ultimo_seguimiento"},
                {title: "estado", data:  function(obj){ return (ingeniero.lista[obj.estado_tarea])? ingeniero.lista[obj.estado_tarea] : '';  }},
                {title: "Motivo", data:  function(obj){ return (ingeniero.lista[obj.motivo_estado]) ? ingeniero.lista[obj.motivo_estado] : ''; }},
                // {title: "Ingeniero BO TX", data: "ingeniero"},
                {title: "Area Asignada", data: function(obj){ return (ingeniero.lista[obj.area_asignada]) ? ingeniero.lista[obj.area_asignada] : ''; }},
            ], 'tabla_asignadas', '', '', ''));

            
        },


        // Pinta la tabla de total
        printTableTotalEng: function(data){
            ingeniero.tabla_total = $('#tabla_total').DataTable(helper.configTableSearchColumn(data, [
                {title: "CRQ", data: "crq"},
                {title: "Tipo", data: "tipo_tarea"},
                {title: "Info Ejecución", data: "info_ejecucion"},
                {title: "Fecha Asignación", data: "fecha_asignacion"},
                {title: "Solicitante Remedy", data: "solicitante_remedy"},
                {title: "Subred", data: "subred"},
                {title: "Fecha ültimo Seguimiento", data: "fecha_ultimo_seguimiento"},
                {title: "estado", data:  function(obj){ return (ingeniero.lista[obj.estado_tarea])? ingeniero.lista[obj.estado_tarea] : '';  }},
                {title: "Motivo", data:  function(obj){ return (ingeniero.lista[obj.motivo_estado]) ? ingeniero.lista[obj.motivo_estado] : ''; }},
                {title: "Ingeniero BO TX", data: "ingeniero"},
                {title: "Area Asignada", data: function(obj){ return (ingeniero.lista[obj.area_asignada]) ? ingeniero.lista[obj.area_asignada] : ''; }},
            ], 'tabla_total', '', '', ''));
            swal.close();
        },

        // funciones para pintar la tabla de total
        getTablaTotalEng: function(){
        	if (!ingeniero.switch_total) {
            	ingeniero.getListTotalEng();
        		ingeniero.switch_total = true;
        	}
        },






    };
    $.post(base_url + 'Crq/js_getOptionList', {}, function(data) {
		const obj = JSON.parse(data);
	    ingeniero.init(obj);
    });
});