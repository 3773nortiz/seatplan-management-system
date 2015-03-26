<?php

namespace Fuel\Migrations;

class Add_reason_to_attendances
{
	public function up()
	{
		\DBUtil::add_fields('attendances', array(
			'reason' => array('type' => 'text'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('attendances', array(
			'reason'

		));
	}
}