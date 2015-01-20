<?php
class Controller_Admin_Studentclass extends Controller_Admin
{

	public function action_index()
	{
		$data['studentclasses'] = Model_Studentclass::find('all');
		$this->template->title = "Studentclasses";
		$this->template->content = View::forge('admin/studentclass/index', $data);

	}

	public function action_view($id = null)
	{
		$data['studentclass'] = Model_Studentclass::find($id);

		$this->template->title = "Studentclass";
		$this->template->content = View::forge('admin/studentclass/view', $data);

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

					Response::redirect('admin/studentclass');
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
		$this->template->content = View::forge('admin/studentclass/create');

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

				Response::redirect('admin/studentclass');
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
		$this->template->content = View::forge('admin/studentclass/edit');

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

		Response::redirect('admin/studentclass');

	}

}
