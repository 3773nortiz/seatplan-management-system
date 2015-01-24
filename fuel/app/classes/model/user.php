<?php
class Model_User extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'fname',
		'mname',
		'lname',
		'email',
		'username',
		'password',
		'address',
		'bdate',
		'gender',
		'contact',
		'prof_pic',
		'group',
		'last_login',
		'login_hash',
		'profile_fields',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
	);

	protected static $_has_many = array(
	  	'studentclass' => array(
	        'key_from' => 'id',
	        'model_to' => 'Model_Studentclass',
	        'key_to' => 'user_id',
	        'cascade_save' => true,
	        'cascade_delete' => false,
    	)
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('fname', 'Fname', 'required|max_length[50]');
		$val->add_field('mname', 'Mname', 'required|max_length[50]');
		$val->add_field('lname', 'Lname', 'required|max_length[50]');
		$val->add_field('email', 'Email', 'required|valid_email|max_length[255]');
		$val->add_field('username', 'Username', 'required|max_length[50]');
		$val->add_field('password', 'Password', 'required|max_length[255]');
		$val->add_field('address', 'Address', 'required|max_length[255]');
		$val->add_field('bdate', 'Bdate', 'required|valid_string[numeric]');
		$val->add_field('gender', 'Gender', 'required|valid_string[numeric]');
		$val->add_field('contact', 'Contact', 'required|max_length[50]');
		$val->add_field('prof_pic', 'Prof Pic', 'max_length[255]');
		$val->add_field('group', 'Group', 'required|valid_string[numeric]');
		$val->add_field('last_login', 'Last Login', 'valid_string[numeric]');

		return $val;
	}

}
