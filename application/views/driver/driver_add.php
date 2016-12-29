<?php
/**
 * Created by PhpStorm.
 * User: Uditha Jay
 * Date: 8/23/2016
 * Time: 10:52 AM
 */?>

<div class="col-md-3">
</div>
<div class="col-md-9">

        </br>
        <form action="<?php echo base_url();?>Driver/driver_insert_to_db" method="post">
            <div class="form-horizontal">
                <div class="panel panel-info">
                    <div class="panel-heading"><h3>Add Driver</h3></div>
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
                        <label class="col-md-3 control-label" style="font-size: medium;">First Name</label>
                        <div class="col-md-5">
                            <?php
                            $input_data = array(
                                'name'  => 'driver_fname',
                                'class' => 'form-control',
                            );
                            echo form_input($input_data, set_value('driver_fname'))?>
                        </div>
                        <div class="col-md-1"></div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" style="font-size: medium;">Last Name</label>
                        <div class="col-md-5 ">
                            <?php
                            $input_data2 = array(
                                'name'  => 'driver_lname',
                                'class' => 'form-control'
                            );
                            echo form_input($input_data2, set_value('driver_lname'))?>
                        </div>
                        <div class="col-md-1"></div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" style="font-size: medium;">Contact Number 01</label>
                        <div class="col-md-5 ">
                            <?php
                            $input_data3 = array(
                                'name'  => 'driver_contact1',
                                'class' => 'form-control'
                            );
                            echo form_input($input_data3, set_value('driver_contact1'))?>
                        </div>
                        <div class="col-md-1"></div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" style="font-size: medium;">Contact Number 02</label>
                        <div class="col-md-5 ">
                            <?php
                            $input_data4 = array(
                                'name'  => 'driver_contact2',
                                'class' => 'form-control'
                            );
                            echo form_input($input_data4, set_value('driver_contact2'))?>
                        </div>
                        <div class="col-md-1"></div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" style="font-size: medium;">NIC</label>
                        <div class="col-md-5 ">
                            <?php
                            $input_data5 = array(
                                'name'  => 'driver_nic',
                                'class' => 'form-control'
                            );
                            echo form_input($input_data5, set_value('driver_nic'))?>
                        </div>
                        <div class="col-md-1"></div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" style="font-size: medium;">Driver Licence</label>
                        <div class="col-md-5 ">
                            <?php
                            $input_data6 = array(
                                'name'  => 'driver_licence_num',
                                'class' => 'form-control'
                            );
                            echo form_input($input_data6, set_value('driver_licence_num'))?>
                        </div>
                        <div class="col-md-1"></div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" style="font-size: medium;">Emergency Contact</label>
                        <div class="col-md-5 ">
                            <?php
                            $input_data7 = array(
                                'name'  => 'driver_emergency_contact',
                                'class' => 'form-control'
                            );
                            echo form_input($input_data7, set_value('driver_emergency_contact'))?>
                        </div>
                        <div class="col-md-1"></div>
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