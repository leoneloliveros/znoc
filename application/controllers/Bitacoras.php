<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'libraries/spout/src/Spout/Autoloader/autoload.php';
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Box\Spout\Common\Entity\Style\Color;

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
        $date1 = DateTime::createFromFormat('d/m/Y H:i', $info['fechaYHoraIngresoTarea']);
        $info['fechaYHoraIngresoTarea'] = $date1->format('Y-m-d H:i');

        $date = str_replace('/', '-', $info['fecha'] );
        $info['fecha'] = date("Y-m-d", strtotime($date));

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
            'title' => 'BackOffice',
            'active' => 'bitac-cci-hfc',
            'header' => array('Consultar Actividades', 'CCI Y HFC'),
            'sub_bar' => true,
        );


        $this->load->view('parts/header', $data);
        $this->load->view('bitacoras/exportBitacoraBO');
        $this->load->view('parts/footer');
    }

    public function cargarBitacoraBO($fechaInicio, $fechaFinal) {
        $this->load->library('Datatables');

        $bitacora_BO_table = $this->datatables->init();
        $bitacora_BO_table->select('*')->from('znoc.BITACORA_BO')->where("DATE_FORMAT(fecha, '%Y-%m-%d') BETWEEN '$fechaInicio' and '$fechaFinal'");

        $bitacora_BO_table
            ->style(array(
            'class' => 'table table-striped',
            ))
          ->column('Igeniero','ingeniero')
          ->column('Fecha','fecha')
          ->column('Horario','horario')
          ->column('Ticket','ticket')
          ->column('Tarea','tarea')
          ->column('Estación','estacion')
          ->column('Prioridad','prioridad')
          ->column('Tipo de servicio','tipo_de_servicio')
          ->column('Detalle de la actividad','detalle_de_actividad')
          ->column('Regional','regional')
          ->column('Ciudad','ciudad')
          ->column('Entrada de ticket','entrada_del_ticket')
          ->column('Fecha y hora (Ingreso de tarea)','fecha_y_hora_ingreso_tarea')
          ->column('Hora inicio de trabajo','hora_inicio_trabajo')
          ->column('Hora final de trabajo','hora_final_trabajo')
          ->column('Tiempo de revision','tiempo_revision')
          ->column('Destino del ticket','destino_del_ticket')
          ->column('Seguimiento','seguimiento')
          ->column('Causa de falla','causa_de_falla')
          ->column('Diagnostigo del ticket','diagnostico_ticket')
          ->column('Tipo de soporte','tipo_de_soporte')
          ->column('Ticket mal gestionado TMG','ticket_mal_gestionado_TMG')
          ->column('Area dirigida TMG','area_dirigida_TMG')
          ->column('Ruta sin documento RSD','ruta_sin_documentar_RSD')
          ->column('Ruta desactualiazada','ruta_desactualizada')
          ->column('Excluido','check_de_excluido');

        $this->datatables->create('bitacora_BO_table', $bitacora_BO_table);
        $this->load->view('bitacoras/loadBOData');
    }

    public function c_getBinnacleByTypeActivityAndIncident() {
        $tipo_actividad = $this->input->post('tipo_actividad');
        $num_tk_incidente = $this->input->post('num_tk_incidente');
        $tabla = $this->input->post('tabla');
        $bitac = $this->Dao_bitacoras_model->getBinnacleByTypeActivityAndIncident($tipo_actividad, $num_tk_incidente, $tabla);
        echo json_encode($bitac);
    }
    public function getDepartaments()
    {
      $departamento = $this->input->post('departamento');
      // echo $departamento;
      $query = $this->Dao_bitacoras_model->getDepartaments($departamento);
      // var_dump($query);
      echo json_encode($query);
    }
    public function showdepartamento()
    {
      $query = $this->Dao_bitacoras_model->showdepartamento();

      echo json_encode($query);

    }
    public function getIncidentsFO()
    {
      $query = $this->input->post('query');
      $data = $this->Dao_bitacoras_model->getIncidentFO($query);
      echo json_encode($data);
    }
    public function exportIncidentsFO()
    {
      $data = $_SESSION['x'];
      // echo '<pre>'; print_r("lol"); echo '</pre>';


        $writer = WriterEntityFactory::createXLSXWriter();
        $style = (new StyleBuilder())
        ->setShouldWrapText(false)
        ->build();

        $writer->openToBrowser('IncidentesFOMovil('.date('Y-m-d').').xlsx');
        $titles = array('ID','INGENIERO','FECHA', 'HORARIO','TICKET','TAREA','ESTACION','PRIORIDAD','TIPO DE SERVICIO','DETALLE DE ACTIVIDAD','REGIONAL','CIUDAD','ENTRADA DE TICKET','FECHA Y HORA INGRESO DE TAREA','HORA INICIO DE TRABAJO','HORA FINAL DE TRABAJO','TIEMPO DE REVISION','DESTINO DEL TICKET','SEGUIMIENTO','CAUSA DE FALLA','DIAGNOSTICO DEL TICKET','TIPO DE SOPORTE','TICKET MAL GESTIONADO TMG',
      'AREA DIRIGIDA TMG','RUTA SIN DOCUMENTAR RSD','RUTA DESACTUALIZADA','EXCLUIDO');

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
/* End of file Bitacoras.php */
?>
