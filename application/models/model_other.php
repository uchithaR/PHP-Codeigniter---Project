<?php

/**
 * Created by PhpStorm.
 * User: Uditha Jay
 * Date: 8/31/2016
 * Time: 4:40 PM
 */
class model_other extends CI_Model{
    function __construct(){
        parent::__construct();
    }


    function getInstituteDetails(){
        $this->db->select('institute_name AS Institute, institute_description AS Description');
        $this->db->from('institute');
        $query = $this->db->get();

        return $query;
    }


    function getRegisteredInstitutionDetails(){
        $this->db->select('ri_name AS Registered Institution, ri_description AS Description');
        $this->db->from('registered_institution');
        $query = $this->db->get();

        return $query;
    }


    function getVehicleTypeDetails(){
        $this->db->select('vt_name AS Vehicle Type, vt_description AS Description');
        $this->db->from('vehicle_type');
        $query = $this->db->get();

        return $query;
    }


    function getInsuranceCompanyDetails(){
        $this->db->select('ic_name AS Name, ic_description AS Description');
        $this->db->from('insurance_company');
        $query = $this->db->get();

        return $query;
    }


    function getMinisterDesignationDetails(){
        $this->db->select('md_name AS Designation, md_description AS Description');
        $this->db->from('minister_designation');
        $query = $this->db->get();

        return $query;
    }


    function getServiceCenterDetails(){
        $this->db->select('sc_name AS Service Center, sc_description AS Description, sc_contact_person AS \'Contact Person\', sc_title AS \'Contact Person Title\', sc_contact1 AS \'Contact Number 01\', sc_contact2 AS \'Contact Number 02\'');
        $this->db->from('service_centre');
        $query = $this->db->get();

        return $query;
    }

}