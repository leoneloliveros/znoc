<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Areas extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Areas_model');
    }

  public function index()
  {
    if (!$this->session->userdata('id')) {
        header('location: ' . base_url());
    }

    $data = array(
        'active_sidebar' => false,
        'title' => 'Areas',
        'active' => "generate_areas",
        'header' => array('Crear Usuarios', 'area usuario session'),
        'sub_bar' => true
    );

    $this->load->view('parts/header', $data);
    $this->load->view('generate_areas');
    $this->load->view('parts/footer');
  }

  public function saveArea(){
    $guardarArea = $this->input->post('guardarArea');
    $query = $this->Areas_model->saveArea($guardarArea);
  }
}

?>
