<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Agent_app extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('agent_login')) {

            $this->load->model('Agent_app_model');
            $this->load->model('Agent_common_model');

            if ($this->session->userdata('language') && $this->session->userdata('language') == 'LANG_IT') {
                $this->lang->load('agent_app_it_lang', 'italian');
                $this->lang->load('layout_it_lang', 'italian');
            }
            else
            {
                $this->lang->load('agent_app_en_lang', 'english');
                $this->lang->load('layout_en_lang', 'english');

            }

        } else {
            redirect(site_url('agent_login'));
        }
    }

    public function index()
    {

        echo 'No Path To Go';

    }

    public function  all_apps()
    {
        if(count($_POST)>0)
        {

        }
        else
        {
            $data['content']='agent_app/app_list';
            $data['title']='APPS';
            $data['apps']=$this->Agent_app_model->get_all_app_request_from_agent();
            $this->load->vars($data);
            $this->load->view('agent_layout/agent_main_layout');
        }
    }

    public function new_app()
    {
        if(count($_POST)>0 && $this->input->post('btn_add_app'))
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('app_name','app_name','required');
            $this->form_validation->set_rules('app_user_name','app_user_name','required|is_unique[admin_panel_login.admin_panel_login_username]');
            if($this->form_validation->run())
            {
                $result=$this->Agent_app_model->add_app();
                if($result==0)
                {
                    $this->session->set_flashdata('error','App Add Request Sending Failed');
                    redirect(uri_string());
                }
                else if($result==1)
                {
                    $this->session->set_flashdata('message','Request Added Successfully');
                    redirect(uri_string());
                }
            }
            else
            {
                $this->session->set_flashdata('error',validation_errors());
                redirect(uri_string());
            }
        }
        else
        {
            $data['content']='agent_app/add_app';
            $data['title']='APPS';
            $data['app_modules']=$this->Agent_app_model->get_all_module();
            $this->load->vars($data);
            $this->load->view('agent_layout/agent_main_layout');
        }
    }

    public function app_user_name_exist_or_not($app_id=NULL)
    {
        $result=NULL;
        if($app_id==NULL)
        {
            $app_user_name=$this->input->post('app_user_name');
            $result=$this->Agent_app_model->get_app_user_by_app_user_name($app_user_name);
        }
        else
        {
            $app_user_name=$this->input->post('app_user_name');
            $result=$this->Agent_app_model->get_app_user_by_app_user_name_and_id($app_user_name,$app_id);
        }

        if(sizeof($result)<=0){
            echo 'true';
        }
        else
        {
            echo 'false';
        }
    }

    public function delete_app_by_id($app_id)
    {
        $result=$this->Agent_app_model->delete_app_by_id($app_id);
        if($result==0)
        {
            $this->session->set_flashdata('error','App Add Request Sending Failed');
            redirect(site_url('agent_apps'));
        }
        else if($result==1)
        {
            $this->session->set_flashdata('message','App Deleted Successfully');
            redirect(site_url('agent_apps'));
        }
        else if($result==-1)
        {
            $this->session->set_flashdata('error','App Not Found');
            redirect(site_url('agent_apps'));
        }
    }

    public function update_app_by_id($app_id)
    {
        if(count($_POST)>0 && $this->input->post('app_name'))
        {


            $this->load->library('form_validation');
            $this->form_validation->set_rules('app_name','app_name','required');
            $this->form_validation->set_rules('app_user_name','app_user_name','required');
            if($this->form_validation->run())
            {
                $result=$this->Agent_app_model->update_app_by_id($app_id);
                if($result==0)
                {
                    $this->session->set_flashdata('error','App Updating Failed');
                    redirect(site_url('agent_apps'));
                }
                else if($result==1)
                {
                    $this->session->set_flashdata('message','App Updated Successfully');
                    redirect(uri_string());
                }
                else if($result==-1)
                {
                    $this->session->set_flashdata('error','App Not Found');
                    redirect(site_url('agent_apps'));
                }
            }
            else
            {
                $this->session->set_flashdata('error',validation_errors());
                redirect(uri_string());
            }

        }
        else
        {
            $data['content']='agent_app/edit_app';
            $data['title']='APPS';
            $data['app_details']=$this->Agent_app_model->get_app_by_app_info_id($app_id);
            $data['app_modules']=$this->Agent_app_model->get_all_module();
            $this->load->vars($data);
            $this->load->view('agent_layout/agent_main_layout');
        }

    }
    public function view_app_details_by_id($app_id)
    {
        $result=$this->Agent_app_model->get_app_by_app_info_id($app_id);
        if(sizeof($result)<=0)
        {
            $this->session->set_flashdata('error','App Not Found');
            redirect(site_url('agent_apps'));

        }
        $data['content']='agent_app/app_details';
        $data['title']='APPS';
        $data['app_details']=$result;
        $this->load->vars($data);
        $this->load->view('agent_layout/agent_main_layout');
    }
}