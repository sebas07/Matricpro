<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InicioProfesor extends CI_Controller {

    public function index()
    {
        $this->load->view('layout/default/header.php');
        $this->load->view('layout/default/menuProfesor.php');
        $this->load->view('welcome_message');
        $this->load->view('layout/default/footer.php');
    }
}