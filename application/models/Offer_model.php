<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Offer_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }



    public function check_product_exist_by_product_id($product_id)
    {
        $this->db->where('product_id',$product_id);
        $this->db->where('ref_product_app_info_id',$this->session->userdata('login_app_id'));
        $result=$this->db->get('product');
        return $result->result_array();

    }

    public function check_offer_exist_by_id($offer_id)
    {

        $this->db->where('offer_id',$offer_id);
        $this->db->where('ref_offer_app_info_id',$this->session->userdata('login_app_id'));
        $this->db->where('offer_active',1);
        $result=$this->db->get('offer');
        return $result->result_array();

    }


    public function get_product_by_name($product_name){
        $app_id=$this->session->userdata('login_app_id');
        $sql="SELECT * FROM product WHERE product_name LIKE '%$product_name%' AND product_active=1 AND ref_product_app_info_id=$app_id";
        $result=$this->db->query($sql);
        return $result->result_array();
    }



    public function add_offer()
    {
        $this->db->trans_start();

        $app_id=$this->session->userdata('login_app_id');
        $current_date_time=date('Y-m-d h:i:sa');

        $offer_info_array=array(
            'ref_offer_app_info_id'=>$app_id,
            'ref_offer_target_type_id'=>(isset($_POST['submit_general_offer']))?1:((isset($_POST['submit_target_offer']))?2:3),
            'offer_title'=>$this->input->post('offer_title'),
            'offer_details'=>$this->input->post('offer_description'),
            'offer_starting_date_time'=>($this->input->post('offer_start_date_time')!='')?$this->input->post('offer_start_date_time'):NULL,
            'offer_ending_date_time'=>($this->input->post('offer_end_date_time')!='')?$this->input->post('offer_end_date_time'):NULL,
            'offer_created_date_time'=>$current_date_time,
            'offer_active'=>1,
            'offer_is_push_notification'=>($this->input->post('push_notification')=='on')?1:0,
        );
        $this->db->insert('offer',$offer_info_array);
        $offer_id=$this->db->insert_id();

        if(isset($_POST['offer_products']))
        {
            foreach ($_POST['offer_products'] AS $offer_product)
            {
                $result=$this->check_product_exist_by_product_id($offer_product);
                if(sizeof($result)>0){
                    $offer_product_array=array(
                        'ref_offer_product_offer_id'=>$offer_id,
                        'ref_offer_product_product_id'=>$offer_product,
                        'offer_product_adding_date_time'=>$current_date_time,
                        'offer_product_active'=>1,
                    );

                    $this->db->insert('offer_product',$offer_product_array);
                }


            }
        }


        if (isset($_FILES['offer_display_image']) && $_FILES['offer_display_image']['error'] == 0 && $this->input->post('single_image_deleted_0')==0 ) {
            if (!is_dir('./all_images/offer_images/app_id_' . $this->session->userdata('login_app_id'))) {
                mkdir('./all_images/offer_images/app_id_' . $this->session->userdata('login_app_id'), 0777, true);
            }
            $this->load->library('upload');
            $file_name = explode('.', $_FILES["offer_display_image"]["name"]);
            $file_extension_pos=sizeof($file_name);
            $file_extension =$file_name[$file_extension_pos-1];
            $temp_name = 'o_' . date('Y_m_d_h_i_s') .".". $file_extension;
            $config['upload_path'] = './all_images/offer_images/app_id_' . $this->session->userdata('login_app_id');
            $config['allowed_types'] = "jpg|png|gif|jpeg";
            $config['file_name'] = $temp_name;
            $this->upload->initialize($config);
//            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('offer_display_image')) {
                $error = array('error' => $this->upload->display_errors());
                print_r($error);
                die();
            } else {
                $offer_image_array = array(
                    'ref_offer_image_offer_id' => $offer_id,
                    'offer_image_location' => 'all_images/offer_images/app_id_' . $this->session->userdata('login_app_id'). '/' . $temp_name,
                    'offer_image_is_display' => 1,
                    'offer_image_size_kb' => ($_FILES['offer_display_image']['size'] / 1000),
                    'offer_image_active' => 1,
                    'offer_image_uploading_datetime' => date('Y-m-d h:i:sa'),
                    'offer_image_last_edited_date_time' => date('Y-m-d h:i:sa')
                );
                $this->db->insert('offer_image', $offer_image_array);
            }

        }

        if (isset($_FILES['offer_more_image']) && sizeof($_FILES['offer_more_image']['name'])>0) {
            $this->load->library('upload');
            $i=0;
            foreach ($_FILES['offer_more_image']['name'] AS $offer_image) {
                if($this->input->post('image_deleted_'.$i)==1 )
                { }
            else {
                $_FILES["file_select_upload"]["name"] = $_FILES["offer_more_image"]["name"][$i];
                $_FILES["file_select_upload"]["type"] = $_FILES["offer_more_image"]["type"][$i];
                $_FILES["file_select_upload"]["tmp_name"] = $_FILES["offer_more_image"]["tmp_name"][$i];
                $_FILES["file_select_upload"]["error"] = $_FILES["offer_more_image"]["error"][$i];
                $_FILES["file_select_upload"]["size"] = $_FILES["offer_more_image"]["size"][$i];
                if ($_FILES["file_select_upload"]["error"] == 0) {
                    if (!is_dir('./all_images/offer_images/app_id_' . $this->session->userdata('login_app_id'))) {
                        mkdir('./all_images/offer_images/app_id_' . $this->session->userdata('login_app_id'), 0777, true);
                    }
                    $file_name = explode('.', $_FILES['file_select_upload']["name"]);
//                $file_extension = end($file_name);
                    $file_extension_pos = sizeof($file_name);
                    $file_extension = $file_name[$file_extension_pos - 1];
                    $temp_name = 'p_' . date('Y_m_d_h_i_s') . $i . '.' . $file_extension;
                    $config['upload_path'] = './all_images/offer_images/app_id_' . $this->session->userdata('login_app_id');
                    $config['allowed_types'] = "jpg|png|gif|jpeg";
                    $config['file_name'] = $temp_name;
//                print_r($config);die();
                    $this->upload->initialize($config);
//                $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('file_select_upload')) {
                        $error = array('error' => $this->upload->display_errors());
                        print_r($error);
                        die();
                    } else {
                        $product_image_array = array(
                            'ref_offer_image_offer_id' => $offer_id,
                            'offer_image_location' => 'all_images/offer_images/app_id_' . $this->session->userdata('login_app_id') . '/' . $temp_name,
                            'offer_image_is_display' => 0,
                            'offer_image_size_kb' => ($_FILES['file_select_upload']['size'] / 1000),
                            'offer_image_active' => 1,
                            'offer_image_uploading_datetime' => date('Y-m-d h:i:sa'),
                            'offer_image_last_edited_date_time' => date('Y-m-d h:i:sa')
                        );
                        $this->db->insert('offer_image', $product_image_array);
                    }
                }

            }

                $i++;
            }
        }

        if(isset($_POST['submit_target_offer'])){

            $condition_gender=0;
            if($this->input->post('is_target_gender')=='on'){
                if($this->input->post('men')=='on' && $this->input->post('women')=='on'){
                    $condition_gender=4;
                }
                else if($this->input->post('men')=='on')
                {
                    $condition_gender=1;
                }
                else if($this->input->post('women')=='on')
                {
                    $condition_gender=2;
                }
            }
            $start_date_range=NULL;
            $end_date_range=NULL;
            if(isset($_POST['age_limit']))
            {

                $year_ranges=explode('-',$this->input->post('age_limit'));
                $start_date_range=$year_ranges[0];
                $end_date_range=$year_ranges[1];

            }
            $target_info_array=array(
                'ref_offer_conditions_offer_id'=>$offer_id,
                'is_condition_gender'=>($this->input->post('is_target_gender')=='on')?1:0,
                'condition_gender'=> $condition_gender,
                'is_condition_occupation'=>($this->input->post('is_target_occupation')=='on')?1:0,
                'condition_occupation_list_id'=>(isset($_POST['occupation_id']))?$this->input->post('occupation_id'): NULL,
                'is_condition_city'=>($this->input->post('is_target_city')=='on')?1:0,
                'condition_cities_id'=>(isset($_POST['city_id']))?$this->input->post('city_id'): NULL,
                'is_condition_birth_date'=>($this->input->post('is_target_birthday')=='on')?1:0,
                'condition_birth_date'=>(isset($_POST['birthday']))?$this->input->post('city_id'): NULL,
                'is_condition_age_range'=>($this->input->post('is_target_marital_status')=='on')?1:0,
                'condition_starting_age'=>(isset($_POST['age_limit']))?$start_date_range: NULL,
                'condition_ending_range'=>(isset($_POST['age_limit']))?$end_date_range: NULL,
                'is_condition_marital_status'=>($this->input->post('is_target_marital_status')=='on')?1:0,
                'condition_marital_status_id'=>(isset($_POST['marital_status']))?$this->input->post('marital_status'): NULL,
                'match_all_conditions'=>($this->input->post('match_and_condition')=='on')?1:0,
            );
            $this->db->insert('offer_conditions',$target_info_array);
        }

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

//    public function get_all_offer(){
//        $app_id=$this->session->userdata('login_app_id');
//        $this->db->where('ref_offer_app_info_id',$app_id);
//        $this->db->where('offer_active',1);
//        $result=$this->db->get('offer');
//        return $result->result_array();
//    }

    public function get_active_offer_list_by_limit($starting_limit)
    {
        $app_id=$this->session->userdata('login_app_id');
        $sql="SELECT * FROM offer 
        WHERE offer_active=1 AND  ref_offer_app_info_id=$app_id order by offer_id DESC LIMIT $starting_limit,".DEFAULT_DATA_LIMIT."";

        // echo $sql;
        $query=$this->db->query($sql);

        return $query->result_array();


    }

    public function delete_offer_by_id($offer_id){
            $result=$this->check_offer_exist_by_id($offer_id);
            if(sizeof($result)<=0)
            {
                return -1;
            }
            else
            {
                $this->db->trans_start();
                $offer_info_array=array(
                    'offer_active'=>0
                );
                $this->db->where('offer_id',$offer_id);
                $this->db->update('offer',$offer_info_array);

                $offer_img_array=array(
                    'offer_image_active'=>0
                );
                $this->db->where('ref_offer_image_offer_id',$offer_id);
                $this->db->update('offer_image',$offer_img_array);
                $offer_product_array=array(
                    'offer_product_active'=>0
                );
                $this->db->where('ref_offer_product_offer_id',$offer_id);
                $this->db->update('offer_product',$offer_product_array);

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

    public function get_offer_by_id($offer_id){
       $app_id=$this->session->userdata('login_app_id');
       $sql="SELECT * FROM offer
LEFT JOIN offer_conditions ON ref_offer_conditions_offer_id=offer_id
LEFT JOIN offer_image ON ref_offer_image_offer_id=offer_id
LEFT JOIN offer_product ON ref_offer_product_offer_id=offer_id
LEFT JOIN product ON ref_offer_product_product_id=product_id
LEFT JOIN cities ON cities_id=condition_cities_id
LEFT JOIN marital_status ON condition_marital_status_id=marital_status_id
LEFT JOIN occupation_list ON occupation_list_id=condition_occupation_list_id
LEFT JOIN target_type ON target_type_id=ref_offer_target_type_id
WHERE  ref_offer_app_info_id=$app_id AND offer_id=$offer_id AND offer_active=1";

       $result=$this->db->query($sql);
       return $result->result_array();
    }

    public function delete_offer_img_by_id($img_id){
        $app_id=$this->session->userdata('login_app_id');
       $sql="SELECT * FROM offer_image
INNER JOIN offer ON offer_id=ref_offer_image_offer_id
WHERE ref_offer_app_info_id=$app_id AND offer_image_id=$img_id AND offer_image_active=1";
       $result_obj=$this->db->query($sql);
       $result=$result_obj->result_array();
       if(sizeof($result)<=0)
       {
        return -1;

       }
       else
       {
           $this->db->trans_start();
           $offer_img_array=array(
               'offer_image_active'=>0
           );
           $this->db->where('offer_image_id',$img_id);
           $this->db->update('offer_image',$offer_img_array);

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

    public function delete_offer_product_by_id($product_id){
        $app_id=$this->session->userdata('login_app_id');
        $sql="SELECT * FROM offer_product
INNER JOIN offer ON offer_id=ref_offer_product_offer_id
WHERE ref_offer_app_info_id=$app_id AND offer_product_id=$product_id AND offer_product_active=1";
        $result_obj=$this->db->query($sql);
        $result=$result_obj->result_array();
        if(sizeof($result)<=0)
        {
            return -1;

        }
        else
        {
            $this->db->trans_start();
            $offer_product_array=array(
                'offer_product_active'=>0
            );
            $this->db->where('offer_product_id',$product_id);
            $this->db->update('offer_product',$offer_product_array);

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

    public function update_offer($offer_id){
        $result=$this->check_offer_exist_by_id($offer_id);
        if(sizeof($result)<=0)
        {
            return -1;
        }
        $this->db->trans_start();

        $app_id=$this->session->userdata('login_app_id');
        $current_date_time=date('Y-m-d h:i:sa');

        $offer_info_array=array(
            'ref_offer_app_info_id'=>$app_id,
            'ref_offer_target_type_id'=>(isset($_POST['submit_general_offer']))?1:((isset($_POST['submit_target_offer']))?2:3),
            'offer_title'=>$this->input->post('offer_title'),
            'offer_details'=>$this->input->post('offer_description'),
            'offer_starting_date_time'=>($this->input->post('offer_start_date_time')!='')?$this->input->post('offer_start_date_time'):NULL,
            'offer_ending_date_time'=>($this->input->post('offer_end_date_time')!='')?$this->input->post('offer_end_date_time'):NULL,
            'offer_active'=>1,
            'offer_is_push_notification'=>($this->input->post('push_notification')=='on')?1:0,
        );
        $this->db->where('offer_id',$offer_id);
        $this->db->update('offer',$offer_info_array);

        if(isset($_POST['offer_products']))
        {
            foreach ($_POST['offer_products'] AS $offer_product)
            {
                $result=$this->check_product_exist_by_product_id($offer_product);
                if(sizeof($result)>0){
                    $offer_product_array=array(
                        'ref_offer_product_offer_id'=>$offer_id,
                        'ref_offer_product_product_id'=>$offer_product,
                        'offer_product_adding_date_time'=>$current_date_time,
                        'offer_product_active'=>1,
                    );

                    $this->db->insert('offer_product',$offer_product_array);
                }


            }
        }


        if (isset($_FILES['offer_display_image']) && $_FILES['offer_display_image']['error'] == 0 && $this->input->post('single_image_deleted_0')==0 ) {
            if (!is_dir('./all_images/offer_images/app_id_' . $this->session->userdata('login_app_id'))) {
                mkdir('./all_images/offer_images/app_id_' . $this->session->userdata('login_app_id'), 0777, true);
            }
            $this->load->library('upload');
            $file_name = explode('.', $_FILES["offer_display_image"]["name"]);
            $file_extension_pos=sizeof($file_name);
            $file_extension =$file_name[$file_extension_pos-1];
            $temp_name = 'o_' . date('Y_m_d_h_i_s') .".". $file_extension;
            $config['upload_path'] = './all_images/offer_images/app_id_' . $this->session->userdata('login_app_id');
            $config['allowed_types'] = "jpg|png|gif|jpeg";
            $config['file_name'] = $temp_name;
            $this->upload->initialize($config);
//            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('offer_display_image')) {
                $error = array('error' => $this->upload->display_errors());
                print_r($error);
                die();
            } else {
                $offer_image_array = array(
                    'offer_image_location' => 'all_images/offer_images/app_id_' . $this->session->userdata('login_app_id'). '/' . $temp_name,
                    'offer_image_is_display' => 1,
                    'offer_image_size_kb' => ($_FILES['offer_display_image']['size'] / 1000),
                    'offer_image_active' => 1,
                    'offer_image_uploading_datetime' => date('Y-m-d h:i:sa'),
                    'offer_image_last_edited_date_time' => date('Y-m-d h:i:sa')
                );
                $this->db->where('ref_offer_image_offer_id',$offer_id);
                $this->db->where('offer_image_is_display',1);
                $this->db->where('offer_image_active',1);
                $result_obj=$this->db->get('offer_image');
                $result=$result_obj->result_array();
                if(sizeof($result)<=0)
                {
                    $offer_image_array['ref_offer_image_offer_id']=$offer_id;
                    $this->db->insert('offer_image', $offer_image_array);
                }
                else
                {
                    $this->db->where('offer_image_id',$result[0]['offer_image_id']);
                    $this->db->update('offer_image',$offer_image_array);
                }

            }

        }

        if (isset($_FILES['offer_more_image']) && sizeof($_FILES['offer_more_image']['name'])>0) {
            $this->load->library('upload');
            $i=0;
            foreach ($_FILES['offer_more_image']['name'] AS $offer_image) {
                if($this->input->post('image_deleted_'.$i)==1 )
                { }
                else {
                    $_FILES["file_select_upload"]["name"] = $_FILES["offer_more_image"]["name"][$i];
                    $_FILES["file_select_upload"]["type"] = $_FILES["offer_more_image"]["type"][$i];
                    $_FILES["file_select_upload"]["tmp_name"] = $_FILES["offer_more_image"]["tmp_name"][$i];
                    $_FILES["file_select_upload"]["error"] = $_FILES["offer_more_image"]["error"][$i];
                    $_FILES["file_select_upload"]["size"] = $_FILES["offer_more_image"]["size"][$i];
                    if ($_FILES["file_select_upload"]["error"] == 0) {
                        if (!is_dir('./all_images/offer_images/app_id_' . $this->session->userdata('login_app_id'))) {
                            mkdir('./all_images/offer_images/app_id_' . $this->session->userdata('login_app_id'), 0777, true);
                        }
                        $file_name = explode('.', $_FILES['file_select_upload']["name"]);
//                $file_extension = end($file_name);
                        $file_extension_pos = sizeof($file_name);
                        $file_extension = $file_name[$file_extension_pos - 1];
                        $temp_name = 'p_' . date('Y_m_d_h_i_s') . $i . '.' . $file_extension;
                        $config['upload_path'] = './all_images/offer_images/app_id_' . $this->session->userdata('login_app_id');
                        $config['allowed_types'] = "jpg|png|gif|jpeg";
                        $config['file_name'] = $temp_name;
//                print_r($config);die();
                        $this->upload->initialize($config);
//                $this->load->library('upload', $config);
                        if (!$this->upload->do_upload('file_select_upload')) {
                            $error = array('error' => $this->upload->display_errors());
                            print_r($error);
                            die();
                        } else {
                            $product_image_array = array(
                                'ref_offer_image_offer_id' => $offer_id,
                                'offer_image_location' => 'all_images/offer_images/app_id_' . $this->session->userdata('login_app_id') . '/' . $temp_name,
                                'offer_image_is_display' => 0,
                                'offer_image_size_kb' => ($_FILES['file_select_upload']['size'] / 1000),
                                'offer_image_active' => 1,
                                'offer_image_uploading_datetime' => date('Y-m-d h:i:sa'),
                                'offer_image_last_edited_date_time' => date('Y-m-d h:i:sa')
                            );
                            $this->db->insert('offer_image', $product_image_array);
                        }
                    }

                }

                $i++;
            }
        }

        if(isset($_POST['submit_target_offer'])){

            $condition_gender=0;
            if($this->input->post('is_target_gender')=='on'){
                if($this->input->post('men')=='on' && $this->input->post('women')=='on'){
                    $condition_gender=4;
                }
                else if($this->input->post('men')=='on')
                {
                    $condition_gender=1;
                }
                else if($this->input->post('women')=='on')
                {
                    $condition_gender=2;
                }
            }
            $start_date_range=NULL;
            $end_date_range=NULL;
            if(isset($_POST['age_limit']))
            {

                $year_ranges=explode('-',$this->input->post('age_limit'));
                $start_date_range=$year_ranges[0];
                $end_date_range=$year_ranges[1];

            }
            $target_info_array=array(
                'is_condition_gender'=>($this->input->post('is_target_gender')=='on')?1:0,
                'condition_gender'=> $condition_gender,
                'is_condition_occupation'=>($this->input->post('is_target_occupation')=='on')?1:0,
                'condition_occupation_list_id'=>(isset($_POST['occupation_id']))?$this->input->post('occupation_id'): NULL,
                'is_condition_city'=>($this->input->post('is_target_city')=='on')?1:0,
                'condition_cities_id'=>(isset($_POST['city_id']))?$this->input->post('city_id'): NULL,
                'is_condition_birth_date'=>($this->input->post('is_target_birthday')=='on')?1:0,
                'condition_birth_date'=>(isset($_POST['birthday']))?$this->input->post('birthday'): NULL,
                'is_condition_age_range'=>($this->input->post('is_target_age_limit')=='on')?1:0,
                'condition_starting_age'=>(isset($_POST['age_limit']))?$start_date_range: NULL,
                'condition_ending_range'=>(isset($_POST['age_limit']))?$end_date_range: NULL,
                'is_condition_marital_status'=>($this->input->post('is_target_marital_status')=='on')?1:0,
                'condition_marital_status_id'=>(isset($_POST['marital_status']))?$this->input->post('marital_status'): NULL,
                'match_all_conditions'=>($this->input->post('match_and_condition')=='on')?1:0,
            );

//            print_r($_POST);die();

            $this->db->where('ref_offer_conditions_offer_id',$offer_id);
            $tem_condition_obj=$this->db->get('offer_conditions');
            $tem_condition=$tem_condition_obj->result_array();
            if(sizeof($tem_condition)<=0){
                $target_info_array['ref_offer_conditions_offer_id']=$offer_id;
                $this->db->insert('offer_conditions',$target_info_array);
            }
            else
            {
                $this->db->where('ref_offer_conditions_offer_id',$offer_id);
                $this->db->update('offer_conditions',$target_info_array);
            }



        }
        else if(isset($_POST['submit_general_offer']))
        {
            $this->db->where('ref_offer_conditions_offer_id',$offer_id);
            $tem_condition_obj=$this->db->get('offer_conditions');
            $tem_condition=$tem_condition_obj->result_array();
            if(sizeof($tem_condition)>=1)
            {
                $target_info_array=array(
                    'is_condition_gender'=>0,
                    'condition_gender'=> NULL,
                    'is_condition_occupation'=>0,
                    'condition_occupation_list_id'=>NULL,
                    'is_condition_city'=>0,
                    'condition_cities_id'=>NULL,
                    'is_condition_birth_date'=>0,
                    'condition_birth_date'=>NULL,
                    'is_condition_age_range'=>0,
                    'condition_starting_age'=>NULL,
                    'condition_ending_range'=>NULL,
                    'is_condition_marital_status'=>0,
                    'condition_marital_status_id'=>NULL,
                    'match_all_conditions'=>0,
                );
                $this->db->where('ref_offer_conditions_offer_id',$offer_id);
                $this->db->update('offer_conditions',$target_info_array);
            }
        }

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