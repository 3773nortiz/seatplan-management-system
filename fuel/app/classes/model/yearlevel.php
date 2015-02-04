<?php
class Model_Yearlevel extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'level',
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
		$val->add_field('level', 'Level', 'required|max_length[50]');

		return $val;
	}

	public static function getYearLevel(){
		$yearlevel = static::find('all');
		return $yearlevel;
	}

	public static function getStudentYearLevel($id) {

		$levelname = Model_Yearlevel::find('first', array(
			'where' => array(
				array('id', $id)
			)
		));

		return $levelname ? $levelname->level : null;
	}

}
