<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_contact_us extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        echo 'NO path To go';
    }

    public function contact_us(){
        if(count($_POST)>0){

        }
        else{
            $data['content']='admin_contact_us/contact_us';
            $data['title']='CONTACT US';
            $this->load->vars($data);
            $this->load->view('admin_layout/admin_main_layout');
        }
    }
}