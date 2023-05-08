<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Anggotamigrate extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'auto_increment' => TRUE
			],
			'nama' => [
				'type' => 'VARCHAR',
				'constraint' => 255
			],
			'jabatan' => [
				'type' => 'VARCHAR',
				'constraint' => 255
			],
			'foto' => [
				'type' => 'VARCHAR',
				'constraint' => 255,
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
		$this->forge->createTable('anggota', TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('anggota', TRUE);
	}
}
