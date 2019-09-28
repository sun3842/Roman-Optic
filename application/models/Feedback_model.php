<?php defined('BASEPATH') OR exit ('No direct script acces allowed');

Class Feedback_model extends CI_Model
{


    function __construct()
    {
        $this->load->database();
    }


    public function get_all_feedback()
    {
        $app_id = $this->session->userdata('login_app_id');

        $sql = "SELECT * FROM feedback
                LEFT JOIN downloaded_user ON downloaded_user_id=ref_feedback_downloaded_user_id
                WHERE ref_feedback_app_info_id=$app_id";
        $result = $this->db->query($sql);
        return $result->result_array();

    }

    public function feedback_count()

    {
        $app_id = $this->session->userdata('login_app_id');

        $sql = "SELECT * from feedback WHERE ref_feedback_app_info_id=$app_id";
        $result = $this->db->query($sql);
        return $result->result_array();

    }

    public function get_feedback_by_id($feedback_id)
    {
        $app_id = $this->session->userdata('login_app_id');

//        $sql = "SELECT * FROM feedback
//              LEFT JOIN feedback_reply ON feedback_id=ref_feedback_reply_feedback_id
//              LEFT JOIN downloaded_user ON downloaded_user_id=ref_feedback_reply_downloaded_user_id
//              WHERE ref_feedback_app_info_id=$app_id AND feedback_id = $feedback_id";
        $sql="SELECT feedback.*,feedback_reply.*,download_user.*,rep_download_user.downloaded_user_first_name AS rep_first_name,rep_download_user.downloaded_user_last_name AS rep_last_name,rat_feedback.* FROM feedback
LEFT JOIN feedback_reply ON (feedback_id=ref_feedback_reply_feedback_id)
LEFT JOIN downloaded_user AS download_user ON (download_user.downloaded_user_id=ref_feedback_downloaded_user_id)
LEFT JOIN downloaded_user AS rep_download_user ON (rep_download_user.downloaded_user_id=ref_feedback_reply_downloaded_user_id)
LEFT JOIN (SELECT ref_feedback_app_info_id as app_id,AVG(feedback_rating_score) AS avg_rat FROM feedback) AS rat_feedback ON rat_feedback.app_id=feedback.ref_feedback_app_info_id
WHERE ref_feedback_app_info_id=$app_id AND feedback_id=$feedback_id";

        $result = $this->db->query($sql);
        return $result->result_array();
    }

    public function check_feedback_id_exist($feedback_id)
    {
        $this->db->where('ref_feedback_reply_feedback_id', $feedback_id);
        $this->db->where('ref_feedback_reply_app_info_id', $this->session->userdata('login_app_id'));
        $result = $this->db->get('feedback_reply');
        return $result->result_array();
    }

    public function add_admin_reply_by_feedback_id()

    {
        $result = $this->check_feedback_id_exist($this->input->post('feedback_id'));
        if (sizeof($result) == 0) {
            return -1;
        } else {

            $this->db->trans_start();

            $admin_text_add = array(

                'feedback_reply_message' => $this->input->post('admn_reply'),
                'ref_feedback_reply_feedback_id' => $this->input->post('feedback_id'),
                'ref_feedback_reply_downloaded_user_id' => $this->input->post('downloaded_user_id'),
                'ref_feedback_reply_app_info_id' => $this->session->userdata('login_app_id'),
                'feedback_reply_from_downloaded_user' => 0,
                'feedback_reply_from_app_admin' => 1
            );

            $this->db->insert('feedback_reply', $admin_text_add);
            $this->db->trans_complete();

            $this->db->trans_complete();
            if ($this->db->trans_status() == TRUE) {
                return 1;
            } else {
                return 0;
            }

        }


    }

    public function update_status()

    {
        $this->db->trans_start();
        $feedback_id = $this->input->post('feedback_id');

        $feedback_status_update = array(

            'feedback_is_public' => $this->input->post('feedback_status')

        );

        $this->db->where('feedback_id', $feedback_id);
        $this->db->where('ref_feedback_app_info_id', $this->session->userdata('login_app_id'));
        $this->db->update('feedback', $feedback_status_update);

        $this->db->trans_complete();
        if ($this->db->trans_status() == TRUE) {
            return 1;
        } else {
            return 0;
        }

    }


}