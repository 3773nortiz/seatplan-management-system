<?php
class Controller_Admin_Yearlevel extends Controller_Admin{

	public function action_index()
	{
		$data['yearlevels'] = Model_Yearlevel::find('all');
		$this->template->title = "Yearlevels";
		$this->template->content = View::forge(parent::get_prefix() . '\yearlevel/index', $data);

	}

	public function action_view($id = null)
	{
		$data['yearlevel'] = Model_Yearlevel::find($id);

		$this->template->title = "Yearlevel";
		$this->template->content = View::forge(parent::get_prefix() . 'yearlevel/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Yearlevel::validate('create');

			if ($val->run())
			{
				$yearlevel = Model_Yearlevel::forge(array(
					'level' => Input::post('level'),
				));

				if ($yearlevel and $yearlevel->save())
				{
					Session::set_flash('success', e('Added yearlevel #'.$yearlevel->id.'.'));

					Response::redirect(parent::get_prefix() . 'yearlevel');
				}

				else
				{
					Session::set_flash('error', e('Could not save yearlevel.'));
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Yearlevels";
		$this->template->content = View::forge(parent::get_prefix() . 'yearlevel/create');

	}

	public function action_edit($id = null)
	{
		$yearlevel = Model_Yearlevel::find($id);
		$val = Model_Yearlevel::validate('edit');

		if ($val->run())
		{
			$yearlevel->level = Input::post('level');

			if ($yearlevel->save())
			{
				Session::set_flash('success', e('Updated yearlevel #' . $id));

				Response::redirect(parent::get_prefix() . 'yearlevel');
			}

			else
			{
				Session::set_flash('error', e('Could not update yearlevel #' . $id));
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$yearlevel->level = $val->validated('level');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('yearlevel', $yearlevel, false);
		}

		$this->template->title = "Yearlevels";
		$this->template->content = View::forge(parent::get_prefix() . 'yearlevel/edit');

	}

	public function action_delete($id = null)
	{
		if ($yearlevel = Model_Yearlevel::find($id))
		{
			$yearlevel->delete();

			Session::set_flash('success', e('Deleted yearlevel #'.$id));
		}

		else
		{
			Session::set_flash('error', e('Could not delete yearlevel #'.$id));
		}

		Response::redirect(parent::get_prefix() . 'yearlevel');

	}


}