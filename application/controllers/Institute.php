<?php

/**
 * Created by PhpStorm.
 * User: Uditha Jay
 * Date: 8/21/2016
 * Time: 5:13 PM
 */
class Institute extends CI_Controller
{
    public function index()
    {
        $this->institute_add();
    }

    public function institute_add(){
        $this->load->library('session');

        $this->load->model('model_institute');

        $this->load->view('home_side_bar');
        $this->load->view('institute/institute_add');
    }

    public function institute_insert_to_db(){
        try {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('institute_name', 'Institute Name', 'max_length[100]|trim|required');
            $this->form_validation->set_rules('institute_description', 'Institute Description', 'max_length[500]|trim');

            if ($this->form_validation->run() == FALSE) {
                $this->load->library('session');
                $this->session->set_flashdata('warning_message', validation_errors());
                $this->institute_add();
            } else {
                $this->load->model('model_institute');

                if ($quary = $this->model_institute->addInstitute()) {
                    $this->load->library('session');
                    $url = $this->session->userdata('url');

                    if($url == '1')
                        $this-> vehicle_add();
                    else if($url == '2')
                        $this-> vehicle_edit();
                }
            }
        }
        catch (mysqli_sql_exception $e){
            $this->institute_add();
        }
    }

    public function vehicle_add()
    {
        $this->load->model('model_vehicle');

        $data['institute_names'] = $this->model_vehicle->getInstitutes();
        $data['registered_institute_names'] = $this->model_vehicle->getRegisteredInstitutes();
        $data['vehicle_types'] = $this->model_vehicle->getVehicleTypes();

        $this->load->view('home_side_bar');
        $this->load->view('vehicle/vehicle_add', $data);
    }

    public function vehicle_edit(){
        $this->load->model('model_vehicle');

        $data['vehicle_details'] = $this->model_vehicle->getVehicleDetalsByNumber();

        $data['vehicle_numbers'] = $this->model_vehicle->getVehicleNumbers();

        $data['institute_names'] = $this->model_vehicle->getInstitutes();
        $data['registered_institute_names'] = $this->model_vehicle->getRegisteredInstitutes();
        $data['vehicle_types'] = $this->model_vehicle->getVehicleTypes();

        $this->load->view('home_side_bar');
        $this->load->view('vehicle/vehicle_edit',$data);
    }
}

