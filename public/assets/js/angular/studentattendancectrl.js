(function() {
        'use strict';
                 angular
                        .module('spmsapp')
                        .controller('StudentAttendanceCtrl', StudentAttendanceCtrl);

        function StudentAttendanceCtrl($scope) {
            var class_id;
            $scope.studLists = {};
            $scope.noStudent = false;
            $scope.ranges = [];

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


            $scope.weeks = [
                'Sunday',
                'Monday',
                'Tuesday',
                'Wednesday',
                'Thursday',
                'Friday',
                'Saturday',
            ];



            $(function () {
                    $scope.getDateRangeData();
                    $('.input-daterange').datepicker().on('changeDate', function(e){
                        $scope.getDateRangeData();


                        $scope.getDateRanges();
                    });
                    $('#form_class_id').on('change', function (e) {
                        $scope.getDateRangeData();


                        $scope.getDateRanges();
                    });
            });



            $scope.test = function () {
              console.log('asd');
            };

            $scope.getDateRangeData = function () {
                $scope. getClassValue();
                var date = $('input[name="start"]').val();
                var endate = $('input[name="end"]').val();

                if (date && class_id && endate) {
                    $scope.noStudent = true;
                    $('.noStudent').text('');
                    var fromDate = new Date(date);
                    fromDate.setHours(0);
                    fromDate.setMinutes(0);
                    fromDate.setSeconds(0);

                    var toDate = new Date(endate);
                    toDate.setHours(23);
                    toDate.setMinutes(59);
                    toDate.setSeconds(59);

                    fromDate = new Date(fromDate) / 1000;
                    toDate = new Date(toDate) / 1000;

                    $.get(BASE_URL + USER_PREFIX + 'attendance/get_attendances/' + class_id + '/' + fromDate + '/' + toDate, function (data) {
                            var parsed = JSON.parse(data);
                        if(data.length > 0) {
                            for (var key in parsed) {
                                if (!$scope.studLists[parsed[key].id]) {
                                    $scope.studLists[parsed[key].id] = {
                                        'attendances': []
                                    }
                                }
                                $scope.studLists[parsed[key].id].attendances.push(parsed[key]);
                            }
                            if($scope.studLists.status == null) {
                                 $scope.noStudent = true;
                            }
                            $scope.$digest($scope.studLists);
                        } 
                        $scope.studLists = [];
                    });
                    
                        $scope.ranges = [];
                } else {

                    $scope.noStudent = false;
                    $('.noStudent').text('No Attendance Lists');
                } 

            };


            $scope.getClassValue = function () {
                class_id = $('select[name="class_id"] option:selected').val();
            };

            $scope.getStatusValue = function (status) {
                var attendance;
                if(status == null || status == 4) {
                   attendance = "No Attendance";
                } else {
                    attendance = ATTENDANCE[status].name;
                }
                return attendance;

            };

            $scope.getDateRanges = function () {

                var sdate = $('input[name="start"]').val();
                var edate = $('input[name="end"]').val();

                var rangeStartDate = new Date(sdate);
                var rangeEndDate = new Date(edate);
                    
                while(rangeStartDate <= rangeEndDate) 
                {
                    $scope.dateObj = {
                       'months' :  $scope.months[rangeStartDate.getMonth()],
                       'date'   :  rangeStartDate.getDate(),
                       'year'   :  rangeStartDate.getFullYear(),
                       'weeks'  :  $scope.weeks[rangeStartDate.getDay()],
                    };

                    $scope.ranges.push($scope.dateObj);
                    $scope.$digest($scope.ranges);

                    rangeStartDate.setDate(rangeStartDate.getDate() + 1);
                }

               
            }

        }

})();


