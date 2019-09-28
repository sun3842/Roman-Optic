<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('login'))
		{
			$this->load->model('Message_model');
			$this->load->model('Common_model');

            if ($this->session->userdata('language') && $this->session->userdata('language') == 'LANG_IT') {
                $this->lang->load('message_it_lang.php', 'italian');
                $this->lang->load('layout_it_lang', 'italian');
            }
            else
            {
                $this->lang->load('message_en_lang.php', 'english');
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

	public function create_message(){

		if(count($_POST)>0){


			$this->load->library('form_validation');
			$this->form_validation->set_rules('message_title','message_title','required');
			$this->form_validation->set_rules('message_description','message_description','required');




			if($this->form_validation->run())
			{
				$this->Message_model->add_message();
                $this->session->set_flashdata('message','Message Added Successfully');
                redirect(uri_string());
			}


			else
			{
				$this->session->set_flashdata('message',validation_errors());
				redirect(uri_string());
			}


		}

		else{

            $data ["occupation_list"] = $this->Common_model->get_all_occupation();
            $data ["marital_status"] = $this->Common_model->get_all_marital_status();
//            $data ["cities"] = $this->Common_model->get_all_city();
			$data ['title'] = "MESSAGE";
			$data ['content'] = 'admin_message/admin_create_message';
			$this->load->vars($data);
			$this->load->view('admin_layout/admin_main_layout');
		}

	}



	public function message_list(){

        if(count($_POST)>0 && $this->input->post('offer_start_limit')){

               $result = $this->Message_model->get_all_message_list($this->input->post('offer_start_limit'));
               $temp_result=$result;
               $temp=0;

               foreach ($result AS $message)
            {
                $temp_result[$temp]['ref_message_target_type_id']=($message['ref_message_target_type_id']==1)? 'General':(($message['ref_message_target_type_id']==2)? 'Target':'Personal');
                $temp_result[$temp]['message_last_edited_date_time']=date_format(new DateTime($message
                	['message_last_edited_date_time']),'d F Y');
               
                $temp++;
            }

               echo json_encode($temp_result,JSON_HEX_APOS);
        }


        else{

        $data ["target_type"] = $this->Message_model->get_target_type_name();
        $data ["message"] = $this->Message_model->get_all_message_list(0);
		$data ['title'] = "MESSAGE";
		$data ['content'] = 'admin_message/admin_message_list';
		$this->load->vars($data);
		$this->load->view('admin_layout/admin_main_layout');

        }
        

	}

	public function de_active_message_by_message_id($message_id)
	{
		$result=$this->Message_model->delete_message_by_message_id($message_id);
		if($result==0){
			$this->session->set_flashdata('error','Message Updating Failed');
			redirect(uri_string());

		}
		else if($result==-1){
			$this->session->set_flashdata('error','Message Not Found');
			redirect(uri_string());

		}
		else{
			$this->session->set_flashdata('message','Message Deleted');
			redirect(site_url('news_message_list'));

		}

	}


	public function edit_message($message_id)
	{
		if(count($_POST)>0){

            
			$this->load->library('form_validation');
			$this->form_validation->set_rules('message_title','message_title','required');
			$this->form_validation->set_rules('message_description','message_description','required');
			

			

			if($this->form_validation->run())
			{
				$this->Message_model->update_message_by_id($message_id);
                $this->session->set_flashdata('message','Message Added Successfully');
                redirect('news_message_list');
			}


			else
			{
				$this->session->set_flashdata('message',validation_errors());
				redirect(uri_string());
			}



		}

		else{

            $data ["message"] = $this->Message_model->get_message_data_by_id($message_id);
            $data ["occupation_list"] = $this->Common_model->get_all_occupation();
            $data ["marital_status"] = $this->Common_model->get_all_marital_status();
//            $data ["cities"] = $this->Common_model->get_all_city();
			$data ['title'] = "MESSAGE";
			$data ['content'] = 'admin_message/edit_message';
			$this->load->vars($data);
			$this->load->view('admin_layout/admin_main_layout');
		}


	}
}