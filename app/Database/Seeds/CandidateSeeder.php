<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CandidateSeeder extends Seeder
{
  public function run()
  {
    $faker = \Faker\Factory::create('id_ID');
    $data = [
      'id_candidate' => $faker->uuid(),
      'no_urut' => '1',
      'ketua' => 'WILDAN SANTOSA',
      'wakil' => 'ANI KURNIA',
      'visi' => $faker->paragraph($faker->numberBetween(5, 10), true),
      'misi' => $faker->paragraph($faker->numberBetween(5, 10), true),
      'slogan' => $faker->sentence(),
      'periode' => '2023',
      'foto' => 'candidate1.jpg'
    ];
    $this->db->table('candidate')->insert($data);
    $data = [
      'id_candidate' => $faker->uuid(),
      'no_urut' => '2',
      'ketua' => 'KEVIN NIDAL IBRAHIM',
      'wakil' => 'ELVAN DWI SAPUTRA',
      'visi' => $faker->paragraph($faker->numberBetween(5, 10), true),
      'misi' => $faker->paragraph($faker->numberBetween(5, 10), true),
      'slogan' => $faker->sentence(),
      'periode' => '2023',
      'foto' => 'candidate2.jpg'
    ];
    $this->db->table('candidate')->insert($data);
    $data = [
      'id_candidate' => $faker->uuid(),
      'no_urut' => '3',
      'ketua' => 'ARIP ALKAFF',
      'wakil' => 'CINDY AYU LESTARI',
      'visi' => $faker->paragraph($faker->numberBetween(5, 10), true),
      'misi' => $faker->paragraph($faker->numberBetween(5, 10), true),
      'slogan' => $faker->sentence(),
      'periode' => '2023',
      'foto' => 'candidate3.jpg'
    ];
    $this->db->table('candidate')->insert($data);
  }
}
