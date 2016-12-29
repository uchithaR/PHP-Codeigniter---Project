<?php

/**
 * Created by PhpStorm.
 * User: Uditha Jay
 * Date: 8/29/2016
 * Time: 11:33 PM
 */
class model_payment extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getActiveVehicles()
    {
        $this->db->select('vehicle_id, vehicle_no');
        $this->db->from('vehicle');

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

    function addPayment(){
        $vehicle_id = $this->getIdByVehicleName($this->input->post('payment_vehicle_name'));

        $payment = array(
            'payment_id' => NULL,
            'payment_file_no' => $this->input->post('payment_file_no'),
            'payment_occurred_date' => $this->input->post('payment_occurred_date'),
            'payment_description    ' => $this->input->post('payment_description'),
            'payment_bill_date' => $this->input->post('payment_bill_date'),
            'payment_vehicle_mileage' => $this->input->post('payment_vehicle_mileage'),
            'payment_invoice_no' => $this->input->post('payment_invoice_no'),
            'payment_amount' => $this->input->post('payment_amount'),
            'payment_voucher_given' => $this->input->post('payment_voucher_given'),
            'payment_paidby_check' => $this->input->post('payment_paidby_check'),
            'vehicle_id' => $vehicle_id,
            'sc_id' => $this->input->post('sc_id'),
            'payment_voucher_given' => 0,
            'payment_paidby_check' => 0,

        );

        $insert = $this->db->insert('payment', $payment);

        return $insert;
    }

    function getPaymentDetails(){
        $this->db->select('*');
        $this->db->from('vw_payment_details');
        $query = $this->db->get();

        return $query;
    }




    /**payment voucher **/
    function addPaymentVoucher(){
        $payment_id = $this->getIdByPaymentName($this->input->post('payment_name'));
        $payment_voucher = array(
            'payment_id' => $payment_id,
            'pv_voucher_no' => $this->input->post('pv_voucher_no'),
            'pv_submitted_date' => $this->input->post('pv_submitted_date')
        );

        $insert = $this->db->insert('payment_voucher', $payment_voucher);

        $payment_update_data = array(
            'payment_voucher_given' => 1
        );

        $this->db->where('payment_id', $payment_id);
        $update = $this->db->update('payment', $payment_update_data);

        return $insert;
    }



    /**payment cheque **/
    function addPaymentCheque(){
        $payment_id = $this->getIdByPaymentVoucherName($this->input->post('payment_voucher_name'));
        $payment_cheque = array(
            'payment_id' => $payment_id,
            'pc_cheque_no' => $this->input->post('pc_cheque_no'),
            'pc_date' => $this->input->post('pc_date')
        );

        $insert = $this->db->insert('payment_cheque', $payment_cheque);

        $payment_update_data = array(
            'payment_paidby_check' => 1
        );

        $this->db->where('payment_id', $payment_id);
        $update = $this->db->update('payment', $payment_update_data);

        return $insert;
    }





    /**search**/
    function searchPayment($name){
        $this->db->like('Name', $name, 'both');
        return $this->db->get('vw_payment_search')->result();
    }

    function getIdByPaymentName($payment_name){
        $this->db->select('payment_id');
        $this->db->from('vw_payment_search');
        $this->db->where('Name', $payment_name);
        $query = $this->db->get();

        if($query->num_rows()>0){
            return $query->first_row()->payment_id;
        }
        else{
            return null;
        }
    }

    function searchVehicle($name){
        $this->db->like('vehicle_no', $name, 'both');
        $this->db->where('vehicle_is_active', '1');
        return $this->db->get('vehicle')->result();
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

    function searchPaymentVoucher($name){
        $this->db->like('Name', $name, 'both');
        return $this->db->get('vw_payment_voucher_search')->result();
    }

    function getIdByPaymentVoucherName($payment_name){
        $this->db->select('payment_id');
        $this->db->from('vw_payment_voucher_search');
        $this->db->where('Name', $payment_name);
        $query = $this->db->get();

        if($query->num_rows()>0){
            return $query->first_row()->payment_id;
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

    function paymentExists($key){
        $this->db->where('Name', $key);
        $result = $this->db->get('vw_payment_search');
        if($result->num_rows() > 0)
            return false;
        else
            return true;
    }

    function paymentVoucherExists($key){
        $this->db->where('Name', $key);
        $result = $this->db->get('vw_payment_voucher_search');
        if($result->num_rows() > 0)
            return false;
        else
            return true;
    }


}