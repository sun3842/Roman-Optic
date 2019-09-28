<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Lens extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        if ($this->session->userdata('login'))
        {
            $this->load->model('Lens_model');
            $this->load->model('Common_model');
            if ($this->session->userdata('language') && $this->session->userdata('language') == 'LANG_IT') {
                $this->lang->load('lens_user_it_lang', 'italian');
                $this->lang->load('layout_it_lang', 'italian');
            }
            else
            {
                $this->lang->load('lens_user_en_lang', 'english');
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

	public function lens_user(){

		if(count($_POST)>0 && $this->input->post('user_start_limit')){
            $result=$this->Lens_model->get_all_lens_user_by_limit($this->input->post('user_start_limit'));
            echo  json_encode($result,JSON_HEX_APOS);
		}

		else{

			$data ['title'] = "Lens";
			$data ['content'] = 'lens/lens_user';
			$data['lens_users']=$this->Lens_model->get_all_lens_user_by_limit(0);
			$this->load->vars($data);
			$this->load->view('admin_layout/admin_main_layout');
		}

	}

	public function add_lens_user(){

        if(count($_POST)>0 && $this->input->post('user_first_name'))
        {
//            print_r($_POST);die();
            $this->load->library('form_validation');
            $this->form_validation->set_rules('user_first_name','user_first_name','required');
            $this->form_validation->set_rules('user_last_name','user_last_name','required');
            $this->form_validation->set_rules('left_sphere_power_value','left_sphere_power_value','required');
            $this->form_validation->set_rules('left_cylinder_power_value','left_cylinder_power_value','required');
            $this->form_validation->set_rules('right_sphere_power_value','left_sphere_power_value','required');
            $this->form_validation->set_rules('right_cylinder_power_value','left_cylinder_power_value','required');
            $this->form_validation->set_rules('right_lens_type','right_lens_type','required');
            $this->form_validation->set_rules('left_lens_type','left_lens_type','required');

            $this->form_validation->set_rules('user_phone','user_phone','required');
            $this->form_validation->set_rules('left_lens_duration','left_lens_duration','greater_than_equal_to[0]');
            $this->form_validation->set_rules('right_lens_duration','right_lens_duration','greater_than_equal_to[0]');

            if($this->form_validation->run())
            {
                $result=$this->Lens_model->add_lens_user();
                if($result==0)
                {
                    $this->session->set_flashdata('error','User Addition Failed');
                    redirect(uri_string());
                }
                else
                {
                    $this->session->set_flashdata('message','User Added Successfully');
                    redirect(uri_string());
                }
            }
            else
            {
                $this->session->set_flashdata('error',validation_errors());
                redirect(uri_string());
            }

        }
		else if(count($_POST)>0 && $this->input->post('user_name')){

		    $result=$this->Lens_model->get_download_user_by_name($this->input->post('user_name'));

		    echo json_encode($result,JSON_HEX_APOS);

		}

		else if(count($_POST)>0  && $this->input->post('country_id'))
        {
            $result=$this->Lens_model->get_all_states_by_country_id($this->input->post('country_id'));
            echo json_encode($result,JSON_HEX_APOS);
        }

        else if(count($_POST)>0  && $this->input->post('region_id'))
        {
            $result=$this->Lens_model->get_all_cities_by_states_id($this->input->post('region_id'));
            echo json_encode($result,JSON_HEX_APOS);
        }


		else{

			$data ['title'] = "Lens";
			$data ['content'] = 'lens/add_lens_user';
			$data['countries']=$this->Lens_model->get_all_country();
			$data['lens_types']=$this->Lens_model->get_all_lens_type();
			$this->load->vars($data);
			$this->load->view('admin_layout/admin_main_layout');
		}

	}


	public function update_lens_user($user_id)
    {
        if(count($_POST)>0 && $this->input->post('user_first_name'))
        {
//            print_r($_POST);die();
            $this->load->library('form_validation');
            $this->form_validation->set_rules('user_first_name','user_first_name','required');
            $this->form_validation->set_rules('user_last_name','user_last_name','required');
            $this->form_validation->set_rules('left_sphere_power_value','left_sphere_power_value','required');
            $this->form_validation->set_rules('left_cylinder_power_value','left_cylinder_power_value','required');
            $this->form_validation->set_rules('right_sphere_power_value','left_sphere_power_value','required');
            $this->form_validation->set_rules('right_cylinder_power_value','left_cylinder_power_value','required');
            $this->form_validation->set_rules('right_lens_type','right_lens_type','required');
            $this->form_validation->set_rules('left_lens_type','left_lens_type','required');

            $this->form_validation->set_rules('user_phone','user_phone','required');
            $this->form_validation->set_rules('left_lens_duration','left_lens_duration','greater_than_equal_to[0]');
            $this->form_validation->set_rules('right_lens_duration','right_lens_duration','greater_than_equal_to[0]');

            if($this->form_validation->run())
            {
                $result=$this->Lens_model->update_lens_user_by_id($user_id);
                if($result==0)
                {
                    $this->session->set_flashdata('error','User Addition Failed');
                    redirect(uri_string());
                }
                else if($result==-1)
                {
                    $this->session->set_flashdata('error','User Not Found');
                    redirect(site_url('lens_user'));
                }
                else
                {
                    $this->session->set_flashdata('message','User Added Successfully');
                    redirect(uri_string());
                }
            }
            else
            {
                $this->session->set_flashdata('error',validation_errors());
                redirect(uri_string());
            }

        }

        else{

            $result=$this->Lens_model->get_lens_user_by_id($user_id);
            if(sizeof($result)<0){
                $this->session->set_flashdata('error','User Not Found');
                redirect(site_url('lens_user'));
            }
            else
            {
                $data['lens_user']=$result;
                if($result['lens_user_country_id']!=''){
                    $data['regions']=$this->Lens_model->get_all_states_by_country_id($result['lens_user_country_id']);
                }
                if($result['lens_user_state_id']!=''){
                    $data['cities']=$this->Lens_model->get_all_cities_by_states_id($result['lens_user_state_id']);
                }
            }

            $data ['title'] = "Lens";
            $data ['content'] = 'lens/edit_lens_user';
            $data['countries']=$this->Lens_model->get_all_country();
            $data['lens_types']=$this->Lens_model->get_all_lens_type();
            $this->load->vars($data);
            $this->load->view('admin_layout/admin_main_layout');
        }
    }

}