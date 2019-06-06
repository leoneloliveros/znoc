<?php


defined('BASEPATH') or exit('No direct script access allowed');
ini_set('memory_limit',-1);
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
        'sub_bar'        => array(false,''),
        'f_actual'       => date('Y-m-d')
    );

    $this->load->view('parts/header', $data);
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

}

  /* End of file reportes.php */