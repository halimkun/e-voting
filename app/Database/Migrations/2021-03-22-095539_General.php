<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class General extends Migration
{
	public function up()
	{
		 $this->forge->addField([
		   'id_sekolah' => [
		       'type' => 'INT',
		       'constraint' => '11'
		     ],
		   'nama_sekolah' => [
		       'type' => 'VARCHAR',
		       'constraint' => '255'
		     ],
		   'logo_sekolah' => [
		       'type' => 'VARCHAR',
		       'constraint' => '255'
		     ],
		   'email_sekolah' => [
		       'type' => 'VARCHAR',
		       'constraint' => '255'
		     ],
		   'alamat_sekolah' => [
		       'type' => 'VARCHAR',
		       'constraint' => '255'
		     ],
		   'foto_sekolah' => [
		       'type' => 'VARCHAR',
		       'constraint' => '255'
		     ],
		   'status_acara' => [
		       'type' => 'ENUM',
		       'constraint' => ['2','1','0']
		     ]
		 ]);
		 $this->forge->addKey('id_sekolah', true);
		 $this->forge->createTable('general', TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('general', true);
	}
}
