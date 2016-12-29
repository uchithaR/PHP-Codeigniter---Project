<?php
/**
 * Created by PhpStorm.
 * User: Uditha Jay
 * Date: 8/17/2016
 * Time: 3:21 PM
 */?>
<?php ?>

<html class="no-js">
    <head>
        <title>VRIMS</title>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Home</title>

        <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>css/bootstrap.css" rel="stylesheet" type="text/css"/>

        <link href="<?php echo base_url(); ?>css/main.css" rel="stylesheet" type="text/css"/>

        <script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-3.0.0.min.js"></script>

        <style>
            body {
                background: dodgerblue  ; /* For browsers that do not support gradients */
                background: -webkit-linear-gradient(deepskyblue, dodgerblue); /* For Safari 5.1 to 6.0 */
                background: -o-linear-gradient(deepskyblue, dodgerblue); /* For Opera 11.1 to 12.0 */
                background: -moz-linear-gradient(deepskyblue, dodgerblue); /* For Firefox 3.6 to 15 */
                background: linear-gradient(deepskyblue, dodgerblue); /* Standard syntax */
            }
        </style>

    </head>
    <body>

    <form class="form-horizontal">
        <fieldset>
            <div class="form-group">
                </br></br></br></br></br>
                <div class="col-lg-3 control-label">
                </div>

                <div class="col-lg-2 control-label">
                    <div class="icon">
                        <a href="<?php echo base_url()?>Vehicle"><img src="<?php echo base_url()?>images/home-vehicle.png" alt="Manage Vehicles Image" ></a>
                        <div class="home_menu">VEHICLE</div>
                    </div>
                </div>

                <div class="col-lg-2 control-label">
                    <div class="icon">
                        <a href="<?php echo base_url()?>Minister"><img src="<?php echo base_url()?>images/home-minister.png" alt="Manage Ministers Image"></a>
                        <div class="home_menu">MINISTR</div>
                    </div>
                </div>

                <div class="col-lg-2 control-label">
                    <div class="icon">
                        <a href="<?php echo base_url()?>Driver"><img src="<?php echo base_url()?>images/home-driver.png" alt="Manage Drivers Image"></a>
                        <div class="home_menu">DRIVER</div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-3 control-label">
                </div>

                <div class="col-lg-2 control-label">
                    <div class="icon">
                        <a href="<?php echo base_url()?>Accident"><img src="<?php echo base_url()?>images/home-accident.png" alt="Manage Accidents Image"></a>
                        <div class="home_menu">ACCIDENT</div>
                    </div>
                </div>

                <div class="col-lg-2 control-label">
                    <div class="icon">
                        <a href="<?php echo base_url()?>Payment"><img src="<?php echo base_url()?>images/home-payment.png" alt="Manage Payment Image"></a>
                        <div class="home_menu">PAYMENT</div>
                    </div>
                </div>

                <div class="col-lg-2 control-label">
                    <div class="icon">
                        <a href="<?php echo base_url()?>Other"><img src="<?php echo base_url()?>images/home-other.png" alt="Manage Other Image"></a>
                        <div class="home_menu">OTHER</div>
                    </div>
                </div>
            </div>


        </fieldset>
    </form>

    </body>
</html>


