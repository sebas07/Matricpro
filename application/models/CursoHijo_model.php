<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CursoHijo_model extends CI_Model
{
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function obtenerCursosHijos(){
        $query = $this->db->get('cursohijo');
        if($query->num_rows() > 0) return $query;
        else return false;
    }
}
?>