<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Lens_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_all_country(){
        $this->db->order_by('countries_name','ace');
        $result=$this->db->get('countries');

        return $result->result_array();
    }

    public function get_download_user_by_name($user_name){
        $app_id=$this->session->userdata('login_app_id');
        $sql="SELECT * FROM downloaded_user
WHERE downloaded_user_user_name LIKE '%$user_name%' AND ref_downloaded_user_app_info_id=$app_id AND downloaded_user_active=1";
        $result=$this->db->query($sql);
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

    public function get_all_lens_type()
    {
        $this->db->where('lense_type_active',1);
        $result=$this->db->get('lens_type');
        return $result->result_array();
    }
    public function add_lens_user(){
        $this->db->trans_start();

        $current_date_time=date('Y-m-d h:i:sa');
        $lens_user_info_array=array(
            'ref_lens_user_app_info_id'=>$this->session->userdata('login_app_id'),
            'ref_lens_user_downloaded_user_id'=>($this->input->post('user_id')=='')?NULL:$this->input->post('user_id'),
            'lens_user_first_name'=>$this->input->post('user_first_name'),
            'lens_user_last_name'=>$this->input->post('user_last_name'),
            'lens_user_birth_date'=>$this->input->post('user_dob'),
            'lens_user_country_id'=>($this->input->post('user_country')!='')?$this->input->post('user_country'):NULL,
            'lens_user_state_id'=>($this->input->post('user_region')!='')?$this->input->post('user_region'):NULL,
            'lens_user_city_id'=>($this->input->post('user_city')!='')?$this->input->post('user_city'):NULL,
            'lens_user_address'=>$this->input->post('user_address'),
            'lens_user_post_code'=>$this->input->post('user_post_code'),
            'lens_user_phone'=>$this->input->post('user_phone'),
            'lens_user_email'=>$this->input->post('user_mail'),
            'lens_user_left_name'=>$this->input->post('left_lens_name'),
            'lens_user_left_company'=>$this->input->post('left_company_name'),
            'ref_lens_user_left_lens_type_id'=>$this->input->post('left_lens_type'),
            'lens_user_left_sphere'=>$this->input->post('left_sphere_power_value'),
            'lens_user_left_cylinder'=>$this->input->post('left_cylinder_power_value'),
            'lens_user_left_axis'=>$this->input->post('left_axis'),
            'lens_user_left_addiction'=>$this->input->post('left_addiction'),
            'lens_user_left_diameter'=>$this->input->post('left_diameter'),
            'lens_user_left_duration_day'=>$this->input->post('left_lens_duration'),
            'lens_user_left_starting_date'=>$this->input->post('left_start_date'),
            'lens_user_left_inserting_date'=>$current_date_time,
            'lens_user_right_name'=>$this->input->post('right_lens_name'),
            'lens_user_right_company'=>$this->input->post('right_company_name'),
            'ref_lens_user_right_lens_type_id'=>$this->input->post('right_lens_type'),
            'lens_user_right_sphere'=>$this->input->post('right_sphere_power_value'),
            'lens_user_right_cylinder'=>$this->input->post('right_cylinder_power_value'),
            'lens_user_right_axis'=>$this->input->post('right_axis'),
            'lens_user_right_addiction'=>$this->input->post('right_addiction'),
            'lens_user_right_diameter'=>$this->input->post('right_diameter'),
            'lens_user_right_duration_day'=>$this->input->post('right_lens_duration'),
            'lens_user_right_starting_date'=>$this->input->post('right_start_date'),
            'lens_user_right_inserting_date'=>$current_date_time,
            'lens_user_active'=>1,
            'lens_user_last_edited_date_time'=>$current_date_time,

        );
        $this->db->insert('lens_user',$lens_user_info_array);
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
    public function get_all_lens_user_by_limit($starting_limit){

        $app_id=$this->session->userdata('login_app_id');
        $sql="SELECT lens_user.*,countries.*,states.*,cities.*,left_lens.lens_type_name AS left_lens_name,right_lens.lens_type_name AS right_lens_name   FROM lens_user
LEFT JOIN countries ON countries_id=lens_user_country_id
LEFT JOIN states ON states_id=lens_user_state_id
LEFT JOIN cities ON cities_id=lens_user_city_id
LEFT JOIN lens_type AS left_lens ON left_lens.lens_type_id=ref_lens_user_left_lens_type_id
LEFT JOIN lens_type AS right_lens ON right_lens.lens_type_id=ref_lens_user_right_lens_type_id
WHERE ref_lens_user_app_info_id=$app_id AND lens_user_active=1 order by lens_user_id DESC LIMIT $starting_limit,".DEFAULT_DATA_LIMIT."";

        $result=$this->db->query($sql);
        return $result->result_array();
    }

    public function get_lens_user_by_id($lens_user_id){
        $app_id=$this->session->userdata('login_app_id');
        $sql="SELECT * FROM lens_user
LEFT JOIN  downloaded_user ON downloaded_user_id=ref_lens_user_downloaded_user_id
 WHERE lens_user_id=$lens_user_id AND ref_lens_user_app_info_id=$app_id AND lens_user_active=1";
        $result=$this->db->query($sql);
        return $result->row_array();
    }

    public function update_lens_user_by_id($user_id){
        $result=$this->get_lens_user_by_id($user_id);
        if(sizeof($result)<=0)
        {
            return -1;
        }
        else
        {
            $this->db->trans_start();

            $current_date_time=date('Y-m-d h:i:sa');
            $lens_user_info_array=array(
                'ref_lens_user_downloaded_user_id'=>($this->input->post('user_id')=='')?NULL:$this->input->post('user_id'),
                'lens_user_first_name'=>$this->input->post('user_first_name'),
                'lens_user_last_name'=>$this->input->post('user_last_name'),
                'lens_user_birth_date'=>$this->input->post('user_dob'),
                'lens_user_country_id'=>($this->input->post('user_country')!='')?$this->input->post('user_country'):NULL,
                'lens_user_state_id'=>($this->input->post('user_region')!='')?$this->input->post('user_region'):NULL,
                'lens_user_city_id'=>($this->input->post('user_city')!='')?$this->input->post('user_city'):NULL,
                'lens_user_address'=>$this->input->post('user_address'),
                'lens_user_post_code'=>$this->input->post('user_post_code'),
                'lens_user_phone'=>$this->input->post('user_phone'),
                'lens_user_email'=>$this->input->post('user_mail'),
                'lens_user_left_name'=>$this->input->post('left_lens_name'),
                'lens_user_left_company'=>$this->input->post('left_company_name'),
                'ref_lens_user_left_lens_type_id'=>$this->input->post('left_lens_type'),
                'lens_user_left_sphere'=>$this->input->post('left_sphere_power_value'),
                'lens_user_left_cylinder'=>$this->input->post('left_cylinder_power_value'),
                'lens_user_left_axis'=>$this->input->post('left_axis'),
                'lens_user_left_addiction'=>$this->input->post('left_addiction'),
                'lens_user_left_diameter'=>$this->input->post('left_diameter'),
                'lens_user_left_duration_day'=>$this->input->post('left_lens_duration'),
                'lens_user_left_starting_date'=>$this->input->post('left_start_date'),
                'lens_user_left_inserting_date'=>$current_date_time,
                'lens_user_right_name'=>$this->input->post('right_lens_name'),
                'lens_user_right_company'=>$this->input->post('right_company_name'),
                'ref_lens_user_right_lens_type_id'=>$this->input->post('right_lens_type'),
                'lens_user_right_sphere'=>$this->input->post('right_sphere_power_value'),
                'lens_user_right_cylinder'=>$this->input->post('right_cylinder_power_value'),
                'lens_user_right_axis'=>$this->input->post('right_axis'),
                'lens_user_right_addiction'=>$this->input->post('right_addiction'),
                'lens_user_right_diameter'=>$this->input->post('right_diameter'),
                'lens_user_right_duration_day'=>$this->input->post('right_lens_duration'),
                'lens_user_right_starting_date'=>$this->input->post('right_start_date'),
                'lens_user_right_inserting_date'=>$current_date_time,
                'lens_user_active'=>1,
                'lens_user_last_edited_date_time'=>$current_date_time,

            );
            $this->db->where('lens_user_id',$user_id);
            $this->db->update('lens_user',$lens_user_info_array);
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