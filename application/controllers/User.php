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
            $val_pass = $this->Dao_user_model->validatePass($pass, $val_user->id_users);
            if ($val_pass != null) {
                if ($pass === 'abc123' || strlen($pass) <= 6) {
                    $data['usuario'] = $val_user;
                    $this->load->view('cambiarContrasena', $data);
                }else{
                    $data = array(
                    // 'role' => $val_user->rol,
                    'id' => $val_user->id_users,
                    'name' => $val_user->nombres . " " . $val_user->apellidos,
                    'email'=> $val_user->email,
                    'role'=> $val_user->role,
                    'imagen'=> $val_user->imagen
                );

                $this->session->set_userdata($data);

                if (!$this->session->userdata('id')) {header('location: ' . base_url());}

                
                $config_page = array(
                    'active_sidebar' => false,
                    'title'          => 'ZOLID | Principal',
                    'active'         => 'principal',
                    'header'         => array('PRINCIPAL', 'Bandeja principal'),
                    'sub_bar'         => false,
                );
                
                $this->load->view('parts/header', $config_page);
                $this->load->view('principal');
                $this->load->view('parts/footer');
                }
            } else {
                $response['mensaje'] = 'Error de autentificación!';
                $response['texto'] = 'La contraseña es errónea';
                $response['tipo'] = 'error';
                $this->load->view('login', $response);
            }

        } else {
            $response['mensaje'] = 'Error de autentificación!';
            $response['texto'] = 'El No. de documento es desconocido!';
            $response['tipo'] = 'error';
            $this->load->view('login', $response);
        }
    }

    // Carga la vista ppal segun el roll
    public function principal() {
        if (!$this->session->userdata('id')) {header('location: ' . base_url());}

        $config_page = array(
            'active_sidebar' => false,
            'title'          => 'ZOLID | Principal',
            'active'         => 'principal',
            'header'         => array('PRINCIPAL', 'Bandeja principal'),
            'sub_bar'         => false,
        );

        $this->load->view('parts/header', $config_page);
        $this->load->view("principal");
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

    // Vista para cambiar opciones del usuario
    public function perfil() {
        if (!$this->session->userdata('id')) {header('location: ' . base_url());}

        $config_page = array(
            'subproyecto'    => 'Microondas',
            'active_sidebar' => true,
            'title'          => 'ZOLID | Perfil',
            'active'         => 'earch-btn',
            'header'         => array('Perfil', 'cambiar perfil'),
        );

        $this->load->view('parts/header', $config_page);
        $this->load->view("perfil_usuario");
        $this->load->view('parts/footer');
    }

    // cambiar configuraciones de perfil
    public function configurar_perfil() {


        // logica para subida de archivos
        $id_user = $this->session->userdata('id');
        $field         = 'form_file'; // The name attribute of the file input control.
        $realizado = true;
        if ( isset($_FILES[$field]) && isset($_FILES[$field]['name']) && $_FILES[$field]['name'] != '') {
            $realizado = $this->subir_archivo();
           if (!$realizado) {
                $this->session->set_flashdata('msj', array('title' => 'Error', 'cuerpo' => 'Error al actualizar la imagen', 'tipo' => 'error'));
           }

        }

        // Logica para cambio de password
        $new_pass = $this->input->post('new_password');
        $conf_pass = $this->input->post('new_password_2');
        if ($new_pass != '' && $conf_pass != '') {
            if (!$this->Dao_user_model->update_usuarios($id_user, array('contrasena' => $new_pass)) > 0) {
                $realizado = false;
                $this->session->set_flashdata('msj', array('title' => 'Error', 'cuerpo' => 'Error al actualizar contraseña', 'tipo' => 'error'));

            }
        }

        if ($realizado) {
             $this->session->set_flashdata('msj', array('title' => 'OK', 'cuerpo' => 'Cambios Realizados', 'tipo' => 'success'));
        } 

        header('location: ' . base_url('User/perfil'));

    }

    // funcion para mover archivos de los usuarios
    private function subir_archivo(){
        $id_user = $this->session->userdata('id');

        $mi_archivo              = $_FILES['form_file'];
        $config['upload_path']   = "assets2/dist/img/usuarios/";
        $config['file_name']     = $id_user;
        $config['allowed_types'] = "*";
        $config['max_size']      = "50000";
        $config['max_width']     = "2000";
        $config['max_height']    = "2000";
        $config['overwrite']     = true;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('form_file')) {
            echo $this->upload->display_errors();
            return false;
        }    


        $this->Dao_user_model->update_usuarios($id_user, array('imagen' => $id_user));
        

        return true;          
    }

    function CambioContra(){
		$inpCambio =  $this->input->post('inputDos');
		 $id = $this->input->post('id');
		 if($this->Dao_user_model->cambiar($id, $inpCambio) == 1){
			 $data['mensaje'] = 'Contraseña Actualizada!';
			 $data['texto'] = 'Por favor, ingrese con su nueva contraseña';
			 $data['tipo'] = 'success';
			 $this->load->view('login',$data);
		 }else{
			 $data['mensaje'] = 'Error de actualización';
			 $data['texto'] = 'Por favor, intente nuevamente el cambiado de contraseña';
			 $data['tipo'] = 'error';
			 $this->load->view('login',$data);
		 }
	 }

}
