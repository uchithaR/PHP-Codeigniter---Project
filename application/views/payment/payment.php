<?php
/**
 * Created by PhpStorm.
 * User: Uditha Jay
 * Date: 8/29/2016
 * Time: 11:37 PM
 */?>

        <div class="col-md-3">
        </div>
        <div class="col-md-9">
            </br>

            <form action="<?php echo base_url();?>Payment/payment_insert_to_db" method="post">
                <div class="form-horizontal">
                    <div class="panel panel-info">
                        <div class="panel-heading" style="font-size: large">Payment</div>
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
                                    <label class="col-md-3 control-label" style="font-size: medium;">File Number</label>
                                    <div class="col-md-5">
                                        <?php
                                        $input_data = array(
                                            'name'  => 'payment_file_no',
                                            'class' => 'form-control'
                                        );
                                        echo form_input($input_data, set_value('payment_file_no'))?>
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" style="font-size: medium;">Payment Occurred Date</label>
                                    <div class="col-md-5 ">
                                        <?php
                                        $input_data2 = array(
                                            'name'  => 'payment_occurred_date',
                                            'id' => 'payment_occurred_date',
                                            'class' => 'form-control',
                                            'data-date-format' => 'yyyy/mm/dd',
                                            'readonly'=>'readonly'
                                        );
                                        echo form_input($input_data2, set_value('payment_occurred_date'))?>
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" style="font-size: medium;">Description</label>
                                    <div class="col-md-5 ">
                                        <?php
                                        $input_data3 = array(
                                            'name'  => 'payment_description',
                                            'rows'  => '5',
                                            'class' => 'form-control'
                                        );
                                        echo form_textarea($input_data3, set_value('payment_description'))?>
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" style="font-size: medium;">Bill Date</label>
                                    <div class="col-md-5 ">
                                        <?php
                                        $input_data4 = array(
                                            'name'  => 'payment_bill_date',
                                            'id' => 'payment_bill_date',
                                            'class' => 'form-control',
                                            'data-date-format' => 'yyyy/mm/dd',
                                            'readonly'=>'readonly'
                                        );
                                        echo form_input($input_data4, set_value('payment_bill_date'))?>
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" style="font-size: medium;">Vehicle Number</label>
                                    <div class="col-md-5 ">
                                        <?php
                                        $input_data = array(
                                            'name'  => 'payment_vehicle_name',
                                            'id' => 'payment_vehicle_name',
                                            'class' => 'form-control'
                                        );
                                        echo form_input($input_data, set_value('payment_vehicle_name'))?>
                                    </div>
                                    <div class="col-md-1 control-label" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" style="font-size: medium;">Vehicle Mileage</label>
                                    <div class="col-md-5 ">
                                        <?php
                                        $input_data5 = array(
                                            'name'  => 'payment_vehicle_mileage',
                                            'class' => 'form-control'
                                        );
                                        echo form_input($input_data5, set_value('payment_vehicle_mileage'))?>
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" style="font-size: medium;">Service Center</label>
                                    <div class="col-md-5 ">
                                        <?php
                                        $input_data9 = array(
                                            'name'  => 'sc_id',
                                            'class' => 'form-control'
                                        );
                                        echo form_dropdown($input_data9, $service_centers, set_value('sc_id'));?>
                                    </div>
                                    <div class="col-md-1 control-label" >
                                        <a href="<?php echo base_url()?>Accident/service_centerss_add"><i class="fa fa-plus fa-lg" ></i></a>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" style="font-size: medium;">Invoice Number</label>
                                    <div class="col-md-5 ">
                                        <?php
                                        $input_data6 = array(
                                            'name'  => 'payment_invoice_no',
                                            'class' => 'form-control'
                                        );
                                        echo form_input($input_data6, set_value('payment_invoice_no'))?>
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" style="font-size: medium;">Amount</label>
                                    <div class="col-md-5 ">
                                        <?php
                                        $input_data7 = array(
                                            'name'  => 'payment_amount',
                                            'class' => 'form-control'
                                        );
                                        echo form_input($input_data7, set_value('payment_amount'))?>
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