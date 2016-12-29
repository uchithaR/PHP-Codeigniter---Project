<?php
/**
 * Created by PhpStorm.
 * User: Uditha Jay
 * Date: 8/31/2016
 * Time: 4:40 PM
 */?>

<div class="col-md-3">
</div>
<div class="col-md-9">
    </br>
    <div class="panel panel-info">
        <div class="panel-heading" style="font-size: large">Other Details</div>
        <div class="panel-body">

            <ul class="nav nav-tabs">
                <li class="active"><a href="#institute" data-toggle="tab" aria-expanded="true">Institute</a></li>
                <li class=""><a href="#registered_institution" data-toggle="tab" aria-expanded="false">Registered Institution</a></li>
                <li class=""><a href="#vehicle_type" data-toggle="tab" aria-expanded="false">Vehicle Type</a></li>
                <li class=""><a href="#insurance_company" data-toggle="tab" aria-expanded="false">Insurance Company</a></li>
                <li class=""><a href="#minister_designation" data-toggle="tab" aria-expanded="false">Minister Designation</a></li>
                <li class=""><a href="#service_center" data-toggle="tab" aria-expanded="false">Service Center</a></li>
            </ul>

            <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active in" id="institute">
                    <br><h4>Institute</h4>
                    <?php echo($institute_table); ?>
                </div>

                <div class="tab-pane fade" id="registered_institution">
                    </br><h4>Registered Institution</h4>
                    <?php echo($ri_table); ?>
                </div>

                <div class="tab-pane fade" id="vehicle_type">
                    </br><h4>Vehicle Type</h4>
                    <?php echo($vt_table); ?>
                </div>

                <div class="tab-pane fade" id="insurance_company">
                    </br><h4>Insurance Company</h4>
                    <?php echo($ic_table); ?>
                </div>

                <div class="tab-pane fade" id="minister_designation">
                    </br><h4>Minister Designation</h4>
                    <?php echo($md_table); ?>
                </div>

                <div class="tab-pane fade" id="service_center">
                    </br><h4>Service Center</h4>
                    <?php echo($sc_table); ?>
                </div>
            </div>
        </div></div>


    </div>
</body>
</html>