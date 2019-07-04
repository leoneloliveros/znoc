<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dao_malla_model extends CI_Model {

	public function __construct(){

	}

	// Inserta evento en bd tabla malla
	public function insert_event($data){
		if ($this->db->insert('malla', $data)) {
			return true;
		} else {
			return false;
		}		
	}

	// se verifica si existe un registro
	public function getRegister($id, $mes, $ano){
		$query = $this->db->query("
				SELECT COUNT(1) AS cant FROM malla WHERE id_usuario = '$id' AND mes = '$mes' AND ano = '$ano' LIMIT 1
			");
		return $query->row()->cant;
	}

	// actualiza eventos en la tabla malla.
	public function update_event($data, $where){
		$this->db->where($where);
        if($this->db->update('malla', $data)){
        	return 1;
        }else {
			$error = $this->db->error();
			return $error['message'];
		}
	}

	// retorna todos los eventos de la malla con base al mes y ño que se le pase
	public function get_events_by_month($where){
		$query = $this->db->get_where('malla', $where);
		return $query->result_array();
	}

	// elimina de la tabla malla where $where
	public function delete_malla($where){
		$this->db->where($where);
		if($this->db->delete('malla')){
        	return 1;
        }else {
			$error = $this->db->error();
			return $error['message'];
		}
	}

}