<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Anggota extends BaseController
{

	protected $validation;
	protected $anggota;
	protected $riwayatAnggota;
	protected $colCondition;

	public function __construct()
	{
		$this->validation = \Config\Services::validation();
		$this->anggota = new \App\Models\AnggotaModel();
		$this->riwayatAnggota = new \App\Models\Riwayatanggota();
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
			'colCondition'	=> $this->colCondition,
			'riwayat'		=> $this->riwayatAnggota->findAll(),
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

	function riwayatAnggota_save() {
		// validate nama, jabatan, tahun
		$validation = $this->validation->setRules([
			'nama' => [
				'label' => 'Nama',
				'rules' => 'required',
				'errors' => [
					'required' => '{field}-wajib-diisi !'
				]
			],
			'jabatan' => [
				'label' => 'Jabatan',
				'rules' => 'required',
				'errors' => [
					'required' => '{field}-wajib-diisi !'
				]
			],
			'tahun' => [
				'label' => 'Tahun',
				'rules' => 'required|numeric|exact_length[4]|less_than_equal_to[' . date('Y') . ']',
				'errors' => [
					'required' => '{field}-wajib-diisi !',
					'numeric' => '{field}-harus-berupa-angka !',
					'exact_length' => '{field}-harus-4-digit !',
					'less_than_equal_to' => '{field}-tidak-boleh-lebih-dari-' . date('Y') . ' !'
				]
			],
		]);

		if (!$validation->withRequest($this->request)->run()) {
			$errors = implode(', ', $this->validation->getErrors());
			
			setFlasher('Gagal !!', 'error', $errors);
			return redirect()->to(base_url('admin/anggota'));
		}

		// if 'jabatan' => $this->request->getPost('jabatan') in [komisi a, komisi b, komisi c]
		$riwayat = $this->riwayatAnggota->where(['tahun' => $this->request->getPost('tahun'), 'jabatan' => $this->request->getPost('jabatan')])->findAll();
		if (in_array(strtolower($this->request->getPost('jabatan')), ['komisi a', 'komisi b', 'komisi c'])) {
			if (count($riwayat) >= 2) {
				setFlasher('Gagal !!', 'error', 'Data-riwayat-anggota-dengan-jabatan-' . $this->request->getPost('jabatan') . '-pada-tahun-' . $this->request->getPost('tahun') . '-sudah-ada !!');
				return redirect()->to(base_url('admin/anggota'));
			}
		} else {
			if (count($riwayat) >= 1) {
				setFlasher('Gagal !!', 'error', 'Data-riwayat-anggota-dengan-jabatan-' . $this->request->getPost('jabatan') . '-pada-tahun-' . $this->request->getPost('tahun') . '-sudah-ada !!');
				return redirect()->to(base_url('admin/anggota'));
			}
		}
		

		// insert data	
		if ($this->riwayatAnggota->save($this->request->getPost())) {
			setFlasher('Selamat !!', 'success', 'Data-berhasil-ditambahkan !!');
			return redirect()->to(base_url('admin/anggota'));
		}
		
		setFlasher('Gagal !!', 'error', 'Nampaknya-ada-yang-salah !!');
		return redirect()->to(base_url('admin/anggota'));		 
	}

	function riwayatAnggota_delete($num) {
		if ($this->riwayatAnggota->delete($num)) {
			setFlasher('Selamat !!', 'success', 'Data-berhasil-dihapus !!');
			return redirect()->to(base_url('admin/anggota'));
		}
		
		setFlasher('Gagal !!', 'error', 'Nampaknya-ada-yang-salah !!');
		return redirect()->to(base_url('admin/anggota'));
	}
}
