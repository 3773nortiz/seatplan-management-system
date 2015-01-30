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


	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('user_id', 'User Id', 'required|valid_string[numeric]');
		$val->add_field('class_id', 'Class Id', 'required|valid_string[numeric]');
		$val->add_field('seat', 'Seat', 'required|max_length[10]');

		return $val;
	}

}
