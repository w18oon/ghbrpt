<div class="col-md-12">
    <!-- BEGIN Portlet PORTLET-->
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-info font-yellow-casablanca"></i>
                <span class="caption-subject bold font-yellow-casablanca uppercase"> Result</span>
            </div>
        </div>
        <div class="portlet-body">
            <p class="text-right">
                <a href="<?php echo base_url($excel_file); ?>" class="btn btn-sm yellow-casablanca"><i class="fa fa-file-excel-o"></i> Export to Excel</a>
            </p>
            <table class="table table-bordered table-striped table-hover ci-datatable">
                <thead>
                    <tr>
                        <th>DTM</th>
                        <th>ANI</th>
                        <th>DNIS</th>
                        <th>Duration</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cdr_arr as $cdr) : ?>
                    <tr>
                        <td><?php echo $cdr['dtm']; ?></td>
                        <td><?php echo $cdr['ani']; ?></td>
                        <td><?php echo $cdr['dnis']; ?></td>
                        <td><?php echo $cdr['duration']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>            
        </div>
    </div>
</div>