(function() {
        'use strict';
                 angular
                        .module('spmsapp')
                        .controller('StatusCtrl', StatusCtrl);

        function StatusCtrl($scope) {
            $scope.statusLists = {};


            $(function () {
                $scope.getStatus();
            });


            $scope.getStatus = function () {
                $.get(BASE_URL + USER_PREFIX + 'attendance/get_notified_students/', function (data) {
                    $scope.statusLists = {};
                    var parsed = JSON.parse(data);
                     if(data.length > 0) {
                        $scope.statusLists = parsed;
                        $scope.$digest($scope.statusLists);
                    }
                });

            };

        }
})();


