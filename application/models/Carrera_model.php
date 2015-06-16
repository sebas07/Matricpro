<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carrera_model extends CI_Model
{

    function __construct()
    {
        parent:: __construct();
        $this->load->database();
    }


    function obtener($id)
    {
        $this->db->where('idCarrera', $id);
        $query = $this->db->get('carrera');
        if ($query->num_rows() > 0) return $query->result()[0];
        else return false;
    }


}
?>