<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('login')){
            $this->load->model('Collection_model');
        }
        else{
            redirect(site_url('login'));
        }
    }

    public function index(){
        echo 'NO PATH TO GO';
    }

    public function view_dashboard(){
        if(count($_POST)>0){

        }
        else{
            $data['title']="DASHBOARD";
            $data['content']='others/dashboard';
            $this->load->vars($data);
            $this->load->view('admin_layout/admin_main_layout');
        }
    }
}