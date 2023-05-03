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
      'ketua' => 'BUDI BUDIMAN',
      'wakil' => 'AGUS SANTOSO',
      'visi' => '<p>Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.</p><p>Lorem ipsum dolor sit amet.</p><p>Lorem ipsum dolor sit amet. Lorem ipsum dolor.</p><p>Lorem ipsum dolor sit amet janaba.</p><p>Lorem ipsum dolor sit amet jababjaibabahababa.</p>',
      'misi' => '<p>Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.</p><p>Lorem ipsum dolor sit amet.</p><p>Lorem ipsum dolor sit amet. Lorem ipsum dolor.</p><p>Lorem ipsum dolor sit amet janaba.</p><p>Lorem ipsum dolor sit amet jababjaibabahababa.</p>',
      'slogan' => $faker->sentence(),
      'foto' => 'candidate1.jpg'
    ];
  	$this->db->table('candidate')->insert($data);
    $data = [
      'id_candidate' => $faker->uuid(),
      'no_urut' => '2',
      'ketua' => 'SUSI SUSANTY',
      'wakil' => 'BURHAN',
      'visi' => '<p>Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.</p><p>Lorem ipsum dolor sit amet.</p><p>Lorem ipsum dolor sit amet. Lorem ipsum dolor.</p><p>Lorem ipsum dolor sit amet janaba.</p><p>Lorem ipsum dolor sit amet jababjaibabahababa.</p>',
      'misi' => '<p>Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.</p><p>Lorem ipsum dolor sit amet.</p><p>Lorem ipsum dolor sit amet. Lorem ipsum dolor.</p><p>Lorem ipsum dolor sit amet janaba.</p><p>Lorem ipsum dolor sit amet jababjaibabahababa.</p>',
      'slogan' => $faker->sentence(),
      'foto' => 'candidate2.jpg'
    ];
  	$this->db->table('candidate')->insert($data);
    $data = [
      'id_candidate' => $faker->uuid(),
      'no_urut' => '3',
      'ketua' => 'DEWI PUTRI',
      'wakil' => 'AJENG NUR',
      'visi' => '<p>Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.</p><p>Lorem ipsum dolor sit amet.</p><p>Lorem ipsum dolor sit amet. Lorem ipsum dolor.</p><p>Lorem ipsum dolor sit amet janaba.</p><p>Lorem ipsum dolor sit amet jababjaibabahababa.</p>',
      'misi' => '<p>Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.</p><p>Lorem ipsum dolor sit amet.</p><p>Lorem ipsum dolor sit amet. Lorem ipsum dolor.</p><p>Lorem ipsum dolor sit amet janaba.</p><p>Lorem ipsum dolor sit amet jababjaibabahababa.</p>',
      'slogan' => $faker->sentence(),
      'foto' => 'candidate3.jpg'
    ];
  	$this->db->table('candidate')->insert($data);
	}
}
