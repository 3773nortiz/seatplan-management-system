<?php
class Controller_Admin_Course extends Controller_Admin{

	public function action_index()
	{
		$data['courses'] = Model_Course::find('all', array(
			'where'	=> array(array('id', '!=', '0'))
		));
		$this->template->title = "Courses";
		$this->template->content = View::forge('admin/course/index', $data);

	}

	public function action_view($id = null)
	{
		$data['course'] = Model_Course::find($id);

		$this->template->title = "Course";
		$this->template->content = View::forge(parent::get_prefix() . 'course/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Course::validate('create');

			if ($val->run())
			{
				$course = Model_Course::forge(array(
					'coursename' => Input::post('coursename'),
				));

				if ($course and $course->save())
				{
					Session::set_flash('success', e('Added course #'.$course->id.'.'));

					Response::redirect('admin/course');
				}

				else
				{
					Session::set_flash('error', e('Could not save course.'));
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Courses";
		$this->template->content = View::forge(parent::get_prefix() . 'course/create');

	}

	public function action_edit($id = null)
	{
		$course = Model_Course::find($id);
		$val = Model_Course::validate('edit');

		if ($val->run())
		{
			$course->coursename = Input::post('coursename');

			if ($course->save())
			{
				Session::set_flash('success', e('Updated course #' . $id));

				Response::redirect('admin/course');
			}

			else
			{
				Session::set_flash('error', e('Could not update course #' . $id));
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$course->coursename = $val->validated('coursename');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('course', $course, false);
		}

		$this->template->title = "Courses";
		$this->template->content = View::forge(parent::get_prefix() . 'course/edit');

	}

	public function action_delete($id = null)
	{
		if ($course = Model_Course::find($id))
		{
			$course->delete();

			Session::set_flash('success', e('Deleted course #'.$id));
		}

		else
		{
			Session::set_flash('error', e('Could not delete course #'.$id));
		}

		Response::redirect('admin/course');

	}


}