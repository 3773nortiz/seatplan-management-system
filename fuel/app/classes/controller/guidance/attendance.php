<?php
class Controller_Guidance_Attendance extends Controller_Account
{

    public function action_index()
    {
        $data['attendances'] = Model_Attendance::find('all');
        $this->template->title = "Attendance";
        $this->template->content = View::forge(parent::get_prefix() . 'attendance/index', $data);

    }

    public function action_view($id = null)
    {
        $data['attendance'] = Model_Attendance::find($id);

        $this->template->title = "Attendance";
        $this->template->content = View::forge(parent::get_prefix() . 'attendance/view', $data);

    }

    public function action_create()
    {
        if (Input::method() == 'POST')
        {
            $val = Model_Attendance::validate('create');

            if ($val->run())
            {
                $attendance = Model_Attendance::forge(array(
                    'status' => Input::post('status'),
                    'studentclass_id' => Input::post('studentclass_id'),
                ));

                if ($attendance and $attendance->save())
                {
                    Session::set_flash('success', e('Added attendance #'.$attendance->id.'.'));

                    Response::redirect(parent::get_prefix() . 'attendance');
                }

                else
                {
                    Session::set_flash('error', e('Could not save attendance.'));
                }
            }
            else
            {
                Session::set_flash('error', $val->error());
            }
        }

        $this->template->title = "Attendances";
        $this->template->content = View::forge(parent::get_prefix() . 'attendance/create');

    }

    public function action_edit($id = null)
    {
        $attendance = Model_Attendance::find($id);
        $val = Model_Attendance::validate('edit');

        if ($val->run())
        {
            $attendance->status = Input::post('status');
            $attendance->studentclass_id = Input::post('studentclass_id');

            if ($attendance->save())
            {
                Session::set_flash('success', e('Updated attendance #' . $id));

                Response::redirect(parent::get_prefix() . 'attendance');
            }

            else
            {
                Session::set_flash('error', e('Could not update attendance #' . $id));
            }
        }

        else
        {
            if (Input::method() == 'POST')
            {
                $attendance->status = $val->validated('status');
                $attendance->studentclass_id = $val->validated('studentclass_id');

                Session::set_flash('error', $val->error());
            }

            $this->template->set_global('attendance', $attendance, false);
        }

        $this->template->title = "Attendances";
        $this->template->content = View::forge(parent::get_prefix() . 'attendance/edit');

    }

    public function action_delete($id = null)
    {
        if ($attendance = Model_Attendance::find($id))
        {
            $attendance->delete();

            Session::set_flash('success', e('Deleted attendance #'.$id));
        }

        else
        {
            Session::set_flash('error', e('Could not delete attendance #'.$id));
        }

        Response::redirect(parent::get_prefix() . 'attendance');

    }

    public function action_set_attendace ($studClassId, $status) {
        $attendance = Model_Attendance::find('first', [
            'or_where'  => [
                [DB::expr('UNIX_TIMESTAMP() - updated_at'), '<=', Config::get('attendace_delay')],
            ],
            'where'     => [['studentclass_id', $studClassId]],
            'order_by'  => ['updated_at' => 'desc']
        ]);

        if (!$attendance) {
            $attendance = Model_Attendance::forge([
                'status'            => $status,
                'studentclass_id'   => $studClassId
            ]);

        } else {
            $attendance->status = $status;
        }

        return $attendance->save();
    }

    /**
    * @param $fromDate, $toDate timestamp
    *
    */
    public function action_get_attendances ($class_id, $fromDate, $toDate) {

        return Format::forge(DB::select(Model_Studentclass::table() . '.id', 'user_id', 'fname', 'mname', 'lname', 'status', [DB::expr('SUBSTR(FROM_UNIXTIME('. Model_Attendance::table() .'.updated_at), 1, 10)'), 'date'])
            ->from(Model_Studentclass::table())
            ->join(Model_User::table(), 'INNER')->on('user_id', '=', Model_User::table() . '.id')
                ->on('class_id', '=', DB::escape($class_id))
            ->join(Model_Attendance::table(), 'LEFT')->on('studentclass_id', '=', Model_Studentclass::table() . '.id')
                ->on(Model_Attendance::table() . '.updated_at', 'BETWEEN', DB::escape($fromDate) .  ' AND ' . DB::escape($toDate))
            ->group_by([DB::expr('SUBSTR(FROM_UNIXTIME('. Model_Attendance::table() .'.updated_at), 1, 10)'), 'user_id'])
            ->order_by('lname')
            ->order_by(Model_Attendance::table() . '.updated_at')
            ->order_by('user_id')
            ->execute())->to_json();
    }

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

            ->where(array(
                array(DB::expr('SUBSTR(FROM_UNIXTIME('. Model_Attendance::table().'.updated_at), 1, 4)'), '=', DB::expr(DB::quote($year))),
                array(DB::expr('SUBSTR(FROM_UNIXTIME('. Model_Attendance::table(). '.updated_at), 6, 2)'), 'BETWEEN', DB::expr(DB::quote($fromMonth) . ' AND ' . DB::quote($toMonth)))
            ))

            ->group_by('month', Model_Attendance::table().'.status')
            ->execute())->to_json();
    }

    public function action_faker ($limit = 10) {
        $studentclasses = Model_Studentclass::find('all');
        $data = '';

        for ($x = 0; $x < $limit; $x++) {
            foreach ($studentclasses as $key => $studentclass) {
                $attendance = new Model_Attendance();
                $attendance->status = rand(1, 3);
                $attendance->studentclass_id = $studentclass->id;
                if ($attendance->save(true)) {
                    $attendance->updated_at = time() + $x * 86400;
                    DB::query("UPDATE attendances SET updated_at = $attendance->updated_at WHERE id = $attendance->id")->execute();
                }

                $data .= Format::forge($attendance)->to_json();
            }
        }
        return $data;
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

            ->where(array(
                array(DB::expr('SUBSTR(FROM_UNIXTIME('. Model_Attendance::table().'.updated_at), 1, 4)'), '=', DB::expr(DB::quote($year))),
                array(DB::expr('SUBSTR(FROM_UNIXTIME('. Model_Attendance::table(). '.updated_at), 6, 2)'), 'BETWEEN', DB::expr(DB::quote($fromMonth) . ' AND ' . DB::quote($toMonth)))
            ))

            ->group_by(Model_Attendance::table().'.status')
            ->execute())->to_json();
    }

}
