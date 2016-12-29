<?php
/**
 * Created by PhpStorm.
 * User: Uditha Jay
 * Date: 8/23/2016
 * Time: 3:13 PM
 */
?>

        <div class="col-md-3">
        </div>
        <div class="col-md-9">
            </br>
            <div class="panel panel-info">
                <div class="panel-heading" style="font-size: large">Assign Drivers to Ministers</div>
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
                        <li class="active"><a href="#assign_drivers" data-toggle="tab" aria-expanded="true">Assign Drivers</a></li>
                        <li class=""><a href="#change_drivers" data-toggle="tab" aria-expanded="false">Re-Assign Drivers</a></li>
                        <li class=""><a href="#remove_drivers" data-toggle="tab" aria-expanded="false">Remove Drivers</a></li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane fade active in" id="assign_drivers">

                            </br><h4>Assign Drivers</h4>
                            <form action="<?php echo base_url();?>Minister/minister_assign_drivers_to_db" method="post">
                                <div class="form-horizontal">
                                    <div class="form-group">
                                        <label class="col-md-1 control-label" style="font-size: medium;">Minister</label>
                                        <div class="col-md-3">

                                            <?php
                                            $input_data1 = array(
                                                'name'  => 'driver_not_assigned_minister_name',
                                                'id' => 'driver_not_assigned_minister_name',
                                                'class' => 'form-control'
                                            );
                                            echo form_input($input_data1)?>
                                        </div>
                                        <div class="col-md-1"></div>

                                        <label class="col-md-1 control-label" style="font-size: medium;">Driver</label>
                                        <div class="col-md-3 ">
                                            <?php
                                            $input_data2 = array(
                                                'name'  => 'driver_not_assigned_driver_name',
                                                'id' => 'driver_not_assigned_driver_name',
                                                'class' => 'form-control'
                                            );
                                            echo form_input($input_data2)?>

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
                                                'style' => 'width:225px'
                                            );
                                            echo form_reset($button_data,'Reset');?>
                                        </div>
                                        <div class="col-md-3">
                                            <?php
                                            $button_data2 = array(
                                                'name'  => 'submit',
                                                'class' => 'btn btn-default',
                                                'style' => 'width:225px'
                                            );
                                            echo form_submit($button_data2, 'Assign');?>
                                        </div>
                                        <div class="col-md-1">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="change_drivers">

                            </br><h4>Re-Assign Drivers</h4>
                            <form action="<?php echo base_url();?>Minister/minister_reassign_drivers_to_db" method="post">
                                <div class="form-horizontal">
                                    <div class="form-group">
                                        <label class="col-md-1 control-label" style="font-size: medium;">Minister</label>
                                        <div class="col-md-3">
                                            <?php
                                            $input_data3 = array(
                                                'name'  => 'driver_assigned_minister_name',
                                                'id' => 'driver_assigned_minister_name',
                                                'class' => 'form-control'
                                            );
                                            echo form_input($input_data3)?>

                                        </div>
                                        <div class="col-md-1"></div>

                                        <label class="col-md-1 control-label" style="font-size: medium;">Driver</label>
                                        <div class="col-md-3 ">
                                            <?php
                                            $input_data4 = array(
                                                'name'  => 'driver_not_assigned_driver_name2',
                                                'id' => 'driver_not_assigned_driver_name2',
                                                'class' => 'form-control'
                                            );
                                            echo form_input($input_data4)?>
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
                                                'style' => 'width:225px'
                                            );
                                            echo form_reset($button_data,'Reset');?>
                                        </div>
                                        <div class="col-md-3">
                                            <?php
                                            $button_data2 = array(
                                                'name'  => 'submit',
                                                'class' => 'btn btn-default',
                                                'style' => 'width:225px'
                                            );
                                            echo form_submit($button_data2, 'Re-Assign');?>
                                        </div>
                                        <div class="col-md-1">
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <div class="tab-pane fade" id="remove_drivers">

                            </br><h4>Remove Drivers</h4>
                            <form action="<?php echo base_url();?>Minister/minister_remove_drivers_from_db" method="post">
                                <div class="form-horizontal">
                                    <div class="form-group">
                                        <label class="col-md-1 control-label" style="font-size: medium;">Minister</label>
                                        <div class="col-md-3">
                                            <?php
                                            $input_data5 = array(
                                                'name'  => 'driver_assigned_minister_name2',
                                                'id' => 'driver_assigned_minister_name2',
                                                'class' => 'form-control'
                                            );
                                            echo form_input($input_data5)?>
                                        </div>
                                        <div class="col-md-1"></div>


                                        <div class="col-md-3" style="display: none">
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
                                                'style' => 'width:225px'
                                            );
                                            echo form_reset($button_data,'Reset');?>
                                        </div>
                                        <div class="col-md-3">
                                            <?php
                                            $button_data2 = array(
                                                'name'  => 'submit',
                                                'class' => 'btn btn-default',
                                                'style' => 'width:225px'
                                            );
                                            echo form_submit($button_data2, 'Remove');?>
                                        </div>
                                        <div class="col-md-1">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-info">
                <div class="panel-heading" style="font-size: large">Driver Assigned Details</div>
                <div class="panel-body">

                    <div class="col-md-1">
                    </div>

                    <div class="col-md-7">
                        <div class="table-responsive">
                            <?php echo($table); ?>
                        </div>
                    </div>

                    <div class="col-md-1">
                    </div>
            </div>
            </div>

        </div>

    </body>
</html>