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
              }
            });
       };

      $scope.removeStudent = function(studObj) {
        $('#select1').selectator('destroy');
        // var idx = $('[name="select1"] option:selected').index();
        //$scope.students.splice(idx, 1);
        //$('[name="select1"] option').eq(0).attr('selected', 'true');
        $scope.students.push({
          fname: studObj.fname,
          mname: studObj.mname,
          lname: studObj.lname,
          id: studObj.user_id
        });
        console.log($scope.students);
        $scope.$digest($scope.students);
        $('#select1').selectator();
      };

      $scope.addStudent = function (studId) {
        $('#select1').selectator('destroy');
        for (var key in $scope.students) {
          var value = $scope.students[key];
          console.log(value);
          console.log(key);
          if (value.id == studId) {
            $scope.students.splice(key, 1);
            break
          }
        }
        console.log($scope.students);
        $scope.$digest($scope.students);
        $('#select1').selectator();
      };

      $scope.updateStudentList();
      console.log($scope.students);

    }

})();





