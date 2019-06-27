<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Malla extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('data/Dao_user_model');
    		$this->load->model('data/Dao_malla_model');
    		$this->load->helper('camilo');
    }
    public function index()
    {

      $data = array(
          'active_sidebar' => false,
          'title'          => 'Malla',
          'active'         => "Malla",
          'header'         => array('Malla',''),
          'sub_bar'        => true,
          'f_actual'       => date('Y-m-d')
      );
      $ingenieros['ingenieros'] = $this->Dao_user_model->getEngineers();
      $this->load->view('parts/header', $data);
      $this->load->view('malla',$ingenieros);
      $this->load->view('parts/footer');

    }
    // Insertar evento de malla a base de datos
public function insert_event_drop(){
  $fecha = new DateTime($this->input->post('fecha'));
  $idUser = $this->input->post('idUser');
  $franja = $this->input->post('franja');
  $dia = $fecha->format('d');
  $mes = $fecha->format('m');
  $ano = $fecha->format('Y');
  $hasta = ($dia + 4 >  cal_days_in_month(CAL_GREGORIAN, $mes, $ano)) ? cal_days_in_month(CAL_GREGORIAN, $mes, $ano): $dia + 4;
  $res = '';
  $columna = '';
  $this->crear_sino_existe($idUser, $mes, $ano);
  // actualizar calendario
  for ($i=$dia; $i <= $hasta; $i++) {
    $columna ='`' . substr("0". $i, -2) . '`';;
    $up = $this->Dao_malla_model->update_event(array($columna => $franja), array('id_usuario' => $idUser, 'mes' => $mes, 'ano' => $ano));
    $res .= ($up==1)? '' : $up ;
  }
  echo json_encode($res);

}

// verifica si un registro ya existe, si existe retorna 1 sino 0
private function crear_sino_existe($idUser, $mes, $ano){
  // verificar si ya exite uel registro de ese usuario para esa fecha
  $existe = $this->Dao_malla_model->getRegister($idUser, $mes, $ano);
  if ($existe == 0) {
    $insert = $this->Dao_malla_model->insert_event(array('mes' => $mes, 'ano' => $ano,'id_usuario' => $idUser));
  }
}

//
public function save_calendar(){

  // limpiar el calendario en el mes y año donde dio guardar
  $this->Dao_malla_model->delete_malla(array('ano'=> $this->input->post('ano'), 'mes'=>$this->input->post('mes')));

  $eventos = $this->input->post('eventos');
  $hasta = count($eventos);
  // recorrer los eventos del calendario
  for ($i=0; $i < $hasta ; $i++) {
    $objDate = new DateTime($eventos[$i]['inicio']);
    $mes = $objDate->format('m');
    $ano = $objDate->format('Y');
    $this->crear_sino_existe($eventos[$i]['id_user'] , $mes, $ano);
    // actualizar los eventos del los dias
    $response = $this->actualizar_dias($eventos[$i]['id_user'], $eventos[$i]['inicio'], $eventos[$i]['fin'], $mes, $ano, $eventos[$i]['franja']);

  }

  echo json_encode($response);

}

// Actualiza la bd malla recorriendo los dias que hay entre fechas
private function actualizar_dias($user, $fi, $ff, $mes, $ano, $franja){
  $response = [];
  $fi = new DateTime($fi);
  $ff = new DateTime($ff);

  $fecha_base = $fi;
  // recorrer los dias entre fechas
  while ($fecha_base <= $ff) {
    $columna = '`' . $fecha_base->format('d') . '`';
    $up = $this->Dao_malla_model->update_event(array($columna => $franja), array('id_usuario' => $user, 'mes' => $mes, 'ano' => $ano));

    ($up != 1) ? array_push($response, $up) :'';
    $fecha_base = new DateTime(sumarORestarDiasAFecha($fecha_base->format('Y-m-d'), 1, '+'));
  }

  return $response;


}

// retorna eventos SERVERSIDE
public function getEventsCalendar(){

  // print_r($this->input->post('start'));

  $ini = new DateTime($this->input->post('start'));
  $ano = $ini->format('Y');
  $mes = $ini->format('m');

  $eventos = $this->Dao_malla_model->get_events_by_month(array('ano' => $ano, 'mes' => $mes));
  $hasta = count($eventos);
  $p = 0;
  $id = 999999999;
  $retorno = [];

  for ($i=0; $i < $hasta; $i++) {
    //recorrer las columnas
    // iniciar variable next
    $next = '01';
    $temp = '';
    $creado = false;

    foreach ($eventos[$i] as $col => $franja) {
      if ($col != 'id_malla' && $col != 'id_usuario' && $col != 'mes' && $col != 'ano' ) {
        $next = substr("0" . (intval($col) +1) , -2);
        if ($franja != '') {
          if (!$creado) {
            $retorno[$p]['start'] = $eventos[$i]['ano']."-".substr("0" . $eventos[$i]['mes'] , -2) ."-".$col;
            $retorno[$p]['title'] = $franja;
            $retorno[$p]['resourceId'] = $eventos[$i]['id_usuario'];
            $retorno[$p]['id'] = $id;
            $retorno[$p]['color'] = $this->get_color_event($franja);
            $creado = true;
            $id--;
          }

          if ($col == '31' || $franja != $eventos[$i][$next]) {
            $retorno[$p]['end'] = $eventos[$i]['ano']."-".substr("0" . $eventos[$i]['mes'] , -2)."-".$col. " 12:00:00";
            $creado = false;
            $p++;
          }
        }

      }

    }

  }

  // $a = [array(/*'id'=> '1', */'resourceId'=> '63556518', 'start'=> '2018-08-05', 'end'=> '2018-08-08', 'title'=> 'event 1')];
  echo json_encode($retorno);
}

// retorna el color indicado segun la franja
private function get_color_event($franja){
  $color = 'black';
      switch ($franja) {
        case '3:00-11:00':
          $color = '#5c32bf69';
          break;
    case '6:00-14:00':
          $color = '#084c6fba';
          break;
        case '7:00-16:00':
          $color = '#ffff00';
          break;
        case '13:00-21:00':
          $color = '##0070c0';
          break;
        case '11:00-20:00':
          $color = '#92d050';
          break;
        case '8:00-17:00':
          $color = '#ffc000';
          break;

        default:
          $color = '#8c8c8c';
          break;
      }
    return $color;
}


}
?>
