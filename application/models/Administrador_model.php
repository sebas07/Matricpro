<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrador_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function validar_ingreso($username, $password) {
        $this->db->select('idAdministrador, cedula, contrasena');
        $this->db->from('administrador');
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
    function obtenerAdministrador($id) {
        $this->db->from('administrador');
        $this->db->where('idAdministrador', $id);
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            return $query->result()[0];
        } else {
            return false;
        }
    }
    function cambiarContrasenna($id, $data) {
        $datos = array(
            'contrasena' => $data['contrasena']
        );
        $this->db->where('idAdministrador', $id);
        $this->db->update('administrador', $datos);
    }
}