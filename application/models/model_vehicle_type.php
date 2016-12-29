<?php

/**
 * Created by PhpStorm.
 * User: Uditha Jay
 * Date: 8/22/2016
 * Time: 11:07 AM
 */
class model_vehicle_type extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    function addVehicleType(){
        $vehicle_type_insert_data = array(
            'vt_id' => NULL,
            'vt_name' => $this->input->post('vt_name'),
            'vt_description' => $this->input->post('vt_description'),
            'vt_is_active' => 1
        );

        $insert = $this->db->insert('vehicle_type', $vehicle_type_insert_data);

        return $insert;
    }
}