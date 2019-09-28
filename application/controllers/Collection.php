<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Collection extends  CI_Controller{
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('login')){
            $this->load->model('Collection_model');

            if ($this->session->userdata('language') && $this->session->userdata('language') == 'LANG_IT') {
                $this->lang->load('collection_it_lang', 'italian');
                $this->lang->load('layout_it_lang', 'italian');
            }
            else
            {
                $this->lang->load('collection_en_lang', 'english');
                $this->lang->load('layout_en_lang', 'english');

            }
        }
        else{
            redirect(site_url('login'));
        }
    }

    public function index(){
        echo 'NO PATH TO GO';
    }

    public function category_list(){
        if(count($_POST)>0 && $this->input->post('update_ctg_name')){
            $result=$this->Collection_model->check_category_name_exist(trim($this->input->post('update_ctg_name')),trim($this->input->post('update_ctg_id')));
            if(sizeof($result)>0){
                echo 'false';
            }
            else{
                echo 'true';
            }
        }
        else if(count($_POST)>0 && $this->input->post('text_update_category_name') && $this->input->post('text_update_category_id')){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('text_update_category_name','text_update_category_name','required');
            if($this->form_validation->run()){
                $result=$this->Collection_model->check_category_name_exist($this->input->post('text_update_category_name'),$this->input->post('text_update_category_id'));
                if(sizeof($result)>0){
                    $this->session->set_flashdata("error",'Category Name Already Exist');
                    redirect(uri_string());
                }
                else{
                    $result=$this->Collection_model->check_category_id_exist($this->input->post('text_update_category_id'));
                    if(sizeof($result)<=0){
                        $this->session->set_flashdata("error","Category You are trying to update does't exist");
                        redirect(uri_string());
                    }
                    else{
                        $result=$this->Collection_model->update_category_name($this->input->post('text_update_category_name'),$this->input->post('text_update_category_id'));
                        if($result==1){
                            $this->session->set_flashdata("message","Category Updated Successfully");
                            redirect(uri_string());
                        }
                        else{
                            $this->session->set_flashdata("error","Category Updating Failed");
                            redirect(uri_string());
                        }
                    }
                }
            }
            else{
                $this->session->set_flashdata("error",validation_errors());
                redirect(uri_string());
            }

        }
        else{
            $data['title']="CATEGORY";
            $data['content']='collection/all_category';
            $data['categories']=$this->Collection_model->get_all_active_categories();
            $this->load->vars($data);
            $this->load->view('admin_layout/admin_main_layout');
        }
    }






    public function new_category(){
        if(count($_POST)>0 && $this->input->post('new_category_name')){
            $result=$this->Collection_model->check_category_name_addable($this->input->post('new_category_name'));
            if($this->input->post('new_category_name')==''){
                echo -1;
            }
            else if(sizeof($result)>0){
                echo -1;    //---------------------if category name already exist----------------------------------------
            }
            else{
                $result=$this->Collection_model->add_category_name($this->input->post('new_category_name'));
                echo $result;
            }

        }

        else if(count($_POST)>0 && $this->input->post('category_id')){
            $result=$this->Collection_model->get_all_active_subcategories_by_categories_id($this->input->post('category_id'));
            echo json_encode($result,JSON_HEX_APOS);
        }

        else if(count($_POST)>0 && $this->input->post('new_sub_category_name') && $this->input->post('category')){
            $result=$this->Collection_model->check_subcategory_name_exist_by_category_id($this->input->post('new_sub_category_name'),$this->input->post('category'));
            if($this->input->post('new_sub_category_name')==''){
                echo -1;
            }
            else if(sizeof($result)>0){
                echo -1;    //---------------------if subcategory name already exist----------------------------------------
            }
            else{
                $result=$this->Collection_model->add_subcategory_name_by_category_id($this->input->post('category'),$this->input->post('new_sub_category_name'));
                echo $result;
            }

        }
        else{
            $data['title']="CATEGORY";
            $data['content']='collection/add_category';
            $data['active_categories']=$this->Collection_model->get_all_active_categories();
            $this->load->vars($data);
            $this->load->view('admin_layout/admin_main_layout');
            $this->load->view('collection/add_category_js');
        }
    }




    public function subcategory_list_by_ctg_id($category_id){
        if(count($_POST)>0 && $this->input->post('update_subctg_name')){

            $result=$this->Collection_model->check_subcategory_name_exist_by_category_id_subcategory_id($this->input->post('update_subctg_name'),$this->input->post('update_ctg_id'),$this->input->post('update_subctg_id'));
            if(sizeof($result)>0){
                echo 'false';
            }
            else{
                echo 'true';
            }

        }
        else if(count($_POST)>0 && $this->input->post('text_update_subcategory_name') && $this->input->post('text_update_subcategory_id') && $this->input->post('text_update_category_id')){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('text_update_subcategory_name','text_update_subcategory_name','required');
            if($this->form_validation->run()){
                $result=$this->Collection_model->check_subcategory_name_exist_by_category_id_subcategory_id($this->input->post('text_update_subcategory_name'),$this->input->post('text_update_category_id'),$this->input->post('text_update_subcategory_id'));
                if(sizeof($result)>0){
                    $this->session->set_flashdata("error","Subcategory Already Exist");
                    redirect(uri_string());
                }
                else{
                    $result=$this->Collection_model->update_subcategory_name($this->input->post('text_update_subcategory_name'),$this->input->post('text_update_subcategory_id'));
                    if($result==-1){
                        $this->session->set_flashdata("error","Subcategory Not Exist");
                        redirect(uri_string());
                    }
                    else if($result==0){
                        $this->session->set_flashdata("error","Subcategory Updating Failed");
                        redirect(uri_string());
                    }
                    else{
                        $this->session->set_flashdata("message","Subcategory Updated Successfully");
                        redirect(uri_string());
                    }
                }
            }
            else{
                $this->session->set_flashdata("error",validation_errors());
                redirect(uri_string());
            }

        }
        else{
            $data['title']="CATEGORY";
            $data['content']='collection/all_subcategory';
            $data['active_subcategories']=$this->Collection_model->get_all_active_subcategories_by_categories_id($category_id);
            $this->load->vars($data);
            $this->load->view('admin_layout/admin_main_layout');
//            $this->load->view('collection/add_category_js');
        }
    }


    public function de_active_category(){
        $category=$this->input->post('delete_category');
        $result=$this->Collection_model->delete_category_id($category);
        if($result==-1){
            $this->session->set_flashdata("error","Category Not Found");
            redirect(base_url('all_category'));
        }
        else if($result==1){
            $this->session->set_flashdata("message","Category removed Successfully");
            redirect(base_url('all_category'));
        }
        else if($result==0){
            $this->session->set_flashdata("message","Category removed Failed");
            redirect(base_url('all_category'));
        }
    }

    public function de_active_subcategory(){
//        print_r($_POST);die();
        $subcategory=$this->input->post('delete_subcategory');
        $result=$this->Collection_model->delete_subcategory_id($subcategory);
        if($result==-1){
            $this->session->set_flashdata("error","Subcategory Not Found");
            redirect(base_url('all_subcategory/'.$this->input->post('category_id')));
        }
        else if($result==1){
            $this->session->set_flashdata("message","Subcategory removed Successfully");
            redirect(base_url('all_subcategory/'.$this->input->post('category_id')));
        }
        else if($result==0){
            $this->session->set_flashdata("message","Subcategory removed Failed");
            redirect(base_url('all_subcategory/'.$this->input->post('category_id')));
        }
    }


    public function new_product(){
        if(count($_POST)>0 && $this->input->post('new_product_title')){
//                print_r($_FILES);die();
                $this->load->library('form_validation');
                $this->form_validation->set_rules('new_product_title','new_product_title','required');
            $this->form_validation->set_rules('p_fixed_price','p_fixed_price','numeric');
            $this->form_validation->set_rules('p_custom_price_from','p_custom_price_from','numeric');
            $this->form_validation->set_rules('p_custom_price_to','p_custom_price_to','numeric');
            $this->form_validation->set_rules('p_price_abs_reduce','p_price_abs_reduce','numeric');
            $this->form_validation->set_rules('p_price_percent_reduce','p_price_percent_reduce','numeric');
                if($this->form_validation->run()){
                    $result=$this->Collection_model->add_new_product();
                    if($result==1){
                        $this->session->set_flashdata('message','Product Added Successfully');
                        redirect(uri_string());
                    }
                    else{
                        $this->session->set_flashdata('error','Product Addition Failed');
                        redirect(uri_string());
                    }
                }
                else{
                    $this->session->set_flashdata('error',validation_errors());
                    redirect(uri_string());
                }
        }
        else if(count($_POST)>0 && $this->input->post('category_id')){
            $result=$this->Collection_model->get_all_active_subcategories_by_categories_id($this->input->post('category_id'));
            echo json_encode($result,JSON_HEX_APOS);
        }
        else{
            $data['title']="PRODUCT";
            $data['content']='collection/add_product';
            $data['categories']=$this->Collection_model->get_all_active_categories();
            $data['currencies']=$this->Collection_model->get_all_currency();
            $this->load->vars($data);
            $this->load->view('collection/add_product_css');
            $this->load->view('admin_layout/admin_main_layout');
            $this->load->view('collection/add_product_js');
        }
    }

    /*Function name:public function product_list()
    For showing product list and more products through jquery function*/
    public function product_list(){
        if(count($_POST)>0 && $this->input->post('starting_limit'))
        {
            $result=$this->Collection_model->get_active_product_list_by_limit($this->input->post('starting_limit'));
            echo  json_encode($result,JSON_HEX_APOS);
        }
        else
        {
            $data['title']="PRODUCT";
            $data['content']='collection/all_product';
            $data['products']=$this->Collection_model->get_active_product_list_by_limit(0);
            $this->load->vars($data);
//            $this->load->view('collection/add_product_css');
            $this->load->view('admin_layout/admin_main_layout');
            $this->load->view('collection/all_product_js');
        }
    }


    public function de_active_product_by_p_id($product_id){
        $result=$this->Collection_model->delete_product_by_product_id($product_id);
        if($result==0){
            $this->session->set_flashdata('error','Product Updating Failed');
            redirect(site_url('all_product'));
        }
        else if($result==-1){
            $this->session->set_flashdata('error','Product Not Found');
            redirect(site_url('all_product'));
        }
        else{
            $this->session->set_flashdata('message','Product Deleted');
            redirect(site_url('all_product'));
        }
    }

    public function update_product($product_id)
    {
        if(count($_POST)>0 && $this->input->post('delete_img_id'))
        {
            $result=$this->Collection_model->delete_product_img_by_id($this->input->post('delete_img_id'));
            echo $result;

        }
        else if(count($_POST)>0 && $this->input->post('new_product_title'))
        {
            $this->load->library("form_validation");
            $this->form_validation->set_rules('new_product_title','new_product_title','required');
            $this->form_validation->set_rules('p_fixed_price','p_fixed_price','numeric');
            $this->form_validation->set_rules('p_custom_price_from','p_custom_price_from','numeric');
            $this->form_validation->set_rules('p_custom_price_to','p_custom_price_to','numeric');
            $this->form_validation->set_rules('p_price_abs_reduce','p_price_abs_reduce','numeric');
            $this->form_validation->set_rules('p_price_percent_reduce','p_price_percent_reduce','numeric');
            if($this->form_validation->run())
            {
                $result=$this->Collection_model->update_product_information_by_product_id($product_id);
                if($result==-1)
                {
                    $this->session->set_flashdata('error','Product Not Found');
                    redirect(site_url('all_product'));
                }
                else if($result=0)
                {
                    $this->session->set_flashdata('error','Product Updating Failed');
                    redirect(uri_string());
                }
                else
                {
                    $this->session->set_flashdata('messages','Product Updated Successfully');
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
            $result=$this->Collection_model->get_product_by_id($product_id);
            if($result==-1)
            {
                $this->session->set_flashdata('error','Product Not Found');
                redirect(uri_string());
            }
            $data['title']='PRODUCT';
            $data['content']='collection/edit_product';
            $data['product_details']=$result;
            $data['categories']=$this->Collection_model->get_all_active_categories();
            $subcategories=NULL;
            if($result[0]['ref_product_category_id']!='')
            {
                $subcategories=$this->Collection_model->get_all_active_subcategories_by_categories_id($result[0]['ref_product_category_id']);
            }
            $data['subcategories']=$subcategories;
            $data['currencies']=$this->Collection_model->get_all_currency();
            $this->load->vars($data);
            $this->load->view('admin_layout/admin_main_layout');
            $this->load->view('collection/edit_product_js');
        }


    }


}