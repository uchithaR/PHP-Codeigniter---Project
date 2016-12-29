<?php
/**
 * Created by PhpStorm.
 * User: Uditha Jay
 * Date: 8/18/2016
 * Time: 1:53 PM
 */?>
<?php ?>

<html class="no-js">
    <head>
        <title>VRIMS</title>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <link href="<?php echo base_url(); ?>css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

        <link href="<?php echo base_url(); ?>css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>

        <link href="<?php echo base_url(); ?>css/main.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>css/sidebar.css" rel="stylesheet" type="text/css"/>

        <link href="<?php echo base_url(); ?>css/jquery-ui.css" rel="stylesheet" type="text/css"/>

        <link href="<?php echo base_url(); ?>css/datepicker.css" rel="stylesheet" type="text/css"/>

        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-3.0.0.min.js"></script>

        <script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/npm.js"></script>

        <script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap-jquery-1.12.4.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui.js"></script>

        <script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap-datepicker.js"></script>

        <script type="text/javascript">
            $(document).ready(function(){
                $('#vehicle_insurance').datepicker();
                $('#vehicle_revenue').datepicker();
                $('#vi_from_date').datepicker();
                $('#vi_to_date').datepicker();
                $('#accident_date').datepicker();
                $('#payment_occurred_date').datepicker();
                $('#payment_bill_date').datepicker();
                $('#pv_submitted_date').datepicker();
                $('#pc_date').datepicker();

                $('#driver_name').autocomplete({
                    source: "<?php echo base_url();?>Driver/driver_search/?"
                });
                $('#minister_name').autocomplete({
                    source: "<?php echo base_url();?>Minister/minister_search/?"
                });
                $('#vehicle_name').autocomplete({
                    source: "<?php echo base_url();?>Vehicle/vehicle_search/?"
                });
                $('#vehicle_name').autocomplete({
                    source: "<?php echo base_url();?>Vehicle/vehicle_search/?"
                });


                //payment
                $('#payment_name').autocomplete({
                    source: "<?php echo base_url();?>Payment/payment_search/?"
                });
                $('#payment_vehicle_name').autocomplete({
                    source: "<?php echo base_url();?>Payment/payment_vehicle_search/?"
                });
                $('#payment_voucher_name').autocomplete({
                    source: "<?php echo base_url();?>Payment/payment_voucher_search/?"
                });

                //vehicle insurane
                $('#insuranced_vehicle_name').autocomplete({
                    source: "<?php echo base_url();?>Insurance/insuranced_vehicle_search/?"
                });
                $('#insurance_active_vehicle_name').autocomplete({
                    source: "<?php echo base_url();?>Insurance/insurance_active_vehicle_search/?"
                });

                //vehicle registration certificate
                $('#vrc_active_vehicle_name').autocomplete({
                    source: "<?php echo base_url();?>Vehicle/active_vehicle_search/?"
                });
                $('#vrc_active_vehicle_name2').autocomplete({
                    source: "<?php echo base_url();?>Vehicle/active_vehicle_search2/?"
                });

                //accident
                $('#accident_active_vehicle_name').autocomplete({
                    source: "<?php echo base_url();?>Accident/active_vehicle_search/?"
                });

                $('#apr_accident_name').autocomplete({
                    source: "<?php echo base_url();?>Accident/apr_accident/?"
                });
                $('#apr_accident_name2').autocomplete({
                    source: "<?php echo base_url();?>Accident/apr_downloadable_accident/?"
                });


                //driver assign
                $('#driver_not_assigned_minister_name').autocomplete({
                    source: "<?php echo base_url();?>Minister/not_assigned_minister_search/?"
                });
                $('#driver_not_assigned_driver_name').autocomplete({
                    source: "<?php echo base_url();?>Minister/not_assigned_driver_search/?"
                });

                $('#driver_assigned_minister_name').autocomplete({
                    source: "<?php echo base_url();?>Minister/assigned_minister_search/?"
                });
                $('#driver_not_assigned_driver_name2').autocomplete({
                    source: "<?php echo base_url();?>Minister/not_assigned_driver_search/?"
                });

                $('#driver_assigned_minister_name2').autocomplete({
                    source: "<?php echo base_url();?>Minister/assigned_minister_search/?"
                });


                //vehicle assign
                $('#vehicle_active_minister_name').autocomplete({
                    source: "<?php echo base_url();?>Minister/active_minister_search/?"
                });
                $('#vehicle_not_assigned_vehicle_name').autocomplete({
                    source: "<?php echo base_url();?>Minister/not_assigned_vehicle_search/?"
                });
                $('#vehicle_assigned_vehicle_name').autocomplete({
                    source: "<?php echo base_url();?>Minister/assigned_vehicle_search/?"
                });



            });
        </script>


    </head>

    <body>
    <div class="col-md-3">
    </div>
    <div class="col-md-9">
    </div>

    <div class="nav-side-menu">
        <div class="brand"><a href="<?php echo base_url()?>Home"><img src="<?php echo base_url()?>images/logo.png" alt="Smiley face" height="200" width="200"></a></div>
        <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>

        <div class="menu-list">

            <ul id="menu-content" class="menu-content collapse out">
                <li>
                    <a href="<?php echo base_url()?>Home">
                        <i class="fa fa-home fa-lg"></i> Home
                    </a>
                </li>

                <li  data-toggle="collapse" data-target="#products" class="collapsed active">
                    <a href="#"><i class="fa fa-car fa-lg"></i> Vehicles <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="products">
                    <li><a href="<?php echo base_url()?>Vehicle/vehicle_details">Vehicle Details</a></li>
                    <li><a href="<?php echo base_url()?>Vehicle/vehicle_add">Add Vehicle</a></li>
                    <li><a href="<?php echo base_url()?>Vehicle/vehicle_edit">Edit Vehicle Details</a></li>
                    <li><a href="<?php echo base_url()?>Vehicle/vehicle_registration_certificate">Vehicle Registration Certificate</a></li>
                    <li><a href="<?php echo base_url()?>Insurance/vehicle_insurance_details">Vehicle Insurance Details</a></li>
                    <li><a href="<?php echo base_url()?>Insurance/vehicle_insurance_add">Add Vehicle Insurance</a></li>
                    <li><a href="<?php echo base_url()?>Insurance/vehicle_insurance_edit">Edit Vehicle Insurance</a></li>
                </ul>


                <li data-toggle="collapse" data-target="#service" class="collapsed">
                    <a href="#"><i class="fa fa-user fa-lg"></i> Ministers <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="service">
                    <li><a href="<?php echo base_url()?>Minister/minister_details">Minister Details</a></li>
                    <li><a href="<?php echo base_url()?>Minister/minister_add">Add Minister</a></li>
                    <li><a href="<?php echo base_url()?>Minister/minister_edit">Edit Minister</a></li>
                    <li><a href="<?php echo base_url()?>Minister/minister_assign_drivers">Assign Drivers</a></li>
                    <li><a href="<?php echo base_url()?>Minister/minister_assign_vehicles">Assign Vehicles</a></li>
                </ul>


                <li data-toggle="collapse" data-target="#new" class="collapsed">
                    <a href="#"><i class="fa fa-users fa-lg"></i> Drivers <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="new">
                    <li><a href="<?php echo base_url()?>Driver/driver_details">Driver Details</a></li>
                    <li><a href="<?php echo base_url()?>Driver/driver_add">Add Driver</a></li>
                    <li><a href="<?php echo base_url()?>Driver/driver_edit">Edit Driver</a></li>
                </ul>

                <li data-toggle="collapse" data-target="#accidents" class="collapsed">
                    <a href="#"><i class="fa fa-ambulance fa-lg"></i> Accidents <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="accidents">
                    <li><a href="<?php echo base_url()?>Accident/accident_details">Accident Details</a></li>
                    <li><a href="<?php echo base_url()?>Accident/accident_report">Report Accidents</a></li>
                    <li><a href="<?php echo base_url()?>Accident/accident_police_report">Police Report</a></li>
                    <li><a href="<?php echo base_url()?>Accident/service_centers_add">Add Service Center</a></li>
                </ul>

                <li data-toggle="collapse" data-target="#payments" class="collapsed">
                    <a href="#"><i class="fa fa-money fa-lg"></i> Payments <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="payments">
                    <li><a href="<?php echo base_url()?>Payment/payment_details">Payment Details</a></li>
                    <li><a href="<?php echo base_url()?>Payment/payment_add">Payments</a></li>
                    <li><a href="<?php echo base_url()?>Payment/payment_voucher">Payment Vouchers</a></li>
                    <li><a href="<?php echo base_url()?>Payment/payment_cheque">Payment Cheques</a></li>
                </ul>

                <li data-toggle="collapse" data-target="#other" class="collapsed">
                    <a href="#"><i class="fa fa-file fa-lg"></i> Other <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="other">
                    <li><a href="<?php echo base_url()?>Other/other_details">Other Details</a></li>
                </ul>

            </ul>
        </div>
    </div>



