<?php

namespace Fuel\Migrations;

class Add_chair_plan_to_classes
{
	public function up()
	{
		\DBUtil::add_fields('classes', array(
			'chair_plan' => array('type' => 'text'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('classes', array(
			'chair_plan'

		));
	}
}