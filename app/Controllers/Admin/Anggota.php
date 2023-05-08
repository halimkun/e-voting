<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Anggota extends BaseController
{

	protected $validation;
	protected $anggota;
	protected $colCondition;

	public function __construct()
	{
		$this->validation = \Config\Services::validation();
		$this->anggota = new \App\Models\AnggotaModel();
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

		helper('Flasher');
	}

	public function index()
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

		$data = [
			'title' 		=> 'Data Anggota',
			'act' 			=> 'anggota',
			'css'			=> ['sweetalert/sweetalert2.min'],
			'js' 			=> ['sweetalert/sweetalert2.all.min', 'js/flasher'],
			'validation' 	=> $this->validation,
			'anggota' 		=> json_encode($anggota),
			'anggota_real'	=> $this->anggota->findAll(),
			'fields'		=> $this->anggota->select(['jabatan', 'nama'])->findAll(),
			'colCondition'	=> $this->colCondition
		];

		return view('admin/anggota', $data);
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

	public function save()
	{
		$pd = $this->request->getPost();
		$pd = array_map(
			function ($name, $value) {
				return [
					'jabatan' => str_replace('_', ' ', $name),
					'nama' => $value
				];
			},
			array_keys($pd),
			array_values($pd)
		);
		
		// update data anggota where jabatan
		foreach ($pd as $data) {
			$this->anggota->update($this->anggota->where('jabatan', $data['jabatan'])->first()['id'], $data);
		}

		setFlasher('Selamat!!', 'success', 'Data-berhasil-ditambahkan!!');
		return redirect()->to(base_url('admin/anggota'));
	}
}
