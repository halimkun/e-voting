<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AnggotaSeeder extends Seeder
{
	public function run()
	{
		$anggota = new \App\Models\AnggotaModel();
		$faker = \Faker\Factory::create('id_ID');
		$jabatan = [
			'Ketua',
			'Wakil Ketua',
			'Sekretaris',
			'Sekretaris 2',
			'Ketua Komisi',
			'Bendahara',
			'Bendahara 2',
			'Komisi A',
			'Komisi A 1',
			'Komisi B',
			'Komisi B 1',
			'Komisi C',
			'Komisi C 1',
		];

		for ($i=0; $i < count($jabatan); $i++) { 
			$anggota->insert([
				'nama' => $faker->name(),
				'jabatan' => $jabatan[$i],
			]);
		}
	}
}
