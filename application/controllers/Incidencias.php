<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Incidencias extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('data/Dao_tipo_tareas_model');
        $this->load->model('data/Dao_crq_model');
        $this->load->model('data/Dao_mc_tareas_model');
    }
    public function index()
    {
      
      $data = array(
          'active_sidebar' => false,
          'title'          => 'Incidencias',
          'active'         => "Incidencias",
          'header'         => array('Incidencias',''),
          'sub_bar'        => true,
          'f_actual'       => date('Y-m-d')
      );

      $this->load->view('parts/header', $data);
      $this->load->view('Incidencias');
      $this->load->view('parts/footer');

    }
}
?>
