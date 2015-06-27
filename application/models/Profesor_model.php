<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profesor_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    function validar_ingreso($username, $password) {
        $this->db->select('idProfesor, cedula, contrasena');
        $this->db->from('profesor');
        $this->db->where('cedula', $username);
        $this->db->where('contrasena', $password);
        $this->db->limit(1);

        $query = $this->db->get();

        if($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    function obtenerProfesores(){
        $query = $this->db->get('profesor');
        if($query->num_rows() > 0) return $query;
        else return false;
    }
}