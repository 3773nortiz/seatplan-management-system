<?php
class Controller_Teacher_Studentclass extends Controller_Base
{

	public function action_index()
	{
		$data['studentclasses'] = Model_Studentclass::find('all');
		$this->template->title = "Studentclasses";
		$this->template->content = View::forge(parent::get_prefix() . 'studentclass/index', $data);

	}

	public function action_view($id = null)
	{
		$data['studentclass'] = Model_Studentclass::find($id);
		$data['student_seats'] =

		$this->template->title = "Studentclass";
		$this->template->content = View::forge(parent::get_prefix() . 'studentclass/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Studentclass::validate('create');

			if ($val->run())
			{
				$studentclass = Model_Studentclass::forge(array(
					'user_id' => Input::post('user_id'),
					'class_id' => Input::post('class_id'),
					'seat' => Input::post('seat'),
				));

				if ($studentclass and $studentclass->save())
				{
					Session::set_flash('success', e('Added studentclass #'.$studentclass->id.'.'));

					Response::redirect(parent::get_prefix() . 'studentclass');
				}

				else
				{
					Session::set_flash('error', e('Could not save studentclass.'));
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Studentclasses";
		$this->template->content = View::forge(parent::get_prefix() . 'studentclass/create');

	}

	public function action_edit($id = null)
	{
		$studentclass = Model_Studentclass::find($id);
		$val = Model_Studentclass::validate('edit');

		if ($val->run())
		{
			$studentclass->user_id = Input::post('user_id');
			$studentclass->class_id = Input::post('class_id');
			$studentclass->seat = Input::post('seat');

			if ($studentclass->save())
			{
				Session::set_flash('success', e('Updated studentclass #' . $id));

				Response::redirect(parent::get_prefix() . 'studentclass');
			}

			else
			{
				Session::set_flash('error', e('Could not update studentclass #' . $id));
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$studentclass->user_id = $val->validated('user_id');
				$studentclass->class_id = $val->validated('class_id');
				$studentclass->seat = $val->validated('seat');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('studentclass', $studentclass, false);
		}

		$this->template->title = "Studentclasses";
		$this->template->content = View::forge(parent::get_prefix() . 'studentclass/edit');

	}

	public function action_delete($id = null)
	{
		if ($studentclass = Model_Studentclass::find($id))
		{
			$studentclass->delete();

			Session::set_flash('success', e('Deleted studentclass #'.$id));
		}

		else
		{
			Session::set_flash('error', e('Could not delete studentclass #'.$id));
		}

		Response::redirect(parent::get_prefix() . 'studentclass');

	}

	public function action_add_student($user_id, $class_id, $seat) {
		$studentclass = Model_Studentclass::forge();
		$studentclass->user_id = $user_id;
		$studentclass->class_id = $class_id;
		$studentclass->seat = $seat;

		if ($studentclass->save()) {
			$student = Model_User::find($user_id);
			$data = [
				'id'		=> $studentclass->id,
				'gender'	=> Config::get('gender')[$student->gender]
			];
			return json_encode($data);
		}

		return new Response("Could not save to DB", 500);

	}

	public function action_reseat_student($student_id, $class_id, $seat = null) {
		$student = Model_Studentclass::find('first', [
			'where'	=> [
				['user_id', $student_id],
				['class_id', $class_id]
			]
		]);

		if ($seat) {
			$student->seat = $seat;
			return $student->save();
		} else {
			return $student->delete();
		}

	}

	public static function get_student_seats($class_id) {
		return DB::select(Model_Studentclass::table() . '.id', 'user_id', 'fname', 'mname', 'lname', 'seat', 'gender', 'status')
			->from(Model_Studentclass::table())
			->join(Model_User::table(), 'INNER')->on('user_id', '=', Model_User::table() . '.id')
				->on('class_id', '=', DB::escape($class_id))
			->join(Model_Attendance::table(), 'LEFT')->on('studentclass_id', '=', Model_Studentclass::table() . '.id')
				->on(DB::expr('UNIX_TIMESTAMP() - ' . Model_Attendance::table() . '.updated_at'), '<=', DB::escape(Config::get('attendace_delay')))
			->group_by('user_id')
			->execute()
			->as_array('seat');
	}

}
