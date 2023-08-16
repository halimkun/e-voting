<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PesertaSeeder extends Seeder
{
	public function run()
	{
		$faker = \Faker\Factory::create('id_ID');
		$nisn_awal = 14507;
		for ($i = 0; $i < 50; $i++) {
		   $data = [
		     'id_peserta' => $faker->uuid(),
		     'username' => $nisn_awal++,
		     'password' => $faker->regexify('[A-Z]{6}[0-9]{5}'),
		     'nama' => $faker->name(),
		     'kelas' => $faker->randomElement(['X','XI','XII']),
		     'jurusan' => $faker->randomElement(['RPL','TKJ','MM', 'AKL']),
			 'tahun_ajaran' => $faker->randomElement(['2021','2022','2023']),
		     'status_pilihan' => '0'
		   ];
		   $this->db->table('peserta')->insert($data);
		}
	}
}
