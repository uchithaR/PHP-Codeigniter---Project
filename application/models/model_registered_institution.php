<?php

/**
 * Created by PhpStorm.
 * User: Uditha Jay
 * Date: 8/22/2016
 * Time: 10:51 AM
 */
class model_registered_institution extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    function addRegisteredInstitution(){
        $ri_insert_data = array(
            'ri_id' => NULL,
            'ri_name' => $this->input->post('ri_name'),
            'ri_description' => $this->input->post('ri_description'),
            'ri_is_active' => 1
        );

        $insert = $this->db->insert('registered_institution', $ri_insert_data);

        return $insert;
    }
}