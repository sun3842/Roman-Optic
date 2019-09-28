<?php defined('BASEPATH') OR exit ('No direct script acces allowed');

Class Home_model extends CI_Model
{


    function __construct()
    {
        $this->load->database();
        $this->load->model('Common_model');
    }
    public function get_all_last_week_expiried_lenses()
    {
//        $current_date=date('Y-m-d');
//        $week = new DateTime($current_date.' + 7 day');
//        $week=$week->format('Y-m-d');
        $app_id=$this->session->userdata('login_app_id');
//        $sql="SELECT * FROM lens_user WHERE ((lens_user_left_duration_day>= $current_date AND lens_user_left_duration_day < $week)
//                               OR (lens_user_right_duration_day>= $current_date AND lens_user_right_duration_day < $week)) AND ref_lens_user_app_info_id=$app_id AND lens_user_active=1 ";
//        print_r($sql);die();
//        $sql="SELECT * FROM lens_user WHERE (lens_user_left_duration_day<= 7
//                               OR lens_user_right_duration_day<= 7) AND ref_lens_user_app_info_id=$app_id AND lens_user_active=1";
        $sql="SELECT * FROM (SELECT lens_user.*, DATE_ADD(lens_user_left_starting_date, INTERVAL lens_user_left_duration_day DAY) as left_EXPIRED_DATE,DATE_ADD(lens_user_right_starting_date, INTERVAL lens_user_right_duration_day DAY) as right_EXPIRED_DATE,left_lens_type.lens_type_name AS left_eye_lens_name,right_lens_type.lens_type_name AS right_eye_lens_name from lens_user
               INNER JOIN lens_type AS left_lens_type ON left_lens_type.lens_type_id=ref_lens_user_left_lens_type_id
               INNER JOIN lens_type AS right_lens_type ON right_lens_type.lens_type_id=ref_lens_user_right_lens_type_id
               WHERE lens_user_active=1 AND ref_lens_user_app_info_id=$app_id) AS lens_user_1 where (left_EXPIRED_DATE between CURDATE() and DATE_ADD(CURDATE(),INTERVAL 7 DAY)) OR (right_EXPIRED_DATE between CURDATE() and DATE_ADD(CURDATE(),INTERVAL 7 DAY))";
        $result=$this->db->query($sql);
        return $result->result_array();
    }
    public function get_all_download_list()
    {

        $sql="SELECT * FROM downloaded_user WHERE ref_downloaded_user_app_info_id=2 AND downloaded_user_active=1";
        $result=$this->db->query($sql);
        return $result->result_array();

    }
    public function get_all_feedback_list_7_days()
    {
        $current_date=date('Y-m-d h:i:s');
        $week = new DateTime($current_date.' - 7 day');
        $week=$week->format('Y-m-d h:i:s');
        $app_id=$this->session->userdata('login_app_id');
        $sql="SELECT * FROM feedback WHERE ref_feedback_app_info_id=$app_id AND feedback_giving_date_time>='$week'";
        $result=$this->db->query($sql);
        return $result->result_array();
    }
    public function get_all_chat_list_7_days()
    {
        $current_date=date('Y-m-d h:i:s');
        $week = new DateTime($current_date.' - 7 day');
        $week=$week->format('Y-m-d h:i:s');
        $app_id=$this->session->userdata('login_app_id');
        $sql="SELECT * FROM chat WHERE chat_sending_date_time>='$week' AND ref_chat_app_info_id=$app_id GROUP BY(ref_chat_downloaded_user_id)";
        $result=$this->db->query($sql);
        return $result->result_array();
    }



}