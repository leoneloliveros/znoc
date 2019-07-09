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

}

/* End of file Bitacoras.php */
?>
