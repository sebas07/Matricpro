<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administrador extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $sessionActual = $this->session->userdata('logged_in');
        if(!$sessionActual || !($sessionActual['tipo'] == 3)) {
            redirect('logueo/administradores', 'refresh');
        } else {
            $this->load->database();
            $this->load->library('Grocery_crud');
        }
    }
    function index()
    {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('flexigrid');
            $crud->set_table('administrador');
            $crud->set_subject('Administrador');
            $crud->set_language('spanish');
            $crud->required_fields(
//                'id',
                'nombre',
                'apellido1',
                'apellido2',
                'cedula'
            );
            $crud->columns('nombre', 'apellido1', 'apellido2', 'cedula');
            $crud->add_fields('nombre', 'apellido1', 'apellido2', 'cedula', 'contrasena');
            $crud->edit_fields('nombre', 'apellido1', 'apellido2', 'cedula');

            $crud->display_as('nombre', 'Nombre');
            $crud->display_as('apellido1', 'Primer Apellido');
            $crud->display_as('apellido2', 'Segundo Apellido');
            $crud->display_as('cedula', 'Cédula');
            $crud->display_as('contrasena', 'Contraseña');

            $output = $crud->render();

            $this->load->view('layout/default/header.php');
            $this->load->view('layout/default/menuAdministrador.php');
            $data['titulo'] = 'Administradores';
            $this->load->view('layout/default/titulos.php',$data);
            $this->load->view('administrador/index', $output);
            $this->load->view('layout/default/footer.php');
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
}
