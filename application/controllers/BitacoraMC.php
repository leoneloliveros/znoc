<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'libraries/spout/src/Spout/Autoloader/autoload.php';
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Box\Spout\Common\Entity\Style\Color;

class BitacoraMC extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Bitacora_MC_Model');
    }

  public function index()
  {
    if (!$this->session->userdata('id')) {
        header('location: ' . base_url());
    }
  $data = array(
      'active_sidebar' => false,
      'title' => 'Bitacoras MC',
      'active' => "bitacora_mc",
      'header' => array('Crear Bitacora', 'Mesa de Calidad'),
      'sub_bar' => true
  );
    $this->load->view('parts/header', $data);
    $this->load->view('BitMesaCalidad');
    $this->load->view('parts/footer');
  }

  public function saveBinnacle()
  {
      $guardarBitacora = $this->input->post('datosBitGeneral');
      $date_1 = DateTime::createFromFormat('d/m/Y H:i', $guardarBitacora['fecha_hora_inicio']);
      $guardarBitacora['fecha_hora_inicio'] = $date_1->format('Y-m-d H:i');
      $date_2 = DateTime::createFromFormat('d/m/Y H:i', $guardarBitacora['fecha_hora_fin']);
      $guardarBitacora['fecha_hora_fin'] = $date_2->format('Y-m-d H:i');
      $table = 'bitacora_mc';
      $query = $this->Bitacora_MC_Model->saveBinnacle($guardarBitacora,$table);
      // var_dump($guardarBitacora);
  }

  public function saveBitTI()
  {
    $guardarBitacoraTI = $this->input->post('datosBitacoraTI2');
    $date_1 = DateTime::createFromFormat('d/m/Y H:i', $guardarBitacoraTI['fecha_hora_solicitud']);
    $guardarBitacoraTI['fecha_hora_solicitud'] = $date_1->format('Y-m-d H:i');
    $date_2 = DateTime::createFromFormat('d/m/Y H:i', $guardarBitacoraTI['fecha_hora_respuesta']);
    $guardarBitacoraTI['fecha_hora_respuesta'] = $date_2->format('Y-m-d H:i');
    $table = 'turno_integral';
    $query = $this->Bitacora_MC_Model->saveBinnacle($guardarBitacoraTI,$table);
  }

  public function ConsultarBitacorasMC()
  {
  $data = array(
      'active_sidebar' => false,
      'title' => 'Consultar Bitacoras MC',
      'active' => "consultar_bitacora_mc",
      'header' => array('Consultar Bitacora', 'Mesa de Calidad'),
      'sub_bar' => true
  );
    $this->load->view('parts/header', $data);
    $this->load->view('consultarMC');
    $this->load->view('parts/footer');
  }

  public function cargarBitacoraMc($fecha1, $fecha2, $bitacora)
  {
    // echo $bitacora;

    if ($bitacora == 'general') {
      $this->load->library('Datatables');
      $bitacoraMC = $this->datatables->init();
      $bitacoraMC->select('mc.id,mc.ingeniero,mc.fecha_hora_inicio,mc.fecha_hora_fin,mc.duracion,mc.actividad,mc.nombre_reporte,mc.nemonico,mc.incidente,mc.resumen,mc.tarea,mc.tk_creado,mc.falla_masiva,mc.causal_de_cierre,mc.estado,mc.degradacion_por_packet_abis,mc.obaservaciones, week(mc.fecha_hora_inicio) as  weeks')->from('bitacora_mc mc')->where("DATE_FORMAT(fecha_hora_inicio, '%Y-%m-%d') BETWEEN '$fecha1' and '$fecha2'");
      $bitacoraMC
          ->style(array(
          'class' => 'table table-striped',
          ))
        ->column('Igeniero','ingeniero')
        ->column('Fecha de Inicio','fecha_hora_inicio')
        ->column('Fecha y hora fin','fecha_hora_fin')
        ->column('Duracion','duracion')
        ->column('Actividad','actividad')
        ->column('Nombre del Reporte','nombre_reporte')
        ->column('Nemonico','nemonico')
        ->column('Incidente','incidente')
        ->column('Resumen','resumen')
        ->column('Tarea','tarea')
        ->column('TK creado','tk_creado')
        ->column('Falla masiva','falla_masiva')
        ->column('Causal de Cierre','causal_de_cierre')
        ->column('Estado','estado')
        ->column('Degradacion por packet Abis','degradacion_por_packet_abis')
        ->column('Obseraciones','obaservaciones')
        ->column('Semana','weeks')
        ->column('Editar','id', function($id){
          $input = "
            <a href='".base_url('BitacoraMC/EditarBitacorasMC/').$id.''."' class=\"openFormAcces\" title=\"Editar Bitacora\">
              <i class=\"fas fa-edit\"></i>
            </a>";
            return $input;
        });

      $this->datatables->create('bitacoraMC', $bitacoraMC);
      $this->load->view('bitacoras/loadBitacoraMC');
    }

    elseif ($bitacora == 'turno_integral') {

      $this->load->library('Datatables');
      $bitacoraTI = $this->datatables->init();
      $bitacoraTI->select('*')->from('turno_integral')->where("DATE_FORMAT(fecha_hora_solicitud, '%Y-%m-%d') BETWEEN '$fecha1' and '$fecha2'");
      $bitacoraTI
          ->style(array(
          'class' => 'table table-striped',
          ))
        ->column('Fecha de Solicitud','fecha_hora_solicitud')
        ->column('Solicitante','solicitante')
        ->column('Resumen de solicitud','resumen_solicitud')
        ->column('Incidente','incidente')
        ->column('Medio','medio')
        ->column('Tipificacion','tipificacion')
        ->column('Ingeniero','ingeniero')
        ->column('Nemonicon','nemonicon')
        ->column('Fecha y Hora de Respuesta','fecha_hora_respuesta')
        ->column('Tiempo de respuesta','tiempo_respuesta')
        ->column('Observaciones','observaciones')
        ->column('Editar','id', function($id){
          $input = "
            <a href='".base_url('BitacoraMC/EditarBitacoraTI/').$id.''."' class=\"openFormAcces\" title=\"Editar Bitacora\">
              <i class=\"fas fa-edit\"></i>
            </a>";
            return $input;
        });

      $this->datatables->create('bitacoraTI', $bitacoraTI);
      $this->load->view('bitacoras/loadBitacoraTI');
    }

  }
    public function getIncidentsMC()
    {
      $query = $this->input->post('query');
      $data = $this->Bitacora_MC_Model->getIncidentMC($query);
      echo json_encode($data);
    }

    public function exportIncidentsMC($fecha1, $fecha2)
    {
      $data = $_SESSION['x'];
      // echo '<pre>'; print_r("lol"); echo '</pre>';


        $writer = WriterEntityFactory::createXLSXWriter();
        $style = (new StyleBuilder())
        ->setShouldWrapText(false)
        ->build();

        $writer->openToBrowser('Bitacora General MC ('.date($fecha1).'     '.date($fecha2).').xlsx');
        $titles = array('ID','INGENIERO','FECHA HORA INICIO', 'FECHA HORA FIN','DURACION','ACTIVIDAD','NOMBRE DEL REPORTE','NEMONICO','INCIDENTE','RESUMEN','TAREA','TK CREADO','FALLA MASIVA','CAUSAL DE CIERRE','ESTADO','DEGRADACION POR PACKET ABIS','OBSERVACIONES','SEMANA');

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

    public function getIncidentsTI()
    {
      $query = $this->input->post('query');
      $data = $this->Bitacora_MC_Model->getIncidentsTI($query);
      echo json_encode($data);
    }

    public function exportIncidentsTI($fecha1, $fecha2)
    {
      $data = $_SESSION['x'];
      // echo '<pre>'; print_r("lol"); echo '</pre>';


        $writer = WriterEntityFactory::createXLSXWriter();
        $style = (new StyleBuilder())
        ->setShouldWrapText(false)
        ->build();

        $writer->openToBrowser('Bitacora Turno Integral MC ('.date($fecha1).'     '.date($fecha2).').xlsx');
        $titles = array('ID','FECHA Y HORA DE SOLICITUD','SOLICITANTE', 'RESUMEN DE SOLICITUD','INCIDENTE','MEDIO','TIPIFICACION','INGENIERO','NEMONICO','FECHA Y HORA DE RESPUESTA','TIEMPO DE RESPUESTA','OBSERVACIONES');

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

    public function EditarBitacorasMC($ids)
    {

    $data = array(
        'active_sidebar' => false,
        'title' => 'Editar Bitacoras MC',
        'active' => "editar_bitacora_mc",
        'header' => array('Editar Bitacora', 'Mesa de Calidad'),
        'sub_bar' => true
    );
      $getInfo = $this->editBinnacleMC($ids);

      $data['info'] = $getInfo;
      $this->load->view('parts/header', $data);
      $this->load->view('EditarBitacoraMC');
      $this->load->view('parts/footer');
    }

    public function editBinnacleMC($ids)
    {
      $query = $this->Bitacora_MC_Model->editBinnacleMC($ids);
      return (Array)$query;
    }

    public function updateBitGeneral()
    {
      $guardarBitacora = $this->input->post('datosBitGeneral');
      $date_1 = DateTime::createFromFormat('d/m/Y H:i', $guardarBitacora['fecha_hora_inicio']);
      $guardarBitacora['fecha_hora_inicio'] = $date_1->format('Y-m-d H:i');
      $date_2 = DateTime::createFromFormat('d/m/Y H:i', $guardarBitacora['fecha_hora_fin']);
      $guardarBitacora['fecha_hora_fin'] = $date_2->format('Y-m-d H:i');
      $query = $this->Bitacora_MC_Model->updateBitGeneral($guardarBitacora);
    }

    public function EditarBitacoraTI($ids)
    {

    $data = array(
        'active_sidebar' => false,
        'title' => 'Editar Bitacoras TI',
        'active' => "editar_bitacora_ti",
        'header' => array('Editar Bitacora', 'Turno Integral'),
        'sub_bar' => true
    );
    $getInfo = $this->editBinnacleTI($ids);
    $data['info'] = $getInfo;

      $this->load->view('parts/header', $data);
      $this->load->view('editarBitTI');
      $this->load->view('parts/footer');
    }
    public function editBinnacleTI($ids)
    {
      $query = $this->Bitacora_MC_Model->editBinnacleTI($ids);
      return (Array)$query;
    }
    public function updateBitTI()
    {
      $guardarBitacoraTI = $this->input->post('datosBitacoraTI');
      $date_1 = DateTime::createFromFormat('d/m/Y H:i', $guardarBitacoraTI['fecha_hora_solicitud']);
      $guardarBitacoraTI['fecha_hora_solicitud'] = $date_1->format('Y-m-d H:i');
      $date_2 = DateTime::createFromFormat('d/m/Y H:i', $guardarBitacoraTI['fecha_hora_respuesta']);
      $guardarBitacoraTI['fecha_hora_respuesta'] = $date_2->format('Y-m-d H:i');
      $query = $this->Bitacora_MC_Model->updateBitTI($guardarBitacoraTI);
    }


}

?>
