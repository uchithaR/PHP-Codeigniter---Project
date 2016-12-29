<?php

/**
 * Created by PhpStorm.
 * User: Uditha Jay
 * Date: 8/22/2016
 * Time: 1:23 PM
 */
class model_minister extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function addMinisterDesignation()
    {
        $minister_designation = array(
            'md_id' => NULL,
            'md_name' => $this->input->post('md_name'),
            'md_description' => $this->input->post('md_description'),
            'md_is_active' => 1
        );

        $insert = $this->db->insert('minister_designation', $minister_designation);

        return $insert;
    }

    function addMinister()
    {
        $minister = array(
            'minister_id' => NULL,
            'minister_fname' => $this->input->post('minister_fname'),
            'minister_lname' => $this->input->post('minister_lname'),
            'minister_contact1' => $this->input->post('minister_contact1'),
            'minister_contact2' => $this->input->post('minister_contact2'),
            'md_id' => $this->input->post('md_id'),
            'minister_is_active' => 1
        );

        $insert = $this->db->insert('minister', $minister);

        return $insert;
    }

    function getMinisterDesignations()
    {
        $this->db->select('md_id, md_name');
        $this->db->from('minister_designation');
        $this->db->where('md_is_active', 1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $minister_designation_row) {
                $minister_designation[$minister_designation_row['md_id']] = $minister_designation_row['md_name'];
            }
            return $minister_designation;
        } else {
            return null;
        }
    }


    function getMinisters()
    {
        $this->db->select('minister_id, concat(minister_fname, \' \', minister_lname) as minister_name');
        $this->db->from('minister');
        $this->db->order_by('minister_id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $minister_row) {
                $ministers[$minister_row['minister_id']] = $minister_row['minister_name'];
            }
            return $ministers;
        } else {
            return null;
        }
    }

    function getMinistersByName()
    {
        $minister_name = $this->input->post('minister_name');

        if($minister_name == NULL){
            $this->db->select('MAX(minister_id) AS MAX');
            $this->db->from('minister');
            $query = $this->db->get();
            foreach ($query->result() as $object) {
                $minister_id = $object->MAX;
            }
        }
        else
            $minister_id = $this->getIdByMinisterName($minister_name);

        if($minister_id == NULL){
            $this->db->select('MAX(minister_id) AS MAX');
            $this->db->from('minister');
            $query = $this->db->get();
            foreach ($query->result() as $object) {
                $minister_id = $object->MAX;
            }
        }

        $this->db->select('*');
        $this->db->from('minister');
        $this->db->where('minister_id', $minister_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    function getMinistersByName2()
    {
        $minister_id = $this->input->post('minister_id');
        if ($minister_id <= 0) {
            $this->db->select('MAX(minister_id) AS MAX');
            $this->db->from('minister');
            $query = $this->db->get();
            foreach ($query->result() as $object) {
                $minister_id = $object->MAX;
            }
        }

        $this->db->select('*');
        $this->db->from('minister');
        $this->db->where('minister_id', $minister_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    function updateMinister()
    {
        $minister_update_data = array(
            'minister_fname' => $this->input->post('minister_fname'),
            'minister_lname' => $this->input->post('minister_lname'),
            'minister_contact1' => $this->input->post('minister_contact1'),
            'minister_contact2' => $this->input->post('minister_contact2'),
            'md_id' => $this->input->post('md_id'),
            'minister_is_active' => $this->input->post('minister_is_active')
        );

        $this->db->where('minister_id', $this->input->post('minister_id'));
        $update = $this->db->update('minister', $minister_update_data);

        return $update;
    }

    function checkEditable()
    {
        $this->db->select('minister_id');
        $this->db->from('minister');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function getMinisterDetails()
    {
        $this->db->select('*');
        $this->db->from('vw_minister_details');
        $query = $this->db->get();

        return $query;
    }














    function getDriverAssignedDetails()
    {
        $this->db->select('*');
        $this->db->from('vw_driver_assigned_details');
        $query = $this->db->get();

        return $query;
    }

    //*assign drivers start
    function getNotAssignedMinisters()
    {
        $this->db->select('minister.minister_id, concat(minister_fname, \' \', minister_lname) as minister_name');
        $this->db->from('minister');
        $this->db->join('driver_assigned', 'minister.minister_id = driver_assigned.minister_id', 'left');

        $array = array('minister.minister_is_active' => 1, 'driver_assigned.minister_id' => NULL);
        $this->db->where($array);

        $this->db->order_by('minister.minister_id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $minister_row) {
                $ministers[$minister_row['minister_id']] = $minister_row['minister_name'];
            }
            return $ministers;
        } else {
            return null;
        }
    }

    function getNotAssignedDrivers()
    {
        $this->db->select('driver.driver_id, concat(driver_fname, \' \', driver_lname) as driver_name');
        $this->db->from('driver');
        $this->db->join('driver_assigned', 'driver.driver_id = driver_assigned.driver_id', 'left');

        $array = array('driver.driver_is_active' => 1, 'driver_assigned.driver_id' => NULL);
        $this->db->where($array);

        $this->db->order_by('driver_id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $driver_row) {
                $driver[$driver_row['driver_id']] = $driver_row['driver_name'];
            }
            return $driver;
        } else {
            return null;
        }
    }

    function assignDrivers()
    {
        $minister_id = $this->getIdByMinisterName($this->input->post('driver_not_assigned_minister_name'));
        $driver_id = $this->getIdByDriverName($this->input->post('driver_not_assigned_driver_name'));

        $assign_driver_data = array(
            'minister_id' => $minister_id,
            'driver_id' => $driver_id,
            'da_from_date' => date("Y/m/d"),
            'da_is_active' => 1
        );
        $insert = $this->db->insert('driver_assigned', $assign_driver_data);
        return $insert;
    }
    //*assign drivers end




    //*reassign drivers start
    function getAssignedMinisters()
    {
        $this->db->select('minister.minister_id, concat(minister_fname, \' \', minister_lname) as minister_name');
        $this->db->from('minister');
        $this->db->join('driver_assigned', 'minister.minister_id = driver_assigned.minister_id');

        $array = array('minister.minister_is_active' => 1);
        $this->db->where($array);

        $this->db->order_by('minister.minister_id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $minister_row) {
                $ministers[$minister_row['minister_id']] = $minister_row['minister_name'];
            }
            return $ministers;
        } else {
            return null;
        }
    }

    function getAssignedDrivers()
    {
        $this->db->select('driver.driver_id, concat(driver_fname, \' \', driver_lname) as driver_name');
        $this->db->from('driver');
        $this->db->join('driver_assigned', 'driver.driver_id = driver_assigned.driver_id', 'left');

        $array = array('driver.driver_is_active' => 1, 'driver_assigned.driver_id' => NULL);
        $this->db->where($array);

        $this->db->order_by('driver_id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $driver_row) {
                $driver[$driver_row['driver_id']] = $driver_row['driver_name'];
            }
            return $driver;
        } else {
            return null;
        }
    }

    function reassignDrivers()
    {
        $minister_id = $this->getIdByMinisterName($this->input->post('driver_assigned_minister_name'));
        $driver_id = $this->getIdByDriverName($this->input->post('driver_not_assigned_driver_name2'));

        $assign_driver_data = array(
            'driver_id' => $driver_id,
            'da_from_date' => date("Y/m/d")
        );

        $this->db->where('minister_id', $minister_id);
        $update = $this->db->update('driver_assigned', $assign_driver_data);

        return $update;
    }
    //*reassign drivers end




    //*remove drivers start

    //* call getAssignedMinisters()

    function removeDrivers()
    {
        $minister_id = $this->getIdByMinisterName($this->input->post('driver_assigned_minister_name2'));

        $this->db->where('minister_id', $minister_id);
        $this->db->delete('driver_assigned');

        return 1;
    }
    //*remove drivers end





    function getVehicleAssignedDetails()
    {
        $this->db->select('*');
        $this->db->from('vw_vehicle_assigned_details');
        $query = $this->db->get();

        return $query;
    }

    //*assign vehicles to ministers start

    function getActiveMinisters()
    {
        $this->db->select('minister_id, concat(minister_fname, \' \', minister_lname) as minister_name');
        $this->db->from('minister');

        $array = array('minister.minister_is_active' => 1);
        $this->db->where($array);

        $this->db->order_by('minister_id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $minister_row) {
                $ministers[$minister_row['minister_id']] = $minister_row['minister_name'];
            }
            return $ministers;
        } else {
            return null;
        }
    }

    function getNotAssignedVehicles()
    {
        $this->db->select('vehicle.vehicle_id, vehicle.vehicle_no');
        $this->db->from('vehicle');
        $this->db->join('vehicle_assigned', 'vehicle.vehicle_id = vehicle_assigned.vehicle_id', 'left');

        $array = array('vehicle.vehicle_is_active' => 1, 'vehicle_assigned.vehicle_id' => NULL);
        $this->db->where($array);

        $this->db->order_by('vehicle.vehicle_id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $driver_row) {
                $driver[$driver_row['vehicle_id']] = $driver_row['vehicle_no'];
            }
            return $driver;
        } else {
            return null;
        }
    }

    function assignVehicles(){
        $minister_id = $this->getIdByMinisterName($this->input->post('vehicle_active_minister_name'));
        $vehicle_id = $this->getIdByVehicleName($this->input->post('vehicle_not_assigned_vehicle_name'));

        $assign_vehicle_data = array(
            'vehicle_id' => $minister_id,
            'minister_id' => $vehicle_id,
            'va_from_date' => date("Y/m/d"),
            'va_is_active' => 1
        );
        $insert = $this->db->insert('vehicle_assigned', $assign_vehicle_data);
        return $insert;
    }

    function getAssignedVehicles()
    {
        $this->db->select('vehicle.vehicle_id, vehicle_no');
        $this->db->from('vehicle');
        $this->db->join('vehicle_assigned', 'vehicle.vehicle_id = vehicle_assigned.vehicle_id');

        $array = array('vehicle.vehicle_is_active' => 1);
        $this->db->where($array);

        $this->db->order_by('vehicle_id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $driver_row) {
                $driver[$driver_row['vehicle_id']] = $driver_row['vehicle_no'];
            }
            return $driver;
        } else {
            return null;
        }
    }

    function removeVehicles(){
        $vehicle_id = $this->getIdByVehicleName($this->input->post('vehicle_assigned_vehicle_name'));

        $this->db->where('vehicle_id', $vehicle_id);
        $this->db->delete('vehicle_assigned');

        return 1;
    }

    //*assign vehicles to ministers end






    /** search  */
    function searchMinisters($name){
        $this->db->like('Name', $name, 'both');
        return $this->db->get('vw_minister_search')->result();
    }

    function searchNotAssignedMinisters($name){
        $this->db->select('minister.minister_id, concat(minister_fname, \' \', minister_lname) as Name');
        $this->db->from('minister');
        $this->db->join('driver_assigned', 'minister.minister_id = driver_assigned.minister_id', 'left');

        $array = array('minister.minister_is_active' => 1, 'driver_assigned.minister_id' => NULL);
        $this->db->where($array);

        $this->db->order_by('minister.minister_id', 'DESC');

        $this->db->like('concat(minister_fname, \' \', minister_lname)', $name, 'both');
        return $this->db->get()->result();
    }


    function searchNotAssignedDrivers($name){
        $this->db->select('driver.driver_id, concat(driver_fname, \' \', driver_lname) as Name');
        $this->db->from('driver');
        $this->db->join('driver_assigned', 'driver.driver_id = driver_assigned.driver_id', 'left');

        $array = array('driver.driver_is_active' => 1, 'driver_assigned.driver_id' => NULL);
        $this->db->where($array);

        $this->db->order_by('driver_id', 'DESC');

        $this->db->like('concat(driver_fname, \' \', driver_lname)', $name, 'both');
        return $this->db->get()->result();
    }


    function searchAssignedMinisters($name){
        $this->db->select('minister.minister_id, concat(minister_fname, \' \', minister_lname) as Name');
        $this->db->from('minister');
        $this->db->join('driver_assigned', 'minister.minister_id = driver_assigned.minister_id');

        $array = array('minister.minister_is_active' => 1);
        $this->db->where($array);

        $this->db->order_by('minister.minister_id', 'DESC');

        $this->db->like('concat(minister_fname, \' \', minister_lname)', $name, 'both');
        return $this->db->get()->result();
    }

    function searchActiveMinisters($name){
        $this->db->select('minister_id, concat(minister_fname, \' \', minister_lname) as Name');
        $this->db->from('minister');

        $array = array('minister.minister_is_active' => 1);
        $this->db->where($array);

        $this->db->order_by('minister_id', 'DESC');

        $this->db->like('concat(minister_fname, \' \', minister_lname)', $name, 'both');
        return $this->db->get()->result();
    }

    function searchNotAssignedVehicles($name){
        $this->db->select('vehicle.vehicle_id, vehicle.vehicle_no AS Name');
        $this->db->from('vehicle');
        $this->db->join('vehicle_assigned', 'vehicle.vehicle_id = vehicle_assigned.vehicle_id', 'left');

        $array = array('vehicle.vehicle_is_active' => 1, 'vehicle_assigned.vehicle_id' => NULL);
        $this->db->where($array);

        $this->db->order_by('vehicle.vehicle_id', 'DESC');

        $this->db->like('vehicle.vehicle_no', $name, 'both');
        return $this->db->get()->result();
    }

    function searchAssignedVehicles($name){
        $this->db->select('vehicle.vehicle_id, vehicle_no AS Name');
        $this->db->from('vehicle');
        $this->db->join('vehicle_assigned', 'vehicle.vehicle_id = vehicle_assigned.vehicle_id');

        $array = array('vehicle.vehicle_is_active' => 1);
        $this->db->where($array);

        $this->db->order_by('vehicle_id', 'DESC');

        $this->db->like('vehicle.vehicle_no', $name, 'both');
        return $this->db->get()->result();
    }




    function getIdByMinisterName($minister_name){
        $this->db->select('minister_id');
        $this->db->from('vw_minister_search');
        $this->db->where('Name', $minister_name);
        $query = $this->db->get();

        if($query->num_rows()>0){
            return $query->first_row()->minister_id;
        }
        else{
            return null;
        }
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

    function ministerNameExists($key){
        $this->db->where('Name', $key);
        $result = $this->db->get('vw_minister_details');
        if($result->num_rows() > 0)
            return false;
        else
            return true;
    }

    function driverNameExists($key){
        $this->db->where('Name', $key);
        $result = $this->db->get('vw_driver_search');

        if($result->num_rows() > 0)
            return false;
        else
            return true;
    }

    function vehicleNameExists($key){
        $this->db->where('vehicle_no', $key);
        $result = $this->db->get('vehicle');

        if($result->num_rows() > 0)
            return false;
        else
            return true;
    }





























    function checkDriverAssignedForMinister()
    {
        $this->db->select('minister_id');
        $this->db->from('driver_assigned');
        $this->db->where('minister_id', $this->input->post('minister_id'));
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}