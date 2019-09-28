 <?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Branch_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }


    public function add_new_branch()
    {
        $this->db->trans_start();

        $address=trim($this->input->post('shop_address'));
        $city=trim($this->input->post('city_list'));
        $post_code=trim($this->input->post('post_code'));
        $region=trim($this->input->post('state_list'));
        $country=trim($this->input->post('country_list'));
        $geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.urlencode($address).',+'.urlencode($city).',+'.urlencode($post_code).',+'.urlencode($region).',+'.urlencode($country).'&sensor=false');
        $output= json_decode($geocode); //Store values in variableù

        if($output->status == 'OK')
        {
            $lat = $output->results[0]->geometry->location->lat; //Returns Latitude
            $long = $output->results[0]->geometry->location->lng; // Returns Longitude
            $full_address=$output->results[0]->formatted_address;
        }
        else{
            $lat=0;
            $long=0;
            $full_address=$address.",". $region.",".$city.",".$post_code.",".$country;
        }

        $data=array(
            'ref_branch_app_info_id'=>$this->session->userdata('login_app_id'),
            'branch_title'=>trim($this->input->post('shop_name')),
            'is_main_branch'=>trim($this->input->post('is_main_branch')),
            'branch_reg_no'=>trim($this->input->post('reg_no')),
            'branch_about_us'=>trim($this->input->post('shop_details')),
            'ref_branch_countries_id'=>trim($this->input->post('country_list')),
            'ref_branch_states_id'=>trim($this->input->post('state_list')),
            'ref_branch_cities_id'=>trim($this->input->post('city_list')),
            'branch_address'=>trim($this->input->post('shop_address')),
            'branch_post_code'=>trim($this->input->post('post_code')),
            'branch_full_address'=>$full_address,
            'ref_branch_country_phone_code_country_id'=>trim($this->input->post('phone_code_country_id')),
            'branch_country_phone_code'=>trim($this->input->post('country_phone_code')),
            'branch_contact_number'=>trim($this->input->post('phone_number')),
           // 'branch_fax_number'=>trim($this->input->post()),
            'branch_email_address'=>trim($this->input->post('shop_email')),
            'branch_web_site_link'=>trim($this->input->post('shop_website')),
            'branch_lat_value'=>$lat,
            'branch_long_value'=>$long ,
            'branch_facebook'=>trim($this->input->post('shop_facebook')),
            'branch_linkedin'=>trim($this->input->post('shop_linkedin')),
            'branch_google_plus'=>trim($this->input->post('shop_google_plus')),
            'branch_twitter'=>trim($this->input->post('shop_twitter')),
            'branch_instagram'=>trim($this->input->post('shop_instagram')),
            'branch_created_date_time'=>date('Y-m-d h:i:sa'),
        );


        $this->db->insert('branch',$data);
        $inserted_branch_id=$this->db->insert_id();

        //Time table

        //SATURDAY
        if($this->input->post('h_sat_status')==1)
        {
            if($this->input->post('h_sat_total_slot')==2)
            {
                $sat_time=$this->input->post('h_sat_slot_start_time_1')."-".$this->input->post('h_sat_slot_end_time_1').",".$this->input->post('h_sat_slot_start_time_2')."-".$this->input->post('h_sat_slot_end_time_2');
            }
            else if($this->input->post('h_sat_total_slot')==1)
            {
                $sat_time=$this->input->post('h_sat_slot_start_time_1')."-".$this->input->post('h_sat_slot_end_time_1');
            }
        }
        else
        {
            $sat_time=NULL;
        }

        //SUNDAY
        if($this->input->post('h_sun_status')==1)
        {
            if($this->input->post('h_sun_total_slot')==2)
            {
                $sun_time=$this->input->post('h_sun_slot_start_time_1')."-".$this->input->post('h_sun_slot_end_time_1').",".$this->input->post('h_sun_slot_start_time_2')."-".$this->input->post('h_sun_slot_end_time_2');
            }
            else if($this->input->post('h_sun_total_slot')==1)
            {
                $sun_time=$this->input->post('h_sun_slot_start_time_1')."-".$this->input->post('h_sun_slot_end_time_1');
            }
        }
        else
        {
            $sun_time=NULL;
        }
        //MONDAY
        if($this->input->post('h_mon_status')==1)
        {
            if($this->input->post('h_mon_total_slot')==2)
            {
                $mon_time=$this->input->post('h_mon_slot_start_time_1')."-".$this->input->post('h_mon_slot_end_time_1').",".$this->input->post('h_mon_slot_start_time_2')."-".$this->input->post('h_mon_slot_end_time_2');
            }
            else if($this->input->post('h_mon_total_slot')==1)
            {
                $mon_time=$this->input->post('h_mon_slot_start_time_1')."-".$this->input->post('h_mon_slot_end_time_1');
            }
        }
        else
        {
            $mon_time=NULL;
        }
        //TUESDAY
        if($this->input->post('h_tue_status')==1)
        {
            if($this->input->post('h_tue_total_slot')==2)
            {
                $tue_time=$this->input->post('h_tue_slot_start_time_1')."-".$this->input->post('h_tue_slot_end_time_1').",".$this->input->post('h_tue_slot_start_time_2')."-".$this->input->post('h_tue_slot_end_time_2');
            }
            else if($this->input->post('h_tue_total_slot')==1)
            {
                $tue_time=$this->input->post('h_tue_slot_start_time_1')."-".$this->input->post('h_tue_slot_end_time_1');
            }
        }
        else
        {
            $tue_time=NULL;
        }
        //WEDNESDAY
        if($this->input->post('h_wed_status')==1)
        {
            if($this->input->post('h_wed_total_slot')==2)
            {
                $wed_time=$this->input->post('h_wed_slot_start_time_1')."-".$this->input->post('h_wed_slot_end_time_1').",".$this->input->post('h_wed_slot_start_time_2')."-".$this->input->post('h_wed_slot_end_time_2');
            }
            else if($this->input->post('h_wed_total_slot')==1)
            {
                $wed_time=$this->input->post('h_wed_slot_start_time_1')."-".$this->input->post('h_wed_slot_end_time_1');
            }
        }
        else
        {
            $wed_time=NULL;
        }

        //THURSDAY
        if($this->input->post('h_thurs_status')==1)
        {
            if($this->input->post('h_thurs_total_slot')==2)
            {
                $thurs_time=$this->input->post('h_thurs_slot_start_time_1')."-".$this->input->post('h_thurs_slot_end_time_1').",".$this->input->post('h_thurs_slot_start_time_2')."-".$this->input->post('h_thurs_slot_end_time_2');
            }
            else if($this->input->post('h_thurs_total_slot')==1)
            {
                $thurs_time=$this->input->post('h_thurs_slot_start_time_1')."-".$this->input->post('h_thurs_slot_end_time_1');
            }
        }
        else
        {
            $thurs_time=NULL;
        }

        //FRIDAY
        if($this->input->post('h_fri_status')==1)
        {
            if($this->input->post('h_fri_total_slot')==2)
            {
                $fri_time=$this->input->post('h_fri_slot_start_time_1')."-".$this->input->post('h_fri_slot_end_time_1').",".$this->input->post('h_fri_slot_start_time_2')."-".$this->input->post('h_fri_slot_end_time_2');
            }
            else if($this->input->post('h_fri_total_slot')==1)
            {
                $fri_time=$this->input->post('h_fri_slot_start_time_1')."-".$this->input->post('h_fri_slot_end_time_1');
            }
        }
        else
        {
            $fri_time=NULL;
        }

        $data_time=array(
            'ref_brnach_timetable_branch_id'=>$inserted_branch_id,
            'timetable_type'=>$this->input->post('select_branch_time_table'),
            'is_sat_open'=>$this->input->post('h_sat_status'),
            'sat_time'=>$sat_time,
            'is_sun_open'=>$this->input->post('h_sun_status'),
            'sun_time'=>$sun_time,
            'is_mon_open'=>$this->input->post('h_mon_status'),
            'mon_time'=>$mon_time,
            'is_tues_open'=>$this->input->post('h_tue_status'),
            'tues_time'=>$tue_time,
            'is_wed_open'=>$this->input->post('h_wed_status'),
            'wed_time'=>$wed_time,
            'is_thurs_open'=>$this->input->post('h_thurs_status'),
            'thurs_time'=>$thurs_time,
            'is_fri_open'=>$this->input->post('h_fri_status'),
            'fri_time'=>$fri_time
        );


        $this->db->insert('branch_timetable',$data_time);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)//It will work when $db['default']['db_debug'] = FALSE;if you want to see db error then put true from Config/database.php $db['default']['db_debug'] = TRUE;
        {
            return 0;
        }
        else
        {
            return 1;
        }
    }

    public function get_all_active_branch_list()
    {
        $sql="SELECT * FROM branch left join branch_timetable ON (branch_id=ref_brnach_timetable_branch_id) WHERE ref_branch_app_info_id=".$this->session->userdata('login_app_id')." AND branch_active=1";
        $query=$this->db->query($sql);

        return $query->result_array();
    }

    public function get_branch_details_by_branch_id($branch_id)
    {
        $sql="SELECT * FROM branch 
        left join branch_timetable ON (branch_id=ref_brnach_timetable_branch_id) 
        LEFT JOIN countries ON (ref_branch_countries_id=countries_id)
        LEFT JOIN states ON (ref_branch_states_id=states_id)
        LEFT JOIN cities ON (ref_branch_cities_id=cities_id)
        WHERE ref_branch_app_info_id=".$this->session->userdata('login_app_id')." AND branch_active=1 AND branch_id=".$branch_id;
        $query=$this->db->query($sql);

        return $query->row_array();
    }



    public function update_branch_by_branch_id($branch_id)
    {
        $this->db->trans_start();

        $address=trim($this->input->post('shop_address'));
        $city=trim($this->input->post('city_list'));
        $post_code=trim($this->input->post('post_code'));
        $region=trim($this->input->post('state_list'));
        $country=trim($this->input->post('country_list'));
        $geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.urlencode($address).',+'.urlencode($city).',+'.urlencode($post_code).',+'.urlencode($region).',+'.urlencode($country).'&sensor=false');
        $output= json_decode($geocode); //Store values in variableù

        if($output->status == 'OK')
        {
            $lat = $output->results[0]->geometry->location->lat; //Returns Latitude
            $long = $output->results[0]->geometry->location->lng; // Returns Longitude
            $full_address=$output->results[0]->formatted_address;
        }
        else{
            $lat=0;
            $long=0;
            $full_address=$address.",". $region.",".$city.",".$post_code.",".$country;
        }

        $data=array(
            'ref_branch_app_info_id'=>$this->session->userdata('login_app_id'),
            'branch_title'=>trim($this->input->post('shop_name')),
            'is_main_branch'=>trim($this->input->post('is_main_branch')),
            'branch_reg_no'=>trim($this->input->post('reg_no')),
            'branch_about_us'=>trim($this->input->post('shop_details')),
            'ref_branch_countries_id'=>trim($this->input->post('country_list')),
            'ref_branch_states_id'=>trim($this->input->post('state_list')),
            'ref_branch_cities_id'=>trim($this->input->post('city_list')),
            'branch_address'=>trim($this->input->post('shop_address')),
            'branch_post_code'=>trim($this->input->post('post_code')),
            'branch_full_address'=>$full_address,
            'ref_branch_country_phone_code_country_id'=>trim($this->input->post('phone_code_country_id')),
            'branch_country_phone_code'=>trim($this->input->post('country_phone_code')),
            'branch_contact_number'=>trim($this->input->post('phone_number')),
            // 'branch_fax_number'=>trim($this->input->post()),
            'branch_email_address'=>trim($this->input->post('shop_email')),
            'branch_web_site_link'=>trim($this->input->post('shop_website')),
            'branch_lat_value'=>$lat,
            'branch_long_value'=>$long ,
            'branch_facebook'=>trim($this->input->post('shop_facebook')),
            'branch_linkedin'=>trim($this->input->post('shop_linkedin')),
            'branch_google_plus'=>trim($this->input->post('shop_google_plus')),
            'branch_twitter'=>trim($this->input->post('shop_twitter')),
            'branch_instagram'=>trim($this->input->post('shop_instagram')),
            'branch_created_date_time'=>date('Y-m-d h:i:sa'),
        );


        $this->db->where('branch_id', $branch_id);
        $this->db->where('ref_branch_app_info_id', $this->session->userdata('login_app_id'));
        $this->db->update('branch', $data);

        //Time table

        //SATURDAY
        if($this->input->post('h_sat_status')==1)
        {
            if($this->input->post('h_sat_total_slot')==2)
            {
                $sat_time=$this->input->post('h_sat_slot_start_time_1')."-".$this->input->post('h_sat_slot_end_time_1').",".$this->input->post('h_sat_slot_start_time_2')."-".$this->input->post('h_sat_slot_end_time_2');
            }
            else if($this->input->post('h_sat_total_slot')==1)
            {
                $sat_time=$this->input->post('h_sat_slot_start_time_1')."-".$this->input->post('h_sat_slot_end_time_1');
            }
        }
        else
        {
            $sat_time=NULL;
        }

        //SUNDAY
        if($this->input->post('h_sun_status')==1)
        {
            if($this->input->post('h_sun_total_slot')==2)
            {
                $sun_time=$this->input->post('h_sun_slot_start_time_1')."-".$this->input->post('h_sun_slot_end_time_1').",".$this->input->post('h_sun_slot_start_time_2')."-".$this->input->post('h_sun_slot_end_time_2');
            }
            else if($this->input->post('h_sun_total_slot')==1)
            {
                $sun_time=$this->input->post('h_sun_slot_start_time_1')."-".$this->input->post('h_sun_slot_end_time_1');
            }
        }
        else
        {
            $sun_time=NULL;
        }
        //MONDAY
        if($this->input->post('h_mon_status')==1)
        {
            if($this->input->post('h_mon_total_slot')==2)
            {
                $mon_time=$this->input->post('h_mon_slot_start_time_1')."-".$this->input->post('h_mon_slot_end_time_1').",".$this->input->post('h_mon_slot_start_time_2')."-".$this->input->post('h_mon_slot_end_time_2');
            }
            else if($this->input->post('h_mon_total_slot')==1)
            {
                $mon_time=$this->input->post('h_mon_slot_start_time_1')."-".$this->input->post('h_mon_slot_end_time_1');
            }
        }
        else
        {
            $mon_time=NULL;
        }
        //TUESDAY
        if($this->input->post('h_tue_status')==1)
        {
            if($this->input->post('h_tue_total_slot')==2)
            {
                $tue_time=$this->input->post('h_tue_slot_start_time_1')."-".$this->input->post('h_tue_slot_end_time_1').",".$this->input->post('h_tue_slot_start_time_2')."-".$this->input->post('h_tue_slot_end_time_2');
            }
            else if($this->input->post('h_tue_total_slot')==1)
            {
                $tue_time=$this->input->post('h_tue_slot_start_time_1')."-".$this->input->post('h_tue_slot_end_time_1');
            }
        }
        else
        {
            $tue_time=NULL;
        }
        //WEDNESDAY
        if($this->input->post('h_wed_status')==1)
        {
            if($this->input->post('h_wed_total_slot')==2)
            {
                $wed_time=$this->input->post('h_wed_slot_start_time_1')."-".$this->input->post('h_wed_slot_end_time_1').",".$this->input->post('h_wed_slot_start_time_2')."-".$this->input->post('h_wed_slot_end_time_2');
            }
            else if($this->input->post('h_wed_total_slot')==1)
            {
                $wed_time=$this->input->post('h_wed_slot_start_time_1')."-".$this->input->post('h_wed_slot_end_time_1');
            }
        }
        else
        {
            $wed_time=NULL;
        }

        //THURSDAY
        if($this->input->post('h_thurs_status')==1)
        {
            if($this->input->post('h_thurs_total_slot')==2)
            {
                $thurs_time=$this->input->post('h_thurs_slot_start_time_1')."-".$this->input->post('h_thurs_slot_end_time_1').",".$this->input->post('h_thurs_slot_start_time_2')."-".$this->input->post('h_thurs_slot_end_time_2');
            }
            else if($this->input->post('h_thurs_total_slot')==1)
            {
                $thurs_time=$this->input->post('h_thurs_slot_start_time_1')."-".$this->input->post('h_thurs_slot_end_time_1');
            }
        }
        else
        {
            $thurs_time=NULL;
        }

        //FRIDAY
        if($this->input->post('h_fri_status')==1)
        {
            if($this->input->post('h_fri_total_slot')==2)
            {
                $fri_time=$this->input->post('h_fri_slot_start_time_1')."-".$this->input->post('h_fri_slot_end_time_1').",".$this->input->post('h_fri_slot_start_time_2')."-".$this->input->post('h_fri_slot_end_time_2');
            }
            else if($this->input->post('h_fri_total_slot')==1)
            {
                $fri_time=$this->input->post('h_fri_slot_start_time_1')."-".$this->input->post('h_fri_slot_end_time_1');
            }
        }
        else
        {
            $fri_time=NULL;
        }

        $data_time=array(
            'ref_brnach_timetable_branch_id'=>$branch_id,
            'timetable_type'=>$this->input->post('select_branch_time_table'),
            'is_sat_open'=>$this->input->post('h_sat_status'),
            'sat_time'=>$sat_time,
            'is_sun_open'=>$this->input->post('h_sun_status'),
            'sun_time'=>$sun_time,
            'is_mon_open'=>$this->input->post('h_mon_status'),
            'mon_time'=>$mon_time,
            'is_tues_open'=>$this->input->post('h_tue_status'),
            'tues_time'=>$tue_time,
            'is_wed_open'=>$this->input->post('h_wed_status'),
            'wed_time'=>$wed_time,
            'is_thurs_open'=>$this->input->post('h_thurs_status'),
            'thurs_time'=>$thurs_time,
            'is_fri_open'=>$this->input->post('h_fri_status'),
            'fri_time'=>$fri_time
        );

        $this->db->where('ref_brnach_timetable_branch_id', $branch_id);
        $this->db->update('branch_timetable', $data_time);


        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)//It will work when $db['default']['db_debug'] = FALSE;if you want to see db error then put true from Config/database.php $db['default']['db_debug'] = TRUE;
        {
            return 0;
        }
        else
        {
            return 1;
        }
    }
}