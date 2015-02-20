<?php
class Controller_Student_Attendance extends Controller_Account
{
    /**
    * @param $year yyyy
    */
    public function action_get_all_students_attendance($class_id, $year) {

        return Format::forge(DB::select(
                Model_Studentclass::table() . '.class_id',
                array(DB::expr('SUBSTR(FROM_UNIXTIME('. Model_Attendance::table(). '.updated_at), 6, 2)'), 'month'),
                array(DB::expr('COUNT(' . Model_Attendance::table() . '.id)'), 'data'),
                'status'
            )
            ->from(Model_Attendance::table())

            ->join(Model_Studentclass::table(), 'INNER')
                ->on(Model_Attendance::table().'.studentclass_id', '=', Model_Studentclass::table(). '.id')
                ->on(Model_Studentclass::table(). '.class_id', '=', DB::expr($class_id))
                ->on(Model_Studentclass::table(). '.user_id', '=', DB::expr(Auth::get('id')))

            ->where(array(
                array(DB::expr('SUBSTR(FROM_UNIXTIME('. Model_Attendance::table().'.updated_at), 1, 4)'), '=', DB::expr($year))
            ))
            
            ->group_by(DB::expr('SUBSTR(FROM_UNIXTIME('. Model_Attendance::table().'.updated_at), 6, 2)'), Model_Attendance::table().'.status')
            ->execute())->to_json();
    }

    
    /**
    * @param $year yyyy
    */
    public function action_students_attendance_pie_chart($class_id, $year) {

        return Format::forge(DB::select(
                Model_Studentclass::table() . '.class_id',
                array(DB::expr('COUNT(' . Model_Attendance::table() . '.id)'), 'data'),
                'status'
            )
            ->from(Model_Attendance::table())

            ->join(Model_Studentclass::table(), 'INNER')
                ->on(Model_Attendance::table().'.studentclass_id', '=', Model_Studentclass::table(). '.id')
                ->on(Model_Studentclass::table(). '.class_id', '=', DB::expr($class_id))

            ->where(array(
                array(DB::expr('SUBSTR(FROM_UNIXTIME('. Model_Attendance::table().'.updated_at), 1, 4)'), '=', DB::expr($year))
            ))
            
            ->group_by(Model_Attendance::table().'.status')
            ->execute())->to_json();
    }
}
