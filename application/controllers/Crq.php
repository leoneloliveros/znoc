<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crq extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('data/Dao_tipo_tareas_model');
        $this->load->model('data/Dao_crq_model');
        $this->load->model('data/Dao_mc_tareas_model');
    }

    // Cargar la cista de crear crq
    public function crear() {
        if (!$this->session->userdata('id')) {header('location: ' . base_url());}

        $config_page = array(
            'subproyecto'    => 'Microondas',
            'active_sidebar' => true,
            'title'          => 'ZOLID | Crear',
            'active'         => 'menu_crear',
            'header'         => array('', 'Creación de Actividades'),
        );

        $data['tipo_tareas'] = $this->Dao_tipo_tareas_model->get_all_tipo_tareas();
        // echo '<pre>'; print_r($data['tipo_tareas']); echo '</pre>';

        $this->load->view('parts/header', $config_page);
        $this->load->view("crear_crq", $data);
        $this->load->view('parts/footer');
    }

    // de formulario de crear crq para creacion
    public function crear_crq() {
        // retorna false si ya existia ese crq sino lo crea
        $crq_creado = $this->crear_en_tabla_crq($this->input->post());
        if ($crq_creado) {
            // si se creó se crean la(s) tarea(s)
            $this->crear_en_tabla_tareas($this->input->post());
            $this->session->set_flashdata('res', 1);
        } else {
            // si retorna false es porque el crq ya existe
            $this->session->set_flashdata('res', -1);

        }

        header('location: ' . base_url() . "Crq/crear");

    }

    // retorna false si ya existia ese crq sino lo crea
    private function crear_en_tabla_crq($post) {
        $existe = $this->Dao_crq_model->getByCrq($post['crq']);
        if ($existe) {
            return false;
        } else {
            $data = array(
                'crq'                => $post['crq'],
                'info_ejecucion'     => $post['info_ejecucion'],
                'fecha_asignacion'   => null,
                'solicitante_remedy' => $post['solicitante_remedy'],
            );
            $insert = $this->Dao_crq_model->insertar_crq($data);
            return $insert;

        }
    }

    // funcion para insertar nuevas tareas
    private function crear_en_tabla_tareas($post) {
        $data = array(
            'crq'            => $post['crq'],
            'id_tipo_tareas' => $post['id_tipo_tareas'],
        );

        $insert = $this->Dao_mc_tareas_model->insertar_tarea($data);

        if ($insert && $post['id_tipo_tareas'] > 9) {
            $data2 = array(
                'crq'            => $post['crq'],
                'id_tipo_tareas' => 14,
            );
            $insert2 = $this->Dao_mc_tareas_model->insertar_tarea($data2);
        }

        return $insert;

    }

    //  Retorna para js el listado de tareas pendientes por asignar y asignadas
    public function js_getListTsbles() {
        $response = array(
            'lista'      => array_column($this->Dao_mc_tareas_model->get_option_list(), 'valores', 'id_lista'),
            'asignadas'  => $this->Dao_mc_tareas_model->get_tareas_asignadas(),
            'pendientes' => $this->Dao_mc_tareas_model->get_tareas_pendientes()
        );
        // echo '<pre>'; print_r($response['pendientes']); echo '</pre>';
        echo json_encode($response);
    }

    // Retorna el listado de todas las tareas
    public function js_getListTotal(){
    	$response = array(
    		'total' => $this->Dao_mc_tareas_model->get_todas_las_tareas($this->session->userdata('role'))
    	);

    	echo json_encode($response);
    	
    }


    // Retorna para js  las actividades asignadas y ejecutadas del ingeniero logueado
    public function js_getListTable_asignadas(){
    	$fecha = $this->input->post('fecha');
    	$data = $this->Dao_mc_tareas_model->get_tareas_asignadas($this->session->userdata('id'), $fecha);
    	echo json_encode($data);
    }

    // Retorna a js el listado de opciones disponibles en base de datos
    public function js_getOptionList(){
    	$data = array_column($this->Dao_mc_tareas_model->get_option_list(), 'valores', 'id_lista');
    	echo json_encode($data);
    }

    // Retorna para js los listados de reginal redes y subredes separados
    public function js_get_listas(){
        $data = array(
            'subredes' => $this->Dao_crq_model->get_all_subredes(),
            'regiones' => $this->Dao_crq_model->get_lists_regiones(),
            'estados' => $this->Dao_crq_model->get_lists_estados(),
            'motivos' => $this->Dao_crq_model->get_lists_motivos(),
            'areas_asignadas' => $this->Dao_crq_model->get_lists_area_asignada()
        );
        echo json_encode($data);
    }

    // Retorna a js listado de red sugun la region post
    public function js_get_red_by_region(){
        $region = $this->input->post('region');
        $redes = $this->Dao_crq_model->get_list_red_by_region($region);
        echo json_encode($redes);
    }

    // Retorna listado de sub red segun la red post
    public function js_get_subred_by_red(){
        $red = $this->input->post('red');
        $subredes = $this->Dao_crq_model->get_list_subred_by_red($red);
        echo json_encode($subredes);
        
    }

    // Guardar la informacion editada de cierre
    public function js_save_cierre_crq(){
        $post = array_column($this->input->post()['data'], 'value', 'name');
        $fecha_asignacion = date('Y-m-d');

        if (isset($post['id_subred'])) {
            $this->Dao_crq_model->update_crq( array( 'id_subred' => $post['id_subred'],'fecha_asignacion' => $fecha_asignacion), $post['crq'] );
        } 

        $data = array(
            'estado_tarea'             => $post['estado_tarea'],
            'motivo_estado'            => $post['motivo_estado'],
            'motivo_estado'            => $post['motivo_estado'],
            'area_asignada'            => $post['area_asignada'],
            'fecha_ultimo_seguimiento' => $fecha_asignacion,
        );

        $res = $this->Dao_mc_tareas_model->update_tareas_crq($data, $post['crq'], $post['id_tipo_tareas']);

        echo json_encode(($res > 0));


    }


}
