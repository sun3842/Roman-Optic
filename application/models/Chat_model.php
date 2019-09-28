<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Chat_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_chat_users_by_limit($starting_limit)
    {
        $app_id=$this->session->userdata('login_app_id');
        $sql="SELECT * FROM chat
 join (SELECT ref_chat_downloaded_user_id,max(chat_sending_date_time) as last_sending_date_time FROM chat GROUP BY(ref_chat_downloaded_user_id)) as max_chat ON(chat.ref_chat_downloaded_user_id=max_chat.ref_chat_downloaded_user_id AND chat.chat_sending_date_time=max_chat.last_sending_date_time)
  INNER JOIN 	downloaded_user ON 	downloaded_user_id=chat.ref_chat_downloaded_user_id
  WHERE ref_chat_app_info_id=$app_id ORDER BY chat.chat_sending_date_time DESC LIMIT $starting_limit,".DEFAULT_DATA_LIMIT."";
        $result=$this->db->query($sql);
        return $result->result_array();
    }

    public function get_all_chat_by_user_id($user_id){
        $app_id=$this->session->userdata('login_app_id');
        $sql="SELECT * FROM chat WHERE ref_chat_app_info_id=$app_id AND ref_chat_downloaded_user_id=$user_id";
        $result=$this->db->query($sql);
        return $result->result_array();
    }

    public function check_chat_user_exist_or_not($chat_user)
    {
        $this->db->where('downloaded_user_id',$chat_user);
        $this->db->where('ref_downloaded_user_app_info_id',$this->session->userdata('login_app_id'));
        $result=$this->db->get('downloaded_user');
        return $result->result_array();
    }

    public function add_new_chat_message()
    {
        $result=$this->check_chat_user_exist_or_not($this->input->post('chat_user'));
        if(sizeof($result)<=0)
        {
            return -1;
        }
        else
        {
            $this->db->trans_start();

            $chat_array=array(
                'ref_chat_app_info_id'=>$this->session->userdata('login_app_id'),
                'ref_chat_downloaded_user_id'=>$this->input->post('chat_user'),
                'chat_message_from_downloaded_user'=>0,
                'chat_message_from_app_admin'=>1,
                'chat_message'=>$this->input->post('text_message'),
                'chat_with_file'=>0,
                'chat_is_edited'=>0,
                'chat_sending_date_time'=>date('Y-m-d h:i:sa'),
                'chat_created_edited_date_time'=>date('Y-m-d h:i:sa'),
            );
            $this->db->insert('chat',$chat_array);
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


    public function get_users_last_chat_by_limit($end_limit)
    {
        $app_id=$this->session->userdata('login_app_id');
        $sql="SELECT * FROM chat
 join (SELECT ref_chat_downloaded_user_id,max(chat_sending_date_time) as last_sending_date_time FROM chat GROUP BY(ref_chat_downloaded_user_id)) as max_chat ON(chat.ref_chat_downloaded_user_id=max_chat.ref_chat_downloaded_user_id AND chat.chat_sending_date_time=max_chat.last_sending_date_time)
  INNER JOIN 	downloaded_user ON 	downloaded_user_id=chat.ref_chat_downloaded_user_id
  WHERE ref_chat_app_info_id=$app_id ORDER BY chat.chat_sending_date_time DESC LIMIT 0,".$end_limit."";
        $result=$this->db->query($sql);
        return $result->result_array();
    }
}



