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

    function obtenerLista(){
        $query = "select ch.* from cursohijo as ch
inner join curso as c
on ch.idCurso = c.idCurso
inner join cursoporcarrera as cc
on c.idCurso = cc.idCurso
inner join carrera as ca
on cc.idCarrera = ca.idCarrera
where ca.idCarrera = '1' and
c.idCurso not in(
select distinct c.idCurso from curso as c
inner join cursohijo as ch
on c.idCurso = ch.idCurso
inner join avancecurrilcular as ac
on ch.idCursoHijo = ac.idCursoHijo
inner join estuduante as e
on ac.idEstudiante = e.idEstudiante
inner join estudianteporcarrera as ec
on e.idEstudiante = ec.idEstudiante
where e.idEstudiante = '1'and ac.NotaFinal  >= '70' and
c.idCurso) and
c.idCurso not in(
select c.idCurso from curso as c
inner join cursoporcarrera as cc
on c.idCurso = cc.idCurso
inner join dependencia as d
on cc.idCursoPorCarrera = d.idCursoPorCarrera
) or c.idCurso in (select c.idCurso from cursohijo as ch
inner join curso as c
on ch.idCurso = c.idCurso
inner join cursoporcarrera as cc
on c.idCurso = cc.idCurso
inner join dependencia as d
on cc.idCursoPorCarrera = d.idCursoPorCarrera
where cc.idCarrera = '1'
and d.dependencia
in(
select distinct c.idCurso
from curso as c
inner join cursohijo as ch
on c.idCurso = ch.idCurso
inner join avancecurrilcular as a
on ch.idCursoHijo = a.idCursoHijo
inner join estudianteporcurso as ec
on a.idEstudiante = ec.idEstudiante
where a.NotaFinal >= '70' and ec.idEstudiante = '1') and
c.idCurso not in(select c.idCurso from curso as c
inner join cursohijo as ch
on c.idCurso = ch.idCurso
inner join avancecurrilcular as ac
on ch.idCurso = ac.idCursoHijo));";
        return $this->db->query($query);
    }


}
?>