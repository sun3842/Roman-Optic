<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Collection_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    //******************************************************for encoding product attribute value*****************************************
//    public function encode_product_attribute_value($product_attribute)
//    {
//        $attr_values = explode(',', $product_attribute);
//        $temp_attr_value = '';
//        foreach ($attr_values AS $attr_value) {
//            $temp_attr_value = $temp_attr_value . '/' . $attr_value . '/,';
//        }
//
//        return $temp_attr_value;
//
//    }


    public function check_category_name_exist($category_name,$category_id)
    {

        $this->db->where('ref_category_app_info_id', $this->session->userdata('login_app_id'));
        $this->db->where('category_name', $category_name);
        $this->db->where('category_id!=', $category_id);
        $result = $this->db->get('category');
        return $result->row_array();
    }

    public function check_category_name_addable($category_name)
    {
        $this->db->where('ref_category_app_info_id', $this->session->userdata('login_app_id'));
        $this->db->where('category_name', $category_name);
        $result = $this->db->get('category');
        return $result->row_array();
    }

    public function check_category_id_exist($category_id)
    {
        $this->db->where('ref_category_app_info_id', $this->session->userdata('login_app_id'));
        $this->db->where('category_id', $category_id);
        $result = $this->db->get('category');
        return $result->row_array();
    }

    public function check_subcategory_name_exist_by_category_id($subcategory_name, $category_id)
    {
        $sql = 'SELECT * FROM subcategory
INNER JOIN category ON ref_subcategory_category_id=category_id
WHERE ref_category_app_info_id=' . $this->session->userdata('login_app_id') . ' AND ref_subcategory_category_id=' . $category_id . ' AND subcategory_name="' . $subcategory_name . '"';
        $result = $this->db->query($sql);
        return $result->row_array();

    }

    public function check_subcategory_name_exist_by_category_id_subcategory_id($subcategory_name, $category_id,$subcategory_id)
    {
        $sql = 'SELECT * FROM subcategory
INNER JOIN category ON ref_subcategory_category_id=category_id
WHERE ref_category_app_info_id=' . $this->session->userdata('login_app_id') . ' AND ref_subcategory_category_id=' . $category_id . ' AND subcategory_name="' . $subcategory_name . '" AND subcategory_id!='.$subcategory_id;
        $result = $this->db->query($sql);
        return $result->row_array();

    }

    public function check_subcategory_id_exist($subcategory_id)
    {

        $sql = 'SELECT * FROM subcategory
INNER JOIN category ON ref_subcategory_category_id=category_id
WHERE ref_category_app_info_id=' . $this->session->userdata('login_app_id') . ' AND subcategory_id="' . $subcategory_id . '"';
        $result = $this->db->query($sql);
        return $result->row_array();

    }

    public function add_category_name($category_name)
    {

        $category_array = array(
            'ref_category_app_info_id' => $this->session->userdata('login_app_id'),
            'category_name' => $category_name,
            'category_active' => 1,
            'category_last_edited_date_time' => date('Y-m-d h:i:sa')
        );
        $this->db->trans_start();
        $this->db->insert('category', $category_array);
        $category_insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        if ($this->db->trans_status() == TRUE) {
            return $category_insert_id;
        } else return 0;

    }

    public function update_category_name($update_category_name, $category_id)
    {
        $category_array = array(
            'category_name' => $update_category_name,
            'category_last_edited_date_time' => date('Y-m-d h:i:sa')
        );

        $this->db->trans_start();
        $this->db->where('category_id', $category_id);
        $this->db->update('category', $category_array);
        $this->db->trans_complete();
        if ($this->db->trans_status() == TRUE) {
            return 1;
        } else return 0;

    }

    public function delete_category_id($category_id)
    {

        $result = $this->check_category_id_exist($category_id);
        if (sizeof($result) <= 0) {
            return -1;
        } else {
            $this->db->trans_start();
            if ($this->input->post('product_delete') == "on") {
                $product_array = array(
                    'product_active' => 0,
                    'product_last_edited_date_time' => date('Y-m-d h:i:sa')
                );
                $this->db->where('ref_product_category_id', $category_id);
                $this->db->update('product', $product_array);
            } else {
                $product_array = array(
                    'ref_product_category_id' => NULL,
                    'ref_product_subcategory_id' => NULL,
                    'product_last_edited_date_time' => date('Y-m-d h:i:sa')
                );
                $this->db->where('ref_product_category_id', $category_id);
                $this->db->update('product', $product_array);
            }
            $subcategory_array = array(
                'subcategory_active' => 0,
                'subcategory_last_edited_date_time' => date('Y-m-d h:i:sa')
            );
            $this->db->where('ref_subcategory_category_id', $category_id);
            $this->db->update('subcategory', $subcategory_array);
            $category_array = array(
                'category_name' => $result['category_name'] . '-' . date('Y-m-d h:i:sa'),
                'category_active' => 0,
                'category_last_edited_date_time' => date('Y-m-d h:i:sa'),
            );
            $this->db->where('category_id', $category_id);
            $this->db->update('category', $category_array);
            $this->db->trans_complete();
            if ($this->db->trans_status() == TRUE) {
                return 1;
            } else return 0;
        }

    }

    public function add_subcategory_name_by_category_id($category_id, $subcategory_name)
    {

        $subcategory_array = array(
            'ref_subcategory_category_id' => $category_id,
            'subcategory_name' => $subcategory_name,
            'subcategory_active' => 1,
            'subcategory_last_edited_date_time' => date('Y-m-d h:i:sa')
        );
        $this->db->trans_start();
        $this->db->insert('subcategory', $subcategory_array);
        $subcategory_insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        if ($this->db->trans_status() == TRUE) {
            return $subcategory_insert_id;
        } else return 0;

    }

    public function update_subcategory_name($update_subcategory_name, $subcategory_id)
    {
        $result = $this->check_subcategory_id_exist($subcategory_id);
        if (sizeof($result) <= 0) {
            return -1;
        } else {
            $subcategory_array = array(
                'subcategory_name' => $update_subcategory_name,
                'subcategory_last_edited_date_time' => date('Y-m-d h:i:sa')
            );
            $this->db->trans_start();
            $this->db->where('subcategory_id', $subcategory_id);
            $this->db->update('subcategory', $subcategory_array);
            $this->db->trans_complete();
            if ($this->db->trans_status() == TRUE) {
                return 1;
            } else return 0;
        }

    }

    public function get_category_id_by_subcategory_id($subcategory_id)
    {

    }

    public function delete_subcategory_id($subcategory_id)
    {
        $result = $this->check_subcategory_id_exist($subcategory_id);
        if (sizeof($result) <= 0) {
            return -1;
        } else {
            $this->db->trans_start();

            if ($this->input->post('product_delete') == "on") {
                $product_array = array(
                    'product_active' => 0,
                    'product_last_edited_date_time' => date('Y-m-d h:i:sa')
                );
                $this->db->where('ref_product_subcategory_id', $subcategory_id);
                $this->db->update('product', $product_array);
            } else {
                $product_array = array(
                    'ref_product_subcategory_id' => NULL,
                    'product_last_edited_date_time' => date('Y-m-d h:i:sa')
                );
                $this->db->where('ref_product_subcategory_id', $subcategory_id);
                $this->db->update('product', $product_array);
            }

            $subcategory_array = array(
                'subcategory_name' => $result['subcategory_name'] . '-' . date('Y-m-d h:i:sa'),
                'subcategory_active' => 0,
                'subcategory_last_edited_date_time' => date('Y-m-d h:i:sa')
            );
            $this->db->where('subcategory_id', $subcategory_id);
            $this->db->update('subcategory', $subcategory_array);

            $this->db->trans_complete();
            if ($this->db->trans_status() == TRUE) {
                return 1;
            } else return 0;

        }
    }

    public function get_all_active_categories()
    {
        $sql = 'SELECT *,(SELECT COUNT(subcategory_id) FROM subcategory WHERE ref_subcategory_category_id=category_id AND subcategory_active<>0) AS subctg FROM category WHERE category_active=1 AND ref_category_app_info_id=' . $this->session->userdata('login_app_id');
        $result = $this->db->query($sql);
        return $result->result_array();
    }

    public function get_all_active_subcategories_by_categories_id($category_id)
    {
        $sql = 'SELECT * FROM subcategory
INNER JOIN category ON ref_subcategory_category_id=category_id
WHERE ref_category_app_info_id=' . $this->session->userdata('login_app_id') . ' AND ref_subcategory_category_id=' . $category_id . ' AND subcategory_active=1';

        $result = $this->db->query($sql);
        return $result->result_array();
    }

    /*
     * Function Name: public function get_active_product_list_by_limit($starting_limit)
     * it will return active product list by app id and limit
     */
    public function get_active_product_list_by_limit($starting_limit)
    {
        /*
        $this->db->join('category', 'category_id = ref_product_category_id', 'left');
        $this->db->join('subcategory', 'subcategory_id = ref_product_subcategory_id', 'left');
        $this->db->where('ref_product_app_info_id',$this->session->userdata('login_app_id'));
        $this->db->where('product_active',1);
        $this->db->limit(DEFAULT_DATA_LIMIT,$starting_limit);
        $result=$this->db->get('product');
        return $result->result_array();
        */

        $app_id=$this->session->userdata('login_app_id');
        $sql="SELECT * FROM (SELECT * FROM product 
        WHERE product_active=1 AND ref_product_app_info_id=$app_id order by product_id DESC LIMIT $starting_limit,".DEFAULT_DATA_LIMIT.") as product_list
        LEFT JOIN category ON (category_id = product_list.ref_product_category_id) 
        LEFT JOIN subcategory ON (subcategory_id = product_list.ref_product_subcategory_id)
        LEFT JOIN product_image ON (ref_product_image_product_id=product_list.product_id)
        LEFT JOIN product_attributes ON (ref_product_attributes_product_id=product_list.product_id) 
        ";

       // echo $sql;
        $query=$this->db->query($sql);

        return $query->result_array();


    }

    public function get_all_currency(){
        $result=$this->db->get('currency');
        return $result->result_array();
    }

    public function add_new_product()
    {
        $product_info_array = array(
            'product_unique_id' => 'p_' . date('Y m d h i s'),
            'ref_product_app_info_id' => $this->session->userdata('login_app_id'),
            'ref_product_category_id' => ($this->input->post('product_category') == '') ? NULL : $this->input->post('product_category'),
            'ref_product_subcategory_id' => ($this->input->post('product_subcategory') == '') ?NULL : $this->input->post('product_subcategory'),
            'product_name' => $this->input->post('new_product_title'),
            'product_description' => $this->input->post('new_product_description'),
            'ref_product_currency_id'=>$this->input->post('price_currency'),
            'product_price' => ($this->input->post('product_price') == 'fixed_price') ? $this->input->post('p_fixed_price') : (($this->input->post('product_price') == 'custom_price') ? ($this->input->post('p_custom_price_from') . '-' . $this->input->post('p_custom_price_to')) : 0),
            'product_is_push_notification' => ($this->input->post('push_notification') == 'on') ? 1 : 0,
            'product_created_date_time' => date('Y-m-d h:i:sa'),
            'product_active' => 1,
            'product_last_edited_date_time' => date('Y-m-d h:i:sa'),
        );
        if($this->input->post('display_product')=='custom_p_display_time')
        {
            $product_info_array['product_last_displaying_date']=$this->input->post('p_display_custom_time');
        }
        else if($this->input->post('display_product')=='select_p_display_time')
        {
            $days=$this->input->post('p_display_fixed_time');
            $date=date('Y-m-d');
            $new_display_date=date('Y-m-d',strtotime($date.' + '.$days.' days'));
            $product_info_array['product_last_displaying_date']=$new_display_date;
        }
        if ($this->input->post('product_has_offer') == 'on') {
            $product_info_array['product_has_offer']=1;
            $product_info_array['product_offer_current_price'] = ($this->input->post('offer_product') == 'select_reduce_price') ? $this->input->post('p_price_abs_reduce') : 0;
            $product_info_array['product_offer_price_percentage'] = ($this->input->post('offer_product') == 'custom_reduce_price') ? $this->input->post('p_price_percent_reduce') : 0;
            $product_info_array['product_offer_starting_date_time'] = $this->input->post('p_offer_from');
            $product_info_array['product_offer_ending_date_time'] = $this->input->post('p_offer_to');
        }

        $this->db->trans_start();

        $this->db->insert('product', $product_info_array);
        $product_id = $this->db->insert_id();
        $temp_attr_number = 0;
        if (isset($_POST['product_attr_name'])) {
            foreach ($_POST['product_attr_name'] AS $attr_name) {

                $product_attr_array = array(
                    'ref_product_attributes_product_id' => $product_id,
                    'product_attributes_name' => $attr_name,
                    'product_attributes_values' => $_POST['product_attr_value'][$temp_attr_number],
                    'product_attributes_active' => 1,
                    'product_attributes_created_datetime' => date('Y-m-d h:i:sa'),
                    'product_attributes_last_edited_date_time' => date('Y-m-d h:i:sa'),
                );

                $this->db->insert('product_attributes', $product_attr_array);

                $temp_attr_number++;

            }
        }


        if (isset($_FILES['product_display_image']) && $_FILES['product_display_image']['error'] == 0 && $this->input->post('single_image_deleted_0')==0 ) {
            if (!is_dir('./all_images/product_images/app_id_' . $this->session->userdata('login_app_id'))) {
                mkdir('./all_images/product_images/app_id_' . $this->session->userdata('login_app_id'), 0777, true);
            }
            $this->load->library('upload');
            $file_name = explode('.', $_FILES["product_display_image"]["name"]);
            $file_extension_pos=sizeof($file_name);
            $file_extension =$file_name[$file_extension_pos-1];
            $temp_name = 'p_' . date('Y_m_d_h_i_s') .".". $file_extension;
            $config['upload_path'] = './all_images/product_images/app_id_' . $this->session->userdata('login_app_id');
            $config['allowed_types'] = "jpg|png|gif|jpeg";
            $config['file_name'] = $temp_name;
                $this->upload->initialize($config);
//            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('product_display_image')) {
                $error = array('error' => $this->upload->display_errors());
                print_r($error);
                die();
            } else {
                $product_image_array = array(
                    'ref_product_image_product_id' => $product_id,
                    'product_image_location' => 'all_images/product_images/app_id_' . $this->session->userdata('login_app_id'). '/' . $temp_name,
                    'product_image_is_display' => 1,
                    'product_image_size_kb' => ($_FILES['product_display_image']['size'] / 1000),
                    'product_image_active' => 1,
                    'product_image_uploading_datetime' => date('Y-m-d h:i:sa'),
                    'product_image_last_edited_date_time' => date('Y-m-d h:i:sa')
                );
                $this->db->insert('product_image', $product_image_array);
            }

        }

        if (isset($_FILES['product_image']) && sizeof($_FILES['product_image']['name'])>0) {
            $this->load->library('upload');
            $i=0;
            foreach ($_FILES['product_image']['name'] AS $product_image) {
                if($this->input->post('image_deleted_'.$i)==0)
                {
                    $_FILES["file_select_upload"]["name"] = $_FILES["product_image"]["name"][$i];
                    $_FILES["file_select_upload"]["type"] = $_FILES["product_image"]["type"][$i];
                    $_FILES["file_select_upload"]["tmp_name"] = $_FILES["product_image"]["tmp_name"][$i];
                    $_FILES["file_select_upload"]["error"] = $_FILES["product_image"]["error"][$i];
                    $_FILES["file_select_upload"]["size"] = $_FILES["product_image"]["size"][$i];
                    if($_FILES["file_select_upload"]["error"]==0){
                        if (!is_dir('./all_images/product_images/app_id_' . $this->session->userdata('login_app_id'))) {
                            mkdir('./all_images/product_images/app_id_' . $this->session->userdata('login_app_id'), 0777, true);
                        }
                        $file_name = explode('.', $_FILES['file_select_upload']["name"]);
//                $file_extension = end($file_name);
                        $file_extension_pos=sizeof($file_name);
                        $file_extension =$file_name[$file_extension_pos-1];
                        $temp_name = 'p_'. date('Y_m_d_h_i_s').$i.'.'.$file_extension;
                        $config['upload_path'] = './all_images/product_images/app_id_' . $this->session->userdata('login_app_id');
                        $config['allowed_types'] = "jpg|png|gif|jpeg";
                        $config['file_name'] = $temp_name;
//                print_r($config);die();
                        $this->upload->initialize($config);
//                $this->load->library('upload', $config);
                        if (!$this->upload->do_upload('file_select_upload')) {
                            $error = array('error' => $this->upload->display_errors());
                            print_r($error);
                            die();
                        }
                        else {
                            $product_image_array = array(
                                'ref_product_image_product_id' => $product_id,
                                'product_image_location' => 'all_images/product_images/app_id_' . $this->session->userdata('login_app_id'). '/' . $temp_name,
                                'product_image_is_display' => 0,
                                'product_image_size_kb' => ($_FILES['file_select_upload']['size'] / 1000),
                                'product_image_active' => 1,
                                'product_image_uploading_datetime' => date('Y-m-d h:i:sa'),
                                'product_image_last_edited_date_time' => date('Y-m-d h:i:sa')
                            );
                            $this->db->insert('product_image', $product_image_array);
                        }
                    }
                }


                $i++;
            }
        }


        $this->db->trans_complete();

        if ($this->db->trans_status() == TRUE) {
            return 1;
        } else return 0;



    }



    public function check_product_exist_by_product_id($product_id)
    {
        $this->db->where('product_id',$product_id);
        $this->db->where('ref_product_app_info_id',$this->session->userdata('login_app_id'));
        $result=$this->db->get('product');
        return $result->result_array();

    }



    public function update_product_information_by_product_id($product_id)
    {
        $result=$this->check_product_exist_by_product_id($product_id);
        if(sizeof($result)!=1)
        {
            return -1;
        }
        else
        {
            $this->db->trans_start();
            $product_info_array = array(
                'product_unique_id' => 'p_' . date('Y m d h i s'),
                'ref_product_app_info_id' => $this->session->userdata('login_app_id'),
                'ref_product_category_id' => ($this->input->post('product_category') == '') ? NULL : $this->input->post('product_category'),
                'ref_product_subcategory_id' => ($this->input->post('product_subcategory') == '') ?NULL : $this->input->post('product_subcategory'),
                'product_name' => $this->input->post('new_product_title'),
                'product_description' => $this->input->post('new_product_description'),
                'ref_product_currency_id'=>$this->input->post('price_currency'),
                'product_price' => ($this->input->post('product_price') == 'fixed_price') ? $this->input->post('p_fixed_price') : (($this->input->post('product_price') == 'custom_price') ? ($this->input->post('p_custom_price_from') . '-' . $this->input->post('p_custom_price_to')) : 0),
                'product_is_push_notification' => ($this->input->post('push_notification') == 'on') ? 1 : 0,
                'product_created_date_time' => date('Y-m-d h:i:sa'),
                'product_active' => 1,
                'product_last_edited_date_time' => date('Y-m-d h:i:sa'),
            );
            if($this->input->post('display_product')=='custom_p_display_time')
            {
                $product_info_array['product_last_displaying_date']=$this->input->post('p_display_custom_time');
            }
            else if($this->input->post('display_product')=='select_p_display_time')
            {
                $days=$this->input->post('p_display_fixed_time');
                $date=date('Y-m-d');
                $new_display_date=date('Y-m-d',strtotime($date.' + '.$days.' days'));
                $product_info_array['product_last_displaying_date']=$new_display_date;
            }
            if ($this->input->post('product_has_offer') == 'on') {
                $product_info_array['product_has_offer']=1;
                $product_info_array['product_offer_current_price'] = ($this->input->post('offer_product') == 'select_reduce_price') ? $this->input->post('p_price_abs_reduce') : 0;
                $product_info_array['product_offer_price_percentage'] = ($this->input->post('offer_product') == 'custom_reduce_price') ? $this->input->post('p_price_percent_reduce') : 0;
                $product_info_array['product_offer_starting_date_time'] = $this->input->post('p_offer_from');
                $product_info_array['product_offer_ending_date_time'] = $this->input->post('p_offer_to');
            }
            else
            {
                $product_info_array['product_has_offer']=0;
                $product_info_array['product_offer_current_price'] =NULL;
                $product_info_array['product_offer_price_percentage'] = NULL;
                $product_info_array['product_offer_starting_date_time'] =NULL;
                $product_info_array['product_offer_ending_date_time'] = NULL;
            }



            $this->db->where('product_id',$product_id);
            $this->db->update('product', $product_info_array);
           //*************************************before update attributes***********************//////////////
            $this->db->where('ref_product_attributes_product_id',$product_id);
            $attributes_obj=$this->db->get('product_attributes');
            $attributes=$attributes_obj->result_array();
            $total_attributes=sizeof($attributes);
//            print_r($total_attributes);die();
            //*************************************before update attributes***********************//////////////

            $temp_attr_number = 0;
            $total_new_attributes=0;
            if(isset($_POST['product_attr_name'])){
                $total_new_attributes=sizeof($_POST['product_attr_name']);
            }
//            print_r($total_new_attributes);die();
            if (isset($_POST['product_attr_name'])) {
                foreach ($_POST['product_attr_name'] AS $attr_name) {

                    $product_attr_array = array(
                        'ref_product_attributes_product_id' => $product_id,
                        'product_attributes_name' => $attr_name,
                        'product_attributes_values' => $_POST['product_attr_value'][$temp_attr_number],
                        'product_attributes_active' => 1,
                        'product_attributes_created_datetime' => date('Y-m-d h:i:sa'),
                        'product_attributes_last_edited_date_time' => date('Y-m-d h:i:sa'),
                    );
                    if($temp_attr_number<$total_attributes)
                    {
                        $this->db->where('product_attributes_id',$attributes[$temp_attr_number]['product_attributes_id']);
                        $this->db->update('product_attributes',$product_attr_array);
                    }
                    else
                    {
                        $this->db->insert('product_attributes', $product_attr_array);
                    }

                    $temp_attr_number++;

                }
            }
            if($total_attributes>$total_new_attributes){
                for($i=$temp_attr_number;$i<$total_attributes;$i++){
                    $this->db->where('product_attributes_id',$attributes[$i]['product_attributes_id']);
                    $this->db->delete('product_attributes');
                }
            }


            if (isset($_FILES['product_display_image']) && $_FILES['product_display_image']['error'] == 0 && $this->input->post('single_image_deleted_0')==0 ) {
                if (!is_dir('./all_images/product_images/app_id_' . $this->session->userdata('login_app_id'))) {
                    mkdir('./all_images/product_images/app_id_' . $this->session->userdata('login_app_id'), 0777, true);
                }
                $this->load->library('upload');
                $file_name = explode('.', $_FILES["product_display_image"]["name"]);
                $file_extension_pos=sizeof($file_name);
                $file_extension =$file_name[$file_extension_pos-1];
                $temp_name = 'p_' . date('Y_m_d_h_i_s') .".". $file_extension;
                $config['upload_path'] = './all_images/product_images/app_id_' . $this->session->userdata('login_app_id');
                $config['allowed_types'] = "jpg|png|gif|jpeg";
                $config['file_name'] = $temp_name;
                $this->upload->initialize($config);
//            $this->load->library('upload', $config);
                if (!$this->upload->do_upload('product_display_image')) {
                    $error = array('error' => $this->upload->display_errors());
                    print_r($error);
                    die();
                } else {
                    $product_image_array = array(
                        'ref_product_image_product_id' => $product_id,
                        'product_image_location' => 'all_images/product_images/app_id_' . $this->session->userdata('login_app_id'). '/' . $temp_name,
                        'product_image_is_display' => 1,
                        'product_image_size_kb' => ($_FILES['product_display_image']['size'] / 1000),
                        'product_image_active' => 1,
                        'product_image_uploading_datetime' => date('Y-m-d h:i:sa'),
                        'product_image_last_edited_date_time' => date('Y-m-d h:i:sa')
                    );
                    $this->db->where('ref_product_image_product_id',$product_id);
                    $this->db->where('product_image_is_display',1);
                    $this->db->where('product_image_active',1);
                    $p_result_obj=$this->db->get('product_image');
                    $p_result=$p_result_obj->result_array();
//                    print_r(sizeof($p_result));die();
                    if(sizeof($p_result)>=1){
                        $this->db->where('product_image_id',$p_result[0]['product_image_id']);
                        $this->db->update('product_image',$product_image_array);
                    }
                    else
                    {
                        $this->db->insert('product_image', $product_image_array);
                    }

                }

            }

            if (isset($_FILES['product_image']) && sizeof($_FILES['product_image']['name'])>0) {
                $this->load->library('upload');
                $i=0;
                foreach ($_FILES['product_image']['name'] AS $product_image) {
                    if($this->input->post('image_deleted_'.$i)==0)
                    {
                        $_FILES["file_select_upload"]["name"] = $_FILES["product_image"]["name"][$i];
                        $_FILES["file_select_upload"]["type"] = $_FILES["product_image"]["type"][$i];
                        $_FILES["file_select_upload"]["tmp_name"] = $_FILES["product_image"]["tmp_name"][$i];
                        $_FILES["file_select_upload"]["error"] = $_FILES["product_image"]["error"][$i];
                        $_FILES["file_select_upload"]["size"] = $_FILES["product_image"]["size"][$i];
                        if($_FILES["file_select_upload"]["error"]==0){
                            if (!is_dir('./all_images/product_images/app_id_' . $this->session->userdata('login_app_id'))) {
                                mkdir('./all_images/product_images/app_id_' . $this->session->userdata('login_app_id'), 0777, true);
                            }
                            $file_name = explode('.', $_FILES['file_select_upload']["name"]);
//                $file_extension = end($file_name);
                            $file_extension_pos=sizeof($file_name);
                            $file_extension =$file_name[$file_extension_pos-1];
                            $temp_name = 'p_'. date('Y_m_d_h_i_s').$i.'.'.$file_extension;
                            $config['upload_path'] = './all_images/product_images/app_id_' . $this->session->userdata('login_app_id');
                            $config['allowed_types'] = "jpg|png|gif|jpeg";
                            $config['file_name'] = $temp_name;
//                print_r($config);die();
                            $this->upload->initialize($config);
//                $this->load->library('upload', $config);
                            if (!$this->upload->do_upload('file_select_upload')) {
                                $error = array('error' => $this->upload->display_errors());
                                print_r($error);
                                die();
                            }
                            else {
                                $product_image_array = array(
                                    'ref_product_image_product_id' => $product_id,
                                    'product_image_location' => 'all_images/product_images/app_id_' . $this->session->userdata('login_app_id'). '/' . $temp_name,
                                    'product_image_is_display' => 0,
                                    'product_image_size_kb' => ($_FILES['file_select_upload']['size'] / 1000),
                                    'product_image_active' => 1,
                                    'product_image_uploading_datetime' => date('Y-m-d h:i:sa'),
                                    'product_image_last_edited_date_time' => date('Y-m-d h:i:sa')
                                );
                                $this->db->insert('product_image', $product_image_array);
                            }
                        }
                    }


                    $i++;
                }
            }


            $this->db->trans_complete();

            if ($this->db->trans_status() == TRUE) {
                return 1;
            } else return 0;

        }

    }

    public function delete_product_by_product_id($product_id)
    {

        $result=$this->check_product_exist_by_product_id($product_id);
        if(sizeof($result)==0){
            return -1;
        }
        else{
            $this->db->trans_start();
            $product_array=array(
                'product_active'=>0,
                'product_last_edited_date_time'=>date('Y-m-d h:i:sa'),
            );
            $this->db->where('product_id',$product_id);
            $this->db->update('product',$product_array);
            $product_attr_array=array(
                'product_attributes_active'=>0,
                'product_attributes_last_edited_date_time'=>date('Y-m-d h:i:sa'),
            );
            $this->db->where('ref_product_attributes_product_id',$product_id);
            $this->db->update('product_attributes',$product_attr_array);
            $product_img_array=array(
                'product_image_active'=>0,
                'product_image_last_edited_date_time'=>date('Y-m-d h:i:sa'),
            );
             $this->db->where('ref_product_image_product_id',$product_id);
            $this->db->update('product_image',$product_img_array);
            $this->db->trans_complete();
            if ($this->db->trans_status() == TRUE) {
                return 1;
            }
            else return 0;
        }
    }

    public function get_product_by_id($product_id)
    {
        $result=$this->check_product_exist_by_product_id($product_id);
        if(sizeof($result)<=0)
        {
            return -1;
        }
        else
        {
            $app_id=$this->session->userdata('login_app_id');
            $sql="SELECT * FROM product AS  product_data
        LEFT JOIN category ON (category_id = product_data.ref_product_category_id) 
        LEFT JOIN subcategory ON (subcategory_id = product_data.ref_product_subcategory_id)
        LEFT JOIN product_image ON (ref_product_image_product_id=product_data.product_id)
        LEFT JOIN product_attributes ON (ref_product_attributes_product_id=product_data.product_id) 
        WHERE product_data.product_active=1 AND product_data.ref_product_app_info_id=$app_id AND product_data.product_id=$product_id";

            $result=$this->db->query($sql);
            return $result->result_array();
        }

    }

    public function delete_product_img_by_id($img_id){

        $app_id=$this->session->userdata('login_app_id');
        $sql="SELECT * FROM product_image
INNER JOIN product ON product_id=ref_product_image_product_id
WHERE ref_product_app_info_id=$app_id AND product_image_id=$img_id";
        $result_obj=$this->db->query($sql);
        $result=$result_obj->result_array();

        if(sizeof($result)==1)
        {
            $this->db->trans_start();
            $product_img_array=array(
                'product_image_active'=>0,
            );
            $this->db->where('product_image_id',$img_id);
            $this->db->update('product_image',$product_img_array);
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
        else
        {
            return -1;
        }

    }


}