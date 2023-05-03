<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Admin extends Migration
{
	public function up()
	{
		$this->forge->addField([
		  'id_admin' => [
		      'type' => 'VARCHAR',
		      'constraint' => '150',
		    ],
		  'username' => [
		      'type' => 'VARCHAR',
		      'constraint' => '150',
		      'unique' => true
		    ],
		  'password' => [
		      'type' => 'VARCHAR',
		      'constraint' => '255'
		    ],
		  'nama' => [
		      'type' => 'VARCHAR',
		      'constraint' => '255'
		    ],
		  'foto_profile' => [
		      'type' => 'VARCHAR',
		      'constraint' => '255'
		    ]
		]);
		$this->forge->addKey('id_admin', true);
		$this->forge->createTable('admin', true);
	}

	public function down()
	{
		$this->forge->dropTable('admin', true);
	}
}
