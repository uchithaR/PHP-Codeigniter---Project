<?php
/**
 * Created by PhpStorm.
 * User: Uditha Jay
 * Date: 8/30/2016
 * Time: 2:32 PM
 */?>
        <div class="col-md-3">
        </div>
        <div class="col-md-9">

            </br>

            <form action="<?php echo base_url();?>Payment/payment_cheque_insert_to_db" method="post">
                <div class="form-horizontal">
                    <div class="panel panel-info">
                        <div class="panel-heading" style="font-size: large">Payment Cheque</div>
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
                                <label class="col-md-3 control-label" style="font-size: medium;">Payment</label>
                                <div class="col-md-4">
                                    <?php
                                    $input_data = array(
                                        'name'  => 'payment_voucher_name',
                                        'id' => 'payment_voucher_name',
                                        'class' => 'form-control'
                                    );
                                    echo form_input($input_data, set_value('payment_voucher_name'))?>
                                </div>
                                <div class="col-md-1"></div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" style="font-size: medium;">Voucher Number</label>
                                <div class="col-md-5 ">
                                    <?php
                                    $input_data2 = array(
                                        'name'  => 'pc_cheque_no',
                                        'class' => 'form-control'
                                    );
                                    echo form_input($input_data2, set_value('pc_cheque_no'))?>
                                </div>
                                <div class="col-md-1"></div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" style="font-size: medium;">Voucher Submitted Date</label>
                                <div class="col-md-5 ">
                                    <?php
                                    $input_data3 = array(
                                        'name'  => 'pc_date',
                                        'id' => 'pc_date',
                                        'class' => 'form-control',
                                        'data-date-format' => 'yyyy/mm/dd',
                                        'readonly'=>'readonly'
                                    );
                                    echo form_input($input_data3, set_value('pc_date'))?>
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