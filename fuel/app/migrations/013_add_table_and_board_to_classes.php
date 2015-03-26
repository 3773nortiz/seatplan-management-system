<?php

namespace Fuel\Migrations;

class Add_table_and_board_to_classes
{
	public function up()
	{
		\DBUtil::add_fields('classes', array(
			'table_position' => array('constraint' => 1, 'type' => 'int', 'unsigned' => true),
			'board_position' => array('constraint' => 1, 'type' => 'int', 'unsigned' => true)
		));
	}

	public function down()
	{
		\DBUtil::drop_fields('classes', array(
			'table_position',
			'board_position'

		));
	}
}