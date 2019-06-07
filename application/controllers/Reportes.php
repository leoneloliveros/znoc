<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Reportes extends CI_Controller
{ 
  function __construct(){
    parent::__construct();
    $this->load->model('Dao_reportes_model');
  }

  public function volumetria()
  {
    
    $data = array(
        'active_sidebar' => false,
        'title'          => 'Volumetrías',
        'active'         => "areali",
        'header'         => array('Actividades','Volumetría'),
        'sub_bar'        => true,
        'f_actual'       => date('Y-m-d')
    );

    $this->load->view('parts/header', $data);
    $this->load->view('parts/datesRange');
    $this->load->view('volumetria');
    $this->load->view('parts/footer');
    
  }

  public function c_getNemonicosAccordingDate()
  {
    $fdesde = $this->input->post('desde');
    $fhasta = $this->input->post('hasta');
    $data = $this->Dao_reportes_model->getNemonicosAccordingDate($fdesde,$fhasta);
    echo json_encode($data);
  }

  public function care($tipo)
  {
    $data = array(
      'active_sidebar' => true,
      'title'          => 'Customer Care',
      'active'         => $tipo,
      'header'         => array('Customer Care', strtoupper($tipo)),
      'sub_bar'        => true,
      'f_actual'       => date('Y-m-d')
  );

    $this->load->view('parts/header', $data);
    $this->load->view('parts/datesRange');
    $this->load->view('Care');
    $this->load->view('parts/footer'); 
  }

}

  /* End of file reportes.php */