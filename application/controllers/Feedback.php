<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Feedback extends  CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('login'))
        {

            $this->load->model('Feedback_model');
            $this->load->model('Common_model');

            if ($this->session->userdata('language') && $this->session->userdata('language') == 'LANG_IT') {
                $this->lang->load('feedback_it_lang.php', 'italian');
                $this->lang->load('layout_it_lang', 'italian');
            }
            else
            {
                $this->lang->load('feedback_en_lang.php', 'english');
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

    public function feedback_list(){

            if($this->input->post('feedback_id')){ 
              $this->Feedback_model->update_status();
                // echo $this->input->post('feedback_status');
            }

            else
            {
                $data['feedbacks'] = $this->Feedback_model->get_all_feedback();
                $data['feedback_count'] = $this->Feedback_model->feedback_count();
                $data['title']="FEEDBACK";
                $data['content']='feedback/all_feedback';
                $this->load->vars($data);
                $this->load->view('admin_layout/admin_main_layout');
            }

            
        
    }

    public function view_feedback_by_id($feedback_id){

        if($this->input->post('admin_reply_submit'))
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('admn_reply','admn_reply','required');
            
            if($this->form_validation->run())
            {
                 $this->Feedback_model->add_admin_reply_by_feedback_id();
                $this->session->set_flashdata('message','Reply Added Successfully');
                redirect(uri_string());
            }


            else
            {
                $this->session->set_flashdata('error',validation_errors());
                redirect(uri_string());
            }


           
        }

            $data['feedbacks_details'] = $this->Feedback_model->get_feedback_by_id($feedback_id);
            $data['title']="FEEDBACK";
            $data['content']='feedback/feedback_details';
            $this->load->vars($data);
            $this->load->view('admin_layout/admin_main_layout');
        
    }

   /* public function feedback_reply_by_id()
    {
        if($this->input->post('admin_reply_submit'))
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('admn_reply','admn_reply','required');
            
            if($this->form_validation->run())
            {
                 $this->Feedback_model->add_admin_reply_by_feedback_id();
                $this->session->set_flashdata('message','Reply Added Successfully');
                redirect(uri_string());
            }


            else
            {
                $this->session->set_flashdata('error',validation_errors());
                redirect(uri_string());
            }


           
        }


    }*/
}