(function() {
    'use strict';
         angular
            .module('spmsapp', [])
            .controller('AddStudentCtrl', AddStudentCtrl);

    function AddStudentCtrl($scope) {

      $scope.students = [];


       $scope.updateStudentList = function () {
            $.ajax({
              url: BASE_URL + USER_PREFIX +'users/get_all_students_not_in/' + classId,
              data: '',
              async: false,
              dataType: 'json',
              success: function(data){
                for(var student in data) {
                  $scope.students.push(data[student]);
                }

                 if($scope.students.length <= 0) {
                    $('.add-student-action').attr('disabled');
                  }
                // $scope.$digest($scope.students);
              }
            });
       };

      $scope.removeStudent = function() {
         // var idx = $('[name="select1"] option:selected').index();
          //$scope.students.splice(idx, 1);
          //$('[name="select1"] option').eq(0).attr('selected', 'true');
      };

      $scope.updateStudentList();


    }

})();





       