<?php
class Controller_Teacher_Class extends Controller_Account
{

	public function action_index()
	{
		$data['classes'] = Model_Class::find('all');
		$this->template->title = "Classes";
		$this->template->content = View::forge(parent::get_prefix() . 'class/index', $data);

	}

	public function action_view($id = null)
	{
		$data['class'] = Model_Class::find($id);
		$data['student_seats'] = Controller_Teacher_Studentclass::get_student_seats($id);

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
				$class = Model_Class::forge(array(
					'class_name' => Input::post('class_name'),
					'chairs' => Input::post('chairs'),
					'subject_id' => Input::post('subject_id'),
					'user_id' => Input::post('user_id'),
				));

				if ($class and $class->save())
				{
					Session::set_flash('success', e('Added class #'.$class->id.'.'));

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

		$this->template->title = "Classes";
		$this->template->content = View::forge(parent::get_prefix() . 'class/create');

	}

	public function action_edit($id = null)
	{
		$class = Model_Class::find($id);
		$val = Model_Class::validate('edit');

		if ($val->run())
		{
			$class->class_name = Input::post('class_name');
			$class->chairs = Input::post('chairs');
			$class->subject_id = Input::post('subject_id');
			$class->user_id = Input::post('user_id');

			if ($class->save())
			{
				Session::set_flash('success', e('Updated class #' . $id));

				Response::redirect(parent::get_prefix() . 'class');
			}

			else
			{
				Session::set_flash('error', e('Could not update class #' . $id));
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

		$this->template->title = "Classes";
		$this->template->content = View::forge(parent::get_prefix() . 'class/edit', $data);

	}

	public function action_delete($id = null)
	{
		if ($class = Model_Class::find($id))
		{
			$class->delete();

			Session::set_flash('success', e('Deleted class #'.$id));
		}

		else
		{
			Session::set_flash('error', e('Could not delete class #'.$id));
		}

		Response::redirect(parent::get_prefix() . 'class');

	}

}
