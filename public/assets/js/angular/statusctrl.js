(function() {
        'use strict';
                 angular
                        .module('spmsapp')
                        .controller('StatusCtrl', StatusCtrl);

        function StatusCtrl($scope) {
            $scope.statusLists = {};
            var class_id;


            $(function () {
                $scope.getStatus();
                $('#form_class_id').on('change', function (e) {   
                        $scope.getStatus();
                });
            });


            $scope.getStatus = function () {
                $scope. getClassValue();
                console.log('ff');
                $.get(BASE_URL + USER_PREFIX + 'attendance/get_notified_students_by_class/' + class_id, function (data) {
                    $scope.statusLists = {};
                    var parsed = JSON.parse(data);
                    console.log(parsed);
                     if(data.length > 0) {
                        $scope.statusLists = parsed;
                        $scope.$digest($scope.statusLists);
                    }
                });

            };

            $scope.getClassValue = function () {
                class_id = $('select[name="class_id"] option:selected').val();
            };

        }
})();


