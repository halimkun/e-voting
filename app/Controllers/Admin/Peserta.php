<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PesertaModel;
use App\Models\HasilModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xls;

class Peserta extends BaseController
{
	private $PesertaModel;
	private $HasilModel;

	public function __construct()
	{
		$this->PesertaModel = new PesertaModel();
		$this->HasilModel = new HasilModel();
		helper('Flasher');
	}

	public function index()
	{
		$validation =  \Config\Services::validation();
		$hal = $this->request->getGet('page_peserta');
		$cari = $this->request->getPost('cari');
		$keyword_peserta = $this->request->getPost('keyword');
		$hal = (isset($hal)) ? $hal : 1;

		if (isset($cari)) {
			session()->set('keyword_peserta', $keyword_peserta);
		} else {
			$keyword_peserta = session()->get('keyword_peserta');
		}

		$keyword_peserta = ($keyword_peserta == null) ? '' : $keyword_peserta;

		$jmlh_data_pagination = 10;
		$data = [
			'title' => 'DATA PESERTA',
			'act' => 'peserta',
			'css' => ['sweetalert/sweetalert2.min'],
			'js' => ['sweetalert/sweetalert2.all.min', 'js/flasher'],
			'data_peserta' => $this->PesertaModel->getData(null, $jmlh_data_pagination, $keyword_peserta),
			'pager' => $this->PesertaModel->pager,
			'hal' => $hal,
			'jmlh_all_data' => $this->PesertaModel->getTotal(),
			'jmlh_data_pagination' => $jmlh_data_pagination,
			'validation' => $validation
		];
		return view('admin/peserta', $data);
	}

	public function hapus($id_peserta)
	{
		$this->PesertaModel->delete($id_peserta);
		setFlasher('Selamat!!', 'success', 'Data-berhasil-dihapus!!');
		session()->set('keyword_peserta', '');
		return redirect()->to(base_url('admin/peserta'));
	}

	public function add()
	{
		if (!$this->validate([
			'username' => [
				'rules' => 'required|is_unique[peserta.username]|numeric',
				'errors' => [
					'required' => 'harap isi bidang ini!!',
					'is_unique' => 'username telah ada!!',
					'numeric' => 'username hanya boleh berisi angka!!'
				]
			],
			'nama' => [
				'rules' => 'required|alpha_space',
				'errors' => [
					'required' => 'harap isi bidang ini!!',
					'alpha_space' => 'nama tidak boleh mengandung angka!!'
				]
			],
			'kelas' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'harap isi bidang ini!!'
				]
			],
			'jurusan' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'harap isi bidang ini!!'
				]
			],
		])) {
			setFlasher('Oupss..', 'error', 'Tampaknya terjadi kesalahan. Mohon untuk ulangi lagi!!');
			return redirect()->to(base_url('admin/peserta'))->withInput();
		}
		$faker = \Faker\Factory::create('id_ID');
		$data_insert = [
			'id_peserta' => $faker->uuid(),
			'username' => esc($this->request->getPost('username')),
			'password' => $faker->regexify('[A-Z]{6}[0-9]{5}'),
			'nama' => esc($this->request->getPost('nama')),
			'kelas' => strtoupper(esc($this->request->getPost('kelas'))),
			'jurusan' => strtoupper(esc($this->request->getPost('jurusan'))),
			'status_pilihan' => '0',
			'waktu_pilih' => null
		];

		$this->PesertaModel->insert($data_insert);
		setFlasher('Selamat!!', 'success', 'Data-baru-berhasil-ditambahkan!!');
		return redirect()->to(base_url('admin/peserta'));
	}

	public function edit()
	{
		$id_peserta = $this->request->getPost('id_peserta');
		$username = $this->request->getPost('username');
		$password = $this->request->getPost('password');
		$nama = $this->request->getPost('nama');
		$kelas = $this->request->getPost('kelas');
		$jurusan = $this->request->getPost('jurusan');
		// $status_pilihan = $this->request->getPost('status_pilihan');
		// $cek_status_pilihan = $this->request->getPost('cek_status_pilihan');


		if ($username == '' || $id_peserta == '' || $password == '' || $nama == '' || $kelas == '' || $jurusan == '') {
			setFlasher('Oupss..', 'warning', 'Mohon-untuk-mengisi-semua-data!!');
			return redirect()->to(base_url('admin/peserta'));
		}

		$data_username = $this->PesertaModel->where('id_peserta', $id_peserta)->first()->username;

		if ($username != $data_username) {
			if (!$this->validate([
				'username' => [
					'rules' => 'is_unique[peserta.username]',
				]
			])) {
				setFlasher('Oupss..', 'warning', 'username-telah-digunakan.-Mohon-untuk-memilih-username-lain!!');
				return redirect()->to(base_url('admin/peserta'));
			}
		}

		$data_update = [
			'username' => esc($username),
			'password' => esc($password),
			'nama' => esc($nama),
			'kelas' => strtoupper(esc($kelas)),
			'jurusan' => strtoupper(esc($jurusan)),
			// 'status_pilihan' => esc($status_pilihan)
		];

		// if ($cek_status_pilihan == true) {
		// 	if ($status_pilihan == 0) {
		// 		$data_update['waktu_pilih'] = null;
		// 		$this->HasilModel->where('id_peserta', $id_peserta)->delete();
		// 	}
		// }

		$this->PesertaModel->update($id_peserta, $data_update);
		setFlasher('Selamat!!', 'success', 'Data-berhasil-diubah!!');
		return redirect()->to(base_url('admin/peserta'));
	}

	public function getOneData($id_peserta)
	{
		$data = $this->PesertaModel->getData($id_peserta);
		echo $data;
	}

	public function uploadExcel()
	{
		$file = $this->request->getFile('file_excel');
		$eks = $file->getClientExtension();

		// validation
		if (!$this->validate([
			'file_excel' => [
				'rules' => 'uploaded[file_excel]|ext_in[file_excel,xls,csv]',
				'errors' => [
					'uploaded' => 'Mohon untuk upload file dulu!!',
					'ext_in' => 'file yang diterima hanya file .xls dan .csv'
				]
			]
		])) {
			return redirect()->to(base_url('/admin/peserta'))->withInput();
		}



		// upload file
		$newName = $file->getRandomName();
		$file->move('sampel_excel', $newName);

		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader(ucfirst($eks));
		$spreadsheet = $reader->load('sampel_excel/' . $newName);
		$sheetData = $spreadsheet->getActiveSheet()->toArray();
		$validation =  \Config\Services::validation();
		$faker = \Faker\Factory::create('id_ID');
		$gagal_insert = 0;
		$berhasil_insert = 0;
		for ($i = 1; $i < count($sheetData); $i++) {
			$data_insert = [
				'id_peserta' => $faker->uuid(),
				'username' => $sheetData[$i]['1'],
				'password' => $sheetData[$i]['2'],
				'nama' => $sheetData[$i]['3'],
				'kelas' => strtoupper($sheetData[$i]['4']),
				'jurusan' => strtoupper($sheetData[$i]['5']),
				'status_pilihan' => '0',
				'waktu_pilih' => null
			];

			$id_peserta = $this->PesertaModel->where('id_peserta', $data_insert['id_peserta'])->first();
			$username = $this->PesertaModel->where('username', $data_insert['username'])->first();

			if ($id_peserta != null) {
				$gagal_insert++;
			} elseif ($username != null) {
				$gagal_insert++;
			} else {
				if ($data_insert['password'] == '' || $data_insert['nama'] == '' || $data_insert['kelas'] == '' || $data_insert['jurusan'] == '') {
					$gagal_insert++;
				} else {
					if ($this->PesertaModel->insert($data_insert)) {
						$berhasil_insert++;
					} else {
						$gagal_insert++;
					}
				}
			}
		}
		unlink('sampel_excel/' . $newName);
		setFlasher('Info!!', 'info', "$berhasil_insert-data-berhasil-ditambahkan!!-dan-$gagal_insert-data-gagal-ditambahkan!!");
		return redirect()->to(base_url('/admin/peserta'));
	}
}
