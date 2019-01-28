<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crq extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('data/Dao_tipo_tareas_model');
    }

    // Cargar la cista de crear crq
    public function crear() {
    	if (!$this->session->userdata('id')) {header('location: ' . base_url());}

        $config_page = array(
            'active_sidebar' => true,
            'title'          => 'ZOLID | Crear',
            'active'         => 'menu_crear',
            'header'         => array('', 'Creación de Actividades')
        );

        $data['tipo_tareas'] = $this->Dao_tipo_tareas_model->get_all_tipo_tareas();
        // echo '<pre>'; print_r($data['tipo_tareas']); echo '</pre>';

        $this->load->view('parts/header', $config_page);
        $this->load->view("crear_crq", $data);
        $this->load->view('parts/footer');
    }

}
