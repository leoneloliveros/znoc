$(function() {
    lider = {
        init: function() {
            lider.events();
            lider.getListTables();

        },

        lista: [],
        switch_total: false,

        //Eventos de la ventana.
        events: function() {
        	$('#pestana_total').click(lider.getTablaTotal);
        },

        // obener los datos para las tablas
        getListTables: function() {
            //metodo ajax (post)
            $.post(base_url + '/Crq/js_getListTsbles', {
                    //parametros
                },
                // función que recibe los datos
                function(data) {
                    // convertir el json a objeto de javascript
                    const obj = JSON.parse(data);
                    lider.lista = obj.lista;
                    lider.printTableAsignadas(obj.asignadas);
                    lider.printTablePendientes(obj.pendientes);
                }
            );
        },

        // trae la informacion para la tabla total
        getListTotal: function(){
        	helper.alertLoading('Cargando...','Espere Por Favor', false);
            $.post(base_url + 'Crq/js_getListTotal', 
            	{}, 
            	function(data) {
            		const obj = JSON.parse(data);
            		lider.printTableTotal(obj.total);
           		}
            );
        },

        // para pintar la tabla de asignadas
        printTableAsignadas: function(data) {
            lider.tabla_asignadas = $('#tabla_asignadas').DataTable(helper.configTableSearchColumn(data, [
                {title: "CRQ", data: "crq"},
                {title: "Tipo", data: "tipo_tarea"},
                {title: "Info Ejecución", data: "info_ejecucion"},
                {title: "Fecha Asignación", data: "fecha_asignacion"},
                {title: "Solicitante Remedy", data: "solicitante_remedy"},
                {title: "Subred", data: "subred"},
                {title: "Fecha último Seguimiento", data: "fecha_ultimo_seguimiento"},
                {title: "estado", data:  function(obj){ return (lider.lista[obj.estado_tarea])? lider.lista[obj.estado_tarea] : '';  }},
                {title: "Motivo", data:  function(obj){ return (lider.lista[obj.motivo_estado]) ? lider.lista[obj.motivo_estado] : ''; }},
                {title: "Ingeniero BO TX", data: "ingeniero"},
                {title: "Area Asignada", data: function(obj){ return (lider.lista[obj.area_asignada]) ? lider.lista[obj.area_asignada] : ''; }},
            ], 'tabla_asignadas', '', '', ''));
        },

        // pintar la tabla pendientes
        printTablePendientes: function(data){
            lider.tabla_pendientes = $('#tabla_pendientes').DataTable(helper.configTableSearchColumn(data, [
                {title: "CRQ", data: "crq"},
                {title: "Tipo", data: "tipo_tarea"},
                {title: "Info Ejecución", data: "info_ejecucion"},
                {title: "Solicitante Remedy", data: "solicitante_remedy"},
            ], 'tabla_pendientes', '', '', ''));
        },

        // Pinta la tabla de total
        printTableTotal: function(data){
            lider.tabla_total = $('#tabla_total').DataTable(helper.configTableSearchColumn(data, [
                {title: "CRQ", data: "crq"},
                {title: "Tipo", data: "tipo_tarea"},
                {title: "Info Ejecución", data: "info_ejecucion"},
                {title: "Fecha Asignación", data: "fecha_asignacion"},
                {title: "Solicitante Remedy", data: "solicitante_remedy"},
                {title: "Subred", data: "subred"},
                {title: "Fecha ültimo Seguimiento", data: "fecha_ultimo_seguimiento"},
                {title: "estado", data:  function(obj){ return (lider.lista[obj.estado_tarea])? lider.lista[obj.estado_tarea] : '';  }},
                {title: "Motivo", data:  function(obj){ return (lider.lista[obj.motivo_estado]) ? lider.lista[obj.motivo_estado] : ''; }},
                {title: "Ingeniero BO TX", data: "ingeniero"},
                {title: "Area Asignada", data: function(obj){ return (lider.lista[obj.area_asignada]) ? lider.lista[obj.area_asignada] : ''; }},
            ], 'tabla_total', '', '', ''));
            swal.close();
        },


        // funciones para pintar la tabla de total
        getTablaTotal: function(){
        	if (!lider.switch_total) {
            	lider.getListTotal();
        		lider.switch_total = true;
        	}
        },


    };
    lider.init();
});



