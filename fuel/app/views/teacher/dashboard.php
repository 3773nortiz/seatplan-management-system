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
                        <script type="text/javascript">

                            var morrisBarData = [{
                                y: '2004',
                                a: 10,
                                b: 30
                            }, {
                                y: '2005',
                                a: 100,
                                b: 25
                            }, {
                                y: '2006',
                                a: 60,
                                b: 25
                            }, {
                                y: '2007',
                                a: 75,
                                b: 35
                            }, {
                                y: '2008',
                                a: 90,
                                b: 20
                            }, {
                                y: '2009',
                                a: 75,
                                b: 15
                            }, {
                                y: '2010',
                                a: 50,
                                b: 10
                            }, {
                                y: '2011',
                                a: 75,
                                b: 25
                            }, {
                                y: '2012',
                                a: 30,
                                b: 10
                            }, {
                                y: '2013',
                                a: 75,
                                b: 5
                            }, {
                                y: '2014',
                                a: 60,
                                b: 8
                            }];

                            // See: assets/javascripts/ui-elements/examples.charts.js for more settings.

                        </script>
                </div>
            </div>
        </div> 
    </div>
</div>


    
<!-- Specific Page Vendor -->
<script src="<?php echo Config::get('base_url') .  'assets/vendor/nanoscroller/nanoscroller.js'; ?>"></script>
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
    'charts/attendance-barchart.js',
)); ?>