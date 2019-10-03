<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Areas_model extends CI_Model {

  public function saveArea($value)
  {
    $query = $this->db->query("INSERT INTO areasrelations (subarea, area) VALUES (
    '"  ."Dilo_". $value['nombreArea'] .  "',
    'Dilo')");
    if ($query) {
        return "Datos Guardados correctamente";
    } else {
        echo "Hay un error en el registro de comentarios";
      }
    }

    public function saveManager($value)
    {
      $query = $this->db->insert('areamanagers', $value);
      if ($query) {
          return "Datos Guardados correctamente";
      } else {
          echo "Hay un error en el registro de comentarios";
        }

      }

    public function postRol($value)
    {
      $query = $this->db->query("INSERT INTO roles (name, area, description) VALUES (
        '" . $value['nemeRol'] ."',
        '". $value['area'] ."',
        '" . $value['descriptionRol'] ."'
      )");
        }

    public function getArea($id)
    {
      $query =$this->db->query("SELECT am.area FROM areamanagers am JOIN users u ON am.user_id = u.id_users  WHERE user_id='$id'");
      return $query->result();
    }
    public function getUsers()
    {
      $consulta=$this->db->query("SELECT id_users,concat(RTRIM(nombres),' ',apellidos)  as nombresUsuarios FROM users");
      return $consulta->result();
      // print_r($this->db->last_query());

    }
    public function getIdUser($value)
    {
      var_dump($value);exit();
      $consulta=$this->db->query("SELECT id_users FROM users WHERE concat(nombres,' ',apellidos) = '$value'");
      return $consulta->result();
      // print_r($this->db->last_query());

    }
    public function getIdRol($value)
    {
      $consulta = $this->db->query("SELECT user_id FROM role_user WHERE role_id = 5 ");
      return $consulta->result();
    }
    public function getCordinadores($value)
    {
      $consultaC = $this->db->query("SELECT am.area, concat(u.nombres,' ',u.apellidos) as nombre_cordinador FROM  areamanagers am inner join users u on am.user_id = u.id_users  WHERE area ='$value'");
      return $consultaC ->result();
    }
    public function getUsuarios($value)
    {
      $consultaU = $this->db->query("SELECT r.area, concat(u.nombres,' ',u.apellidos) as nombres_usuarios FROM  roles r inner join role_user ru on ru.role_id = r.id INNER JOIN users u on ru.user_id = u.id_users  WHERE area ='$value'");
      return $consultaU ->result();
    }
    public function getRol($value)
    {
      $consultaR = $this->db->query ("SELECT name FROM roles where area ='$value'");
      return $consultaR ->result();
    }

    public function saveCordinator($value)
    {
      $query = $this->db->insert('areamanagers', $value);
      if ($query) {
          return "Datos Guardados correctamente";
      } else {
          echo "Hay un error en el registro de comentarios";
        }
    }




}

?>
