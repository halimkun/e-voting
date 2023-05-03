<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Hasil extends Migration
{
	public function up()
	{
	  $this->forge->addField([
	    'id_hasil' => [
	        'type' => 'INT',
	        'constraint' => 11,
	        'auto_increment' => true
	      ],
	    'id_candidate' => [
	        'type' => 'VARCHAR',
	        'constraint' => '150'
	      ],
	    'id_peserta' => [
	        'type' => 'VARCHAR',
	        'constraint' => '150'
	      ]
	  ]);
	  $this->forge->addKey('id_hasil', TRUE);
	  $this->forge->addForeignKey('id_candidate','candidate','id_candidate','CASCADE','CASCADE');
	  $this->forge->addForeignKey('id_peserta','peserta','id_peserta','CASCADE','CASCADE');
	  $this->forge->createTable('hasil', TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('hasil', true);
	}
}
