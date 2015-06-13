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
//               'id',
                'nombre',
                'descripcion'
            );


            $crud->display_as('nombre','Nombre');
            $crud->display_as('descripcion','Descripción');


            $crud -> add_action ( 'Ver cursos' , base_url().'assets/Grocery_crud/themes/flexigrid/css/images/next.gif' , 'carrera/ver' ) ;

            $output = $crud->render();

            $this->load->view('layout/default/header.php');
            $this->load->view('layout/default/menuAdministrador.php');
            $this->load->view('carrera/index', $output);
            $this->load->view('layout/default/footer.php');

        }catch(Exception $e){
            /* Si algo sale mal cachamos el error y lo mostramos */
            show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
    }


    function ver($idCarrera)
    {
        try{

            /* Creamos el objeto */
            $crud = new grocery_CRUD();

            /* Seleccionamos el tema */
            $crud->set_theme('flexigrid');

            /* Seleccionmos el nombre de la tabla de nuestra base de datos*/
            $crud->set_table('cursoporcarrera');
            $crud->where('idCarrera', $idCarrera);

            /* Le asignamos un nombre */
            $crud->set_subject('Curso');

            /* Asignamos el idioma español */
            $crud->set_language('spanish');

            $crud->required_fields(
                'idCurso',
                'ciclo'
            );

//            inicio
            $crud->columns('idCurso','ciclo');

            $crud->add_fields('idCarrera', 'idCurso','ciclo');
            $crud->edit_fields('ciclo');

            $crud->display_as('idCurso','Curso');
            $crud->display_as('ciclo','Ciclo');

            $crud->field_type('idCarrera','invisible');

            $GLOBALS['idCarrera'] = $idCarrera;
            $crud->callback_before_insert(function ($post_array) {
                    $post_array['idCarrera'] = $GLOBALS['idCarrera'];
                    return $post_array;
                }
            );
//            $crud->callback_before_update(function ($post_array) {
//                    $post_array['idCarrera'] = $GLOBALS['idCarrera'];
//                    return $post_array;
//                }
//            );

//
//            $crud->set_relation('idCarrera','carrera','nombre');
            $crud->set_relation('idCurso','curso','nombre');
// fin

            $output = $crud->render();

            $this->load->view('layout/default/header.php');
            $this->load->view('layout/default/menuAdministrador.php');
            $this->load->view('carrera/index', $output);
            $this->load->view('layout/default/footer.php');

        }catch(Exception $e){
            /* Si algo sale mal cachamos el error y lo mostramos */
            show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
    }


}