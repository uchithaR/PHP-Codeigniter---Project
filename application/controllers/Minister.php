<?php

/**
 * Created by PhpStorm.
 * User: Uditha Jay
 * Date: 8/22/2016
 * Time: 1:23 PM
 */
class Minister extends CI_Controller{
    public function index()
    {
        $this->minister_details();
    }

    public function minister_add(){
        $this->load->library('session');
        $this->session->unset_userdata('url');
        $this->session->set_userdata('url', '1');

        $this->load->model('model_minister');

        $data['minister_designations'] = $this->model_minister->getMinisterDesignations();

        $this->load->view('home_side_bar');
        $this->load->view('minister/minister_add',$data);
    }

    public function minister_insert_to_db(){
        try {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('minister_fname', 'First Name', 'max_length[100]|trim|required');
            $this->form_validation->set_rules('minister_lname', 'Last Name', 'max_length[100]|trim');
            $this->form_validation->set_rules('minister_contact1', 'Contact Number 01', 'max_length[15]|trim');
            $this->form_validation->set_rules('minister_contact2', 'Contact Number 02', 'max_length[15]|trim');
            $this->form_validation->set_rules('md_id', 'Minister Designation', 'trim|required|greater_than[0]');

            if ($this->form_validation->run() == FALSE) {
                $this->load->library('session');
                $this->session->set_flashdata('warning_message', validation_errors());
                $this->minister_add();
            } else {
                $this->load->model('model_minister');

                if ($quary = $this->model_minister->addMinister()) {
                    $this->load->library('session');
                    $this->session->set_flashdata('success_message', 'Successfully Submitted.');
                    redirect(current_url());
                }
            }
        }
        catch (mysqli_sql_exception $e){
            $this->minister_add();
        }
    }

    public function minister_designation_add(){
        $this->load->library('session');

        $this->load->model('model_minister');

        $this->load->view('home_side_bar');
        $this->load->view('minister/minister_designation_add');
    }

    public function minister_designation_insert_to_db(){
        try {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('md_name', 'Institute Name', 'max_length[100]|trim|required');
            $this->form_validation->set_rules('md_description', 'Institute Description', 'max_length[500]|trim');

            if ($this->form_validation->run() == FALSE) {
                $this->load->library('session');
                $this->session->set_flashdata('warning_message', validation_errors());
                $this->minister_designation_add();
            } else {
                $this->load->model('model_minister');

                if ($quary = $this->model_minister->addMinisterDesignation()) {
                    $this->load->library('session');
                    $url = $this->session->userdata('url');

                    if($url == '1')
                        $this->minister_add();
                    else if($url == '2')
                        $this-> minister_edit();
                }
            }
        }
        catch (mysqli_sql_exception $e){
            $this->minister_designation_add();
        }
    }

    public function minister_edit(){
        $this->load->library('session');
        $this->session->unset_userdata('url');
        $this->session->set_userdata('url', '2');

        $this->load->model('model_minister');

        if($this->model_minister->checkEditable()) {
            $data['ministers_details'] = $this->model_minister->getMinistersByName();

            $data['ministers'] = $this->model_minister->getMinisters();

            $data['minister_designations'] = $this->model_minister->getMinisterDesignations();

            $this->load->view('home_side_bar');
            $this->load->view('minister/minister_edit', $data);
        }
        else{
            $this->minister_add();
        }
    }

    public function minister_data(){
        $this->load->library('session');

        $this->load->model('model_minister');

        //$data['ministers'] = $this->model_minister->getMinisters();

        $data['minister_designations'] = $this->model_minister->getMinisterDesignations();

        $this->load->library('form_validation');

        $this->form_validation->set_rules('minister_name', 'Name', 'callback_ministerNameExists|required');

        if($this->form_validation->run() == FALSE){
            $this->load->library('session');
            $this->session->set_flashdata('minister_warning_message', validation_errors());
            $this->minister_edit();
        }
        else{
            $data['ministers_details'] = $this->model_minister->getMinistersByName();

            $this->load->view('home_side_bar');
            $this->load->view('minister/minister_edit',$data);
        }
    }

    public function minister_update_to_db(){
        $this->load->library('session');
        $this->load->model('model_minister');

        $this->load->library('form_validation');

        $this->form_validation->set_rules('minister_id', 'Minister Id', 'trim|required');
        $this->form_validation->set_rules('minister_fname', 'First Name', 'max_length[100]|trim|required');
        $this->form_validation->set_rules('minister_lname', 'Last Name', 'max_length[100]|trim');
        $this->form_validation->set_rules('minister_contact1', 'Contact Number 01', 'max_length[15]|trim');
        $this->form_validation->set_rules('minister_contact2', 'Contact Number 02', 'max_length[15]|trim');
        $this->form_validation->set_rules('md_id', 'Minister Designation', 'required|greater_than[0]');
        $this->form_validation->set_rules('minister_is_active', 'Minister Active', 'required');

        if($this->form_validation->run() == FALSE){
            $this->load->library('session');
            $this->session->set_flashdata('warning_message', validation_errors());
            $this->minister_edit();
        }
        else{
            $this->load->model('model_minister');

            if($quary = $this->model_minister->updateMinister()){
                $this->load->library('session');
                $this->session->set_flashdata('success_message', 'Successfully Updated.');
                redirect(current_url());
            }
        }
    }



    public function minister_details(){
        $this->load->model('model_minister');

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



        $query = $this->model_minister->getMinisterDetails();
        $data['table'] = $this->table->generate($query);

        $this->load->view('home_side_bar');
        $this->load->view('minister/minister_details',$data);

    }


    /**
     * function to assign drivers
     */
    public function minister_assign_drivers(){
        $this->load->library('session');

        $this->load->model('model_minister');
        //$data['not_assigned_ministers'] = $this->model_minister->getNotAssignedMinisters();
        //$data['not_assigned_drivers'] = $this->model_minister->getNotAssignedDrivers();

        //$data['assigned_ministers'] = $this->model_minister->getAssignedMinisters();
        //$data['assigned_drivers'] = $this->model_minister->getAssignedDrivers();

        $this->load->library('table');
        $template = array(
            'table_open'            => '<table border="0" cellpadding="4" cellspacing="0" class="table table-striped table-hover">',

            'thead_open'            => '<thead>',
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

        $query = $this->model_minister->getDriverAssignedDetails();
        $data['table'] = $this->table->generate($query);

        $this->load->view('home_side_bar');
        $this->load->view('minister/minister_assign_drivers', $data);
    }

    public function minister_assign_drivers_to_db(){

        $this->load->model('model_minister');

        $this->load->library('form_validation');

        $this->form_validation->set_rules('driver_not_assigned_minister_name', 'Minister ', 'callback_ministerNameExists|required');
        $this->form_validation->set_rules('driver_not_assigned_driver_name', 'Driver', 'callback_driverNameExists|required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->library('session');
            $this->session->set_flashdata('warning_message', validation_errors());
            $this->minister_assign_drivers();
        } else {
            $this->load->model('model_minister');
            $this->load->library('session');
            $this->session->set_flashdata('success_message', 'Driver Successfully Assigned.');

            $this->model_minister->assignDrivers();

            $this->minister_assign_drivers();
        }

        /**$this->load->library('table');
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

        $query = $this->model_minister->getDriverAssignedDetails();
        $data['table'] = $this->table->generate($query);

        $data['not_assigned_ministers'] = $this->model_minister->getNotAssignedMinisters();
        $data['not_assigned_drivers'] = $this->model_minister->getNotAssignedDrivers();

        $data['assigned_ministers'] = $this->model_minister->getAssignedMinisters();
        $data['assigned_drivers'] = $this->model_minister->getAssignedDrivers();

        $this->load->view('home_side_bar');
        $this->load->view('minister/minister_assign_drivers', $data);**/
    }

    public function minister_reassign_drivers_to_db(){

        $this->load->model('model_minister');

        $this->load->library('form_validation');

        $this->form_validation->set_rules('driver_assigned_minister_name', 'Minister ', 'callback_ministerNameExists|required');
        $this->form_validation->set_rules('driver_not_assigned_driver_name2', 'Driver', 'callback_driverNameExists|required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->library('session');
            $this->session->set_flashdata('warning_message', validation_errors());
            $this->minister_assign_drivers();
        } else {
            $this->load->library('session');
            $this->session->set_flashdata('success_message', 'Driver Successfully Reassigned.');

            $this->load->model('model_minister');
            $this->model_minister->reassignDrivers();

            $this->minister_assign_drivers();
        }

        /**$this->load->library('table');
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

        $query = $this->model_minister->getDriverAssignedDetails();
        $data['table'] = $this->table->generate($query);

        $data['not_assigned_ministers'] = $this->model_minister->getNotAssignedMinisters();
        $data['not_assigned_drivers'] = $this->model_minister->getNotAssignedDrivers();

        $data['assigned_ministers'] = $this->model_minister->getAssignedMinisters();
        $data['assigned_drivers'] = $this->model_minister->getAssignedDrivers();

        $this->load->view('home_side_bar');
        $this->load->view('minister/minister_assign_drivers', $data);**/
    }

    public function minister_remove_drivers_from_db(){

        $this->load->model('model_minister');

        $this->load->library('form_validation');

        $this->form_validation->set_rules('driver_assigned_minister_name2', 'Minister ', 'callback_ministerNameExists|required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->library('session');
            $this->session->set_flashdata('warning_message', validation_errors());
            $this->minister_assign_drivers();
        } else {
            $this->load->library('session');
            $this->session->set_flashdata('success_message', 'Driver Successfully Removed.');

            $this->load->model('model_minister');
            $this->model_minister->removeDrivers();

            $this->minister_assign_drivers();
        }

        /**$this->load->library('table');
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

        $query = $this->model_minister->getDriverAssignedDetails();
        $data['table'] = $this->table->generate($query);

        $data['not_assigned_ministers'] = $this->model_minister->getNotAssignedMinisters();
        $data['not_assigned_drivers'] = $this->model_minister->getNotAssignedDrivers();

        $data['assigned_ministers'] = $this->model_minister->getAssignedMinisters();
        $data['assigned_drivers'] = $this->model_minister->getAssignedDrivers();

        $this->load->view('home_side_bar');
        $this->load->view('minister/minister_assign_drivers', $data);**/
    }




    /**
     * functions to assign vehicles
     */
    public function minister_assign_vehicles(){
        $this->load->library('session');

        $this->load->model('model_minister');
        //$data['active_ministers'] = $this->model_minister->getActiveMinisters();
        //$data['not_assigned_vehicles'] = $this->model_minister->getNotAssignedVehicles();

        //$data['assigned_vehicles'] = $this->model_minister->getAssignedVehicles();

        $this->load->library('table');
        $template = array(
            'table_open'            => '<table border="0" cellpadding="4" cellspacing="0" class="table table-striped table-hover">',

            'thead_open'            => '<thead>',
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

        $query = $this->model_minister->getVehicleAssignedDetails();
        $data['table'] = $this->table->generate($query);

        $this->load->view('home_side_bar');
        $this->load->view('minister/minister_assign_vehicles', $data);
    }


    public function minister_assign_vehicles_to_db(){

        $this->load->model('model_minister');

        $this->load->library('form_validation');

        $this->form_validation->set_rules('vehicle_active_minister_name', 'Minister ', 'callback_ministerNameExists|required');
        $this->form_validation->set_rules('vehicle_not_assigned_vehicle_name', 'Vehicle', 'callback_vehicleNameExists|required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->library('session');
            $this->session->set_flashdata('warning_message', validation_errors());
            $this->minister_assign_vehicles();
        }
        else {
            $this->model_minister->assignVehicles();

            $this->load->library('session');
            $this->session->set_flashdata('success_message', 'Vehicle Successfully Assigned.');

            $this->minister_assign_vehicles();
        }

        /**$this->load->library('table');
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

        $query = $this->model_minister->getVehicleAssignedDetails();
        $data['table'] = $this->table->generate($query);

        $data['active_ministers'] = $this->model_minister->getActiveMinisters();
        $data['not_assigned_vehicles'] = $this->model_minister->getNotAssignedVehicles();

        $data['assigned_vehicles'] = $this->model_minister->getAssignedVehicles();

        $this->load->view('home_side_bar');
        $this->load->view('minister/minister_assign_vehicles', $data);**/
    }

    public function minister_remove_vehicles_from_db(){
        try {

            $this->load->model('model_minister');

            $this->load->library('form_validation');

            $this->form_validation->set_rules('vehicle_assigned_vehicle_name', 'Vehicle', 'callback_vehicleNameExists|required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->library('session');
                $this->session->set_flashdata('warning_message', validation_errors());
                $this->minister_assign_vehicles();
            } else {
                $this->model_minister->removeVehicles();

                $this->load->library('session');
                $this->session->set_flashdata('success_message', 'Vehicle Successfully Removed.');

                $this->minister_assign_vehicles();
            }
        }
        catch(mysqli_sql_exception $e){
            $this->minister_assign_vehicles();
        }

        /**$this->load->library('table');
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

        $query = $this->model_minister->getVehicleAssignedDetails();
        $data['table'] = $this->table->generate($query);

        $data['active_ministers'] = $this->model_minister->getActiveMinisters();
        $data['not_assigned_vehicles'] = $this->model_minister->getNotAssignedVehicles();

        $data['assigned_vehicles'] = $this->model_minister->getAssignedVehicles();

        $this->load->view('home_side_bar');
        $this->load->view('minister/minister_assign_vehicles', $data);*/
    }





    /** search */
    public function minister_search(){
        $this->load->model('model_minister');
        if(isset($_GET['term'])){
            $result = $this->model_minister->searchMinisters($_GET['term']);
            if(count($result)>0){
                foreach($result as $object)
                    $arr_result[] = $object->Name;

                echo json_encode($arr_result);
            }
        }
    }

    public function not_assigned_minister_search(){
        $this->load->model('model_minister');
        if(isset($_GET['term'])){
            $result = $this->model_minister->searchNotAssignedMinisters($_GET['term']);
            if(count($result)>0){
                foreach($result as $object)
                    $arr_result[] = $object->Name;

                echo json_encode($arr_result);
            }
        }
    }


    public function not_assigned_driver_search(){
        $this->load->model('model_minister');
        if(isset($_GET['term'])){
            $result = $this->model_minister->searchNotAssignedDrivers($_GET['term']);
            if(count($result)>0){
                foreach($result as $object)
                    $arr_result[] = $object->Name;

                echo json_encode($arr_result);
            }
        }
    }

    public function assigned_minister_search(){
        $this->load->model('model_minister');
        if(isset($_GET['term'])){
            $result = $this->model_minister->searchAssignedMinisters($_GET['term']);
            if(count($result)>0){
                foreach($result as $object)
                    $arr_result[] = $object->Name;

                echo json_encode($arr_result);
            }
        }
    }

    public function active_minister_search(){
        $this->load->model('model_minister');
        if(isset($_GET['term'])){
            $result = $this->model_minister->searchActiveMinisters($_GET['term']);
            if(count($result)>0){
                foreach($result as $object)
                    $arr_result[] = $object->Name;

                echo json_encode($arr_result);
            }
        }
    }

    public function not_assigned_vehicle_search(){
        $this->load->model('model_minister');
        if(isset($_GET['term'])){
            $result = $this->model_minister->searchNotAssignedVehicles($_GET['term']);
            if(count($result)>0){
                foreach($result as $object)
                    $arr_result[] = $object->Name;

                echo json_encode($arr_result);
            }
        }
    }
    public function assigned_vehicle_search(){
        $this->load->model('model_minister');
        if(isset($_GET['term'])){
            $result = $this->model_minister->searchAssignedVehicles($_GET['term']);
            if(count($result)>0){
                foreach($result as $object)
                    $arr_result[] = $object->Name;

                echo json_encode($arr_result);
            }
        }
    }





    /** custom validation**/

    function ministerNameExists($key){
        $this->load->model('model_minister');
        $ministerNameAvailable = $this->model_minister->ministerNameExists($key);
        if($ministerNameAvailable)
            return false;
        else
            return true;
    }

    function driverNameExists($key){
        $this->load->model('model_minister');
        $driverNameAvailable = $this->model_minister->driverNameExists($key);
        if($driverNameAvailable)
            return false;
        else
            return true;
    }

    function vehicleNameExists($key){
        $this->load->model('model_minister');
        $driverNameAvailable = $this->model_minister->vehicleNameExists($key);
        if($driverNameAvailable)
            return false;
        else
            return true;
    }

}