<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Gallery_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }


    public function add_photo_video()
    {
        if (isset($_FILES['videos_photos']) && sizeof($_FILES['videos_photos']['name'])>0) {
//            print_r($_POST);die();
            $this->db->trans_start();
            $this->load->library('upload');
            $i=0;
            foreach ($_FILES['videos_photos']['name'] AS $video_photo) {

                $_FILES["file_select_upload"]["name"] = $_FILES["videos_photos"]["name"][$i];
                $_FILES["file_select_upload"]["type"] = $_FILES["videos_photos"]["type"][$i];
                $_FILES["file_select_upload"]["tmp_name"] = $_FILES["videos_photos"]["tmp_name"][$i];
                $_FILES["file_select_upload"]["error"] = $_FILES["videos_photos"]["error"][$i];
                $_FILES["file_select_upload"]["size"] = $_FILES["videos_photos"]["size"][$i];
                if($_FILES["file_select_upload"]["error"]==0 && $this->input->post('single_image_deleted_'.$i)==0) {
                    if (!is_dir('./all_images/gallery/app_id_' . $this->session->userdata('login_app_id'))) {
                        mkdir('./all_images/gallery/app_id_' . $this->session->userdata('login_app_id'), 0777, true);
                    }

                    $file_type=explode('/',$_FILES['file_select_upload']["type"]);


                    $file_name = explode('.', $_FILES['file_select_upload']["name"]);
//                $file_extension = end($file_name);
                    $file_extension_pos=sizeof($file_name);
                    $file_extension =$file_name[$file_extension_pos-1];
                    $temp_name = 'g_'. date('Y_m_d_h_i_s').$i.'.'.$file_extension;
                    $config['upload_path'] = './all_images/gallery/app_id_' . $this->session->userdata('login_app_id');
                    $config['allowed_types'] = "jpg|png|gif|jpeg|mp4|mkv";
                    $config['file_name'] = $temp_name;
//                print_r($config);die();
                    $this->upload->initialize($config);
//                $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('file_select_upload')) {
                        $error = array('error' => $this->upload->display_errors());
                        print_r($error);
                        die();
                    }
                    else {
                        $photo_video_info_array = array(
                            'ref_image_app_info_id' => $this->session->userdata('login_app_id'),
                            'ref_image_album_id' => NULL,
                            'image_is_video'=>($file_type[0]=='video')?1:0,
                            'image_file_extension'=>$file_extension,
                            'image_file_size' => ($_FILES['file_select_upload']['size'] / 1000),
                            'image_file_location' => 'all_images/gallery/app_id_' . $this->session->userdata('login_app_id'). '/' . $temp_name,
                            'image_description'=>$_POST['image_description'][$i],
                            'image_uploaded_date_time'=>date('Y-m-d h:i:sa'),
                            'image_active' => 1,
                            'image_last_edited_date_time' => date('Y-m-d h:i:sa')
                        );
                        $this->db->insert('images', $photo_video_info_array);
                    }
                }

                $i++;
            }
            $this->db->trans_complete();
            if($this->db->trans_status()==TRUE)
            {
                return 1;
            }
            else
            {
               return 0;
            }
        }
        else
        {
            return 0;
        }
    }

    public function get_all_images_videos()
    {
        $this->db->where('ref_image_app_info_id',$this->session->userdata('login_app_id'));
        $this->db->where('ref_image_album_id',NULL);
        $this->db->where('image_active',1);
        $result=$this->db->get('images');
        return $result->result_array();
    }

    public function check_img_exist_or_not_by_id($img_id)
    {
        $this->db->where('ref_image_app_info_id',$this->session->userdata('login_app_id'));
        $this->db->where('image_active',1);
        $this->db->where('images_id',$img_id);
        $result=$this->db->get('images');
        return $result->result_array();

    }

    public function delete_img_by_id($img_id)
    {

        $result=$this->check_img_exist_or_not_by_id($img_id);
        if(sizeof($result)<0)
        {
            return -1;
        }
        else
        {
            $this->db->trans_start();

            $img_info_array=array(
                'image_active'=>0,
            );
            $this->db->where('images_id',$img_id);
            $this->db->update('images',$img_info_array);
            $this->db->trans_complete();

            if($this->db->trans_status()==TRUE)
            {
                return 1;
            }
            else
            {
                return 0;
            }
        }

    }

    public function add_album()
    {
        if(sizeof($_FILES['videos_photos']['name'])<=0)
        {
            return 0;
        }
        $this->db->trans_start();
        $album_info_array=array(
            'ref_album_app_info_id'=>$this->session->userdata('login_app_id'),
            'album_name'=>$this->input->post('album_title'),
            'album_details'=>$this->input->post('album_details'),
            'album_active'=>1,
            'album_created_date_time'=>date('Y-m-d h:i:sa'),
            'album_last_edited_date_time'=>date('Y-m-d h:i:sa'),
        );

        $this->db->insert('album',$album_info_array);

        $album_id=$this->db->insert_id();
//        print_r($album_id);die();
        if (isset($_FILES['videos_photos']) && sizeof($_FILES['videos_photos']['name'])>0) {
            $this->load->library('upload');
            $i = 0;

            foreach ($_FILES['videos_photos']['name'] AS $video_photo) {
                if($this->input->post('single_image_deleted_'.$i)==0)
                {
                    $_FILES["file_select_upload"]["name"] = $_FILES["videos_photos"]["name"][$i];
                    $_FILES["file_select_upload"]["type"] = $_FILES["videos_photos"]["type"][$i];
                    $_FILES["file_select_upload"]["tmp_name"] = $_FILES["videos_photos"]["tmp_name"][$i];
                    $_FILES["file_select_upload"]["error"] = $_FILES["videos_photos"]["error"][$i];
                    $_FILES["file_select_upload"]["size"] = $_FILES["videos_photos"]["size"][$i];
                    if ($_FILES["file_select_upload"]["error"] == 0) {
                        if (!is_dir('./all_images/gallery/app_id_' . $this->session->userdata('login_app_id').'/'.$album_id)) {
                            mkdir('./all_images/gallery/app_id_' . $this->session->userdata('login_app_id').'/'.$album_id, 0777, true);
                        }

                        $file_type = explode('/', $_FILES['file_select_upload']["type"]);


                        $file_name = explode('.', $_FILES['file_select_upload']["name"]);
//                $file_extension = end($file_name);
                        $file_extension_pos = sizeof($file_name);
                        $file_extension = $file_name[$file_extension_pos - 1];
                        $temp_name = 'g_' . date('Y_m_d_h_i_s') . $i . '.' . $file_extension;
                        $config['upload_path'] = './all_images/gallery/app_id_' . $this->session->userdata('login_app_id').'/'.$album_id;
                        $config['allowed_types'] = "jpg|png|gif|jpeg|mp4|mkv";
                        $config['file_name'] = $temp_name;
//                print_r($config);die();
                        $this->upload->initialize($config);
//                $this->load->library('upload', $config);
                        if (!$this->upload->do_upload('file_select_upload')) {
                            $error = array('error' => $this->upload->display_errors());
                            print_r($error);
                            die();
                        } else {
                            $photo_video_info_array = array(
                                'ref_image_app_info_id' => $this->session->userdata('login_app_id'),
                                'ref_image_album_id' => $album_id,
                                'image_is_video' => ($file_type[0] == 'video') ? 1 : 0,
                                'image_file_extension' => $file_extension,
                                'image_file_size' => ($_FILES['file_select_upload']['size'] / 1000),
                                'image_file_location' => './all_images/gallery/app_id_' . $this->session->userdata('login_app_id').'/'.$album_id . '/' . $temp_name,
                                'image_description' => $_POST['image_description'][$i],
                                'image_uploaded_date_time' => date('Y-m-d h:i:sa'),
                                'image_active' => 1,
                                'image_last_edited_date_time' => date('Y-m-d h:i:sa')
                            );
                            $this->db->insert('images', $photo_video_info_array);
                        }
                    }
                }


                $i++;
            }


        }
        $this->db->trans_complete();
        if($this->db->trans_status()==TRUE)
        {
            return 1;
        }
        else
        {
            return 0;
        }

    }




    public function get_all_albums()
    {
//        $this->db->where('ref_album_app_info_id',$this->session->userdata('login_app_id'));
//        $this->db->where('album_active',1);
//
//        $result=$this->db->get('album');
        $app_id=$this->session->userdata('login_app_id');
        $sql="SELECT * FROM album
LEFT JOIN images ON album_id=ref_image_album_id
WHERE ref_album_app_info_id=$app_id AND album_active=1 AND image_active=1";
        $result=$this->db->query($sql);
        return $result->result_array();
    }

    public function check_album_exist_or_not_by_id($album_id){
        $this->db->where('ref_album_app_info_id',$this->session->userdata('login_app_id'));
        $this->db->where('album_active',1);
        $this->db->where('album_id',$album_id);

        $result=$this->db->get('album');
        return $result->result_array();
    }

    public function get_album_details_by_id($album_id)
    {
        $result=$this->check_album_exist_or_not_by_id($album_id);
        if(sizeof($result)<=0){
            return -1;
        }
        else
        {
            $app_id=$this->session->userdata('login_app_id');
            $sql="SELECT * FROM album
LEFT JOIN images ON album_id=ref_image_album_id
WHERE album_id=$album_id AND ref_album_app_info_id=$app_id AND album_active=1 AND image_active=1";
            $result=$this->db->query($sql);
            return $result->result_array();
        }
    }


    public function add_images_in_album($album_id){
        $result=$this->check_album_exist_or_not_by_id($album_id);
        if(sizeof($result)<=0){
            return -1;
        }
        else
        {
            if (isset($_FILES['videos_photos']) && sizeof($_FILES['videos_photos']['name'])>0) {
                $this->db->trans_start();
                $this->load->library('upload');
                $i=0;
                foreach ($_FILES['videos_photos']['name'] AS $video_photo) {
                    if($this->input->post('single_image_deleted_'.$i)==0) {
                        $_FILES["file_select_upload"]["name"] = $_FILES["videos_photos"]["name"][$i];
                        $_FILES["file_select_upload"]["type"] = $_FILES["videos_photos"]["type"][$i];
                        $_FILES["file_select_upload"]["tmp_name"] = $_FILES["videos_photos"]["tmp_name"][$i];
                        $_FILES["file_select_upload"]["error"] = $_FILES["videos_photos"]["error"][$i];
                        $_FILES["file_select_upload"]["size"] = $_FILES["videos_photos"]["size"][$i];
                        if ($_FILES["file_select_upload"]["error"] == 0) {
                            if (!is_dir('./all_images/gallery/app_id_' . $this->session->userdata('login_app_id'))) {
                                mkdir('./all_images/gallery/app_id_' . $this->session->userdata('login_app_id'), 0777, true);
                            }

                            $file_type = explode('/', $_FILES['file_select_upload']["type"]);


                            $file_name = explode('.', $_FILES['file_select_upload']["name"]);
//                $file_extension = end($file_name);
                            $file_extension_pos = sizeof($file_name);
                            $file_extension = $file_name[$file_extension_pos - 1];
                            $temp_name = 'g_' . date('Y_m_d_h_i_s') . $i . '.' . $file_extension;
                            $config['upload_path'] = './all_images/gallery/app_id_' . $this->session->userdata('login_app_id');
                            $config['allowed_types'] = "jpg|png|gif|jpeg|mp4|mkv";
                            $config['file_name'] = $temp_name;
//                print_r($config);die();
                            $this->upload->initialize($config);
//                $this->load->library('upload', $config);
                            if (!$this->upload->do_upload('file_select_upload')) {
                                $error = array('error' => $this->upload->display_errors());
                                print_r($error);
                                die();
                            } else {
                                $photo_video_info_array = array(
                                    'ref_image_app_info_id' => $this->session->userdata('login_app_id'),
                                    'ref_image_album_id' => $album_id,
                                    'image_is_video' => ($file_type[0] == 'video') ? 1 : 0,
                                    'image_file_extension' => $file_extension,
                                    'image_file_size' => ($_FILES['file_select_upload']['size'] / 1000),
                                    'image_file_location' => 'all_images/gallery/app_id_' . $this->session->userdata('login_app_id') . '/' . $temp_name,
                                    'image_description' => $_POST['image_description'][$i],
                                    'image_uploaded_date_time' => date('Y-m-d h:i:sa'),
                                    'image_active' => 1,
                                    'image_last_edited_date_time' => date('Y-m-d h:i:sa')
                                );
                                $this->db->insert('images', $photo_video_info_array);
                            }
                        }
                    }
                    $i++;
                }
                $this->db->trans_complete();
                if($this->db->trans_status()==TRUE)
                {
                    return 1;
                }
                else
                {
                    return 0;
                }
            }
            else
            {
                return 0;
            }
        }
    }

    public function delete_album_by_id($album_id)
    {
        $result=$this->check_album_exist_or_not_by_id($album_id);
        if(sizeof($result)<=0){
            return -1;
        }
        else
        {
            $this->db->trans_start();
            $album_info_array=array(
                'album_active'=>0
            );
            $this->db->where('album_id',$album_id);
            $this->db->update('album',$album_info_array);

            $img_info_array=array(
                'image_active'=>0
            );
            $this->db->where('ref_image_album_id',$album_id);
            $this->db->update('images',$img_info_array);
            $this->db->trans_complete();
            if($this->db->trans_status()==TRUE)
            {
                return 1;
            }
            else
            {
                return 0;
            }
        }
    }
    public function update_album_by_id($album_id)
    {
        $result=$this->check_album_exist_or_not_by_id($album_id);
        if(sizeof($result)<=0){
            return -1;
        }
        else
        {
            $this->db->trans_start();
            $album_info_array=array(
                'album_name'=>$this->input->post('update_album_name'),
                'album_details'=>$this->input->post('update_album_details'),
            );
            $this->db->where('album_id',$album_id);
            $this->db->update('album',$album_info_array);

            $this->db->trans_complete();
            if($this->db->trans_status()==TRUE)
            {
                return 1;
            }
            else
            {
                return 0;
            }
        }
    }
    public function update_image_by_id($img_id){
        $result=$this->check_img_exist_or_not_by_id($img_id);
        if(sizeof($result)<0)
        {
            return -1;
        }
        else
        {
            $this->db->trans_start();

            $img_info_array=array(
                'image_description'=>$this->input->post('update_text_image_details'),
            );
            $this->db->where('images_id',$img_id);
            $this->db->update('images',$img_info_array);
            $this->db->trans_complete();

            if($this->db->trans_status()==TRUE)
            {
                return 1;
            }
            else
            {
                return 0;
            }
        }
    }
}