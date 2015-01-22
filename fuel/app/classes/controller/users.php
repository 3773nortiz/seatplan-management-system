<?php
class Controller_Users extends Controller_Account
{

	public function action_index()
	{
		$data['users'] = Model_User::find('all');
		$this->template->title = "Users";
		$this->template->content = View::forge(parent::get_prefix() . 'users/index', $data);

	}

	public function action_view($id = null)
	{
		$data['user'] = Model_User::find($id);

		$this->template->title = "User";
		$this->template->content = View::forge(parent::get_prefix() . 'users/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_User::validate('create');

			if ($val->run())
			{
				$user = Model_User::forge(array(
					'fname' => Input::post('fname'),
					'mname' => Input::post('mname'),
					'lname' => Input::post('lname'),
					'email' => Input::post('email'),
					'username' => Input::post('username'),
					'password' => Input::post('password'),
					'address' => Input::post('address'),
					'bdate' => Input::post('bdate'),
					'gender' => Input::post('gender'),
					'contact' => Input::post('contact'),
					'prof_pic' => Input::post('prof_pic'),
					'group' => Input::post('group'),
					'last_login' => Input::post('last_login'),
					'login_hash' => Input::post('login_hash'),
					'profile_fields' => Input::post('profile_fields'),
				));

				
			    Upload::process(Config::get('upload_prof_pic'));

			    if (Upload::is_valid()) {
                                                                        
                   	Upload::save();

                   	$value = Upload::get_files();

                   	foreach($value as $files) {
                        $user->prof_pic = $value[0]['saved_as'];
                    }


					if ($user and $user->save())
					{
						// Session::set_flash('success', e('Added user #'.$user->id.'.'));
						// Response::redirect(parent::get_prefix() . 'users');
					}

					else
					{
						Session::set_flash('error', e('Could not save user.'));
					}
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}


		$this->template->title = "Users";
		$this->template->content = View::forge(parent::get_prefix() . 'users/create');

	}

	public function action_edit($id = null)
	{
		$user = Model_User::find($id);
		$val = Model_User::validate('edit');

		if ($val->run())
		{
			$user->fname = Input::post('fname');
			$user->mname = Input::post('mname');
			$user->lname = Input::post('lname');
			$user->email = Input::post('email');
			$user->username = Input::post('username');
			$user->password = Input::post('password');
			$user->address = Input::post('address');
			$user->bdate = Input::post('bdate');
			$user->gender = Input::post('gender');
			$user->contact = Input::post('contact');
			// $user->prof_pic = Input::post('prof_pic');
			$user->group = Input::post('group');
			$user->last_login = Input::post('last_login');
			$user->login_hash = Input::post('login_hash');
			$user->profile_fields = Input::post('profile_fields');

			if ($user->save())
			{
				Session::set_flash('success', e('Succesfully Updated' . $id));

				Response::redirect(parent::get_prefix() . 'users/edit');
			}

			else
			{
				Session::set_flash('error', e('Could not update user #' . $id));
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$user->fname = $val->validated('fname');
				$user->mname = $val->validated('mname');
				$user->lname = $val->validated('lname');
				$user->email = $val->validated('email');
				$user->username = $val->validated('username');
				$user->password = $val->validated('password');
				$user->address = $val->validated('address');
				$user->bdate = $val->validated('bdate');
				$user->gender = $val->validated('gender');
				$user->contact = $val->validated('contact');
				$user->prof_pic = $val->validated('prof_pic');
				$user->group = $val->validated('group');
				$user->last_login = $val->validated('last_login');
				$user->login_hash = $val->validated('login_hash');
				$user->profile_fields = $val->validated('profile_fields');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('user', $user, false);
		}

		$this->template->title = "Edit Profile";
		$this->template->content = View::forge('edit_profile');

	}

	public function action_delete($id = null)
	{
		if ($user = Model_User::find($id))
		{
			$user->delete();

			Session::set_flash('success', e('Deleted user #'.$id));
		}

		else
		{
			Session::set_flash('error', e('Could not delete user #'.$id));
		}

		Response::redirect(parent::get_prefix() . 'users');

	}


}
