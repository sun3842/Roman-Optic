<?php if(!defined('BASEPATH')) exit ('No direct script allowed');

class Order_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_all_order_status()
    {
        $this->db->where('order_status_active',1);
        $result=$this->db->get('order_status');
        return $result->result_array();
    }

    public function order_unique_id_is_valid($order_unique_id)
    {
        $this->db->where('ref_order_info_app_info_id',$this->session->userdata('login_app_id'));
        $this->db->where('order_info_unique_number',$order_unique_id);
        $result=$this->db->get('order_info');
        return $result->result_array();
    }

    public function add_order()
    {
        $this->db->trans_start();
        $order_array=array(
            'ref_order_info_app_info_id'=>$this->session->userdata('login_app_id'),
            'ref_order_info_order_status_id'=>$this->input->post('order_status'),
            'order_info_unique_number'=>$this->input->post('order_unique_id'),
            'order_info_opinion'=>$this->input->post('order_opinion'),
            'order_info_order_date'=>$this->input->post('order_date'),
            'order_info_delivery_date'=>$this->input->post('delivery_date'),
            'order_info_delivery_time'=>$this->input->post('delivery_time'),
        );
        $this->db->insert('order_info',$order_array);
        $this->db->trans_complete();
        if($this->db->trans_status()===false)
        {
            return 0;
        }
        else
        {
            return 1;
        }
    }

    public function get_all_order_by_limit($start_limit)
    {
        $app_id=$this->session->userdata('login_app_id');
        $sql="SELECT * FROM order_info
INNER JOIN order_status ON ref_order_info_order_status_id=order_status_id
WHERE ref_order_info_app_info_id=$app_id AND order_info_active=1 ORDER By(order_info_id) DESC LIMIT $start_limit,".DEFAULT_DATA_LIMIT."";
        $result=$this->db->query($sql);
        return $result->result_array();
    }
    public function order_unique_id_is_editable($order_unique_id,$order_id)
    {
        $this->db->where('ref_order_info_app_info_id',$this->session->userdata('login_app_id'));
        $this->db->where('order_info_unique_number',$order_unique_id);
        $this->db->where('order_info_id<>',$order_id);
        $result=$this->db->get('order_info');
        return $result->result_array();
    }

    public function check_order_exist_or_not($order_id)
    {
        $this->db->where('ref_order_info_app_info_id',$this->session->userdata('login_app_id'));
        $this->db->where('order_info_id',$order_id);
        $result=$this->db->get('order_info');
        return $result->result_array();
    }

    public function update_order()
    {
        $result=$this->check_order_exist_or_not($this->input->post('order_id'));
        if(sizeof($result)<=0)
        {
            return -1;
        }
        $this->db->trans_start();
        $order_array=array(
            'ref_order_info_app_info_id'=>$this->session->userdata('login_app_id'),
            'ref_order_info_order_status_id'=>$this->input->post('order_status'),
            'order_info_unique_number'=>$this->input->post('order_unique_id'),
            'order_info_opinion'=>$this->input->post('order_opinion'),
            'order_info_order_date'=>$this->input->post('order_date'),
            'order_info_delivery_date'=>$this->input->post('delivery_date'),
            'order_info_delivery_time'=>$this->input->post('delivery_time'),
        );
        $this->db->where('order_info_id',$this->input->post('order_id'));
        $this->db->update('order_info',$order_array);
        $this->db->trans_complete();
        if($this->db->trans_status()===false)
        {
            return 0;
        }
        else
        {
            return 1;
        }
    }
}