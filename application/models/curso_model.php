<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Curso_model extends CI_Model
{

    function __construct()
    {
        parent:: __construct();
        $this->load->database();
    }


    function obtener($id)
    {
        $this->db->where('idCurso', $id);
        $query = $this->db->get('curso');
        if ($query->num_rows() > 0) return $query->result()[0];
        else return false;
    }
    function obtenerPadre($id)
    {
        $this->db->where('idCurso', $id);
        $query = $this->db->query("SELECT cp.*, ch.grupo from curso as cp inner join cursohijo as ch on cp.idCurso = ch.idCurso where idCursoHijo = $id;");
        if ($query->num_rows() > 0) return $query->result()[0];
        else return false;
    }

    function obtenerCursos(){
        $query = $this->db->get('curso');
        if($query->num_rows() > 0) return $query;
        else return false;
    }

}
?>