<?php

namespace Fuel\Migrations;

class Create_classes
{
	public function up()
	{
		\DBUtil::create_table('classes', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'class_name' => array('constraint' => 50, 'type' => 'varchar'),
			'chairs' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'subject_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'user_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('classes');
	}
}