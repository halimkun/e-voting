<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
	public function run()
	{
		$faker = \Faker\Factory::create('id_ID');
		$data = [
		  'id_admin' => $faker->uuid(),
		  'username' => 'admin',
		  'password' => password_hash('admin', PASSWORD_DEFAULT),
		  'nama' => 'ADMIN NI YEE',
		  'foto_profile' => 'admin.jpg'
		];
		$this->db->table('admin')->insert($data);
	}
}
