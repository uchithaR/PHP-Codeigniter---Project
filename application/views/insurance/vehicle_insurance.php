<?php
/**
 * Created by PhpStorm.
 * User: Uditha Jay
 * Date: 8/25/2016
 * Time: 10:30 AM
 */?>

        <div class="col-md-3">
        </div>
        <div class="col-md-9">

            </br>
            <form action="<?php echo base_url();?>Insurance/vehicle_insurance_to_db" method="post">
                <div class="form-horizontal">
                    <div class="panel panel-info">
                    <div class="panel-heading" style="font-size: large">Vehicle Insurance</div>
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
                            <label class="col-md-3 control-label" style="font-size: medium;">Vehicle Number</label>
                            <div class="col-md-5 ">
                                <?php
                                $input_data1 = array(
                                    'name'  => 'insurance_active_vehicle_name',
                                    'id' => 'insurance_active_vehicle_name',
                                    'class' => 'form-control'
                                );
                                echo form_input($input_data1)?>
                            </div>
                            <div class="col-md-1 control-label" >

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" style="font-size: medium;">Insurance Company</label>
                            <div class="col-md-5 ">
                                <?php
                                $input_data2 = array(
                                    'name'  => 'ic_id',
                                    'class' => 'form-control'
                                );
                                echo form_dropdown($input_data2, $insurance_companies, '');?>
                            </div>
                            <div class="col-md-1 control-label" >
                                <a href="<?php echo base_url()?>Insurance/insurance_company_add"><i class="fa fa-plus fa-lg" ></i></a>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" style="font-size: medium;">Name</label>
                            <div class="col-md-5 ">
                                <?php
                                $input_data6 = array(
                                    'name'  => 'vi_name',
                                    'class' => 'form-control'
                                );
                                echo form_input($input_data6)?>
                            </div>
                            <div class="col-md-1"></div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" style="font-size: medium;">From</label>
                            <div class="col-md-5 ">
                                <?php
                                $input_data4 = array(
                                    'name'  => 'vi_from_date',
                                    'id' => 'vi_from_date',
                                    'class' => 'form-control',
                                    'data-date-format' => 'yyyy/mm/dd',
                                    'readonly'=>'readonly'
                                );
                                echo form_input($input_data4)?>
                            </div>
                            <div class="col-md-1"></div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" style="font-size: medium;">To</label>
                            <div class="col-md-5 ">
                                <?php
                                $input_data4 = array(
                                    'name'  => 'vi_to_date',
                                    'id' => 'vi_to_date',
                                    'class' => 'form-control',
                                    'data-date-format' => 'yyyy/mm/dd',
                                    'readonly'=>'readonly'
                                );
                                echo form_input($input_data4)?>
                            </div>
                            <div class="col-md-1"></div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" style="font-size: medium;">Description</label>
                            <div class="col-md-5 ">
                                <?php
                                $input_data5 = array(
                                    'name'  => 'vi_description',
                                    'rows'        => '5',
                                    'class' => 'form-control'
                                );
                                echo form_textarea($input_data5)?>
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
            </form>
        </div>

    </body>
</html>

