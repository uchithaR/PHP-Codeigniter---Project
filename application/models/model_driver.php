<?php

/**
 * Created by PhpStorm.
 * User: Uditha Jay
 * Date: 8/23/2016
 * Time: 10:52 AM
 */
class model_driver extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    function addDriver(){
        $driver = array(
            'driver_id' => NULL,
            'driver_fname' => $this->input->post('driver_fname'),
            'driver_lname' => $this->input->post('driver_lname'),
            'driver_contact1' => $this->input->post('driver_contact1'),
            'driver_contact2' => $this->input->post('driver_contact2'),
            'driver_nic' => $this->input->post('driver_nic'),
            'driver_licence_num' => $this->input->post('driver_licence_num'),
            'driver_emergency_contact' => $this->input->post('driver_emergency_contact'),
            'driver_is_active' => 1
        );

        $insert = $this->db->insert('driver', $driver);

        return $insert;
    }

    function updateDriver(){
        $driver_update_data = array(
            'driver_fname' => $this->input->post('driver_fname'),
            'driver_lname' => $this->input->post('driver_lname'),
            'driver_contact1' => $this->input->post('driver_contact1'),
            'driver_contact2' => $this->input->post('driver_contact2'),
            'driver_nic' => $this->input->post('driver_nic'),
            'driver_licence_num' => $this->input->post('driver_licence_num'),
            'driver_emergency_contact' => $this->input->post('driver_emergency_contact'),
            'driver_is_active' => $this->input->post('driver_is_active')
        );

        $this->db->where('driver_id', $this->input->post('driver_id'));
        $update = $this->db->update('driver', $driver_update_data);

        return $update;
    }

    function getDriverDetails(){
        $this->db->select('*');
        $this->db->from('vw_driver_details');
        $query = $this->db->get();

        return $query;
    }

    function getDrivers(){
        $this->db->select('driver_id, concat(driver_fname, \' \', driver_lname) as driver_name');
        $this->db->from('driver');
        $this->db->order_by('driver_id','DESC');
        $query = $this->db->get();

        if($query->num_rows()>0){
            foreach($query->result_array() as $driver_row) {
                $drivers[$driver_row['driver_id']] = $driver_row['driver_name'];
            }
            return $drivers;
        }
        else {
            return null;
        }
    }

    function getDriversByName(){

        $driver_name = $this->input->post('driver_name');

        if($driver_name == NULL){
            $this->db->select('MAX(driver_id) AS MAX');
            $this->db->from('driver');
            $query = $this->db->get();
            foreach ($query->result() as $object) {
                $driver_id = $object->MAX;
            }
        }
        else
            $driver_id = $this->getIdByDriverName($driver_name);

        if($driver_id == NULL){
            $this->db->select('MAX(driver_id) AS MAX');
            $this->db->from('driver');
            $query = $this->db->get();
            foreach ($query->result() as $object) {
                $driver_id = $object->MAX;
            }
        }

        /**if($driver_id <=0){
            $this->db->select('MAX(driver_id) AS MAX');
            $this->db->from('driver');
            $query = $this->db->get();
            foreach ($query->result() as $object) {
                $driver_id = $object->MAX;
            }
        }**/

        $this->db->select('*');
        $this->db->from('driver');
        $this->db->where('driver_id', $driver_id );
        $query = $this->db->get();

        if($query->num_rows()>0){
            return $query->result();
        }
        else{
            return null;
        }
    }

    function getDriversByName2(){
        $driver_id = $this->input->post('driver_id');
        if($driver_id <=0){
            $this->db->select('MAX(driver_id) AS MAX');
            $this->db->from('driver');
            $query = $this->db->get();
            foreach ($query->result() as $object) {
                $driver_id = $object->MAX;
            }
        }

        $this->db->select('*');
        $this->db->from('driver');
        $this->db->where('driver_id', $driver_id );
        $query = $this->db->get();

        if($query->num_rows()>0){
            return $query->result();
        }
        else{
            return null;
        }
    }

    function checkEditable()
    {
        $this->db->select('driver_id');
        $this->db->from('driver');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function searchDriver($name){
        $this->db->like('Name', $name, 'both');
        return $this->db->get('vw_driver_search')->result();
    }

    function getIdByDriverName($driver_name){
        $this->db->select('driver_id');
        $this->db->from('vw_driver_search');
        $this->db->where('Name', $driver_name);
        $query = $this->db->get();

        if($query->num_rows()>0){
            return $query->first_row()->driver_id;
        }
        else{
            return null;
        }
    }





    /**custom validations**/
    function driverNameExists($key){
        $this->db->where('Name', $key);
        $result = $this->db->get('vw_driver_search');

        if($result->num_rows() > 0)
            return false;
        else
            return true;
    }


}