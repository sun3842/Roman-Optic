<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Order extends  CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('login')) {

            $this->load->model('Order_model');
            $this->load->model('Common_model');

            if ($this->session->userdata('language') && $this->session->userdata('language') == 'LANG_IT') {
                $this->lang->load('order_it_lang.php', 'italian');
                $this->lang->load('layout_it_lang', 'italian');
            } else {
                $this->lang->load('order_en_lang.php', 'english');
                $this->lang->load('layout_en_lang', 'english');

            }
        } else {

            redirect(site_url('login'));

        }
    }


    public function index()
    {

        echo "Access Denied";
    }

    public function new_order()
    {
        if(count($_POST)>0 && $this->input->post('add_order'))
        {
            $result=$this->Order_model->order_unique_id_is_valid($this->input->post('order_unique_id'));
            if(sizeof($result)>0)
            {
                $this->session->set_flashdata('error','Order Id Already Exist');
                redirect(uri_string());
            }
            $this->load->library('form_validation');
            $this->form_validation->set_rules('order_status','order_status','required');
            if($this->form_validation->run())
            {
                $result=$this->Order_model->add_order();
                if($result==1)
                {
                    $this->session->set_flashdata('message','Order Placed Successfully');
                    redirect(uri_string());
                }
                else
                {
                    $this->session->set_flashdata('error','Order Placed Fail');
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
            $data['title']='Product Tracking';
            $data['content']='order/add_order';
            $data['order_status']=$this->Order_model->get_all_order_status();
            $this->load->vars($data);
            $this->load->view('admin_layout/admin_main_layout');
        }

    }
    public function all_order()
    {
        if(count($_POST)>0 && $this->input->post('order_start_limit'))
        {
            $result=$this->Order_model->get_all_order_by_limit($this->input->post('order_start_limit'));
            echo json_encode($result,JSON_HEX_APOS);
        }
        else
        {
            $data['title']='Product Tracking';
            $data['content']='order/order_list';
            $data['orders']=$this->Order_model->get_all_order_by_limit(0);
            $data['order_status']=$this->Order_model->get_all_order_status();
            $this->load->vars($data);
            $this->load->view('admin_layout/admin_main_layout');
        }

    }

    public function is_order_id_exist()
    {
        $result=$this->Order_model->order_unique_id_is_valid($this->input->post('order_id'));
        if(sizeof($result)>0)
        {
            echo 'false';
        }
        else
        {
            echo 'true';
        }
    }
    public function update_order()
    {
//        print_r($_POST);die();
        $result=$this->Order_model->order_unique_id_is_editable($this->input->post('order_unique_id'),$this->input->post('order_id'));
        if(sizeof($result)>0)
        {
            $this->session->set_flashdata('error','Order Id Already Exist');
            redirect(site_url('order_list'));
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('order_status','order_status','required');
        if($this->form_validation->run())
        {
            $result=$this->Order_model->update_order();
            if($result==1)
            {
                $this->session->set_flashdata('message','Order Updated Successfully');
                redirect(site_url('order_list'));
            }
            else if($result==-1)
            {
                $this->session->set_flashdata('message','Order No Found');
                redirect(site_url('order_list'));
            }
            else
            {
                $this->session->set_flashdata('error','Order Updating Failed');
                redirect(site_url('order_list'));
            }
        }
        else
        {
            $this->session->set_flashdata('error',validation_errors());
            redirect(site_url('order_list'));
        }
    }
    public function is_order_unique_id_editable()
    {
        $order_data=explode('`!#$^(se[||<~`43>])^_%+/*-',$this->input->post('order_data'));
//        print_r($order_data);die();
        $result=$this->Order_model->order_unique_id_is_editable($order_data[0],$order_data[1]);
        if(sizeof($result)>0)
        {
           echo 'false';
        }
        else
        {
            echo 'true';
        }
    }
}