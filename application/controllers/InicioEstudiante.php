<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InicioEstudiante extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $sessionActual = $this->session->userdata('logged_in');
        if(!$sessionActual || !($sessionActual['tipo'] == 1)) {
            redirect('logueo', 'refresh');
        }
    }
    public function index() {
        $this->load->view('layout/default/header.php');
        $this->load->view('layout/default/menuEstudiante.php');
        $this->load->view('welcome_message');
        $this->load->view('layout/default/footer.php');
    }
    function logout() {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('InicioEstudiante', 'refresh');
    }
}
