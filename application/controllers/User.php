<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('data/Dao_user_model');

    }

    // Al inicio del proyecto, cargar login
    public function index() {
        if ($this->session->userdata('name')) {
            $this->session->sess_destroy();
        }
        $this->load->view('login');
    }

    // Funcion para validar logueo
    public function validate_credentials() {
        $idUser = $this->input->post('username');
        $pass   = $this->input->post('contrasena');

        // print_r($_POST);
        $val_user = $this->Dao_user_model->getUserByUsername($idUser);
        if ($val_user != null) {
            $val_pass = $this->Dao_user_model->validatePass($pass, $val_user->id_usuario);
            if ($val_pass != null) {

                $data = array(
                    'role'     => $val_user->rol,
                    'id'       => $val_user->id_usuario,
                    'name'     => explode(" ", $val_user->nombres)[0] . " " . explode(" ", $val_user->apellidos)[0],
                    'email'    => $val_user->email,
                    'proyecto' => $val_user->proyecto,
                    'imagen'   => $val_user->imagen,

                );

                $this->session->set_userdata($data);
                header('location: ' . base_url() . "User/principal/$val_user->rol");
            } else {
                $response['error'] = "error";
                $this->load->view('login', $response);
            }
        } else {
            $response['error'] = "error";
            $this->load->view('login', $response);
        }
    }

    // Carga la vista ppal segun el roll
    public function principal($role) {
        if (!$this->session->userdata('id')) {header('location: ' . base_url());}

        $config_page = array(
            'active_sidebar' => false,
            'title'          => 'ZOLID | Principal',
            'active'         => 'principal',
            'header'         => array('PRINCIPAL', 'Bandeja principal')
        );

        $this->load->view('parts/header', $config_page);
        $this->load->view("$role");
        $this->load->view('parts/footer');
    }

    // cierra session
    public function logout() {
        if ($this->session->userdata('id')) {
            $this->session->sess_destroy();
        }
        // $this->load->view('login');
        header('location: ' . base_url());
    }

    // retorna para js las variables del usuario en session
    public function getSessionValues() {
        $clave = $this->input->post('clave');

        if ($clave) {
            echo json_encode($this->session->userdata("$clave"));
        } else {
            echo json_encode($this->session->userdata());
        }
    }

    // retorna listado de ingenieros con su id
    public function js_getEngineers() {
        $ingenieros = $this->Dao_user_model->getEngineers();
        echo json_encode($ingenieros);
    }

    // retorna la lista de ingenieros que se encuentran agendados en la malla para la fecha que se pasa por post
    public function c_getMeshEngineersByDate() {
        $date       = $this->input->post('fecha');
        $ingenieros = $this->Dao_user_model->getMeshEngineersByDate($date);
        echo json_encode($ingenieros);
    }
    // valida si el pasword ingresado en el input es correcto
    public function validate_pass() {
        $user_in_session = $this->session->userdata('id');
        $password        = $this->input->post('pass');
        $res             = $this->Dao_user_model->get_pass_by_id($user_in_session);
        if ($res->contrasena == $password) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }
    public function Update_pass_or_email() {
        if (!$this->session->userdata('id')) {header('location: ' . base_url());}
        $user_in_session = $this->session->userdata('id');
        $data            = array(
            'email'      => $this->input->post('new_email'),
            'contrasena' => $this->input->post('new_pass'),
        );
        $res = $this->Dao_user_model->m_Update_pass_or_email($user_in_session, $data);

        $this->load->library('user_agent');
        if ($res == 1) {
            $this->session->set_flashdata('msj', 'ok');
            $this->session->sess_destroy();
            $this->load->view('login');
        } else {
            $this->session->set_flashdata('msj', 'error');
            header('location: ' . $this->agent->referrer());
        }

    }

    // retorna el id de un usuario segun su nombre
    public function c_get_iduser_by_name() {
        $nombre = $this->input->post('name');
        $idUser = $this->Dao_user_model->get_user_by_name($nombre);
        echo json_encode($idUser);
    }

}
