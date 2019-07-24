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
        'active_sidebar' => false,
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
  public function c_getDataFromIncidentesFija()
  {
    $fdesde = $this->input->post('desde');
    $fhasta = $this->input->post('hasta');
    $data = $this->Dao_reportes_model->getIncidentesFija($fdesde,$fhasta);
    echo json_encode($data);
  }
  public function excelIncidentesFija()
  {
    $data = $_SESSION['x'];
    // echo '<pre>'; print_r("lol"); echo '</pre>';
    

      $writer = WriterEntityFactory::createXLSXWriter();
      $style = (new StyleBuilder())
      ->setShouldWrapText(false)
      ->build();

      $writer->openToBrowser('IncidentesFija('.date('Y-m-d').').xlsx');
      $titles = array('TICKETID', 'INTERNALPRIORITY', 'REGIONAL', 'PRIMER_GRUPO', 'OWNERGROUP', 'CREATIONDATE', 'CLOSEDATE', 'ACTUALFINISH', 'STATUS', 'STATUSDATE', 'RUTA_TKT', 'ACTIVIDAD', 'FECHAREPORTE_ACTI', 'FECHACAMBIO_ACTI', 'ESTADO_ACTI' );

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
      $titles = array('TICKETID','INTERNALPRIORITY','STATUS','CREATIONDATE','ACTUALFINISH','FECHA_CIERRE_TKT','DESCRIPTION','REGIONAL','RUTA_TKT','OWNERGROUP','PRIMER_GRUPO','TIEMPO_OTROS_GRUPOS','TIEMPO_ESCALA_FO_M','T_REAL_FO','RG_TIEMPO_ESCALA_FO_M','TIEMPO_ESCALA_BO_H','RG_TI_ESCALA_BO','CAN_OT_FIBRA','TI_OT_FIBRA_REAL_H','RG_TI_OT_FIBRA','CAN_OT_CCOAX','TI_OT_CCOAX_REAL_H','RG_TI_OT_CCOAX','CAN_TAS_QA','TI_TAS_QA_REAL_M','RG_TI_TAS_QA_M','TI_CIERRE_TAS_H','TIEMPO_CAMPO_H','TIEMPO_VIDA_TKT_H','TIEMPO_BO_H');

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


  public function c_getDataFromWorkInfo()
  {
    $fdesde = $this->input->post('desde');
    $fhasta = $this->input->post('hasta');
    $data = $this->Dao_reportes_model->getWorkInfo($fdesde,$fhasta);
    echo json_encode($data);
  }
  public function excelWorkInfoMesaCalidad()
  {
    $data = $_SESSION['x'];
    // echo '<pre>'; print_r("lol"); echo '</pre>';
    

      $writer = WriterEntityFactory::createXLSXWriter();
      $style = (new StyleBuilder())
      ->setShouldWrapText(false)
      ->build();

      $writer->openToBrowser('workinfo('.date('Y-m-d').').xlsx');
      $titles = array('CREADO POR', 'TICKET ID', 'CREACION NOTA', 'RESUMEN NOTA', 'DETALLE NOTA', 'CREACION INCIDENTE', 'ESTADO INCIDENTE', 'INCIDENTE CREADO POR', 'INCIDENTE CREADO NOMBRE', 'DESCRIPCION INCIDENTE', 'FECHA CIERRE INCIDENTE', 'RUTA CLASIFICACION', 'TIPO INCIDENTE', 'ARTICULO DE CONFIGURACION', 'FECHA AFECTACION', 'PRIORIDAD', 'URGENCIA', 'IMPACTO', 'PROVEEDORES', 'UBICACION', 'GRUPO PROPIETARIO');

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

  public function c_getDataFromAlarmasAutomatismo()
  {
    $fdesde = $this->input->post('desde');
    $fhasta = $this->input->post('hasta');
    $data = $this->Dao_reportes_model->getAlarmasAutomatismo($fdesde,$fhasta);
    echo json_encode($data);
  }
  public function excelAlarmasAutomatismo()
  {
    $data = $_SESSION['x'];
    // echo '<pre>'; print_r("lol"); echo '</pre>';
    

      $writer = WriterEntityFactory::createXLSXWriter();
      $style = (new StyleBuilder())
      ->setShouldWrapText(false)
      ->build();

      $writer->openToBrowser('AlarmasAutomatismo('.date('Y-m-d').').xlsx');
      $titles = array('TICKET ID', 'DESCRIPCION INCIDENTE', 'ESTADO INCIDENTE', 'PRIORIDAD', 'PROVEEDORES', 'FECHA CREACION INCIDENTE', 'FECHA CIERRE INCIDENTE', 'GRUPO PROPIETARIO', 'CREADO POR ID', 'CREADO POR NOMBRE', 'ARTICULO CONFIGURACION', 'RUTA CLASIFICACION', 'ELEMENTO DE RED', 'ID GLOBAL', 'ID ALARMA', 'ALARMA', 'FECHA CREACION ALARMA', 'FECHA CANCELACION ALARMA', 'UBICACION', 'EXCLUSION', 'INCIDENTE EXCLUSION', 'INCIDENTE CODIGO FALLA', 'CODIGO CAUSA CIERRE');

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

  public function c_getDataFromTareasFOPerformance()
  {
    $fdesde = $this->input->post('desde');
    $fhasta = $this->input->post('hasta');
    $data = $this->Dao_reportes_model->getTareasFOPerformance($fdesde,$fhasta);
    echo json_encode($data);
  }
  public function excelTareasFOPerformance()
  {
    $data = $_SESSION['x'];
    // echo '<pre>'; print_r("lol"); echo '</pre>';
    

      $writer = WriterEntityFactory::createXLSXWriter();
      $style = (new StyleBuilder())
      ->setShouldWrapText(false)
      ->build();

      $writer->openToBrowser('TareasFOPerformance('.date('Y-m-d').').xlsx');
      $titles = array('TAREA', 'FECHA CREACION DE TAREA', 'DESCRIPCION TAREA', 'ESTADO TAREA', 'FECHA ESTADO', 'INCIDENTE', 'FECHA CREACION INCIDENTE', 'ESTADO INCIDENTE', 'DESCRIPCION INCIDENTE', 'FECHA CIERRE INCIDENTE', 'CREADOR DE NOTA', 'FECHA NOTA', 'RESUMEN NOTA', 'DETALLE NOTA');

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

  public function c_getTiempoAtencion()
  {
    $fdesde = $this->input->post('desde');
    $fhasta = $this->input->post('hasta');
    $data = $this->Dao_reportes_model->getTiempoAtencion($fdesde,$fhasta);
    echo json_encode($data);
  }
  public function excelTiempoAtencion()
  {
    $data = $_SESSION['x'];
    // echo '<pre>'; print_r("lol"); echo '</pre>';
    

      $writer = WriterEntityFactory::createXLSXWriter();
      $style = (new StyleBuilder())
      ->setShouldWrapText(false)
      ->build();

      $writer->openToBrowser('TiempoAtencion('.date('Y-m-d').').xlsx');
      $titles = array('INCIDENTE', 'FECHA CREACION INCIDENTE', 'PRIORIDAD INCIDENTE', 'ESTADO INCIDENTE', 'GRUPO PROPIETARIO INCIDENTE', 'FECHA CREACION OT TAS', 'ESTADO ACT', 'REGIONAL ACT', 'GRUPO ACT', 'TIPO ACT', 'TIEMPO ESCALAMIENTO');

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

  public function c_getControlTicket()
  {
    $fdesde = $this->input->post('desde');
    $fhasta = $this->input->post('hasta');
    $data = $this->Dao_reportes_model->getControlTicket($fdesde,$fhasta);
    echo json_encode($data);
  }
  public function excelControlTicket()
  {
    $data = $_SESSION['x'];
    // echo '<pre>'; print_r("lol"); echo '</pre>';
    

      $writer = WriterEntityFactory::createXLSXWriter();
      $style = (new StyleBuilder())
      ->setShouldWrapText(false)
      ->build();

      $writer->openToBrowser('ControlTickets('.date('Y-m-d').').xlsx');
      $titles = array('INCIDENTE', 'CREATIONDATE', 'TIEMPO_TRANSCURRIDO', 'ALERTA', 'FECHA_REPORTE', 'INTERNALPRIORITY', 'STATUS', 'OWNERGROUP');

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
  public function c_getGestionPerformance()
  {
    $fdesde = $this->input->post('desde');
    $fhasta = $this->input->post('hasta');
    $data = $this->Dao_reportes_model->getGestionPerformance($fdesde,$fhasta);
    echo json_encode($data);
  }
  public function excelGestionPerformance()
  {
    $data = $_SESSION['x'];
    // echo '<pre>'; print_r("lol"); echo '</pre>';
    

      $writer = WriterEntityFactory::createXLSXWriter();
      $style = (new StyleBuilder())
      ->setShouldWrapText(false)
      ->build();

      $writer->openToBrowser('GestionPerformance('.date('Y-m-d').').xlsx');
      $titles = array('TICKETID', 'ZONA_TKT', 'TIPO_TKT', 'CREATIONDATE', 'CLOSEDATE', 'ACTUALFINISH', 'STATUS', 'INTERNALPRIORITY', 'URGENCY', 'CREATEDBY', 'CHANGEDATE', 'OWNERGROUP', 'LOCATION', 'MUN100', 'AFECTACION_TOTAL_CORE', 'INCEXCLUIR', 'INCMEXCLUSION', 'PROVEEDORES', 'TICKET_EXT', 'DESCRIPTION', 'EXTERNALSYSTEM', 'RUTA_TKT', 'INC_ALARMA', 'INCSOLUCION', 'GERENTE', 'REGIONAL', 'CIUDAD_MUNICIPIO', 'FAILURECODE', 'PROBLEM_CODE', 'PROBLEM_DESCRIPTION', 'CAUSE_CODE', 'CAUSE_DESCRIPTION', 'REMEDY_CODE', 'REMEDY_DESCRIPTION', 'TIEMPO_VIDA_TKT', 'TIEMPO_RESOLUCION_TKT', 'TIEMPO_DETECCION', 'TIEMPO_ESCALA', 'TIEMPO_FALLA', 'TIEMPO_OT_ALM');

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