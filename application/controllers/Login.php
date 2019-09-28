<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Login extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('login')){
            redirect(site_url('home'));

        }
        else{
            $this->load->model('Common_model');
        }

    }

    public function index(){
        redirect(base_url('login'));
    }

    public function login(){
//        print_r($_POST);die();
        if(count($_POST)>0){

            $status=$this->Common_model->db_login_authentication();
            if($status==1)
            {
                redirect(site_url('home'));
            }
            else
            {
                redirect(uri_string());
            }
        }
        else{
            $this->load->view('others/login.php');
        }
    }
}