<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Offer extends  CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('login'))
        {
            $this->load->model('Offer_model');
            $this->load->model('Common_model');
            if ($this->session->userdata('language') && $this->session->userdata('language') == 'LANG_IT') {
                $this->lang->load('offer_it_lang', 'italian');
                $this->lang->load('layout_it_lang', 'italian');
            }
            else
            {
                $this->lang->load('offer_en_lang', 'english');
                $this->lang->load('layout_en_lang', 'english');

            }
        }
        else
        {
            redirect(site_url('login'));
        }
    }


    public function index(){
        echo 'No Path To Go';
    }

    public function new_offer(){
        if(count($_POST)>0 && $this->input->post('product'))
        {
               $result=$this->Offer_model->get_product_by_name($this->input->post('product'));
//               echo json_encode($result);
            echo json_encode($result,JSON_HEX_APOS);
        }
        else if(count($_POST)>0 && $this->input->post('offer_title')){
//            print_r($_POST);die();
            $this->load->library('form_validation');
            $this->form_validation->set_rules('offer_title','offer_title','required');
            $this->form_validation->set_rules('offer_description','offer_description','required');


            if($this->form_validation->run())
            {
                $result=$this->Offer_model->add_offer();
                if($result==1)
                {
                    $this->session->set_flashdata('message','Offer Added Successfully');
                    redirect(uri_string());
                }
                else
                {
                    $this->session->set_flashdata('error','Offer Added Failed');
                    redirect(uri_string());
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
            $data['title']="OFFER";
            $data['content']='offer/add_offer';
            $data['occupations']=$this->Common_model->get_all_occupation();
            $data['marital_status']=$this->Common_model->get_all_marital_status();
            $this->load->vars($data);
            $this->load->view('admin_layout/admin_main_layout');
            $this->load->view('offer/add_offer_js');
        }

    }

    public function offer_list(){
        if(count($_POST)>0 && $this->input->post('offer_start_limit'))
        {
            $result=$this->Offer_model->get_active_offer_list_by_limit($this->input->post('offer_start_limit'));
            $temp_result=$result;
            $temp=0;
            foreach ($result AS $offer)
            {
                $temp_result[$temp]['ref_offer_target_type_id']=($offer['ref_offer_target_type_id']==1)? 'General':(($offer['ref_offer_target_type_id']==2)? 'Target':'Personal');
                $temp_result[$temp]['offer_created_date_time']=date_format(new DateTime($offer['offer_created_date_time']),'d F Y');
                $temp_result[$temp]['offer_starting_date_time']=($offer['offer_starting_date_time']!='')?date_format(new DateTime($offer['offer_starting_date_time']),'d F Y'):'';
                $temp_result[$temp]['offer_ending_date_time']=($offer['offer_ending_date_time']!='')?date_format(new DateTime($offer['offer_ending_date_time']),'d F Y'):'';
                $temp++;
            }
            echo json_encode($temp_result,JSON_HEX_APOS);
        }
        else
        {
            $data['title']="OFFER";
            $data['content']='offer/all_offer';
            $data['offers']=$this->Offer_model->get_active_offer_list_by_limit(0);
            $this->load->vars($data);
            $this->load->view('admin_layout/admin_main_layout');
        }
    }

    public function de_active_offer_by_id($offer_id)
    {
        $result=$this->Offer_model->delete_offer_by_id($offer_id);
        if($result==1)
        {
            $this->session->set_flashdata('message','Offer Deleted Successfully');
            redirect(site_url('all_offer'));
        }
        else if($result==-1)
        {
            $this->session->set_flashdata('error','Offer NOT FOUND');
            redirect(site_url('all_offer'));
        }
        else
        {
            $this->session->set_flashdata('error','Offer Deleted Failed');
            redirect(site_url('all_offer'));

        }

    }


    public function update_offer_by_id($offer_id)
    {

        if(count($_POST)>0 && $this->input->post('offer_img'))
        {
            $result=$this->Offer_model->delete_offer_img_by_id($this->input->post('offer_img'));

//            echo json_encode($result);
            echo $result;
        }
        if(count($_POST)>0 && $this->input->post('offer_product'))
        {
            $result=$this->Offer_model->delete_offer_product_by_id($this->input->post('offer_product'));

            echo $result;
        }

        else if(count($_POST)>0 && $this->input->post('offer_title')){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('offer_title','offer_title','required');
            $this->form_validation->set_rules('offer_description','offer_description','required');
            if($this->form_validation->run())
            {
                $result=$this->Offer_model->update_offer($offer_id);
                if($result==1)
                {
                    $this->session->set_flashdata('message','Offer Update Successfully');
                    redirect(uri_string());
                }
                else if($result==0)
                {
                    $this->session->set_flashdata('error','Offer Updating Failed');
                    redirect(uri_string());
                }
                else if($result==-1)
                {
                    $this->session->set_flashdata('error','Offer Not Found');
                    redirect(uri_string());
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
            $result=$this->Common_model->get_all_marital_status();
            if(sizeof($result)<=0){
                $this->session->set_flashdata('error','Offer Not Found');
                redirect(site_url('all_offer'));
            }
            $data['title']="OFFER";
            $data['content']='offer/edit_offer';
            $data['cities']=$this->Common_model->get_all_city();
            $data['occupations']=$this->Common_model->get_all_occupation();
            $data['offer']=$this->Offer_model->get_offer_by_id($offer_id);
            $data['marital_status']=$result;
            $this->load->vars($data);
            $this->load->view('admin_layout/admin_main_layout');
            $this->load->view('offer/edit_offer_js');
        }

    }

    public function view_offer($offer_id){
        if(count($_POST)>0)
        {

        }
        else
        {
            $data['title']="OFFER";
            $data['content']='offer/offer_details';
            $data['offer']=$this->Offer_model->get_offer_by_id($offer_id);
            $this->load->vars($data);
            $this->load->view('admin_layout/admin_main_layout');
        }
    }

    public function get_all_city(){
        $result=$this->Common_model->get_all_city();
        echo json_encode($result,JSON_HEX_APOS);
    }
}