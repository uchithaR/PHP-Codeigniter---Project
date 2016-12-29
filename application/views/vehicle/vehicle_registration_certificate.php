<?php
/**
 * Created by PhpStorm.
 * User: Uditha Jay
 * Date: 8/29/2016
 * Time: 4:11 PM
 */?>


        <div class="col-md-3">
        </div>
        <div class="col-md-9">
            <?php echo('</br>');?>
            <div class="panel panel-info">
                <div class="panel-heading" style="font-size: large">Vehicle Registration Certificate</div>
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

                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#download" data-toggle="tab">View Vehicle Registration Certificate</a></li>
                        <li class=""><a href="#upload" data-toggle="tab">Upload Vehicle Registration Certificate</a></li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane fade" id="upload">
                            <h3>Upload Vehicle Registration Certificate</h3>

                            <?php echo form_open_multipart('Vehicle/vehicle_registration_certificate_insert_to_db'); ?>

                            <div class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-md-3 control-label" style="font-size: medium;">Select Vehicle</label>
                                    <div class="col-md-4">
                                        <?php
                                        $input_data = array(
                                            'name'  => 'vrc_active_vehicle_name',
                                            'id' => 'vrc_active_vehicle_name',
                                            'class' => 'form-control'
                                        );
                                        echo form_input($input_data)?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" style="font-size: medium;">Select File</label>
                                    <div class="col-md-4">
                                        <?php echo form_upload('userfile');?>
                                    </div>
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
                            <?php echo form_close() ?>
                        </div>





