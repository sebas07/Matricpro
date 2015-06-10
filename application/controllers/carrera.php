<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Heredamos de la clase CI_Controller */
class Carrera extends CI_Controller {

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
            $crud->set_table('carrera');

            /* Le asignamos un nombre */
            $crud->set_subject('Carrera');

            /* Asignamos el idioma español */
            $crud->set_language('spanish');

            /* Aqui le decimos a grocery que estos campos son obligatorios */
            $crud->required_fields(
//                'id',
                'nombre',
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
            $crud->display_as('descripcion','Descripción');

//            $crud->display_as('idEspecialidad','Especialidad');


            /* Generamos la tabla */

//            $crud->set_relation('idEspecialidad','especialidad','descripcion');


            $output = $crud->render();

            /* La cargamos en la vista situada en
            /applications/views/productos/administracion.php */
//            $data['usuario'] = $this->session->userdata('username');
//            $data['title'] = "Profesor";
            $this->load->view('layout/default/header.php');
            $this->load->view('layout/default/menuAdministrador.php');
            $this->load->view('carrera/index', $output);
            $this->load->view('layout/default/footer.php');

        }catch(Exception $e){
            /* Si algo sale mal cachamos el error y lo mostramos */
            show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
    }

    /*
     *
     **/
//    function administracion()
//    {
//
//    }
}