<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Areas_model extends CI_Model {

  public function saveArea($value)
  {
    $query = $this->db->query("INSERT INTO znoc.areamanagers (area, responsable_area, user_id) VALUES (
    '" . $value['nombreArea'] .  "',
    '" . $value['responsableArea'] .  "',
    '" . $value['id_user'] . "')");
    if ($query) {
        return "Datos Guardados correctamente";
    } else {
        echo "Hay un error en el registro de comentarios";
      }
    }

    public function getArea($id)
    {
      $query =$this->db->query("SELECT area FROM areamanagers WHERE user_id='$id'");
      return $query->result();
    }
    public function getUsers()
    {
      $consulta=$this->db->query("SELECT id_users, nombres FROM users");
      return $consulta->result();
      // print_r($this->db->last_query());

    }
    public function getIdUser($value)
    {
      $consulta=$this->db->query("SELECT id_users FROM users WHERE nombres = '$value'");
      return $consulta->result();
      // print_r($this->db->last_query());

    }
    public function getIdRol($value)
    {
      $consulta = $this->db->query("SELECT user_id FROM role_user WHERE role_id = 5 ");
      return $consulta->result();
    }



}

?>
