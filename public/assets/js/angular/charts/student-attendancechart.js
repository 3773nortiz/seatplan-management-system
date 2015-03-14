/*
Name:           UI Elements / Charts - Examples
Written by:     Okler Themes - (http://www.okler.net)
Theme Version:  1.3.0
*/


(function() {
        'use strict';
                 angular
                        .module('spmsapp')
                        .controller('StudentGraphAttendanceCtrl', StudentGraphAttendanceCtrl);

        function StudentGraphAttendanceCtrl($scope) {
        
        $scope.yearLists = [];
        $scope.months = [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ];

        $scope.status = {
            '1' : {
                'label': "Present", 
                'color': "#0088cc"
                },
            '2' : {
                'label': "Late", 
                'color': "#ed9c28"
            },
            '3' : {
                'label': "Absent" , 
                'color': "#E36159"
            }
        };
        
        $scope.morrisBarData = [];
        $scope.flotPieData = [];
        $scope.morrisDonutData = [];
        // $scope.morrisStackedData = [];

        var class_id, year_list, year, fromMonth, toMonth;   

         $(function () {
            $scope.getAttendance();
            $scope.pieChart();
            $('#form_year_list').on('change', function (e) {
               $scope.getAttendance();
               $scope.pieChart();
            });
            $('#form_month_list').on('change', function (e) {
               $scope.getAttendance();
               $scope.pieChart();
            });
              $('#to_month_list').on('change', function (e) {
               $scope.getAttendance();
               $scope.pieChart();
            });
            $('#form_class_id').on('change', function (e) {
               $scope.getAttendance();
               $scope.pieChart();
            });
        });


        $scope.init = function() {

            var d = new Date();
            var n = d.getFullYear();
            for (var i = 2000; i <= n; i++) {
                $scope.yearLists.push(i);
            }

        };

        $scope.appendZeroes = function (month) {
            return Number(month) > 9 ? month : '0' + Number(month);
        }

        $scope.getAttendance = function () {   
            class_id = $('select[name="class_id"] option:selected').val();
            year_list = $('select[name="year_list"] option:selected').val();
            fromMonth = $('select[name="from_month_list"]').val();
            toMonth = $('select[name="to_month_list"] option:selected').val();

            fromMonth  = $scope.appendZeroes(fromMonth);
            toMonth = $scope.appendZeroes(toMonth);

            $('#morrisBar').html('');
            // $('#morrisStacked').html('');
            

            $.get(BASE_URL + USER_PREFIX + 'attendance/get_all_students_attendance/' + class_id + '/' + fromMonth + '/'+  toMonth + '/' + year_list , function (data) {
                data = JSON.parse(data);
                $scope.morrisBarData = [];
                // $scope.morrisStackedData = [];

                //Bar Graph
               
                $.each($scope.months, function(monthKey, month) {
                    $scope.morrisBarData.push(
                        {
                            'y' : month,
                            'a' : 0,
                            'b' : 0
                        }
                    );
                    // $scope.morrisStackedData.push(
                    //     {
                    //         y: month,
                    //         a: 0,
                    //         b: 0
                    //     }
                    // );
                    $.each(data, function(dataKey, dataVal) {
                        if (monthKey + 1 == Number(dataVal.month)) {

                            var index = dataVal.status == 1 ? 'a' : (dataVal.status == 3 ? 'b' : '');

                            $scope.morrisBarData[monthKey][index] = Number(dataVal.data);
                            // $scope.morrisStackedData[monthKey][index] = Number(dataVal.data);
                        }
                    })
                });

                Morris.Bar({
                    resize: true,
                    element: 'morrisBar',
                    data: $scope.morrisBarData,
                    xkey: 'y',
                    ykeys: ['a', 'b'],
                    labels: ['Present', 'Absent'],
                    hideHover: true,
                    barColors: ['#0088cc', '#2baab1']
                });


                // Morris.Bar({
                //     resize: true,
                //     element: 'morrisStacked',
                //     data: $scope.morrisStackedData,
                //     xkey: 'y',
                //     ykeys: ['a', 'b'],
                //     labels: ['Present', 'Absent'],
                //     barColors: ['#0088cc', '#2baab1'],
                //     fillOpacity: 0.7,
                //     smooth: false,
                //     stacked: true,
                //     hideHover: true
                // });

            }).always(function() {
                // alert( "finished" );
            });
        };


        $scope.pieChart = function () {
            class_id = $('select[name="class_id"] option:selected').val();
            year_list = $('select[name="year_list"] option:selected').val();
            fromMonth = $('select[name="from_month_list"]').val();
            toMonth = $('select[name="to_month_list"] option:selected').val();

            fromMonth  = $scope.appendZeroes(fromMonth);
            toMonth = $scope.appendZeroes(toMonth);

            $('#flotPie').html('');
            $('#morrisDonut').html('');

            $.get(BASE_URL + USER_PREFIX + 'attendance/students_attendance_pie_chart/' + class_id + '/' + fromMonth + '/'+  toMonth + '/' + year_list , function (data) {
                data = JSON.parse(data);
                $scope.flotPieData = [];
                $scope.morrisDonutData = [];

                $.each(data, function(dataKey, dataVal) {    
                    $scope.flotPieData.push(
                    {
                        label: $scope.status["" + dataVal.status].label,
                        data: [
                            [1, Number(dataVal.data)]
                        ],
                        color: $scope.status["" + dataVal.status].color
                    });

                    $scope.morrisDonutData.push(
                        {
                            label: $scope.status["" + dataVal.status].label,
                            value: Number(dataVal.data)
                        }
                    );


                });

                if (data.length <= 0) {
                    $('.pie').html("No Attendance");
                    $scope.flotPieData.push(
                    {
                        label: 'No Attendance',
                        data: [
                            [1, 0]
                        ],
                        color: '#f6f6f6'
                    });

                    $scope.morrisDonutData.push(
                        {
                            label: 'No Attendance',
                            value: 0
                        }
                    );
                } else {
                     $('.pie').html("");
                }

                var plot = $.plot('#flotPie', $scope.flotPieData, {
                    series: {
                        pie: {
                            show: true,
                            combine: {
                                color: '#999',
                                threshold: 0.1
                            }
                        }
                    },
                    legend: {
                        show: false
                    },
                    grid: {
                        hoverable: true,
                        clickable: true
                    }
                });

                Morris.Donut({
                    resize: true,
                    element: 'morrisDonut',
                    data: $scope.morrisDonutData,
                    colors: ['#0088cc', '#734ba9', '#E36159']
                });

            }).always(function() {
                // alert( "finished" );
            });;
        };

        $scope.init();
    }

})();
