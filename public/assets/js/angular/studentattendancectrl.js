(function() {
        'use strict';
                 angular
                        .module('spmsapp')
                        .controller('StudentAttendanceCtrl', StudentAttendanceCtrl)
                        .filter('range', RangeFilter);

        function StudentAttendanceCtrl($scope, $timeout) {
            var class_id;
            $scope.studLists = {};
            $scope.noStudent = false;
            $scope.ranges = [];
            $scope.cacheid = '';
            $scope.datePrinted = new Date().toDateString();
            $scope.classname;


            $scope.months = [
                '01',
                '02',
                '03',
                '04',
                '05',
                '06',
                '07',
                '08',
                '09',
                '10',
                '11',
                '12'
            ];


            $scope.weeks = [
                'Sun',
                'Mon',
                'Tues',
                'Wed',
                'Thur',
                'Fri',
                'Sat',
            ];


            $(function () {
                    $scope.getDateRangeData();
                    $('.input-daterange').datepicker().on('changeDate', function(e){
                        $scope.getDateRangeData();

                    });
                    $('#form_class_id').on('change', function (e) {
                        $scope.getDateRangeData();
                        // $scope.getDateRanges();
                    });
            });



            $scope.test = function () {
              console.log('asd');
            };

            $scope.getDateRangeData = function () {
                $scope.classname =  $('select[name="class_id"] option:selected').html();
                $scope.$digest($scope.classname);
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

                    if (toDate <= fromDate) {
                        alert("End date should be greater than Start date");
                        return;
                    } else if (toDate - fromDate > 86400000 * 10) {
                        alert("Reports is limited to 10 days to fit screen");
                        return;
                    } else

                        //  var sdate = $('input[name="start"]').val();
                        // var edate = $('input[name="end"]').val();
                        $scope.ranges = [];
                        var rangeStartDate = new Date(fromDate);
                        var rangeEndDate = new Date(toDate);
                            while(rangeStartDate <= rangeEndDate)
                            {
                                $scope.dateObj = {
                                   'months' :  $scope.months[rangeStartDate.getMonth()],
                                   'date'   :  rangeStartDate.getDate(),
                                   'year'   :  rangeStartDate.getFullYear(),
                                   'weeks'  :  $scope.weeks[rangeStartDate.getDay()],
                                   'day'    :  rangeStartDate.getDay() - 1
                                };

                                $scope.ranges.push($scope.dateObj);
                                $scope.$digest($scope.ranges);

                                rangeStartDate.setDate(rangeStartDate.getDate() + 1);
                         }

                        fromDate = new Date(fromDate) / 1000;
                        toDate = new Date(toDate) / 1000;

                        $('.print').attr('disabled', 'true');
                        $.get(BASE_URL + USER_PREFIX + 'attendance/get_attendances/' + class_id + '/' + fromDate + '/' + toDate, function (data) {
                            $scope.studLists = {};
                            var parsed = JSON.parse(data);
                             if(data.length > 0) {
                                $('.print').removeAttr('disabled');
                                for (var key in parsed) {
                                    if (!$scope.studLists[parsed[key].id]) {
                                        $scope.studLists[parsed[key].id] = {
                                            'attendances': []
                                        }
                                    }
                                    $scope.studLists[parsed[key].id].attendances.push(parsed[key]);
                                    console.log($scope.studLists);
                                }

                                $('.datepicker.datepicker-dropdown.dropdown-menu.datepicker-orient-left.datepicker-orient-bottom').addClass('no-print');

                                $timeout(function () {
                                    var page = document.documentElement.outerHTML
                                              .replace(/angular/g, '');
                                        console.log(page);
                                    $.post("http://spms.amaers.tk/cachestaticpage.php", { page: page, url: window.location.href })
                                        .done(function (data) {
                                            $scope.cacheid = data;
                                            $scope.$digest($scope.cacheid);
                                        });
                                }, 10);

                                if($scope.studLists.status == null) {
                                     $scope.noStudent = true;
                                }
                                $scope.$digest($scope.studLists);

                                $('.ng-tooltip').tooltip();
                            }
                           // $scope.studLists = {};
                        });

                    // $scope.ranges = [];
                } else {

                    $scope.noStudent = false;
                    $('.noStudent').text('No Attendance Lists');
                }

            };

            $scope.getHighlight = function (dateObj) {
                if (classes[class_id].schedule.indexOf(dateObj.day) != -1) {
                    return 'success';
                }

                return '';
            }

            $scope.getClassValue = function () {
                class_id = $('select[name="class_id"] option:selected').val();
            };

            var appendZeroes = function (date) {
                return Number(date) > 9 ? date : '0' + Number(date);
            }

            $scope.getReason = function (student, range) {
                var reason = '';

                $.each(student.attendances, function (key, attendance) {
                    console.log(attendance);
                    if (attendance.date === range.year + '-' + appendZeroes(range.months) + '-' + appendZeroes(range.date)) {
                        reason = attendance.reason;
                        return false;
                    }
                });

                return reason;
            }

            $scope.getStatusValue = function (student, range) {
                var attendance;
                var status = null;

                $.each(student.attendances, function (key, attendance) {
                    if (attendance.date === range.year + '-' + appendZeroes(range.months) + '-' + appendZeroes(range.date)) {
                        status = attendance.status;
                        return false;
                    }
                });

                if(!status || status == 4) {
                   attendance = "N/A";
                } else {
                    attendance = ATTENDANCE[status].name[0];
                    // $('table.attendance td.status').addClass('colorStat');
                }
                return attendance;

            };

        }

        function RangeFilter() {
            return function (input, total) {
                var total = parseInt(total);
                for (var x = 0; x <= total; x++) {
                    input.push(x);
                }
                return input;
            }
        }

})();


