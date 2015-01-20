<?php

class Controller_Base extends Controller_Template
{

	public function before()
	{
		parent::before();

		// Assign current_user to the instance so controllers can use it
		$this->current_user = Auth::check()
			? (Config::get('auth.driver', 'Simpleauth') == 'Ormauth' ? Model\Auth_User::find_by_username(Auth::get_screen_name()) : Model_User::find_by_username(Auth::get_screen_name()))
			: null;

		// Set a global variable so views can use it
		View::set_global('current_user', $this->current_user);
	}

	public function get_prefix()
	{
		if (Auth::member(100)) {
			return 'admin/';
		} else if (Auth::member(50)) {
			return 'teacher/';
		} else if (Auth::member(1)) {
			return 'student/';
		}
		
	}
}
