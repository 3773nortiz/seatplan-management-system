<?php

namespace Fuel\Migrations;

class Add_schedule_to_classes
{
	public function up()
	{
		\DBUtil::add_fields('classes', array(
			'schedule' => array('constraint' => 7, 'type' => 'varchar'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('classes', array(
			'schedule'

		));
	}
}