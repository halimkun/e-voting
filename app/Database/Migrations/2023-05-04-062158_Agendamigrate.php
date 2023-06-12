<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Agendamigrate extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'auto_increment' => TRUE
			],
			'mulai' => [
				'type' => 'DATETIME'
			],
			'selesai' => [
				'type' => 'DATETIME'
			],
			'acara' => [
				'type' => 'VARCHAR',
				'constraint' => 255
			],
			'keterangan' => [
				'type' => 'TEXT',
				'null' => TRUE
			],
			'acara' => [
				'type' => 'VARCHAR',
				'constraint' => 255
			],
			'foto' => [
				'type' => 'VARCHAR',
				'constraint' => 255
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
		$this->forge->createTable('agenda', TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('agenda', TRUE);
	}
}
