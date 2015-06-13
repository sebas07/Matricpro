<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Heredamos de la clase CI_Controller */
class Profesor extends CI_Controller {

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
            $crud->set_table('profesor');

            /* Le asignamos un nombre */
            $crud->set_subject('Profesor');

            /* Asignamos el idioma español */
            $crud->set_language('spanish');

            /* Aqui le decimos a grocery que estos campos son obligatorios */
            $crud->required_fields(
//                'id',
                'nombre',
                'apellido1',
                'apellido2',
                'cedula'
            );

            $crud->columns('nombre','apellido1','apellido2', 'cedula', 'Especialidades');

            $crud->add_fields('nombre','apellido1','apellido2', 'cedula','Especialidades','contrasena');
            $crud->edit_fields('nombre','apellido1','apellido2','Especialidades', 'cedula');




            $crud->display_as('nombre','Nombre');
            $crud->display_as('apellido1','Primer Apellido');
            $crud->display_as('apellido2','Segundo Apellido');
            $crud->display_as('cedula','Cédula');
            $crud->display_as('contrasena','Contraseña');

            $crud->set_relation_n_n('Especialidades', 'especialidadporprofesor','especialidad','idProfesor', 'idEspecialidad', 'descrpcion');


            $output = $crud->render();

            $this->load->view('layout/default/header.php');
            $this->load->view('layout/default/menuAdministrador.php');
            $this->load->view('profesor/index', $output);
            $this->load->view('layout/default/footer.php');

        }catch(Exception $e){
            /* Si algo sale mal cachamos el error y lo mostramos */
            show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
    }

}