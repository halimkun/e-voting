<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RunningSeeder extends Seeder
{
	public function run()
	{
		$this->call('AdminSeeder');
		$this->call('CandidateSeeder');
		$this->call('GeneralSeeder');
		$this->call('PesertaSeeder');
		$this->call('SettingsSeeder');
	}
}
