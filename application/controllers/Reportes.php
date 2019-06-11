<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'libraries/spout/src/Spout/Autoloader/autoload.php';

use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Box\Spout\Common\Entity\Style\Color;

ini_set('memory_limit', -1);

class Reportes extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Dao_reportes_model');
    }

    public function volumetria() {

        $data = array(
            'active_sidebar' => false,
            'title' => 'Volumetrías',
            'active' => "areali",
            'header' => array('Actividades', 'Volumetría'),
            'sub_bar' => true,
            'f_actual' => date('Y-m-d')
        );

        $this->load->view('parts/header', $data);
        $this->load->view('parts/datesRange');
        $this->load->view('volumetria');
        $this->load->view('parts/footer');
    }

    public function c_getNemonicosAccordingDate() {
        $fdesde = $this->input->post('desde');
        $fhasta = $this->input->post('hasta');
        $data = $this->Dao_reportes_model->getNemonicosAccordingDate($fdesde, $fhasta);
        echo json_encode($data);
    }

    public function reporte_sla() {

        $data = array(
            'active_sidebar' => false,
            'title' => 'Reporte SLAs',
            'active' => "slali",
            'header' => array('Reporte', 'SLAs'),
            'sub_bar' => true,
            'f_actual' => date('Y-m-d'),
            'f_inicio' => date('Y-m') . '-01'
        );

        $this->load->view('parts/header', $data);
        $this->load->view('reporte_sla');
        $this->load->view('parts/footer');
    }

    public function c_getInfoReportSlas() {
        $fdesde = $this->input->post('desde');
        $fhasta = $this->input->post('hasta');
        $data = $this->Dao_reportes_model->getInfoReportSlas($fdesde, $fhasta);
        echo json_encode($data);
    }

    public function care($tipo) {
        $data = array(
            'active_sidebar' => true,
            'title' => 'Customer Care',
            'active' => $tipo,
            'header' => array('Customer Care', strtoupper($tipo)),
            'sub_bar' => true,
            'f_actual' => date('Y-m-d')
        );

        $this->load->view('parts/header', $data);
        $this->load->view('parts/datesRange');
        $this->load->view('Care');
        $this->load->view('parts/footer');
    }

    public function enviarDatosExcel() {
        $data = json_decode($this->input->post('data'));
        $_SESSION['x'] = $data;
    }

    public function excelVolumetrias() {
        // $data = json_decode($this->input->post('data'));
        $data = $_SESSION['x'];
        // echo '<pre>'; print_r((array)$data->faoc[1][0]); echo '</pre>';
        $excel = WriterEntityFactory::createXLSXWriter();
        $excel->openToBrowser('Volumetrias(' . date('Y-m-d') . ').xlsx');
        // $wrapText = (new StyleBuilder())->setShouldWrapText(false)->build();

        $titles = array('TICKETID', 'ZONA_TKT', 'TIPO_TKT', 'CREATIONDATE', 'CLOSEDATE', 'ACTUALFINISH', 'STATUS', 'INTERNALPRIORITY', 'URGENCY', 'CREATEDBY', 'CHANGEDATE', 'OWNERGROUP', 'LOCATION', 'MUN100', 'AFECTACION_TOTAL_CORE', 'INCEXCLUIR', 'PROVEEDORES', 'TICKET_EXT', 'DESCRIPTION', 'EXTERNALSYSTEM', 'RUTA_TKT', 'INC_ALARMA', 'INCSOLUCION', 'GERENTE', 'REGIONAL', 'PROBLEM_CODE', 'PROBLEM_DESCRIPTION', 'CAUSE_CODE', 'CAUSE_DESCRIPTION', 'REMEDY_CODE', 'REMEDY_DESCRIPTION', 'TIEMPO_VIDA_TKT', 'TIEMPO_RESOLUCION_TKT', 'TIEMPO_DETECCION', 'TIEMPO_ESCALA', 'TIEMPO_FALLA');

        $header = WriterEntityFactory::createRowFromArray($titles);


        $faoc = $excel->getCurrentSheet();
        $faoc->setName('FAOC');
        $excel->addRow($header);

        foreach ($data->faoc[1] as $volumetrias) {
            $row = WriterEntityFactory::createRowFromArray((array) $volumetrias);
            $excel->addRow($row);
        }
        // // $ejmplo = WriterEntityFactory::createRowFromArray(array("hola",'qie','pex'));

        $faob = $excel->addNewSheetAndMakeItCurrent();
        $faob->setName('FAOB');
        $excel->addRow($header);

        foreach ($data->faob[1] as $volumetrias) {
            $row = WriterEntityFactory::createRowFromArray((array) $volumetrias);
            $excel->addRow($row);
        }

        $fapp = $excel->addNewSheetAndMakeItCurrent();
        $fapp->setName('FAPP');
        $excel->addRow($header);



        foreach ($data->fapp[1] as $volumetrias) {
            $row = WriterEntityFactory::createRowFromArray((array) $volumetrias);
            $excel->addRow($row);
        }

        $fee = $excel->addNewSheetAndMakeItCurrent();
        $fee->setName('FEE');
        $excel->addRow($header);


        foreach ($data->fee[1] as $volumetrias) {
            $row = WriterEntityFactory::createRowFromArray((array) $volumetrias);
            $excel->addRow($row);
        }

        $fi = $excel->addNewSheetAndMakeItCurrent();
        $fi->setName('FI');
        $excel->addRow($header);


        foreach ($data->fi[1] as $volumetrias) {
            $row = WriterEntityFactory::createRowFromArray((array) $volumetrias);
            $excel->addRow($row);
        }

        $foip = $excel->addNewSheetAndMakeItCurrent();
        $foip->setName('FOIP');
        $excel->addRow($header);


        foreach ($data->foip[1] as $volumetrias) {
            $row = WriterEntityFactory::createRowFromArray((array) $volumetrias);
            $excel->addRow($row);
        }
        $excel->close();
    }

    public function excelTiempoEscalamientoMovil($fdesde, $fhasta) {
        $data_faoc = $this->Dao_reportes_model->getIncidentsByCoordination($fdesde, $fhasta, 'FAOC');
        $data_faob = $this->Dao_reportes_model->getIncidentsByCoordination($fdesde, $fhasta, 'FAOB');
        $data_fapp = $this->Dao_reportes_model->getIncidentsByCoordination($fdesde, $fhasta, 'FAPP');
        $data_fee = $this->Dao_reportes_model->getIncidentsByCoordination($fdesde, $fhasta, 'FEE');
        $data_fi = $this->Dao_reportes_model->getIncidentsByCoordination($fdesde, $fhasta, 'FI');
        $data_foip = $this->Dao_reportes_model->getIncidentsByCoordination($fdesde, $fhasta, 'FOIP');

        $excel = WriterEntityFactory::createXLSXWriter();
        $excel->openToBrowser('SLAS tiempos de escalamiento movil(' . date('Y-m-d') . ').xlsx');
        // $wrapText = (new StyleBuilder())->setShouldWrapText(false)->build();

        $titles = array('TICKETID', 'ZONA_TKT', 'TIPO_TKT', 'CREATIONDATE', 'CLOSEDATE', 'ACTUALFINISH', 'STATUS', 'INTERNALPRIORITY', 'URGENCY', 'CREATEDBY', 'CHANGEDATE', 'OWNERGROUP', 'LOCATION', 'MUN100', 'AFECTACION_TOTAL_CORE', 'INCEXCLUIR', 'PROVEEDORES', 'TICKET_EXT', 'DESCRIPTION', 'EXTERNALSYSTEM', 'RUTA_TKT', 'INC_ALARMA', 'INCSOLUCION', 'GERENTE', 'REGIONAL', 'PROBLEM_CODE', 'PROBLEM_DESCRIPTION', 'CAUSE_CODE', 'CAUSE_DESCRIPTION', 'REMEDY_CODE', 'REMEDY_DESCRIPTION', 'TIEMPO_VIDA_TKT', 'TIEMPO_RESOLUCION_TKT', 'TIEMPO_DETECCION', 'TIEMPO_ESCALA', 'TIEMPO_FALLA');

        $header = WriterEntityFactory::createRowFromArray($titles);


        $faoc = $excel->getCurrentSheet();
        $faoc->setName('FAOC');
        $excel->addRow($header);

        foreach ($data_faoc as $dataFaoc) {
            $row = WriterEntityFactory::createRowFromArray((array) $dataFaoc);
            $excel->addRow($row);
        }
        // // $ejmplo = WriterEntityFactory::createRowFromArray(array("hola",'qie','pex'));

        $faob = $excel->addNewSheetAndMakeItCurrent();
        $faob->setName('FAOB');
        $excel->addRow($header);

        foreach ($data_faob as $datFaob) {
            $row = WriterEntityFactory::createRowFromArray((array) $datFaob);
            $excel->addRow($row);
        }

        $fapp = $excel->addNewSheetAndMakeItCurrent();
        $fapp->setName('FAPP');
        $excel->addRow($header);



        foreach ($data_fapp as $dataFapp) {
            $row = WriterEntityFactory::createRowFromArray((array) $dataFapp);
            $excel->addRow($row);
        }

        $fee = $excel->addNewSheetAndMakeItCurrent();
        $fee->setName('FEE');
        $excel->addRow($header);


        foreach ($data_fee as $dataFee) {
            $row = WriterEntityFactory::createRowFromArray((array) $dataFee);
            $excel->addRow($row);
        }

        $fi = $excel->addNewSheetAndMakeItCurrent();
        $fi->setName('FI');
        $excel->addRow($header);


        foreach ($data_fi as $dataFi) {
            $row = WriterEntityFactory::createRowFromArray((array) $dataFi);
            $excel->addRow($row);
        }

        $foip = $excel->addNewSheetAndMakeItCurrent();
        $foip->setName('FOIP');
        $excel->addRow($header);


        foreach ($data_foip as $dataFoip) {
            $row = WriterEntityFactory::createRowFromArray((array) $dataFoip);
            $excel->addRow($row);
        }
        $excel->close();
    }
    
    public function reporte_sla_customer() {

        $data = array(
            'active_sidebar' => false,
            'title' => 'Customer Care Reporte SLAs',
            'active' => "slaliCustomer",
            'header' => array('Customer Care', 'SLAs'),
            'sub_bar' => true,
            'f_actual' => date('Y-m-d'),
            'f_inicio' => date('Y-m') . '-01'
        );

        $this->load->view('parts/header', $data);
        $this->load->view('reporte_sla_customer');
        $this->load->view('parts/footer');
    }
    
    public function c_getInfoReportSlasCustomer() {
        $fdesde = $this->input->post('desde');
        $fhasta = $this->input->post('hasta');
        $data = $this->Dao_reportes_model->getInfoReportSlasCustomer($fdesde, $fhasta);
        echo json_encode($data);
    }

}

/* End of file reportes.php */