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
            <form action="<?php echo site_url('event-summary-report/result'); ?>" class="form-horizontal" method="post">
                <div class="form-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Report Type</label>
                        <div class="col-md-4">
                            <div class="mt-radio-inline">
                                <label class="mt-radio">
                                    <input type="radio" class="radio-report-type" name="report-type" value="daily" checked> Daily
                                    <span></span>
                                </label>
                                <label class="mt-radio">
                                    <input type="radio" class="radio-report-type" name="report-type" value="monthly"> Monthly
                                    <span></span>
                                </label>
                                <label class="mt-radio">
                                    <input type="radio" class="radio-report-type" name="report-type" value="yearly"> Yearly
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Events</label>
                        <div class="col-md-4">
                            <select class="multi-select form-control input-medium" multiple="multiple" name="report-form-events[]">
                                <?php foreach ($events as $event) :?>
                                <option value="<?php echo $event['event_id']; ?>"><?php echo $event['event_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div id="daily" class="report-form">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Date</label>
                            <div class="col-md-4">
                                <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
                                    <input type="text" class="form-control" name="report-date">
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
                            <label class="col-md-3 control-label">Time from</label>
                            <div class="col-md-4">
                                <div class="input-group input-medium">
                                    <input type="text" class="form-control timepicker timepicker-24" name="time-from">
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-clock-o"></i>
                                        </button>
                                    </span>
                                </div>
                                <span class="help-block"> Select time (Ex.hh:mm)</span>
                            </div>
                        </div>
                        <div class="form-group last">
                            <label class="col-md-3 control-label">Time to</label>
                            <div class="col-md-4">
                                <div class="input-group input-medium">
                                    <input type="text" class="form-control timepicker timepicker-24" name="time-to">
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-clock-o"></i>
                                        </button>
                                    </span>
                                </div>
                                <span class="help-block"> Select time (Ex.hh:mm)</span>
                            </div>
                        </div>
                    </div>
                    <div id="monthly" class="report-form" style="display: none;">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Month</label>
                            <div class="col-md-4">
                                <div class="input-group input-medium date date-picker monthly-m" data-date-format="yyyy-mm" data-date-start-view="1" data-date-min-view-mode="1">
                                    <input type="text" class="form-control" name="monthly-m">
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                                <span class="help-block"> Select Month (Ex.yyyy-mm) </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Date from</label>
                            <div class="col-md-4">
                                <div class="input-group input-medium date date-picker monthly-df" data-date-format="yyyy-mm-dd">
                                    <input type="text" class="form-control" name="monthly-df">
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
                                <div class="input-group input-medium date date-picker monthly-dt" data-date-format="yyyy-mm-dd">
                                    <input type="text" class="form-control" name="monthly-dt">
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
                    <div id="yearly" class="report-form" style="display: none;">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Year</label>
                            <div class="col-md-4">
                                <div class="input-group input-medium date date-picker yearly-y" data-date-format="yyyy" data-date-start-view="2" data-date-min-view-mode="2">
                                    <input type="text" class="form-control" name="yearly-y">
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                                <span class="help-block"> Select Year (Ex.yyyy) </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Month From</label>
                            <div class="col-md-4">
                                <div class="input-group input-medium date date-picker monthly-df" data-date-format="yyyy-mm" data-date-start-view="1" data-date-min-view-mode="1">
                                    <input type="text" class="form-control" name="yearly-mf">
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                                <span class="help-block"> Select Month (Ex.yyyy-mm) </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Month To</label>
                            <div class="col-md-4">
                                <div class="input-group input-medium date date-picker monthly-df" data-date-format="yyyy-mm" data-date-start-view="1" data-date-min-view-mode="1">
                                    <input type="text" class="form-control" name="yearly-mt">
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                                <span class="help-block"> Select Month (Ex.yyyy-mm) </span>
                            </div>
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