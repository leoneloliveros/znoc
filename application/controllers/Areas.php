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
    $guardarManager = $this->input->post('guardarManager');
    $query = $this->Areas_model->saveArea($guardarArea);
    $query2 = $this->Areas_model->saveManager($guardarManager);

    // var_dump($guardarArea);

  }
  public function getIdRol()
  {
    $obtenerRol = $this->input->post('rolManager');
    $query = $this->Areas_model->getIdRol($obtenerRol);
    return (Array)$query;
    var_dump($query);

  }

  public function consultArea(){
    $id = $this->session->userdata('id');
    $query = $this->Areas_model->getArea($id);
    return (Array)$query;
    // var_dump($query);
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
  public function viewArea($area) {
      $data = array(
          'active_sidebar' => false,
          'title' => 'Consultar Area',
          'active' => 'consultArea',
          'header' => array('Consult', 'Areas'),
          'sub_bar' => true,
      );
      $getCordinadores =  $this->getCordinadores($area);
      $getUsuarios = $this->getUsuarios($area);
      $getRol = $this->getRol($area);

      $data['cordinadores'] = $getCordinadores;
      $data['nombre_area'] = $area;
      $data['usuarios'] = $getUsuarios;
      $data['roles'] = $getRol;

      $this->load->view('parts/header', $data);
      $this->load->view('consultArea');
      $this->load->view('parts/footer');
  }

  public function getCordinadores($area)
  {
    $query = $this->Areas_model->getCordinadores($area);
    return (Array)$query;
  }
  public function getUsuarios($area)
  {
    $query = $this->Areas_model->getUsuarios($area);
    // var_dump($query);
    return (Array)$query;
  }
  public function getRol($area)
  {
   $query = $this->Areas_model->getRol($area);
   // var_dump($query);
   return (Array)$query;
  }
  public function generateRol($area)
  {
    $data = array(
        'active_sidebar' => false,
        'title' => 'Crear Roles',
        'active' => 'generateRol',
        'header' => array('Crear', 'Rol'),
        'sub_bar' => true,
    );
    $data['nombre_area'] = $area;
    $this->load->view('parts/header', $data);
    $this->load->view('generateRol' );
    $this->load->view('parts/footer');
  }

  public function postRol()
  {
    $nuevoRol = $this->input->post('nuevoRol');
    $query=$this->Areas_model->postRol($nuevoRol);
  }
    public function generateCordinator($area)
    {
      $data = array(
          'active_sidebar' => false,
          'title' => 'Crear Cordinador',
          'active' => 'generateCordinator',
          'header' => array('Crear', 'Cordinador'),
          'sub_bar' => true,
      );
      $data['nombre_area'] = $area;
      $this->load->view('parts/header', $data);
      $this->load->view('generateCordinator');
      $this->load->view('parts/footer');
    }
    public function saveCordinator()
    {
      $guardarCordinador = $this->input->post('guardarCordinador');
      $query2 = $this->Areas_model->saveCordinator($guardarCordinador);
    }

}

?>
