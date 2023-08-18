<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Candidate extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_candidate' => [
				'type' => 'VARCHAR',
				'constraint' => '150',
			],
			'no_urut' => [
				'type' => 'INT',
				'constraint' => '2',
			],
			'periode' => [
				'type' => 'YEAR',
				'constraint' => '4'
			],
			'ketua' => [
				'type' => 'VARCHAR',
				'constraint' => '255'
			],
			'wakil' => [
				'type' => 'VARCHAR',
				'constraint' => '255'
			],
			'visi' => [
				'type' => 'TEXT'
			],
			'misi' => [
				'type' => 'TEXT'
			],
			'slogan' => [
				'type' => 'TEXT'
			],
			'foto' => [
				'type' => 'VARCHAR',
				'constraint' => '255'
			]
		]);
		$this->forge->addKey('id_candidate', TRUE);
		$this->forge->createTable('candidate', TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('candidate', TRUE);
	}
}
