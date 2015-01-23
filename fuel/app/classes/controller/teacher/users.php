<?php
class Controller_Teacher_Users extends Controller_Users
{

    public static function get_all_students() {

        $students = array();
        $student_list = Model_User::find('all', array(
                'select'    => array('id', 'fname', 'mname', 'lname'),
                'where'     => array(array('group', '1'))));

        foreach ($student_list  as $key => $value) {
            $students[$value['id']]  = $value['fname'].'  '. $value['mname'][0].'.  '. $value['lname'];
        }

        return $students;
    }

}
