<?php

/**
 * Created by PhpStorm.
 * User: Uditha Jay
 * Date: 8/25/2016
 * Time: 10:45 AM
 */
class model_insurance extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    function getInsuranceNotAssignedVehicles()
    {
        $this->db->select('vehicle.vehicle_id, vehicle.vehicle_no');
        $this->db->from('vehicle');
        $this->db->join('vehicle_insurance', 'vehicle.vehicle_id = vehicle_insurance.vehicle_id', 'left');

        $array = array('vehicle.vehicle_is_active' => 1, 'vehicle_insurance.vehicle_id' => NULL);
        $this->db->where($array);

        $this->db->order_by('vehicle.vehicle_id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $vehicle_row) {
                $vehicle[$vehicle_row['vehicle_id']] = $vehicle_row['vehicle_no'];
            }
            return $vehicle;
        } else {
            return null;
        }
    }

    function getInsuranceCompanies()
    {
        $this->db->select('ic_id, ic_name');
        $this->db->from('insurance_company');

        $array = array('ic_is_active' => 1);
        $this->db->where($array);

        $this->db->order_by('ic_id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $ic_row) {
                $ic[$ic_row['ic_id']] = $ic_row['ic_name'];
            }
            return $ic;
        } else {
            return null;
        }
    }

    function addVehicleInsurance(){
        $vehicle_id = $this->getIdByVehicleName($this->input->post('insurance_active_vehicle_name'));

        $vehicle_insurance_insert_data = array(
            'vehicle_id' => $vehicle_id,
            'ic_id' => $this->input->post('ic_id'),
            'vi_name' => $this->input->post('vi_name'),
            'vi_from_date' => $this->input->post('vi_from_date'),
            'vi_to_date' => $this->input->post('vi_to_date'),
            'vi_description' => $this->input->post('vi_description'),
            'vi_is_active' => 1
        );

        $insert = $this->db->insert('vehicle_insurance', $vehicle_insurance_insert_data);

        return $insert;
    }

    function getVehicleInsuranceDetails(){
        $this->db->select('*');
        $this->db->from('vw_vehicle_insurance_details');
        $query = $this->db->get();

        return $query;
    }

    function getInsurancedVehicles()
    {
        $this->db->select('vehicle.vehicle_id, vehicle.vehicle_no');
        $this->db->from('vehicle');
        $this->db->join('vehicle_insurance', 'vehicle.vehicle_id = vehicle_insurance.vehicle_id');

        $array = array('vehicle.vehicle_is_active' => 1);
        $this->db->where($array);

        $this->db->order_by('vehicle.vehicle_id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $vehicle_row) {
                $vehicle[$vehicle_row['vehicle_id']] = $vehicle_row['vehicle_no'];
            }
            return $vehicle;
        } else {
            return null;
        }
    }

    function getVehicleInsuranceDetailsByNumber(){
        $vehicle_name = $this->input->post('insuranced_vehicle_name');

        if($vehicle_name == NULL){
            $this->db->select('MAX(vehicle_id) AS MAX');
            $this->db->from('vehicle_insurance');
            $query = $this->db->get();
            foreach ($query->result() as $object) {
                $vehicle_id = $object->MAX;
            }
        }
        else
            $vehicle_id = $this->getIdByVehicleName($vehicle_name);

        if($vehicle_id == NULL){
            $this->db->select('MAX(vehicle_id) AS MAX');
            $this->db->from('vehicle_insurance');
            $query = $this->db->get();
            foreach ($query->result() as $object) {
                $vehicle_id = $object->MAX;
            }
        }


        $this->db->select('*');
        $this->db->from('vehicle_insurance');
        $this->db->join('vehicle', 'vehicle_insurance.vehicle_id = vehicle.vehicle_id', 'left');
        $this->db->where('vehicle_insurance.vehicle_id', $vehicle_id );
        $query = $this->db->get();

        if($query->num_rows()>0){
            return $query->result();
        }
        else{
            return null;
        }
    }

    function updateInsurencedVehicle(){
        $vehicle_insurance_update_data = array(
            'ic_id' => $this->input->post('ic_id'),
            'vi_name' => $this->input->post('vi_name'),
            'vi_from_date' => $this->input->post('vi_from_date'),
            'vi_to_date' => $this->input->post('vi_to_date'),
            'vi_description' => $this->input->post('vi_description')
        );

        $this->db->where('vehicle_id', $this->input->post('vehicle_id'));
        $update = $this->db->update('vehicle_insurance', $vehicle_insurance_update_data);

        return $update;
    }

    function checkEditable()
    {
        $this->db->select('vehicle_id');
        $this->db->from('vehicle_insurance');

        $array = array('vi_is_active' => 1);
        $this->db->where($array);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }









    /**insurance company
     *
     */

    function addInsuranceCompany(){
        $insurance_company_insert_data = array(
            'ic_id' => NULL,
            'ic_name' => $this->input->post('ic_name'),
            'ic_description' => $this->input->post('ic_description'),
            'ic_is_active' => 1
        );

        $insert = $this->db->insert('insurance_company', $insurance_company_insert_data);

        return $insert;
    }






    function searchActiveVehicle($name){
        $this->db->select('vehicle.vehicle_id, vehicle.vehicle_no AS Name');
        $this->db->from('vehicle');
        $this->db->join('vehicle_insurance', 'vehicle.vehicle_id = vehicle_insurance.vehicle_id', 'left');

        $array = array('vehicle.vehicle_is_active' => 1, 'vehicle_insurance.vehicle_id' => NULL);
        $this->db->where($array);

        $this->db->order_by('vehicle.vehicle_id', 'DESC');

        $this->db->like('vehicle_no', $name, 'both');
        return $this->db->get()->result();
    }

    function searchVehicle($name){
        $this->db->like('Name', $name, 'both');
        return $this->db->get('vw_insuranced_vehicle_search')->result();
    }

    function getIdByVehicleName($vehicle_name){
        $this->db->select('vehicle_id');
        $this->db->from('vehicle');
        $this->db->where('vehicle_no', $vehicle_name);
        $query = $this->db->get();

        if($query->num_rows()>0){
            return $query->first_row()->vehicle_id;
        }
        else{
            return null;
        }
    }


    /** custom validation**/

    function vehicleNameExists($key){
        $this->db->where('vehicle_no', $key);
        $result = $this->db->get('vehicle');
        if($result->num_rows() > 0)
            return false;
        else
            return true;
    }

}