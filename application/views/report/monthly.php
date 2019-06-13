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
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#tab_1_1" data-toggle="tab"><i class="icon-list"></i> Table </a>
                </li>
                <li>
                    <a href="#tab_1_2" data-toggle="tab"><i class="icon-graph"></i> Graph </a>
                </li>
                <li>
                    <a href="#tab_1_3" data-toggle="tab"><i class="icon-bar-chart "></i> Bar </a>
                </li>
                <li>
                    <a href="#tab_1_4" data-toggle="tab"><i class="icon-pie-chart "></i> Pie </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="tab_1_1">
                    <p class="text-right" style="padding: 15px 0;">
                        <a href="<?php echo base_url($excel_file); ?>" class="btn btn-sm yellow-casablanca"><i class="fa fa-file-excel-o"></i> Export to Excel</a>
                        <a href="<?php echo base_url($pdf_file); ?>" target="_blank" class="btn btn-sm yellow-casablanca"><i class="fa fa-file-pdf-o"></i> Export to PDF</a>
                    </p>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover ci-datatable">
                        <thead>
                            <tr>
                                <th> Event </th>
                                <?php for ($x = $v_from; $x <= $v_to; $x+=1) echo '<th>' . str_pad($x, 2, 0, STR_PAD_LEFT) . '</th>';?>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($cdrs as $key => $val) {
                            ?>
                            <tr>
                                <td><?php echo $events[$key]['event_name']; ?></td>
                                <?php $total = 0; ?>
                                <?php foreach ($val as $hh) : ?>
                                <td><?php echo $hh; ?></td>
                                <?php $total += $hh; ?>
                                <?php endforeach; ?>
                                <td><?php echo $total; ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab_1_2">
                    <p class="text-right" style="padding: 15px 0;">
                        <a href="javascript:void(0);" class="btn btn-sm yellow-casablanca export-png" data-canvas-id="m-line-chart"><i class="fa fa-file-image-o"></i> Export to Image</a>
                    </p>
                    <canvas id="m-line-chart"></canvas>
                </div>
                <div class="tab-pane fade" id="tab_1_3">
                    <p class="text-right" style="padding: 15px 0;">
                        <a href="javascript:void(0);" class="btn btn-sm yellow-casablanca export-png" data-canvas-id="m-bar-chart"><i class="fa fa-file-image-o"></i> Export to Image</a>
                    </p>
                    <canvas id="m-bar-chart"></canvas>
                </div>
                <div class="tab-pane fade" id="tab_1_4">
                    <p class="text-right" style="padding: 15px 0;">
                        <a href="javascript:void(0);" class="btn btn-sm yellow-casablanca export-png" data-canvas-id="m-pie-chart"><i class="fa fa-file-image-o"></i> Export to Image</a>
                    </p>
                    <canvas id="m-pie-chart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>