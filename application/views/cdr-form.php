<div class="col-md-12">
    <!-- BEGIN Portlet PORTLET-->
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-equalizer font-yellow-casablanca"></i>
                <span class="caption-subject bold font-yellow-casablanca uppercase"> Conditions</span>
            </div>
        </div>
        <div class="portlet-body form">
            <?php if (isset($alert)) :?>
            <div class="alert alert-<?php echo $alert['type']; ?> alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <?php echo $alert['msg']; ?>
            </div>
            <?php endif; ?>
            <form action="<?php echo site_url('cdr-report/result'); ?>" class="form-horizontal" method="post">
                <div class="form-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Date from</label>
                        <div class="col-md-4">
                            <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
                                <input type="text" class="form-control" name="cdr-form-dtm-from">
                                <span class="input-group-btn">
                                    <button class="btn default" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>
                            <span class="help-block"> Select date (Ex.yyyy-mm-dd) </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Date to</label>
                        <div class="col-md-4">
                            <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
                                <input type="text" class="form-control" name="cdr-form-dtm-to">
                                <span class="input-group-btn">
                                    <button class="btn default" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>
                            <span class="help-block"> Select date (Ex.yyyy-mm-dd) </span>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-4">
                            <button type="submit" class="btn yellow-casablanca">Submit</button>
                            <button type="reset" class="btn default">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>