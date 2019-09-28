<?php defined('BASEPATH') OR exit ('No direct script acces allowed');

Class Agent_app_model extends CI_Model
{


    function __construct()
    {
        $this->load->database();
        $this->load->model('Agent_common_model');
    }

    function encode_app_modules($module){

        $modules_string='';
        $flag=0;
        foreach ($module AS $item)
        {
            if($flag==0)
            {
                $modules_string=$item;
                $flag=1;
            }
            else{
                $modules_string=$modules_string.','.$item;
            }

        }
        return $modules_string;
    }

    public function get_app_user_by_app_user_name($app_user_name)
    {
        $this->db->where('admin_panel_login_username',$app_user_name);
        $result=$this->db->get('admin_panel_login');
        return $result->row_array();
    }


    public function get_all_module()
    {
        $this->db->where('app_modules_active',1);
        $result=$this->db->get('app_modules');
        return $result->result_array();
    }


    public function add_app()
    {
        $this->db->trans_start();

        $app_modules=$this->encode_app_modules($_POST['modules']);
        $app_info_array=array(
            'app_info_unique_id'=>md5(date('d F Y h:i:sa')),
            'app_info_name'=>$this->input->post('app_name'),
            'app_info_description'=>$this->input->post('app_description'),
            'ref_app_info_version_id'=>4,
            'app_info_modules_id'=>$app_modules,
            'app_info_active'=>0,
            'app_info_created_date_time'=>date('d F Y h:i:sa'),
        );

        $this->db->insert('app_info',$app_info_array);
        $app_info_id=$this->db->insert_id();

        $app_details_array=array(
            'ref_app_details_app_info_id'=>$app_info_id,
            'ref_app_details_agent_login_id'=>$this->session->userdata('agent_login_id'),
            'app_details_app_name'=>$this->input->post('app_name'),
            'app_details_description'=>$this->input->post('app_description'),
            'app_details_available_expecting_date'=>$this->input->post('app_available_expecting_date'),
            'app_details_edited_date_time'=>date('d F Y h:i:fa'),
            'app_details_active'=>0
        );
        $this->db->insert('app_details',$app_details_array);
        $password_hash_value=$this->Agent_common_model->create_hash($this->input->post('app_user_name'));
        $app_login_info_array=array(
            'ref_admin_panel_login_app_info_id'=>$app_info_id,
            'admin_panel_login_username'=>$this->input->post('app_user_name'),
            'admin_panel_login_password_value'=>$password_hash_value,
            'admin_panel_login_active'=>0
        );
        $this->db->insert('admin_panel_login',$app_login_info_array);
        $app_admin_info=array(
            'ref_representative_app_info_id'=>$app_info_id
        );
        $this->db->insert('representative',$app_admin_info);
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

    public function get_all_app_request_from_agent()
    {
        $user_agent_id=$this->session->userdata('agent_login_id');
        $sql="SELECT * FROM app_info
INNER JOIN app_details ON app_info_id=ref_app_details_app_info_id
WHERE ref_app_details_agent_login_id=$user_agent_id AND app_info_active<>-1 ORDER  BY app_info_id DESC";
        $result=$this->db->query($sql);
        return $result->result_array();
    }

    public function check_app_editable_or_not($app_id)
    {

        $this->db->where('ref_app_details_agent_login_id',$this->session->userdata('agent_login_id'));
        $this->db->where('app_details_android_uploading_date_time',NULL);
        $this->db->where('app_details_ios_uploading_date_time',NULL);
        $this->db->where('ref_app_details_app_info_id',$app_id);
        $result=$this->db->get('app_details');
        return $result->result_array();

    }

    public function get_app_user_by_app_user_name_and_id($user_name,$app_id)
    {
        $this->db->where('admin_panel_login_username',$user_name);
        $this->db->where('ref_admin_panel_login_app_info_id<>',$app_id);
        $result=$this->db->get('admin_panel_login');
        return $result->row_array();
    }


    public function delete_app_by_id($app_id)
    {

        $result=$this->check_app_editable_or_not($app_id);
        if(sizeof($result)<=0)
        {
            return -1;
        }
        else
        {
            $this->db->trans_start();
            $app_info_array=array(
                'app_info_active'=>-1
            );
            $this->db->where('app_info_id',$app_id);
            $this->db->update('app_info',$app_info_array);
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

    public function get_app_by_app_info_id($app_info_id)
    {
        $agent_id=$this->session->userdata('agent_login_id');
        $sql="SELECT * FROM app_info
LEFT JOIN app_details ON ref_app_details_app_info_id=app_info_id
LEFT JOIN admin_panel_login ON ref_admin_panel_login_app_info_id=app_info_id
LEFT JOIN app_modules on (find_in_set(app_modules_id,app_info_modules_id)>0) where app_info_id=$app_info_id AND ref_app_details_agent_login_id=$agent_id AND app_info_active=0";
        $result=$this->db->query($sql);
        return $result->result_array();
    }

    public function update_app_by_id($app_info_id)
    {
        $result=$this->check_app_editable_or_not($app_info_id);
        if(sizeof($result)<=0)
        {
            return -1;
        }
        else
        {
            $this->db->trans_start();

            $app_modules=$this->encode_app_modules($_POST['modules']);
            $app_info_array=array(
                'app_info_name'=>$this->input->post('app_name'),
                'app_info_description'=>$this->input->post('app_description'),
                'ref_app_info_version_id'=>4,
                'app_info_modules_id'=>$app_modules,
                'app_info_active'=>0,
                'app_info_created_date_time'=>date('d F Y h:i:sa'),
            );

            $this->db->where('app_info_id',$app_info_id);
            $this->db->update('app_info',$app_info_array);

            $app_details_array=array(
                'ref_app_details_agent_login_id'=>$this->session->userdata('agent_login_id'),
                'app_details_app_name'=>$this->input->post('app_name'),
                'app_details_description'=>$this->input->post('app_description'),
                'app_details_available_expecting_date'=>$this->input->post('app_available_expecting_date'),
                'app_details_edited_date_time'=>date('d F Y h:i:fa'),
                'app_details_active'=>0
            );
            $this->db->where('ref_app_details_app_info_id',$app_info_id);
            $this->db->update('app_details',$app_details_array);
            $password_hash_value=$this->Agent_common_model->create_hash($this->input->post('app_user_name'));
            $app_login_info_array=array(
                'admin_panel_login_username'=>$this->input->post('app_user_name'),
                'admin_panel_login_password_value'=>$password_hash_value,
                'admin_panel_login_active'=>0
            );
            $this->db->where('ref_admin_panel_login_app_info_id',$app_info_id);
            $this->db->update('admin_panel_login',$app_login_info_array);
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