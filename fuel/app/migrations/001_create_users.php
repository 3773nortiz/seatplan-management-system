<?php

namespace Fuel\Migrations;

class Create_users
{
	public function up()
	{
		\DBUtil::create_table('users', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'fname' => array('constraint' => 50, 'type' => 'varchar'),
			'mname' => array('constraint' => 50, 'type' => 'varchar'),
			'lname' => array('constraint' => 50, 'type' => 'varchar'),
			'email' => array('constraint' => 255, 'type' => 'varchar'),
			'username' => array('constraint' => 50, 'type' => 'varchar'),
			'password' => array('constraint' => 255, 'type' => 'varchar'),
			'address' => array('constraint' => 255, 'type' => 'varchar'),
			'bdate' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'gender' => array('constraint' => 1, 'type' => 'int', 'unsigned' => true),
			'contact' => array('constraint' => 50, 'type' => 'varchar'),
			'prof_pic' => array('constraint' => 255, 'type' => 'varchar'),
			'group' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'last_login' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'login_hash' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'profile_fields' => array('type' => 'text', 'null' => true, 'null' => true),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('users');
	}
}