<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bitacora_MC_Model extends CI_Model {

public function saveBinnacle($value, $tabla)
  {
    // var_dump($value);
    $query = $this->db->insert($tabla ,$value);
    if ($query) {
        return "Datos Guardados correctamente";
    } else {
        echo "Hay un error en el registro de comentarios";
      }
  }

  public function getIncidentMC($queryresult) {
      $query = $this->db->query($queryresult);
      $data = $query->result();
      $_SESSION['x'] = $data;
      return $data;
  }

  public function getIncidentsTI($queryresult) {
      $query = $this->db->query($queryresult);
      $data = $query->result();
      $_SESSION['x'] = $data;
      return $data;
  }


}
?>
