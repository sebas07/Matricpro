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

    function obtenerLista($carrera,$id){
        $query = "select ch.* from cursohijo as ch inner join curso as c
on ch.idCurso = c.idCurso inner join cursoporcarrera as cc on c.idCurso = cc.idCurso inner join carrera as ca
on cc.idCarrera = ca.idCarrera where ca.idCarrera = '$carrera' and ch.estado = '1' and c.idCurso not in (select distinct c.idCurso
from curso as c inner join cursohijo as ch on c.idCurso = ch.idCurso inner join estudianteporcurso as ec
on ch.idCursoHijo = ec.idCursoHijo inner join estuduante as e on ec.idEstudiante = e.idEstudiante where e.idEstudiante = '$id'
and (ec.NotaFinal <=> null or ec.NotaFinal >= '70')) and c.idCurso not in(select distinct c.idCurso from curso as c
inner join cursohijo as ch on c.idCurso = ch.idCurso inner join estudianteporcurso as ec on ch.idCursoHijo = ec.idCursoHijo
inner join estuduante as e on ec.idEstudiante = e.idEstudiante inner join estudianteporcarrera as ecar
on e.idEstudiante = ecar.idEstudiante where ec.NotaFinal >= '70' and ec.idEstudiante = '$id') and c.idCurso
not in(select c.idCurso from curso as c inner join cursoporcarrera as cc on c.idCurso = cc.idCurso inner join dependencia as d
on cc.idCursoPorCarrera = d.idCursoPorCarrera) or c.idCurso in (select c.idCurso from cursohijo as ch inner join curso as c
on ch.idCurso = c.idCurso inner join cursoporcarrera as cc on c.idCurso = cc.idCurso inner join dependencia as d
on cc.idCursoPorCarrera = d.idCursoPorCarrera where cc.idCarrera = '$carrera' and d.dependencia in(select distinct c.idCurso
from curso as c inner join cursohijo as ch on c.idCurso = ch.idCurso inner join estudianteporcurso as ec
on ch.idCursoHijo = ec.idCursoHijo where ec.NotaFinal >= '70' and ec.idEstudiante = '$id') and c.idCurso not in(select c.idCurso
from curso as c inner join cursohijo as ch on c.idCurso = ch.idCurso inner join estudianteporcurso as ec
on ch.idCursoHijo = ec.idCursoHijo where (ec.NotaFinal <=> null or ec.NotaFinal >= 70) and ec.idEstudiante = '$id'));";
        return $this->db->query($query);
    }

    function obtenerAvance($carrera,$id){
        $query = "select distinct c.sigla,c.nombre,ch.grupo,ch.semestre,ch.año,ec.NotaFinal from estudianteporcurso as ec
        inner join cursohijo as ch on ec.idCursoHijo = ch.idCursoHijo inner join curso as c on ch.idCurso = c.idCurso
        inner join cursoporcarrera as cc on c.idCurso = cc.idCurso inner join carrera as ca on cc.idCarrera = ca.idCarrera
        where ec.idEstudiante = '$id' and ca.idCarrera = '$carrera';";
        return $this->db->query($query);
    }

}
?>