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


	// retorna solo la lista de regiones
	public function get_lists_regiones(){
		$query = $this->db->select('regional')
							->from('mc_subredes')
							->group_by('regional')
							->get();
		return $query->result();
	}

	// retorna listado redes segun nombre de region
	public function get_list_red_by_region($region){
		$query = $this->db->select('red')
							->from('mc_subredes')
							->where('regional', $region)
							->group_by('red')
							->get();
		return $query->result();
	}

	// Retoprna listado de subredes segun la red seleccionada
	public function get_list_subred_by_red($red){
		$query = $this->db->select('id_subred,subred')
							->from('mc_subredes')
							->where('red', $red)
							->get();
		return $query->result();
	}

	// RETORNBA LISTADO DE ESTADOS PARA MW
	public function get_lists_estados(){
		$query = $this->db->select('id_lista, valores')
							->from('listas')
							->where('lista', 'mc_estado')
							->get();
		return $query->result();
	}

	//RETORNBA LISTADO DE MOTIVOS ESTADOS PARA MW
	public function get_lists_motivos(){
		$query = $this->db->select('id_lista, valores')
							->from('listas')
							->where('lista', 'mc_motivo_estado')
							->get();
		return $query->result();
	}

	// RETORNA LISTADO DE ARA ASIGNADA PARA MW
	public function get_lists_area_asignada(){
		$query = $this->db->select('id_lista, valores')
							->from('listas')
							->where('lista', 'mc_area_asignada')
							->get();
		return $query->result();
	}

	// Retorna todos registros y columnas de la tabla mc_subredes
	public function get_all_subredes(){
		$query = $this->db->get('mc_subredes');
		return $query->result();
	}

	// Actualiza la tabla mc_crqs_mw pasandole el array y el crq
	public function update_crq($data, $crq){
		$this->db->where_in('crq', $crq);
        $this->db->update('mc_crqs_mw', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->affected_rows();
        } else {
            return 0;
        }
	}


}