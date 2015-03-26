<?php
class Model_Studentclass extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'user_id',
		'class_id',
		'seat',
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

	protected static $_has_one = array(
	    'class' => array(
	        'key_from' => 'class_id',
	        'model_to' => 'Model_Class',
	        'key_to' => 'id',
	        'cascade_save' => true,
	        'cascade_delete' => false,
	    ),
	    'student' => array(
	    	'key_from' => 'user_id',
	        'model_to' => 'Model_User',
	        'key_to' => 'id',
	        'cascade_save' => true,
	        'cascade_delete' => false,
	    )
	);


	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('user_id', 'User Id', 'required|valid_string[numeric]');
		$val->add_field('class_id', 'Class Id', 'required|valid_string[numeric]');
		$val->add_field('seat', 'Seat', 'required|max_length[10]');

		return $val;
	}

}
