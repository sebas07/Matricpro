<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InicioAdministrador extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $sessionActual = $this->session->userdata('logged_in');
        if(!$sessionActual || !($sessionActual['tipo'] == 3)) {
            redirect('logueo/administradores', 'refresh');
        }
    }
    public function index() {
        $this->load->view('layout/default/header.php');
        $this->load->view('layout/default/menuAdministrador.php');
        $this->load->view('welcome_message');
        $this->load->view('layout/default/footer.php');
    }
    function logout() {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('InicioAdministrador', 'refresh');
    }
}