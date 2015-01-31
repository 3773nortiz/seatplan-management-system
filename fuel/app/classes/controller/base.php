<?php

class Controller_Base extends Controller_Template
{

	public function before()
	{
		parent::before();

		// Assign current_user to the instance so controllers can use it
		$this->current_user = Auth::check()
			? (Config::get('auth.driver', 'Simpleauth') == 'Ormauth' 
				? Model\Auth_User::find_by_username(Auth::get_screen_name()) 
				: Model_User::find_by_username(Auth::get_screen_name()))
			: null;

		// Set a global variable so views can use it
		View::set_global('current_user', $this->current_user);
	}

	public static function get_prefix()
	{
		if (Auth::member(100)) {
			return 'admin/';
		} else if (Auth::member(50)) {
			return 'teacher/';
		} else if (Auth::member(1)) {
			return 'student/';
		}
		
	}

	public static function is_black_listed($file) {
		if(Auth::member(100)){
			if ($file == "studentclass" || $file == "attendance" || $file == "class" ||
				$file == "users"){
				return true;
			}

		} else if (Auth::member(50)) {
			if ($file == "studentclass" || $file == "attendance"){
				return true;
			}

		} elseif (Auth::member(1)) {
			if($file == "users") {
				return true;
			}
		}

		return false;
	}
	
	public static function getBaseName($base_name) {
		if(Auth::member(100)){

		} else if (Auth::member(50)) {
			if($base_name == "users") {
				return "student";
			}
		} elseif (Auth::member(1)) {
		}

	}
}
