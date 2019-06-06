<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Dao_reportes_model extends CI_Model {

  public function getNemonicosAccordingDate($fi,$ff)
  {
    $this->db->where('(DESCRIPTION LIKE "FAOC:%"');
    $this->db->or_where('DESCRIPTION LIKE "FAOB:%"');
    $this->db->or_where('DESCRIPTION LIKE "FAPP:%"');
    $this->db->or_where('DESCRIPTION LIKE "FEE:%"');
    $this->db->or_where('DESCRIPTION LIKE "FI:%"');
    $this->db->or_where('DESCRIPTION LIKE "FOIP:%")');
    $this->db->where("CREATIONDATE BETWEEN '$fi' AND '$ff'");
    $this->db->order_by('DESCRIPTION','DESC');
    $query = $this->db->get('maximo.INCIDENT');
    echo '<pre>'; print_r($this->db->last_query()); echo '</pre>';
    // echo '<pre>'; print_r("======================"); echo '</pre>';
    return $query->result();
    // echo '<pre>'; print_r($query->result()); echo '</pre>';
  }
  
  //Retorna el nombre del trabajo, el subestado, y los puntos de acuerdo al id de las tablas puntos, tipo_trabajo y subestado --jc
    public function getInfoReportSlas($fdesde,$fhasta){
        $query = $this->db->query("
            SELECT 
                (CASE WHEN DESCRIPTION LIKE '%FAOC%' THEN 'FAOC'
                    WHEN DESCRIPTION LIKE '%FAOB%' THEN 'FAOB'
                    WHEN DESCRIPTION LIKE '%FAPP%' THEN 'FAPP'
                    WHEN DESCRIPTION LIKE '%FEE%' THEN 'FEE'
                    WHEN DESCRIPTION LIKE '%FI%' THEN 'FI'
                    WHEN DESCRIPTION LIKE '%FOIP%' THEN 'FOIP'
                    ELSE 'Sin coordinación'
                END) AS coordinacion,
                SUM(IF(INTERNALPRIORITY = 1 AND URGENCY = 1 AND TIEMPO_ESCALA <= 20, 1, 0)) AS 'alta_alta_20_min',
                SUM(IF(INTERNALPRIORITY = 1 AND URGENCY = 2 AND TIEMPO_ESCALA <= 40, 1, 0)) AS 'alta_media_40_min',
                SUM(IF(INTERNALPRIORITY = 2 AND TIEMPO_ESCALA <= 60, 1, 0)) AS 'medias_60',
                SUM(IF(INTERNALPRIORITY = 3 AND TIEMPO_ESCALA <= 80, 1, 0)) AS 'bajas_80',
                SUM(IF(INTERNALPRIORITY IS NULL, 1, 0)) AS 'nulos',
                COUNT(TICKETID) AS total_incidentes
            FROM maximo.INCIDENT
            WHERE DATE_FORMAT(CREATIONDATE, '%Y-%m-%d') BETWEEN '$fdesde' AND '$fhasta'
            GROUP BY (CASE WHEN DESCRIPTION LIKE '%FAOC%' THEN 'FAOC'
                        WHEN DESCRIPTION LIKE '%FAOB%' THEN 'FAOB'
                        WHEN DESCRIPTION LIKE '%FAPP%' THEN 'FAPP'
                        WHEN DESCRIPTION LIKE '%FEE%' THEN 'FEE'
                        WHEN DESCRIPTION LIKE '%FI%' THEN 'FI'
                        WHEN DESCRIPTION LIKE '%FOIP%' THEN 'FOIP'
                    END)
        ");
        return $query->result();
    }
}

/* End of file Dao_reportes_model.php */