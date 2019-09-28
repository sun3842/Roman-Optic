<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Job extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        if($this->session->userdata('login'))
        {
            $this->load->model('Job_model');
            $this->load->model('Common_model');

            if ($this->session->userdata('language') && $this->session->userdata('language') == 'LANG_IT') {
                $this->lang->load('job_it_lang.php', 'italian');
                $this->lang->load('layout_it_lang', 'italian');
            }
            else
            {
                $this->lang->load('job_en_lang.php', 'english');
                $this->lang->load('layout_en_lang', 'english');

            }
        }

        else
        {
            redirect(site_url('login'));
        }

    }

    public function index(){

        echo "Access Denied";
    }


    public function create_job(){

        if($this->input->post('job_info_submit'))
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('job_title','job_title','required');
            $this->form_validation->set_rules('job_position','job_position','required');
            $this->form_validation->set_rules('employment_status','employment_status','required');



            if($this->form_validation->run())
            {
                $this->Job_model->add_job_info();
                $this->session->set_flashdata('message','Job Info Added Successfully');
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
            $data["currency"] = $this->Job_model->get_all_currency_name();
            $data["jobs_position"] = $this->Job_model->get_all_jobs_position();
            $data["employment_status"] = $this->Job_model->get_all_employment_status();
            $data['content']='admin_job/create_job';
            $data['title']='Job';
            $this->load->vars($data);
            $this->load->view('admin_layout/admin_main_layout');
        }

    }


    public function job_list()
    {
        $data['jobs_details'] = $this->Job_model->get_job_details();
        $data['content']='admin_job/all_job';
        $data['title']='Job';
        $this->load->vars($data);
        $this->load->view('admin_layout/admin_main_layout');
    }

    public function edit_job($jobs_id)
    {
        if($this->input->post('job_info_submit'))
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('job_title','job_title','required');
            $this->form_validation->set_rules('job_position','job_position','required');
            $this->form_validation->set_rules('employment_status','employment_status','required');




            if($this->form_validation->run())
            {
                $this->Job_model->update_job_details_by_id($jobs_id);
                $this->session->set_flashdata('message','Job Added Successfully');
                redirect('job_list');
            }


            else
            {
                $this->session->set_flashdata('error',validation_errors());
                redirect(uri_string());
            }



        }

        else{

            $data ["jobs"] = $this->Job_model->get_job_data_by_id($jobs_id);
            $data["currency"] = $this->Job_model->get_all_currency_name();
            $data["jobs_position"] = $this->Job_model->get_all_jobs_position();
            $data["employment_status"] = $this->Job_model->get_all_employment_status();
            $data['content']='admin_job/edit_job';
            $data['title']='Job';
            $this->load->vars($data);
            $this->load->view('admin_layout/admin_main_layout');
        }


    }

    public function deactive_job($jobs_id)
    {
        $result=$this->Job_model->delete_job_by_job_id($jobs_id);
        if($result==0){
            $this->session->set_flashdata('error','Job Info Updating Failed');
            redirect(uri_string());

        }
        else if($result==-1){
            $this->session->set_flashdata('error','Job Info Not Found');
            redirect(uri_string());

        }
        else{
            $this->session->set_flashdata('message','Job Info Deleted');
            redirect(site_url('job_list'));

        }
    }
}
