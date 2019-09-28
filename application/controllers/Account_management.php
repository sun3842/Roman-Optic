<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Account_management extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('login')) {
            $this->load->model('Common_model');
            $this->load->model('Account_management_model');

            if ($this->session->userdata('language') && $this->session->userdata('language') == 'LANG_IT') {
                $this->lang->load('account_management_it_lang', 'italian');
                $this->lang->load('layout_it_lang', 'italian');
            }
            else
            {
                $this->lang->load('account_management_en_lang', 'english');
                $this->lang->load('layout_en_lang', 'english');

            }

        }
        else
        {
            redirect(site_url('login'));
        }
    }

    public function index()
    {
        echo 'NO PATH TO GO';
    }

    public function check_user_password()
    {
        if (count($_POST) > 0 && $this->input->post('user_password')) {

            $result = $this->Account_management_model->check_is_password_valid();
            if ($result == true) {
                $result = $this->Account_management_model->get_app_admin_by_app_id();
                echo json_encode($result, JSON_HEX_APOS);
            } else {
                echo 0;
            }


        } else {
            $data['content'] = 'account_management/check_user_password';
            $data['title'] = 'Account Management';
            $this->load->vars($data);
            $this->load->view('admin_layout/admin_main_layout');
        }
    }


    public function update_app_user()
    {
//        print_r($_POST);die();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('update_user_email', 'update_user_email', 'required');
        if ($this->form_validation->run()) {
            $result = $this->Account_management_model->update_app_user_info();
            if ($result == 1) {
                $this->session->set_flashdata('message', 'User Info Updated Successfully');
                redirect(site_url('check_account_password'));
            } else if ($result == 1) {
                $this->session->set_flashdata('error', 'User Info Updated Failed');
                redirect(site_url('check_account_password'));
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect(site_url('check_account_password'));
        }
    }

    public function app_user_new_pass()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('user_new_password', 'user_new_password', 'required|min_length[4]');
        $this->form_validation->set_rules('user_re_new_pass', 'user_re_new_pass', 'required|matches[user_new_password]');
        if ($this->form_validation->run()) {
            $result = $this->Account_management_model->update_app_user_password();
            if ($result == 1) {
                $this->session->set_flashdata('message', 'User Pass Updated Successfully');
                redirect(site_url('check_account_password'));
            } else if ($result == 1) {
                $this->session->set_flashdata('error', 'User Pass Updated Failed');
                redirect(site_url('check_account_password'));
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect(site_url('check_account_password'));
        }
    }
    public function user_info()
    {
        $this->load->view('account_management/user_info');
    }

}