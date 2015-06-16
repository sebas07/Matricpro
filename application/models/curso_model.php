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


}
?>