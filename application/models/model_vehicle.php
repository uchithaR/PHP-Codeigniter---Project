<?php

/**
 * Created by PhpStorm.
 * User: Uditha Jay
 * Date: 8/18/2016
 * Time: 4:08 PM
 */
class model_vehicle extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    function getInstitutes(){
        $this->db->select('institute_id, institute_name');
        $this->db->from('institute');
        $this->db->where('institute_is_active', 1 );
        $query = $this->db->get();

        if($query->num_rows()>0){
            //return $query->result();
            foreach($query->result_array() as $institute_row) {
                $institute[$institute_row['institute_id']] = $institute_row['institute_name'];
            }
            return $institute;
        }
        else{
            return null;
        }
    }

    function getRegisteredInstitutes(){
        $this->db->select('ri_id, ri_name');
        $this->db->from('registered_institution');
        $this->db->where('ri_is_active', 1 );
        $query = $this->db->get();

        if($query->num_rows()>0){
            //return $query->result();
            foreach($query->result_array() as $ri_row) {
                $registered_institute[$ri_row['ri_id']] = $ri_row['ri_name'];
            }
            return $registered_institute;
        }
        else{
            return null;
        }
    }

    function getVehicleTypes(){
        $this->db->select('vt_id, vt_name');
        $this->db->from('vehicle_type');
        $this->db->where('vt_is_active', 1 );
        $query = $this->db->get();

        if($query->num_rows()>0){
            foreach($query->result_array() as $vt_row) {
                $vehicle_types[$vt_row['vt_id']] = $vt_row['vt_name'];
            }
            return $vehicle_types;
        }
        else{
            return null;
        }
    }

    function addVehicle(){
        $vehicle_inser_data = array(
            'vehicle_id' => NULL,
            'vehicle_no' => $this->input->post('vehicle_no'),
            'vehicle_file_no' => $this->input->post('file_no'),
            'vehicle_manufacture_year' => $this->input->post('vehicle_manufacture_year'),
            'vehicle_insurance' => $this->input->post('vehicle_insurance'),
            'vehicle_revenue' => $this->input->post('vehicle_revenue'),
            'institute_id' => $this->input->post('institute_id'),
            'ri_id' => $this->input->post('ri_id'),
            'vt_id' => $this->input->post('vt_id'),
            'vehicle_is_active' => 1,
            'vehicle_added_date' => date("Y/m/d")
        );

        $insert = $this->db->insert('vehicle', $vehicle_inser_data);

        return $insert;
    }

    function getVehicleDetails(){
        $this->db->select('*');
        $this->db->from('vw_vehicle_details');
        $query = $this->db->get();

        return $query;

        /**if($query->num_rows()>0){
            return $query;
        }
        else{
            return null;
        }**/
    }

    function getVehicleNumbers(){
        $this->db->select('vehicle_id, vehicle_no');
        $this->db->from('vehicle');
        $this->db->order_by('vehicle_id','DESC');
        $query = $this->db->get();

        if($query->num_rows()>0){
            //return $query->result();
            foreach($query->result_array() as $v_row) {
                $vehicle_numbers[$v_row['vehicle_id']] = $v_row['vehicle_no'];
            }
            return $vehicle_numbers;
        }
        else {
            return null;
        }
    }

    function getVehicleDetalsByNumber(){
        $vehicle_name = $this->input->post('vehicle_name');

        if($vehicle_name == NULL){
            $this->db->select('MAX(vehicle_id) AS MAX');
            $this->db->from('vehicle');
            $query = $this->db->get();
            foreach ($query->result() as $object) {
                $vehicle_id = $object->MAX;
            }
        }
        else
            $vehicle_id = $this->getIdByVehicleName($vehicle_name);

        if($vehicle_id == NULL){
            $this->db->select('MAX(vehicle_id) AS MAX');
            $this->db->from('vehicle');
            $query = $this->db->get();
            foreach ($query->result() as $object) {
                $vehicle_id = $object->MAX;
            }
        }

        $this->db->select('*');
        $this->db->from('vehicle');
        $this->db->where('vehicle_id', $vehicle_id );
        $query = $this->db->get();

        if($query->num_rows()>0){
            return $query->result();
        }
        else{
            return null;
        }
    }

    function updateVehicle(){
        $vehicle_update_data = array(
            'vehicle_no' => $this->input->post('vehicle_no'),
            'vehicle_file_no' => $this->input->post('file_no'),
            'vehicle_manufacture_year' => $this->input->post('vehicle_manufacture_year'),
            'vehicle_insurance' => $this->input->post('vehicle_insurance'),
            'vehicle_revenue' => $this->input->post('vehicle_revenue'),
            'institute_id' => $this->input->post('institute_id'),
            'ri_id' => $this->input->post('ri_id'),
            'vt_id' => $this->input->post('vt_id'),
            'vehicle_is_active' => $this->input->post('vehicle_is_active')
        );

        $this->db->where('vehicle_id', $this->input->post('vehicle_id'));
        $update = $this->db->update('vehicle', $vehicle_update_data);

        return $update;
    }

    function checkEditable()
    {
        $this->db->select('vehicle_id');
        $this->db->from('vehicle');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }












    /**vehicle registration certtificate**/
    function getVehicleNumbersToUploadVRC(){
        $this->db->select('vehicle.vehicle_id, vehicle.vehicle_no');
        $this->db->from('vehicle');
        $this->db->join('vehicle_registration_certificate', 'vehicle.vehicle_id = vehicle_registration_certificate.vehicle_id', 'left');

        $array = array('vehicle.vehicle_is_active' => 1, 'vehicle_registration_certificate.vehicle_id' => NULL);
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

    function uploadVehicleRegistrationCertificate($url){
        $vehicle_name = $this->input->post('vrc_active_vehicle_name');

        $vehicle_id = $this->getIdByActiveVehicleName($vehicle_name);

        $vehicle_registration_certificate = array(
            'vehicle_id' => $vehicle_id,
            'vrc_path' => $url
        );

        $insert = $this->db->insert('vehicle_registration_certificate', $vehicle_registration_certificate);

        return $insert;
    }

    function getVehicleIdToDownloadVehicleRegistrationCertificate(){

        //$query = $this->db->query('SELECT accident.accident_id, concat(vehicle.vehicle_no, \' - \', accident.accident_description) as accidents from accident left join vehicle on accident.vehicle_id=vehicle.vehicle_id left join police_report on accident.accident_id = police_report.accident_id where police_report.accident_id IS NOT NULL');

        $this->db->select('vehicle_registration_certificate.vehicle_id, vehicle.vehicle_no');
        $this->db->from('vehicle_registration_certificate');
        $this->db->join('vehicle', 'vehicle_registration_certificate.vehicle_id = vehicle.vehicle_id', 'left');

        //$array = array('vehicle.vehicle_is_active' => 1, 'police_report.accident_id' => NULL);
        //$this->db->where($array);

        $this->db->order_by('vehicle_registration_certificate.vehicle_id', 'DESC');
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

    function downloadVehicleRegistrationCertificate(){
        $vehicle_name = $this->input->post('vrc_active_vehicle_name2');

        if($vehicle_name == NULL){
            $this->db->select('MAX(vehicle_id) AS MAX');
            $this->db->from('vehicle_registration_certificate');
            $query = $this->db->get();
            foreach ($query->result() as $object) {
                $vehicle_id = $object->MAX;
            }
        }
        else
            $vehicle_id = $this->getIdByActiveVehicleName2($vehicle_name);

        if($vehicle_id == NULL){
            $this->db->select('MAX(vehicle_id) AS MAX');
            $this->db->from('vehicle');
            $query = $this->db->get();
            foreach ($query->result() as $object) {
                $vehicle_id = $object->MAX;
            }
        }


        /**$this->db->select('vehicle_registration_certificate.vehicle_id, vehicle_registration_certificate.vrc_path, vehicle.vehicle_no');
        $this->db->from('vehicle_registration_certificate');

        $this->db->join('vehicle', 'vehicle_registration_certificate.vehicle_id = vehicle.vehicle_id', 'left');

        $array = array('vehicle_registration_certificate.vehicle_id' => $vehicle_id);
        $this->db->where($array);

        $this->db->order_by('vehicle_registration_certificate.vehicle_id', 'DESC');
        $query = $this->db->get(); **/


        $this->db->select('*');
        $this->db->from('vw_vrc_downloadable_vehicle_search');

        $array = array('vehicle_id' => $vehicle_id);
        $this->db->where($array);

        $this->db->order_by('vehicle_id', 'DESC');
        $query = $this->db->get();


        return $query->result();

    }





    function checkDownloadable()
    {
        $this->db->select('vehicle_id');
        $this->db->from('vehicle_registration_certificate');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }





    /** search**/

    function searchVehicle($name){
        $this->db->like('Name', $name, 'both');
        return $this->db->get('vw_vehicle_search')->result();
    }

    function getIdByVehicleName($vehicle_name){
        $this->db->select('vehicle_id');
        $this->db->from('vw_vehicle_search');
        $this->db->where('Name', $vehicle_name);
        $query = $this->db->get();

        if($query->num_rows()>0){
            return $query->first_row()->vehicle_id;
        }
        else{
            return null;
        }
    }


    function activeVehicleSearch($name){
        $this->db->like('Name', $name, 'both');
        return $this->db->get('vw_vrc_active_vehicle_search')->result();
    }

    function getIdByActiveVehicleName($vehicle_name){
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

    function activeVehicleSearch2($name){
        $this->db->like('Name', $name, 'both');
        return $this->db->get('vw_vrc_downloadable_vehicle_search')->result();
    }

    function getIdByActiveVehicleName2($vehicle_name){
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