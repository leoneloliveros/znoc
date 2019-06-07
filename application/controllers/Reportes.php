<?php


defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH.'libraries/spout/src/Spout/Autoloader/autoload.php';
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Box\Spout\Common\Entity\Style\Color;
ini_set('memory_limit',-1);
class Reportes extends CI_Controller
{ 
  function __construct(){
    parent::__construct();
    $this->load->model('Dao_reportes_model');
  }

  public function volumetria()
  {
    
    $data = array(
        'active_sidebar' => false,
        'title'          => 'Volumetrías',
        'active'         => "areali",
        'header'         => array('Actividades','Volumetría'),
        'sub_bar'        => true,
        'f_actual'       => date('Y-m-d')
    );

    $this->load->view('parts/header', $data);
    $this->load->view('parts/datesRange');
    $this->load->view('volumetria');
    $this->load->view('parts/footer');
    
  }

  public function c_getNemonicosAccordingDate()
  {
    $fdesde = $this->input->post('desde');
    $fhasta = $this->input->post('hasta');
    $data = $this->Dao_reportes_model->getNemonicosAccordingDate($fdesde,$fhasta);
    echo json_encode($data);
  }
  
  public function reporte_sla()
  {
    
    $data = array(
        'active_sidebar' => false,
        'title'          => 'Reporte SLAs',
        'active'         => "slali",
        'header'         => array('Reporte','SLAs'),
        'sub_bar'        => true,
        'f_actual'       => date('Y-m-d'),
        'f_inicio'       => date('Y-m') . '-01'
    );

    $this->load->view('parts/header', $data);
    $this->load->view('reporte_sla');
    $this->load->view('parts/footer');
    
  }
  
  public function c_getInfoReportSlas()
  {
    $fdesde = $this->input->post('desde');
    $fhasta = $this->input->post('hasta');
    $data = $this->Dao_reportes_model->getInfoReportSlas($fdesde, $fhasta);
    echo json_encode($data);
  }

  public function care($tipo)
  {
    $data = array(
      'active_sidebar' => true,
      'title'          => 'Customer Care',
      'active'         => $tipo,
      'header'         => array('Customer Care', strtoupper($tipo)),
      'sub_bar'        => true,
      'f_actual'       => date('Y-m-d')
  );

    $this->load->view('parts/header', $data);
    $this->load->view('parts/datesRange');
    $this->load->view('Care');
    $this->load->view('parts/footer'); 
  }
  
  public function enviarDatosExcel()
  {
    $data = json_decode($this->input->post('data'));
    $_SESSION['x'] = $data;
  }

  public function excelVolumetrias()
  {
    // $data = json_decode($this->input->post('data'));
    $data = $_SESSION['x'];
    // echo '<pre>'; print_r($data->faoc); echo '</pre>';
    // echo '<pre>'; print_r("lol"); echo '</pre>';
    
    $excel = WriterEntityFactory::createXLSXWriter();
    $excel->openToBrowser('Volumetrias('.date('Y-m-d').').xlsx');
    $wrapText = (new StyleBuilder())->setShouldWrapText(false)->build();
    
    $titles = array('TICKETID','ZONA_TKT','TIPO_TKT','CREATIONDATE','CLOSEDATE','ACTUALFINISH','STATUS','INTERNALPRIORITY','URGENCY','CREATEDBY','CHANGEDATE','OWNERGROUP','LOCATION','MUN100','AFECTACION_TOTAL_CORE','INCEXCLUIR','PROVEEDORES','TICKET_EXT','DESCRIPTION','EXTERNALSYSTEM','RUTA_TKT','INC_ALARMA','INCSOLUCION','GERENTE','REGIONAL','PROBLEM_CODE','PROBLEM_DESCRIPTION','CAUSE_CODE','CAUSE_DESCRIPTION','REMEDY_CODE','REMEDY_DESCRIPTION','TIEMPO_VIDA_TKT','TIEMPO_RESOLUCION_TKT','TIEMPO_DETECCION','TIEMPO_ESCALA','TIEMPO_FALLA','TIPO TURNO');
    $styleHeader = (new StyleBuilder())
      ->setBackgroundColor(Color::rgb(12, 65, 117))
      ->setFontColor(Color::WHITE)
      ->build();
    
    $header = WriterEntityFactory::createRowFromArray($titles,$styleHeader);

    
    $faoc = $excel->getCurrentSheet();
    $faoc->setName('FAOC');
    $excel->addRow($header);

    foreach ($data->faoc as $turnos) {
      foreach ($turnos as $row) {
        $celdas = array();
        
        foreach ($row as $value) {
          array_push($celdas,WriterEntityFactory::createCell($value, $wrapText));
        }
          
          $row = WriterEntityFactory::createRow($celdas);
          $excel->addRow($row);
      }
    }
    // // $ejmplo = WriterEntityFactory::createRowFromArray(array("hola",'qie','pex'));
    
    $faob = $excel->addNewSheetAndMakeItCurrent();
    $faob->setName('FAOB');
    $excel->addRow($header);
    
    foreach ($data->faob as $turnos) {
      foreach ($turnos as  $row) {
        $celdas = array();
        foreach ($row as $value) {
          array_push($celdas,WriterEntityFactory::createCell($value, $wrapText));
        }
          $row = WriterEntityFactory::createRow($celdas);
          $excel->addRow($row);
      }
    }

    $fapp = $excel->addNewSheetAndMakeItCurrent();
    $fapp->setName('FAPP');
    $excel->addRow($header);
    
    foreach ($data->fapp as $turnos) {
      foreach ($turnos as  $row) {
        $celdas = array();
        foreach ($row as $value) {
          array_push($celdas,WriterEntityFactory::createCell($value, $wrapText));
        }
          $row = WriterEntityFactory::createRow($celdas);
          $excel->addRow($row);
      }
    }

    $fee = $excel->addNewSheetAndMakeItCurrent();
    $fee->setName('FEE');
    $excel->addRow($header);
    
    foreach ($data->fee as $turnos) {
      foreach ($turnos as  $row) {
        $celdas = array();
        foreach ($row as $value) {
          array_push($celdas,WriterEntityFactory::createCell($value, $wrapText));
        }
          $row = WriterEntityFactory::createRow($celdas);
          $excel->addRow($row);
      }
    }

    $fi = $excel->addNewSheetAndMakeItCurrent();
    $fi->setName('FI');
    $excel->addRow($header);
    
    foreach ($data->fi as $turnos) {
      foreach ($turnos as  $row) {
        $celdas = array();
        foreach ($row as $value) {
          array_push($celdas,WriterEntityFactory::createCell($value, $wrapText));
        }
          $row = WriterEntityFactory::createRow($celdas);
          $excel->addRow($row);
      }
    }

    $foip = $excel->addNewSheetAndMakeItCurrent();
    $foip->setName('FOIP');
    $excel->addRow($header);
    
    foreach ($data->foip as $turnos) {
      foreach ($turnos as  $row) {
        $celdas = array();
        foreach ($row as $value) {
          array_push($celdas,WriterEntityFactory::createCell($value, $wrapText));
        }
          $row = WriterEntityFactory::createRow($celdas);
          $excel->addRow($row);
      }
    }
    $excel->close();
  }

}

  /* End of file reportes.php */