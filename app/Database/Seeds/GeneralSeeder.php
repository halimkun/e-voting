<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GeneralSeeder extends Seeder
{
	public function run()
	{
		$data = [
		  'id_sekolah' => 1,
		  'nama_sekolah' => 'SMK N 9 NUSA INDAH',
		  'logo_sekolah' => 'logo_sekolah.png',
		  'email_sekolah' => 'smkn9nusaindah@gamil.com',
		  'alamat_sekolah' => 'Jl. Abc no 321',
		  'foto_sekolah' => 'foto_sekolah.jpg',
		  'status_acara' => '0'
		];
		$this->db->table('general')->insert($data);
	}
}
