<?php
class Controller_Admin_Subject extends Controller_Admin
{

	public function action_index()
	{
		$data['subjects'] = Model_Subject::find('all');
		$this->template->title = "Subjects";
		$this->template->content = View::forge(parent::get_prefix() . 'subject/index', $data);

	}

	public function action_view($id = null)
	{
		$data['subject'] = Model_Subject::find($id);

		$this->template->title = "Subject";
		$this->template->content = View::forge(parent::get_prefix() . 'subject/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Subject::validate('create');

			if ($val->run())
			{
				$subject = Model_Subject::forge(array(
					'subject_name' => Input::post('subject_name'),
				));

				if ($subject and $subject->save())
				{
					Session::set_flash('success', e('Added subject #'.$subject->id.'.'));

					Response::redirect(parent::get_prefix() . 'subject');
				}

				else
				{
					Session::set_flash('error', e('Could not save subject.'));
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Subjects";
		$this->template->content = View::forge(parent::get_prefix() . 'subject/create');

	}

	public function action_edit($id = null)
	{
		$subject = Model_Subject::find($id);
		$val = Model_Subject::validate('edit');

		if ($val->run())
		{
			$subject->subject_name = Input::post('subject_name');

			if ($subject->save())
			{
				Session::set_flash('success', e('Updated subject #' . $id));

				Response::redirect(parent::get_prefix() . 'subject');
			}

			else
			{
				Session::set_flash('error', e('Could not update subject #' . $id));
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$subject->subject_name = $val->validated('subject_name');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('subject', $subject, false);
		}

		$this->template->title = "Subjects";
		$this->template->content = View::forge(parent::get_prefix() . 'subject/edit');

	}

	public function action_delete($id = null)
	{
		if ($subject = Model_Subject::find($id))
		{
			$subject->delete();

			Session::set_flash('success', e('Deleted subject #'.$id));
		}

		else
		{
			Session::set_flash('error', e('Could not delete subject #'.$id));
		}

		Response::redirect(parent::get_prefix() . 'subject');

	}

}
