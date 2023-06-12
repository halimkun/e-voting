<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SettingsSeeder extends Seeder
{
	public function run()
	{
		$data = [
			[
				'class'		=> 'Config\App',
				'key'		=> 'nama_sekolah',
				'value'		=> 'SMA NEGERI 1 KESESI',
				'type'		=> 'string',
				'context'	=> null
			],
			[
				'class'		=> 'Config\App',
				'key'		=> 'alamat_sekolah',
				'value'		=> 'Jl. Raya Kaibahan, Klairan, Kaibahan, Kec. Kesesi, Kabupaten Pekalongan, Jawa Tengah 51162',
				'type'		=> 'string',
				'context'	=> null
			],
			[
				'class'		=> 'Config\App',
				'key'		=> 'email_sekolah',
				'value'		=> 'admin@smankesesi.sch.id',
				'type'		=> 'string',
				'context'	=> null
			],
			[
				'class'		=> 'Config\App',
				'key'		=> 'logo_sekolah',
				'value'		=> 'logo.png',
				'type'		=> 'string',
				'context'	=> null
			],
			[
				'class'		=> 'Config\App',
				'key'		=> 'about_title',
				'value'		=> 'Organisasi Siswa Intra Sekolah',
				'type'		=> 'string',
				'context'	=> null
			],
			[
				'class'		=> 'Config\App',
				'key'		=> 'about_sekolah',
				'value'		=> '&lt;b&gt;Organisasi Siswa Intra Sekolah (OSIS) &lt;/b&gt;adalah organisasi yang berada di lingkungan sekolah yang berfungsi sebagai wadah pengembangan diri bagi siswa. OSIS merupakan organisasi yang beranggotakan siswa-siswi yang dipilih melalui pemilihan umum yang dilakukan oleh seluruh siswa-siswi sekolah. OSIS merupakan organisasi yang berfungsi sebagai wadah pengembangan diri bagi siswa. OSIS merupakan organisasi yang beranggotakan siswa-siswi yang dipilih melalui pemilihan umum yang dilakukan oleh seluruh siswa-siswi sekolah.',
				'type'		=> 'string',
				'context'	=> null
			],
			[
				'class'		=> 'Config\App',
				'key'		=> 'status_acara',
				'value'		=> 0,
				'type'		=> 'integer',
				'context'	=> null
			],
		];
		$db = \Config\Database::connect();
		$db->table('settings')->insertBatch($data);
		$db->close();
	}
}
