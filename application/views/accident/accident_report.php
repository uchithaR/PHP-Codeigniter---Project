<?php
/**
 * Created by PhpStorm.
 * User: Uditha Jay
 * Date: 8/25/2016
 * Time: 3:35 PM
 */?>

        <div class="col-md-3">
        </div>
        <div class="col-md-9">
            </br>

            <form action="<?php echo base_url();?>Accident/accident_insert_to_db" method="post">
                <div class="form-horizontal">
                    <div class="panel panel-info">
                        <div class="panel-heading" style="font-size: large">Report Accidents</div>
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

                            <div class="form-group">
                                <label class="col-md-3 control-label" style="font-size: medium;">Vehicle</label>
                                <div class="col-md-5 ">
                                    <?php
                                    $input_data = array(
                                    'name'  => 'accident_active_vehicle_name',
                                    'id' => 'accident_active_vehicle_name',
                                    'class' => 'form-control'
                                    );
                                    echo form_input($input_data, set_value('accident_active_vehicle_name'))?>
                                </div>
                                <div class="col-md-1 control-label" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" style="font-size: medium;">Accident Details</label>
                                <div class="col-md-5">
                                    <?php
                                    $input_data = array(
                                        'name'  => 'accident_description',
                                        'class' => 'form-control',
                                    );
                                    echo form_input($input_data, set_value('accident_description'))?>
                                </div>
                                <div class="col-md-1"></div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" style="font-size: medium;">Date</label>
                                <div class="col-md-5 ">
                                    <?php
                                    $input_data5 = array(
                                        'name'  => 'accident_date',
                                        'id' => 'accident_date',
                                        'class' => 'form-control',
                                        'data-date-format' => 'yyyy/mm/dd',
                                        'readonly'=>'readonly'
                                    );
                                    echo form_input($input_data5, set_value('accident_date'))?>
                                </div>
                                <div class="col-md-1"></div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" style="font-size: medium;">On The Spot</label>

                                <div class="col-md-1 control-label" >Yes</div>
                                <div class="col-md-1">
                                    <?php
                                    $input_data2 = array(
                                        'name'  => 'accident_onthespot',
                                        'class' => 'radio'
                                    );
                                    echo form_radio($input_data2, '1', 1);?>
                                </div>

                                <div class="col-md-1 control-label" >No</div>
                                <div class="col-md-1">
                                    <?php
                                    $input_data3 = array(
                                        'name'  => 'accident_onthespot',
                                        'class' => 'radio'
                                    );
                                    echo form_radio($input_data3, '0'); ?>
                                </div>

                                <div class="col-md-2 control-label" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" style="font-size: medium;">Insurance Number</label>
                                <div class="col-md-5 ">
                                    <?php
                                    $input_data4 = array(
                                        'name'  => 'accident_insurance_no',
                                        'class' => 'form-control'
                                    );
                                    echo form_input($input_data4, set_value('accident_insurance_no'))?>
                                </div>
                                <div class="col-md-1"></div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" style="font-size: medium;">Service Center</label>
                                <div class="col-md-5 ">
                                    <?php
                                    $input_data6 = array(
                                        'name'  => 'sc_id',
                                        'class' => 'form-control'
                                    );
                                    echo form_dropdown($input_data6, $service_centers, set_value('sc_id'));?>
                                </div>
                                <div class="col-md-1 control-label" >
                                    <a href="<?php echo base_url();?>Accident/service_center_add"><i class="fa fa-plus fa-lg" ></i></a>
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
                </div>
            </form>
        </div>


    </body>
</html>