<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Opticians extends  CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if($this->session->userdata('login')){

            $this->load->model('Opticians_model');
            $this->load->model('Common_model');

            if ($this->session->userdata('language') && $this->session->userdata('language') == 'LANG_IT') {
                $this->lang->load('optician_it_lang.php', 'italian');
                $this->lang->load('layout_it_lang', 'italian');
            }
            else
            {
                $this->lang->load('optician_en_lang.php', 'english');
                $this->lang->load('layout_en_lang', 'english');

            }
        }

        else{

            redirect(site_url('login'));

        }
    }


    public function index()
    {

        echo "Access Denied";
    }

    public function optician_list(){

        $data['team_members']=$this->Opticians_model->get_all_member_list();
        $data['title']='OPTICIAN';
        $data['content']='optician/all_optician';
        $this->load->vars($data);
        $this->load->view('admin_layout/admin_main_layout');

    }

    public function new_optician(){
        if(count($_POST)>0)
        {

            $this->load->library('form_validation');
            $this->form_validation->set_rules('first_name','first_name','required');
            $this->form_validation->set_rules('last_name','last_name','required');
            $this->form_validation->set_rules('designation','designation','required');
            $this->form_validation->set_rules('branch_name','branch_name','required');
            $this->form_validation->set_rules('email','email','valid_email');




            if($this->form_validation->run())
            {
                $this->Opticians_model->add_opticians();
                $this->session->set_flashdata('message','Opticians Added Successfully');
                redirect(uri_string());
            }


            else
            {
                $this->session->set_flashdata('error',validation_errors());
                redirect(uri_string());
            }




        }
        else
        {

            $data['branch_names'] = $this->Opticians_model->get_all_branch_names();
            $data['title']='OPTICIAN';
            $data['content']='optician/add_optician';
            $this->load->vars($data);
            $this->load->view('admin_layout/admin_main_layout');
        }
    }

    public function de_active_optician_by_team_member_id($team_member_id)
    {
        $result = $this->Opticians_model->delete_optician_by_team_member_id($team_member_id);

        if($result==0){
            $this->session->set_flashdata('error','Optician Updating Failed');
            redirect(uri_string());
        }
        else if($result==-1){
            $this->session->set_flashdata('error','Optician Not Found');
            redirect(uri_string());
        }
        else{
            $this->session->set_flashdata('message','Optician Deleted');
            redirect(site_url('all_optician'));
        }
    }

    public function edit_optician($team_member_id)
    {
        if(count($_POST)>0){


            $this->load->library('form_validation');
            $this->form_validation->set_rules('first_name','first_name','required');
            $this->form_validation->set_rules('last_name','last_name','required');
            $this->form_validation->set_rules('designation','designation','required');
            $this->form_validation->set_rules('branch_name','branch_name','required');
            $this->form_validation->set_rules('email','email','valid_email');

            if($this->form_validation->run())
            {
                $this->Opticians_model->update_optician_by_id($team_member_id);
                $this->session->set_flashdata('message','Optician Updated Successfully');
                redirect(site_url('all_optician'));
            }
            else
            {
                $this->session->set_flashdata('error',validation_errors());
                redirect(uri_string());
            }


        }

        else{

            $data["optician"] = $this->Opticians_model->get_optician_data_by_id($team_member_id);
            $data['branch_names'] = $this->Opticians_model->get_all_branch_names();
            $data['title']='OPTICIAN';
            $data['content']='optician/edit_optician';
            $this->load->vars($data);
            $this->load->view('admin_layout/admin_main_layout');


        }
    }
}