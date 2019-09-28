<?php if(!defined('BASEPATH')) exit ('No direct script allowed');

class Service_model extends CI_Model
{
	
	public function __construct()
	{
		$this->load->database();
	}

	public function add_new_service(){


        $this->db->trans_start();

        //if(isset($_FILES['service_image']) == " " )




        $service_info = array(
        	'services_name' => $this->input->post('service_name'),
        	'services_details' => $this->input->post('service_description'),
            'ref_services_app_info_id' => $this->session->userdata('login_app_id'),
        	'services_image_location' => isset($_FILES['service_image']) && $_FILES['service_image']['error'] == 0?$this->upload_service_image():null,
            'services_is_active' =>1 
             
        );
         

        $this->db->insert('services',$service_info);
        $this->db->trans_complete();
        if ($this->db->trans_status() == TRUE) 
         {
            return 1;
         } 
            else
            {
              return 0;
            }

	}


   public function update_service_by_id($service_id){





        $this->db->trans_start();
        if($this->input->post('img_change')==0)
        {
            $service_info = array(
            'services_name' => $this->input->post('service_name'),
            'services_details' => $this->input->post('service_description'),
            'ref_services_app_info_id' => $this->session->userdata('login_app_id'), 
               
           );
        }
        else 
        {
            $service_info = array(
            'services_name' => $this->input->post('service_name'),
            'services_details' => $this->input->post('service_description'),
            'ref_services_app_info_id' => $this->session->userdata('login_app_id'),
            'services_image_location' => isset($_FILES['service_image']) && $_FILES['service_image']['error'] == 0?$this->upload_service_image():null,
             
          );
        }




        

        
        $this->db->where('services_id',$service_id);
        $this->db->where('ref_services_app_info_id',$this->session->userdata('login_app_id'));
        $this->db->update('services',$service_info );
         
        $this->db->trans_complete();
        if ($this->db->trans_status() == TRUE) 
         {
            return 1;
         } 
            else
            {
              return 0;
            }



      }






    public function get_all_service_list()
    {

        $query = $this->db->get_where("services",array('ref_services_app_info_id'=>$this->session->userdata('login_app_id'),'services_is_active'=>1));
        
        return $query->result_array();
    

    }


    public function get_service_data_by_id($service_id)
    {

        // $query = $this->db->get_where("services",array('services_id=>('$service_id')','ref_services_app_info_id'=>$this->session->userdata('login_app_id'),'services_is_active'=>1));
        $this->db->where('services_id',$service_id);
        $this->db->where('ref_services_app_info_id',$this->session->userdata('login_app_id'));
        $result=$this->db->get('services');
        
        return $result->row_array();
    

    }


	public function upload_service_image()
	{
		if (!is_dir('./all_images/service_images/app_id_' . $this->session->userdata('login_app_id'))) {
                mkdir('./all_images/service_images/app_id_' . $this->session->userdata('login_app_id'), 0777, true);
            }

            $this->load->library('upload');
            $file_name = explode('.', $_FILES["service_image"]["name"]);
            $file_extension_pos=sizeof($file_name);
            $file_extension =$file_name[$file_extension_pos-1];
            $temp_name = 's_' . date('Y_m_d_h_i_s') .".". $file_extension;
            $config['upload_path'] = 'all_images/service_images/app_id_' . $this->session->userdata('login_app_id');
            $config['allowed_types'] = "jpg|png|gif|jpeg";
            $config['file_name'] = $temp_name;
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('service_image'))

             {
                $error = array('error' => $this->upload->display_errors());
               

                return null;

            }

            else
            {
            	return 'all_images/service_images/app_id_' . $this->session->userdata('login_app_id'). '/' . $temp_name;

            }


            return null;

	}

    public function check_service_exist_by_service_id($service_id)
    {
        $this->db->where('services_id',$service_id);
        $this->db->where('ref_services_app_info_id',$this->session->userdata('login_app_id'));
        $result=$this->db->get('services');
        return $result->result_array();

    }


    public function delete_service_by_service_id($service_id)
    {

        $result=$this->check_service_exist_by_service_id($service_id);
        if(sizeof($result)==0)
        {
            return -1;
        }

        else
        {
            $this->db->trans_start();

            $service_array=array(
                'services_is_active'=> 0,

            );

            $this->db->where('services_id', $service_id);
            $this->db->update('services', $service_array);
           
            $this->db->trans_complete();
            if ($this->db->trans_status() == TRUE) {
                return 1;
            }
            else return 0;
        }
    }
}