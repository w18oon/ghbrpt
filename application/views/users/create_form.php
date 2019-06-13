<div class="col-md-12">
    <!-- BEGIN Portlet PORTLET-->
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-plus font-yellow-casablanca"></i>
                <span class="caption-subject bold font-yellow-casablanca uppercase"> Create User</span>
            </div>
        </div>
        <div class="portlet-body form">
            <?php if (isset($alert)) :?>
            <div class="alert alert-<?php echo $alert['type']; ?> alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <?php echo $alert['msg']; ?>
            </div>
            <?php endif; ?>
            <form action="<?php echo site_url('users/create'); ?>" class="form-horizontal" method="post">
                <div class="form-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="user-form-username">Username</label>
                        <div class="col-md-4">
                            <input class="form-control" id="user-form-username" type="text" name="user-form-username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="user-form-password">Password</label>
                        <div class="col-md-4">
                            <input class="form-control" id="user-form-password" type="password" name="user-form-password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="user-form-conf-password">Confirm Password</label>
                        <div class="col-md-4">
                            <input class="form-control" id="user-form-conf-password" type="password" name="user-form-conf-password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">User Type</label>
                        <div class="col-md-4">
                            <div class="mt-radio-inline">
                                <label class="mt-radio">
                                    <input type="radio" class="radio-report-type" name="user-form-user-type" value="Admin"> Admin
                                    <span></span>
                                </label>
                                <label class="mt-radio">
                                    <input type="radio" class="radio-report-type" name="user-form-user-type" value="User" checked> User
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-4">
                            <button type="submit" class="btn yellow-casablanca">Submit</button>
                            <a href="<?php echo site_url('users'); ?>" class="btn default">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>