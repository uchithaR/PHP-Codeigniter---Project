<?php
/**
 * Created by PhpStorm.
 * User: Uditha Jay
 * Date: 8/21/2016
 * Time: 11:16 AM
 */?>
<?php ?>

            <?php
            foreach ($vehicle_details as $object) {
            }
            ?>

            <div class="col-md-3 col-md-3">
            </div>
            <div class="col-md-9">

                </br>
                <form action="<?php echo base_url();?>Vehicle/vehicle_data" method="post">
                    <div class="form-horizontal">
                        <div class="panel panel-info">
                        <div class="panel-heading" style="font-size: large">Edit Vehicle Details</div>
                        <div class="panel-body">

                            <div style="margin-top: 8px" id="message">
                                <?php
                                if($this->session->userdata('search_warning_message') != null)
                                {
                                    echo '<div class="alert alert-warning" role="alert">';
                                    echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                                    echo $this->session->userdata('search_warning_message') <> '' ? $this->session->userdata('search_warning_message') : '';
                                    echo '</div>';
                                    $this->session->set_flashdata('search_warning_message', NULL);
                                }
                                ?>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" style="font-size: medium;">Select Vehicle Number</label>
                                <div class="col-md-4">
                                    <?php
                                    $input_data = array(
                                        'name'  => 'vehicle_name',
                                        'id' => 'vehicle_name',
                                        'class' => 'form-control'
                                    );
                                    echo form_input($input_data, $object->vehicle_no)?>
                                </div>

                                <div class="col-md-2 ">
                                    <?php
                                    $button_data = array(
                                        'name'  => 'submit',
                                        'class' => 'btn btn-default',
                                        'style' => 'width:150px'
                                    );
                                    echo form_submit($button_data, 'Search');?>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </form>




                <form action="<?php echo base_url();?>Vehicle/vehicle_update_to_db" method="post">
                    <div class="form-horizontal">
                        <div class="panel panel-info">
                        <div class="panel-heading" style="font-size: large">Vehicle Details</div>
                        <div class="panel-body">

                            <div style="margin-top: 8px" id="message">
                                <?php
                                if($this->session->userdata('warning_message') != null)
                                {
                                    echo '<div class="alert alert-warning" role="alert">';
                                    echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                                    echo $this->session->userdata('warning_message') <> '' ? $this->session->userdata('warning_message') : '';
                                    echo '</div>';
                                    $this->session->set_flashdata('warning_message', NULL);
                                }
                                ?>
                            </div>
                            <div style="margin-top: 8px" id="message">
                                <?php
                                if($this->session->userdata('success_message') != null)
                                {
                                    echo '<div class="alert alert-success" role="alert">';
                                    echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                                    echo $this->session->userdata('success_message') <> '' ? $this->session->userdata('success_message') : '';
                                    echo '</div>';
                                    $this->session->set_flashdata('success_message', NULL);
                                }
                                ?>
                            </div>

                            <div class="form-group" style="display: none">
                                <label class="col-md-3 control-label" style="font-size: medium;">Vehicle ID</label>
                                <div class="col-md-5">
                                    <?php
                                    $input_data = array(
                                        'name'  => 'vehicle_id',
                                        'class' => 'form-control'
                                    );
                                    echo form_input($input_data, $object->vehicle_id)?>
                                </div>
                                <div class="col-md-1"></div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" style="font-size: medium;">Vehicle Number</label>
                                <div class="col-md-5">
                                    <?php
                                    $input_data = array(
                                        'name'  => 'vehicle_no',
                                        'class' => 'form-control'
                                    );
                                    echo form_input($input_data, $object->vehicle_no)?>
                                </div>
                                <div class="col-md-1"></div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" style="font-size: medium;">File Number</label>
                                <div class="col-md-5 ">
                                    <?php
                                    $input_data2 = array(
                                        'name'  => 'file_no',
                                        'class' => 'form-control'
                                    );
                                    echo form_input($input_data2, $object->vehicle_file_no)?>
                                </div>
                                <div class="col-md-1"></div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" style="font-size: medium;">Manufacture Year</label>
                                <div class="col-md-5 ">
                                    <?php
                                    $input_data3 = array(
                                        'name'  => 'vehicle_manufacture_year',
                                        'class' => 'form-control'
                                    );
                                    echo form_input($input_data3, $object->vehicle_manufacture_year)?>
                                </div>
                                <div class="col-md-1"></div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" style="font-size: medium;">Insurance</label>
                                <div class="col-md-5 ">
                                    <?php
                                    $input_data4 = array(
                                        'name'  => 'vehicle_insurance',
                                        'id' => 'vehicle_insurance',
                                        'class' => 'form-control',
                                        'data-date-format' => 'yyyy/mm/dd',
                                        'readonly'=>'readonly'
                                    );
                                    echo form_input($input_data4, $object->vehicle_insurance)?>
                                </div>
                                <div class="col-md-1"></div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" style="font-size: medium;">Revenue</label>
                                <div class="col-md-5 ">
                                    <?php
                                    $input_data5 = array(
                                        'name'  => 'vehicle_revenue',
                                        'id' => 'vehicle_revenue',
                                        'class' => 'form-control',
                                        'data-date-format' => 'yyyy/mm/dd',
                                        'readonly'=>'readonly'
                                    );
                                    echo form_input($input_data5, $object->vehicle_revenue)?>
                                </div>
                                <div class="col-md-1"></div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" style="font-size: medium;">Institute</label>
                                <div class="col-md-5 ">
                                    <?php
                                    $input_data6 = array(
                                        'name'  => 'institute_id',
                                        'class' => 'form-control'
                                    );
                                    echo form_dropdown($input_data6, $institute_names, $object->institute_id);?>
                                </div>
                                <div class="col-md-1 control-label" >
                                    <a href="<?php echo base_url()?>Institute/institute_add"><i class="fa fa-plus fa-lg" ></i></a>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" style="font-size: medium;">Registered Institution</label>
                                <div class="col-md-5 ">
                                    <?php
                                    $input_data7 = array(
                                        'name'  => 'ri_id',
                                        'class' => 'form-control'
                                    );
                                    echo form_dropdown($input_data7, $registered_institute_names, $object->ri_id);?>
                                </div>
                                <div class="col-md-1 control-label" >
                                    <a href="<?php echo base_url()?>Registered_institution/registered_institution_add"><i class="fa fa-plus fa-lg" ></i></a>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" style="font-size: medium;">Vehicle Type</label>
                                <div class="col-md-5">
                                    <?php
                                    $input_data8 = array(
                                        'name'  => 'vt_id',
                                        'class' => 'form-control'
                                    );
                                    echo form_dropdown($input_data8, $vehicle_types, $object->vt_id);?>
                                </div>
                                <div class="col-md-1 control-label" >
                                    <a href="<?php echo base_url()?>Vehicle_type/vehicle_type_add"><i class="fa fa-plus fa-lg" ></i></a>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" style="font-size: medium;">Vehicle Active</label>

                                <div class="col-md-1 control-label" >Yes</div>
                                <div class="col-md-1">
                                    <?php
                                    $input_data9 = array(
                                        'name'  => 'vehicle_is_active',
                                        'class' => 'radio'
                                    );
                                    echo form_radio($input_data9, '1', $object->vehicle_is_active);?>
                                </div>

                                <div class="col-md-1 control-label" >No</div>
                                <div class="col-md-1">
                                    <?php
                                    $input_data9 = array(
                                        'name'  => 'vehicle_is_active',
                                        'class' => 'radio'
                                    );
                                    echo form_radio($input_data9, '0', !$object->vehicle_is_active); ?>
                                </div>

                                <div class="col-md-2 control-label" >
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-3">
                                    <?php
                                    $button_data = array(
                                        'name'  => 'reset',
                                        'class' => 'btn btn-default',
                                        'style' => 'width:150px'
                                    );
                                    echo form_reset($button_data,'Reset');?>
                                </div>
                                <div class="col-md-2 ">
                                    <?php
                                    $button_data2 = array(
                                        'name'  => 'submit',
                                        'class' => 'btn btn-default',
                                        'style' => 'width:150px'
                                    );
                                    echo form_submit($button_data2, 'Submit');?>
                                </div>
                                <div class="col-md-1">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>



            </div>
</body>
</html>




