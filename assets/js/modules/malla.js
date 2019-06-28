$(function(){

  $( ".draggable" ).draggable();
    var ids = 0;
    function eventos_externos(){
      $('#external-events .fc-event').each(function() {
        ids++;
        // store data so the calendar knows to render an event upon drop
        $(this).data('event', {
          textColor: '#000',
          color: $.trim($(this).data('color')),
          id: ids,
          title: $.trim($(this).text()), // use the element's text as the event title
          stick: true // maintain when user navigates (see docs on the renderEvent method)
        });
        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex: 999,
          revert: true,      // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        });
      });
    }
    eventos_externos();



    initThemeChooser({
      init: function(themeSystem) {
        $('#calendar').fullCalendar({
        	schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
          // now: '2018-08-05', // FECHA DONDE SE VA A POSICIONAR AL CARGARSE EL DOCUMENTO
          // lang: 'es',
          height: 513,
          editable: true,
          aspectRatio: 1,
          droppable: true,
          scrollTime: '00:00',
          customButtons: {

            boton_prueba:{
              text: 'Guardar este mes',
              click: save_events_calendar,
            }
          },
          header: {
            left: 'prev,next boton_prueba',
            center: 'title',
            right: 'today'
          },
          selectable: true,
          defaultView: 'timelineMonth',
          resourceLabelText: 'Nombre Ingeniero',
          resources: ingenieros,
          eventSources: [

            // your event source SERVER SIDE
            {
              url: base_url + '/Malla/getEventsCalendar', // use the `url` property
              // color: 'yellow',    // an option!
              textColor: '#000',  // an option!
              type: 'POST',
              error: function() {
                helper.miniAlert('Error al cargar los eventos' , 'error');
              },
            }

            // any other sources...

          ],

          // Agreagar manualmente el listado de las personas
          /*[
            { id: 'a', title: 'Ingeniero A'},
            { id: 'b', title: 'Ingeniero B'},
            { id: 'c', title: 'Ingeniero C'}
          ],*/
          // se agran los eventos manualmente
          // events: [
          //   { id: '1', resourceId: '63556518', start: '2018-08-05T02:00:00', end: '2018-08-08T07:00:00', title: 'event 1' },
          //   { id: '2', resourceId: '56771859', start: '2018-08-05T05:00:00', end: '2018-08-10T22:00:00', title: 'event 2' },
          //   { id: '3', resourceId: '1013589386 ', start: '2018-08-05T02:00:00', end: '2018-08-06T22:00:00', title: 'event 3' },
          // ],

          // ********************FUNCIONES DE EVENTOS********************
          // al darle click a la celda (dia)
          dayClick: function(date, jsEvent, view, resource) {
            // alert('clicked ' + date.format() + ' on resource ' + resource.title);
          },
          // cuando se seleccionan varias celdas con espacio vacio  arrastrando
          select: function(startDate, endDate, jsEvent, view, resource) {
            // alert('desde ' + startDate.format() + ' hasta ' + endDate.format() + ' on resource ' + resource.title);
            // alert('nose' + jsEvent.title);
          },
          // al darle click al evento
          eventClick: function(event, jsEvent, view){
            // var inicio = new Date(event.start);
            // console.log("inicio", inicio);
            // var fin = new Date(event.end);
            // console.log("fin", fin);
          },
          // al arrastrar un evento externo al calendario
          drop: function(date, jsEvent, ui, resourceId) {
            // console.log($('#calendar').getEventSource);
            // $.post(base_url + 'Malla/insert_event_drop',
            //   {
            //     fecha: date.format(),
            //     idUser: resourceId,
            //     franja: jsEvent.target.dataset.franja
            //   },
            //   function(data) {
            //     console.log("drop", data);
            // });

            eventos_externos();
            // evento externo no se regenera
            if ($('#drop-remove').is(':checked')) {
              // if so, remove the element from the "Draggable Events" list
              $(this).remove();
            }
          },
          // aparentemente igual a la funcion drop
          eventReceive: function(event) { // called when a proper external event is dropped
          },
          // al mover algo en el calendario
          eventDrop: function(event) { // called when an event (already on the calendar) is moved
          },
          // al soltar un evento que se está moviendo
          eventDragStop: function(event,jsEvent) {
            //para calcular la coordenada donde se suelta el evento (papelera7 borrar)
            if( (1179 <= jsEvent.pageX) && (jsEvent.pageX <= 1326) && (354 <= jsEvent.pageY) && (jsEvent.pageY <= 420) ){
              $('#calendar').fullCalendar('removeEvents', event.id);
            }
          }
        });
        },
        // al cambiar el tema
        change: function(themeSystem) {
          $('#calendar').fullCalendar('option', 'themeSystem', themeSystem);
        }
    });

    // EVENTO DEL MENU STICKY
 	  $('#btn_fixed').on('click', function () {
        $(this).hide();
        $('#content_fixed').removeClass('closed');
        $('#content_fixed #menu_fixed').removeClass('hidden').hide().fadeIn(500);
    });
    $('#btn_close_fixed').on('click', function () {
        $('#content_fixed').addClass('closed');
        $('#content_fixed #menu_fixed').hide();
        $('#btn_fixed').fadeIn(500);
    });

    // evento de añadir nuevo horario
    $('#btn_add_horario').click(function(event) {
        swal({
          title: 'Nuevo horario',
          html: `
            <div class="form_in_box">
              <!--*********************  INPUT DATE  *********************-->
              <div class="form-group">
                <label for="hora_inicial" class="col-md-4 control-label">Hora Inicial: &nbsp;</label>
                <div class="col-md-8 selectContainer">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    <input type="time" name="hora_inicial" id="hora_inicial" value="08:00" class="form-control">
                  </div>
                </div>
              </div>

              <!--*********************  INPUT DATE  *********************-->
              <div class="form-group">
                <label for="hora_final" class="col-md-4 control-label">Hora Final: &nbsp;</label>
                <div class="col-md-8 selectContainer">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    <input type="time" name="hora_final" id="hora_final" value="16:00" class="form-control">
                  </div>
                </div>
              </div>
            </div>
          `,
          customClass: 'swal-md',
          type: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Guardar'
        }).then((result) => {
          if (result.value) {
            const inicial = $('#hora_inicial').val();
            const final = $('#hora_final').val();
            $('#malla_adicional').append(`
              <span><div class='fc-event' data-color="#656565" data-franja="${inicial}-${final}" data-duration="120:00">${inicial}-${final}</div></span>
            `);
            eventos_externos();
          } else {
            helper.miniAlert();
          }
        })

    });


    function save_events_calendar(){
        if (role_in_session == 'lider') {
          const date            = $('#calendar').fullCalendar('getDate');
          const mes_en_pantalla = date._i[1];
          const ano             = date._i[0];
          const eventos         = $('#calendar').fullCalendar('clientEvents');
          let obj_eventos       = {};
          let j = 0;
          // let mas_temp = (mes_actual)

          if (eventos.length > 0) {

             $.each(eventos, function(i, evento) {


                evento.start._d = helper.sumar_o_restar_dias_a_fecha(`${evento.start._d.getFullYear()}-${evento.start._d.getMonth() + 1}-${evento.start._d.getDate()}`);
                if (evento.start._d.getMonth() == ((mes_en_pantalla == 0) ? 11 : mes_en_pantalla -1)  && evento.end._d.getMonth() == mes_en_pantalla) {
                  evento.start._d = new Date(ano, mes_en_pantalla, 1);
                }

                	// si el evento fin el nulo le asignamos el mismo de inicio asumiendo que es solo el caso de un evento de un dia
                	if (evento.end == null) {
                		evento.end = evento.start;
                	}

                if (evento.start._d.getMonth() == mes_en_pantalla && evento.end._d.getMonth() == ((mes_en_pantalla == 11)? 0 : mes_en_pantalla +1)) {
                  evento.end._d = new Date(helper.sumar_o_restar_dias_a_fecha(`${ano}-${mes_en_pantalla + 2}-01`, -1));
                }

                if (evento.start._d.getMonth() == mes_en_pantalla) {
                    obj_eventos[j] = {
                      inicio: helper.formatDate(eventos[i].start._d),
                      fin: helper.formatDate(eventos[i].end._d),
                      id_user: eventos[i].resourceId,
                      franja: eventos[i].title
                    };
                    j++;
                }
            });

             swal({
                title: 'Por favor!',
                html: `<h4>No cierre ni actualice esta ventana hasta que termine el proceso</h4>
                 <img src="${base_url}/assets/images/cargando.gif" alt="" />
                `,
                onOpen: () => {
                    swal.showLoading();
                },
                allowOutsideClick: false // al darle clic fuera se cierra el alert
            });



            $.post(base_url + 'Malla/save_calendar',
                {
                  eventos: obj_eventos,
                  mes: mes_en_pantalla + 1,
                  ano: ano
                },
                function(data) {

                  const obj = JSON.parse(data);
                  if (!obj.length > 0) {
                    swal('Good job!', 'Malla actualizada', 'success');
                  } else {
                    let errores = obj.join('.<br>');
                    swal('Warning', 'existieron errores en el proceso:<br><pre>' + errores +'</pre>' , 'warning');
                  }
              });

          } else {
            helper.miniAlert('No existe ningun evento en el calendario', 'error');
          }

        } else {
            helper.miniAlert('No tienes permisos para editar la malla', 'info')
        }






    }









  });
