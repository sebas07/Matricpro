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
        $this->load->model('carrera_model');
        $this->load->model('estudiantePorCurso_model');
    }

    function index(){
        $id = $this->session->userdata('logged_in')['id'];
        $data['carreras'] = $this->carrera_model->obtenerCarrera($id);
        $this->load->view('layout/default/header.php');
        $this->load->view('layout/default/menuEstudiante.php');
        $this->load->view('estudiante/opcionesCarrera.php',$data);
        $this->load->view('layout/default/footer.php');
    }

    function listaCursos(){
        $idCarrera = $this->input->post("idCarrera");
        $id = $this->session->userdata('logged_in')['id'];
        $data['cursoshijo'] = $this->curso_model->obtenerLista($idCarrera,$id);
        $data['profesores'] = $this->profesor_model->obtenerProfesores();
        $data['cursos'] = $this->curso_model->obtenerCursos();
        $this->load->view('layout/default/header.php');
        $this->load->view('layout/default/menuEstudiante.php');
        $this->load->view('estudiante/matricular.php',$data);
        $this->load->view('layout/default/footer.php');
    }

    function matricular($idCurso){
//        $idCurso = $this->input->post("idCursoHijo");
        $id = $this->session->userdata('logged_in')['id'];
        $this->estudiantePorCurso_model->agregar($idCurso,$id);
    }
}

?>