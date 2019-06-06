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
        'active'         => "voltria",
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
  
  public function reporte_sla()
  {
    
    $data = array(
        'active_sidebar' => false,
        'title'          => 'Reporte SLAs',
        'active'         => "reporte_sla",
        'header'         => array('Reporte','SLAs'),
        'sub_bar'        => array(false,''),
        'f_actual'       => date('Y-m-d'),
        'f_inicio'       => date('Y-m') . '-01'
    );

    $this->load->view('parts/header', $data);
    $this->load->view('reporte_sla');
    $this->load->view('parts/footer');
    
  }
  
  public function c_getInfoReportSlas()
  {
    $fdesde = $this->input->post('desde');
    $fhasta = $this->input->post('hasta');
    $data = $this->Dao_reportes_model->getInfoReportSlas($fdesde, $fhasta);
    echo json_encode($data);
  }

}

  /* End of file reportes.php */