<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Account_management_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->load->model('Common_model');
    }

    public function check_is_password_valid()
    {

//        $pass_hash_value=$this->Common_model->create_hash($this->input->post('user_password'));
//        print_r($pass_hash_value);die();
        $this->db->where('ref_admin_panel_login_app_info_id',$this->session->userdata('login_app_id'));
        $result_obj=$this->db->get('admin_panel_login');
        $result=$result_obj->row_array();
        $is_password_match=$this->Common_model->is_password_match($this->input->post('user_password'),$result['admin_panel_login_password_value']);
        return $is_password_match;
    }

    public function get_app_admin_by_app_id()
    {
        $this->db->where('ref_representative_app_info_id',$this->session->userdata('login_app_id'));
        $result=$this->db->get('representative');
        return $result->row_array();
    }

    public function update_app_user_info()
    {
        $this->db->trans_start();
        $user_info_array=array(
            'representative_first_name'=>$this->input->post('update_user_first_name'),
            'representative_last_name'=>$this->input->post('update_user_last_name'),
            'representative_contact_number'=>$this->input->post('update_user_phone'),
            'representative_email_address'=>$this->input->post('update_user_email')
        );
        $this->db->where('ref_representative_app_info_id',$this->session->userdata('login_app_id'));
        $result=$this->db->get('representative');
        $result=$result->result_array();
        if(sizeof($result)>0)
        {
            $this->db->where('ref_representative_app_info_id',$this->session->userdata('login_app_id'));
            $this->db->update('representative',$user_info_array);
        }
        else
        {
            $user_info_array['ref_representative_app_info_id']=$this->session->userdata('login_app_id');
            $this->db->insert('representative',$user_info_array);
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

    public function update_app_user_password()
    {
        $pass_hash_value=$this->Common_model->create_hash($this->input->post('user_new_password'));
        $user_pass_array=array(
            'admin_panel_login_password_value'=>$pass_hash_value,
        );
        $this->db->trans_start();
        $this->db->where('ref_admin_panel_login_app_info_id',$this->session->userdata('login_app_id'));
        $this->db->update('admin_panel_login',$user_pass_array);
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