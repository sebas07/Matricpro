<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Heredamos de la clase CI_Controller */
class Matricula extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('cursoHijo_model');
        $this->load->model('profesor_model');
        $this->load->model('curso_model');
    }

    function Matricular(){
        $data['cursoshijo'] = $this->cursoHijo_model->obtenerCursosHijos();
        $data['profesores'] = $this->profesor_model->obtenerProfesores();
        $data['cursos'] = $this->curso_model->obtenerCursos();
        $this->load->view('layout/default/header.php');
        $this->load->view('layout/default/menuEstudiante.php');
        $this->load->view('estudiante/matricular.php',$data);
        $this->load->view('layout/default/footer.php');
    }
}

?>