<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Inquiry_model extends CI_Model{
    public function __construct()
    {
        $this->load->database();
    }


    public function get_all_inquiry_by_limit($start_limit)
    {

        $app_id=$this->session->userdata('login_app_id');
//        $sql="SELECT * FROM inquiry
//LEFT JOIN (SELECT * FROM inquiry_message ORDER BY inquiry_message_id DESC LIMIT 1) as inquiry_reply ON inquiry_reply.ref_inquiry_message_inquiry_id=inquiry_id
//LEFT JOIN downloaded_user ON downloaded_user_id=ref_inquiry_downloaded_user_id
//WHERE ref_downloaded_user_app_info_id=$app_id ORDER BY inquiry_id DESC LIMIT $start_limit,".DEFAULT_DATA_LIMIT."";
        $sql="SELECT * FROM inquiry
LEFT JOIN (SELECT *,MAX(ref_inquiry_message_inquiry_id) AS last_message FROM inquiry_message GROUP BY(ref_inquiry_message_inquiry_id)) AS inq_rep ON inq_rep.ref_inquiry_message_inquiry_id=inquiry.inquiry_id 
WHERE inquiry.ref_inquiry_app_info_id=$app_id
ORDER BY(inquiry.inquiry_id) DESC LIMIT $start_limit,".DEFAULT_DATA_LIMIT."";
//        $this->db->join('downloaded_user', 'downloaded_user.downloaded_user_id = ref_inquiry_downloaded_user_id', 'left');
//        $this->db->where('ref_inquiry_app_info_id',$this->session->userdata('login_app_id'));
//        $this->db->order_by("inquiry_date_time", "DESC");
//        $result=$this->db->get('inquiry');
        $result=$this->db->query($sql);
        return $result->result_array();

    }



    public function check_inquiry_exist_or_not($inquiry_id){
        $this->db->where('ref_inquiry_app_info_id',$this->session->userdata('login_app_id'));
        $this->db->where('inquiry_id',$inquiry_id);
        $result=$this->db->get('inquiry');
        return $result->result_array();
    }


    public function get_inquiry_reply_by_id($inquiry_id){
        $result=$this->check_inquiry_exist_or_not($inquiry_id);
        if(sizeof($result)<=0)
        {
            return -1;
        }
        else
        {
            $this->db->trans_start();
            $inquiry_array=array(
                'inquiry_is_seen'=>1
            );
            $this->db->where('inquiry_id',$inquiry_id);
            $this->db->update('inquiry',$inquiry_array);
            $inquiry_message_array=array(
                'inquiry_reply_is_seen'=>1
            );
            $this->db->where('ref_inquiry_message_inquiry_id',$inquiry_id);
            $this->db->update('inquiry_message',$inquiry_message_array);

            $sql="SELECT * FROM inquiry
LEFT JOIN inquiry_message ON ref_inquiry_message_inquiry_id=inquiry_id
LEFT JOIN downloaded_user ON downloaded_user_id=ref_inquiry_downloaded_user_id
LEFT JOIN product ON product_id=ref_inquiry_product_id
LEFT JOIN product_image ON ref_product_image_product_id=product_id
LEFT JOIN product_attributes ON ref_product_attributes_product_id=product_id
LEFT JOIN category ON ref_product_category_id=category_id
LEFT JOIN currency ON currency_id=ref_product_currency_id
LEFT JOIN offer ON offer_id=ref_inquiry_offer_id
LEFT JOIN offer_conditions ON ref_offer_conditions_offer_id=offer_id
LEFT JOIN cities ON condition_cities_id=cities_id
LEFT JOIN occupation_list ON condition_occupation_list_id=occupation_list_id
LEFT JOIN marital_status ON condition_marital_status_id=marital_status_id
LEFT JOIN offer_image ON ref_offer_image_offer_id=offer_id
LEFT JOIN offer_product ON ref_offer_product_offer_id=offer_id
WHERE inquiry_id=$inquiry_id";
            $result=$this->db->query($sql);
            $this->db->trans_complete();
            if($this->db->trans_status()==TRUE)
            {
                return $result->result_array();
            }
            else
            {
                return 0;
            }
        }
    }
    public function add_inquiry_message_by_inquiry_id($inquiry_id){
        $result=$this->check_inquiry_exist_or_not($inquiry_id);
        if(sizeof($result)<=0)
        {
            return -1;
        }
        else
        {
            $this->db->trans_start();

            $message_inquiry_array=array(
                'ref_inquiry_message_inquiry_id'=>$inquiry_id,
                'inquiry_reply_message'=>$this->input->post('inquiry_reply'),
                'inquiry_reply_from_user'=>0,
                'inquiry_reply_from_admin'=>1,
                'inquiry_reply_is_seen'=>1,
            );

            $this->db->insert('inquiry_message',$message_inquiry_array);

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