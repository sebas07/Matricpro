<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InicioEstudiante extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $sessionActual = $this->session->userdata('logged_in');
        if(!$sessionActual) {
            redirect(base_url().'Welcome/errorLogueo');
        } elseif (!($sessionActual['tipo'] == 1)) {
            redirect(base_url().'Welcome/errorPermiso');
        }
    }
    public function index() {
        $this->load->model('Estudiante_model');
        $data = array();
        $data['estudiante'] = $this->Estudiante_model->obtenerEstudiante($this->session->userdata('logged_in')['id']);
        $this->load->view('layout/default/header.php');
        $this->load->view('layout/default/menuEstudiante.php');
        $this->load->view('welcome_message', $data);
        $this->load->view('layout/default/footer.php');
    }
    function logout() {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('Welcome', 'refresh');
    }
}
