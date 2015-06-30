<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EstudiantePorCurso_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    function agregar($idCurso,$idEstudiante){
        $query = "insert into estudianteporcurso (idCursoHijo,idEstudiante) values ('$idCurso','$idEstudiante');";
        $this->db->query($query);
    }

    function obtenerAvanceCurricular($idEstudiante,$idCarrera){
        $query = "";
        return $this->db->query($query);
    }
}