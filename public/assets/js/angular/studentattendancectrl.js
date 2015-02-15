(function() {
        'use strict';
                 angular
                        .module('spmsapp')
                        .controller('StudentAttendanceCtrl', StudentAttendanceCtrl);

        function StudentAttendanceCtrl($scope) {
            var class_id;
            $scope.studLists = [];
            $scope.noStudent;

            $(function () {
                 $scope.getDateRangeData();
            });


            $scope.getDateRangeData = function () {
                $scope. getClassValue();

                $('.input-daterange').datepicker()
                .on('changeDate', function(e){

                    var date = $('input[name="start"]').val();

                    $scope.getClassValue();

                    if (date && class_id) {
                        var fromDate = new Date(date);
                        fromDate.setHours(0);
                        fromDate.setMinutes(0);
                        fromDate.setSeconds(0);

                        var toDate = new Date(date);
                        toDate.setHours(23);
                        toDate.setMinutes(59);
                        toDate.setSeconds(59);
                        fromDate = new Date(fromDate) / 1000;
                        toDate = new Date(toDate) / 1000;
                        
                        $.get(BASE_URL + USER_PREFIX + 'attendance/get_attendances/' + class_id + '/' + fromDate + '/' + toDate, function (data) {
                                var parsed = JSON.parse(data);
                             if(data.length > 0) {
                                for (var key in parsed) {
                                        if(parsed[key].status == null) {
                                            parsed[key].status = 4;
                                        }
                                    $scope.studLists.push(parsed[key]);
                                    $scope.$digest($scope.studLists);
                                }
                            } else {
                                $scope.noStudent = "No Student";
                            }
                            $scope.studLists = [];

                        });
                    }
                });

            };


            $scope.getClassValue = function () {
                class_id = $('select[name="class_id"] option:selected').val();
            };

            $scope.getStatusValue = function (status) {

                var attendance = ATTENDANCE[status].name;

                return attendance;

            };

        }

})();





