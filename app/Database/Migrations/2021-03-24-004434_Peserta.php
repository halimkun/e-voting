<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Peserta extends Migration
{
	public function up()
	{
		$this->forge->addField([
		   'id_peserta' => [
		       'type' => 'VARCHAR',
		       'constraint' => '150'
		     ],
		   'username' => [
		       'type' => 'INT',
		       'constraint' => '11',
		       'unique' => true,
		       'null' => false
		     ],
		   'password' => [
		       'type' => 'VARCHAR',
		       'constraint' => '255',
		       'null' => false
		     ],
		   'nama' => [
		       'type' => 'VARCHAR',
		       'constraint' => '255'
		     ],
		   'kelas' => [
		       'type' => 'VARCHAR',
		       'constraint' => '50',
		     ],
		   'jurusan' => [
		       'type' => 'VARCHAR',
		       'constraint' => '100'
		     ],
		   'status_pilihan' => [
		       'type' => 'ENUM',
		       'constraint' => ['1','0'],
		       'default' => '0'
		     ],
		   'waktu_pilih' => [
		       'type' => 'DATETIME',
		       'null' => TRUE
		     ]
		  ]);
		$this->forge->addKey('id_peserta', TRUE);
		$this->forge->createTable('peserta', TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('peserta', TRUE);
	}
}
