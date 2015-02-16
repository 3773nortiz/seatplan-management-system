/*
Name:           UI Elements / Charts - Examples
Written by:     Okler Themes - (http://www.okler.net)
Theme Version:  1.3.0
*/


(function() {
        'use strict';
                 angular
                        .module('spmsapp')
                        .controller('GraphAttendanceCtrl', GraphAttendanceCtrl);

        function GraphAttendanceCtrl($scope) {
        
        $scope.yearLists = [];
        $scope.month = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ];
        
        $scope.morrisBarData = [{
                y: $scope.month[0],
                a: 10,
                b: 30
            }, {
                y: $scope.month[1],
                a: 100,
                b: 25
            }, {
                y: $scope.month[2],
                a: 60,
                b: 25
            }, {
                y: $scope.month[3],
                a: 75,
                b: 35
            }  ];

            // {
            //     y: '2008',
            //     a: 90,
            //     b: 20
            // }, {
            //     y: '2009',
            //     a: 75,
            //     b: 15
            // }, {
            //     y: '2010',
            //     a: 50,
            //     b: 10
            // }, {
            //     y: '2011',
            //     a: 75,
            //     b: 25
            // }, {
            //     y: '2012',
            //     a: 30,
            //     b: 10
            // }, {
            //     y: '2013',
            //     a: 75,
            //     b: 5
            // }, {
            //     y: '2014',
            //     a: 60,
            //     b: 8
            // }

            $scope.init = function() {

                var d = new Date();
                var n = d.getFullYear();
                
                for (var i = n; i <= 2019; i++) {
                    $scope.yearLists.push(i);
                }

                console.log($scope.yearLists);
               
                Morris.Bar({
                    resize: true,
                    element: 'morrisBar',
                    data: $scope.morrisBarData,
                    xkey: 'y',
                    ykeys: ['a', 'b'],
                    labels: ['Series A', 'Series B'],
                    hideHover: true,
                    barColors: ['#0088cc', '#2baab1']
                });
            };

            $scope.getAttendance = function () {
                $.get(BASE_URL + USER_PREFIX + 'attendance/get_all_students_attendance/' + class_id + '/' + year , function (data) {
                        var parsed = JSON.parse(data);
                        console.log(parsed);
                });
            };


            $scope.init();
        }

})();





