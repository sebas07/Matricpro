<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Curso extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $sessionActual = $this->session->userdata('logged_in');
        if(!$sessionActual || !($sessionActual['tipo'] == 3)) {
            redirect('logueo/administradores', 'refresh');
        } else {
            $this->load->database();
            $this->load->library('Grocery_crud');
            $this->load->model('curso_model');
        }
    }
    function index()
    {
        try{

            /* Creamos el objeto */
            $crud = new grocery_CRUD();

            /* Seleccionamos el tema */
            $crud->set_theme('flexigrid');

            /* Seleccionmos el nombre de la tabla de nuestra base de datos*/
            $crud->set_table('curso');

            /* Le asignamos un nombre */
            $crud->set_subject('Curso');

            /* Asignamos el idioma español */
            $crud->set_language('spanish');

            /* Aqui le decimos a grocery que estos campos son obligatorios */
            $crud->required_fields(
//                'id',
                'nombre',
                'sigla',
                'descripcion'
            );

            $crud->columns('nombre','sigla','descripcion', 'Pertenece_a_la_carrera');

//            $crud->add_fields('nombre','sigla','descripcion');
//            $crud->edit_fields('nombre','sigla','descripcion');

            $crud->display_as('nombre','Nombre');
            $crud->display_as('sigla','Sigla');
            $crud->display_as('descripcion','Descripción');


            $crud -> add_action ( 'Abrir curso' , base_url().'assets/Grocery_crud/themes/flexigrid/css/images/add.png' , 'curso/abrircurso' ) ;
            $crud->set_relation_n_n("Pertenece_a_la_carrera", 'cursoporcarrera','carrera','idCurso', 'idCarrera', 'nombre');
//            $crud->set_relation_n_n("Requisitos", 'dependencia','curso','idCursoPorCarrera', 'dependencia', 'nombre');
            $output = $crud->render();

            /* La cargamos en la vista situada en
            /applications/views/productos/administracion.php */
//            $data['usuario'] = $this->session->userdata('username');
//            $data['title'] = "Profesor";
            $this->load->view('layout/default/header.php');
            $this->load->view('layout/default/menuAdministrador.php');
            $data['titulo'] = 'Cursos';
            $this->load->view('layout/default/titulos.php',$data);
            $this->load->view('curso/index', $output);
            $this->load->view('layout/default/footer.php');

        }catch(Exception $e){
            /* Si algo sale mal cachamos el error y lo mostramos */
            show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
    }


    function abrirCurso($idCurso)
    {
        try{

            /* Creamos el objeto */
            $crud = new grocery_CRUD();

            /* Seleccionamos el tema */
            $crud->set_theme('flexigrid');

            /* Seleccionmos el nombre de la tabla de nuestra base de datos*/
            $crud->set_table('cursohijo');
            $crud->where('idCurso', $idCurso);


            /* Le asignamos un nombre */
            $crud->set_subject('Curso');


            /* Asignamos el idioma español */
            $crud->set_language('spanish');

            /* Aqui le decimos a grocery que estos campos son obligatorios */
            $crud->required_fields(
                'grupo',
                'semestre',
                'estado',
                'año',
                'capacidad'
            );

            $crud->columns('idProfesor','grupo','semestre','estado','año','capacidad');

//            $crud->add_fields('idCurso', 'idProfesor','grupo','semestre','estado','año','capacidad');
//            $crud->edit_fields('idCurso', 'idProfesor','grupo','semestre','estado','año','capacidad');

            $crud->display_as('idProfesor','Profesor');
            $crud->display_as('grupo','Grupo');
            $crud->display_as('semestre','Semestre');
            $crud->display_as('estado','Estado');
            $crud->display_as('año','Año');
            $crud->display_as('capacidad','Capacidad de estudiantes');

            $crud->field_type('idCurso','invisible');

            $GLOBALS['idCurso'] = $idCurso;
            $crud->callback_before_insert(function ($post_array) {
                    $post_array['idCurso'] = $GLOBALS['idCurso'];
                    return $post_array;
            }
        );
            $crud->set_relation('idProfesor','profesor','nombre');

            $output = $crud->render();
            $curso =  $this->curso_model->obtener($idCurso);
            $data['nombreCurso'] = $curso->nombre.' '. $curso->sigla;
            $this->load->view('layout/default/header.php');
            $this->load->view('layout/default/menuAdministrador.php');
            $this->load->view('layout/default/titulos.php',$data);
            $this->load->view('curso/index', $output);
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