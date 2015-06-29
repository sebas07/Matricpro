<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProfesorCurso extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $sessionActual = $this->session->userdata('logged_in');
//        if(!$sessionActual) {
//            redirect(base_url().'Welcome/errorLogueo');
//        } elseif (!($sessionActual['tipo'] == 3)) {
//            redirect(base_url().'Welcome/errorPermiso');
//        } else {
            $this->load->database();
            $this->load->library('Grocery_crud');
            $this->load->model('curso_model');
//        }
    }
    function index()
    {
        try{

            /* Creamos el objeto */
            $crud = new grocery_CRUD();

            /* Seleccionamos el tema */
            $crud->set_theme('flexigrid');

            /* Seleccionmos el nombre de la tabla de nuestra base de datos*/
            $crud->set_table('cursohijo');

            $sessionActual = $this->session->userdata('logged_in');
            $crud->where('idProfesor', $sessionActual['id']);

            /* Le asignamos un nombre */
            $crud->set_subject('Curso');

            /* Asignamos el idioma español */
            $crud->set_language('spanish');

            /* Aqui le decimos a grocery que estos campos son obligatorios */
            $crud->required_fields(
//                'id',
//                'nombre',
//                'sigla',
//                'descripcion'
            );

            $crud->columns('idCurso','grupo','semestre', 'estado','año','capacidad');

//            $crud->add_fields('nombre','sigla','descripcion');
//            $crud->edit_fields('nombre','sigla','descripcion');

            $crud->display_as('idCurso','Curso');
            $crud->display_as('grupo','Grupo');
            $crud->display_as('semestre','Semestre');
            $crud->display_as('estado','Estado');
            $crud->display_as('año','Año');
            $crud->display_as('capacidad','Capacidad');

//            $crud -> add_action ( 'Abrir curso' , base_url().'assets/Grocery_crud/themes/flexigrid/css/images/add.png' , 'curso/abrircurso' ) ;
//            $crud->set_relation_n_n("Pertenece_a_la_carrera", 'cursoporcarrera','carrera','idCurso', 'idCarrera', 'nombre');
//            $crud->set_relation_n_n("Requisitos", 'dependencia','curso','idCursoPorCarrera', 'dependencia', 'nombre');
            $crud->set_relation('idCurso','curso','{nombre} / {sigla}');
            $crud->unset_add();
            $crud->unset_read();
            $crud -> add_action ( 'Ver estudiante' , base_url().'assets/Grocery_crud/themes/flexigrid/css/images/add.png' , 'profesorcurso/estudiantes') ;
            $crud->unset_delete();
            $crud->edit_fields('estado');
            $output = $crud->render();

            /* La cargamos en la vista situada en
            /applications/views/productos/administracion.php */
//            $data['usuario'] = $this->session->userdata('username');
//            $data['title'] = "Profesor";
            $this->load->view('layout/default/header.php');
            $this->load->view('layout/default/menuProfesor.php');
            $data['titulo'] = 'Mis cursos';
            $this->load->view('layout/default/titulos.php',$data);
            $this->load->view('profesorcurso/index', $output);
            $this->load->view('layout/default/footer.php');

        }catch(Exception $e){
            /* Si algo sale mal cachamos el error y lo mostramos */
            show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
    }


    function estudiantes($idCurso)
    {
        try{

            /* Creamos el objeto */
            $crud = new grocery_CRUD();

            /* Seleccionamos el tema */
            $crud->set_theme('flexigrid');

            /* Seleccionmos el nombre de la tabla de nuestra base de datos*/
            $crud->set_table('estudianteporcurso');
            $crud->where('idCursoHijo', $idCurso);

            /* Le asignamos un nombre */
            $crud->set_subject('Estudintes');


            /* Asignamos el idioma español */
            $crud->set_language('spanish');

            /* Aqui le decimos a grocery que estos campos son obligatorios */
            $crud->required_fields(
//                'grupo',
//                'semestre',
//                'estado',
//                'año',
//                'capacidad'
            );

            $crud->columns('idEstudiante', 'NotaFinal');

//            $crud->add_fields('idCurso', 'idProfesor','grupo','semestre','estado','año','capacidad');
//            $crud->edit_fields('idCurso', 'idProfesor','grupo','semestre','estado','año','capacidad');

            $crud->display_as('idEstudiante','Eestudiante');
            $crud->display_as('NotaFinal','Nota');

            $crud->unset_add();
            $crud->unset_read();
//            $crud -> add_action ( 'Ver estudiante' , base_url().'assets/Grocery_crud/themes/flexigrid/css/images/add.png' , 'profesorcurso/estudiantes') ;
            $crud->unset_delete();
            $crud->edit_fields('NotaFinal');


            $crud->set_relation('idEstudiante','estuduante','{nombre} {apellido1} {apellido2} / {carnet}');
//            $crud->set_relation('idEstudiante','estuduante','');
            $output = $crud->render();
            $curso =  $this->curso_model->obtenerPadre($idCurso);
            $data['nombreCurso'] = $curso->nombre.' '. $curso->sigla.'-Grupo: '. $curso->grupo ;
            $this->load->view('layout/default/header.php');
            $this->load->view('layout/default/menuProfesor.php');
            $this->load->view('layout/default/titulos.php',$data);
            $this->load->view('profesorcurso/index', $output);
            $this->load->view('layout/default/footer.php');

        }catch(Exception $e){
            show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
    }

    function test_callback($post_array,$idCurso){
        $post_array['idCurso'] = $idCurso;
        return $post_array;
    }

}