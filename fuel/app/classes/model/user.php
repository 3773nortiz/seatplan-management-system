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
		'course_id',
		'yearlevel_id'
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
    	),
	);

	protected static $_many_many = array(
	    'studentlists' => array(
	        'key_from' => 'id',
	        'key_through_from' => 'user_id', // column 1 from the table in between, should match a posts.id
	        'table_through' => 'studentclasses', // both models plural without prefix in alphabetical order
	        'key_through_to' => 'class_id', // column 2 from the table in between, should match a users.id
	        'model_to' => 'Model_Class',
	        'key_to' => 'id',
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
		$val->add_field('group', 'Group', 'valid_string[numeric]');
		$val->add_field('last_login', 'Last Login', 'valid_string[numeric]');
		$val->add_field('course_id', 'Course', 'required|valid_string[numeric]');
		$val->add_field('yearlevel_id', 'Course', 'required|valid_string[numeric]');
		return $val;
	}

}
