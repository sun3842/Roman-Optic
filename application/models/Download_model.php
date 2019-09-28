<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Download_model extends CI_Model
{
	
	function __construct()
	{
		$this->load->database();
	}


 public function get_all_download_list()
 {

   
   $app_id = $this->session->userdata('login_app_id');
   
   $sql= "SELECT * FROM downloaded_user
          LEFT  JOIN  (SELECT * FROM downloaded_user_device JOIN device_type
          ON (downloaded_user_device_device_type_id=device_type_id)) as d_u_d
          ON (downloaded_user.downloaded_user_id=d_u_d.ref_downloaded_user_device_downloaded_user_id)
          LEFT JOIN countries ON (ref_downloaded_user_nationality_country_id = countries_id)
          LEFT JOIN marital_status ON (ref_downloaded_user_marital_status_id = marital_status_id)
          LEFT JOIN occupation_list ON (ref_downloaded_user_occupation_list_id = occupation_list_id)
          LEFT JOIN states ON (ref_downloaded_user_states_id = states_id)
          LEFT JOIN cities ON (ref_downloaded_user_cities_id = cities_id)
          WHERE   ref_downloaded_user_app_info_id = $app_id";
         


         $result = $this->db->query($sql);

         return $result->result_array();

 }

   public function add_downloader_message()

   {

      $this->db->trans_start();


      $message_info = array
      (
        'message_title' => $this->input->post('message_title'),
        'message_details' => $this->input->post('message_description'),
        'ref_message_target_type_id' => 3,
        'ref_message_app_info_id' =>$this->session->userdata('login_app_id'),
        'message_is_push_notification'=>isset($_POST['push_notification']) ? 1:0,
        'message_active' => 1

      );

      $this->db->insert('message',$message_info);
      $insert_id = $this->db->insert_id();

      $personal_message_info = array
      (
        'ref_message_personal_message_id' => $insert_id,
        'ref_message_personal_downloaded_user_id' => $this->input->post('downloader_id')
  
      );
      
       $this->db->insert('message_personal',$personal_message_info);
       $this->db->trans_complete();
       if($this->db->trans_status() == TRUE)
       {
         return 1;
       }

       else
       {
         return 0;
       }

   }


   public function check_download_user_exist_or_not($download_user_id)
   {
       $this->db->where('downloaded_user_id',$download_user_id);
       $this->db->where('ref_downloaded_user_app_info_id',$this->session->userdata('login_app_id'));
       $result=$this->db->get('downloaded_user');
       return $result->result_array();
   }

   public function add_block_reason_message()
 {
     $result=$this->check_download_user_exist_or_not($this->input->post('downloader_block_id'));
     if(sizeof($result)<=0)
     {
         return 0;
     }
    $this->db->trans_start();
 
   $downloader_id = $this->input->post('downloader_block_id');

   $block_info = array
      (
        
        'downloaded_user_block_reason' => $this->input->post('block_user'),
        'ref_downloaded_user_app_info_id' => $this->session->userdata('login_app_id'),
        'downloaded_user_active' => 0
  
      );
      
     //$this->db->insert('downloaded_user',$block_info);

     $this->db->where('downloaded_user_id',$downloader_id);
     $this->db->where('ref_downloaded_user_app_info_id',$this->session->userdata('login_app_id'));
     $this->db->update('downloaded_user',$block_info );


     $this->db->trans_complete();
     if($this->db->trans_status() == TRUE)
     {
       return 1;
     }

     else
     {
       return 0;
     }
   }


   public function add_unblock_message()
   {

       $result=$this->check_download_user_exist_or_not($this->input->post('downloader_unblock_id'));
       if(sizeof($result)<=0)
       {
           return 0;
       }

    $this->db->trans_start();
    $downloader_id = $this->input->post('downloader_unblock_id');

     $unblock_info = array
      (
        
        'ref_downloaded_user_app_info_id' => $this->session->userdata('login_app_id'),
        'downloaded_user_active' => 1
  
      );

     $this->db->where('downloaded_user_id',$downloader_id);
     $this->db->where('ref_downloaded_user_app_info_id',$this->session->userdata('login_app_id'));
     $this->db->update('downloaded_user',$unblock_info );


     $this->db->trans_complete();
     
     if($this->db->trans_status() == TRUE)
     {
       return 1;
     }

     else
     {
       return 0;
     }
   }

}