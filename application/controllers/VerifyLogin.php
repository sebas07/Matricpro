<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VerifyLogin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Estudiante_model', '', TRUE);
        $this->load->model('Profesor_model', '', TRUE);
        $this->load->model('Administrador_model', '', TRUE);
        $this->load->library('form_validation');
    }
    function index() {
        $this->form_validation->set_rules('carnet', 'Carnet', 'trim|required');
        $this->form_validation->set_rules('contrasenna', 'Contrasenna', 'trim|required|callback_check_databaseE');

        if($this->form_validation->run() == FALSE) {
            $this->load->view('layout/default/header.php');
            $this->load->view('layout/default/login_estudiante.php');
            $this->load->view('layout/default/footer.php');
        } else {
            redirect('InicioEstudiante', 'refresh');
        }
    }
    function profesor() {
        $this->form_validation->set_rules('cedula', 'Cedula', 'trim|required');
        $this->form_validation->set_rules('contrasenna', 'Contrasenna', 'trim|required|callback_check_databaseP');

        if($this->form_validation->run() == FALSE) {
            $this->load->view('layout/default/header.php');
            $this->load->view('layout/default/login_profesor.php');
            $this->load->view('layout/default/footer.php');
        } else {
            redirect('InicioProfesor', 'refresh');
        }
    }
    function administrador() {
        $this->form_validation->set_rules('cedula', 'Cedula', 'trim|required');
        $this->form_validation->set_rules('contrasenna', 'Contrasenna', 'trim|required|callback_check_databaseA');

        if($this->form_validation->run() == FALSE) {
            $this->load->view('layout/default/header.php');
            $this->load->view('layout/default/login_administrador.php');
            $this->load->view('layout/default/footer.php');
        } else {
            redirect('Welcome', 'refresh');
        }
    }
    function check_databaseE($password) {
        $username = $this->input->post('carnet');
        $result = $this->Estudiante_model->validar_ingreso($username, $password);
        if($result) {
            $sess_array = array();
            foreach ($result as $row) {
                $sess_array = array(
                    'id' => $row->idEstudiante,
                    'carnet' => $row->carnet,
                    'tipo' => 1
                );
                $this->session->set_userdata('logged_in', $sess_array);
            }
            return true;
        } else {
            $this->form_validation->set_message('check_database', 'Datos invalidos');
            return false;
        }
    }
    function check_databaseP($password) {
        $username = $this->input->post('cedula');
        $result = $this->Profesor_model->validar_ingreso($username, $password);
        if($result) {
            $sess_array = array();
            foreach ($result as $row) {
                $sess_array = array(
                    'id' => $row->idProfesor,
                    'cedula' => $row->cedula,
                    'tipo' => 2
                );
                $this->session->set_userdata('logged_in', $sess_array);
            }
            return true;
        } else {
            $this->form_validation->set_message('check_database', 'Datos invalidos');
            return false;
        }
    }
    function check_databaseA($password) {
        $username = $this->input->post('cedula');
        $result = $this->Administrador_model->validar_ingreso($username, $password);
        if($result) {
            $sess_array = array();
            foreach ($result as $row) {
                $sess_array = array(
                    'id' => $row->idAdministrador,
                    'cedula' => $row->cedula,
                    'tipo' => 3
                );
                $this->session->set_userdata('logged_in', $sess_array);
            }
            return true;
        } else {
            $this->form_validation->set_message('check_database', 'Datos invalidos');
            return false;
        }
    }
}