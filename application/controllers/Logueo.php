<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Heredamos de la clase CI_Controller */
class Logueo extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }
    function index() {
        $this->load->view('layout/default/header.php');
        $this->load->view('layout/default/login_estudiante.php');
        $this->load->view('layout/default/footer.php');
    }
    function profesores() {
        $this->load->view('layout/default/header.php');
        $this->load->view('layout/default/login_profesor.php');
        $this->load->view('layout/default/footer.php');
    }
    function administradores() {
        $this->load->view('layout/default/header.php');
        $this->load->view('layout/default/login_administrador.php');
        $this->load->view('layout/default/footer.php');
    }
}

?>