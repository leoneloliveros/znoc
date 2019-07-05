<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Dao_bitacoras_model extends CI_Model {

  public function saveCCIHFC($data)
  {
    $this->db->insert('cci_hfc', $data);
    return $this->db->affected_rows();
  }

  public function saveBookLogsAccordingType($dataGen,$specificData,$table)
  {
    // echo '<pre>'; print_r($dataGen); echo '</pre>';
    $this->db->insert('logbooks',$dataGen);
    // echo '<pre>'; print_r($this->db->last_query()); echo '</pre>';


    if ($this->db->affected_rows() == 1)  {

      $specificData['id_logbooks'] = $this->db->insert_id();

      $this->db->insert($table,$specificData);
      // echo '<pre>'; print_r($this->db->last_query()); echo '</pre>';

      if ($this->db->affected_rows() == 1)  {

        // return 'xxxx';
        return true;
      }else{
        return "no guarda en la tabla $table";
      }
    }else{
      return "no guarda en la tabla logBooks";
    }
    // echo '<pre>'; print_r($this->db->last_query()); echo '</pre>';
    // echo '<pre>'; print_r("============"); echo '</pre>';


  }
  public function getAreas()
  {
    $query = $this->db->query("SELECT subarea FROM areasrelations WHERE area = 'Dilo_FrontOffice' ");
    return $query->result();
  }
  public function getEngineersForLogBooks($tipo)
  {
    $query = $this->db->select('CONCAT(u.nombres," ",u.apellidos) AS ing, u.id_users AS id')
      ->from('users u')
      ->join('roles r','u.role = r.id','INNER')
      ->where('r.area',$tipo)
      ->get();
      // echo '<pre>'; print_r($query->result()); echo '</pre>';
      $ingenieros = array();
      foreach ($query->result() as $row)
          $ingenieros[$row->id]=$row->ing;
    return $ingenieros;

  }

}

/* End of file Dao_bitacoras_model.php */

?>
