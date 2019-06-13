<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--><html lang="en"><!--<![endif]-->
    <head>
        <meta charset="utf-8" />
        <title>GHB Report</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <link href="<?php echo base_url('assets/global/plugins/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/global/plugins/simple-line-icons/simple-line-icons.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/global/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- <link href="<?php echo base_url('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css'); ?>" rel="stylesheet" type="text/css" /> -->
        <link href="<?php echo base_url('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css'); ?>" rel="stylesheet" type="text/css">
        <!-- <link href="<?php echo base_url('assets/global/plugins/bootstrap-select/css/bootstrap-select.css'); ?>" rel="stylesheet" type="text/css"> -->
        <link href="<?php echo base_url('assets/global/plugins/jquery-multi-select/css/multi-select.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/global/css/components.min.css'); ?>" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo base_url('assets/global/css/plugins.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/layouts/layout/css/layout.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/layouts/layout/css/themes/light_customize.css'); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('assets/layouts/layout/css/custom.min.css'); ?>" rel="stylesheet" type="text/css" />
        <style type="text/css">
            .datepicker, .bootstrap-select .dropdown-menu { z-index: 9999 !important;}
        </style>
    </head>
    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
        <div class="page-wrapper">
            <!-- BEGIN HEADER -->
            <div class="page-header navbar navbar-fixed-top">
                <!-- BEGIN HEADER INNER -->
                <div class="page-header-inner ">
                    <!-- BEGIN LOGO -->
                    <div class="page-logo">
                        <a href="index.html">
                            <img src="<?php echo base_url('assets/layouts/layout/img/logo.png'); ?>" alt="logo" class="logo-default" /> </a>
                        <div class="menu-toggler sidebar-toggler">
                            <span></span>
                        </div>
                    </div>
                    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                        <span></span>
                    </a>
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <!-- <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <li class="dropdown dropdown-user">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <i class="icon-user"></i>
                                    <span class="username username-hide-on-mobile"> User </span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li>
                                        <a href="javascript:;"><i class="icon-user"></i> My Profile </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="<?php echo site_url('signout'); ?>"><i class="icon-lock-open"></i> Sign Out </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div> -->
                </div>
            </div>
            <div class="clearfix"></div>
            <!-- BEGIN CONTAINER -->
            <div class="page-container">
                <!-- BEGIN SIDEBAR -->
                <div class="page-sidebar-wrapper">
                    <!-- BEGIN SIDEBAR -->
                    <div class="page-sidebar navbar-collapse collapse">
                        <!-- BEGIN SIDEBAR MENU -->
                        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                            <li class="sidebar-toggler-wrapper hide">
                                <div class="sidebar-toggler">
                                    <span></span>
                                </div>
                            </li>
                            <?php $menu_counter = 0;
                            foreach ($menus as $menu) {
                                $li_class = ($menu_counter == 0)? ' start': NULL;
                                $li_class = ($current_page == $menu['slug'])? ' active open': NULL;
                            ?>
                            <li class="nav-item<?php echo $li_class; ?>">
                                <a href="<?php echo site_url($menu['slug']); ?>" class="nav-link">
                                    <i class="icon-<?php echo $menu['icon']; ?>"></i>
                                    <span class="title"><?php echo $menu['title']; ?></span>
                                    <?php if ($current_page == $menu['slug']) : ?>
                                    <span class="selected" style="z-index: 999;"></span>
                                    <?php endif; ?>
                                </a>
                            </li>
                            <?php $menu_counter += 1; } ?>
                        </ul>
                    </div>
                </div>
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        <!-- BEGIN PAGE BAR -->
                        <div class="page-bar">
                            <ul class="page-breadcrumb">
                                <li>
                                    <i class="icon-home"></i>
                                </li>
                                <?php if ($page_breadcrumb != NULL) :?>
                                <li>
                                    <i class="fa fa-angle-right"></i>
                                    <span><?php echo $page_breadcrumb; ?></span>
                                </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <?php if ($page_title != NULL) :?>
                        <!-- BEGIN PAGE TITLE-->
                        <h1 class="page-title"><?php echo $page_title; ?></h1>
                        <?php endif; ?>
                        <div class="row"><?php $this->load->view($page, $this->data); ?></div>
                    </div>
                </div>
            </div>
            <!-- BEGIN FOOTER -->
            <!-- <div class="page-footer">
                <div class="page-footer-inner"> 2016 &copy; Metronic Theme By
                    <a target="_blank" href="http://keenthemes.com">Keenthemes</a> &nbsp;|&nbsp;
                    <a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" title="Purchase Metronic just for 27$ and get lifetime updates for free" target="_blank">Purchase Metronic!</a>
                </div>
            </div> -->
        </div>
        <!--[if lt IE 9]>
        <script src="assets/global/plugins/respond.min.js"></script>
        <script src="assets/global/plugins/excanvas.min.js"></script> 
        <script src="assets/global/plugins/ie8.fix.min.js"></script> 
        <![endif]-->
        <script src="<?php echo base_url('assets/global/plugins/jquery.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/global/plugins/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/global/plugins/js.cookie.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/global/plugins/jquery.blockui.min.js'); ?>" type="text/javascript"></script>
        <!-- <script src="<?php echo base_url('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js'); ?>" type="text/javascript"></script> -->
        <!-- <script src="<?php echo base_url('assets/global/plugins/moment.min.js'); ?>" type="text/javascript"></script> -->
        <script src="<?php echo base_url('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js'); ?>" type="text/javascript"></script>
        <!-- <script src="<?php echo base_url('assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js'); ?>" type="text/javascript"></script> -->
        <script src="<?php echo base_url('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/global/scripts/datatable.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/global/plugins/datatables/datatables.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/global/scripts/app.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/pages/scripts/components-date-time-pickers.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/layouts/layout/scripts/layout.min.js'); ?>" type="text/javascript"></script>
        <!-- <script src="<?php echo base_url('assets/layouts/layout/scripts/demo.min.js'); ?>" type="text/javascript"></script> -->
        <script src="<?php echo base_url('assets/layouts/global/scripts/quick-sidebar.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/layouts/global/scripts/quick-nav.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/global/scripts/filesaver.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/global/scripts/chart.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/global/scripts/chart-utils.js'); ?>" type="text/javascript"></script>
        <!-- <script src="http://cdn.jsdelivr.net/g/filesaver.js"></script> -->
        <script type="text/javascript">
            $(function() {
                $('.radio-report-type').on('click', function(){
                    var reportType = $(this).val();
                    $('.report-form').hide();
                    $('#' + reportType).show();
                });

                $('.export-png').on('click', function() {
                    var canvasID = $(this).data('canvas-id');
                    var canvas = document.getElementById(canvasID);
                        canvas.toBlob(function(blob) {
                        saveAs(blob, "event-summary-report-chart.png");
                    });
                });
                
                $('.get-upd-ev-frm').on('click', function() {
                    var eventID = $(this).data('id'),
                        eventName = $(this).data('name'),
                        eventFlag = $(this).data('flag'),
                        action = $(this).data('action');
                    $('#update-form-modal [name=event-form-id]').val(eventID);
                    $('#update-form-modal [name=event-form-name]').val(eventName);
                    $('#update-form-modal').find(':radio[value=' + eventFlag +']').prop("checked", true);
                    $('#update-form-modal').find('form').attr('action', action + eventID);
                });
                $('.ci-datatable').DataTable({
                    "info":false,
                    "ordering": false,
                    "searching": false,
                    "bLengthChange": false,
                    "pageLength": 10
                });

                // $('.bs-select').selectpicker({
                //     iconBase: 'fa',
                //     tickIcon: 'fa-check'
                // });
                $('.multi-select').multiSelect();
            });
        </script>
        <?php if (isset($line_chart)) :?>
        <script type="text/javascript">
            var config = {
                type: 'line',
                data: {
                    labels: [<?php echo $line_chart['labels']; ?>],
                    datasets: [
                    <?php foreach ($line_chart['events'] as $event) : ?>
                    {
                        label: "<?php echo $event['label']; ?>",
                        backgroundColor: '<?php echo $event['color']; ?>',
                        borderColor: '<?php echo $event['color']; ?>',
                        data: [ <?php echo $event['data']; ?>],
                        fill: false,
                    },
                    <?php endforeach; ?>
                    ]
                },
                options: {
                    responsive: true,
                    title:{
                        display:true,
                        text:'Daily Report'
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false,
                    },
                    hover: {
                        mode: 'nearest',
                        intersect: true
                    },
                    scales: {
                        xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Month'
                            }
                        }],
                        yAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Amount'
                            }
                        }]
                    }
                }
            };
            var ctx = document.getElementById("m-line-chart").getContext("2d");
            window.myLine = new Chart(ctx, config);
        </script>
        <script type="text/javascript">
            var config = {
                type: 'bar',
                data: {
                    labels: [<?php echo $line_chart['labels']; ?>],
                    datasets: [
                    <?php foreach ($line_chart['events'] as $event) : ?>
                    {
                        label: "<?php echo $event['label']; ?>",
                        backgroundColor: '<?php echo $event['color']; ?>',
                        borderColor: '<?php echo $event['color']; ?>',
                        data: [ <?php echo $event['data']; ?>],
                        fill: false,
                    },
                    <?php endforeach; ?>
                    ]
                },
                options: {
                    responsive: true,
                    title:{
                        display:true,
                        text:'Daily Report'
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false,
                    },
                    hover: {
                        mode: 'nearest',
                        intersect: true
                    },
                    scales: {
                        xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Month'
                            }
                        }],
                        yAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Amount'
                            }
                        }]
                    }
                }
            };
            var ctx = document.getElementById("m-bar-chart").getContext("2d");
            window.myLine = new Chart(ctx, config);
        </script>
        <?php endif; ?>
        <?php if (isset($chart_line)) :?>
        <script type="text/javascript">
            var config = {
                type: 'line',
                data: {
                    labels: [<?php echo $chart_line['labels']; ?>],
                    datasets: [
                    <?php foreach ($chart_line['events'] as $event) : ?>
                    {
                        label: "<?php echo $event['label']; ?>",
                        backgroundColor: '<?php echo $event['color']; ?>',
                        borderColor: '<?php echo $event['color']; ?>',
                        data: [ <?php echo $event['data']; ?>],
                        fill: false,
                    },
                    <?php endforeach; ?>
                    ]
                },
                options: {
                    responsive: true,
                    title:{
                        display:true,
                        text:'Daily Report'
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false,
                    },
                    hover: {
                        mode: 'nearest',
                        intersect: true
                    },
                    scales: {
                        xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Hour'
                            }
                        }],
                        yAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Amount'
                            }
                        }]
                    }
                }
            };
            var ctx = document.getElementById("line-chart").getContext("2d");
            window.myLine = new Chart(ctx, config);
        </script>
        <script type="text/javascript">
            var config = {
                type: 'bar',
                data: {
                    labels: [<?php echo $chart_line['labels']; ?>],
                    datasets: [
                    <?php foreach ($chart_line['events'] as $event) : ?>
                    {
                        label: "<?php echo $event['label']; ?>",
                        backgroundColor: '<?php echo $event['color']; ?>',
                        borderColor: '<?php echo $event['color']; ?>',
                        data: [ <?php echo $event['data']; ?>],
                        fill: false,
                    },
                    <?php endforeach; ?>
                    // {
                    //     label: "My Second dataset",
                    //     fill: false,
                    //     backgroundColor: window.chartColors.blue,
                    //     borderColor: window.chartColors.blue,
                    //     data: [
                    //         randomScalingFactor(),
                    //         randomScalingFactor(),
                    //         randomScalingFactor(),
                    //         randomScalingFactor(),
                    //         randomScalingFactor(),
                    //         randomScalingFactor(),
                    //         randomScalingFactor()
                    //     ],
                    // },
                    ]
                },
                options: {
                    responsive: true,
                    title:{
                        display:true,
                        text:'Daily Report'
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false,
                    },
                    hover: {
                        mode: 'nearest',
                        intersect: true
                    },
                    scales: {
                        xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Hour'
                            }
                        }],
                        yAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Amount'
                            }
                        }]
                    }
                }
            };
            var ctx = document.getElementById("bar-chart").getContext("2d");
            window.myLine = new Chart(ctx, config);
        </script>
        <?php endif; ?>
        <?php if (isset($pie_chart)) :?>
        <script type="text/javascript">
            var config = {
                type: 'pie',
                data: {
                    datasets: [{
                        data: [ <?php echo $pie_chart['data']; ?>],
                        backgroundColor: [ <?php echo $pie_chart['color']; ?> ],
                    }],
                    label: 'Dataset 1',
                    labels: [<?php echo $pie_chart['labels']; ?>]
                },
                options: {
                    responsive: true
                }
            };
			var ctx = document.getElementById("pie-chart").getContext("2d");
			window.myPie = new Chart(ctx, config);
        </script>
        <?php endif; ?>
        <?php if (isset($m_pie_chart)) :?>
        <script type="text/javascript">
            var config = {
                type: 'pie',
                data: {
                    datasets: [{
                        data: [ <?php echo $m_pie_chart['data']; ?>],
                        backgroundColor: [ <?php echo $m_pie_chart['color']; ?> ],
                    }],
                    label: 'Dataset 1',
                    labels: [<?php echo $m_pie_chart['labels']; ?>]
                },
                options: {
                    responsive: true
                }
            };
			var ctx = document.getElementById("m-pie-chart").getContext("2d");
			window.myPie = new Chart(ctx, config);
        </script>
        <?php endif; ?>
    </body>
</html>