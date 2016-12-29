<?php

/**
 * Created by PhpStorm.
 * User: Uditha Jay
 * Date: 8/25/2016
 * Time: 10:44 AM
 */
class Insurance extends CI_Controller
{
    public function index()
    {
        $this->vehicle_insurance_details();
    }

    public function vehicle_insurance_add(){
        $this->load->library('session');

        $this->load->model('model_insurance');

        //$data['insurance_not_assigned'] = $this->model_insurance->getInsuranceNotAssignedVehicles();
        $data['insurance_companies'] = $this->model_insurance->getInsuranceCompanies();

        $this->load->view('home_side_bar');
        $this->load->view('insurance/vehicle_insurance', $data);
    }

    public function vehicle_insurance_to_db(){
        try {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('insurance_active_vehicle_name', 'Insurance Company Name', 'trim|callback_vehicleNameExists|required');
            $this->form_validation->set_rules('ic_id', 'Insurance Company Description', 'trim|greater_than[0]|required');
            $this->form_validation->set_rules('vi_name', 'Insurance Name', 'max_length[100]|trim|required');
            $this->form_validation->set_rules('vi_from_date', 'From Date', 'trim');
            $this->form_validation->set_rules('vi_to_date', 'To Date', 'trim');
            $this->form_validation->set_rules('vi_description', 'Description', 'max_length[500]|trim');

            if ($this->form_validation->run() == FALSE) {
                $this->load->library('session');
                $this->session->set_flashdata('warning_message', validation_errors());
                $this->vehicle_insurance_add();
            } else {
                $this->load->model('model_insurance');

                if ($quary = $this->model_insurance->addVehicleInsurance()) {
                    $this->load->library('session');
                    $this->session->set_flashdata('success_message', 'Successfully Submitted.');
                        $this-> vehicle_insurance_add();
                }
            }
        }
        catch (mysqli_sql_exception $e){
            $this->vehicle_insurance_add();
        }
    }

    public function vehicle_insurance_details(){
        $this->load->model('model_insurance');

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



        $query = $this->model_insurance->getVehicleInsuranceDetails();
        $data['table'] = $this->table->generate($query);

        $this->load->view('home_side_bar');
        $this->load->view('insurance/vehicle_insurance_details',$data);
    }


    public function vehicle_insurance_edit(){
        $this->load->library('session');

        $this->load->model('model_insurance');

        if($this->model_insurance->checkEditable()) {
            //$data['insuranced_vehicles'] = $this->model_insurance->getInsurancedVehicles();
            $data['insurance_companies'] = $this->model_insurance->getInsuranceCompanies();
            $data['vehicle_insurance_details'] = $this->model_insurance->getVehicleInsuranceDetailsByNumber();

            $this->load->view('home_side_bar');
            $this->load->view('insurance/vehicle_insurance_edit', $data);
        }
        else {
            $this->vehicle_insurance_add();
        }
    }

    public function vehicle_insurance_data(){
        $this->load->library('session');

        $this->load->model('model_insurance');

        //$data['insuranced_vehicles'] = $this->model_insurance->getInsurancedVehicles();
        $data['insurance_companies'] = $this->model_insurance->getInsuranceCompanies();
        //$data['vehicle_insurance_details'] = $this->model_insurance->getVehicleInsuranceDetailsByNumber();

        $this->load->library('form_validation');

        $this->form_validation->set_rules('insuranced_vehicle_name', 'Vehicle Name', 'callback_vehicleNameExists|required');

        if($this->form_validation->run() == FALSE){
            $this->load->library('session');
            $this->session->set_flashdata('insurance_warning_message', validation_errors());
            $this->vehicle_insurance_edit();
        }
        else{
            $data['vehicle_insurance_details'] = $this->model_insurance->getVehicleInsuranceDetailsByNumber();

            $this->load->view('home_side_bar');
            $this->load->view('insurance/vehicle_insurance_edit',$data);
        }
    }

    public function vehicle_insurance_update_to_db(){
        $this->load->library('session');
        $this->load->model('model_insurance');

        $this->load->library('form_validation');

        $this->form_validation->set_rules('vehicle_id', 'Insurance Company Name', 'trim|required');
        $this->form_validation->set_rules('ic_id', 'Insurance Company Description', 'trim|required');
        $this->form_validation->set_rules('vi_name', 'Insurance Name', 'max_length[100]|trim|required');
        $this->form_validation->set_rules('vi_from_date', 'From Date', 'trim');
        $this->form_validation->set_rules('vi_to_date', 'To Date', 'trim|required');
        $this->form_validation->set_rules('vi_description', 'Description', 'max_length[500]|trim');

        if($this->form_validation->run() == FALSE){
            $this->load->library('session');
            $this->session->set_flashdata('warning_message', validation_errors());
            $this->vehicle_insurance_edit();
        }
        else{
            $this->load->model('model_insurance');

            if($quary = $this->model_insurance->updateInsurencedVehicle()){
                $this->load->library('session');
                $this->session->set_flashdata('success_message', 'Successfully Updated.');

                $this->vehicle_insurance_edit();
            }
        }
    }








    /** insurance company */

    public function insurance_company_add(){
        $this->load->library('session');
        $this->session->unset_userdata('url');
        $this->session->set_userdata('url', '1');

        $this->load->model('model_insurance');

        $this->load->view('home_side_bar');
        $this->load->view('insurance/insurance_company_add');
    }

    public function insurance_company_to_db(){
        try {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('ic_name', 'Insurance Company Name', 'max_length[100]|trim|required');
            $this->form_validation->set_rules('ic_description', 'Insurance Company Description', 'max_length[500]|trim');

            if ($this->form_validation->run() == FALSE) {
                $this->load->library('session');
                $this->session->set_flashdata('warning_message', validation_errors());
                $this->insurance_company_add();
            } else {
                $this->load->model('model_insurance');

                if ($quary = $this->model_insurance->addInsuranceCompany()) {
                    $this->load->library('session');
                    $url = $this->session->userdata('url');

                    if($url == '1')
                        $this-> vehicle_insurance_add();
                    else if($url == '2')
                        $this-> vehicle_insurance_add();
                }
            }
        }
        catch (mysqli_sql_exception $e){
            $this->vehicle_insurance_add();
        }
    }






    /**search **/

    public function insurance_active_vehicle_search(){
        $this->load->model('model_insurance');
        if(isset($_GET['term'])){
            $result = $this->model_insurance->searchActiveVehicle($_GET['term']);
            if(count($result)>0){
                foreach($result as $object)
                    $arr_result[] = $object->Name;

                echo json_encode($arr_result);
            }
        }
    }


    public function insuranced_vehicle_search(){
        $this->load->model('model_insurance');
        if(isset($_GET['term'])){
            $result = $this->model_insurance->searchVehicle($_GET['term']);
            if(count($result)>0){
                foreach($result as $object)
                    $arr_result[] = $object->Name;

                echo json_encode($arr_result);
            }
        }
    }



    /** custom validation**/

    function vehicleNameExists($key){
        $this->load->model('model_insurance');
        $vehicleNameAvailable = $this->model_insurance->vehicleNameExists($key);
        if($vehicleNameAvailable)
            return false;
        else
            return true;
    }

}