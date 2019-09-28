<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Events_model extends CI_Model
{

    function __construct()
    {
        $this->load->database();
    }


    public function get_all_country(){
        $this->db->order_by('countries_name','ace');
        $result=$this->db->get('countries');

        return $result->result_array();
    }

    public function get_all_states_by_country_id($country_id)
    {
        $this->db->where('states_country_id',$country_id);
        $result=$this->db->get('states');
        return $result->result_array();
    }
    public function get_all_cities_by_states_id($states_id){
        $this->db->where('cities_state_id',$states_id);
        $result=$this->db->get('cities');
        return $result->result_array();
    }


    public function add_event()
    {
        $this->db->trans_start();
        $event_array=array(
            'ref_events_app_info_id'=>$this->session->userdata('login_app_id'),
            'events_title'=>$this->input->post('event_name'),
            'events_details'=>$this->input->post('event_details'),
            'events_starting_date_time'=>($this->input->post('event_start_time')!="")?$this->input->post('event_start_time'):NULL,
            'events_ending_date_time'=>($this->input->post('event_end_time')!='')?$this->input->post('event_end_time'):NULL,
            'ref_events_country_id'=>($this->input->post('event_country')=='')?NULL:$this->input->post('event_country'),
            'ref_events_state_id'=>($this->input->post('event_region')=='')?NULL:$this->input->post('event_region'),
            'ref_events_city_id'=>($this->input->post('event_city')=='')?NULL:$this->input->post('event_city'),
            'events_location'=>$this->input->post('event_location'),
            'events_created_date_time'=>date('Y-m-d h:i:sa'),
            'events_active'=>1,

        );

        $this->db->insert('events',$event_array);
        $event_id=$this->db->insert_id();


        if (isset($_FILES['event_display_image']) && $_FILES['event_display_image']['error'] == 0 && $this->input->post('single_image_deleted_0')==0  ) {
            if (!is_dir('./all_images/event_images/app_id_' . $this->session->userdata('login_app_id'))) {
                mkdir('./all_images/event_images/app_id_' . $this->session->userdata('login_app_id'), 0777, true);
            }
            $this->load->library('upload');
            $file_name = explode('.', $_FILES["event_display_image"]["name"]);
            $file_extension_pos=sizeof($file_name);
            $file_extension =$file_name[$file_extension_pos-1];
            $temp_name = 'o_' . date('Y_m_d_h_i_s') .".". $file_extension;
            $config['upload_path'] = './all_images/event_images/app_id_' . $this->session->userdata('login_app_id');
            $config['allowed_types'] = "jpg|png|gif|jpeg";
            $config['file_name'] = $temp_name;
            $this->upload->initialize($config);
//            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('event_display_image')) {
                $error = array('error' => $this->upload->display_errors());
                print_r($error);
                die();
            } else {
                $event_image_array = array(
                    'ref_events_images_events_id' => $event_id,
                    'events_images_is_display_image'=>1,
                    'events_images_location' => 'all_images/event_images/app_id_' . $this->session->userdata('login_app_id'). '/' . $temp_name,
                    'events_images_size' => $_FILES['event_display_image']['size'],
                    'events_images_active' => 1,
                    'events_images_uploaded_date_time' => date('Y-m-d h:i:sa'),
                    'events_images_created_edited_date_time' => date('Y-m-d h:i:sa')
                );
                $this->db->insert('events_images', $event_image_array);
            }

        }

        if (isset($_FILES['event_more_image']) && sizeof($_FILES['event_more_image']['name'])>0 ) {
            $this->load->library('upload');
            $i=0;
            foreach ($_FILES['event_more_image']['name'] AS $event_image) {
                if($this->input->post('image_deleted_'.$i)==1 )
                { }
                else{
                    $_FILES["file_select_upload"]["name"] = $_FILES["event_more_image"]["name"][$i];
                    $_FILES["file_select_upload"]["type"] = $_FILES["event_more_image"]["type"][$i];
                    $_FILES["file_select_upload"]["tmp_name"] = $_FILES["event_more_image"]["tmp_name"][$i];
                    $_FILES["file_select_upload"]["error"] = $_FILES["event_more_image"]["error"][$i];
                    $_FILES["file_select_upload"]["size"] = $_FILES["event_more_image"]["size"][$i];
                    if($_FILES["file_select_upload"]["error"]==0){
                        if (!is_dir('./all_images/event_images/app_id_' . $this->session->userdata('login_app_id'))) {
                            mkdir('./all_images/event_images/app_id_' . $this->session->userdata('login_app_id'), 0777, true);
                        }
                        $file_name = explode('.', $_FILES['file_select_upload']["name"]);
//                $file_extension = end($file_name);
                        $file_extension_pos=sizeof($file_name);
                        $file_extension =$file_name[$file_extension_pos-1];
                        $temp_name = 'p_'. date('Y_m_d_h_i_s').$i.'.'.$file_extension;
                        $config['upload_path'] = './all_images/event_images/app_id_' . $this->session->userdata('login_app_id');
                        $config['allowed_types'] = "jpg|png|gif|jpeg";
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
                            $event_image_array = array(
                                'ref_events_images_events_id' => $event_id,
                                'events_images_is_display_image'=>0,
                                'events_images_location' => 'all_images/event_images/app_id_' . $this->session->userdata('login_app_id'). '/' . $temp_name,
                                'events_images_size' => $_FILES['file_select_upload']['size'],
                                'events_images_active' => 1,
                                'events_images_uploaded_date_time' => date('Y-m-d h:i:sa'),
                                'events_images_created_edited_date_time' => date('Y-m-d h:i:sa')
                            );
                            $this->db->insert('events_images', $event_image_array);
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

    public function get_events_by_limit($starting_limit)
    {
        $app_id=$this->session->userdata('login_app_id');

        $sql="SELECT * FROM events 
LEFT JOIN (SELECT * FROM events_images WHERE events_images_active=1 GROUP  BY (ref_events_images_events_id)) AS event_images ON event_images.ref_events_images_events_id=events_id
WHERE events_active=1 AND ref_events_app_info_id=$app_id ORDER  BY events_id DESC LIMIT $starting_limit,".DEFAULT_DATA_LIMIT."";
        $result=$this->db->query($sql);
        return $result->result_array();
    }

    public function check_event_exist_or_not($event_id){
        $this->db->where('ref_events_app_info_id',$this->session->userdata('login_app_id'));
        $this->db->where('events_active',1);
        $this->db->where('events_id',$event_id);
        $result=$this->db->get('events');
        return $result->result_array();

    }

    public function update_event_by_id($event_id)
    {
        $result=$this->check_event_exist_or_not($event_id);
        if(sizeof($result)<=0)
        {
            return -1;
        }
        $this->db->trans_start();
        $event_array=array(
            'events_title'=>$this->input->post('event_name'),
            'events_details'=>$this->input->post('event_details'),
            'events_starting_date_time'=>($this->input->post('event_start_time')!="")?$this->input->post('event_start_time'):NULL,
            'events_ending_date_time'=>($this->input->post('event_end_time')!='')?$this->input->post('event_end_time'):NULL,
            'ref_events_country_id'=>($this->input->post('event_country')=='')?NULL:$this->input->post('event_country'),
            'ref_events_state_id'=>($this->input->post('event_region')=='')?NULL:$this->input->post('event_region'),
            'ref_events_city_id'=>($this->input->post('event_city')=='')?NULL:$this->input->post('event_city'),
            'events_location'=>$this->input->post('event_location'),
            'events_active'=>1,

        );

        $this->db->where('events_id',$event_id);
        $this->db->update('events',$event_array);

        if (isset($_FILES['event_display_image']) && $_FILES['event_display_image']['error'] == 0 && $this->input->post('single_image_deleted_0')==0 ) {
            if (!is_dir('./all_images/event_images/app_id_' . $this->session->userdata('login_app_id'))) {
                mkdir('./all_images/event_images/app_id_' . $this->session->userdata('login_app_id'), 0777, true);
            }
            $this->load->library('upload');
            $file_name = explode('.', $_FILES["event_display_image"]["name"]);
            $file_extension_pos=sizeof($file_name);
            $file_extension =$file_name[$file_extension_pos-1];
            $temp_name = 'o_' . date('Y_m_d_h_i_s') .".". $file_extension;
            $config['upload_path'] = './all_images/event_images/app_id_' . $this->session->userdata('login_app_id');
            $config['allowed_types'] = "jpg|png|gif|jpeg";
            $config['file_name'] = $temp_name;
            $this->upload->initialize($config);
//            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('event_display_image')) {
                $error = array('error' => $this->upload->display_errors());
                print_r($error);
                die();
            } else {
                $event_image_array = array(
                    'ref_events_images_events_id' => $event_id,
                    'events_images_is_display_image'=>1,
                    'events_images_location' => 'all_images/event_images/app_id_' . $this->session->userdata('login_app_id'). '/' . $temp_name,
                    'events_images_size' => $_FILES['offer_display_image']['size'],
                    'events_images_active' => 1,
                    'events_images_uploaded_date_time' => date('Y-m-d h:i:sa'),
                    'events_images_created_edited_date_time' => date('Y-m-d h:i:sa')
                );
                $this->db->where('ref_events_images_events_id',$event_id);
                $this->db->where('events_images_active',1);
                $this->db->where('events_images_is_display_image',1);
                $result_obj=$this->db->get('events_images');
                $result=$result_obj->result_array();
                if(sizeof($result)<=0)
                {
                    $this->db->insert('events_images', $event_image_array);
                }
               else
               {
                   $this->db->where('events_images_id',$result[0]['events_images_id']);
                   $this->db->update('events_images',$event_image_array);
               }
            }

        }

        if (isset($_FILES['event_more_image']) && sizeof($_FILES['event_more_image']['name'])>0 ) {
            $this->load->library('upload');
            $i=0;
            foreach ($_FILES['event_more_image']['name'] AS $event_image) {
                if($this->input->post('image_deleted_'.$i)==1 )
                { }
                else{
                    $_FILES["file_select_upload"]["name"] = $_FILES["event_more_image"]["name"][$i];
                    $_FILES["file_select_upload"]["type"] = $_FILES["event_more_image"]["type"][$i];
                    $_FILES["file_select_upload"]["tmp_name"] = $_FILES["event_more_image"]["tmp_name"][$i];
                    $_FILES["file_select_upload"]["error"] = $_FILES["event_more_image"]["error"][$i];
                    $_FILES["file_select_upload"]["size"] = $_FILES["event_more_image"]["size"][$i];
                    if($_FILES["file_select_upload"]["error"]==0){
                        if (!is_dir('./all_images/event_images/app_id_' . $this->session->userdata('login_app_id'))) {
                            mkdir('./all_images/event_images/app_id_' . $this->session->userdata('login_app_id'), 0777, true);
                        }
                        $file_name = explode('.', $_FILES['file_select_upload']["name"]);
//                $file_extension = end($file_name);
                        $file_extension_pos=sizeof($file_name);
                        $file_extension =$file_name[$file_extension_pos-1];
                        $temp_name = 'p_'. date('Y_m_d_h_i_s').$i.'.'.$file_extension;
                        $config['upload_path'] = './all_images/event_images/app_id_' . $this->session->userdata('login_app_id');
                        $config['allowed_types'] = "jpg|png|gif|jpeg";
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
                            $event_image_array = array(
                                'ref_events_images_events_id' => $event_id,
                                'events_images_is_display_image'=>0,
                                'events_images_location' => 'all_images/event_images/app_id_' . $this->session->userdata('login_app_id'). '/' . $temp_name,
                                'events_images_size' => $_FILES['file_select_upload']['size'],
                                'events_images_active' => 1,
                                'events_images_uploaded_date_time' => date('Y-m-d h:i:sa'),
                                'events_images_created_edited_date_time' => date('Y-m-d h:i:sa')
                            );
                            $this->db->insert('events_images', $event_image_array);
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

    public function delete_event_by_id($event_id)
    {
        $result=$this->check_event_exist_or_not($event_id);
        if(sizeof($result)<=0)
        {
            return -1;
        }
        $this->db->trans_start();
        $event_array=array(
            'events_active'=>0
        );
        $this->db->where('events_id',$event_id);
        $this->db->update('events',$event_array);
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



    public function check_event_image_exist_or_not($image_id)
    {
        $app_id=$this->session->userdata('login_app_id');
            $sql="SELECT * FROM events_images
INNER JOIN events ON events_id=ref_events_images_events_id
WHERE events_images_id=$image_id  AND ref_events_app_info_id=$app_id  AND  events_images_active=1";
            $result=$this->db->query($sql);
            return $result->result_array();
    }

    public function delete_event_image_by_image_id($image_id)
    {
        $result=$this->check_event_image_exist_or_not($image_id);
        if(sizeof($result)<=0)
        {
            return -1;
        }
        $this->db->trans_start();
        $event_image_array=array(
            'events_images_active'=>0
        );
        $this->db->where('events_images_id',$image_id);
        $this->db->update('events_images',$event_image_array);
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

    public function get_event_by_id($event_id)
    {
        $app_id=$this->session->userdata('login_app_id');
       $sql="SELECT * FROM events 
LEFT JOIN (SELECT * FROM events_images WHERE events_images_active=1) AS event_images ON event_images.ref_events_images_events_id=events_id
LEFT JOIN countries ON countries_id=ref_events_country_id
LEFT JOIN states ON states_id=ref_events_state_id
LEFT JOIN cities ON cities_id=ref_events_city_id
WHERE events_active=1 AND ref_events_app_info_id=$app_id AND events_id=$event_id";
       $result=$this->db->query($sql);
       return $result->result_array();
    }


    public function get_all_ongoing_event()
    {
        $current_date=date('Y-m-d h:i:s');
        $app_id=$this->session->userdata('login_app_id');
        $sql="SELECT * FROM events 
LEFT JOIN (SELECT * FROM events_images WHERE events_images_active=1 GROUP  BY (ref_events_images_events_id)) AS event_images ON event_images.ref_events_images_events_id=events_id
WHERE events_active=1 AND ref_events_app_info_id=$app_id AND events_starting_date_time<='$current_date' AND events_ending_date_time>='$current_date' ORDER  BY events_id DESC";
        $result=$this->db->query($sql);
        return $result->result_array();
    }
    public function get_all_upcoming_event()
    {
        $current_date=date('Y-m-d h:i:sa');
        $app_id=$this->session->userdata('login_app_id');
        $sql="SELECT * FROM events 
LEFT JOIN (SELECT * FROM events_images WHERE events_images_active=1 GROUP  BY (ref_events_images_events_id)) AS event_images ON event_images.ref_events_images_events_id=events_id
WHERE events_active=1 AND ref_events_app_info_id=$app_id AND events_starting_date_time>'$current_date' ORDER  BY events_id DESC";
        $result=$this->db->query($sql);
        return $result->result_array();
    }


}