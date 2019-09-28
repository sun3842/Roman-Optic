<?php defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        if($this->session->userdata('login'))
        {
            $this->load->model('News_model');
            $this->load->model('Common_model');

            if ($this->session->userdata('language') && $this->session->userdata('language') == 'LANG_IT') {
                $this->lang->load('news_it_lang', 'italian');
                $this->lang->load('layout_it_lang', 'italian');
            }
            else
            {
                $this->lang->load('news_en_lang', 'english');
                $this->lang->load('layout_en_lang', 'english');

            }
        }
    }

    public function index(){

        echo "Access Denied";
    }

    public function create_news(){

        if($this->input->post('news_submit')){

            $this->load->library('form_validation');
            $this->form_validation->set_rules('news_title','news_title','required');
            $this->form_validation->set_rules('news_description','news_description','required');


            if($this->form_validation->run())
            {
                $this->News_model->add_news();
                $this->session->set_flashdata('message','News Added Successfully');
                redirect(uri_string());
            }


            else
            {
                $this->session->set_flashdata('error',validation_errors());
                redirect(uri_string());
            }


        }

        else{

            $data ['title'] = "NEWS";
            $data ['content'] = 'admin_news/admin_create_news';
            $this->load->vars($data);
            $this->load->view('admin_layout/admin_main_layout');
        }

    }

    public function news_list(){



        if(count($_POST)>0 && $this->input->post('news_start_limit')){

            $result = $this->News_model->get_all_news_list($this->input->post('news_start_limit'));
            $temp_result=$result;
            $temp=0;

            foreach ($result AS $news)
            {
                $temp_result[$temp]['news_created_date_time']=date_format(new DateTime($news['news_created_date_time']),'d F Y');

                $temp++;
            }

            echo json_encode($temp_result);
        }



        else {
            $data['news_list'] = $this->News_model->get_all_news_list(0);
            $data ['title'] = "NEWS";
            $data ['content'] = 'admin_news/admin_news_list';
            $this->load->vars($data);
            $this->load->view('admin_layout/admin_main_layout');

        }
    }

    public function edit_news($news_id)
    {
        if($this->input->post('edit_news_submit')){


//            print_r($_POST);die();
            $this->load->library('form_validation');
            $this->form_validation->set_rules('news_title','news_title','required');
            $this->form_validation->set_rules('news_description','news_description','required');

            if($this->form_validation->run())
            {
                $this->News_model->update_news_by_id($news_id);
                $this->session->set_flashdata('message','News Updated Successfully');
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

            $data["edit_news"] = $this->News_model->get_news_data_by_id($news_id);
            $data ['title'] = "NEWS";
            $data ['content'] = 'admin_news/edit_news';
            $this->load->vars($data);
            $this->load->view('admin_layout/admin_main_layout');


        }
    }

    public function de_active_news_by_news_id($news_id)
    {
        $result = $this->News_model->delete_News_by_news_id($news_id);

        if($result==0){
            $this->session->set_flashdata('error','News Removing Failed');
            redirect(uri_string());
        }
        else if($result==-1){
            $this->session->set_flashdata('error','News Not Found');
            redirect(uri_string());
        }
        else{
            $this->session->set_flashdata('message','News Deleted');
            redirect(site_url('news_list'));
        }
    }
}