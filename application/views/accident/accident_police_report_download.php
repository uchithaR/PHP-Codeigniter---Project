<?php
/**
 * Created by PhpStorm.
 * User: Uditha Jay
 * Date: 8/27/2016
 * Time: 7:58 PM
 */?>
                <?php
                foreach ($view_police_report as $object) {
                }
                ?>


                <div class="tab-pane fade active in" id="download">
                    </br><h4>View Police Reports For Accidents</h4>
                    <?php/** echo form_open_multipart('accident/accident_police_report_get_from_db'); **/?>
                    <form action="<?php echo base_url();?>Accident/accident_police_report_get_from_db" method="post">

                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-md-3 control-label" style="font-size: medium;">Select Accident</label>
                            <div class="col-md-4">
                                <?php
                                $input_data = array(
                                    'name'  => 'apr_accident_name2',
                                    'id' => 'apr_accident_name2',
                                    'class' => 'form-control'
                                );
                                echo form_input($input_data, $object->Name)?>
                            </div>
                            <div class="col-md-2 ">
                                <?php
                                $button_data2 = array(
                                    'name'  => 'submit',
                                    'class' => 'btn btn-default',
                                    'style' => 'width:150px'
                                );
                                echo form_submit($button_data2, 'Search');?>
                            </div>
                        </div>
                    </div>


                    <div class="form-horizontal">
                        <div class="form-group">
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-7">
                                <div style="position: relative; left: 0; top: 0;">
                                    <img src="<?php echo base_url()?>images/upload/policereport/<?php echo($object->pr_path)?>" width="750px" style="position: relative; top: 0; left: 0;">
                                    <a download="custom-filename.jpg" href="<?php echo base_url()?>images/upload/policereport/<?php echo($object->pr_path)?>" title="ImageName">
                                        <img alt="ImageName" src="<?php echo base_url()?>images/savebutton.png" width="20px" style="position: absolute; top: 30px; left: 700px;">
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-1">
                            </div>
                        </div>
                        <?php /**
                        <div class="form-group">
                            <div class="col-md-7">
                            </div>
                            <div class="col-md-2">
                                <a download="custom-filename.jpg" href="<?php echo base_url()?>images/upload/policereport/<?php echo($object->pr_path)?>" title="ImageName">
                                    <img alt="ImageName" src="<?php echo base_url()?>images/savebutton.png" width="20px">
                                </a>
                            </div>
                        </div>**/
                        ?>

                    </div>
                        </form>
                </div>


            </div>
</div> </div>

        </div>
    </body>
</html>

