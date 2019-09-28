<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class News_model extends CI_Model
{
    function __construct()
    {
        $this->load->database();
    }

    public function add_news()
    {
        $this->db->trans_start();

        $news_info = array(

            'ref_news_app_info_id' => $this->session->userdata('login_app_id'),
            'news_title' => $this->input->post('news_title'),
            'news_details' => $this->input->post('news_description'),
            'news_active' => 1,
            'news_created_date_time' => date('Y-m-d h:i:sa'),
            'news_image_location' => isset($_FILES['news_image']) && $_FILES['news_image']['error'] == 0 ? $this->upload_news_image() : null

        );

        $this->db->insert('news',$news_info);


        $this->db->trans_complete();
        if($this->db->trans_status == true)
        {
            return 1;
        }

        else
        {
            return 0;
        }

    }

    public function upload_news_image()
    {
        if (!is_dir('./all_images/news_images/app_id_' . $this->session->userdata('login_app_id'))) {
            mkdir('./all_images/news_images/app_id_' . $this->session->userdata('login_app_id'), 0777, true);
        }


        $this->load->library('upload');
        $file_name = explode('.', $_FILES["news_image"]["name"]);
        $file_extension_pos=sizeof($file_name);
        $file_extension =$file_name[$file_extension_pos-1];
        $temp_name = 'n_' . date('Y_m_d_h_i_s') .".". $file_extension;
        $config['upload_path'] = 'all_images/news_images/app_id_' . $this->session->userdata('login_app_id');
        $config['allowed_types'] = "jpg|png|gif|jpeg";
        $config['file_name'] = $temp_name;
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('news_image'))

        {
            $error = array('error' => $this->upload->display_errors());


            return null;

        }

        else
        {

            return 'all_images/news_images/app_id_' . $this->session->userdata('login_app_id'). '/' . $temp_name;

        }

        return null;
    }

    public function get_all_news_list($starting_limit)
    {
        $app_id = $this->session->userdata('login_app_id');
        $sql = "SELECT *from news where ref_news_app_info_id = $app_id AND news_active = 1 ORDER  BY news_id DESC LIMIT $starting_limit," .DEFAULT_DATA_LIMIT."";

        $result = $this->db->query($sql);
        return $result->result_array();
    }

    public function check_news_exist_by_news_id($news_id)
    {
        $this->db->where('news_id',$news_id);
        $this->db->where('ref_news_app_info_id',$this->session->userdata('login_app_id'));
        $result=$this->db->get('news');
        return $result->result_array();
    }

    public function delete_News_by_news_id($news_id)
    {
        $result=$this->check_news_exist_by_news_id($news_id);
        if(sizeof($result)==0)
        {
            return -1;
        }

        else
        {
            $this->db->trans_start();

            $news_array = array(
                'news_active'=> 0,

            );

            $this->db->where('news_id', $news_id);
            $this->db->update('news', $news_array);

            $this->db->trans_complete();
            if ($this->db->trans_status() == TRUE) {
                return 1;
            }
            else return 0;
        }
    }

    public function get_news_data_by_id($news_id)
    {
        $app_id = $this->session->userdata('login_app_id');

        $sql = "SELECT *from news where ref_news_app_info_id = $app_id AND news_active = 1 AND news_id = $news_id ";

        $result = $this->db->query($sql);
        return $result->row_array();
    }

    public function update_news_by_id($news_id)
    {
        $this->db->trans_start();

        if($this->input->post('img_change')==0)
        {
            $news_info = array(
                'ref_news_app_info_id' => $this->session->userdata('login_app_id'),
                'news_title' => $this->input->post('news_title'),
                'news_details' => $this->input->post('news_description'),
                'news_active' => 1,
                'news_created_date_time' => date('Y-m-d h:i:sa'),

            );
        }
        else
        {
            $news_info = array(
                'ref_news_app_info_id' => $this->session->userdata('login_app_id'),
                'news_title' => $this->input->post('news_title'),
                'news_details' => $this->input->post('news_description'),
                'news_active' => 1,
                'news_created_date_time' => date('Y-m-d h:i:sa'),

            );
            if($this->input->post('image_change')==2)
            {
                $news_info['news_image_location']=NULL;
            }
            else
            {
                $this->upload_news_image();
                $news_info['news_image_location']=isset($_FILES['news_image']) && $_FILES['news_image']['error'] == 0 ? $this->upload_news_image() : null;
            }

        }

//        print_r($_FILES);
//        print_r($news_info);die();
        $this->db->where('news_id',$news_id);
        $this->db->where('ref_news_app_info_id',$this->session->userdata('login_app_id'));
        $this->db->update('news',$news_info );

        $this->db->trans_complete();
        if ($this->db->trans_status() == TRUE)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }
}