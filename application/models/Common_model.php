<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');//setlocale(LC_TIME, 'it_IT');
/*
NAME : Sajed Amed
EMAIL ADDRESS: sajedaiub@gmail.com
*/

class Common_Model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }
    /*******************LOGIN RELATED******************************/

    public function db_login_authentication()
    {
        $return_value=0;//function return value

        //Getting posted values from login page
        $posted_login_user_name=$this->input->post('username');
        $posted_login_password=$this->input->post('password');

        //Checking this username is already exist into db as an user or not
        $query = $this->db->get_where('admin_panel_login', array('admin_panel_login_username' => $posted_login_user_name,'admin_panel_login_active'=>1));
        $total_rows=$query->num_rows();

        if($total_rows!=1)
        {
            $return_value=0;
            return $return_value;
        }

        $login_table_row=$query->row_array();
        $target_login_password_value=$login_table_row['admin_panel_login_password_value'];

        if($this->validate_password($posted_login_password, $target_login_password_value))
        {

            //CREATE LOGIN RELATED SESSION
            $this->session->set_userdata('login', 1);
            $this->session->set_userdata('login_app_id',$login_table_row['ref_admin_panel_login_app_info_id']);
            $this->session->set_userdata('login_user_name',$login_table_row['admin_panel_login_username']);
            $this->session->set_userdata('login_user_id',$login_table_row['admin_panel_login_id']);

            $return_value=1;
        }
        else
        {

            $return_value=0;
        }

        return $return_value;
    }
    /*
    This function is responsible for creating password hash value
    */
    public  function create_hash($password)
    {
        //$this->config->load('login_authentication_constants');
        // format: algorithm:iterations:salt:hash

        $salt = base64_encode(mcrypt_create_iv(PBKDF2_SALT_BYTE_SIZE, MCRYPT_DEV_URANDOM));
        return PBKDF2_HASH_ALGORITHM . ":" . PBKDF2_ITERATIONS . ":" .  $salt . ":" .
            base64_encode($this->pbkdf2(
                PBKDF2_HASH_ALGORITHM,
                $password,
                $salt,
                PBKDF2_ITERATIONS,
                PBKDF2_HASH_BYTE_SIZE,
                true
            ));
    }
    /*
    this function is related with login validation.Just compare with posted password hash value with db password hash value
    */
    private function validate_password($password, $correct_hash)
    {
        //$this->config->load('login_authentication_constants');

        $params = explode(":", $correct_hash);
        if(count($params) < HASH_SECTIONS)
            return false;
        $pbkdf2 = base64_decode($params[HASH_PBKDF2_INDEX]);
        return $this->slow_equals(
            $pbkdf2,
            $this->pbkdf2(
                $params[HASH_ALGORITHM_INDEX],
                $password,
                $params[HASH_SALT_INDEX],
                (int)$params[HASH_ITERATION_INDEX],
                strlen($pbkdf2),
                true
            )
        );
    }
    /*Related with login authentication*/
    private function slow_equals($a, $b)
    {
        $diff = strlen($a) ^ strlen($b);
        for($i = 0; $i < strlen($a) && $i < strlen($b); $i++)
        {
            $diff |= ord($a[$i]) ^ ord($b[$i]);
        }
        return $diff === 0;
    }
    /*Related with login authentication*/
    private function pbkdf2($algorithm, $password, $salt, $count, $key_length, $raw_output = false)
    {
        //$this->config->load('login_authentication_constants');

        $algorithm = strtolower($algorithm);

        if(!in_array($algorithm, hash_algos(), true))
            trigger_error('PBKDF2 ERROR: Invalid hash algorithm.', E_USER_ERROR);

        if($count <= 0 || $key_length <= 0)
            trigger_error('PBKDF2 ERROR: Invalid parameters.', E_USER_ERROR);

        if (function_exists("hash_pbkdf2"))
        {
            // The output length is in NIBBLES (4-bits) if $raw_output is false!
            if (!$raw_output)
            {
                $key_length = $key_length * 2;
            }
            return hash_pbkdf2($algorithm, $password, $salt, $count, $key_length, $raw_output);
        }

        $hash_length = strlen(hash($algorithm, "", true));
        $block_count = ceil($key_length / $hash_length);

        $output = "";
        for($i = 1; $i <= $block_count; $i++)
        {
            // $i encoded as 4 bytes, big endian.
            $last = $salt . pack("N", $i);
            // first iteration
            $last = $xorsum = hash_hmac($algorithm, $last, $password, true);
            // perform the other $count - 1 iterations
            for ($j = 1; $j < $count; $j++)
            {
                $xorsum ^= ($last = hash_hmac($algorithm, $last, $password, true));
            }
            $output .= $xorsum;
        }

        if($raw_output)
            return substr($output, 0, $key_length);
        else
            return bin2hex(substr($output, 0, $key_length));
    }

    /*******************LOGIN RELATED******************************/
    /*
    FUNCTION NAME : get_login_user_id()
    it will return login user name */
    public function get_login_user_id()
    {

        return 1;
    }

    /*
    FUNCTION NAME:get_views_folder_name()
    it will return views folder name ,depends on language
    */
    public function get_views_folder_name()
    {

        return VIEWS_FOLDER_ENGLISH;
    }


    /*
    FUNCTION NAME : custom_pager()
    it will return the paination accordingly to the query */
    public function custom_pager($url,$per_page,$total_rows)
    {

        $this->load->library('pagination');
        $config['base_url'] = $url;
        $config['total_rows'] =$total_rows;
        $config['per_page'] = $per_page;
        $config['use_page_numbers'] = TRUE;
        $config['first_url'] = $url.'1';
        $config['first_link'] = '&laquo;';
        $config['last_link'] = '&raquo;';

        $config['cur_tag_open']='<li><a href="#">';
        $config['cur_tag_close']='</a></li>';
        $config['num_tag_open']='<li>';
        $config['num_tag_close']='</li>';
        $config['next_tag_open']='<li>';
        $config['next_tag_close']='</li>';
        $config['first_tag_open']='<li>';
        $config['first_tag_close']='</li>';
        $config['last_tag_open']='<li>';
        $config['last_tag_close']='</li>';
        $config['prev_tag_open']='<li>';
        $config['prev_tag_close']='</li>';


        $config['full_tag_open'] ='<div class="table-pagination"><nav> <ul class="pagination"> ';//'<ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav></div>';//'</ul>';
        $this->pagination->initialize($config);
        return $this->pagination;
    }


    /*
    FUNCTION NAME : get_all_gcm_device_registration_ids()
    it will return all android device id*/
    public function get_all_gcm_device_registration_ids()
    {
        $this->db->select('app_user_device_id');
        $query=$this->db->get_where('app_user',array('ref_app_user_device_type_id'=>ANDROID_DEVICE_TYPE_ID,'app_user_activation'=>1));
        return $query->result_array();
    }

    /*
    FUNCTION NAME : get_all_iios_device_registration_ids()
    it will return all android device id*/
    public function get_all_ios_device_registration_ids()
    {
        $this->db->select('ios_device_token');
        $query=$this->db->get_where('app_user_ios',array('app_user_ios_active'=>1));
        return $query->result_array();
    }

    /*
    FUNCTION NAME : get_android_device_id_by_app_user_id($app_user_id)
    it will return android device id for a single app user.
    */

    public function get_android_device_id_by_app_user_id($app_user_id)
    {
        $this->db->select('app_user_device_id');
        $query=$this->db->get_where('app_user',array('app_user_id'=>$app_user_id,'ref_app_user_device_type_id'=>ANDROID_DEVICE_TYPE_ID,'app_user_activation'=>1));
        return $query->row_array();
    }

    /*
    FUNCTION NAME : get_ios_device_id_by_app_user_id($app_user_id)
    it will return ios device id for a single app user.
    */

    public function get_ios_device_id_by_app_user_id($app_user_id)
    {
        $this->db->select('ios_device_token');
        $query=$this->db->get_where('app_user_ios',array('ref_app_user_ios_app_user_id'=>$app_user_id));
        $row= $query->row_array();
        return $row['ios_device_token'];
    }

    /*
    function name: get_all_app_user_list_by_name_keyword($q)
    it will return app user name with some details as real time ajax function
    */
    public function get_all_app_user_list_by_name_keyword($q)
    {



        $sql="SELECT * from app_user_details where app_user_first_name LIKE '%$q%' or app_user_last_name LIKE '%$q%'";
        $query=$this->db->query($sql);

        return $query->result_array();




    }



    public function get_randomly_gallery_images()
    {
        $sql="SELECT * FROM image where ref_image_image_album_id!=2 ORDER BY RAND() LIMIT 16";
        $query=$this->db->query($sql);

        return $query->result_array();
    }

    public function get_head_branch_details()
    {
        $return_array=array();

        /*Here we can write a simple query for getting main branch details,
        but we did a simply complex query cause we don't want to take any risk if there are rows more than one main branch.
        It will be never happend,Because we will put a filtering for admin panel.
        But we don't want to take any risk.maybe i am wrong.In Final version, we will look after this.*/
        $sql="SELECT * FROM branch 
		LEFT JOIN branch_customer_care ON (branch.branch_id=branch_customer_care.ref_branch_customer_care_branch_id) 
		LEFT JOIN branch_timetable ON (branch.branch_id=branch_timetable.ref_branch_timetable_branch_id) 
		WHERE branch.is_main_branch=1 
		AND branch.branch_id =(select branch_id from branch where is_main_branch=1 AND branch_edited_date_time=(select max(branch_edited_date_time) from branch where is_main_branch=1))";

        $query=$this->db->query($sql);


        $return_array['total_rows']=$query->num_rows();
        $return_array['rows']=$query->row_array();

        return $return_array;
    }

    /*
    FUNCTION NAME : get_user_device_type($app_user_id)
    it will return device type id.
    */
    public function get_user_device_type($app_user_id)
    {
        $this->db->select('ref_app_user_device_type_id');
        $query=$this->db->get_where('app_user',array('app_user_id'=>$app_user_id));
        $row=$query->row_array();

        return $row['ref_app_user_device_type_id'];

    }

    /*
        FUNCTION NAME : get_unseen_chat_info()
        it will return no of chat which is unseen.
        */
    public function get_unseen_chat_info()
    {
        $sql="select COUNT(chat_is_seen) as seen from chat where chat_is_seen=0";
        $query=$this->db->query($sql);
        $row=$query->row_array();
        return $row['seen'];

    }

    /*
FUNCTION NAME : get_unseen_chat_user_info()
it will return user_info of unseen chat.
*/
    public function get_unseen_chat_user_info()
    {
        $sql="select chat.chat_id,chat.chat_message, chat.ref_chat_app_user_id,chat.chat_message_sending_edited_date_time,
		 IFNULL(CONCAT(app_user_details.app_user_first_name,' ', app_user_details.app_user_last_name),'NOT REGISTERED') AS full_name from chat
		 left join app_user_details on chat.ref_chat_app_user_id=app_user_details.ref_app_user_details_app_user_id
		 where chat.chat_is_seen=0 order by chat.chat_message_sending_edited_date_time desc limit 0,5 ";
        $query=$this->db->query($sql);
        return $query->result_object();
    }


    /*
    FUNCTION NAME :get_android_ios_push_information()
    Description:it will return android ios api_key,url,password for sending push notification.
    */

    function get_android_ios_push_information()
    {
        $query=$this->db->get_where('push_information',array('push_information_activation'=>1));
        return $query->row_array();
    }


    //FOr Forgotten password Link
    function check_user_email_address_for_sending_reset_password_link($email)
    {
        $return_value=0;
        $query=$this->db->get_where('user_details',array('user_details_email'=>$email,'user_details_active'=>1));
        if($query->num_rows()==0)
        {
            $return_value=0;
        }
        else if($query->num_rows()==1)
        {
            $row=$query->row_array();
            $user_id=$row['user_details_id'];
            $this->get_password_reset_link($user_id,$email);
            $return_value=1;
        }
        else if($query->num_rows()>1)
        {
            $return_value=2;
        }
        return $return_value;
    }

    function get_random_string($valid_chars, $length)
    {
        // start with an empty random string
        $random_string = "";
        // count the number of chars in the valid chars string so we know how many choices we have
        $num_valid_chars = strlen($valid_chars);
        // repeat the steps until we've created a string of the right length
        for ($i = 0; $i < $length; $i++)
        {
            // pick a random number from 1 up to the number of valid chars
            $random_pick = mt_rand(1, $num_valid_chars);
            // take the random character out of the string of valid chars
            // subtract 1 from $random_pick because strings are indexed starting at 0, and we started picking at 1
            $random_char = $valid_chars[$random_pick-1];
            // add the randomly-chosen char onto the end of our string so far
            $random_string .= $random_char;
        }
        // return our finished random string
        return $random_string;
    }

    function get_password_reset_link($user_id,$email)
    {
        $this->db->trans_start();

        $valid_chars="AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz1234567890";
        $length=100;
        $random_String=$this->get_random_string($valid_chars, $length);

        $data=array(
            'ref_forgot_password_data_user_details_id'=>$user_id,
            'forgot_password_data_random_string'=>$random_String);

        $this->db->insert('forgot_password_data',$data);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
            return 0;
        }
        else
        {
            //SEND EMAIL To User email Address
            $this->send_email($random_String,$email);
            return 1;
        }
    }

    function send_email($random_String,$email)
    {
        //<p><a href=$password_link>CLICK HERE</a></p>

        $mailacc = "anwar.hossain.suman@gmail.com";//$email;
        $password_link=base_url()."/".$random_String;
        $subject = "SWITCHY PASSWORD";
        $message = "
		<html>
		<head>
		<title>Password</title>
		</head>
		<body>
		</body>
		</html>
		";

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: Noreply <noreply@switchyapp.com>' . "\r\n";

        $mail = mail($mailacc, $subject, $message, $headers);
    }




    //*******************************for this  project**///////////////////////////
    public function is_user_valid($params){
        $sql='SELECT * FROM admin_user WHERE admin_user_active=1 AND admin_user_name="'.$params['admin_user_name'].'" AND admin_user_password_hash_value="'.$params['admin_user_password_hash_value'].'"';
        $result=$this->db->query($sql);
        return $result->row_array();
    }

    public function get_user_all_info_by_user_id($user_id){

        $sql='SELECT * FROM admin_user WHERE admin_user_id='.$user_id;
        $result=$this->db->query($sql);
        return $result->row_array();
    }

    public function is_user_name_valid_for_update($user_name,$user_id){
        $sql='SELECT * FROM admin_user WHERE admin_user_name="'.$user_name.'" AND admin_user_id<>'.$user_id;
        $result=$this->db->query($sql);
        return $result->row_array();
    }

    public function update_admin_user_info_by_user_id($params,$user_id){
        $this->db->where('admin_user_id',$user_id);
        return $this->db->update('admin_user',$params);
    }

    public function is_user_name_valid_for_add($user_name){
        $sql='SELECT * FROM admin_user WHERE admin_user_name="'.$user_name.'"';
        $result=$this->db->query($sql);
        return $result->row_array();
    }

    public function add_new_admin_user($params){
        $this->db->insert('admin_user',$params);
        return $this->db->insert_id();
    }
    public function get_all_admin_user(){
        $sql='SELECT * FROM admin_user WHERE admin_user_active<>-1 AND admin_user_ref_user_type_id<>1';
        $result=$this->db->query($sql);
        return $result->result_array();
    }

    public function get_admin_user_by_mail($email){
        $sql='SELECT * FROM admin_user WHERE admin_user_email_address="'.$email.'" And admin_user_active=1';
        $result=$this->db->query($sql);
        return $result->result_array();
    }

    public function update_admin_user_info_by_user_login_name($params,$user_login_name){
        $this->db->where('admin_user_name',$user_login_name);
        return $this->db->update('admin_user',$params);
    }
    public function get_admin_user_by_mail_and_user_name($email,$user_name){
        $sql='SELECT * FROM admin_user WHERE admin_user_name="'.$user_name.'" AND admin_user_email_address="'.$email.'" And admin_user_active=1';
        $result=$this->db->query($sql);
        return $result->result_array();
    }

    public function get_all_city(){
        $this->db->order_by("cities_name", "asc");
        $result=$this->db->get('cities');
        return $result->result_array();
    }
    public function get_all_marital_status(){
        $this->db->where('marital_status_is_active',1);
        $result=$this->db->get('marital_status');
        return $result->result_array();
    }
    public function get_all_occupation(){
        $this->db->where('occupation_list_is_active',1);
        $result=$this->db->get('occupation_list');
        return $result->result_array();
    }


    public function is_password_match($pass_value,$hash_value)
    {
        $result=$this->validate_password($pass_value,$hash_value);
        return $result;
    }











    /*
    * function name:get_all_countries_details()
    * it will return all countries details
    */
    public function get_all_countries_details()
    {
        $query=$this->db->get('countries');
        return $query->result_array();
    }

    /*
     * Function Name:get_all_states_details()
     * it will return all states names
     */
    public function get_all_states_details()
    {
        $query=$this->db->get('states');
        return $query->result_array();

    }


    /*
    * Function Name:get_all_cities_details()
    * it will return all cities names
    */
    public function get_all_cities_details()
    {
        $query=$this->db->get('cities');
        return $query->result_array();

    }

    /*
     * Function name:get_all_states_by_country_id($country_id)
     * it will return all states details by country id
     */
    public function get_all_states_by_country_id($country_id)
    {
        $query=$this->db->get_where('states',array('states_country_id'=>$country_id));
        return $query->result_array();
    }


    /*
    * Function name:get_all_cities_by_states_id($city_id)
    * it will return all cities details by country id
    */
    public function get_all_cities_by_states_id($state_id)
    {
        $query=$this->db->get_where('cities',array('cities_state_id'=>$state_id));
        return $query->result_array();
    }







}

