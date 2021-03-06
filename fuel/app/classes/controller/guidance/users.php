<?php
class Controller_Guidance_Users extends Controller_Users {

    public function action_get_teacher_name($user_id) {

        $data = Model_User::find('all', array(
                'where' => array(array('id', '=', $user_id)))
        );    

        return Format::forge($data)->to_json();
    }

    public function action_get_class_name($class_id) {

        $data = Model_User::find('all', array(
                'where' => array(array('id', '=', $class_id)))
        );    

        return Format::forge($data)->to_json();
    }
        // foreach ($student_list  as $key => $value) if($value['id']){
        //     $students[$value['id']]  = $value['fname'].'  '. $value['mname'][0].'.  '. $value['lname'];
        // }


    // public function action_get_all_students_not_in($class_id) {

    //     // $students = array();
    //     $student_list = Model_User::find('all', array(
    //             'select'    => array('id', 'fname', 'mname', 'lname'),
    //             'where'     => array(
    //                 array('group', '1'),
    //                 array('id', 'NOT IN', DB::select('user_id')
    //                                         ->distinct()
    //                                         ->from(Model_Studentclass::table())
    //                                         ->where('class_id', '=', $class_id))
    //             )
    //         )
    //     );
    //     // foreach ($student_list  as $key => $value) if($value['id']){
    //     //     $students[$value['id']]  = $value['fname'].'  '. $value['mname'][0].'.  '. $value['lname'];
    //     // }

    //     return Format::forge($student_list)->to_json();
    // }


    // public function action_index()
    // {
    //     $data['users'] = Model_User::find('all', array(
    //         'related' => array('studentlists' => array(
    //             'where' => array(array('user_id', Auth::get('id')))
    //         )),
    //         'group_by' => array('id')
    //     ));

    //     $this->template->title = "Students List";
    //     $this->template->content = View::forge(parent::get_prefix() . 'users/index', $data);
    // }

}


