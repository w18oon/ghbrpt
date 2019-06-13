<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--><html lang="en"><!--<![endif]-->
    <head>
        <meta charset="utf-8" />
        <title>GHB Report | Sign In</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="<?php echo base_url('assets/global/plugins/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/global/plugins/simple-line-icons/simple-line-icons.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet'); ?>" type="text/css" />
        <link href="<?php echo base_url('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo base_url('assets/global/css/components.min.css'); ?>" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo base_url('assets/global/css/plugins.min.css'); ?>" rel="stylesheet" type="text/css" />
    </head>
    <body style="background-color: #fafafa;">
        <div style="width: 100%; max-width: 400px; padding: 15px; margin: 30px auto 0;">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div style="width: 100%; max-width: 59px; margin: 0 auto 15px !important;">
                        <img src="<?php echo base_url('assets/pages/img/logo-2.png'); ?>" alt="logo" style="width: 59px;"/>
                    </div>
                </div>
                <div class="portlet-body form">
                    <?php if (isset($alert)) :?>
                    <div class="alert alert-<?php echo $alert['type']; ?> alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        <?php echo $alert['msg']; ?>
                    </div>
                    <?php endif; ?>
                    <form role="form" action="<?php echo site_url('page/do_signin'); ?>" method="post">
                        <div class="form-body">
                            <div class="form-group">
                                <label>Username</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="icon-user"></i>
                                    </span>
                                    <input type="text" name="signin-form-username" class="form-control" placeholder="Username">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="icon-lock"></i>
                                    </span>
                                    <input type="password" name="signin-form-password" class="form-control" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-block yellow-casablanca">Sign In</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- <div class="copyright"> <?php echo date('Y'); ?> © GH Bank. </div> -->
        <!--[if lt IE 9]>
        <script src="<?php echo base_url('assets/global/plugins/respond.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/global/plugins/excanvas.min.js'); ?>"></script> 
        <script src="<?php echo base_url('assets/global/plugins/ie8.fix.min.js'); ?>"></script> 
        <![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="<?php echo base_url('assets/global/plugins/jquery.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/global/plugins/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
    </body>
</html>