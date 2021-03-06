<?php

/**
 * Created by PhpStorm.
 * User: Uditha Jay
 * Date: 8/22/2016
 * Time: 10:57 AM
 */
class Registered_institution extends CI_Controller
{
    public function index()
    {
        $this->registered_institution_add();
    }

    public function registered_institution_add(){
        $this->load->library('session');

        $this->load->model('model_registered_institution');

        $this->load->view('home_side_bar');
        $this->load->view('registered_institution/registered_institution_add');
    }

    public function registered_institution_insert_to_db(){
        try {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('ri_name', 'Registered Institution Name', 'max_length[100]|trim|required');
            $this->form_validation->set_rules('ri_description', 'Registered Institution Description', 'max_length[500]|trim');

            if ($this->form_validation->run() == FALSE) {
                $this->load->library('session');
                $this->session->set_flashdata('warning_message', validation_errors());
                $this->registered_institution_add();
            } else {
                $this->load->model('model_registered_institution');

                if ($quary = $this->model_registered_institution->addRegisteredInstitution()) {
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
            $this->registered_institution_add();
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