<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('login')){

            $this->load->model('Home_model');

            if ($this->session->userdata('language') && $this->session->userdata('language') == 'LANG_IT') {
                $this->lang->load('layout_it_lang', 'italian');
                $this->lang->load('home_it_lang', 'italian');

            }
            else
            {
                $this->lang->load('layout_en_lang', 'english');
                $this->lang->load('home_en_lang', 'english');
            }

        }
        else{
            redirect(site_url('login'));
        }
    }

    public function index()
	{

	    echo 'No Path To Go';

	}


	public function home(){
        $data['content']='home/dashboard';
        $data['title']='Home';
        $data['last_week_expired_lenses']=$this->Home_model->get_all_last_week_expiried_lenses();
        $data['total_download']= $this->Home_model->get_all_download_list();
        $data['total_feedback_7_days']= $this->Home_model->get_all_feedback_list_7_days();
        $data['total_chat_7_days']= $this->Home_model->get_all_chat_list_7_days();

        $this->load->vars($data);
        $this->load->view('admin_layout/admin_main_layout');
    }
    public function all_week_expired_lens_users()
    {
        $data['last_week_expired_lenses']=$this->Home_model->get_all_last_week_expiried_lenses();
        $data['title']='Home';
        $data['content']='home/expired_user_list';
        $this->load->vars($data);
        $this->load->view('admin_layout/admin_main_layout');
    }
}
