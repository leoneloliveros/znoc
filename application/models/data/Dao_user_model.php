<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dao_user_model extends CI_Model {

    public function __construct() {
        
    }

    //consulta usuario unico por username
    public function getUserByUsername($id) {
        $query = $this->db->get_where('users', array('id_users' => $id));
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }

    //consulta usuario unico por password
    public function validatePass($pass, $id_user) {
        $query = $this->db->get_where('users', array('contrasena' => $pass, 'id_users' => $id_user));
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return null;
        }
    }

    // obtiene todos los ingenieros y su id
    public function getEngineers() {
        $query = $this->db->query("
			SELECT id_users AS id, CONCAT(nombres,' ',apellidos) AS title
			FROM users;
		");

        return $query->result();
    }

    //trae la contraseña del usuario en sesion
    public function get_pass_by_id($user) {
        $query = $this->db->query("
				SELECT contrasena FROM users WHERE id_users = $user;
			");
        return $query->row();
    }

    public function m_Update_pass_or_email($user, $data) {
        $this->db->where('id_users', $user);
        if ($this->db->update('usuario', $data)) {
            return 1;
        } else {
            return 0;
        }
    }

    // Obtiene el usuario segun la cedula que le de
    public function getUserById($id_user) {
        $query = $this->db->get_where('usuario', array('id_users' => $id_user));
        return $query->row();
    }

    // retorna id de usuario segun su nombre
    public function get_user_by_name($name) {
        $query = $this->db->query("
            SELECT id_users FROM usuario
            WHERE CONCAT(nombres,' ', apellidos) LIKE '%$name%'
        ");

        return $query->row();
    }

    // actualizar campo de la tabla de usuario
    public function update_usuarios($id, $data) {
        $this->db->where_in('id_users', $id);
        $this->db->update('users', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->affected_rows();
        } else {
            return 0;
        }
    }

    function cambiar($id, $data) {
        $this->db->where('id_users', $id);
        $this->db->update('users', array('contrasena' => $data));
        return $this->db->affected_rows();
    }

    public function getAreasToCharge($user_id) {
        $query = $this->db->query("
            SELECT SUBSTRING_INDEX(area, '_', -1) AS 'texto',
                area
            FROM areamanagers
            WHERE user_id = $user_id
        ");

        return $query->result();
    }

    public function getRolesByArea($area) {
        $query = $this->db->query("
            SELECT id, name
            FROM roles
            WHERE area = '$area'
        ");

        return $query->result();
    }

    public function saveTable($tabla, $data, $action) {
        switch ($action) {
            case "insert":
                $this->db->insert($tabla, $data);
                break;
            case "update":
                $this->db->where((($tabla == 'users') ? 'id_users' : 'user_id'), (($tabla == 'users') ? $data['id_users'] : $data['user_id']));
                $this->db->update($tabla, $data);
                break;
        }

        return $this->db->affected_rows();
    }

    public function validateCedula($cedula) {
        $query = $this->db->query("
            SELECT id_users, nombres, apellidos,
                email, num_contacto, contrasena, imagen
            FROM users
            WHERE id_users = $cedula
        ");

        return $query->result();
    }
    
    function deleteUser($id) {
        $this->db->where('id_users', $id);
        $this->db->delete('users');
        return $this->db->affected_rows();
    }
    
    function deleteRolUserByIdUser($id) {
        $this->db->where('user_id', $id);
        $this->db->delete('role_user');
        return $this->db->affected_rows();
    }

}
