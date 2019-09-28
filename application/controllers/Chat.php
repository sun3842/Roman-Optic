<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Chat extends  CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('login')) {
            $this->load->model('Common_model');
            $this->load->model('Chat_model');


            if ($this->session->userdata('language') && $this->session->userdata('language') == 'LANG_IT') {
                $this->lang->load('chat_it_lang', 'italian');
                $this->lang->load('layout_it_lang', 'italian');
            }
            else
            {
                $this->lang->load('chat_en_lang', 'english');
                $this->lang->load('layout_en_lang', 'english');

            }
        } else {
            redirect(site_url('login'));
        }
    }

    public function index()
    {
        echo 'NO PATH TO GO';
    }

    public function view_chat()
    {
        if(count($_POST)>0)
        {

        }
        else
        {
            $result=$this->Chat_model->get_chat_users_by_limit(0);
            if(sizeof($result)>0){
                $data['chat_users']=$result;
                $data["last_user_chat"]=$this->Chat_model->get_all_chat_by_user_id($result[0]['ref_chat_downloaded_user_id']);
            }
            $data['title']="CHAT";


            $data['content']='chat/chat';
            $this->load->vars($data);
            $this->load->view('admin_layout/admin_main_layout');
        }
    }



    public function add_message()
    {
        $result=$this->Chat_model->add_new_chat_message();
        echo $result;
    }
    public function update_chat_box()
    {
        $result=$this->Chat_model->get_all_chat_by_user_id($this->input->post('chat_user_id'));
        echo json_encode($result,JSON_HEX_APOS);
    }


    public function refresh_user_list_with_length()
    {
        $result=$this->Chat_model->get_users_last_chat_by_limit($this->input->post('total_display_user'));
        echo json_encode($result,JSON_HEX_APOS);
    }
}