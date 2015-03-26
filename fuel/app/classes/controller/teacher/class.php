<?php
class Controller_Teacher_Class extends Controller_Account
{

	public function action_index()
	{
		$data['classes'] = Model_Class::find('all', [
			'where'	=> array(
				array('user_id', Auth::get('id'))
			)
		]);
		$this->template->title = "Class";
		$this->template->content = View::forge(parent::get_prefix() . 'class/index', $data);

	}

	public function action_view($id = null)
	{
		$data['class'] = Model_Class::find($id, [
			'where'	=> array(
				array('user_id', Auth::get('id'))
			)
		]);

		if (!$data['class']) {
			return View::forge('404');
		}

		$data['student_seats'] = Controller_Teacher_Studentclass::get_student_seats($id);
		//$data['students'] = Controller_Teacher_Users::get_all_students_not_in($id);
		$data['scenario'] = 'view';

		$this->template->title = "Class";
		$this->template->content = View::forge(parent::get_prefix() . 'class/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Class::validate('create');

			if ($val->run())
			{
				$chairs = Input::post('chairs');
				$chair_plan = '';
				$row = 'A';
				$col = 1;
				for ($i = 0; $i < $chairs; $i++, $col++) {
					if ($chairs > Config::get('number_of_seat') || ($chairs <= Config::get('number_of_seat') && !in_array($col, [1, 6, 11]))) {
						if ($chair_plan) {
							$chair_plan .= ',';
						}
						$chair_plan .= '"' . $row . $col . '":1';
					} else {
						$i--;
					}

					if ($col >= 11) {
						$col = 0;
						$row++;
					}
				}

				$class = Model_Class::forge(array(
					'class_name' => Input::post('class_name'),
					'chairs' => Input::post('chairs'),
					'subject_id' => Input::post('subject_id'),
					'user_id' => Input::post('user_id'),
					'chair_plan' => '{' . $chair_plan . '}'
				));

				if ($class and $class->save())
				{
					Session::set_flash('success', e('Added class '.$class->class_name.'.'));

					Response::redirect(parent::get_prefix() . 'class');
				}

				else
				{
					Session::set_flash('error', e('Could not save class.'));
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Class";
		$this->template->content = View::forge(parent::get_prefix() . 'class/create', ['scenario' => 'add']);

	}

	public function action_edit($id = null)
	{
		$class = Model_Class::find($id, [
			'where'	=> array(
				array('user_id', Auth::get('id'))
			)
		]);

		if (!$class) {
			return View::forge('404');
		}
		$val = Model_Class::validate('edit');

		if ($val->run())
		{
			$class->class_name = Input::post('class_name');
			// $class->chairs = Input::post('chairs');
			$class->subject_id = Input::post('subject_id');
			$class->user_id = Input::post('user_id');

			if ($class->save())
			{
				Session::set_flash('success', e('Updated class ' . $class->class_name));

				Response::redirect(parent::get_prefix() . 'class');
			}

			else
			{
				Session::set_flash('error', e('Could not update class ' . $class->class_name));
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$class->class_name = $val->validated('class_name');
				$class->chairs = $val->validated('chairs');
				$class->subject_id = $val->validated('subject_id');
				$class->user_id = $val->validated('user_id');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('class', $class, false);
		}

		$data['student_seats'] = Controller_Teacher_Studentclass::get_student_seats($id);
		// $data['students'] = Controller_Teacher_Users::get_all_students();
		$data['class'] = $class;
		$data['scenario'] = 'edit';

		$this->template->title = "Class";
		$this->template->content = View::forge(parent::get_prefix() . 'class/edit', $data);

	}

	public function action_delete($id = null)
	{
		if ($class = Model_Class::find($id))
		{
			$class->delete();

			Session::set_flash('success', e('Deleted class'.$class->class_name));
		}

		else
		{
			Session::set_flash('error', e('Could not delete class #'.$id));
		}

		Response::redirect(parent::get_prefix() . 'class');

	}

	public function action_update_seatplan($class_id, $new_seatplan)
	{
		$class = Model_Class::find($class_id);
		$new_seatplan = htmlspecialchars_decode($new_seatplan);
		$class->chairs = sizeof(explode(',', $new_seatplan));
		$class->chair_plan = $new_seatplan;
		return $class->save();
	}

	public function action_moveboard ($class_id, $type, $direction) {
		$class = Model_Class::find($class_id);
		if ($type == 'desk') {
			$class->table_position = Config::get('class_position')[$direction];
		} else if ($type == 'board') {
			$class->board_position = Config::get('class_position')[$direction];
		}

		return $class->save();
	}

}
