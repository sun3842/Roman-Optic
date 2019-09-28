<?php defined('BASEPATH') OR exit ('No direct script acces allowed');

Class Job_model extends CI_Model
{


    function __construct()
    {
        $this->load->database();
    }


    public function get_all_currency_name()
    {

        $result=$this->db->get('currency');
        return $result->result_array();


    }

    public function get_all_jobs_position()
    {

        $sql = "SELECT * FROM job_position where job_position_active = 1";

        $result = $this->db->query($sql);
        return $result->result_array();

    }

    public function get_all_employment_status()
    {

        $sql = "SELECT * FROM employment_status where employment_status_active = 1";

        $result = $this->db->query($sql);
        return $result->result_array();

    }

    public function add_job_info()
    {
       $this->db->trans_start();

       $app_id = $this->session->userdata('login_app_id');

       $job_info = array(

           'ref_jobs_app_info_id' => $app_id,
           'ref_jobs_employment_status_id' => $this->input->post('employment_status'),
           'ref_jobs_position_id' => $this->input->post('job_position'),
           'ref_jobs_currency_id' => $this->input->post('currency_name'),
           'jobs_title' => $this->input->post('job_title'),
           'jobs_context' => $this->input->post('job_context'),
           'jobs_educational_requirement' => $this->input->post('job_edu_req'),
           'jobs_experiences_requirement' => $this->input->post('job_exp_req'),
           'jobs_location' => $this->input->post('job_location'),
           'jobs_salary_negotiable' => isset($_POST['salary_neg']) ? 1 : 0 ,
           'jobs_salary_range' => $this->input->post('select_salary_limit'),
           'jobs_deadline_date' => $this->input->post('choose_deadtime'),
           'jobs_active' => 1

       );

       $this->db->insert('jobs',$job_info);

       $this->db->trans_complete();
        if ($this->db->trans_status() == TRUE) {
            return 1;
        } else {
            return 0;
        }
    }

    public function get_job_details()
    {
        $app_id  = $this->session->userdata('login_app_id');

        $sql = "SELECT * from jobs LEFT JOIN job_position ON (ref_jobs_position_id = job_position_id)
                LEFT JOIN employment_status ON (ref_jobs_employment_status_id = employment_status_id)
                LEFT JOIN currency ON ref_jobs_currency_id = currency_id where ref_jobs_app_info_id = $app_id AND job_position_active = 1 AND employment_status_active = 1 AND jobs_active = 1";

        $result = $this->db->query($sql);
        return $result->result_array();
    }

    public function update_job_details_by_id($jobs_id)
    {
        $this->db->trans_start();


        $updated_job_info = array
        (
            'ref_jobs_app_info_id' => $this->session->userdata('login_app_id'),
            'ref_jobs_employment_status_id' => $this->input->post('employment_status'),
            'ref_jobs_position_id' => $this->input->post('job_position'),
            'ref_jobs_currency_id' => $this->input->post('currency_name'),
            'jobs_title' => $this->input->post('job_title'),
            'jobs_context' => $this->input->post('job_context'),
            'jobs_educational_requirement' => $this->input->post('job_edu_req'),
            'jobs_experiences_requirement' => $this->input->post('job_exp_req'),
            'jobs_location' => $this->input->post('job_location'),
            'jobs_salary_negotiable' => isset($_POST['salary_neg']) ? 1 : 0 ,
            'jobs_salary_range' => $this->input->post('select_salary_limit'),
            'jobs_deadline_date' => $this->input->post('choose_deadtime'),
            'jobs_active' => 1

        );

        $this->db->where('jobs_id', $jobs_id);
        $this->db->where('ref_jobs_app_info_id', $this->session->userdata('login_app_id'));
        $this->db->where('jobs_active', 1);
        $this->db->update('jobs', $updated_job_info);

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

    public function get_job_data_by_id($jobs_id)
    {
        $app_id = $this->session->userdata('login_app_id');
        $sql = "SELECT * from jobs LEFT JOIN job_position ON (ref_jobs_position_id = job_position_id)
                LEFT JOIN employment_status ON (ref_jobs_employment_status_id = employment_status_id)
                LEFT JOIN currency ON ref_jobs_currency_id = currency_id where ref_jobs_app_info_id = $app_id AND job_position_active = 1 AND employment_status_active = 1 AND jobs_id = $jobs_id";
        $result = $this->db->query($sql);
        return $result->row_array();
    }

    public function check_job_exist_by_job_id($jobs_id)
    {
        $this->db->where('jobs_id', $jobs_id);
        $this->db->where('ref_jobs_app_info_id', $this->session->userdata('login_app_id'));
        $result = $this->db->get('jobs');
        return $result->result_array();
    }

    public function delete_job_by_job_id($jobs_id)
    {
        $result = $this->check_job_exist_by_job_id($jobs_id);
        if (sizeof($result) == 0) {
            return -1;
        } else {
            $this->db->trans_start();

            $job_info = array(
                'jobs_active' => 0,

            );

            $this->db->where('jobs_id', $jobs_id);
            $this->db->update('jobs', $job_info);

            $this->db->trans_complete();
            if ($this->db->trans_status() == TRUE) {
                return 1;
            } else return 0;
        }
    }


}