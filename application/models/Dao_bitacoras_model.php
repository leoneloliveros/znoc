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
    $query = $this->db->query("SELECT subarea FROM areasrelations WHERE area = 'Dilo_frontOfficeMovil' ");
    return $query->result();
  }
  public function getEngineersForLogBooks($tipo)
  {
    $id = $this->db->query("SELECT id FROM roles WHERE area = '$tipo' AND name ='ingeniero'");
    $di = $id->row()->id;
    $query = $this->db->select('CONCAT(u.nombres," ",u.apellidos) AS ing, u.id_users AS id')
      ->from('users u')
      ->join('role_user ru','u.id_users = ru.user_id','INNER')
      ->where('ru.role_id',$di)
      ->get();
         // print_r($this->db->last_query().';<br>');
      // echo '<pre>'; print_r($query->result()); echo '</pre>';
      $ingenieros = array();
      foreach ($query->result() as $row)
          $ingenieros[$row->id]=$row->ing;
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

}

/* End of file Dao_bitacoras_model.php */
