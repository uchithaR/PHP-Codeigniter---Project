<?php
/**
 * Created by PhpStorm.
 * User: Uditha Jay
 * Date: 8/23/2016
 * Time: 2:17 PM
 */?>
        <?php
        foreach ($driver_details as $object) {
        }
        ?>

        <div class="col-md-3">
        </div>
        <div class="col-md-9">
</br>
            <form action="<?php echo base_url();?>Driver/driver_data" method="post">
                <div class="form-horizontal">
                    <div class="panel panel-info">
                        <div class="panel-heading" style="font-size: large">Edit Driver Details</div>
                        <div class="panel-body">

                            <div style="margin-top: 8px" id="message">
                                <?php
                                if($this->session->userdata('driver_warning_message') != null)
                                {
                                    echo '<div class="alert alert-warning" role="alert">';
                                    echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                                    echo $this->session->userdata('driver_warning_message') <> '' ? $this->session->userdata('driver_warning_message') : '';
                                    echo '</div>';
                                    $this->session->set_flashdata('driver_warning_message', NULL);
                                }
                                ?>
                            </div>

                            <div class="form-group">
                            <label class="col-md-3 control-label" style="font-size: medium;">Select Driver</label>
                            <div class="col-md-4">
                                <?php
                                $input_data = array(
                                    'name'  => 'driver_name',
                                    'id' => 'driver_name',
                                    'class' => 'form-control'
                                );
                                echo form_input($input_data, $object->driver_fname . ' ' . $object->driver_lname)?>

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



            <form action="<?php echo base_url();?>Driver/driver_update_to_db" method="post">
                <div class="form-horizontal">
                    <div class="panel panel-info">
                        <div class="panel-heading" style="font-size: large">Edit Details</div>
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
                                <label class="col-md-3 control-label" style="font-size: medium;">Driver ID</label>
                                <div class="col-md-5">
                                    <?php
                                    $input_data = array(
                                        'name'  => 'driver_id',
                                        'class' => 'form-control'
                                    );
                                    echo form_input($input_data, $object->driver_id)?>
                                </div>
                                <div class="col-md-1"></div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" style="font-size: medium;">First Name</label>
                                <div class="col-md-5">
                                    <?php
                                    $input_data = array(
                                        'name'  => 'driver_fname',
                                        'class' => 'form-control',
                                    );
                                    echo form_input($input_data, $object->driver_fname)?>
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
                                    echo form_input($input_data2, $object->driver_lname)?>
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
                                    echo form_input($input_data3, $object->driver_contact1)?>
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
                                    echo form_input($input_data4, $object->driver_contact2)?>
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
                                    echo form_input($input_data5, $object->driver_nic)?>
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
                                    echo form_input($input_data6, $object->driver_licence_num)?>
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
                                    echo form_input($input_data7, $object->driver_emergency_contact)?>
                                </div>
                                <div class="col-md-1"></div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" style="font-size: medium;">Driver Active</label>

                                <div class="col-md-1 control-label" >Yes</div>
                                <div class="col-md-1">
                                    <?php
                                    $input_data9 = array(
                                        'name'  => 'driver_is_active',
                                        'class' => 'radio'
                                    );
                                    echo form_radio($input_data9, '1', $object->driver_is_active);?>
                                </div>

                                <div class="col-md-1 control-label" >No</div>
                                <div class="col-md-1">
                                    <?php
                                    $input_data9 = array(
                                        'name'  => 'driver_is_active',
                                        'class' => 'radio'
                                    );
                                    echo form_radio($input_data9, '0', !$object->driver_is_active); ?>
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

                </div>
            </form>

        </div>

</body>
</html>


