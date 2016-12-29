<?php
/**
 * Created by PhpStorm.
 * User: Uditha Jay
 * Date: 8/22/2016
 * Time: 5:33 PM
 */?>
        <?php
        foreach ($ministers_details as $object) {
        }
        ?>

        <div class="col-md-3">
        </div>
        <div class="col-md-9">
            </br>
            <form action="<?php echo base_url();?>Minister/minister_data" method="post">
                <div class="form-horizontal">
                    <div class="panel panel-info">
                        <div class="panel-heading"><h3>Edit Minister Details</h3></div>
                        <div class="panel-body">

                            <div style="margin-top: 8px" id="message">
                                <?php
                                if($this->session->userdata('minister_warning_message') != null)
                                {
                                    echo '<div class="alert alert-warning" role="alert">';
                                    echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                                    echo $this->session->userdata('minister_warning_message') <> '' ? $this->session->userdata('minister_warning_message') : '';
                                    echo '</div>';
                                    $this->session->set_flashdata('minister_warning_message', NULL);
                                }
                                ?>
                            </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" style="font-size: medium;">Select Minister</label>
                            <div class="col-md-4">
                                <?php
                                $input_data = array(
                                    'name'  => 'minister_name',
                                    'id' => 'minister_name',
                                    'class' => 'form-control'
                                );
                                echo form_input($input_data, $object->minister_fname . ' ' . $object->minister_lname)?>
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



            <form action="<?php echo base_url();?>Minister/minister_update_to_db" method="post">
                <div class="form-horizontal">
                    <div class="panel panel-info">
                        <div class="panel-heading" style="font-size: large">Minister Details</div>
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
                            <label class="col-md-3 control-label" style="font-size: medium;">Minister ID</label>
                            <div class="col-md-5">
                                <?php
                                $input_data = array(
                                    'name'  => 'minister_id',
                                    'class' => 'form-control'
                                );
                                echo form_input($input_data, $object->minister_id)?>
                            </div>
                            <div class="col-md-1"></div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" style="font-size: medium;">First Name</label>
                            <div class="col-md-5">
                                <?php
                                $input_data = array(
                                    'name'  => 'minister_fname',
                                    'class' => 'form-control',
                                );
                                echo form_input($input_data, $object->minister_fname)?>
                            </div>
                            <div class="col-md-1"></div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" style="font-size: medium;">Last Name</label>
                            <div class="col-md-5 ">
                                <?php
                                $input_data2 = array(
                                    'name'  => 'minister_lname',
                                    'class' => 'form-control'
                                );
                                echo form_input($input_data2, $object->minister_lname)?>
                            </div>
                            <div class="col-md-1"></div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" style="font-size: medium;">Contact No 01</label>
                            <div class="col-md-5 ">
                                <?php
                                $input_data3 = array(
                                    'name'  => 'minister_contact1',
                                    'class' => 'form-control'
                                );
                                echo form_input($input_data3, $object->minister_contact1)?>
                            </div>
                            <div class="col-md-1"></div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" style="font-size: medium;">Contact No 02</label>
                            <div class="col-md-5 ">
                                <?php
                                $input_data3 = array(
                                    'name'  => 'minister_contact2',
                                    'class' => 'form-control'
                                );
                                echo form_input($input_data3, $object->minister_contact2)?>
                            </div>
                            <div class="col-md-1"></div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" style="font-size: medium;">Designation</label>
                            <div class="col-md-5 ">
                                <?php
                                $input_data6 = array(
                                    'name'  => 'md_id',
                                    'class' => 'form-control'
                                );
                                echo form_dropdown($input_data6, $minister_designations, '');?>
                            </div>
                            <div class="col-md-1 control-label" >
                                <a href="<?php echo base_url()?>Minister/minister_designation_add"><i class="fa fa-plus fa-lg" ></i></a>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" style="font-size: medium;">Minister Active</label>

                            <div class="col-md-1 control-label" >Yes</div>
                            <div class="col-md-1">
                                <?php
                                $input_data9 = array(
                                    'name'  => 'minister_is_active',
                                    'class' => 'radio'
                                );
                                echo form_radio($input_data9, '1', $object->minister_is_active);?>
                            </div>

                            <div class="col-md-1 control-label" >No</div>
                            <div class="col-md-1">
                                <?php
                                $input_data9 = array(
                                    'name'  => 'minister_is_active',
                                    'class' => 'radio'
                                );
                                echo form_radio($input_data9, '0', !$object->minister_is_active); ?>
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