<div class="col-md-12">
    <!-- BEGIN Portlet PORTLET-->
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-users font-yellow-casablanca"></i>
                <span class="caption-subject bold font-yellow-casablanca uppercase"> Users Management</span>
            </div>
        </div>
        <div class="portlet-body">
            <?php if (isset($alert) && $alert['msg'] != '') :?>
            <div class="alert alert-<?php echo $alert['type']; ?> alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <?php echo $alert['msg']; ?>
            </div>
            <?php endif; ?>
            <p class="text-right" style="padding: 15px 0;">
                <a href="<?php echo site_url('users/create'); ?>" class="btn btn-sm yellow-casablanca"><i class="icon-plus"></i> Add User</a>
            </p>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>User Type</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($users as $user) :?>
                        <tr>
                            <td><?php echo $user['username']; ?></td>
                            <td><?php echo $user['user_type']; ?></td>
                            <td><?php echo $user['created_at']; ?></td>
                            <td>
                                <div class="btn-group">
                                    <a href="<?php echo site_url('users/edit/' . $user['user_id']); ?>" class="btn btn-default btn-sm"><i class="icon-pencil"></i> Edit</a>
                                    <a href="<?php echo site_url('users/delete/' . $user['user_id']); ?>" class="btn btn-default btn-sm"><i class="icon-trash"></i> Delete</a>
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