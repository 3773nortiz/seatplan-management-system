<?php

namespace Fuel\Migrations;

class Add_idnum_to_users
{
	public function up()
	{
		\DBUtil::add_fields('users', array(
			'idnum' => array('constraint' => 255, 'type' => 'varchar'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('users', array(
			'idnum'

		));
	}
}