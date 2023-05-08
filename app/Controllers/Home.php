<?php

namespace App\Controllers;
use App\Models\CobaModel;
class Home extends BaseController
{
	protected $anggota;
	protected $webFile;
	protected $colCondition;

	public function __construct() {
		$this->anggota = new \App\Models\AnggotaModel();
		$this->webFile = new \App\Models\WebfileModel();
		$this->colCondition = [
			'Sekretaris',
			'Sekretaris 2',
			'Bendahara',
			'Bendahara 2',
			'Komisi A',
			'Komisi A 1',
			'Komisi B',
			'Komisi B 1',
			'Komisi C',
			'Komisi C 1'
		];
	}

	public function index()
	{
		return view('home');
	}

	public function about()
	{
		return view('about');
	}

	public function download()
	{
		return view('downloads', [
			'webFile' => $this->webFile->findAll()
		]);
	}

	public function anggota()
	{
		$anggota = $this->removeEmptName($this->anggota->findAll());		
		$anggota = array_map(
			function ($anggota) {
				$temp = [
					'key' => $anggota['jabatan'],
					'name' => $anggota['nama'],
					'jabatan' => $anggota['jabatan'],
				];

				if (strtolower($anggota['jabatan']) !== 'ketua') {
					if (strtolower($anggota['jabatan']) === 'wakil ketua') {
						$temp['parent'] = $this->anggota->where('jabatan', 'ketua')->first()['jabatan'];
					} elseif (str_contains(strtolower($anggota['jabatan']), 'sekretaris')) {
						$sk = explode(' ', strtolower($anggota['jabatan']));
						if (count($sk) === 1) {
							$temp['parent'] = $this->anggota->where('jabatan', 'wakil ketua')->first()['jabatan'];
						} else {
							$temp['parent'] = $this->anggota->where('jabatan', 'sekretaris')->first()['jabatan'];
						}
					} elseif (str_contains(strtolower($anggota['jabatan']), 'bendahara')) {
						$sk = explode(' ', strtolower($anggota['jabatan']));
						if (count($sk) === 1) {
							$temp['parent'] = $this->anggota->where('jabatan', 'wakil ketua')->first()['jabatan'];
						} else {
							$temp['parent'] = $this->anggota->where('jabatan', 'bendahara')->first()['jabatan'];
						}
					} elseif (strtolower($anggota['jabatan']) === 'ketua komisi') {
						$temp['parent'] = $this->anggota->where('jabatan', 'wakil ketua')->first()['jabatan'];
					} elseif (in_array(strtolower($anggota['jabatan']), ['komisi a', 'komisi b', 'komisi c'])) {
						$temp['parent'] = $this->anggota->where('jabatan', 'ketua komisi')->first()['jabatan'];
					} elseif (in_array(strtolower($anggota['jabatan']), ['komisi a 1', 'komisi b 1', 'komisi c 1'])) {
						if (strtolower($anggota['jabatan']) == 'komisi a 1') {
							$temp['parent'] = $this->anggota->where('jabatan', 'komisi a')->first()['jabatan'];
							$temp['jabatan'] = 'Komisi A';
						} elseif (strtolower($anggota['jabatan']) == 'komisi b 1') {
							$temp['parent'] = $this->anggota->where('jabatan', 'komisi b')->first()['jabatan'];
							$temp['jabatan'] = 'Komisi B';
						} elseif (strtolower($anggota['jabatan']) == 'komisi c 1') {
							$temp['parent'] = $this->anggota->where('jabatan', 'komisi c')->first()['jabatan'];
							$temp['jabatan'] = 'Komisi C';
						}
					}
				}
				return $temp;
			},
			$anggota
		);

		$anggota = array_values($anggota);

		return view('anggota', [
			'anggota' => json_encode($anggota),
			'colCondition' => $this->colCondition
		]);
	}

	protected function removeEmptName($array)
	{
		return array_filter(
			$array,
			function ($anggota) {
				return $anggota['nama'] !== '';
			}
		);
	}
}
