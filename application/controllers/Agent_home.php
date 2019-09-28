<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Agent_home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('agent_login')){

            if ($this->session->userdata('language') && $this->session->userdata('language') == 'LANG_IT') {

                $this->lang->load('layout_it_lang', 'italian');
            }
            else
            {
                $this->lang->load('layout_en_lang', 'english');

            }

        }
        else{
            redirect(site_url('agent_login'));
        }
    }

    public function index()
	{

	    echo 'No Path To Go';

	}


	public function home(){
        $data['content']='agent_layout/agent_home';
        $data['title']='Home';
        $this->load->vars($data);
        $this->load->view('agent_layout/agent_main_layout');
    }
}
