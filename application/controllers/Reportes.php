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

    public function volumetria_cc() {

        $data = array(
            'active_sidebar' => false,
            'title' => 'Volumetrías',
            'active' => "areali",
            'header' => array('Customer Care', 'Volumetría'),
            'sub_bar' => true,
            'f_actual' => date('Y-m-d')
        );
        $this->load->view('parts/header', $data);
        $this->load->view('parts/datesRange');
        $this->load->view('volumetria_cc');
        $this->load->view('parts/footer');
    }

    public function c_getNemonicosAccordingDate() {
        $fdesde = $this->input->post('desde');
        $fhasta = $this->input->post('hasta');
        $data = $this->Dao_reportes_model->getNemonicosAccordingDate($fdesde, $fhasta);
        echo json_encode($data);
    }

    public function c_getNemonicosCCAccordingDate() {
        $fdesde = $this->input->post('desde');
        $fhasta = $this->input->post('hasta');
        $data = $this->Dao_reportes_model->getNemonicosCCAccordingDate($fdesde, $fhasta);
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
//        $data = json_decode($this->input->post('data'));
        $data = $_SESSION['x'];
//        echo '<pre>'; print_r($data->faoc); echo '</pre>';
        $excel = WriterEntityFactory::createXLSXWriter();
        $excel->openToBrowser('Volumetrias Front Office Móvil(' . date('Y-m-d') . ').xlsx');
//        $wrapText = (new StyleBuilder())->setShouldWrapText(false)->build();

        $titles = array('TICKETID', 'ZONA_TKT', 'TIPO_TKT', 'CREATIONDATE', 'CLOSEDATE', 'ACTUALFINISH', 'STATUS', 'INTERNALPRIORITY', 'URGENCY', 'CREATEDBY', 'CHANGEDATE', 'OWNERGROUP', 'LOCATION', 'MUN100', 'AFECTACION_TOTAL_CORE', 'INCEXCLUIR', 'PROVEEDORES', 'TICKET_EXT', 'DESCRIPTION', 'EXTERNALSYSTEM', 'RUTA_TKT', 'INC_ALARMA', 'INCSOLUCION', 'GERENTE', 'REGIONAL', 'PROBLEM_CODE', 'PROBLEM_DESCRIPTION', 'CAUSE_CODE', 'CAUSE_DESCRIPTION', 'REMEDY_CODE', 'REMEDY_DESCRIPTION', 'TIEMPO_VIDA_TKT', 'TIEMPO_RESOLUCION_TKT', 'TIEMPO_DETECCION', 'TIEMPO_ESCALA', 'TIEMPO_FALLA', 'TIPO');

        $header = WriterEntityFactory::createRowFromArray($titles);


        $faoc = $excel->getCurrentSheet();
        $faoc->setName('FAOC');
        $excel->addRow($header);

        foreach ($data->faoc as $tipos) {
            foreach ($tipos as $volumetrias) {
                $row = WriterEntityFactory::createRowFromArray((array) $volumetrias);
                $excel->addRow($row);
            }
        }
        // // $ejmplo = WriterEntityFactory::createRowFromArray(array("hola",'qie','pex'));

        $faob = $excel->addNewSheetAndMakeItCurrent();
        $faob->setName('FAOB');
        $excel->addRow($header);

        foreach ($data->faob as $tipos) {
            foreach ($tipos as $volumetrias) {
                $row = WriterEntityFactory::createRowFromArray((array) $volumetrias);
                $excel->addRow($row);
            }
        }

        $fapp = $excel->addNewSheetAndMakeItCurrent();
        $fapp->setName('FAPP');
        $excel->addRow($header);

        foreach ($data->fapp as $tipos) {
            foreach ($tipos as $volumetrias) {
                $row = WriterEntityFactory::createRowFromArray((array) $volumetrias);
                $excel->addRow($row);
            }
        }

        $fee = $excel->addNewSheetAndMakeItCurrent();
        $fee->setName('FEE');
        $excel->addRow($header);

        foreach ($data->fee as $tipos) {
            foreach ($tipos as $volumetrias) {
                $row = WriterEntityFactory::createRowFromArray((array) $volumetrias);
                $excel->addRow($row);
            }
        }

        $fi = $excel->addNewSheetAndMakeItCurrent();
        $fi->setName('FI');
        $excel->addRow($header);

        foreach ($data->fi as $tipos) {
            foreach ($tipos as $volumetrias) {
                $row = WriterEntityFactory::createRowFromArray((array) $volumetrias);
                $excel->addRow($row);
            }
        }

        $foip = $excel->addNewSheetAndMakeItCurrent();
        $foip->setName('FOIP');
        $excel->addRow($header);

        foreach ($data->foip as $tipos) {
            foreach ($tipos as $volumetrias) {
                $row = WriterEntityFactory::createRowFromArray((array) $volumetrias);
                $excel->addRow($row);
            }
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

    public function c_getNemonicosCCAccordingDateV2() {
        $fdesde = $this->input->post('desde');
        $fhasta = $this->input->post('hasta');
        $data = $this->Dao_reportes_model->getNemonicosCCAccordingDateV2($fdesde, $fhasta);
        echo json_encode($data);
    }

    public function volumetria_fija() {

        $data = array(
            'active_sidebar' => false,
            'title' => 'Volumetrías',
            'active' => "vol_fija",
            'header' => array('Actividades', 'Volumetría Fija'),
            'sub_bar' => true,
            'f_actual' => date('Y-m-d'),
            'f_inicio' => date('Y-m') . '-01'
        );

        $this->load->view('parts/header', $data);
        $this->load->view('volumetria_fija');
        $this->load->view('parts/footer');
    }
    public function volumetria_mesa_calidad() {

    $data = array(
        'active_sidebar' => false,
        'title' => 'Volumetrías',
        'active' => "areali",
        'header' => array('Mesa de Calidad', 'Volumetría'),
        'sub_bar' => true,
        'f_actual' => date('Y-m-d'),
        'f_inicio' => date('Y-m') . '-01'
    );
    $this->load->view('parts/header', $data);
    $this->load->view('volumetria_mesa_calidad');
    $this->load->view('parts/footer');
}

public function c_getNemonicosQualityTabledAccordingDate() {
    $fdesde = $this->input->post('desde');
    $fhasta = $this->input->post('hasta');
    $data = $this->Dao_reportes_model->getNemonicosQualityTabledAccordingDate($fdesde, $fhasta);
    echo json_encode($data);
}
public function excelVolumetriasMesaCalidad($fdesde, $fhasta) {
        set_time_limit(-1);
        ini_set('memory_limit', '1500M');
        $data_mc_aict5 = $this->Dao_reportes_model->getWorklogByCoordination($fdesde, $fhasta, 'MC_AICT5');
        $data_mc_gorgt4 = $this->Dao_reportes_model->getWorklogByCoordination($fdesde, $fhasta, 'MC_GORGT4');
        $data_mc_gpt5 = $this->Dao_reportes_model->getWorklogByCoordination($fdesde, $fhasta, 'MC_GPT5');
        $data_mc_rpt1 = $this->Dao_reportes_model->getWorklogByCoordination($fdesde, $fhasta, 'MC_RPT1');
        $data_mc_rpt2 = $this->Dao_reportes_model->getWorklogByCoordination($fdesde, $fhasta, 'MC_RPT2');
        $data_mc_rpt3 = $this->Dao_reportes_model->getWorklogByCoordination($fdesde, $fhasta, 'MC_RPT3');
        $data_mc_tpt1 = $this->Dao_reportes_model->getWorklogByCoordination($fdesde, $fhasta, 'MC_T&PT1');
        $data_mc_tpt2 = $this->Dao_reportes_model->getWorklogByCoordination($fdesde, $fhasta, 'MC_T&PT2');
        $data_mc_tp_soct1 = $this->Dao_reportes_model->getWorklogByCoordination($fdesde, $fhasta, 'MC_T&P_SOCT1');
        $data_mc_tp_soct2 = $this->Dao_reportes_model->getWorklogByCoordination($fdesde, $fhasta, 'MC_T&P_SOCT2');

//         echo '<pre>'; print_r($data_tgr); echo '</pre>';
        $excel = WriterEntityFactory::createXLSXWriter();
        $excel->openToBrowser('Volumetrias Mesa de Calidad(' . date('Y-m-d') . ').xlsx');
        // $wrapText = (new StyleBuilder())->setShouldWrapText(false)->build();

        $titles = array('RECORDKEY','CREATEDATE','DESCRIPTION','MODIFYDATE','MODIFYBY','DESCRIPTION_LONGDESCRIPTION','CLASS','LOGTYPE');
        $header = WriterEntityFactory::createRowFromArray($titles);

        $mc_aict5 = $excel->getCurrentSheet();
        $mc_aict5->setName('MC_AICT5');
        $excel->addRow($header);

        foreach ($data_mc_aict5 as $volumetrias) {
            $row = WriterEntityFactory::createRowFromArray((array) $volumetrias);
            $excel->addRow($row);
        }
        // // $ejmplo = WriterEntityFactory::createRowFromArray(array("hola",'qie','pex'));

        $mc_gorgt4 = $excel->addNewSheetAndMakeItCurrent();
        $mc_gorgt4->setName('MC_GORGT4');
        $excel->addRow($header);

        foreach ($data_mc_gorgt4 as $volumetrias) {
            $row = WriterEntityFactory::createRowFromArray((array) $volumetrias);
            $excel->addRow($row);
        }

        $mc_gpt5 = $excel->addNewSheetAndMakeItCurrent();
        $mc_gpt5->setName('MC_GPT5');
        $excel->addRow($header);

        foreach ($data_mc_gpt5 as $volumetrias) {
            $row = WriterEntityFactory::createRowFromArray((array) $volumetrias);
            $excel->addRow($row);
        }

        $mc_rpt1 = $excel->addNewSheetAndMakeItCurrent();
        $mc_rpt1->setName('MC_RPT1');
        $excel->addRow($header);

        foreach ($data_mc_rpt1 as $volumetrias) {
            $row = WriterEntityFactory::createRowFromArray((array) $volumetrias);
            $excel->addRow($row);
        }

        $mc_rpt2 = $excel->addNewSheetAndMakeItCurrent();
        $mc_rpt2->setName('MC_RPT2');
        $excel->addRow($header);

        foreach ($data_mc_rpt2 as $volumetrias) {
            $row = WriterEntityFactory::createRowFromArray((array) $volumetrias);
            $excel->addRow($row);
        }

        $mc_rpt3 = $excel->addNewSheetAndMakeItCurrent();
        $mc_rpt3->setName('MC_RPT3');
        $excel->addRow($header);

        foreach ($data_mc_rpt3 as $volumetrias) {
            $row = WriterEntityFactory::createRowFromArray((array) $volumetrias);
            $excel->addRow($row);
        }

        $mc_tpt1 = $excel->addNewSheetAndMakeItCurrent();
        $mc_tpt1->setName('MC_TPT1');
        $excel->addRow($header);

        foreach ($data_mc_tpt1 as $volumetrias) {
            $row = WriterEntityFactory::createRowFromArray((array) $volumetrias);
            $excel->addRow($row);
        }

        $mc_tpt2 = $excel->addNewSheetAndMakeItCurrent();
        $mc_tpt2->setName('MC_TPT2');
        $excel->addRow($header);

        foreach ($data_mc_tpt2 as $volumetrias) {
            $row = WriterEntityFactory::createRowFromArray((array) $volumetrias);
            $excel->addRow($row);
        }

        $mc_tp_soct1 = $excel->addNewSheetAndMakeItCurrent();
        $mc_tp_soct1->setName('MC_TP_SOCT1');
        $excel->addRow($header);

        foreach ($data_mc_tp_soct1 as $volumetrias) {
            $row = WriterEntityFactory::createRowFromArray((array) $volumetrias);
            $excel->addRow($row);
        }

        $mc_tp_soct2 = $excel->addNewSheetAndMakeItCurrent();
        $mc_tp_soct2->setName('MC_TP_SOCT2');
        $excel->addRow($header);

        foreach ($data_mc_tp_soct2 as $volumetrias) {
            $row = WriterEntityFactory::createRowFromArray((array) $volumetrias);
            $excel->addRow($row);
        }

        $excel->close();
      }
    public function c_getNemonicosFixedAccordingDate() {
        $fdesde = $this->input->post('desde');
        $fhasta = $this->input->post('hasta');
        $data = $this->Dao_reportes_model->getNemonicosFixedAccordingDate($fdesde, $fhasta);
        echo json_encode($data);
    }

    public function enviarDatosExcelVolumetriasFija() {
        $data = json_decode($this->input->post('data'));
        $_SESSION['VolumetriasFija'] = $data;
    }

    public function excelVolumetriasFija() {
        // $data = json_decode($this->input->post('data'));
        $data = $_SESSION['VolumetriasFija'];
//        echo '<pre>'; print_r($data->fohfc); echo '</pre>';
        // echo '<pre>'; print_r((array)$data->faoc[1][0]); echo '</pre>';
        $excel = WriterEntityFactory::createXLSXWriter();
        $excel->openToBrowser('Volumetrias Front Office Fija(' . date('Y-m-d') . ').xlsx');
        // $wrapText = (new StyleBuilder())->setShouldWrapText(false)->build();

        $titles = array('TICKETID', 'ZONA_TKT', 'TIPO_TKT', 'CREATIONDATE', 'CLOSEDATE', 'ACTUALFINISH', 'STATUS', 'INTERNALPRIORITY', 'URGENCY', 'CREATEDBY', 'CHANGEDATE', 'OWNERGROUP', 'LOCATION', 'MUN100', 'AFECTACION_TOTAL_CORE', 'INCEXCLUIR', 'PROVEEDORES', 'TICKET_EXT', 'DESCRIPTION', 'EXTERNALSYSTEM', 'RUTA_TKT', 'INC_ALARMA', 'INCSOLUCION', 'GERENTE', 'REGIONAL', 'PROBLEM_CODE', 'PROBLEM_DESCRIPTION', 'CAUSE_CODE', 'CAUSE_DESCRIPTION', 'REMEDY_CODE', 'REMEDY_DESCRIPTION', 'TIEMPO_VIDA_TKT', 'TIEMPO_RESOLUCION_TKT', 'TIEMPO_DETECCION', 'TIEMPO_ESCALA', 'TIEMPO_FALLA', 'TIPO_T');

        $header = WriterEntityFactory::createRowFromArray($titles);


        $faoc = $excel->getCurrentSheet();
        $faoc->setName('FOHFC');
        $excel->addRow($header);

        foreach ($data->fohfc as $tipos) {
            foreach ($tipos as $volumetrias) {
                $row = WriterEntityFactory::createRowFromArray((array) $volumetrias);
                $excel->addRow($row);
            }
        }
        // // $ejmplo = WriterEntityFactory::createRowFromArray(array("hola",'qie','pex'));

        $titles = array('TICKETID-2', 'ZONA_TKT', 'TIPO_TKT', 'CREATIONDATE', 'CLOSEDATE', 'ACTUALFINISH', 'STATUS', 'INTERNALPRIORITY', 'URGENCY', 'CREATEDBY', 'CHANGEDATE', 'OWNERGROUP', 'LOCATION', 'MUN100', 'AFECTACION_TOTAL_CORE', 'INCEXCLUIR', 'PROVEEDORES', 'TICKET_EXT', 'DESCRIPTION', 'EXTERNALSYSTEM', 'RUTA_TKT', 'INC_ALARMA', 'INCSOLUCION', 'GERENTE', 'REGIONAL', 'PROBLEM_CODE', 'PROBLEM_DESCRIPTION', 'CAUSE_CODE', 'CAUSE_DESCRIPTION', 'REMEDY_CODE', 'REMEDY_DESCRIPTION', 'TIEMPO_VIDA_TKT', 'TIEMPO_RESOLUCION_TKT', 'TIEMPO_DETECCION', 'TIEMPO_ESCALA', 'TIEMPO_FALLA', 'TIPO_T');

        $header = WriterEntityFactory::createRowFromArray($titles);

        $faob = $excel->addNewSheetAndMakeItCurrent();
        $faob->setName('FOIP');
        $excel->addRow($header);

        foreach ($data->foip as $tipos) {
            foreach ($tipos as $volumetrias) {
                $row = WriterEntityFactory::createRowFromArray((array) $volumetrias);
                $excel->addRow($row);
            }
        }

        $fapp = $excel->addNewSheetAndMakeItCurrent();
        $fapp->setName('FOINF');
        $excel->addRow($header);

        foreach ($data->foinf as $tipos) {
            foreach ($tipos as $volumetrias) {
                $row = WriterEntityFactory::createRowFromArray((array) $volumetrias);
                $excel->addRow($row);
            }
        }

        $fee = $excel->addNewSheetAndMakeItCurrent();
        $fee->setName('FOTV');
        $excel->addRow($header);

        foreach ($data->fotv as $tipos) {
            foreach ($tipos as $volumetrias) {
                $row = WriterEntityFactory::createRowFromArray((array) $volumetrias);
                $excel->addRow($row);
            }
        }

        $fi = $excel->addNewSheetAndMakeItCurrent();
        $fi->setName('PILOTO TV');
        $excel->addRow($header);

        foreach ($data->pilototv as $tipos) {
            foreach ($tipos as $volumetrias) {
                $row = WriterEntityFactory::createRowFromArray((array) $volumetrias);
                $excel->addRow($row);
            }
        }

        $foip = $excel->addNewSheetAndMakeItCurrent();
        $foip->setName('FOSMU');
        $excel->addRow($header);


        foreach ($data->fosmu as $tipos) {
            foreach ($tipos as $volumetrias) {
                $row = WriterEntityFactory::createRowFromArray((array) $volumetrias);
                $excel->addRow($row);
            }
        }
        $excel->close();
    }

    public function enviarDatosExcelCustomerCare() {
        $data = json_decode($this->input->post('data'));
        $dataV2 = json_decode($this->input->post('dataV2'));
        $_SESSION['volumetriasCustomerCare'] = $data;
        $_SESSION['volumetriasCustomerCareV2'] = $dataV2;
    }

    public function excelVolumetriasCustomerCareIncidentes($fdesde, $fhasta) {
        $data_tgr = $this->Dao_reportes_model->getIncidentsByCoordination($fdesde, $fhasta, 'TGR:');
        $data_tgt11r = $this->Dao_reportes_model->getIncidentsByCoordination($fdesde, $fhasta, 'TGT11R:');
        $data_tgt5r = $this->Dao_reportes_model->getIncidentsByCoordination($fdesde, $fhasta, 'TGT5R:');
        $data_ccrec_oop = $this->Dao_reportes_model->getIncidentsByCoordination($fdesde, $fhasta, 'CCREC_OOP');
        $data_ccrec_pqr = $this->Dao_reportes_model->getIncidentsByCoordination($fdesde, $fhasta, 'CCREC_PQR');
        $data_ccpyr_prueb = $this->Dao_reportes_model->getIncidentsByCoordination($fdesde, $fhasta, 'CCPYR_PRUEB');
        $data_ccpyr_lider = $this->Dao_reportes_model->getIncidentsByCoordination($fdesde, $fhasta, 'CCPYR_LIDER');
        $data_ccpyr_rutin = $this->Dao_reportes_model->getIncidentsByCoordination($fdesde, $fhasta, 'CCPYR_RUTIN');
        $data_cccom_reg = $this->Dao_reportes_model->getIncidentsByCoordination($fdesde, $fhasta, 'CCCOM_REG');
        $data_ccrec_rec = $this->Dao_reportes_model->getIncidentsByCoordination($fdesde, $fhasta, 'CCREC_REC');
        $data_ccrec_ie = $this->Dao_reportes_model->getIncidentsByCoordination($fdesde, $fhasta, 'CCREC_IE');

//         echo '<pre>'; print_r($data_tgr); echo '</pre>';
        $excel = WriterEntityFactory::createXLSXWriter();
        $excel->openToBrowser('Volumetrias Customer Care Incidentes(' . date('Y-m-d') . ').xlsx');
        // $wrapText = (new StyleBuilder())->setShouldWrapText(false)->build();

        $titles = array('TICKETID', 'ZONA_TKT', 'TIPO_TKT', 'CREATIONDATE', 'CLOSEDATE', 'ACTUALFINISH', 'STATUS', 'INTERNALPRIORITY', 'URGENCY', 'CREATEDBY', 'CHANGEDATE', 'OWNERGROUP', 'LOCATION', 'MUN100', 'AFECTACION_TOTAL_CORE', 'INCEXCLUIR', 'PROVEEDORES', 'TICKET_EXT', 'DESCRIPTION', 'EXTERNALSYSTEM', 'RUTA_TKT', 'INC_ALARMA', 'INCSOLUCION', 'GERENTE', 'REGIONAL', 'PROBLEM_CODE', 'PROBLEM_DESCRIPTION', 'CAUSE_CODE', 'CAUSE_DESCRIPTION', 'REMEDY_CODE', 'REMEDY_DESCRIPTION', 'TIEMPO_VIDA_TKT', 'TIEMPO_RESOLUCION_TKT', 'TIEMPO_DETECCION', 'TIEMPO_ESCALA', 'TIEMPO_FALLA');

        $header = WriterEntityFactory::createRowFromArray($titles);


        $faoc = $excel->getCurrentSheet();
        $faoc->setName('TGR');
        $excel->addRow($header);

        foreach ($data_tgr as $volumetrias) {
            $row = WriterEntityFactory::createRowFromArray((array) $volumetrias);
            $excel->addRow($row);
        }
        // // $ejmplo = WriterEntityFactory::createRowFromArray(array("hola",'qie','pex'));


        $faob = $excel->addNewSheetAndMakeItCurrent();
        $faob->setName('TGT11R');
        $excel->addRow($header);

        foreach ($data_tgt11r as $volumetrias) {
            $row = WriterEntityFactory::createRowFromArray((array) $volumetrias);
            $excel->addRow($row);
        }

        $fapp = $excel->addNewSheetAndMakeItCurrent();
        $fapp->setName('TGT5R');
        $excel->addRow($header);

        foreach ($data_tgt5r as $volumetrias) {
            $row = WriterEntityFactory::createRowFromArray((array) $volumetrias);
            $excel->addRow($row);
        }

        $fee = $excel->addNewSheetAndMakeItCurrent();
        $fee->setName('CCREC_OOP');
        $excel->addRow($header);


        foreach ($data_ccrec_oop as $volumetrias) {
            $row = WriterEntityFactory::createRowFromArray((array) $volumetrias);
            $excel->addRow($row);
        }

        $fi = $excel->addNewSheetAndMakeItCurrent();
        $fi->setName('CCREC_PQR');
        $excel->addRow($header);

        foreach ($data_ccrec_pqr as $volumetrias) {
            $row = WriterEntityFactory::createRowFromArray((array) $volumetrias);
            $excel->addRow($row);
        }

        $foip = $excel->addNewSheetAndMakeItCurrent();
        $foip->setName('CCPYR_PRUEB');
        $excel->addRow($header);

        foreach ($data_ccpyr_prueb as $volumetrias) {
            $row = WriterEntityFactory::createRowFromArray((array) $volumetrias);
            $excel->addRow($row);
        }

        $faoc = $excel->addNewSheetAndMakeItCurrent();
        $faoc->setName('CCPYR_LIDER');
        $excel->addRow($header);

        foreach ($data_ccpyr_lider as $volumetrias) {
            $row = WriterEntityFactory::createRowFromArray((array) $volumetrias);
            $excel->addRow($row);
        }
        // // $ejmplo = WriterEntityFactory::createRowFromArray(array("hola",'qie','pex'));

        $faob = $excel->addNewSheetAndMakeItCurrent();
        $faob->setName('CCPYR_RUTIN');
        $excel->addRow($header);

        foreach ($data_ccpyr_rutin as $volumetrias) {
            $row = WriterEntityFactory::createRowFromArray((array) $volumetrias);
            $excel->addRow($row);
        }

        $fapp = $excel->addNewSheetAndMakeItCurrent();
        $fapp->setName('CCCOM_REG');
        $excel->addRow($header);

        foreach ($data_cccom_reg as $volumetrias) {
            $row = WriterEntityFactory::createRowFromArray((array) $volumetrias);
            $excel->addRow($row);
        }

        $fee = $excel->addNewSheetAndMakeItCurrent();
        $fee->setName('CCREC_REC');
        $excel->addRow($header);

        foreach ($data_ccrec_rec as $volumetrias) {
            $row = WriterEntityFactory::createRowFromArray((array) $volumetrias);
            $excel->addRow($row);
        }

        $fi = $excel->addNewSheetAndMakeItCurrent();
        $fi->setName('CCREC_IE');
        $excel->addRow($header);

        foreach ($data_ccrec_ie as $volumetrias) {
            $row = WriterEntityFactory::createRowFromArray((array) $volumetrias);
            $excel->addRow($row);
        }

        $excel->close();
    }

    public function excelVolumetriasCustomerCareNotas($fdesde, $fhasta) {
        // set_time_limit(-1);
//        ini_set('memory_limit', '1500M');
        $data_tgs = $this->Dao_reportes_model->getNotesByCoordination($fdesde, $fhasta, 'TG:S');
        $data_tgt11s = $this->Dao_reportes_model->getNotesByCoordination($fdesde, $fhasta, 'TGT11S:');
        $data_tgt5s = $this->Dao_reportes_model->getNotesByCoordination($fdesde, $fhasta, 'TGT5S:');
        $data_cccom_mail = $this->Dao_reportes_model->getNotesByCoordination($fdesde, $fhasta, 'CCCOM_MAIL');
        $data_cccom_chats = $this->Dao_reportes_model->getNotesByCoordination($fdesde, $fhasta, 'CCCOM_CHATS');
        $data_ccrec_cci = $this->Dao_reportes_model->getNotesByCoordination($fdesde, $fhasta, 'CCREC_CCI');
        $data_ccrec_son = $this->Dao_reportes_model->getNotesByCoordination($fdesde, $fhasta, 'CCREC_SON');

//         echo '<pre>'; print_r($data_tgs); echo '</pre>';
        $excel = WriterEntityFactory::createXLSXWriter();
        $excel->openToBrowser('VolumetriasCustomerCareNotas(' . date('Y-m-d') . ').xlsx');
//        $wrapText = (new StyleBuilder())->setShouldWrapText(true)->build();

        $titles = array('RECORDKEY', 'CREATEDATE', 'DESCRIPTION', 'MODIFYDATE', 'MODIFYBY', 'DESCRIPTION_LONGDESCRIPTION', 'CLASS', 'LOGTYPE');
        $style = (new StyleBuilder())
                ->setShouldWrapText(false)
                ->build();
        $header = WriterEntityFactory::createRowFromArray($titles, $style);



        $faoc = $excel->getCurrentSheet();
        $faoc->setName('TGS');
        $excel->addRow($header);

        foreach ($data_tgs as $volumetrias) {
            $row = WriterEntityFactory::createRowFromArray(((array) $volumetrias), $style);
            $excel->addRow($row);
        }
        // // $ejmplo = WriterEntityFactory::createRowFromArray(array("hola",'qie','pex'));

        $faob = $excel->addNewSheetAndMakeItCurrent();
        $faob->setName('TGT11S');
        $excel->addRow($header);

        foreach ($data_tgt11s as $volumetrias) {
            $row = WriterEntityFactory::createRowFromArray(((array) $volumetrias), $style);
            $excel->addRow($row);
        }

        $fapp = $excel->addNewSheetAndMakeItCurrent();
        $fapp->setName('TGT5S');
        $excel->addRow($header);

        foreach ($data_tgt5s as $volumetrias) {
            $row = WriterEntityFactory::createRowFromArray(((array) $volumetrias), $style);
            $excel->addRow($row);
        }

        $fee = $excel->addNewSheetAndMakeItCurrent();
        $fee->setName('CCCOM_MAIL');
        $excel->addRow($header);


        foreach ($data_cccom_mail as $volumetrias) {
            $row = WriterEntityFactory::createRowFromArray(((array) $volumetrias), $style);
            $excel->addRow($row);
        }

        $fi = $excel->addNewSheetAndMakeItCurrent();
        $fi->setName('CCCOM_CHATS');
        $excel->addRow($header);

        foreach ($data_cccom_chats as $volumetrias) {
            $row = WriterEntityFactory::createRowFromArray(((array) $volumetrias), $style);
            $excel->addRow($row);
        }

        $foip = $excel->addNewSheetAndMakeItCurrent();
        $foip->setName('CCREC_CCI');
        $excel->addRow($header);

        foreach ($data_ccrec_cci as $volumetrias) {
            $row = WriterEntityFactory::createRowFromArray(((array) $volumetrias), $style);
            $excel->addRow($row);
        }

        $faoc = $excel->addNewSheetAndMakeItCurrent();
        $faoc->setName('CCREC_SON');
        $excel->addRow($header);

        foreach ($data_ccrec_son as $volumetrias) {
            $row = WriterEntityFactory::createRowFromArray(((array) $volumetrias), $style);
            $excel->addRow($row);
        }

        $excel->close();
    }

    public function excelCustomerCareSlas($fdesde, $fhasta) {
        $data_escritas = $this->Dao_reportes_model->getIncidentsByCoordination($fdesde, $fhasta, 'Escritas', 'CCREC_PQR');
        $data_investigacion = $this->Dao_reportes_model->getIncidentsByCoordination($fdesde, $fhasta, 'Investigacion', 'CCREC_PQR');
        $data_investigacion_legal = $this->Dao_reportes_model->getIncidentsByCoordination($fdesde, $fhasta, 'Investigacion-Legal', 'CCREC_PQR');
        $data_cobertura = $this->Dao_reportes_model->getIncidentsByCoordination($fdesde, $fhasta, 'Cobertura', 'CCREC_OOP');

//         echo '<pre>'; print_r($data_tgr); echo '</pre>';
        $excel = WriterEntityFactory::createXLSXWriter();
        $excel->openToBrowser('Volumetrias Customer Care Slas(' . date('Y-m-d') . ').xlsx');
        // $wrapText = (new StyleBuilder())->setShouldWrapText(false)->build();

        $titles = array('TICKETID', 'ZONA_TKT', 'TIPO_TKT', 'CREATIONDATE', 'CLOSEDATE', 'ACTUALFINISH', 'STATUS', 'INTERNALPRIORITY', 'URGENCY', 'CREATEDBY', 'CHANGEDATE', 'OWNERGROUP', 'LOCATION', 'MUN100', 'AFECTACION_TOTAL_CORE', 'INCEXCLUIR', 'PROVEEDORES', 'TICKET_EXT', 'DESCRIPTION', 'EXTERNALSYSTEM', 'RUTA_TKT', 'INC_ALARMA', 'INCSOLUCION', 'GERENTE', 'REGIONAL', 'PROBLEM_CODE', 'PROBLEM_DESCRIPTION', 'CAUSE_CODE', 'CAUSE_DESCRIPTION', 'REMEDY_CODE', 'REMEDY_DESCRIPTION', 'TIEMPO_VIDA_TKT', 'TIEMPO_RESOLUCION_TKT', 'TIEMPO_DETECCION', 'TIEMPO_ESCALA', 'TIEMPO_FALLA');

        $header = WriterEntityFactory::createRowFromArray($titles);


        $escritas = $excel->getCurrentSheet();
        $escritas->setName('Escritas');
        $excel->addRow($header);

        foreach ($data_escritas as $volumetrias) {
            $row = WriterEntityFactory::createRowFromArray((array) $volumetrias);
            $excel->addRow($row);
        }
        // // $ejmplo = WriterEntityFactory::createRowFromArray(array("hola",'qie','pex'));

        $investigacion = $excel->addNewSheetAndMakeItCurrent();
        $investigacion->setName('Investigacion');
        $excel->addRow($header);

        foreach ($data_investigacion as $volumetrias) {
            $row = WriterEntityFactory::createRowFromArray((array) $volumetrias);
            $excel->addRow($row);
        }

        $investigacion_legal = $excel->addNewSheetAndMakeItCurrent();
        $investigacion_legal->setName('Investigacion_Legal');
        $excel->addRow($header);

        foreach ($data_investigacion_legal as $volumetrias) {
            $row = WriterEntityFactory::createRowFromArray((array) $volumetrias);
            $excel->addRow($row);
        }

        $cobertura = $excel->addNewSheetAndMakeItCurrent();
        $cobertura->setName('Cobertura');
        $excel->addRow($header);

        foreach ($data_cobertura as $volumetrias) {
            $row = WriterEntityFactory::createRowFromArray((array) $volumetrias);
            $excel->addRow($row);
        }

        $excel->close();
    }

    // Vista para cambiar opciones del usuario
    public function generar_reportes() {
        if (!$this->session->userdata('id')) {
            header('location: ' . base_url());
        }

        $data = array(
            'active_sidebar' => false,
            'title' => 'Generar Reporte',
            'active' => "createReport",
            'header' => array('Generar Reporte', ''),
            'sub_bar' => true
        );

        $this->load->view('parts/header', $data);
        $this->load->view('generar_reportes');
        $this->load->view('parts/footer');
    }

    public function c_getTablesBySchema() {
        $schema = $this->input->post('schema');
        $data = $this->Dao_reportes_model->getTablesBySchema($schema);
        echo json_encode($data);
    }

    public function c_getColumnsByTable() {
        $schema = $this->input->post('schema');
        $table = $this->input->post('table');
        $data = $this->Dao_reportes_model->getColumnsByTable($schema, $table);
        echo json_encode($data);
    }

    public function c_getGenerateReport() {
        $query = $this->input->post('query');
        $columns = $this->input->post('columns');
        $data = $this->Dao_reportes_model->getGenerateReport($query);
        $return = array();

        $thead = "<tr>";
        foreach ($columns as $value) {
            $thead .= "<th>$value</th>";
        }
        $thead .= "</tr>";

        $tbody = "";
        foreach ($data as $data_value) {
            $tbody .= "<tr>";
            foreach ($columns as $colums_value) {
                $tbody .= "<td>" . $data_value->$colums_value . "</td>";
            }
            $tbody .= "</tr>";
        }

        $return['thead'] = $thead;
        $return['tbody'] = $tbody;

//        print_r($return);
//        exit('termino proceso');

        echo json_encode($return);
    }

    public function excelGenerateReport($query, $colums, $report_name) {
        $query_decode = base64_decode($query);
        $colums_decode = base64_decode($colums);
        $report_decode = base64_decode($report_name);
        $data_insert = array(
            'nombre_reporte'    => $report_decode,
            'query_reporte'     => $query_decode,
            'columnas_reporte'  => $colums_decode,
            'creador_reporte'   => $this->session->userdata('id')
        );

        $data_report = $this->Dao_reportes_model->getGenerateReport($query_decode);
        $insert_report = $this->Dao_reportes_model->insertGenerateReport($data_insert);

//        echo '<pre>'; print_r($colums_decode); echo '</pre>';exit('finaliza proceso');
        $excel = WriterEntityFactory::createXLSXWriter();
        $excel->openToBrowser("$report_decode (" . date('Y-m-d') . ").xlsx");
//        $wrapText = (new StyleBuilder())->setShouldWrapText(false)->build();

        $titles = explode(',', $colums_decode);

        $header = WriterEntityFactory::createRowFromArray($titles);


        $escritas = $excel->getCurrentSheet();
        $escritas->setName($report_decode);
        $excel->addRow($header);

        foreach ($data_report as $volumetrias) {
            $row = WriterEntityFactory::createRowFromArray((array) $volumetrias);
            $excel->addRow($row);
        }

        $excel->close();
    }

}

/* End of file reportes.php */
