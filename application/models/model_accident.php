<?php

/**
 * Created by PhpStorm.
 * User: Uditha Jay
 * Date: 8/25/2016
 * Time: 3:36 PM
 */
class model_accident extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    function getVehicleNumbers(){
        $this->db->select('vehicle_id, vehicle_no');
        $this->db->from('vehicle');
        $this->db->where('vehicle_is_active', 1);
        $this->db->order_by('vehicle_id','DESC');
        $query = $this->db->get();

        if($query->num_rows()>0){
            foreach($query->result_array() as $v_row) {
                $vehicle_numbers[$v_row['vehicle_id']] = $v_row['vehicle_no'];
            }
            return $vehicle_numbers;
        }
        else {
            return null;
        }
    }

    function getServiceCenters(){
        $this->db->select('sc_id, sc_name');
        $this->db->from('service_centre');
        $this->db->where('sc_is_active', 1);
        $this->db->order_by('sc_id','DESC');
        $query = $this->db->get();

        if($query->num_rows()>0){
            foreach($query->result_array() as $v_row) {
                $vehicle_numbers[$v_row['sc_id']] = $v_row['sc_name'];
            }
            return $vehicle_numbers;
        }
        else {
            return null;
        }
    }

    function addAccident(){
        $vehicle_id = $this->getIdByVehicleName($this->input->post('accident_active_vehicle_name'));

        $accident = array(
            'accident_id' => NULL,
            'accident_description' => $this->input->post('accident_description'),
            'accident_onthespot' => $this->input->post('accident_onthespot'),
            'accident_insurance_no' => $this->input->post('accident_insurance_no'),
            'vehicle_id' => $vehicle_id,
            'sc_id' => $this->input->post('sc_id'),
            'accident_date' => $this->input->post('accident_date')
        );

        $insert = $this->db->insert('accident', $accident);

        return $insert;
    }

    function getVehicleAccidentDetails(){
        $this->db->select('*');
        $this->db->from('vw_vehicle_accident_details');
        $query = $this->db->get();

        return $query;
    }








    /** service center */

    function addServiceCenter(){
        $service_centre = array(
            'sc_id' => NULL,
            'sc_name' => $this->input->post('sc_name'),
            'sc_description' => $this->input->post('sc_description'),
            'sc_contact_person' => $this->input->post('sc_contact_person'),
            'sc_title' => $this->input->post('sc_title'),
            'sc_contact1' => $this->input->post('sc_contact1'),
            'sc_contact2' => $this->input->post('sc_contact2'),
            'sc_added_date' => date("Y/m/d"),
            'sc_is_active' => 1
        );

        $insert = $this->db->insert('service_centre', $service_centre);

        return $insert;
    }





    /** police report */
    function getAccidentIdToUploadPoliceReport(){
        $this->db->select('accident.accident_id, concat(vehicle.vehicle_no, \' - \', accident.accident_description) as accidents');
        $this->db->from('accident');
        $this->db->join('vehicle', 'accident.vehicle_id = vehicle.vehicle_id', 'left');
        $this->db->join('police_report', 'police_report.accident_id = accident.accident_id', 'left');

        $array = array('vehicle.vehicle_is_active' => 1, 'police_report.accident_id' => NULL);
        $this->db->where($array);

        $this->db->order_by('accident.accident_id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $vehicle_row) {
                $vehicle[$vehicle_row['accident_id']] = $vehicle_row['accidents'];
            }
            return $vehicle;
        } else {
            return null;
        }
    }

    function uploadPoliceReport($url){
        $accident_id = $this->getIdByAprAccident($this->input->post('apr_accident_name'));

        $police_report = array(
            'accident_id' => $accident_id,
            'pr_path' => $url
        );

        $insert = $this->db->insert('police_report', $police_report);

        return $insert;
    }




    function getAccidentIdToDownloadPoliceReport(){
        /**$this->db->select('accident.accident_id, concat(vehicle.vehicle_no, \' - \', accident.accident_description) as accidents');
        $this->db->from('accident');
        $this->db->join('vehicle', 'accident.vehicle_id = vehicle.vehicle_id', 'left');
        $this->db->join('police_report', 'police_report.accident_id = accident.accident_id', 'left');

        $array = array('police_report.accident_id' => !NULL);
        $this->db->where($array);

        $this->db->order_by('accident.accident_id', 'DESC');
        $query = $this->db->get();**/

        $query = $this->db->query('SELECT accident.accident_id, concat(vehicle.vehicle_no, \' - \', accident.accident_description) as accidents from accident left join vehicle on accident.vehicle_id=vehicle.vehicle_id left join police_report on accident.accident_id = police_report.accident_id where police_report.accident_id IS NOT NULL');


        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $vehicle_row) {
                $vehicle[$vehicle_row['accident_id']] = $vehicle_row['accidents'];
            }
            return $vehicle;
        } else {
            return null;
        }
    }

    function downloadPoliceReport(){
        $accident_name = $this->input->post('apr_accident_name2');

        if($accident_name == NULL){
            $this->db->select('MAX(accident_id) AS MAX');
            $this->db->from('police_report');
            $query = $this->db->get();
            foreach ($query->result() as $object) {
                $accident_id = $object->MAX;
            }
        }
        else
            $accident_id = $this->getIdByDownloadableAprAccident($accident_name);

        if($accident_id == NULL){
            $this->db->select('MAX(accident_id) AS MAX');
            $this->db->from('police_report');
            $query = $this->db->get();
            foreach ($query->result() as $object) {
                $accident_id = $object->MAX;
            }
        }

        $this->db->select('police_report.accident_id, police_report.pr_path, CONCAT(vehicle.vehicle_no, \' - \', accident.accident_description) AS \'Name\'');
        $this->db->from('police_report');

        $this->db->join('accident', 'police_report.accident_id = accident.accident_id', 'left');
        $this->db->join('vehicle', 'accident.vehicle_id = vehicle.vehicle_id', 'left');

        $array = array('police_report.accident_id' => $accident_id);
        $this->db->where($array);

        $this->db->order_by('police_report.accident_id', 'DESC');
        $query = $this->db->get();


        return $query->result();

    }

    function checkDownloadable()
    {
        $this->db->select('accident_id');
        $this->db->from('police_report');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }






    /** accident search */
    function searchActiveVehicles($name){
        $this->db->select('vehicle_id, vehicle_no as Name');
        $this->db->from('vehicle');

        $array = array('vehicle.vehicle_is_active' => 1);
        $this->db->where($array);

        $this->db->order_by('vehicle_id', 'DESC');

        $this->db->like('vehicle_no', $name, 'both');
        return $this->db->get()->result();
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


    function aprAccident($name){
        $this->db->like('Name', $name, 'both');
        return $this->db->get('vw_apr_accident_search')->result();
    }

    function getIdByAprAccident($accident_name){
        $this->db->select('accident_id');
        $this->db->from('vw_apr_accident_search');
        $this->db->where('Name', $accident_name);
        $query = $this->db->get();

        if($query->num_rows()>0){
            return $query->first_row()->accident_id;
        }
        else{
            return null;
        }
    }



    function aprDownloadableAccident($name){
        $this->db->like('Name', $name, 'both');
        return $this->db->get('vw_apr_downloadable_accident_search')->result();
    }

    function getIdByDownloadableAprAccident($accident_name){
        $this->db->select('accident_id');
        $this->db->from('vw_apr_downloadable_accident_search');
        $this->db->where('Name', $accident_name);
        $query = $this->db->get();

        if($query->num_rows()>0){
            return $query->first_row()->accident_id;
        }
        else{
            return null;
        }
    }




    /**custom validations**/

    function vehicleNameExists($key){
        $this->db->where('vehicle_no', $key);
        $result = $this->db->get('vehicle');

        if($result->num_rows() > 0)
            return false;
        else
            return true;
    }

    function accidentNameExists($key){
        $this->db->where('Name', $key);
        $result = $this->db->get('vw_accident_validation');

        if($result->num_rows() > 0)
            return false;
        else
            return true;
    }


}