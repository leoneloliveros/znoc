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

    $areas = $this->consultArea();
    $datos['data'] = $areas;
    $idRol = $this->getIdRol();
    $datos['rol'] = $idRol;
    $this->load->view('parts/header', $data);
    $this->load->view('ver_areas', $datos);
    $this->load->view('parts/footer');
  }

  public function saveArea(){
    $guardarArea = $this->input->post('guardarArea');
    // var_dump($guardarArea);
    $query = $this->Areas_model->saveArea($guardarArea);

  }
  public function getIdRol()
  {
    $obtenerRol = $this->input->post('rolManager');
    $query = $this->Areas_model->getIdRol($obtenerRol);
    return (Array)$query;
    var_dump($query);

  }

  public function consultArea(){
    // $getArea = $this->input->post('area')
    $id = $this->session->userdata('id');
    $query = $this->Areas_model->getArea($id);
    return (Array)$query;
  }

  public function generate_areas() {
      $data = array(
          'active_sidebar' => false,
          'title' => 'Generar Areas',
          'active' => 'generate_areas',
          'header' => array('Generar', 'Areas'),
          'sub_bar' => true,
      );
      $this->load->view('parts/header', $data);
      $this->load->view('generate_areas');
      $this->load->view('parts/footer');
  }

  public function getUsers()
  {
   $users =$this->input->post('users');
   $query=$this->Areas_model->getUsers($users);
   echo json_encode($query);
   // var_dump($query);
  }

  public function getIdUser()
  {
    $idUser = $this->input->post('idUsers');
    $query=$this->Areas_model->getIdUser($idUser);
    // var_dump($query);
    echo json_encode($query);

  }
  public function viewArea() {
      $data = array(
          'active_sidebar' => false,
          'title' => 'Consultar Area',
          'active' => 'consultArea',
          'header' => array('Consult', 'Areas'),
          'sub_bar' => true,
      );
      $this->load->view('parts/header', $data);
      $this->load->view('consultArea');
      $this->load->view('parts/footer');
  }

}

?>
