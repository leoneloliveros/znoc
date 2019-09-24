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

    public function Reporte() {
        $opcion = $this->input->post('opcion');
        $tituloExcel = strtolower(substr($opcion, strrpos($opcion, "_") + 1));
        $ini2 = $this->input->post('fechaIni');
        $fin2 = $this->input->post('fechaFin');
        $date_1 = DateTime::createFromFormat('d/m/Y', $ini2);
        $date_2 = DateTime::createFromFormat('d/m/Y', $fin2);
        if ($date_1 || $date_2 ) {
          $fin = $date_2->format('Y-m-d');
          $ini = $date_1->format('Y-m-d');
        }

        // print_r($ini);
        // exit();

        if ($opcion == "General") {
            echo "accion PENDIENTE, no deverias estar aquí";
        } else {
            $data = $this->Dao_reportes_model->export($tituloExcel, $ini, $fin);

            $writer = WriterEntityFactory::createXLSXWriter();
            $wrapText = (new StyleBuilder())
                    ->setShouldWrapText(false)
                    ->build();

            $writer->openToBrowser("Bitacora " . $tituloExcel . ".xlsx"); // stream data directly to the browser
            $titles = array('id_energias', 'id_logbooks', 'tiempo_deteccion', 'tipo_falla', 'inicio_actividad', 'fin_actividad', 'tipo_actividad', 'estado', 'num_tk_incidente', 'descripcion', 'ingeniero', 'id_users', 'turno', 'ot_tarea', 'area_asignacion', 'responsable', 'caso_de_uso', 'prioridad','estaciones_afectadas','tipo_incidente','puesto');

            $styleHeader = (new StyleBuilder())
                    ->setBackgroundColor(Color::rgb(12, 65, 117))
                    ->setFontColor(Color::WHITE)
                    ->build();

            $header = WriterEntityFactory::createRowFromArray($titles, $styleHeader);
            $writer->addRow($header);

            foreach ($data as $val) {
                $cells = array();
                foreach ($val as $val1) {
                    array_push($cells, WriterEntityFactory::createCell($val1, $wrapText));
                }
                $rowFromValues = WriterEntityFactory::createRow($cells);
                $writer->addRow($rowFromValues);
            }
            $writer->close();
        }
    }

    public function c_ReporteCciHfc() {
        $opcion = $this->input->post('opcion');
        $ini = $this->input->post('fechaIni');
        $fin = $this->input->post('fechaFin');

        $date_1 = DateTime::createFromFormat('d/m/Y', $ini);
        $ini = $date_1->format('Y-m-d');
        $date_2 = DateTime::createFromFormat('d/m/Y', $fin);
        $fin = $date_2->format('Y-m-d');

        $data_report = $this->Dao_reportes_model->ReporteCciHfc($opcion, $ini, $fin);

        $excel = WriterEntityFactory::createXLSXWriter();
        $excel->openToBrowser("Bitacora " . $opcion . ".xlsx");
        // $wrapText = (new StyleBuilder())->setShouldWrapText(false)->build();

        $titles = array('PRIORIDAD', 'INCIDENTE', 'INGENIERO', 'FECHA INICIO', 'FECHA FINAL', 'ESTADO DEL INCIDENTE', 'ACTIVIDAD', 'OBSERVACIÓN', 'ERROR DE FLUJO', 'ERROR DE WFM', 'TAS QC NO EXITOSO', 'PYMES', 'MAL CATEGORIZADOS', 'OT CERRADA SIN CAUSAS DE CIERRE', 'TIPO BITACORA', 'FECHA INICIO DE ACTIVIDAD', 'FECHA FINALIZACION DE ACTIVIDAD');

        $header = WriterEntityFactory::createRowFromArray($titles);


        $faoc = $excel->getCurrentSheet();
        $faoc->setName($opcion);
        $excel->addRow($header);

        foreach ($data_report as $dataReport) {
            $row = WriterEntityFactory::createRowFromArray((array) $dataReport);
            $excel->addRow($row);
        }

        $excel->close();
    }

}

?>
