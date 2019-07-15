<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bitacoras extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Dao_bitacoras_model');
    }

    public function ccihfc() {
        $data = array(
            'active_sidebar' => false,
            'title' => 'Creación de Bitacoras',
            'active' => 'ccili',
            'header' => array('Creación de Actividades', 'CCI y HFC'),
            'sub_bar' => true,
        );

        $this->load->view('parts/header', $data);
        $this->load->view('Bit_CCI_HFC');
        $this->load->view('parts/footer');
    }

    public function export() {
        $data = array(
            'active_sidebar' => false,
            'title' => 'Bitacoras Front Office',
            'active' => 'fOli',
            'header' => array('Consultar Actividades', 'Front Office'),
            'sub_bar' => true,
        );
        $this->load->view('parts/header', $data);
        $this->load->view('consultar');
        $this->load->view('parts/footer');
    }

    public function saveCCIHFC() {
        $data = json_decode($this->input->post('data'));
        $date_1 = DateTime::createFromFormat('d/m/Y H:i', $data->beginDate);
        $data->beginDate = $date_1->format('Y-m-d H:i:s');
        $date_2 = DateTime::createFromFormat('d/m/Y H:i', $data->endDate);
        $data->endDate = $date_2->format('Y-m-d H:i:s');
        $date_3 = DateTime::createFromFormat('d/m/Y H:i', $data->iniAct);
        $data->iniAct = $date_3->format('Y-m-d H:i:s');
        $date_4 = DateTime::createFromFormat('d/m/Y H:i', $data->finAct);
        $data->finAct = $date_4->format('Y-m-d H:i:s');
//        print_r($data->beginDate);exit();
        $saved = $this->Dao_bitacoras_model->saveCCIHFC($data);
        echo json_encode($saved);
    }

    public function frontEndBookLogs() {

        $data = array(
            'active_sidebar' => false,
            'title' => 'Bitacoras Front Office',
            'active' => 'fOli',
            'header' => array('Creación de Actividades', 'Front Office'),
            'sub_bar' => true,
        );
        $this->load->view('parts/header', $data);
        $this->load->view('BitFrontEnd');
        $this->load->view('parts/footer');
    }

    public function savebookLogsFrontEnd() {
        $generalData = $this->input->post('general');
        $informacionEspecifica = $this->input->post('tipo');
        $table = $this->input->post('tabla');


        $saved = $this->Dao_bitacoras_model->saveBookLogsAccordingType($generalData, $informacionEspecifica, $table);


        echo json_encode($saved);
    }

    public function getAreas() {
        $engs = $this->Dao_bitacoras_model->getAreas();
        echo json_encode($engs);
    }

    public function getEngineersByTypeLogBooks() {
        $tipo = $this->input->post('type');
        $engs = $this->Dao_bitacoras_model->getEngineersForLogBooks($tipo);
        echo json_encode($engs);
    }

    public function c_getEngineersByAreaAndRol() {
        $rol = $this->input->post('rol');
        $area = $this->input->post('area');
        $engs = $this->Dao_bitacoras_model->getEngineersByAreaAndRol($rol, $area);
        echo json_encode($engs);
    }
    public function getBackOfficeView() {
        $data = array(
            'active_sidebar' => false,
            'title' => 'Creación de Bitacoras',
            'active' => 'ccili',
            'header' => array('Creación de Actividades', 'CCI y HFC'),
            'sub_bar' => true,
        );
    
        $this->load->view('parts/header', $data);
        $this->load->view('bitacoras/backoffice');
        $this->load->view('parts/footer');
    }

    public function saveWorkLogBackOffice() {
        $info = $this->input->POST('datosBitacora');
        $guardar = $this->Dao_bitacoras_model->crearBitacoraBackOffice($info);
        if ($guardar == "Registro Exitoso") {
            echo "Registros exitosos";
        } else {
            echo "false";
        }
    }
    public function exportCciHfc() {
        $data = array(
            'active_sidebar' => false,
            'title' => 'Bitacoras CCI Y HFC',
            'active' => 'bitac-cci-hfc',
            'header' => array('Consultar Actividades', 'CCI Y HFC'),
            'sub_bar' => true,
        );
        $this->load->view('parts/header', $data);
        $this->load->view('consultar_cci_hfc');
        $this->load->view('parts/footer');
    }

    public function exportBitacoraBO() {
        $data = array(
            'active_sidebar' => false,
            'title' => 'Bitacoras CCI Y HFC',
            'active' => 'bitac-cci-hfc',
            'header' => array('Consultar Actividades', 'CCI Y HFC'),
            'sub_bar' => true,
        );
        

        $this->load->view('parts/header', $data);
        $this->load->view('bitacoras/exportBitacoraBO');
        $this->load->view('parts/footer');
    }

    public function cargarBitacoraBO() {
        $this->load->library('Datatables');

        $bitacora_BO_table = $this->datatables->init();

        $bitacora_BO_table->select('*')->from('znoc.BITACORA_BO');

        $bitacora_BO_table
            ->style(array(
            'class' => 'table table-striped',
            ))
            ->column('Fecha', 'fecha')
            ->column('Ticket', 'ticket')
            ->column('Tarea', 'tarea')
            ->column('Estacion', 'estacion');
            
        $this->datatables->create('bitacora_BO_table', $bitacora_BO_table); 
        $this->load->view('bitacoras/loadBOData');
    }


}
/* End of file Bitacoras.php */
?>
