<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_job extends CI_Controller {

    public function index()
    {

        echo 'No Path To Go';

    }


    public function create_job(){
       $data['content']='admin_job/create_job';
       $data['title']='Job';
       $this->load->vars($data);
       $this->load->view('admin_layout/admin_main_layout');
    }
}
