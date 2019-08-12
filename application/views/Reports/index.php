<link rel="stylesheet" href="<?= base_url("assets/css/bitacoras_new-style.css") ?>">
<div class="main-title" style="width: 60%;">
  BackOffice
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
                    <label class="form-label" for="fDesde"><b>Fecha Inicial</b></label>
                    <input type="date" id="fDesde" value="<?= $f_actual ?>" class="form-input required-field">
                    <!-- <label class="form-label" for="ticket">Fecha Inicial</label>
                    <input id="ticket" class="form-input required-field" type="text" /> -->
                    </div>
                </div>
                <div class="col-md-6 col-body">
                    <div class="form-group">
                    <label class="form-label" for="fHasta"><b>Fecha Final</b></label>
                    <input type="date" id="fHasta" value="<?= $f_actual ?>" class="form-input required-field">
                    <!-- <label class="form-label" for="ticket">Fecha Final</label>
                    <input id="ticket" class="form-input required-field" type="text" /> -->
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-body">
                <div class="form-group">
                <label class="form-label" for="rutaDesactializadaRD">Reporte</label>
                    <select id="selection" class="form-input required-field" type="text">
                    <option></option>
                    <option value="0">Control Tickets</option>
                    <option value="1">Alarmas</option>
                    <option value="2">Incidentes Fija</option>
                    <!-- <option value="3">Tiempos NOC</option> -->
                    <option value="4">Tiempos Fija</option>
                    <option value="5">Workinfo</option>
                    <option value="6">Alarmas Automatismo</option>
                    <option value="7">Tareas FO Performance</option>
                    <option value="8">Tiempo Atención</option>
                    <option value="9">Gestión Performance</option>
                    <option value="10">Cambio Ventanas Mantenimiento</option>
                    <option value="11">Incidentes Cerrados</option>
                </select>
                </div>
            </div>
            <div class="col-md-12 col-body">
                <div class="wrap" style="margin: auto;">
                    <button id="reportButton"  type="submit">Consultar</button>
                    <img src="https://www.dropbox.com/s/qfu4871umzhlcfo/check_arrow_2.svg?dl=1" alt="">
                    <svg width="66px" height="66px">
                    <circle class="circle_2" stroke-position="outside" stroke-width="3" fill="none" cx="34" cy="33" r="29" stroke="#1ECD97"></circle>
                    </svg>
                </div>
            </div>

        </div>
    </div>
    

</div>






<!-- 
<div class="row datesRange">
    <div class="col-sm-3 col-sm-offset-3">
        <label for="fDesde"><b>Fecha Inicio</b></label>
        <input type="date" id="fDesde" value="<?= $f_actual ?>" class="form-control">
    </div>
    <div class="col-sm-3">
        <label for="fHasta"><b>Fecha Fin</b></label>
        <input type="date" id="fHasta" value="<?= $f_actual ?>" class="form-control">
    </div>
    <div class="row col-sm-12" style="display: flex; justify-content: center;">
        <div class="col-sm-6">
            <label for="fHasta"><b>Reporte</b></label>
            <select class="form-control" name="" id="selection">
                <option value="0">Control Tickets</option>
                <option value="1">Alarmas</option>
                <option value="2">Incidentes Fija</option>
                 <option value="3">Tiempos NOC</option> -->
                <!-- <option value="4">Tiempos Fija</option>
                <option value="5">Workinfo</option>
                <option value="6">Alarmas Automatismo</option>
                <option value="7">Tareas FO Performance</option>
                <option value="8">Tiempo Atención</option>
                <option value="9">Gestión Performance</option>
            </select>
           
        </div>
    </div>

    <div class="col-sm-12" style="margin-top:1em;">
        <button id="reportButton" class="btn-cami_cool">Descargar</button>
    </div>
</div> --> -->

<script type="text/javascript" src="<?= base_url('assets/js/modules/generalReport.js'); ?>"></script>


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

        input:disabled {
            background-color: white !important;;
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
        li.paginate_button + .paginate_button {
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
<script src="<?= base_url("assets/js/backoffice.js?v" . validarEnProduccion())?>"></script>
