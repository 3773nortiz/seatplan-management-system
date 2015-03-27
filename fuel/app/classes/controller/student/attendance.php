<?php
class Controller_Student_Attendance extends Controller_Account
{
    /**
    * @param $fromMonth mm
    * @param $toMonth mm
    * @param $year yyyy
    */
    public function action_get_all_students_attendance($class_id, $fromMonth, $toMonth, $year) {

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
                array(DB::expr('SUBSTR(FROM_UNIXTIME('. Model_Attendance::table().'.updated_at), 1, 4)'), '=', DB::expr($year)),
                array(DB::expr('SUBSTR(FROM_UNIXTIME('. Model_Attendance::table(). '.updated_at), 6, 2)'), 'BETWEEN', DB::expr(DB::quote($fromMonth) . ' AND ' . DB::quote($toMonth)))
            ))

            ->group_by('month', Model_Attendance::table().'.status')
            ->execute())->to_json();
    }


    /**
    * @param $fromMonth mm
    * @param $toMonth mm
    * @param $year yyyy
    */
    public function action_students_attendance_pie_chart($class_id, $fromMonth, $toMonth, $year) {

        return Format::forge(DB::select(
                Model_Studentclass::table() . '.class_id',
                array(DB::expr('COUNT(' . Model_Attendance::table() . '.id)'), 'data'),
                'status'
            )
            ->from(Model_Attendance::table())

            ->join(Model_Studentclass::table(), 'INNER')
                ->on(Model_Attendance::table().'.studentclass_id', '=', Model_Studentclass::table(). '.id')
                ->on(Model_Studentclass::table(). '.class_id', '=', DB::expr($class_id))
                ->on(Model_Studentclass::table(). '.user_id', '=', DB::expr(Auth::get('id')))

            ->where(array(
                array(DB::expr('SUBSTR(FROM_UNIXTIME('. Model_Attendance::table().'.updated_at), 1, 4)'), '=', DB::expr($year)),
                array(DB::expr('SUBSTR(FROM_UNIXTIME('. Model_Attendance::table(). '.updated_at), 6, 2)'), 'BETWEEN', DB::expr(DB::quote($fromMonth) . ' AND ' . DB::quote($toMonth)))
            ))

            ->group_by(Model_Attendance::table().'.status')
            ->execute())->to_json();
    }

    public function action_get_notified ()
    {
        $attendances = Model_Attendance::find('all', [
            'related'  => [
                'studentclass' => [
                    'related' => [
                        'class'   => [
                            'related' => ['subject']
                        ],
                        'student' => [
                            'where'   => [['id', '=', Auth::get('id')]],
                        ]
                    ]
                ]
            ],
            'order_by' => ['studentclass_id', 'updated_at'],
            'where'    => [['status', 3]]
        ]);

        $notified = [];
        $ctr = 0;
        $currStudentclassId = -1;
        $currValue;

        foreach ($attendances as $key => $value) {
            $currValue = $value;

            if ($value->studentclass_id != $currStudentclassId) {
                if ($ctr >= 3) {
                    $notified[] = [
                        'studentclass_id' => $currValue->studentclass_id,
                        'absent_count'    => $ctr,
                        'name'            => ucwords($currValue->studentclass->student->fname . ' ' . $currValue->studentclass->student->mname[0] . '. ' . $currValue->studentclass->student->lname),
                        'class'           => $currValue->studentclass->class->class_name,
                        'subject'         => $currValue->studentclass->class->subject->subject_name,
                        'user_id'         => $currValue->studentclass->student->id
                    ];
                }
                $ctr = 0;
                $currStudentclassId = $value->studentclass_id;
            }
            $ctr++;
        }
        if ($ctr >= 3) {
            $notified[] = [
                'studentclass_id' => $currValue->studentclass_id,
                'absent_count'    => $ctr,
                'name'            => ucwords($currValue->studentclass->student->fname . ' ' . $currValue->studentclass->student->mname[0] . '. ' . $currValue->studentclass->student->lname),
                'class'           => $currValue->studentclass->class->class_name,
                'subject'         => $currValue->studentclass->class->subject->subject_name,
                'user_id'         => $currValue->studentclass->student->id
            ];
        }

        return Format::forge($notified)->to_json();
    }
}
