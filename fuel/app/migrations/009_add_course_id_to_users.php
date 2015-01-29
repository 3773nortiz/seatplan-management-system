<?php

namespace Fuel\Migrations;

class Add_course_id_to_users
{
	public function up()
	{
		\DBUtil::add_fields('users', array(
			'course_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('users', array(
			'course_id'

		));
	}
}