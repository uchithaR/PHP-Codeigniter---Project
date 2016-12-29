<?php

/**
 * Created by PhpStorm.
 * User: Uditha Jay
 * Date: 8/30/2016
 * Time: 12:14 AM
 */
class Payment extends CI_Controller{
    public function index()
    {
        $this->payment_add();
    }

    public function payment_add(){
        $this->load->library('session');

        $this->load->model('model_payment');

        //$data['active_vehicles'] = $this->model_payment->getActiveVehicles();
        $data['service_centers'] = $this->model_payment->getServiceCenters();

        $this->load->view('home_side_bar');
        $this->load->view('payment/payment', $data);
    }

    public function payment_insert_to_db(){
        try {

            $this->load->library('form_validation');

            $this->form_validation->set_rules('payment_file_no', 'File No', 'max_length[100]|trim|required');
            $this->form_validation->set_rules('payment_occurred_date', 'Payment Occurred Date', '');
            $this->form_validation->set_rules('payment_description', 'Description', 'max_length[500]|trim');
            $this->form_validation->set_rules('payment_bill_date', 'Payment Bill Date', '');
            $this->form_validation->set_rules('payment_vehicle_mileage', 'Vehicle Mileage', 'trim|numeric');
            $this->form_validation->set_rules('payment_invoice_no','Invoice Number', 'trim|max_length[100]');
            $this->form_validation->set_rules('payment_amount', 'Amount', 'trim|numeric');
            $this->form_validation->set_rules('payment_vehicle_name', 'Vehicle Number', 'trim|callback_vehicleNameExists');
            $this->form_validation->set_rules('sc_id', 'Service Center', 'trim|greater_than[0]');

            if ($this->form_validation->run() == FALSE) {
                $this->load->library('session');
                $this->session->set_flashdata('warning_message', validation_errors());
                $this->payment_add();
            } else {
                $this->load->model('model_payment');

                if ($quary = $this->model_payment->addPayment()) {
                    $this->load->library('session');
                    $this->session->set_flashdata('success_message', 'Successfully Submitted.');
                    redirect(current_url());
                }
            }
        }
        catch (mysqli_sql_exception $e){
            $this->payment_add();
        }
    }

    public function payment_details(){
        $this->load->model('model_payment');

        $this->load->library('table');
        $template = array(
            'table_open'            => '<table border="0" cellpadding="4" cellspacing="0" class="table table-striped table-hover ">',

            'thead_open'            => '<thead  >',
            'thead_close'           => '</thead>',

            'heading_row_start'     => '<tr class="info" >',
            'heading_row_end'       => '</tr>',
            'heading_cell_start'    => '<th style="text-align: center;">',
            'heading_cell_end'      => '</th>',

            'tbody_open'            => '<tbody style="text-align: center;">',
            'tbody_close'           => '</tbody>',

            'row_start'             => '<tr>',
            'row_end'               => '</tr>',
            'cell_start'            => '<td style="max-width: 250px">',
            'cell_end'              => '</td>',

            'row_alt_start'         => '<tr >',
            'row_alt_end'           => '</tr>',
            'cell_alt_start'        => '<td style="max-width: 250px">',
            'cell_alt_end'          => '</td>',

            'table_close'           => '</table>'
        );

        $this->table->set_template($template);

        $query = $this->model_payment->getPaymentDetails();
        $data['table'] = $this->table->generate($query);

        $this->load->view('home_side_bar');
        $this->load->view('payment/payment_details',$data);
    }





    /**payment voucher**/
    public function payment_voucher(){
        $this->load->library('session');

        $this->load->view('home_side_bar');
        $this->load->view('payment/payment_voucher');
    }

    public function payment_voucher_insert_to_db(){
        try {

            $this->load->library('form_validation');

            $this->form_validation->set_rules('payment_name', 'Payment', 'trim|required|callback_paymentExists');
            $this->form_validation->set_rules('pv_voucher_no', 'Payment Voucher Number', 'trim|required');
            $this->form_validation->set_rules('pv_submitted_date', 'Submitted Date', 'trim');

            if ($this->form_validation->run() == FALSE) {
                $this->load->library('session');
                $this->session->set_flashdata('warning_message', validation_errors());
                $this->payment_voucher();
            } else {
                $this->load->model('model_payment');

                if ($quary = $this->model_payment->addPaymentVoucher()) {
                    $this->load->library('session');
                    $this->session->set_flashdata('success_message', 'Successfully Submitted.');
                    redirect(current_url());
                }
            }
        }
        catch (mysqli_sql_exception $e){
            $this->payment_add();
        }
    }







    /**payment cheque**/
    public function payment_cheque(){
        $this->load->library('session');

        $this->load->view('home_side_bar');
        $this->load->view('payment/payment_cheque');
    }

    public function payment_cheque_insert_to_db(){
        try {

            $this->load->library('form_validation');

            $this->form_validation->set_rules('payment_voucher_name', 'Payment', 'trim|required|callback_paymentVoucherExists');
            $this->form_validation->set_rules('pc_cheque_no', 'Payment Cheque Number', 'trim|required');
            $this->form_validation->set_rules('pc_date', 'Submitted Date', 'trim');

            if ($this->form_validation->run() == FALSE) {
                $this->load->library('session');
                $this->session->set_flashdata('warning_message', validation_errors());
                $this->payment_cheque();
            } else {
                $this->load->model('model_payment');

                if ($quary = $this->model_payment->addPaymentCheque()) {
                    $this->load->library('session');
                    $this->session->set_flashdata('success_message', 'Successfully Submitted.');
                    redirect(current_url());
                }
            }
        }
        catch (mysqli_sql_exception $e){
            $this->payment_add();
        }
    }






    /**search **/
    public function payment_search(){
        $this->load->model('model_payment');
        if(isset($_GET['term'])){

            /**$result = $this->model_payment->searchPayment($_GET['term']);
            if(count($result)>0){
                foreach($result as $object)
                    $arr_result[] = array( 'label' => $object->Name, 'value' => $object->payment_id);

                echo json_encode($arr_result);
            }**/


            $result = $this->model_payment->searchPayment($_GET['term']);
            if(count($result)>0){
                foreach($result as $object)
                    $arr_result[] = $object->Name;

                echo json_encode($arr_result);
            }
        }
    }

    public function payment_vehicle_search(){
        $this->load->model('model_payment');
        if(isset($_GET['term'])){
            $result = $this->model_payment->searchVehicle($_GET['term']);
            if(count($result)>0){
                foreach($result as $object)
                    $arr_result[] = $object->vehicle_no;

                echo json_encode($arr_result);
            }
        }
    }

    public function payment_voucher_search(){
        $this->load->model('model_payment');
        if(isset($_GET['term'])){

            $result = $this->model_payment->searchPaymentVoucher($_GET['term']);
            if(count($result)>0){
                foreach($result as $object)
                    $arr_result[] = $object->Name;

                echo json_encode($arr_result);
            }
        }
    }






    /** custom validation**/

    function vehicleNameExists($key){
        $this->load->model('model_payment');
        $vehicleNameAvailable = $this->model_payment->vehicleNameExists($key);
        if($vehicleNameAvailable)
            return false;
        else
            return true;
    }

    function paymentExists($key){
        $this->load->model('model_payment');
        $paymentAvailable = $this->model_payment->paymentExists($key);
        if($paymentAvailable)
            return false;
        else
            return true;
    }

    function paymentVoucherExists($key){
        $this->load->model('model_payment');
        $paymentAvailable = $this->model_payment->paymentVoucherExists($key);
        if($paymentAvailable)
            return false;
        else
            return true;
    }

}