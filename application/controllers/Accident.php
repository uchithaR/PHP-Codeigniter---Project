<?php

/**
 * Created by PhpStorm.
 * User: Uditha Jay
 * Date: 8/25/2016
 * Time: 3:36 PM
 */
class Accident  extends CI_Controller{
    public function index()
    {
        $this->accident_details();
    }

    public function accident_report(){
        $this->load->library('session');

        $this->load->model('model_accident');

        //$data['vehicles'] = $this->model_accident->getVehicleNumbers();
        $data['service_centers'] = $this->model_accident->getServiceCenters();

        $this->load->view('home_side_bar');
        $this->load->view('accident/accident_report', $data);
    }

    public function accident_insert_to_db(){
        try {

            $this->load->library('form_validation');

            $this->form_validation->set_rules('accident_description', 'Details', 'max_length[500]|trim|required');
            $this->form_validation->set_rules('accident_onthespot', 'On The Spot', 'max_length[500]|trim|required');
            $this->form_validation->set_rules('accident_insurance_no', 'Insurance', 'max_length[100]|trim');
            $this->form_validation->set_rules('accident_active_vehicle_name', 'Vehicle', 'trim|callback_vehicleNameExists|required');
            $this->form_validation->set_rules('sc_id', 'Service Center', 'trim|required|greater_than[0]');
            $this->form_validation->set_rules('accident_date', 'Service Center', 'trim');

            if ($this->form_validation->run() == FALSE) {
                $this->load->library('session');
                $this->session->set_flashdata('warning_message', validation_errors());
                $this->accident_report();
            } else {
                $this->load->model('model_accident');

                if ($quary = $this->model_accident->addAccident()) {
                    $this->load->library('session');
                    $this->session->set_flashdata('success_message', 'Successfully Submitted.');
                    redirect(current_url());
                }
            }
        }
        catch (mysqli_sql_exception $e){
            $this->accident_report();
        }
    }

    public function accident_details(){
        $this->load->model('model_accident');

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



        $query = $this->model_accident->getVehicleAccidentDetails();
        $data['table'] = $this->table->generate($query);

        $this->load->view('home_side_bar');
        $this->load->view('accident/accident_details',$data);

    }






    /** Service Center */
    public function service_center_add(){
        $this->load->library('session');
        $this->session->unset_userdata('url');
        $this->session->set_userdata('url', '1');

        $this->load->model('model_accident');

        $this->load->view('home_side_bar');
        $this->load->view('accident/service_center_add');
    }

    public function service_centers_add(){
        $this->load->library('session');
        $this->session->unset_userdata('url');
        $this->session->set_userdata('url', '3');

        $this->load->model('model_accident');

        $this->load->view('home_side_bar');
        $this->load->view('accident/service_center_add');
    }

    public function service_centerss_add(){
        $this->load->library('session');
        $this->session->unset_userdata('url');
        $this->session->set_userdata('url', '4');

        $this->load->model('model_accident');

        $this->load->view('home_side_bar');
        $this->load->view('accident/service_center_add');
    }

    public function service_center_insert_to_db(){
        try {

            $this->load->library('form_validation');

            $this->form_validation->set_rules('sc_name', 'Name', 'max_length[100]|trim|required');
            $this->form_validation->set_rules('sc_description', 'Description', 'max_length[500]|trim');
            $this->form_validation->set_rules('sc_contact_person', 'Contact Person', 'max_length[100]|trim');
            $this->form_validation->set_rules('sc_title', 'Contact Person Title', 'max_length[100]|trim');
            $this->form_validation->set_rules('sc_contact1', 'Contact Number 01', 'max_length[15]|trim');
            $this->form_validation->set_rules('sc_contact2', 'Contact Number 02', 'max_length[15]|trim');

            if ($this->form_validation->run() == FALSE) {
                $this->load->library('session');
                $this->session->set_flashdata('warning_message', validation_errors());
                $this->service_center_add();
            } else {
                $this->load->model('model_accident');

                if ($quary = $this->model_accident->addServiceCenter()) {
                    $this->load->library('session');
                    $url = $this->session->userdata('url');

                    if ($url == '1')
                        $this->accident_report();
                    else if ($url == '3') {
                        $this->load->library('session');
                        $this->session->set_flashdata('success_message', 'Successfully Submitted.');
                        redirect(current_url());
                    }
                    else if($url == '4')
                        $this-> payment_add();
                    else
                        home_view();
                }
            }
        }
        catch (mysqli_sql_exception $e){
            $this->service_center_add();
        }
    }




    /** police report */

    public function accident_police_report(){
        $this->load->library('session');

        $this->load->model('model_accident');

        //$data['accident_upload_police_report'] = $this->model_accident->getAccidentIdToUploadPoliceReport();

        //$data['accident_download_police_report'] = $this->model_accident->getAccidentIdToDownloadPoliceReport();
        $data['view_police_report'] = $this->model_accident->downloadPoliceReport();

        $this->load->view('home_side_bar');
        $this->load->view('accident/accident_police_report', $data);
        if($this->model_accident->checkDownloadable()){
            $this->load->view('accident/accident_police_report_download');
        }
        else
            $this->load->view('accident/accident_police_report_no_download');
    }

    public function accident_police_report_insert_to_db(){
        $this->load->library('session');

        $config['upload_path'] = './images/upload/policereport/';
        $config['allowed_types'] = 'gif|jpg|png';

        $this->load->library('upload', $config);

         $this->upload->do_upload();
        $url = $this->upload->data('file_name');

        $this->load->library('form_validation');

        $this->form_validation->set_rules('apr_accident_name', 'Accident', 'trim|callback_accidentNameExists|required');
        $this->form_validation->set_rules('userfile', 'Police Report', 'callback_file_selected_test');

        if ($this->form_validation->run() == FALSE) {
            $this->load->library('session');
            $this->session->set_flashdata('warning_message', validation_errors());
            $this->accident_police_report();
        } else {
            $this->load->model('model_accident');

            if ($quary = $this->model_accident->uploadPoliceReport($url)) {
                $this->load->library('session');
                $this->session->set_flashdata('success_message', 'Successfully Uploaded.');
                redirect(current_url());
            }
        }
    }

    public function accident_police_report_get_from_db(){
        $this->load->library('session');

        $this->load->library('form_validation');

        $this->form_validation->set_rules('apr_accident_name2', 'Accident', 'trim|callback_accidentNameExists|required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->library('session');
            $this->session->set_flashdata('warning_message', validation_errors());
            $this->accident_police_report();
        } else {
            $this->load->model('model_accident');

            //$data['accident_upload_police_report'] = $this->model_accident->getAccidentIdToUploadPoliceReport();

            //$data['accident_download_police_report'] = $this->model_accident->getAccidentIdToDownloadPoliceReport();
            $data['view_police_report'] = $this->model_accident->downloadPoliceReport();

            $this->load->view('home_side_bar');
            $this->load->view('accident/accident_police_report', $data);
            if($this->model_accident->checkDownloadable()){
                $this->load->view('accident/accident_police_report_download');
            }
            else
                $this->load->view('accident/accident_police_report_no_download');

        }
    }




    /** search **/
    public function active_vehicle_search(){
        $this->load->model('model_accident');
        if(isset($_GET['term'])){
            $result = $this->model_accident->searchActiveVehicles($_GET['term']);
            if(count($result)>0){
                foreach($result as $object)
                    $arr_result[] = $object->Name;

                echo json_encode($arr_result);
            }
        }
    }


    public function apr_accident(){
        $this->load->model('model_accident');
        if(isset($_GET['term'])){
            $result = $this->model_accident->aprAccident($_GET['term']);
            if(count($result)>0){
                foreach($result as $object)
                    $arr_result[] = $object->Name;

                echo json_encode($arr_result);
            }
        }
    }

    public function apr_downloadable_accident(){
        $this->load->model('model_accident');
        if(isset($_GET['term'])){
            $result = $this->model_accident->aprDownloadableAccident($_GET['term']);
            if(count($result)>0){
                foreach($result as $object)
                    $arr_result[] = $object->Name;

                echo json_encode($arr_result);
            }
        }
    }


    /**custom validation **/

    function vehicleNameExists($key){
        $this->load->model('model_accident');
        $driverNameAvailable = $this->model_accident->vehicleNameExists($key);
        if($driverNameAvailable)
            return false;
        else
            return true;
    }

    function accidentNameExists($key){
        $this->load->model('model_accident');
        $accidentNameAvailable = $this->model_accident->accidentNameExists($key);
        if($accidentNameAvailable)
            return false;
        else
            return true;
    }

    function file_selected_test(){

        $this->form_validation->set_message('file_selected_test', 'Please select a file to upload.');
        if (empty($_FILES['userfile']['name'])) {
            return false;
        }else{
            return true;
        }
    }















    public function home_view(){
        $this->load->view('home');
    }

    public function payment_add(){
        $this->load->library('session');
        $this->session->unset_userdata('url');
        $this->session->set_userdata('url', '4');

        $this->load->model('model_payment');

        $data['active_vehicles'] = $this->model_payment->getActiveVehicles();
        $data['service_centers'] = $this->model_payment->getServiceCenters();

        $this->load->model('model_driver');

        $this->load->view('home_side_bar');
        $this->load->view('payment/payment', $data);
    }
}