<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Download extends  CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if($this->session->userdata('login'))
        {
            $this->load->model('Download_model');
            $this->load->model('Common_model');

            if ($this->session->userdata('language') && $this->session->userdata('language') == 'LANG_IT') {
                $this->lang->load('download_it_lang.php', 'italian');
                $this->lang->load('layout_it_lang', 'italian');
            }
            else
            {
                $this->lang->load('download_en_lang.php', 'english');
                $this->lang->load('layout_en_lang', 'english');

            }
        }

        else
        {
            redirect(site_url('login'));
        }

    }
    public function index(){
        echo 'NO PATH TO GO';
    }

    public function download_list(){

        if(count($_POST)>0){

          $this->load->library('form_validation');

        if($this->input->post('block_user_button')){

            $this->form_validation->set_rules('block_user','block_user','required');
            

            if($this->form_validation->run())
            {
                $this->Download_model->add_block_reason_message();
                $this->session->set_flashdata('message','Blocked Successfully');
                redirect(uri_string());
            }


            else
            {
                $this->session->set_flashdata('message',validation_errors());
                redirect(uri_string());
            }



        }

         if($this->input->post('unblock_user_button')){

//            print_r($_POST);die();
             $this->Download_model->add_unblock_message();
             $this->session->set_flashdata('message','Unblocked Successfully');
             redirect(uri_string());



        }
        if($this->input->post('send_message')){
            
           
            $this->form_validation->set_rules('message_title','message_title','required');
            $this->form_validation->set_rules('message_description','message_description','required');
            

            

            if($this->form_validation->run())
            {
                $this->Download_model->add_downloader_message();
                $this->session->set_flashdata('message','Message Added Successfully');
                redirect(uri_string());
            }


            else
            {
                $this->session->set_flashdata('error',validation_errors());
                redirect(uri_string());
            }



        }

    }

   

        else{
        
            $data["downloads"] = $this->Download_model->get_all_download_list();
            $data['title']="APP USERS";
            $data['content']='download/all_download';
            $this->load->vars($data);
            $this->load->view('admin_layout/admin_main_layout');
        
    }



}

}