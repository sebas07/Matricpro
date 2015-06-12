<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Heredamos de la clase CI_Controller */
class Curso extends CI_Controller {

    function __construct()
    {

        parent::__construct();

//        if($this->session->userdata('logged_in')){

        $this->load->database();
        $this->load->library('Grocery_crud');
//        }
//        else{
//            redirect('welcome');
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

            /* Aqui le indicamos que campos deseamos mostrar */
//            $crud->columns(
//                'nombre',
//                'apellido1',
//                'apellido2',
//                'idEspecialidad'
//            );

            $crud->display_as('nombre','Nombre');
            $crud->display_as('sigla','Sigla');
            $crud->display_as('descripcion','Descripción');



            $crud -> add_action ( 'Abrir curso' , base_url().'assets/grocery_crud/themes/flexigrid/css/images/add.png' , 'curso/abrircurso' ) ;
            $crud->set_relation_n_n("Pertenece_a_las_carreras", 'cursoporcarrera','carrera','idCurso', 'idCarrera', 'nombre');
//            $crud->set_relation_n_n("Requisitos", 'dependencia','curso','idCursoPorCarrera', 'dependencia', 'nombre');
            $output = $crud->render();

            /* La cargamos en la vista situada en
            /applications/views/productos/administracion.php */
//            $data['usuario'] = $this->session->userdata('username');
//            $data['title'] = "Profesor";
            $this->load->view('layout/default/header.php');
            $this->load->view('layout/default/menuAdministrador.php');
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
                'idProfesor',
                'grupo',
                'semestre',
                'estado',
                'año'
            );

            $crud->columns('idProfesor','grupo','semestre','estado','año');

            $crud->add_fields('idCurso', 'idProfesor','grupo','semestre','estado','año');
            $crud->edit_fields('idCurso', 'idProfesor','grupo','semestre','estado','año');
//            $crud->set_relation('idCurso','curso','nombre');

            $crud->field_type('idCurso','invisible');

            $GLOBALS['idCurso'] = $idCurso;
            $crud->callback_before_insert(function ($post_array) {
                    $post_array['idCurso'] = $GLOBALS['idCurso'];
                    return $post_array;
            }
        );
            $crud->set_relation('idProfesor','profesor','nombre');

            $output = $crud->render();
            $data['cursoPadre'] = "Programacion";
            $this->load->view('layout/default/header.php');
            $this->load->view('layout/default/menuAdministrador.php',$data);
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