<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dao_tipo_tareas_model extends CI_Model {

	public function __construct(){

	}

	//Retorna toda la tabla mc_tipo_tareas
	public function get_all_tipo_tareas(){
		$query = $this->db->get('mc_tipo_tareas');
		return $query->result();
	}

	

}