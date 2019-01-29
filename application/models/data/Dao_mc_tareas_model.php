<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dao_mc_tareas_model extends CI_Model {

	public function __construct(){

	}

	// funcion para insertar una tarea nueva en tabla mc_tareas_crqs
	public function insertar_tarea($data){
		if ($this->db->insert('mc_tareas_crqs', $data)) {
			return true;
		} else {
			return false;
		}
	}

	// Retorna todas las tareas que tengan asignado ingeniero
	public function get_tareas_asignadas($id_usuario = false, $fechaAsignacion = false){
		$where_ingeniero = ($id_usuario) ? "AND t.ingeniero_bo_tx = $id_usuario" : "";
		$where_fecha_asignacion = ($fechaAsignacion) ? "AND crq.fecha_asignacion = '$fechaAsignacion'" : "";
		$query = $this->db->query("
			SELECT
			t.id_tarea_crq,
			t.crq,
			t.id_tipo_tareas,
			t.ingeniero_bo_tx,
			t.estado_tarea,
			t.motivo_estado,
			t.area_asignada,
			t.fecha_ultimo_seguimiento,
			crq.id_subred,
			crq.info_ejecucion,
			crq.fecha_asignacion,
			crq.solicitante_remedy,
			ti.tipo_tarea,
			ti.nombre_actividad,
			sr.subred,
			CONCAT(u.nombres, ' ', u.apellidos ) AS ingeniero
			FROM
			mc_tareas_crqs AS t
			INNER JOIN mc_crqs_mw AS crq ON t.crq = crq.crq
			INNER JOIN mc_tipo_tareas AS ti ON t.id_tipo_tareas = ti.id_tipo_tareas
			LEFT JOIN mc_subredes AS sr ON crq.id_subred = sr.id_subred
			INNER JOIN usuarios AS u ON t.ingeniero_bo_tx = u.id_usuario
			WHERE
			t.ingeniero_bo_tx IS NOT NULL 
			$where_ingeniero 
			$where_fecha_asignacion
		");

		return $query->result();
	}


	// Retorna todas las actividades pendientes por asignar
	public function get_tareas_pendientes(){
		$query = $this->db->query("
			SELECT
			crq.crq,
			crq.info_ejecucion,
			crq.solicitante_remedy,
			tt.tipo_tarea
			FROM
			mc_crqs_mw AS crq
			INNER JOIN mc_tareas_crqs AS ta ON ta.crq = crq.crq
			INNER JOIN mc_tipo_tareas AS tt ON ta.id_tipo_tareas = tt.id_tipo_tareas
			WHERE
			ta.ingeniero_bo_tx IS NULL
		");
		return $query->result();
	}

	// Retorna las listas de los distintas opciones
	public function get_option_list(){
		$query = $this->db->get('listas');
		return $query->result();
	}

	// Retorna todas las tareas completas
	public function get_todas_las_tareas(){
		$query = $this->db->query("
			SELECT
			t.id_tarea_crq,
			t.crq,
			t.id_tipo_tareas,
			t.ingeniero_bo_tx,
			t.estado_tarea,
			t.motivo_estado,
			t.area_asignada,
			t.fecha_ultimo_seguimiento,
			crq.id_subred,
			crq.info_ejecucion,
			crq.fecha_asignacion,
			crq.solicitante_remedy,
			ti.tipo_tarea,
			ti.nombre_actividad,
			sr.subred,
			CONCAT(u.nombres, ' ', u.apellidos ) AS ingeniero
			FROM
			mc_tareas_crqs AS t
			INNER JOIN mc_crqs_mw AS crq ON t.crq = crq.crq
			INNER JOIN mc_tipo_tareas AS ti ON t.id_tipo_tareas = ti.id_tipo_tareas
			LEFT JOIN mc_subredes AS sr ON crq.id_subred = sr.id_subred
			LEFT JOIN usuarios AS u ON t.ingeniero_bo_tx = u.id_usuario

		");
		return $query->result();
	}






}	