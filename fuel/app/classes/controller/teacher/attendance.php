<?php
class Controller_Teacher_Attendance extends Controller_Account
{

	public function action_index()
	{
		$data['attendances'] = Model_Attendance::find('all');
		$this->template->title = "Attendances";
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

}
