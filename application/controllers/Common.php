<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

            $this->load->model('Common_model');

    }

    public function index(){
        echo 'NO path To go';
    }

    public function for_ajax_get_all_states_by_country_id(){
        header('Access-Control-Allow-Origin: *');
        header("Content-Type: application/json");

		print(json_encode($this->Common_model->get_all_states_by_country_id($this->input->post('country_id'))));


    }

    public function for_ajax_get_all_cities_by_state_id(){
        header('Access-Control-Allow-Origin: *');
        header("Content-Type: application/json");

        print(json_encode($this->Common_model->get_all_cities_by_states_id($this->input->post('state_id'))));


    }
}