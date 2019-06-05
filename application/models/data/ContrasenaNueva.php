<?php
class ContrasenaNueva extends CI_Model{
    function __construct(){
        parent:: __construct();
        $this -> load -> database();
    }
    function cambiar($id, $data){
        $this->db->where('id_usuario',$id);
        $this->db->update('usuario',array('contrasena'=>$data));
        return $this->db->affected_rows();
    }
}