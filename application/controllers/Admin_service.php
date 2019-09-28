<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_service extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('login')){

			$this->load->model('Service_model');
            $this->load->model('Common_model');

            if ($this->session->userdata('language') && $this->session->userdata('language') == 'LANG_IT') {
                $this->lang->load('service_it_lang.php', 'italian');
                $this->lang->load('layout_it_lang', 'italian');
            }
            else
            {
                $this->lang->load('service_en_lang.php', 'english');
                $this->lang->load('layout_en_lang', 'english');

            }
		}

		else{

			redirect(site_url('login'));

		}
	}

	public function index(){

		echo "Access Denied";
	}




	public function create_service(){

		if(count($_POST)>0){


           /* print_r($_FILES['service_image']);
           print_r($_POST);die();*/

           $this->load->library('form_validation');
           $this->form_validation->set_rules('service_name','service_name','trim|required');
           $this->form_validation->set_rules('service_description','service_description','required');
           if($this->form_validation->run())
           {
           	$this->Service_model->add_new_service();
           	$this->session->set_flashdata('message','Service Added Successfully');
           	redirect(uri_string());
           }
           else
           {
           	$this->session->set_flashdata('message',validation_errors());
           	redirect(uri_string());
           }




       }

       else{


       	$data ['title'] = "SERVICE";
       	$data ['content'] = 'admin_service/admin_create_service';
       	$this->load->vars($data);
       	$this->load->view('admin_layout/admin_main_layout');
       }

   }


public function edit_service($service_id){

		if(count($_POST)>0){


          /* print_r($_FILES['service_image']);
           print_r($_POST);die();*/

           $this->load->library('form_validation');
           $this->form_validation->set_rules('service_name','service_name','trim|required');
           $this->form_validation->set_rules('service_description','service_description','required');
           if($this->form_validation->run())
           {
           	$this->Service_model->update_service_by_id($service_id);
           	$this->session->set_flashdata('message','Service Updated Successfully');
           	redirect(uri_string());
           }
           else
           {
           	$this->session->set_flashdata('message',validation_errors());
           	redirect(uri_string());
           }




       }

       else{

            $data ["services"] = $this->Service_model->get_service_data_by_id($service_id);
		   	$data ['title'] = "SERVICE";
		   	$data ['content'] = 'admin_service/edit_service';
		   	$this->load->vars($data);
		   	$this->load->view('admin_layout/admin_main_layout');

       	
       }

   }


   public function service_list(){

   	$data ["services"] = $this->Service_model->get_all_service_list();
   	$data ['title'] = "SERVICE";
   	$data ['content'] = 'admin_service/admin_service_list';
   	$this->load->vars($data);
   	$this->load->view('admin_layout/admin_main_layout');


   }

   public function de_active_service_by_service_id($service_id){
   	$result=$this->Service_model->delete_service_by_service_id($service_id);
   	if($result==0){
   		$this->session->set_flashdata('error','service Updating Failed');
   	}
   	else if($result==-1){
   		$this->session->set_flashdata('error','Service Not Found');
   	}
   	else{
   		$this->session->set_flashdata('message','Service Deleted');
   	}
   }
}