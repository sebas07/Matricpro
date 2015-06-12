<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Heredamos de la clase CI_Controller */
class Estudiante extends CI_Controller {

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
            $crud->set_table('usuario');

            /* Le asignamos un nombre */
            $crud->set_subject('estudiante');

            /* Asignamos el idioma español */
            $crud->set_language('spanish');

            /* Aqui le decimos a grocery que estos campos son obligatorios */
//            $crud->required_fields(
////                'id',
//                'carnet',
//                'nombre',
//                'apellido1',
//                'apellido2',
//                'fechaNacimiento'
//            );

            $crud->fields('customerName','contactLastName','phone','city','country','creditLimit');
            $crud->add_fields('idUsuario','nombreUsuario','contrasena','tipoUsuario');
            $crud->edit_fields('username','first_name','last_name');

//            $crud->display_as('canet','Carnet');
//            $crud->display_as('nombre','Nombre');
//            $crud->display_as('apellido1','Primer Apellido');
//            $crud->display_as('apellido2','Segundo Apellido');
//            $crud->display_as('fechaNacimiento','Fecha de nacimiento');

            $crud->callback_after_insert(array($this, 'log_user_after_insert'));
            $crud->callback_after_update(array($this, 'log_user_after_update'));

            $output = $crud->render();

            $this->load->view('layout/default/header.php');
            $this->load->view('layout/default/menuAdministrador.php');
            $this->load->view('estudiante/index', $output);
            $this->load->view('layout/default/footer.php');

        }catch(Exception $e){
            /* Si algo sale mal cachamos el error y lo mostramos */
            show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
    }
    function log_user_after_insert($post_array,$primary_key)
    {
        $user_logs_insert = array(
            "idUsuario" => $primary_key,
            "carnet" => 'prueba',
            "nombre" => 'prueba',
            "apellido1" => 'prueba',
            "apellido2" => 'prueba'
        );

        $this->db->insert('estuduante',$user_logs_insert);

        return true;
    }
}