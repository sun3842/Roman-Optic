<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Language extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
//        if($this->session->userdata('login_id')){
//
//        }
//        else{
//            redirect(base_url('Login'));
//        }
    }
    public function index(){
        redirect(base_url("Home"));
    }

    function set_language($language_name,$url=NULL,$others=NULL)
    {
        $this->session->set_userdata('language',$language_name);
        if($url==NULL)$url=base_url();
        if($others!=NULL)$url=$url."/".$others;
        redirect($url);
    }
}