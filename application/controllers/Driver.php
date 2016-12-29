<?php

/**
 * Created by PhpStorm.
 * User: Uditha Jay
 * Date: 8/23/2016
 * Time: 10:52 AM
 */
class Driver extends CI_Controller{
    public function index()
    {
        $this->driver_details();
    }

    public function driver_add(){
        $this->load->library('session');
        $this->session->unset_userdata('url');
        $this->session->set_userdata('url', '1');

        $this->load->model('model_driver');

        $this->load->view('home_side_bar');
        $this->load->view('driver/driver_add');
    }

    public function driver_insert_to_db(){
        try {

            $this->load->library('form_validation');

            $this->form_validation->set_rules('driver_fname', 'First Name', 'max_length[100]|trim|required');
            $this->form_validation->set_rules('driver_lname', 'Last Name', 'max_length[100]|trim');
            $this->form_validation->set_rules('driver_contact1', 'Contact Number 01', 'max_length[15]|trim');
            $this->form_validation->set_rules('driver_contact2', 'Contact Number 02', 'max_length[15]|trim');
            $this->form_validation->set_rules('driver_nic', 'NIC', 'max_length[12]|trim|required');
            $this->form_validation->set_rules('driver_licence_num', 'Licence Number', 'max_length[45]|trim|required');
            $this->form_validation->set_rules('driver_emergency_contact', 'Emergency Contact', 'max_length[15]|trim');

            if ($this->form_validation->run() == FALSE) {
                $this->load->library('session');
                $this->session->set_flashdata('warning_message', validation_errors());
                $this->driver_add();
            } else {
                $this->load->model('model_driver');

                if ($quary = $this->model_driver->addDriver()) {
                    $this->load->library('session');
                    $this->session->set_flashdata('success_message', 'Successfully Submitted.');
                    redirect(current_url());
                }
            }
        }
        catch (mysqli_sql_exception $e){
            $this->driver_add();
        }
    }

    public function driver_edit(){
        $this->load->library('session');
        $this->session->unset_userdata('url');
        $this->session->set_userdata('url', '2');

        $this->load->model('model_driver');

        if($this->model_driver->checkEditable()) {
            $data['drivers'] = $this->model_driver->getDrivers();
            $data['driver_details'] = $this->model_driver->getDriversByName();

            $this->load->view('home_side_bar');
            $this->load->view('driver/driver_edit', $data);
        }
        else{
            $this->driver_add();
        }
    }

    public function driver_data(){
        $this->load->model('model_driver');

        //$data['drivers'] = $this->model_driver->getDrivers();

        $this->load->library('form_validation');

        //$this->form_validation->set_rules('driver_id', 'Name', 'required');
        $this->form_validation->set_rules('driver_name', 'Name', 'required|callback_driverNameExists');

        if($this->form_validation->run() == FALSE){
            $this->load->library('session');
            $this->session->set_flashdata('driver_warning_message', validation_errors());
            $this->driver_edit();
        }
        else{
            $data['driver_details'] = $this->model_driver->getDriversByName();

            $this->load->view('home_side_bar');
            $this->load->view('driver/driver_edit',$data);
        }
    }

    public function driver_update_to_db(){
        $this->load->model('model_driver');

        $this->load->library('form_validation');

        $this->form_validation->set_rules('driver_id', 'Driver Id', 'trim|required');
        $this->form_validation->set_rules('driver_fname', 'First Name', 'max_length[100]|trim|required');
        $this->form_validation->set_rules('driver_lname', 'Last Name', 'max_length[100]|trim');
        $this->form_validation->set_rules('driver_contact1', 'Contact Number 01', 'max_length[15]|trim');
        $this->form_validation->set_rules('driver_contact2', 'Contact Number 02', 'max_length[15]|trim');
        $this->form_validation->set_rules('driver_nic', 'NIC', 'max_length[12]|trim|required');
        $this->form_validation->set_rules('driver_licence_num', 'Licence Number', 'max_length[45]|trim|required');
        $this->form_validation->set_rules('driver_emergency_contact', 'Emergency Contact', 'max_length[15]|trim');
        $this->form_validation->set_rules('driver_is_active', 'Driver Active', 'required');

        if($this->form_validation->run() == FALSE){
            $this->load->library('session');
            $this->session->set_flashdata('warning_message', validation_errors());
            $this->driver_edit();
        }
        else{
            $this->load->model('model_driver');

            if($quary = $this->model_driver->updateDriver()){
                $this->load->library('session');
                $this->session->set_flashdata('success_message', 'Successfully Updated.');
                redirect(current_url());
            }
        }
    }

    public function driver_details(){
        $this->load->model('model_driver');

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



        $query = $this->model_driver->getDriverDetails();
        $data['table'] = $this->table->generate($query);

        $this->load->view('home_side_bar');
        $this->load->view('driver/driver_details',$data);

    }




    /** search**/
    public function driver_search(){
        $this->load->model('model_driver');
        if(isset($_GET['term'])){
            $result = $this->model_driver->searchDriver($_GET['term']);
            if(count($result)>0){
                foreach($result as $object)
                    $arr_result[] = $object->Name;

                echo json_encode($arr_result);
            }
        }
    }


    /**custom validation **/

    function driverNameExists($key){
        $this->load->model('model_driver');
        $vehicleNameAvailable = $this->model_driver->driverNameExists($key);
        if($vehicleNameAvailable)
            return false;
        else
            return true;
    }

}