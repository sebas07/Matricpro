<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estudiante_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function validar_ingreso($username, $password) {
        $this->db->select('idEstudiante, carnet, contrasena');
        $this->db->from('estuduante');
        $this->db->where('carnet', $username);
        $this->db->where('contrasena', $password);
        $this->db->limit(1);

        $query = $this->db->get();

        if($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
}