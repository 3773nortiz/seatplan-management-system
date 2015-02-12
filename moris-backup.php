        <div class="row">
    <!--         <section class="panel">
                    <header class="panel-heading">
                        <div class="panel-actions">
                            <a href="#" class="fa fa-caret-down"></a>
                            <a href="#" class="fa fa-times"></a>
                        </div>
        
                        <h2 class="panel-title">Pie Chart</h2>
                        <p class="panel-subtitle">Default Pie Chart</p>
                    </header>
                    <div class="panel-body"> -->
        
                        <!-- Flot: Pie -->
                        <div class="chart chart-md" id="flotPie"></div>
                        <script type="text/javascript">
        
                            var flotPieData = [{
                                label: "Series 1",
                                data: [
                                    [1, 60]
                                ],
                                color: '#0088cc'
                            }, {
                                label: "Series 2",
                                data: [
                                    [1, 10]
                                ],
                                color: '#2baab1'
                            }, {
                                label: "Series 3",
                                data: [
                                    [1, 15]
                                ],
                                color: '#734ba9'
                            }, {
                                label: "Series 4",
                                data: [
                                    [1, 15]
                                ],
                                color: '#E36159'
                            }];
        
                            // See: assets/javascripts/ui-elements/examples.charts.js for more settings.
        
                        </script>
        <!-- 
                    </div>
            </section> -->
        </div>
                                
        <div class="row">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>
                        <a href="#" class="fa fa-times"></a>
                    </div>

                    <h2 class="panel-title">Donut Chart</h2>
                    <p class="panel-subtitle">Donut Chart are functionally identical to pie charts.</p>
                </header>
                <div class="panel-body">
                    <!-- Morris: Donut -->
                    <div class="chart chart-md" id="morrisDonut"></div>
                    <script type="text/javascript">

                        var morrisDonutData = [{
                            label: "Porto Template",
                            value: 32
                        }, {
                            label: "Tucson Template",
                            value: 18
                        }, {
                            label: "Porto Admin",
                            value: 20
                        }];
                        // See: assets/javascripts/ui-elements/examples.charts.js for more settings.
                    </script>
            </section>
        </div>


        <div class="row">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>
                        <a href="#" class="fa fa-times"></a>
                    </div>

                    <h2 class="panel-title">Stacked Chart</h2>
                    <p class="panel-subtitle">Stacked Bar Chart.</p>
                </header>
                <div class="panel-body">
                    <!-- Morris: Area -->
                    <div class="chart chart-md" id="morrisStacked"></div>
                    <script type="text/javascript">

                        var morrisStackedData = [{
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
            </section>
        </div>