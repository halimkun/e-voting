<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Webfilemigrate extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'auto_increment' => TRUE
			],
			'user_id' => [
				'type' => 'VARCHAR',
				'constraint' => 255
			],
			'judul' => [
				'type' => 'VARCHAR',
				'constraint' => 255
			],
			'file' => [
				'type' => 'VARCHAR',
				'constraint' => 255
			],
			'keterangan' => [
				'type' => 'TEXT',
				'null' => TRUE
			],
			'created_at' => [
				'type' => 'DATETIME',
				'null' => TRUE
			],
			'updated_at' => [
				'type' => 'DATETIME',
				'null' => TRUE
			],
			'deleted_at' => [
				'type' => 'DATETIME',
				'null' => TRUE
			]
		]);

		$this->forge->addKey('id', TRUE);	
		$this->forge->createTable('webfiles', TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('webfiles', TRUE);
	}
}
