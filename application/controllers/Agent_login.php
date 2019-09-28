<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Agent_login extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('agent_login')){
            redirect(site_url('agent_home'));

        }
        else{
            $this->load->model('Agent_common_model');
        }

    }

    public function index(){
        redirect(base_url('agent_login'));
    }

    public function login(){
//        print_r($_POST);die();
        if(count($_POST)>0){

            $status=$this->Agent_common_model->db_login_authentication();
            if($status==1)
            {
                redirect(site_url('agent_home'));
            }
            else
            {
                redirect(uri_string());
            }
        }
        else{
            $this->load->view('agent_others/login.php');
        }
    }
}