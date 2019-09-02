
<div class="main-title" style="width: 60%;">
  BackOffice
</div>

<div style="display:flex; justify-content: center;">
    <div class="card-style w-60">
        <div class="general">
            <div class="switch-container col-md-12 position-relative form-group">
                <label class="switch">
                <input type="checkbox" class="form-check-input">
                <span id="onlyDateInitial" class="slider round"></span>
                </label>
                <span class="checkbox-initial">
                    Solo Fecha de Inicio
                </span>

            </div>
            <div>
                <div class="col-md-6 col-body">
                    <div class="form-group">
                    <label class="form-label" for="fechaInicio">Fecha Inicial</label>
                    <input id="fechaInicio" class="form-input required-field" type="text" />
                    </div>
                </div>
                <div class="col-md-6 col-body">
                    <div class="form-group">
                    <label class="form-label" for="fechaFinal">Fecha Final</label>
                    <input id="fechaFinal" class="form-input required-field" type="text" />
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-body">
                <div class="wrap" style="margin: auto;">
                    <button id="consult" type="submit">Consultar</button>
                    <img src="https://www.dropbox.com/s/qfu4871umzhlcfo/check_arrow_2.svg?dl=1" alt="">
                    <svg width="66px" height="66px">
                    <circle class="circle_2" stroke-position="outside" stroke-width="3" fill="none" cx="34" cy="33" r="29" stroke="#1ECD97"></circle>
                    </svg>
                </div>
            </div>

        </div>
    </div>


</div>
<div class="row" style="display: flex; width: 100%; align-items: center;">

    <div class="col-md-9" id="container-result" style="display: flex;">

    </div>
    <div class="col-md-3" id="container-graph" style="min-width: 310px; max-width: 600px; margin: 0 auto"></div>

</div>


</div>
<!-- <div id="container-graph" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div> -->
<style>
    #container-result {
        /* display: none; */
        /* min-height: 500px; */
        height: auto;
        margin-top: 30px;
    }
    @media only screen and (max-width: 767px)  {
       .contenedorMaestro {
        margin-top: 80px;
       }
    }

    .main-footer a {
        color:white;
        font-weight: bold;
    }




        #bitacora_BO_table {
            color: black;
            background: white;
            border: none;
        }

        #bitacora_BO_table_paginate{
            height: 0px;
        }

        /* li.paginate_button.active, li.paginate_button.active + .paginate_button, li.paginate_button.active - .paginate_button {
            display: none;
        } */
        .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
            z-index: 3;
            color: #fff;
            cursor: default;
            background-color: #8262c3;
            border-color: #8262c3;
        }
        #bitacora_BO_table_next{
            display: block;
            position: absolute;
            top: 50%;
            right: -3%;
            box-shadow: 0 29px 32px -20px rgba(0,0,0,0.5), 0 4px 11px -3px rgba(0,0,0,0.25);
        }
        #bitacora_BO_table_previous{
            display: block;
            position: absolute;
            top: 50%;
            left: -3%;
            box-shadow: 0 29px 32px -20px rgba(0,0,0,0.5), 0 4px 11px -3px rgba(0,0,0,0.25);
}
        }
</style>
<script type="text/javascript" src="<?= base_url('assets/plugins/hightchart/code/highcharts.js');?>"></script>
<script>
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
$(function(){
setInterval(test, 1000);
});



// };


    $('#consult').on('click', function() {
        $('#loader').show();
        $('.spinner-loader').show();
        var fechaInicio = $('#fechaInicio').val();
        var fechaFinal = $('#fechaFinal').val();

        var url = base_url + 'Bitacoras/cargarBitacoraBO' + '/' + moment(fechaInicio, 'DD/MM/YYYY').format('YYYY-MM-DD') + '/' + moment(fechaFinal, 'DD/MM/YYYY').format('YYYY-MM-DD') ;
        var element = document.getElementById('container-result');
        load(url, element);
        function load(url, element)
        {
            req = new XMLHttpRequest();
            req.open("GET", url, false);
            req.send(null);
            element.innerHTML = req.responseText;
            createDatatable(url);
            $('#loader').hide();
            $('.spinner-loader').hide();
        }

        function createDatatable(link) {
            erTable_bitacora_BO_table = $("#bitacora_BO_table").DataTable({
                processing: true,
                serverSide: true,
                "searching": false,
                dom: 'frtip',
                select: true,
                "oLanguage": {
                "oPaginate": {
                    "sPrevious": "<i class='fas fa-backward'></i>", // This is the link to the previous page
                    "sNext": "<i class='fas fa-forward'></i>", // This is the link to the next page
                }
            },
                searchDelay: 500,
                autoWidth: false,
                ajax: {
                    url: link,
                    type: "POST",
                    data: function (d, dt) {
                    d.dt_name = "bitacora_BO_table"
                    }
                },
            });
        }



        Highcharts.chart('container-graph', {
    chart: {
        // plotBackgroundColor: null,
        plotBorderWidth: null,
        backgroundColor: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Estadísticas de bitácoras de Ingenieros'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            }
        }
    },
    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: [{
            name: 'Chrome',
            y: 61.41,
            sliced: true,
            selected: true
        }, {
            name: 'Internet Explorer',
            y: 11.84
        }, {
            name: 'Firefox',
            y: 10.85
        }, {
            name: 'Edge',
            y: 4.67
        }, {
            name: 'Safari',
            y: 4.18
        }, {
            name: 'Sogou Explorer',
            y: 1.64
        }, {
            name: 'Opera',
            y: 1.6
        }, {
            name: 'QQ',
            y: 1.2
        }, {
            name: 'Other',
            y: 2.61
        }]
    }]
});

    });




</script>
<script src="<?= base_url("assets/js/backoffice.js?v" . validarEnProduccion())?>"></script>
