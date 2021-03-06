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
        if($_GET['idCarrera']) {
            $idCarrera = $_GET['idCarrera'];
        }
        $id = $this->session->userdata('logged_in')['id'];
        $data['cursoshijo'] = $this->curso_model->obtenerLista($idCarrera,$id);
        $data['profesores'] = $this->profesor_model->obtenerProfesores();
        $data['cursos'] = $this->curso_model->obtenerCursos();
        $data['carrera'] = $idCarrera;
        $this->load->view('layout/default/header.php');
        $this->load->view('layout/default/menuEstudiante.php');
        $this->load->view('estudiante/matricular.php',$data);
        $this->load->view('layout/default/footer.php');
    }

    function listaCursosMatricula($idCarrera){
        $id = $this->session->userdata('logged_in')['id'];
        $data['cursoshijo'] = $this->curso_model->obtenerLista($idCarrera,$id);
        $data['profesores'] = $this->profesor_model->obtenerProfesores();
        $data['cursos'] = $this->curso_model->obtenerCursos();
        $data['carrera'] = $idCarrera;
        $this->load->view('layout/default/header.php');
        $this->load->view('layout/default/menuEstudiante.php');
        $this->load->view('estudiante/matricular.php',$data);
        $this->load->view('layout/default/footer.php');
    }

    function matricular($idCurso,$idCarrera,$capacidad){
        $cantidad = $this->estudiantePorCurso_model->cantidad($idCurso);
        if($cantidad < $capacidad){
            $id = $this->session->userdata('logged_in')['id'];
            $this->estudiantePorCurso_model->agregar($idCurso,$id);
            echo "<script>alert('El curso fue matriculado con exito')</script>";
            $this->listaCursosMatricula($idCarrera);
        } else {
            echo "<script>alert('El curso solicitado se encuentra lleno')</script>";
            $this->listaCursosMatricula($idCarrera);
        }

    }

    function mostrarAvance(){
        if($_GET['idCarrera']) {
            $idCarrera = $_GET['idCarrera'];
        }
        $id = $this->session->userdata('logged_in')['id'];
        $data['cursos'] = $this->curso_model->obtenerAvance($idCarrera,$id);
        $this->load->view('layout/default/header.php');
        $this->load->view('layout/default/menuEstudiante.php');
        $this->load->view('estudiante/avanceCurricular.php',$data);
        $this->load->view('layout/default/footer.php');
    }

    function avanceCurricular(){
        $id = $this->session->userdata('logged_in')['id'];
        $data['carreras'] = $this->carrera_model->obtenerCarrera($id);
        $this->load->view('layout/default/header.php');
        $this->load->view('layout/default/menuEstudiante.php');
        $this->load->view('estudiante/opcionesAvanceCurricular.php',$data);
        $this->load->view('layout/default/footer.php');
    }

    function listaMatricula(){
        $id = $this->session->userdata('logged_in')['id'];
        $data['cursoshijo'] = $this->curso_model->obtenerMatriculados($id);
        $data['profesores'] = $this->profesor_model->obtenerProfesores();
        $data['cursos'] = $this->curso_model->obtenerCursos();
        $this->load->view('layout/default/header.php');
        $this->load->view('layout/default/menuEstudiante.php');
        $this->load->view('estudiante/retirarCurso.php',$data);
        $this->load->view('layout/default/footer.php');
    }

    function retirar($id){
        $this->curso_model->retirarCurso($id);
        echo "<script>alert('El curso fue retirado con exito')</script>";
        $this->listaMatricula();
    }
}

?>