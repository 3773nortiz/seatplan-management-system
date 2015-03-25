<?php
class Model_Attendance extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'status',
		'studentclass_id',
		'reason',
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
	    'studentclass' => array(
	        'key_from' => 'studentclass_id',
	        'model_to' => 'Model_Studentclass',
	        'key_to' => 'id',
	        'cascade_save' => true,
	        'cascade_delete' => false,
	    )
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('status', 'Status', 'required|valid_string[numeric]');
		$val->add_field('studentclass_id', 'Studentclass Id', 'required|valid_string[numeric]');

		return $val;
	}

}
