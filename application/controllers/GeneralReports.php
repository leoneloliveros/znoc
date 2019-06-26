<?php


defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH.'libraries/spout/src/Spout/Autoloader/autoload.php';
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Box\Spout\Common\Entity\Style\Color;

class GeneralReports extends CI_Controller
{ 
  function __construct(){
    parent::__construct();
    $this->load->model('Dao_reportes_model');
  }

  public function showReports()
  {
    
    $data = array(
        'active_sidebar' => true,
        'title'          => 'Reportes',
        'active'         => "Reportes",
        'header'         => array('Reportes','Generales'),
        'sub_bar'        => true,
        'f_actual'       => date('Y-m-d')
    );

    $this->load->view('parts/header', $data);
    $this->load->view('Reports/index');
    $this->load->view('parts/footer');
    
  }
  public function c_getDataFromMaximoWorkInfo()
  {
    $fdesde = $this->input->post('desde');
    $fhasta = $this->input->post('hasta');
    $data = $this->Dao_reportes_model->getDataWorkInfo($fdesde,$fhasta);
    echo json_encode($data);
  }
  public function excelWorkInfo()
  {
    $data = $_SESSION['x'];
    // echo '<pre>'; print_r("lol"); echo '</pre>';
    

      $writer = WriterEntityFactory::createXLSXWriter();
      $style = (new StyleBuilder())
      ->setShouldWrapText(false)
      ->build();

      $writer->openToBrowser('workinfo('.date('Y-m-d').').xlsx');
      $titles = array('TICKETID');

      $header = WriterEntityFactory::createRowFromArray($titles);
      $writer->addRow($header);

      foreach ($data as $val) {
        $cells = array();
        foreach ($val as $val1) {
          array_push($cells,WriterEntityFactory::createCell($val1,$style));
        }
        $rowFromValues = WriterEntityFactory::createRow($cells);
        $writer->addRow($rowFromValues);
      }
      $writer->close();

  }
  public function c_getDataFromTiemposNOCEste()
  {
    $fdesde = $this->input->post('desde');
    $fhasta = $this->input->post('hasta');
    $data = $this->Dao_reportes_model->getTiempoNOCEste($fdesde,$fhasta);
    echo json_encode($data);
  }
  public function excelTiemposNOCEste()
  {
    $data = $_SESSION['x'];
    // echo '<pre>'; print_r("lol"); echo '</pre>';
    

      $writer = WriterEntityFactory::createXLSXWriter();
      $style = (new StyleBuilder())
      ->setShouldWrapText(false)
      ->build();

      $writer->openToBrowser('workinfo('.date('Y-m-d').').xlsx');
      $titles = array('TICKETID');

      $header = WriterEntityFactory::createRowFromArray($titles);
      $writer->addRow($header);

      foreach ($data as $val) {
        $cells = array();
        foreach ($val as $val1) {
          array_push($cells,WriterEntityFactory::createCell($val1,$style));
        }
        $rowFromValues = WriterEntityFactory::createRow($cells);
        $writer->addRow($rowFromValues);
      }
      $writer->close();

  }

  public function c_getDataFromTiempoFija()
  {
    $fdesde = $this->input->post('desde');
    $fhasta = $this->input->post('hasta');
    $data = $this->Dao_reportes_model->getDataTiempoFija($fdesde,$fhasta);
    echo json_encode($data);
  }
  public function excelTiempoFija()
  {
    $data = $_SESSION['x'];
    // echo '<pre>'; print_r("lol"); echo '</pre>';
    

      $writer = WriterEntityFactory::createXLSXWriter();
      $style = (new StyleBuilder())
      ->setShouldWrapText(false)
      ->build();

      $writer->openToBrowser('TiempoFija('.date('Y-m-d').').xlsx');
      $titles = array('TICKETID','INTERNALPRIORITY','STATUS varchar','CREATIONDATE','ACTUALFINISH','FECHA_CIERRE_TKT','DESCRIPTION','REGIONAL','RUTA_TKT','OWNERGROUP','PRIMER_GRUPO','TIEMPO_OTROS_GRUPOS','TIEMPO_ESCALA_FO_M','T_REAL_FO','RG_TIEMPO_ESCALA_FO_M','TIEMPO_ESCALA_BO_H','RG_TI_ESCALA_BO','CAN_OT_FIBRA','TI_OT_FIBRA_REAL_H','RG_TI_OT_FIBRA','CAN_OT_CCOAX','TI_OT_CCOAX_REAL_H','RG_TI_OT_CCOAX','CAN_TAS_QA','TI_TAS_QA_REAL_M','RG_TI_TAS_QA_M','TI_CIERRE_TAS_H','TIEMPO_CAMPO_H','TIEMPO_VIDA_TKT_H','TIEMPO_BO_H');

      $header = WriterEntityFactory::createRowFromArray($titles);
      $writer->addRow($header);

      foreach ($data as $val) {
        $cells = array();
        foreach ($val as $val1) {
          array_push($cells,WriterEntityFactory::createCell($val1,$style));
        }
        $rowFromValues = WriterEntityFactory::createRow($cells);
        $writer->addRow($rowFromValues);
      }
      $writer->close();

  }

}

  /* End of file reportes.php */