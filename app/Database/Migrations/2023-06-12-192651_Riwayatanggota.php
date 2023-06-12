<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Riwayatanggota extends Migration
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
				'constraint' => 255,
			],
			'jabatan' => [
				'type' => 'VARCHAR',
				'constraint' => 255,
			],
			'tahun' => [
				'type' => 'VARCHAR',
				'constraint' => 255,
			],
			'keterangan' => [
				'type' => 'VARCHAR',
				'constraint' => 255,
			],
			'created_at' => [
				'type' => 'DATETIME',
			],
			'updated_at' => [
				'type' => 'DATETIME',
			],
			'deleted_at' => [
				'type' => 'DATETIME',
			],
		]);

		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('riwayat_anggota', TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('riwayat_anggota', TRUE);
	}
}
