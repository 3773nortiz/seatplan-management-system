<?php

namespace Fuel\Migrations;

class Create_studentclasses
{
	public function up()
	{
		\DBUtil::create_table('studentclasses', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'user_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'class_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'seat' => array('constraint' => 10, 'type' => 'varchar'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('studentclasses');
	}
}