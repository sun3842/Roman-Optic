<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Branch extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('login')){
            $this->load->model('Common_model');
            $this->load->model('Branch_model');

            if ($this->session->userdata('language') && $this->session->userdata('language') == 'LANG_IT') {
                $this->lang->load('layout_it_lang', 'italian');
            }
            else
            {
                $this->lang->load('layout_en_lang', 'english');

            }
        }
        else{
            redirect(site_url('login'));
        }

        // load form and url helpers
        $this->load->helper(array('form', 'url'));

        // load form_validation library
        $this->load->library('form_validation');
    }

    public function index(){
        echo 'NO path To go';
    }


    public function add_new_branch(){
        if(count($_POST)>0)
        {
            $this->form_validation->set_rules('shop_name', 'SHOP NAME', 'required|trim');
            $this->form_validation->set_rules('shop_details', 'SHOP DETAILS', 'required|trim');
            $this->form_validation->set_rules('country_list', 'COUNTRY NAME', 'required|trim');
            $this->form_validation->set_rules('state_list', 'REGION NAME', 'required|trim');
            $this->form_validation->set_rules('city_list', 'CITY NAME', 'required|trim');
            $this->form_validation->set_rules('shop_address', 'ADDRESS', 'required|trim');
            $this->form_validation->set_rules('post_code', 'POST CODE', 'required|trim');
            $this->form_validation->set_rules('country_phone_code', 'COUNTRY CODE', 'required|trim');
            $this->form_validation->set_rules('phone_number', 'PHONE NUMBER', 'required|trim');
            $this->form_validation->set_rules('select_branch_time_table', 'TIMETABLE', 'required|trim');

            //Put email and url validation without required

            if ($this->form_validation->run() == FALSE)
            {
                $data['countries']=$this->Common_model->get_all_countries_details();

                $data['content']='branch/add_new_branch';
                $data['title']='CONTACT US';
                $this->load->vars($data);
                $this->load->view('admin_layout/admin_main_layout');
            }
            else
            {

               $status= $this->Branch_model->add_new_branch();
				if($status==1)
				{
					redirect(site_url('all_branch'));
				}
				else
				{
					redirect(site_url('add_branch'));
				}
            }


        }
        else{

            $data['countries']=$this->Common_model->get_all_countries_details();

            $data['content']='branch/add_new_branch';
            $data['title']='CONTACT US';
            $this->load->vars($data);
            $this->load->view('admin_layout/admin_main_layout');
        }
    }


    public function all_branch_list()
    {
       $data['all_branches']=$this->Branch_model->get_all_active_branch_list();

        $data['content']='branch/all_branch';
        $data['title']='CONTACT US';
        $this->load->vars($data);
        $this->load->view('admin_layout/admin_main_layout');
    }

    public function edit_branch_by_id($branch_id=0)
    {
        if($branch_id>0)
        {
            if(count($_POST)>0)
            {
                $this->form_validation->set_rules('shop_name', 'SHOP NAME', 'required|trim');
                $this->form_validation->set_rules('shop_details', 'SHOP DETAILS', 'required|trim');
                $this->form_validation->set_rules('country_list', 'COUNTRY NAME', 'required|trim');
                $this->form_validation->set_rules('state_list', 'REGION NAME', 'required|trim');
                $this->form_validation->set_rules('city_list', 'CITY NAME', 'required|trim');
                $this->form_validation->set_rules('shop_address', 'ADDRESS', 'required|trim');
                $this->form_validation->set_rules('post_code', 'POST CODE', 'required|trim');
                $this->form_validation->set_rules('country_phone_code', 'COUNTRY CODE', 'required|trim');
                $this->form_validation->set_rules('phone_number', 'PHONE NUMBER', 'required|trim');
                $this->form_validation->set_rules('select_branch_time_table', 'TIMETABLE', 'required|trim');

                //Put email and url validation without required

                if ($this->form_validation->run() == FALSE)
                {
                    $data['branch']=$this->Branch_model->get_branch_details_by_branch_id($branch_id);
                    $data['countries']=$this->Common_model->get_all_countries_details();

                    $data['content']='branch/edit_branch';
                    $data['title']='CONTACT US';
                    $this->load->vars($data);
                    $this->load->view('admin_layout/admin_main_layout');
                }
                else
                {

                    $status= $this->Branch_model->update_branch_by_branch_id($branch_id);
                    if($status==1)
                    {
                        redirect(site_url('all_branch'));
                    }
                    else
                    {
                        redirect(site_url('edit_branch'.$branch_id));
                    }
                }


            }
            else
            {
                $data['branch']=$this->Branch_model->get_branch_details_by_branch_id($branch_id);
                $data['countries']=$this->Common_model->get_all_countries_details();

                $data['content']='branch/edit_branch';
                $data['title']='CONTACT US';
                $this->load->vars($data);
                $this->load->view('admin_layout/admin_main_layout');
            }


        }
        else
        {
            redirect(site_url('home'));
        }
    }
}