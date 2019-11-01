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
  public function editBinnacleMC($ids)
  {
    $consulta = $this->db->query("SELECT * FROM bitacora_mc WHERE id = '$ids'");
    return $consulta -> result();
  }
  public function updateBitGeneral($value)
  {
    // $actividad = $value['actividad'];
    $id = $value['id'];
    // var_dump( $value);
    // $query = $this->db->query("UPDATE znoc.bitacora_mc SET actividad='$actividad' WHERE id='$id'");
    $this->db->where('id', $id);
    $this->db->update('znoc.bitacora_mc', $value);
  }
  public function editBinnacleTI($ids)
  {
    $consulta = $this->db->query("SELECT * FROM turno_integral WHERE id = '$ids'");
    return $consulta -> result();
  }
  public function updateBitTI($value)
  {
    // $actividad = $value['actividad'];
    $id = $value['id'];
    // var_dump($id);
    // $query = $this->db->query("UPDATE znoc.bitacora_mc SET actividad='$actividad' WHERE id='$id'");
    $this->db->where('id', $id);
    $this->db->update('znoc.turno_integral', $value);
  }


}
?>
