<?php if(!defined('BASEPATH')) exit ('No direct script allowed');

class Opticians_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }


    public function get_all_member_list()
    {
        $app_id = $this->session->userdata('login_app_id');

        $sql = "SELECT * FROM team_member LEFT JOIN branch ON (ref_team_member_branch_id = branch_id) 
                where team_member_active = 1 AND branch_active =1  AND ref_team_member_app_info_id = $app_id order by team_member_created_date_time";

        $result = $this->db->query($sql);
        return $result->result_array();

    }

    public function get_all_branch_names()
    {
        $this->db->where('branch_active',1);
        $this->db->where('ref_branch_app_info_id',$this->session->userdata('login_app_id'));
        $result = $this->db->get('branch');
        return $result->result_array();
    }

    public function add_opticians()

    {
        $this->db->trans_start();

        $image_info['image'] = $this->upload_optician_image();

        $add_opticians_info = array(

            'team_member_first_name' => $this->input->post('first_name'),
            'team_member_last_name' => $this->input->post('last_name'),
            'team_member_designation' => $this->input->post('designation'),
            'ref_team_member_branch_id' => $this->input->post('branch_name'),
            'ref_team_member_app_info_id' => $this->session->userdata('login_app_id'),
            'team_member_about_and_services' => $this->input->post('service_details'),
            'team_member_image_location' => isset($_FILES['optician_image']) && $_FILES['optician_image']['error'] == 0 ? $image_info['image']['path'] :null,
            'team_member_image_size' => isset($_FILES['optician_image']) && $_FILES['optician_image']['error'] == 0 ? $image_info['image']['size'] :null,
            'team_member_phone' => $this->input->post('phone_no'),
            'team_member_email' => $this->input->post('email'),
            'team_member_active' => 1,
            'team_member_created_date_time' => date('Y-m-d h:i:sa')

        );

        $this->db->insert('team_member',$add_opticians_info);


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

    public function upload_optician_image()
    {
        if (!is_dir('./all_images/opticians_images/app_id_' . $this->session->userdata('login_app_id'))) {
            mkdir('./all_images/opticians_images/app_id_' . $this->session->userdata('login_app_id'), 0777, true);
        }


        $this->load->library('upload');
        $file_name = explode('.', $_FILES["optician_image"]["name"]);
        $file_extension_pos=sizeof($file_name);
        $file_extension =$file_name[$file_extension_pos-1];
        $temp_name = 'o_' . date('Y_m_d_h_i_s') .".". $file_extension;
        $config['upload_path'] = 'all_images/opticians_images/app_id_' . $this->session->userdata('login_app_id');
        $config['allowed_types'] = "jpg|png|gif|jpeg";
        $config['file_name'] = $temp_name;
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('optician_image'))

        {
            $error = array('error' => $this->upload->display_errors());


            return null;

        }

        else
        {

            $path = 'all_images/opticians_images/app_id_' . $this->session->userdata('login_app_id'). '/' . $temp_name;
            $size = ($_FILES['optician_image']['size']);
            $image_details = array(

                'path' => $path,
                'size' => $size

            );

            return $image_details;

        }

        return null;

    }

    public function check_optician_exist_by_team_member_id($team_member_id)
    {
        $this->db->where('team_member_id',$team_member_id);
        $this->db->where('ref_team_member_app_info_id',$this->session->userdata('login_app_id'));
        $result=$this->db->get('team_member');
        return $result->result_array();
    }

    public function delete_optician_by_team_member_id($team_member_id)
    {
        $result=$this->check_optician_exist_by_team_member_id($team_member_id);
        if(sizeof($result)==0)
        {
            return -1;
        }

        else
        {
            $this->db->trans_start();

            $optician_array = array(
                'team_member_active'=> 0,

            );

            $this->db->where('team_member_id', $team_member_id);
            $this->db->update('team_member', $optician_array);

            $this->db->trans_complete();
            if ($this->db->trans_status() == TRUE) {
                return 1;
            }
            else return 0;
        }
    }

    public function get_optician_data_by_id($team_member_id)
    {
        /*$this->db->where('team_member_id',$team_member_id);
        $this->db->where('ref_team_member_app_info_id',$this->session->userdata('login_app_id'));
        $result=$this->db->get('team_member');*/

        $app_id = $this->session->userdata('login_app_id');

        $sql = "SELECT * FROM team_member LEFT JOIN branch ON (ref_team_member_branch_id = branch_id) 
                where team_member_id = $team_member_id AND team_member_active = 1 AND branch_active =1 AND ref_team_member_app_info_id = $app_id order by team_member_created_date_time DESC";

        $result = $this->db->query($sql);
        return $result->row_array();

    }

    public function update_optician_by_id($team_member_id)
    {
//        print_r($_POST);
//        print_r($_FILES);die();
        $this->db->trans_start();

        if($this->input->post('img_change')==0)
        {
            $optician_info = array(
                'team_member_first_name' => $this->input->post('first_name'),
                'team_member_last_name' => $this->input->post('last_name'),
                'team_member_designation' => $this->input->post('designation'),
                'ref_team_member_branch_id' => $this->input->post('branch_name'),
                'ref_team_member_app_info_id' => $this->session->userdata('login_app_id'),
                'team_member_about_and_services' => $this->input->post('service_details'),
                'team_member_phone' => $this->input->post('phone_no'),
                'team_member_email' => $this->input->post('email'),
                'team_member_active' => 1,
                'team_member_created_date_time' => date('Y-m-d h:i:sa')

            );
        }
        else
        {

            $optician_info = array(
                'team_member_first_name' => $this->input->post('first_name'),
                'team_member_last_name' => $this->input->post('last_name'),
                'team_member_designation' => $this->input->post('designation'),
                'ref_team_member_branch_id' => $this->input->post('branch_name'),
                'ref_team_member_app_info_id' => $this->session->userdata('login_app_id'),
                'team_member_about_and_services' => $this->input->post('service_details'),
                'team_member_phone' => $this->input->post('phone_no'),
                'team_member_email' => $this->input->post('email'),
                'team_member_active' => 1,
                'team_member_created_date_time' => date('Y-m-d h:i:sa')

            );
            if($this->input->post('image_change')==2)
            {
                $optician_info['team_member_image_location']=NULL;
                $optician_info['team_member_image_size']=0;
            }
            else
            {
                $image_info['image'] = $this->upload_optician_image();
                $optician_info['team_member_image_location']=isset($_FILES['optician_image']) && $_FILES['optician_image']['error'] == 0 ? $image_info['image']['path'] :null;
                $optician_info['team_member_image_size']=isset($_FILES['optician_image']) && $_FILES['optician_image']['error'] == 0 ? $image_info['image']['size'] :null;
            }
        }



        $this->db->where('team_member_id',$team_member_id);
        $this->db->where('ref_team_member_app_info_id',$this->session->userdata('login_app_id'));
        $this->db->update('team_member',$optician_info );

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