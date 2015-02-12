<?php
class Model_Class extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'class_name',
		'chairs',
		'subject_id',
		'user_id',
		'chair_plan',
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
		$val->add_field('class_name', 'Class Name', 'required|max_length[50]');
		$val->add_field('chairs', 'Chairs', 'required|valid_string[numeric]|numeric_between[0, 99]');
		$val->add_field('subject_id', 'Subject Id', 'required|valid_string[numeric]');
		$val->add_field('user_id', 'User Id', 'required|valid_string[numeric]');

		return $val;
	}

	public function getSubjectName() {

		$subjects = Model_Subject::find('first', array(
			'where' => array(
				array('id', $this->subject_id)
			)
		));

		return '';
	}

	public static function getClassName() {
		$class = static::find('all');
		return $class;
	}

}
