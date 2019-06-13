<div class="col-md-12">
    <!-- BEGIN Portlet PORTLET-->
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-settings font-yellow-casablanca"></i>
                <span class="caption-subject bold font-yellow-casablanca uppercase"> Settings</span>
            </div>
        </div>
        <div class="portlet-body">
            <?php if (isset($alert)) :?>
            <div class="alert alert-<?php echo $alert['type']; ?> alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <?php echo $alert['msg']; ?>
            </div>
            <?php endif; ?>
            <ul class="nav nav-tabs">
                <li <?php echo ($current_tabs == '1')? 'class="active"': NULL; ?>>
                    <a href="#tab_1_1" data-toggle="tab"><i class="icon-folder-alt"></i> Path </a>
                </li>
                <li <?php echo ($current_tabs == '2')? 'class="active"': NULL; ?>>
                    <a href="#tab_1_2" data-toggle="tab"><i class="icon-list"></i> Event </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade <?php echo ($current_tabs == '1')? 'active in': NULL; ?>" id="tab_1_1">
                    <form action="<?php echo site_url('page/do_update_option'); ?>" class="form-horizontal" method="post">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="setting-form-option-value">CDR Path</label>
                                <div class="col-md-4">
                                    <input class="form-control" id="setting-form-option-value" type="text" name="setting-form-option-value" value="<?php echo $option['option_value']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-4">
                                    <input type="hidden" name="setting-form-option-id" value="<?php echo $option['option_id']; ?>">
                                    <button type="submit" class="btn yellow-casablanca">Submit</button>
                                    <button type="reset" class="btn default">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade <?php echo ($current_tabs == '2')? 'active in': NULL; ?>" id="tab_1_2">
                    <p class="text-right" style="padding: 15px 0;">
                        <a href="javascript:void(0);" class="btn btn-sm yellow-casablanca" data-toggle="modal" data-target="#event-form-modal"><i class="icon-plus"></i> Add Event</a>
                    </p>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Event ID</th>
                                    <th>Event Name</th>
                                    <th>Display Flag</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($events as $event) :?>
                                <tr>
                                    <td><?php echo $event['event_id']; ?></td>
                                    <td><?php echo $event['event_name']; ?></td>
                                    <td><?php echo $event['event_flag']; ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="javascript:void(0);" 
                                                data-action="<?php echo site_url('page/do_update_event/'); ?>" 
                                                data-id="<?php echo $event['event_id']; ?>"
                                                data-name="<?php echo $event['event_name']; ?>"
                                                data-flag="<?php echo $event['event_flag']; ?>"
                                                data-toggle="modal" 
                                                data-target="#update-form-modal"
                                                class="btn btn-default btn-sm get-upd-ev-frm"><i class="icon-pencil"></i> Edit</a>
                                            <a href="<?php echo site_url('page/do_delete_event/' . $event['event_id']); ?>" class="btn btn-default btn-sm"><i class="icon-trash"></i> Delete</a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MODAL -->
<div class="modal fade" id="event-form-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="<?php echo site_url('page/do_create_event'); ?>" class="form-horizontal" method="post">
                <div class="modal-header">
                    Event Form
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="event-form-id">Event ID</label>
                            <div class="col-md-4">
                                <input class="form-control" id="event-form-id" type="text" name="event-form-id">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="event-form-name">Event Name</label>
                            <div class="col-md-4">
                                <input class="form-control" id="event-form-name" type="text" name="event-form-name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Display Flag</label>
                            <div class="col-md-4">
                                <div class="mt-radio-inline">
                                    <label class="mt-radio">
                                        <input type="radio" class="radio-report-type" name="event-form-flag" value="N"> N
                                        <span></span>
                                    </label>
                                    <label class="mt-radio">
                                        <input type="radio" class="radio-report-type" name="event-form-flag" value="Y" checked> Y
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>                
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn yellow-casablanca">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- UPDATE FROM MODAL -->
<div class="modal fade" id="update-form-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="" class="form-horizontal" method="post">
                <div class="modal-header">
                    Event Form
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="event-form-id">Event ID</label>
                            <div class="col-md-4">
                                <input class="form-control" id="event-form-id" type="text" name="event-form-id">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="event-form-name">Event Name</label>
                            <div class="col-md-4">
                                <input class="form-control" id="event-form-name" type="text" name="event-form-name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Display Flag</label>
                            <div class="col-md-4">
                                <div class="mt-radio-inline">
                                    <label class="mt-radio">
                                        <input type="radio" class="radio-report-type" name="event-form-flag" value="N"> N
                                        <span></span>
                                    </label>
                                    <label class="mt-radio">
                                        <input type="radio" class="radio-report-type" name="event-form-flag" value="Y"> Y
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>                
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn yellow-casablanca">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>