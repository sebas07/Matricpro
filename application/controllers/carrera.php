<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Carrera extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $sessionActual = $this->session->userdata('logged_in');
        if(!$sessionActual) {
            redirect(base_url().'Welcome/errorLogueo');
        } elseif (!($sessionActual['tipo'] == 3)) {
            redirect(base_url().'Welcome/errorPermiso');
        } else {
            $this->load->database();
            $this->load->library('Grocery_crud');
            $this->load->model('carrera_model');
        }
    }
    function index()
    {
        try{
            $crud = new grocery_CRUD();
            $crud->set_theme('flexigrid');
            $crud->set_table('carrera');
            $crud->set_subject('Carrera');
            $crud->set_language('spanish');
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
            $data['titulo'] = 'Carreras';
            $this->load->view('layout/default/titulos.php',$data);
            $this->load->view('carrera/index', $output);
            $this->load->view('layout/default/footer.php');
        }catch(Exception $e){
            show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
    }
    function ver($idCarrera)
    {
        try{
            $crud = new grocery_CRUD();
            $crud->set_theme('flexigrid');
            $crud->set_table('cursoporcarrera');
            $crud->where('idCarrera', $idCarrera);
            $crud->order_by('ciclo','asc');
            $crud->set_subject('Curso');
            $crud->set_language('spanish');

            $crud->required_fields(
                'idCurso',
                'ciclo'
            );
            $crud->columns('idCurso','ciclo','Dependencia');
//            $crud->columns('idCurso','ciclo','Dependencia');

//            $crud->add_fields('idCarrera', 'idCurso','ciclo');
            $crud->add_fields('idCarrera', 'idCurso','ciclo','Dependencia');
//            $crud->edit_fields('ciclo');
            $crud->edit_fields('ciclo','Dependencia');

            $crud->display_as('idCurso','Curso');
            $crud->display_as('ciclo','Ciclo');
            $crud->display_as('Dependencia','Requisitos');

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
            $crud->set_relation_n_n('Dependencia', 'dependencia','curso','idCursoPorCarrera', 'dependencia', 'nombre');
//            $crud->set_relation_n_n('Especialidades', 'especialidadporprofesor','especialidad','idProfesor', 'idEspecialidad', 'descrpcion');

//            $crud->set_relation('idCarrera','carrera','nombre');
//            $crud->set_relation('Dependencia','curso','nombre');
//            $crud->where('idCarrera', '');
// fin
            $output = $crud->render();

            $carrera = $this->carrera_model->obtener($idCarrera);
            $data['nombreCarrera'] = $carrera->nombre;
            $this->load->view('layout/default/header.php');
            $this->load->view('layout/default/menuAdministrador.php');
            $this->load->view('layout/default/titulos.php',$data);
            $this->load->view('carrera/index', $output);
            $this->load->view('layout/default/footer.php');
        }catch(Exception $e){
            /* Si algo sale mal cachamos el error y lo mostramos */
            show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
    }

}