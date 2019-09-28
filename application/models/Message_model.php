<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Message_model extends CI_Model
{

    function __construct()
    {
        $this->load->database();
    }

    public function add_message()
    {
        $this->db->trans_start();


        $message_info = array
        (
            'message_title' => $this->input->post('message_title'),
            'message_details' => $this->input->post('message_description'),
            'ref_message_target_type_id' => isset($_POST['general_confirm']) ? 1 : 2,
            'ref_message_app_info_id' => $this->session->userdata('login_app_id'),
            'message_is_push_notification' => isset($_POST['push_notification']) != null ? 1 : 0,
            'message_active' => 1

        );


        $this->db->insert('message', $message_info);

        if (isset($_POST['target_confirm'])) {

            $message_id = $this->db->insert_id();


            $age_start=NULL;
            $age_end=NULL;
            if(isset($_POST['select_age_lmit']))
            {
                $age_range = $this->input->post('select_age_lmit');
                $separate_value = (explode("-", $age_range));

                $age_start=$separate_value[0];
                $age_end=$separate_value[1];
            }

//            print_r($_POST);die();
            $message_condition_info = array
            (

                'ref_message_conditions_message_id' => $message_id,
                'is_condition_gender' => (isset($_POST['gender'])&& $this->input->post('gender')=='on') ? 1 : 0,
                'condition_gender' => (isset($_POST['men'])&&$_POST['men']=='on' && isset($_POST['women']) && $_POST['women']=='on') ? 4 : (isset($_POST['men']) && $_POST['men']=='on') ? 1 : (isset($_POST['women'])&&$_POST['women']=='on') ? 2 : 0,
                'is_condition_occupation' => (isset($_POST['select_occupation'])) ? 1 : 0,
                'condition_occupation_list_id' => (isset($_POST['select_occupation'])) ? $this->input->post('select_occupation') : NULL,
                'is_condition_city' => (isset($_POST['select_city'])) ? 1 : 0,
                'condition_cities_id' => (isset($_POST['select_city'])) ? $this->input->post('select_city') : NULL,
                'is_condition_birth_date' => (isset($_POST['choose_birthdate'])) ? 1 : 0,
                'condition_birth_date' => (isset($_POST['choose_birthdate'])) ? $this->input->post('choose_birthdate') : NULL,
                'is_condition_age_range' => (isset($_POST['select_age_lmit'])) ? 1 : 0,
                'condition_starting_age' => $age_start,
                'condition_ending_range' => $age_end,
                'is_condition_marital_status' => (isset($_POST['select_marital_status'])) ? 1 : 0,
                'condition_marital_status_id' => (isset($_POST['select_marital_status'])) ? $this->input->post('select_marital_status') : NULL,
                'match_all_conditions' => (isset($_POST['match_all_condition'])) ? 1 : 0,

            );

            $this->db->insert('message_conditions', $message_condition_info);

        }


        $this->db->trans_complete();
        if ($this->db->trans_status() == TRUE) {
            return 1;
        } else {
            return 0;
        }

    }


    public function is_condition_exist_by_message_id($message_id)
    {
        $this->db->where('ref_message_conditions_message_id',$message_id);
        $result=$this->db->get('message_conditions');
        return $result->result_array();
    }

    public function update_message_by_id($message_id)
    {

        $this->db->trans_start();


        $message_info = array
        (
            'message_title' => $this->input->post('message_title'),
            'message_details' => $this->input->post('message_description'),
            'ref_message_target_type_id' => isset($_POST['general_confirm']) ? 1 : 2,
            'ref_message_app_info_id' => $this->session->userdata('login_app_id'),
            'message_is_push_notification' => isset($_POST['push_notification']) != null ? 1 : 0,
            'message_active' => 1

        );


        $this->db->where('message_id', $message_id);
        $this->db->where('ref_message_app_info_id', $this->session->userdata('login_app_id'));
        $this->db->update('message', $message_info);

//        print_r($_POST);die();

        if (isset($_POST['target_confirm'])) {


            $age_start=NULL;
            $age_end=NULL;
            if(isset($_POST['select_age_lmit']))
            {
                $age_range = $this->input->post('select_age_lmit');
                $separate_value = (explode("-", $age_range));

                $age_start=$separate_value[0];
                $age_end=$separate_value[1];
            }

            $message_condition_info = array
            (

                'ref_message_conditions_message_id' => $message_id,
                'is_condition_gender' => (isset($_POST['gender'])) ? 1 : 0,
                'condition_gender' => (isset($_POST['men'])&&$_POST['men']=='on' && isset($_POST['women']) && $_POST['women']=='on') ? 4 : (isset($_POST['men']) && $_POST['men']=='on') ? 1 : (isset($_POST['women'])&&$_POST['women']=='on') ? 2 : 0,
                'is_condition_occupation' => (isset($_POST['occupation_id'])) ? 1 : 0,
                'condition_occupation_list_id' => (isset($_POST['occupation_id'])) ? $this->input->post('occupation_id') : NULL,
                'is_condition_city' => (isset($_POST['city_id'])) ? 1 : 0,
                'condition_cities_id' => (isset($_POST['city_id'])) ? $this->input->post('city_id') : NULL,
                'is_condition_birth_date' => (isset($_POST['birthday'])) ? 1 : 0,
                'condition_birth_date' => (isset($_POST['birthday'])) ? $this->input->post('birthday') : NULL,
                'is_condition_age_range' => (isset($_POST['select_age_lmit'])) ? 1 : 0,
                'condition_starting_age' => $age_start,
                'condition_ending_range' => $age_end,
                'is_condition_marital_status' => (isset($_POST['marital_status'])) ? 1 : 0,
                'condition_marital_status_id' => (isset($_POST['marital_status'])) ? $this->input->post('marital_status') : NULL,
                'match_all_conditions' => (isset($_POST['match_all_condition'])&&$_POST['match_all_condition']=='on') ? 1 : 0,

            );

//            print_r($message_condition_info);die();

            $result=$this->is_condition_exist_by_message_id($message_id);
            if(sizeof($result)<=0)
            {
                $message_condition_info['ref_message_conditions_message_id']=$message_id;
//                print_r($message_condition_info);die();
                $this->db->insert('message_conditions',$message_condition_info);

            }
            else
                {
                    $this->db->where('ref_message_conditions_message_id', $message_id);
//                    $this->db->where('ref_message_app_info_id', $this->session->userdata('login_app_id'));
                    $this->db->update('message_conditions', $message_condition_info);
            }



        }


        $this->db->trans_complete();
        if ($this->db->trans_status() == TRUE) {
            return 1;
        } else {
            return 0;
        }
    }

    public function get_target_type_name()
    {
        $this->db->where('target_type_active', 1);
        $result = $this->db->get('target_type');

        return $result->result_array();
    }

    public function get_all_message_list($starting_limit)
    {


        $app_id = $this->session->userdata('login_app_id');
        // $query = $this->db->get_where("message",array('ref_message_app_info_id' => $this->session->userdata('login_app_id'),'message_active'=>1));

        $sql = "SELECT * FROM message LEFT JOIN message_conditions ON ref_message_conditions_message_id = message_id
LEFT JOIN cities ON cities_id=condition_cities_id
LEFT JOIN marital_status ON marital_status_id=condition_marital_status_id
LEFT JOIN occupation_list ON occupation_list_id=condition_occupation_list_id
        WHERE message_active=1 AND  ref_message_app_info_id=$app_id order by message_id DESC LIMIT $starting_limit," . DEFAULT_DATA_LIMIT . "";


        $result = $this->db->query($sql);

        return $result->result_array();

    }

    public function check_message_exist_by_message_id($message_id)
    {
        $this->db->where('message_id', $message_id);
        $this->db->where('ref_message_app_info_id', $this->session->userdata('login_app_id'));
        $result = $this->db->get('message');
        return $result->result_array();

    }


    public function delete_message_by_message_id($message_id)
    {

        $result = $this->check_message_exist_by_message_id($message_id);
        if (sizeof($result) == 0) {
            return -1;
        } else {
            $this->db->trans_start();

            $message_array = array(
                'message_active' => 0,

            );

            $this->db->where('message_id', $message_id);
            $this->db->update('message', $message_array);

            $this->db->trans_complete();
            if ($this->db->trans_status() == TRUE) {
                return 1;
            } else return 0;
        }
    }

    public function get_message_data_by_id($message_id)
    {


        /*$this->db->where('message_id',$message_id);
        $this->db->where('ref_message_app_info_id',$this->session->userdata('login_app_id'));
        $result=$this->db->get('message');
        
        return $result->row_array();*/


//        $app_id = $this->session->userdata('login_app_id');
        $sql = "SELECT * from message LEFT JOIN message_conditions ON ref_message_conditions_message_id = message_id WHERE message_id = $message_id AND ref_message_app_info_id = " . $this->session->userdata('login_app_id') . " AND  message_active = 1";

        $result = $this->db->query($sql);
        return $result->row_array();
    }


    public function get_message_condition_data_by_id()
    {

        /*SELECT * from message LEFT JOIN message_conditions ON ref_message_conditions_message_id = message_id WHERE message_id = 9 */
    }

}