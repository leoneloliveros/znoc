<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dao_crq_model extends CI_Model {

	public function __construct(){

	}

	// Retorna row de la tabla mc_crqs_mw
	public function getByCrq($crq){
		$query = $this->db->get_where('mc_crqs_mw', array('crq', $crq));
		return $query->row();
	}

	// Insertar en la tabla mc_crqs_mw
	public function insertar_crq($data){
		if ($this->db->insert('mc_crqs_mw', $data)) {
			return true;
		} else {
			return false;
		}
	}

}