<?php

class Controller_Account extends Controller_Base
{
	public $template = 'template';

	public function before()
	{
		parent::before();

		if (Request::active()->controller !== 'Controller_Account' or ! in_array(Request::active()->action, array('login', 'logout',
			'register',)))
		{
			if (Auth::check())
			{
				$admin_group_id = Config::get('auth.driver', 'Simpleauth') == 'Ormauth' ? 6 : 100;
				$teacher_group_id = Config::get('auth.driver', 'Simpleauth') == 'Ormauth' ? 6 : 50;
				$student_group_id = Config::get('auth.driver', 'Simpleauth') == 'Ormauth' ? 6 : 1;

				if ( ! Auth::member($admin_group_id) && ! Auth::member($teacher_group_id)
					&& ! Auth::member($student_group_id))
				{
					Session::set_flash('error', e('You don\'t have access to the admin panel'));
					Response::redirect('/');
				}
			}
			else
			{
				Response::redirect('account/login');
			}
		}
	}

	public function action_login()
	{
		// Already logged in
		Auth::check() and Response::redirect('/');

		$val = Validation::forge();

		if (Input::method() == 'POST')
		{
			$val->add('email', 'Email or Username')
			    ->add_rule('required');
			$val->add('password', 'Password')
			    ->add_rule('required');

			if ($val->run())
			{
				$auth = Auth::instance();

				// check the credentials. This assumes that you have the previous table created
				if (Auth::check() or $auth->login(Input::post('email'), Input::post('password')))
				{
					// credentials ok, go right in
					if (Config::get('auth.driver', 'Simpleauth') == 'Ormauth')
					{
						$current_user = Model\Auth_User::find_by_username(Auth::get_screen_name());
					}
					else
					{
						$current_user = Model_User::find_by_username(Auth::get_screen_name());
					}
					Session::set_flash('success', e('Welcome, '.$current_user->username.'  to Seat Plan Management System'));
					Response::redirect('/');
				}
				else
				{
					$this->template->set_global('login_error', 'Fail');
				}
			}
		}

		$this->template->title = 'Login';
		$this->template->content = View::forge('login', array('val' => $val), false);
	}

	/**
	 * The logout action.
	 *
	 * @access  public
	 * @return  void
	 */
	public function action_logout()
	{
		Auth::logout();
		Response::redirect('account');
	}

	/**
	 * The index action.
	 *
	 * @access  public
	 * @return  void
	 */
	public function action_index()
	{
		$this->template->title = 'Dashboard';
		$data['studentclass'] = $this->getStudentClassName(Auth::get('id'));
		$this->template->content = View::forge(parent::get_prefix() . 'dashboard', $data);
	}

	private function getStudentClassName($user_id) {
		return Model_Class::find('all', array(
		    'related' => array(
		    	'classes' => array(
		    		'where' => array(
		    			array('user_id', '=', $user_id)
		    		)
		    	)
		    ),
		));
	}

	public function action_register() {
		if (Input::method() == 'POST')
		{
			$val = Model_User::validate('create');

			$_POST['bdate'] = Date::create_from_string(Input::post('bdate') , "us")->get_timestamp();

			if ($val->run())
			{
				$user = Model_User::forge(array(
					'fname' => Input::post('fname'),
					'mname' => Input::post('mname'),
					'lname' => Input::post('lname'),
					'email' => Input::post('email'),
					'username' => Input::post('username'),
					'password' => Auth::instance()->hash_password(Input::post('password')),
					'address' => Input::post('address'),
					'bdate' => Input::post('bdate'),
					'gender' => Input::post('gender'),
					'contact' => Input::post('contact'),
					'prof_pic' => Input::post('prof_pic') ?: 'ic_avatar.jpg',
					'group' => Input::post('group'),
					'last_login' => Input::post('last_login'),
					'login_hash' => Input::post('login_hash'),
					'profile_fields' => Input::post('profile_fields'),
					'course_id' => Input::post('course_id'),
					'yearlevel_id' => Input::post('yearlevel_id'),
					'idnum' => Input::post('idnum')
				));


			    Upload::process(Config::get('upload_prof_pic'));

			    if (Upload::is_valid()) {

                   	Upload::save();
                   	$value = Upload::get_files();

                   	foreach($value as $files) {
                        $user->prof_pic = $value[0]['saved_as'];
                    }

					if ($user and $user->save()) {
						Response::redirect('account/login');
					} else {
						Session::set_flash('error', e('Could not save user.'));
					}
				} else {
					Session::set_flash('error', e('Uploaded photo is invalid.'));
				}
			}
			else {
				Session::set_flash('error', $val->error());
			}

			if (Input::post('bdate')) {
				$_POST['bdate'] = Date::forge($_POST['bdate'])->format("%m/%d/%Y", true);
			}
		}

		$this->template->title = "Register";
		$this->template->content =  View::forge('register');
	}

}

