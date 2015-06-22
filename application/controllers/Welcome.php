<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
	public function index() {
        $sessionActual = $this->session->userdata('logged_in');
        if(!$sessionActual) {
//            $this->load->view('layout/default/error_logueo.php');
            redirect('logueo', 'refresh');
        } else {
            switch($sessionActual['tipo']) {
                case 1:
                    redirect('InicioEstudiante', 'refresh');
                    break;
                case 2:
                    redirect('InicioProfesor', 'refresh');
                    break;
                case 3:
                    redirect('InicioAdministrador', 'refresh');
                    break;
                default:
                    echo 'El usuario no tiene permisos de acceso';
                    break;
            }
        }
	}
    public function errorLogueo() {
        $this->load->view('layout/default/error_logueo.php');
    }
    public function errorPermiso() {
        $this->load->view('layout/default/error_permiso.php');
    }
}
