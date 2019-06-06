<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Dao_reportes_model extends CI_Model {

  public function getNemonicosAccordingDate($fi,$ff)
  {
    $this->db->where('(DESCRIPTION LIKE "%FAOC:%"');
    $this->db->or_where('DESCRIPTION LIKE "%FAOB:%"');
    $this->db->or_where('DESCRIPTION LIKE "%FAPP:%"');
    $this->db->or_where('DESCRIPTION LIKE "%FEE:%"');
    $this->db->or_where('DESCRIPTION LIKE "%FI:%"');
    $this->db->or_where('DESCRIPTION LIKE "%FOIP:%")');
    $this->db->where("DATE_FORMAT(`CREATIONDATE`, '%Y-%m-%d') BETWEEN '$fi' AND '$ff'");
    $this->db->order_by('DESCRIPTION','DESC');
    $query = $this->db->get('maximo.INCIDENT');
    // echo '<pre>'; print_r($this->db->last_query()); echo '</pre>';
    // echo '<pre>'; print_r("======================"); echo '</pre>';
    return $query->result();
    // echo '<pre>'; print_r($query->result()); echo '</pre>';
  }
}

/* End of file Dao_reportes_model.php */