<?php

namespace Fuel\Migrations;

class Create_attendances
{
	public function up()
	{
		\DBUtil::create_table('attendances', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'status' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'studentclass_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('attendances');
	}
}