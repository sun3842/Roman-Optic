<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        if ($this->session->userdata('login'))
        {
            $this->load->model('Events_model');
            $this->load->model('Common_model');

            if ($this->session->userdata('language') && $this->session->userdata('language') == 'LANG_IT') {
                $this->lang->load('events_it_lang', 'italian');
                $this->lang->load('layout_it_lang', 'italian');
            }
            else
            {
                $this->lang->load('events_en_lang', 'english');
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

	public function create_events(){

		if(count($_POST)>0 && $this->input->post('btn_add_event')){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('event_name','event_name','required');
            $this->form_validation->set_rules('event_details','event_details','required');
            if($this->form_validation->run())
            {
//                print_r($_FILES);die();
                $result=$this->Events_model->add_event();
                if($result==1)
                {
                    $this->session->set_flashdata('message','Event Added Successfully');
                    redirect(uri_string());
                }
                else
                {
                    $this->session->set_flashdata('error','Event addition Failed');
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

			$data ['title'] = "EVENTS";
			$data ['content'] = 'events/create_event';
            $data['countries']=$this->Events_model->get_all_country();
			$this->load->vars($data);
			$this->load->view('admin_layout/admin_main_layout');
            $this->load->view('events/create_event_js');
		}

	}

	public function all_event_list(){

		if(count($_POST)>0 && $this->input->post('event_starting_limit')){
		    $limit_start=$this->input->post('event_starting_limit');
		    if($limit_start==-1){
		        $limit_start=0;
            }

		    $result=$this->Events_model->get_events_by_limit($limit_start);
            $temp_result=$result;
            $counter=0;
            foreach ($result AS $item){
                $temp_result[$counter]['events_starting_date_time']=($item['events_starting_date_time']!='')?date_format(new DateTime($item['events_starting_date_time']),'d F Y'):'';
                $temp_result[$counter]['events_ending_date_time']=($item['events_ending_date_time']!='')?date_format(new DateTime($item['events_ending_date_time']),'d F Y'):'';
                $counter++;
            }
            echo  json_encode($temp_result,JSON_HEX_APOS);

		}

		else{

			$data ['title'] = "EVENTS";
			$data ['content'] = 'events/all_event_list';
			$data['events']=$this->Events_model->get_events_by_limit(0);
			$this->load->vars($data);
			$this->load->view('admin_layout/admin_main_layout');
		}

	}

	public function get_states_by_country_id()
    {
        $result=$this->Events_model->get_all_states_by_country_id($this->input->post('country'));
        echo json_encode($result,JSON_HEX_APOS);
    }
    public function get_cities_by_state_id()
    {
        $result=$this->Events_model->get_all_cities_by_states_id($this->input->post('state'));
        echo json_encode($result,JSON_HEX_APOS);
    }


    public function update_event_by_id($event_id){
	    if(count($_POST)>0 && $this->input->post('btn_edit_event')){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('event_name','event_name','required');
            $this->form_validation->set_rules('event_details','event_details','required');
            if($this->form_validation->run())
            {
//                print_r($_FILES);die();
                $result=$this->Events_model->update_event_by_id($event_id);
                if($result==1)
                {
                    $this->session->set_flashdata('message','Event Updated Successfully');
                    redirect(uri_string());
                }
                else if($result==-1)
                {
                    $this->session->set_flashdata('error','Event Not Found');
                    redirect(site_url(''));
                }
                else
                {
                    $this->session->set_flashdata('error','Event Updated Failed');
                    redirect(uri_string('all_event_list'));
                }

            }
            else
            {
                $this->session->set_flashdata('error',validation_errors());
                redirect(uri_string());
            }
        }
        else
        {
            $result=$this->Events_model->get_event_by_id($event_id);
            if(sizeof($result)<=0)
            {
                $this->session->set_flashdata('error','Event Not Found');
                redirect(site_url('all_event_list'));
            }
            $data ['title'] = "EVENTS";
            $data ['content'] = 'events/edit_event';
            $data['event']=$result;
            $data['countries']=$this->Events_model->get_all_country();
            $data['states']=$this->Events_model->get_all_states_by_country_id($result[0]['ref_events_country_id']);
            $data['cities']=$this->Events_model->get_all_cities_by_states_id($result[0]['ref_events_state_id']);
            $this->load->vars($data);
            $this->load->view('admin_layout/admin_main_layout');
            $this->load->view('events/edit_event_js');
        }
    }

    public function delete_event_image()
    {
        $result=$this->Events_model->delete_event_image_by_image_id($this->input->post('image_id'));
        echo $result;
    }

    public function delete_event_by_id($event_id)
    {
        $result=$this->Events_model->delete_event_by_id($event_id);
        if($result==1)
        {
            $this->session->set_flashdata('message','Event Deleted Successfully');
            redirect(site_url('all_event_list'));
        }
        else if($result==-1)
        {
            $this->session->set_flashdata('error','Event Not Found');
            redirect(site_url('all_event_list'));
        }
        else
        {
            $this->session->set_flashdata('error','Event Deletion Failed');
            redirect(site_url('all_event_list'));
        }


    }
    public function view_event_by_id($event_id)
    {
        $data ['title'] = "EVENTS";
        $data ['content'] = 'events/event_details';
        $data['event']=$this->Events_model->get_event_by_id($event_id);
        $this->load->vars($data);
        $this->load->view('admin_layout/admin_main_layout');
    }

    public function get_all_ongoing_upcoming_event()
    {
        $event_list_type=$this->input->post('event_type');
        if($event_list_type==1)
        {
            $result=$this->Events_model->get_all_ongoing_event();
            $temp_result=$result;
            $counter=0;
            foreach ($result AS $item){
                $temp_result[$counter]['events_starting_date_time']=($item['events_starting_date_time']!='')?date_format(new DateTime($item['events_starting_date_time']),'d F Y'):'';
                $temp_result[$counter]['events_ending_date_time']=($item['events_ending_date_time']!='')?date_format(new DateTime($item['events_ending_date_time']),'d F Y'):'';
                $counter++;
            }
            echo  json_encode($temp_result,JSON_HEX_APOS);
        }
        else if($event_list_type==2)
        {

            $result=$this->Events_model->get_all_upcoming_event();
            $temp_result=$result;
            $counter=0;
            foreach ($result AS $item){
                $temp_result[$counter]['events_starting_date_time']=($item['events_starting_date_time']!='')?date_format(new DateTime($item['events_starting_date_time']),'d F Y'):'';
                $temp_result[$counter]['events_ending_date_time']=($item['events_ending_date_time']!='')?date_format(new DateTime($item['events_ending_date_time']),'d F Y'):'';
                $counter++;
            }
            echo  json_encode($temp_result,JSON_HEX_APOS);

        }
    }
}