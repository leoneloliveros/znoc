<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class BitacoraMC extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Bitacora_MC_Model');
    }

  public function index()
  {
    if (!$this->session->userdata('id')) {
        header('location: ' . base_url());
    }
  $data = array(
      'active_sidebar' => false,
      'title' => 'Bitacoras MC',
      'active' => "bitacora_mc",
      'header' => array('Crear Bitacora', 'Mesa de Calidad'),
      'sub_bar' => true
  );
    $this->load->view('parts/header', $data);
    $this->load->view('BitMesaCalidad');
    $this->load->view('parts/footer');
  }

  public function saveBinnacle()
  {
      $guardarBitacora = $this->input->post('datosBitGeneral');
      $date_1 = DateTime::createFromFormat('d/m/Y H:i', $guardarBitacora['fecha_hora_inicio']);
      $guardarBitacora['fecha_hora_inicio'] = $date_1->format('Y-m-d H:i');
      $date_2 = DateTime::createFromFormat('d/m/Y H:i', $guardarBitacora['fecha_hora_fin']);
      $guardarBitacora['fecha_hora_fin'] = $date_2->format('Y-m-d H:i');
      $table = 'bitacora_mc';
      $query = $this->Bitacora_MC_Model->saveBinnacle($guardarBitacora,$table);
      // var_dump($guardarBitacora);

  }

  public function saveBitTI()
  {
    $guardarBitacoraTI = $this->input->post('datosBitacoraTI2');
    $date_1 = DateTime::createFromFormat('d/m/Y H:i', $guardarBitacoraTI['fecha_hora_solicitud']);
    $guardarBitacoraTI['fecha_hora_solicitud'] = $date_1->format('Y-m-d H:i');
    $date_2 = DateTime::createFromFormat('d/m/Y H:i', $guardarBitacoraTI['fecha_hora_respuesta']);
    $guardarBitacoraTI['fecha_hora_respuesta'] = $date_2->format('Y-m-d H:i');
    $table = 'turno_integral';
    $query = $this->Bitacora_MC_Model->saveBinnacle($guardarBitacoraTI,$table);
  }

  public function ConsultarBitacorasMC()
  {
  $data = array(
      'active_sidebar' => false,
      'title' => 'Consultar Bitacoras MC',
      'active' => "consultar_bitacora_mc",
      'header' => array('Consultar Bitacora', 'Mesa de Calidad'),
      'sub_bar' => true
  );
    $this->load->view('parts/header', $data);
    $this->load->view('consultarMC');
    $this->load->view('parts/footer');
  }

}

?>
