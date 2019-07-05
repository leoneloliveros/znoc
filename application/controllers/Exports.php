<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'libraries/spout/src/Spout/Autoloader/autoload.php';

use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Box\Spout\Common\Entity\Style\Color;

class Exports extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Dao_reportes_model');
    }
    public function Reporte()
    {
      $opcion = $this->input->post('opcion');
      $tituloExcel = strtolower(substr($opcion, strrpos($opcion,"_") + 1));
      $ini = $this->input->post('fechaIni');
      $fin = $this->input->post('fechaFin');

      if ($opcion == "General") {
        echo "accion PENDIENTE, no deverias estar aquí";
      }else {
        $data = $this->Dao_reportes_model->export($tituloExcel,$ini,$fin);

        $writer = WriterEntityFactory::createXLSXWriter();
        $wrapText = (new StyleBuilder())
        ->setShouldWrapText(false)
        ->build();

        $writer->openToBrowser("Bitacora ".$tituloExcel.".xlsx"); // stream data directly to the browser
        $titles = array('id_energias', 'id_logbooks', 'tiempo_deteccion','tipo_falla', 'id_logbooks', 'inicio_actividad', 'fin_actividad', 'tipo_actividad', 'estado', 'num_tk_incidente', 'descripcion',  'id_users',  'turno',  'ot_tarea',  'area_asignacion', 'responsable', 'caso_de_uso', 'prioridad', 'tipo_incidente', 'estaciones_afectadas');

        $styleHeader = (new StyleBuilder())
          ->setBackgroundColor(Color::rgb(12, 65, 117))
          ->setFontColor(Color::WHITE)
          ->build();

        $header = WriterEntityFactory::createRowFromArray($titles,$styleHeader);
        $writer->addRow($header);

        foreach ($data as $val) {
          $cells = array();
          foreach ($val as $val1) {
            array_push($cells,WriterEntityFactory::createCell($val1,$wrapText));
          }
          $rowFromValues = WriterEntityFactory::createRow($cells);
          $writer->addRow($rowFromValues);
        }
        $writer->close();
      }

    }

}
?>
