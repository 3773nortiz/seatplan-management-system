<link rel="stylesheet" href="<?php echo Config::get('base_url') . 'assets/vendor/morris/morris.css'; ?>" />



<div class="col-md-9">
    <div class="col-md-12">  
        <div class="tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#popular" data-toggle="tab">Attendacce Charts</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="popular" class="tab-pane active">
                       <div class="chart chart-md" id="morrisBar"></div>
                </div>
            </div>
        </div> 
    </div>
</div>


    
<!-- Specific Page Vendor -->
<script src="<?php echo Config::get('base_url') . 'assets/vendor/nanoscroller/nanoscroller.js'; ?>"></script>
<script src="<?php echo Config::get('base_url') . 'assets/vendor/jquery-appear/jquery.appear.js' ?>"></script>
<script src="<?php echo Config::get('base_url') . 'assets/vendor/jquery-easypiechart/jquery.easypiechart.js'; ?>"></script>
<script src="<?php echo Config::get('base_url') . 'assets/vendor/flot/jquery.flot.js'; ?>"></script>
<script src="<?php echo Config::get('base_url') . 'assets/vendor/flot-tooltip/jquery.flot.tooltip.js'; ?>"></script>
<script src="<?php echo Config::get('base_url') . 'assets/vendor/flot/jquery.flot.pie.js'; ?>"></script>
<script src="<?php echo Config::get('base_url') . 'assets/vendor/flot/jquery.flot.categories.js'; ?>"></script>
<script src="<?php echo Config::get('base_url') . 'assets/vendor/flot/jquery.flot.resize.js';?>"></script>
<script src="<?php echo Config::get('base_url') . 'assets/vendor/jquery-sparkline/jquery.sparkline.js';?>"></script>
<script src="<?php echo Config::get('base_url') . 'assets/vendor/raphael/raphael.js';?>"></script>
<script src="<?php echo Config::get('base_url') . 'assets/vendor/morris/morris.js'; ?>"></script>
<script src="<?php echo Config::get('base_url') . 'assets/vendor/gauge/gauge.js'; ?>"></script>
<script src="<?php echo Config::get('base_url') . 'assets/vendor/snap-svg/snap.svg.js'; ?>"></script>
<script src="<?php echo Config::get('base_url') . 'assets/vendor/liquid-meter/liquid.meter.js'; ?>"></script>

<?php echo Asset::js(array(
    'angular/charts/attendance-barchart.js',
)); ?>