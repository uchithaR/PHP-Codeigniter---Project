<?php

/**
 * Created by PhpStorm.
 * User: Uditha Jay
 * Date: 8/21/2016
 * Time: 5:58 PM
 */
class model_institute extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    function addInstitute(){
        $institute_insert_data = array(
            'institute_id' => NULL,
            'institute_name' => $this->input->post('institute_name'),
            'institute_description' => $this->input->post('institute_description'),
            'institute_is_active' => 1
        );

        $insert = $this->db->insert('institute', $institute_insert_data);

        return $insert;
    }
}