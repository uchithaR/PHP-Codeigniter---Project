<?php

/**
 * Created by PhpStorm.
 * User: Uditha Jay
 * Date: 8/31/2016
 * Time: 4:39 PM
 */
class Other extends CI_Controller{
    public function index()
    {
        $this->other_details();
    }

    public function other_details2(){
        $this->load->model('model_other');

        $this->load->view('home_side_bar');
        $this->load->view('other/other_details');
    }

    public function other_details(){
        $this->load->model('model_other');

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

        $query = $this->model_other->getInstituteDetails();
        $data['institute_table'] = $this->table->generate($query);


        $this->table->set_template($template);

        $query = $this->model_other->getRegisteredInstitutionDetails();
        $data['ri_table'] = $this->table->generate($query);


        $this->table->set_template($template);

        $query = $this->model_other->getVehicleTypeDetails();
        $data['vt_table'] = $this->table->generate($query);


        $this->table->set_template($template);

        $query = $this->model_other->getInsuranceCompanyDetails();
        $data['ic_table'] = $this->table->generate($query);


        $this->table->set_template($template);

        $query = $this->model_other->getMinisterDesignationDetails();
        $data['md_table'] = $this->table->generate($query);


        $this->table->set_template($template);

        $query = $this->model_other->getServiceCenterDetails();
        $data['sc_table'] = $this->table->generate($query);

        $this->load->view('home_side_bar');
        $this->load->view('other/other_details',$data);

    }

}