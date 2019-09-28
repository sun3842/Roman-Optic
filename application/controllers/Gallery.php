<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Gallery extends  CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (
            $this->session->userdata('login')) {
            $this->load->model('Gallery_model');


            if ($this->session->userdata('language') && $this->session->userdata('language') == 'LANG_IT') {
                $this->lang->load('gallery_it_lang', 'italian');
                $this->lang->load('layout_it_lang', 'italian');
            }
            else
            {
                $this->lang->load('gallery_en_lang', 'english');
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

    public function gallery_list()
    {
        if(count($_POST)>0 && $this->input->post('img_id'))
        {

            $result=$this->Gallery_model->delete_img_by_id($this->input->post('img_id'));

            echo $result;

        }
        else if(count($_POST)>0 && $this->input->post('album_id'))
        {
            $result=$this->Gallery_model->delete_album_by_id($this->input->post('album_id'));
            echo $result;
        }
        else if(count($_POST)>0 && $this->input->post('update_album_name'))
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('update_album_name','update_album_name','required');
            $this->form_validation->set_rules('update_album_id','update_album_id','required');
            if($this->form_validation->run())
            {
                $result=$this->Gallery_model->update_album_by_id($this->input->post('update_album_id'));
                if($result==1)
                {
                  $this->session->set_flashdata('message','Album Updated Successfully');
                  redirect(uri_string());
                }
                else if($result==-1)
                {
                    $this->session->set_flashdata('error','Album Not Found');
                    redirect(uri_string());
                }
                else if($result==0)
                {
                    $this->session->set_flashdata('error','Album Updating Failed');
                    redirect(uri_string());
                }
            }
            else

            {
                $this->session->set_flashdata('error',validation_errors());
                redirect(uri_string());
            }
        }
        else if(count($_POST)>0 && $this->input->post('update_text_image_details'))
        {
//            print_r($_POST);die();
            $this->load->library('form_validation');
//            $this->form_validation->set_rules('update_text_image_details','update_text_image_details','required');
            $this->form_validation->set_rules('update_img_id','update_img_id','required');
            if($this->form_validation->run())
            {

                $result=$this->Gallery_model->update_image_by_id($this->input->post('update_img_id'));
                if($result==1)
                {
                    $this->session->set_flashdata('message','Image Updated Successfully');
                    redirect(uri_string());
                }
                else if($result==-1)
                {
                    $this->session->set_flashdata('error','Image Not Found');
                    redirect(site_url());
                }
                else if($result==0)
                {
                    $this->session->set_flashdata('error','Image Updating Failed');
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

            $data['title']="GALLERY";
            $data['content']='gallery/all_gallery';
            $data['files']=$this->Gallery_model->get_all_images_videos();
            $data['albums']=$this->Gallery_model->get_all_albums();
            $this->load->vars($data);
            $this->load->view('admin_layout/admin_main_layout');
        }
    }

    public function new_album()
    {
        if(count($_POST)>0 && $this->input->post('album_title'))
        {
//            print_r($_FILES);
//            print_r($_POST);die();
            $this->load->library('form_validation');
            $this->form_validation->set_rules('album_title','album_title','required');
            if($this->form_validation->run())
            {
                $result=$this->Gallery_model->add_album();
                if($result==0)
                {
                    $this->session->set_flashdata('error','Album Addition Failed');
                    redirect(uri_string());
                }
                else if($result==1)
                {
                    $this->session->set_flashdata('message','Album Added Successfully');
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
            $data['title']="GALLERY";
            $data['content']='gallery/create_album';
            $this->load->vars($data);
            $this->load->view('admin_layout/admin_main_layout');
        }
    }

    public function new_photo_video()
    {
        if(count($_POST)>0)
        {
//                print_r($_POST);
//                print_r($_FILES);die();
            $result=$this->Gallery_model->add_photo_video();
            if($result==1)
            {
                $this->session->set_flashdata('message','Photos AND Videos Uploaded Successfully');
                redirect(site_url('all_gallery'));
            }
            else if($result==0)
            {
                $this->session->set_flashdata('error','Photos AND Videos Uploading Failed');
                redirect(site_url('all_gallery'));
            }

        }
        else
        {
            $data['title']="GALLERY";
            $data['content']='gallery/add_photo';
            $this->load->vars($data);
            $this->load->view('admin_layout/admin_main_layout');
        }
    }

    public function view_album_by_id($album_id){

        if(count($_POST)>0 && $this->input->post('update_text_image_details'))
        {
//        print_r($_POST);die();
            $this->load->library('form_validation');
//            $this->form_validation->set_rules('update_text_image_details','update_text_image_details','required');
            $this->form_validation->set_rules('update_img_id','update_img_id','required');
            if($this->form_validation->run())
            {

                $result=$this->Gallery_model->update_image_by_id($this->input->post('update_img_id'));
                if($result==1)
                {
                    $this->session->set_flashdata('message','Image Updated Successfully');
                    redirect(uri_string());
                }
                else if($result==-1)
                {
                    $this->session->set_flashdata('error','Image Not Found');
                    redirect(site_url());
                }
                else if($result==0)
                {
                    $this->session->set_flashdata('error','Image Updating Failed');
                    redirect(uri_string());
                }
            }
            else

            {
                $this->session->set_flashdata('error',validation_errors());
                redirect(uri_string());
            }
        }
        else if(count($_POST)>0)
        {
             $result=$this->Gallery_model->add_images_in_album($album_id);
            if($result==0)
            {
                $this->session->set_flashdata('error','Image Uploading Failed');
                redirect(uri_string());
            }
            else if($result==1)
            {
                $this->session->set_flashdata('message','Images/Videos Added Successfully');
                redirect(uri_string());
            }
            else if($result==-1)
            {
                $this->session->set_flashdata('error','ALBUM NOT FOUND');
                redirect(uri_string());
            }

        }

        else
        {
            $result=$this->Gallery_model->get_album_details_by_id($album_id);
            if($result==-1){
                $this->session->set_flashdata('error','ALBUM NOT FOUND');
                redirect(site_url('all_gallery'));
            }
            $data['title']="GALLERY";
            $data['content']='gallery/album_details';
            $data['album_details']=$result;
            $this->load->vars($data);
            $this->load->view('admin_layout/admin_main_layout');
        }
    }
}