<?php
class Model_Subject extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'subject_name',
		'created_at',
		'updated_at',
		'description',
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
		$val->add_field('subject_name', 'Subject Name', 'required|max_length[50]');
		$val->add_field('description', 'Description', 'required|max_length[255]');
		return $val;
	}

}
