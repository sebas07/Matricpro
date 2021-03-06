<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InicioProfesor extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $sessionActual = $this->session->userdata('logged_in');
        if(!$sessionActual) {
            redirect(base_url().'Welcome/errorLogueo');
        } elseif (!($sessionActual['tipo'] == 2)) {
            redirect(base_url().'Welcome/errorPermiso');
        }
    }
    public function index() {
        $this->load->model('Profesor_model');
        $data = array();
        $data['profesor'] = $this->Profesor_model->obtenerProfesor($this->session->userdata('logged_in')['id']);
        $this->load->view('layout/default/header.php');
        $this->load->view('layout/default/menuProfesor.php');
        $this->load->view('welcome_message', $data);
        $this->load->view('layout/default/footer.php');
    }
    function logout() {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('Welcome', 'refresh');
    }
}