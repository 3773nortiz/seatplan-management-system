<?php

namespace Fuel\Migrations;

class Add_description_to_subjects
{
	public function up()
	{
		\DBUtil::add_fields('subjects', array(
			'description' => array('constraint' => 255, 'type' => 'varchar'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('subjects', array(
			'description'

		));
	}
}