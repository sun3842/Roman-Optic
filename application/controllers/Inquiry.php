<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Inquiry extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        if($this->session->userdata('login'))
        {
            $this->load->model('Inquiry_model');
            $this->load->model('Common_model');
            if ($this->session->userdata('language') && $this->session->userdata('language') == 'LANG_IT') {
                $this->lang->load('inquiry_it_lang', 'italian');
                $this->lang->load('layout_it_lang', 'italian');
            }
            else
            {
                $this->lang->load('inquiry_en_lang', 'english');
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

	public function inquiry_list(){

        if(count($_POST)>0 && $this->input->post('inquiry_limit')){

            $result=$this->Inquiry_model->get_all_inquiry_by_limit($this->input->post('inquiry_limit'));
            echo json_encode($result,JSON_HEX_APOS);
        }

		else{

			$data ['title'] = "Inquiry";
			$data['inquiries']=$this->Inquiry_model->get_all_inquiry_by_limit(0);
			$data ['content'] = 'inquiry/inquiry_list';
			$this->load->vars($data);
			$this->load->view('admin_layout/admin_main_layout');
		}

	}

	public function inquiry_reply($inquiry_id){

		if(count($_POST)>0 && $this->input->post('reply_submit')){


                $this->load->library('form_validation');
                $this->form_validation->set_rules('inquiry_reply','inquiry_reply','required');
                if($this->form_validation->run())
                {
                    $result=$this->Inquiry_model->add_inquiry_message_by_inquiry_id($inquiry_id);
                    if($result==-1)
                    {
                        $this->session->set_flashdata('error','Inquiry Not Found');
                        redirect(site_url('inquiry_list'));
                    }
                    else if($result==0)
                    {
                        $this->session->set_flashdata('error','Inquiry Reply Failed');
                        redirect(uri_string());
                    }
                    else
                    {
                        $this->session->set_flashdata('message','Inquiry Reply Send Successfully');
                        redirect(uri_string());
                    }
                }
                else{
                    $this->session->set_flashdata('error',validation_errors());
                    redirect(uri_string());
                }


		}

		else{
		    $result=$this->Inquiry_model->get_inquiry_reply_by_id($inquiry_id);
		    if($result==-1)
		    {
		        $this->session->set_flashdata('error','This is not Yours');
		        redirect(site_url('inquiry_list'));
            }
            else if($result==0)
            {
                $this->session->set_flashdata('error','Technical  Problem');
                redirect(site_url('inquiry_list'));
            }

			$data ['title'] = "Inquiry";
			$data ['inquiry']=$result;
			$data ['content'] = 'inquiry/inquiry_reply';
			$this->load->vars($data);
			$this->load->view('admin_layout/admin_main_layout');
		}

	}
}