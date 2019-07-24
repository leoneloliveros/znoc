<link rel="stylesheet" href="<?= base_url("assets/css/bitacoras_new-style.css") ?>">
<div class="main-title" style="width: 60%;">
    <span>
    Control KPI
    </span>
    <span id='subtitle'>
    <i class="fas fa-code-branch"></i> Front Office Movil
    </span>
  
</div>

<div style="display:flex; justify-content: center;">
    <div class="card-style">
        <div class="general">
            <div class="switch-container col-md-12 position-relative form-group">
                <label class="switch">
                <input type="checkbox" class="form-check-input">
                <span class="slider round"></span>
                </label>
                <span class="checkbox-initial">
                    Solo Fecha de Inicio
                </span>

            </div>
            <div>
                <div class="col-md-6 col-body">
                    <div class="form-group">
                    <label class="form-label" for="ticket">Fecha Inicial</label>
                    <input id="ticket" class="form-input required-field" type="text" />
                    </div>
                </div>
                <div class="col-md-6 col-body">
                    <div class="form-group">
                    <label class="form-label" for="ticket">Fecha Final</label>
                    <input id="ticket" class="form-input required-field" type="text" />
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
    <div class="col-md-9" id="container-result" style="display: flex;"></div>
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
    

    .checkbox-initial {
        position: absolute;
        left: 74px;
        font-size: 17px;
        font-weight: 400;
        top: 2px;
        width: 85%;
        display: flex;
        justify-content: space-between;
    }
    .switch {
        position: relative;
        display: inline-block;
        width: 90px;
        height: 51px;
        margin: 0;
        }

        .switch input { 
        display: none;
        }

        .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #cdcdcd;
        transition: 0.4s;
        width: 54%;
            height: 54%;

        }

        .slider::before {
        position: absolute;
        content: "";
        height: 15px;
        width: 15px;
        left: 6px;
        bottom: 6px;
        background-color: #ffffff;
        transition: 0.4s;
        }

        input:checked + .slider {
        background-color: #4caf50;
        }

        input:focus + .slider {
        box-shadow: 0 0 1px #4caf50;
        }

        input:checked + .slider::before {
        transform: translateX(22px);
        }

        .slider.round {
        border-radius: 34px;
        }

        .slider.round::before {
        border-radius: 50%;
        }





        .wrap {
            top: 17px;
            height: 1px;
        }
        .wrap button{
            background: #1ECD97;
            color: white;
            box-shadow: 0 29px 32px -20px rgba(0,0,0,0.5), 0 4px 11px -3px rgba(0,0,0,0.25);
        }
        .wrap button:hover{
            background: #7e65c0;
            border: 2px solid #7e65c0;
            color: white;
        }
            .card-style{
                min-height: 164px;
                width: 60%;
                display: flex;
            justify-content: center;
            }

        #bitacora_BO_table {
            color: black;
            background: white;
            border: none;
        }

        #bitacora_BO_table_paginate{
            height: 0px;
        }

        li.paginate_button.active {
            display: none;
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
    $('#consult').on('click', function() {
        // $('.container-result').attr('style', 'display: block;')
        // $('#loader').show();
        // $('.spinner-loader').show();
        var url = base_url + 'Bitacoras/cargarBitacoraBO';
        var element = document.getElementById('container-result');
        load(url, element);
        function load(url, element)
        {
            req = new XMLHttpRequest();
            req.open("GET", url, false);
            req.send(null);
            element.innerHTML = req.responseText;
            createDatatable(url);
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


<style>
     body, .content-wrapper, .main-footer {
        background: #24C6DC;  /* fallback for old browsers */
background: -webkit-linear-gradient(to bottom, #514A9D, #24C6DC);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to bottom, #514A9D, #24C6DC); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

    }

    body {
        background: #504b9d;
    }


    .main-footer {
        background: #24c6dc;
    }

    #subtitle {
        font-size: 12px;


    }

    .main-title {
        width: 91% !important;
    display: flex;
    justify-content: space-between;
    align-items: center;
    }

</style>