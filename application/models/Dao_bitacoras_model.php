<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dao_bitacoras_model extends CI_Model {

    public function saveCCIHFC($data) {
        $this->db->insert('cci_hfc', $data);
        return $this->db->affected_rows();
    }

    public function saveBookLogsAccordingType($dataGen, $specificData, $table) {
        // echo '<pre>'; print_r($dataGen); echo '</pre>';
        $this->db->insert('logbooks', $dataGen);
        // echo '<pre>'; print_r($this->db->last_query()); echo '</pre>';


        if ($this->db->affected_rows() == 1) {

            $specificData['id_logbooks'] = $this->db->insert_id();

            $this->db->insert($table, $specificData);
            // echo '<pre>'; print_r($this->db->last_query()); echo '</pre>';

            if ($this->db->affected_rows() == 1) {

                // return 'xxxx';
                return true;
            } else {
                return "no guarda en la tabla $table";
            }
        } else {
            return "no guarda en la tabla logBooks";
        }
        // echo '<pre>'; print_r($this->db->last_query()); echo '</pre>';
        // echo '<pre>'; print_r("============"); echo '</pre>';
    }

    public function getAreas() {
        $query = $this->db->query("SELECT subarea FROM areasrelations WHERE area = 'Dilo_frontOfficeMovil' ");
        return $query->result();
    }

    public function getEngineersForLogBooks($tipo) {
        $id = $this->db->query("SELECT id FROM roles WHERE area = '$tipo' AND name ='ingeniero'");
        $di = $id->row()->id;
        $query = $this->db->select('CONCAT(u.nombres," ",u.apellidos) AS ing, u.id_users AS id')
                ->from('users u')
                ->join('role_user ru', 'u.id_users = ru.user_id', 'INNER')
                ->where('ru.role_id', $di)
                ->get();
        // print_r($this->db->last_query().';<br>');
        // echo '<pre>'; print_r($query->result()); echo '</pre>';
        $ingenieros = array();
        foreach ($query->result() as $row)
            $ingenieros[$row->id] = $row->ing;
        return $ingenieros;
    }

    public function getEngineersByAreaAndRol($rol, $area) {
        $query = $this->db->query("
          SELECT u.id_users, CONCAT(u.nombres, ' ', u.apellidos) ingeniero
          FROM users u
          INNER JOIN role_user ru
          ON ru.user_id = u.id_users
          INNER JOIN roles r
          ON r.id = ru.role_id
          WHERE r.name = '$rol'
          AND r.area = '$area'
      ");
        //    print_r($this->db->last_query().';<br>');
        return $query->result();
    }

    public function crearBitacoraBackOffice($info) {
        $query = $this->db->query("
            INSERT INTO
            znoc.BITACORA_BO(
              ingeniero ,
              fecha ,
              horario ,
              ticket  ,
              tarea ,
              estacion  ,
              prioridad  ,
              tipo_de_servicio  ,
              detalle_de_actividad  ,
              regional  ,
              ciudad  ,
              entrada_del_ticket  ,
              fecha_y_hora_ingreso_tarea  ,
              hora_inicio_trabajo  ,
              hora_final_trabajo  ,
              tiempo_revision  ,
              destino_del_ticket  ,
              seguimiento  ,
              causa_de_falla  ,
              diagnostico_ticket  ,
              tipo_de_soporte  ,
              ticket_mal_gestionado_TMG  ,
              area_dirigida_TMG  ,
              ruta_sin_documentar_RSD  ,
              ruta_desactualizada  ,
              check_de_excluido
            )
            VALUES
            (
              '" . $info['ingeniero'] . "',
              '" . $info['fecha'] . "',
              '" . $info['horario'] . "',
              '" . $info['ticket'] . "',
              '" . $info['tarea'] . "',
              '" . $info['estacion'] . "',
              '" . $info['prioridad'] . "',
              '" . $info['tipoDeServicio'] . "',
              '" . $info['detalleDeActividad'] . "',
              '" . $info['regional'] . "',
              '" . $info['ciudad'] . "',
              '" . $info['entradaDelTicket'] . "',
              '" . $info['fechaYHoraIngresoTarea'] . "',
              '" . $info['horaInicioTrabajo'] . "',
              '" . $info['horaFinalTrabajo'] . "',
              '" . $info['tiempoRevision'] . "',
              '" . $info['destinoDelTicket'] . "',
              '" . $info['seguimiento'] . "',
              '" . $info['causaDeFalla'] . "',
              '" . $info['diagnosticoTicket'] . "',
              '" . $info['tipoDeSoporte'] . "',
              '" . $info['ticketMalGestionadoTMG'] . "',
              '" . $info['areaDirigidaTMG'] . "',
              '" . $info['rutaSinDocumentarRSD'] . "',
              '" . $info['rutaDesactializadaRD'] . "',
              '" . $info['checkDeExcluido'] . "'
            )
            "
        );

        if ($query) {
            return "Registro Exitoso";
        } else {
            echo "Hay un error en el registro de comentarios";
        }
    }

    public function getBinnacleByTypeActivityAndIncident($tipo_actividad, $num_tk_incidente, $tabla) {
        $query = $this->db->query("
          SELECT *
          FROM logbooks lb
          INNER JOIN $tabla tb
          ON lb.id_logbooks = tb.id_logbooks
          WHERE lb.tipo_actividad = '$tipo_actividad'
          AND lb.num_tk_incidente = $num_tk_incidente
      ");
           // print_r($this->db->last_query().';<br>');
        return $query->result();
    }

    public function getDepartaments($value)
    {
      $consulta = $this->db->query("SELECT id_departamentos, sigla, region, departamento FROM departamentos WHERE sigla = '$value'");
      // print_r($this->db->last_query().';<br>');

      return $consulta->result();
    }

    public function showdepartamento()
{
    $consulta = $this->db->query("SELECT sigla FROM departamentos");
    return $consulta->result();
  }

  public function getIncidentFO($queryresult) {
      $query = $this->db->query($queryresult);
      $data = $query->result();
      $_SESSION['x'] = $data;
      return $data;
  }

}

/* End of file Dao_bitacoras_model.php */
