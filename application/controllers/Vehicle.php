<?php

/**
 * Created by PhpStorm.
 * User: Uditha Jay
 * Date: 8/17/2016
 * Time: 3:26 PM
 */
class Vehicle extends CI_Controller
{
    public function index()
    {
        $this->vehicle_details();
    }

    public function vehicle_add(){
        $this->load->library('session');
        $this->session->unset_userdata('url');
        $this->session->set_userdata('url', '1');

        $this->load->model('model_vehicle');

        $data['institute_names'] = $this->model_vehicle->getInstitutes();
        $data['registered_institute_names'] = $this->model_vehicle->getRegisteredInstitutes();
        $data['vehicle_types'] = $this->model_vehicle->getVehicleTypes();

        $this->load->view('home_side_bar');
        $this->load->view('vehicle/vehicle_add',$data);
    }

    public function vehicle_insert_to_db(){
        try {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('vehicle_no', 'Vehicle Number', 'max_length[100]|trim|required');
            $this->form_validation->set_rules('file_no', 'File Number', 'max_length[100]|trim|required');
            $this->form_validation->set_rules('vehicle_manufacture_year', 'Vehicle Manufacture Year', 'numeric|max_length[4]|trim');
            $this->form_validation->set_rules('vehicle_insurance', 'Vehicle Insurance', 'trim');
            $this->form_validation->set_rules('vehicle_revenue', 'Vehicle Revenue', 'trim');
            $this->form_validation->set_rules('institute_id', 'Institute Name', 'required|greater_than[0]');
            $this->form_validation->set_rules('ri_id', 'Registered Institute Name', 'required|greater_than[0]');
            $this->form_validation->set_rules('vt_id', 'Vehicle Type', 'required|greater_than[0]');

            if ($this->form_validation->run() == FALSE) {
                $this->load->library('session');
                $this->session->set_flashdata('warning_message', validation_errors());
                $this->vehicle_add();
            } else {
                $this->load->model('model_vehicle');

                if ($quary = $this->model_vehicle->addVehicle()) {
                    $this->load->library('session');
                    $this->session->set_flashdata('success_message', 'Successfully Submitted.');
                    redirect(current_url());
                }
            }
        }
        catch(mysqli_sql_exception $e){
            $this->vehicle_details();
        }
    }

    public function vehicle_details(){
        $this->load->model('model_vehicle');

        $this->load->library('table');
        $template = array(
            'table_open'            => '<table border="0" cellpadding="4" cellspacing="0" class="table table-striped table-hover ">',

            'thead_open'            => '<thead  >',
            'thead_close'           => '</thead>',

            'heading_row_start'     => '<tr class="info" >',
            'heading_row_end'       => '</tr>',
            'heading_cell_start'    => '<th >',
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



        $query = $this->model_vehicle->getVehicleDetails();
        $data['table'] = $this->table->generate($query);

        $this->load->view('home_side_bar');
        $this->load->view('vehicle/vehicle_details',$data);
    }

    public function vehicle_edit(){
        $this->load->library('session');
        $this->session->unset_userdata('url');
        $this->session->set_userdata('url', '2');

        $this->load->model('model_vehicle');

        if($this->model_vehicle->checkEditable()) {
            $data['vehicle_details'] = $this->model_vehicle->getVehicleDetalsByNumber();

            //$data['vehicle_numbers'] = $this->model_vehicle->getVehicleNumbers();

            $data['institute_names'] = $this->model_vehicle->getInstitutes();
            $data['registered_institute_names'] = $this->model_vehicle->getRegisteredInstitutes();
            $data['vehicle_types'] = $this->model_vehicle->getVehicleTypes();

            $this->load->view('home_side_bar');
            $this->load->view('vehicle/vehicle_edit', $data);
        }
        else{
            $this->vehicle_add();
        }
    }

    public function vehicle_data(){
        $this->load->library('session');
        $this->load->model('model_vehicle');

        //$data['vehicle_numbers'] = $this->model_vehicle->getVehicleNumbers();

        $data['institute_names'] = $this->model_vehicle->getInstitutes();
        $data['registered_institute_names'] = $this->model_vehicle->getRegisteredInstitutes();
        $data['vehicle_types'] = $this->model_vehicle->getVehicleTypes();

        $this->load->library('form_validation');

        $this->form_validation->set_rules('vehicle_name', 'Vehicle Name', 'callback_vehicleNameExists|required');

        if($this->form_validation->run() == FALSE){
            $this->load->library('session');
            $this->session->set_flashdata('search_warning_message', validation_errors());
            $this->vehicle_edit();
        }
        else{
            $data['vehicle_details'] = $this->model_vehicle->getVehicleDetalsByNumber();

            $this->load->view('home_side_bar');
            $this->load->view('vehicle/vehicle_edit',$data);
            }
    }

    public function vehicle_update_to_db(){
        $this->load->model('model_vehicle');

        $this->load->library('form_validation');

        $this->form_validation->set_rules('vehicle_id', 'Vehicle Id', 'trim|required');
        $this->form_validation->set_rules('vehicle_no', 'Vehicle Number', 'max_length[100]|trim|required');
        $this->form_validation->set_rules('file_no', 'File Number', 'max_length[100]|trim|required');
        $this->form_validation->set_rules('vehicle_manufacture_year', 'Vehicle Manufacture Year', 'numeric|max_length[4]|trim');
        $this->form_validation->set_rules('vehicle_insurance', 'Vehicle Insurance', 'trim');
        $this->form_validation->set_rules('vehicle_revenue', 'Vehicle Revenue', 'trim');
        $this->form_validation->set_rules('institute_id', 'Institute Name', 'required|greater_than[0]');
        $this->form_validation->set_rules('ri_id', 'Registered Institute Name', 'required|greater_than[0]');
        $this->form_validation->set_rules('vt_id', 'Vehicle Type', 'required|greater_than[0]');
        $this->form_validation->set_rules('vehicle_is_active', 'Vehicle Active', 'required');

        if($this->form_validation->run() == FALSE){
            $this->load->library('session');
            $this->session->set_flashdata('warning_message', validation_errors());
            $this->vehicle_edit();
        }
        else{
            $this->load->model('model_vehicle');

            if($quary = $this->model_vehicle->updateVehicle()){
                $this->load->library('session');
                $this->session->set_flashdata('success_message', 'Successfully Updated.');
                redirect(current_url());
            }
        }
    }









    /**vehicle registration certificate**/

    public function vehicle_registration_certificate(){
        $this->load->library('session');
        $this->load->model('model_vehicle');

        //$data['active_vehicle_numbers'] = $this->model_vehicle->getVehicleNumbersToUploadVRC();

        $data['view_vehicle_registration_certificate'] = $this->model_vehicle->downloadVehicleRegistrationCertificate();

        //$data['vehicle_download_vehicle_registration_certificate'] = $this->model_vehicle->getVehicleIdToDownloadVehicleRegistrationCertificate();

        $this->load->view('home_side_bar');
        $this->load->view('vehicle/vehicle_registration_certificate', $data);

        if($this->model_vehicle->checkDownloadable()){
            $this->load->view('vehicle/vehicle_registration_certificate_download');
        }
        else
            $this->load->view('vehicle/vehicle_registration_certificate_no_download');
    }

    public function vehicle_registration_certificate_insert_to_db(){
        $this->load->library('session');

        $config['upload_path'] = './images/upload/vehicleregistrationcertificate/';
        $config['allowed_types'] = 'gif|jpg|png';

        $this->load->library('upload', $config);

        $this->upload->do_upload();
        $url = $this->upload->data('file_name');

        $this->load->library('form_validation');

        $this->form_validation->set_rules('vrc_active_vehicle_name', 'Vehicle', 'trim|callback_vehicleNameExists|required');
        $this->form_validation->set_rules('userfile', 'Vehicle Registration Certificate', 'callback_file_selected_test');

        if ($this->form_validation->run() == FALSE) {
            $this->load->library('session');
            $this->session->set_flashdata('warning_message', validation_errors());
            $this->vehicle_registration_certificate();
        }
        else {
            $this->load->model('model_vehicle');

            if ($quary = $this->model_vehicle->uploadVehicleRegistrationCertificate($url)) {
                $this->load->library('session');
                $this->session->set_flashdata('success_message', 'Successfully Uploaded.');
                redirect(current_url());
            }
        }
    }

    public function vehicle_registration_certificate_get_from_db()
    {
        $this->load->library('session');

        $this->load->library('form_validation');

        $this->form_validation->set_rules('vrc_active_vehicle_name2', 'Vehicle', 'trim|callback_vehicleNameExists|required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->library('session');
            $this->session->set_flashdata('warning_message', validation_errors());
            $this->vehicle_registration_certificate();
        } else {
            $this->load->model('model_vehicle');

            //$data['active_vehicle_numbers'] = $this->model_vehicle->getVehicleNumbersToUploadVRC();

            $data['view_vehicle_registration_certificate'] = $this->model_vehicle->downloadVehicleRegistrationCertificate();

            //$data['vehicle_download_vehicle_registration_certificate'] = $this->model_vehicle->getVehicleIdToDownloadVehicleRegistrationCertificate();

            $this->load->view('home_side_bar');
            $this->load->view('vehicle/vehicle_registration_certificate', $data);

            if($this->model_vehicle->checkDownloadable()){
                $this->load->view('vehicle/vehicle_registration_certificate_download');
            }
            else
                $this->load->view('vehicle/vehicle_registration_certificate_no_download');

        }
    }





    /**search **/
    public function vehicle_search(){
        $this->load->model('model_vehicle');
        if(isset($_GET['term'])){
            $result = $this->model_vehicle->searchVehicle($_GET['term']);
            if(count($result)>0){
                foreach($result as $object)
                    $arr_result[] = $object->Name;

                echo json_encode($arr_result);
            }
        }
    }


    public function active_vehicle_search(){
        $this->load->model('model_vehicle');
        if(isset($_GET['term'])){
            $result = $this->model_vehicle->activeVehicleSearch($_GET['term']);
            if(count($result)>0){
                foreach($result as $object)
                    $arr_result[] = $object->Name;

                echo json_encode($arr_result);
            }
        }
    }



    public function active_vehicle_search2(){
        $this->load->model('model_vehicle');
        if(isset($_GET['term'])){
            $result = $this->model_vehicle->activeVehicleSearch2($_GET['term']);
            if(count($result)>0){
                foreach($result as $object)
                    $arr_result[] = $object->Name;

                echo json_encode($arr_result);
            }
        }
    }



    /** custom validation**/

    function vehicleNameExists($key){
        $this->load->model('model_vehicle');
        $vehicleNameAvailable = $this->model_vehicle->vehicleNameExists($key);
        if($vehicleNameAvailable)
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

}