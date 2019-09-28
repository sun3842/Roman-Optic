<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        echo 'No path To Go';
    }
    public function logout(){
        $this->session->sess_destroy();
        redirect(site_url('login'));
    }
}