<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\PesertaModel;

class Login extends BaseController
{
	public function index()
	{
		$validation =  \Config\Services::validation();
		$data = [
			'validation' => $validation,
			'nama_sekolah' => setting('App.nama_sekolah'),
			'logo_sekolah' => setting('App.logo_sekolah'),
		];
		return view('login/peserta', $data);
	}

	public function loginAdmin()
	{
		$validation =  \Config\Services::validation();
		$data['validation'] = $validation;
		return view('login/admin', $data);
	}

	public function cekLoginPeserta()
	{
		$PesertaModel = new PesertaModel();
		$username = $this->request->getPost('username');
		$password = $this->request->getPost('password');

		// validation
		if (!$this->validate([
			'username' => [
				'rules' => 'required',
			],
			'password' => [
				'rules' => 'required'
			]
		])) {
			return redirect()->to(base_url('/login'))->withInput();
		}
		$data = $PesertaModel->where('username', $username)->first();
		// cek username
		if ($data == null) {
			session()->setFlashdata('info-login', ['alert-danger', 'username atau password salah']);
			return redirect()->to(base_url('login'))->withInput();
		}

		// cek password
		$pwSistem = $data->password;
		if ($password != $pwSistem) {
			session()->setFlashdata('info-login', ['alert-danger', 'username atau password salah']);
			return redirect()->to(base_url('login'))->withInput();
		}

		$tahun_ajaran = $data->tahun_ajaran;
		if ($tahun_ajaran != setting('App.tahun_ajaran')) {
			session()->setFlashdata('info-login', ['alert-danger', 'Maaf Anda tidak terdaftar di tahun ajaran sekarang ( '. setting('App.tahun_ajaran') .' )! <br /> <small>jika anda merasa ini kesalahan, silahkan hubungi panitia.</small>']);
			return redirect()->to(base_url('login'))->withInput();
		}

		//.cek apakah sudah memilih 
		$status_pilihan = $data->status_pilihan;
		if ($status_pilihan == '1') {
			session()->setFlashdata('info-login', ['alert-warning', 'Maaf Anda sudah melakukan pemilihan!']);
			return redirect()->to(base_url('login'))->withInput();
		}

		// cek status acara
		$status_acara = setting('App.status_acara');
		if ($status_acara == 0) {
			session()->setFlashdata('info-login', ['alert-warning', 'Acara belum dimulai,, mohon untuk tunggu sebentar!!']);
			return redirect()->to(base_url('login'))->withInput();
		} elseif ($status_acara == 2) {
			session()->setFlashdata('info-login', ['alert-warning', 'Oupss.. Nampaknya Acara sudah selesai!!!']);
			return redirect()->to(base_url('login'))->withInput();
		}

		// jika sudah valid semua
		$id = $data->id_peserta;
		session()->set('login', [
			'status' => true,
			'id' => $id,
			'level' => 0
		]);

		return redirect()->to('/pilih');
	}

	public function cekLoginAdmin()
	{
		$AdminModel = new AdminModel();
		$username = $this->request->getPost('username');
		$password = $this->request->getPost('password');

		// validation
		if (!$this->validate([
			'username' => [
				'rules' => 'required',
			],
			'password' => [
				'rules' => 'required'
			]
		])) {
			return redirect()->to(base_url('/login/admin'))->withInput();
		}

		// cek username 
		$data = $AdminModel->where('username', $username)->first();
		if ($data == null) {
			session()->setFlashdata('info-login', 'username atau password salah!!');
			return redirect()->to(base_url('/login/admin'))->withInput();
		}

		// cek password
		$pwSistem = $data->password;
		if (!password_verify($password, $pwSistem)) {
			session()->setFlashdata('info-login', 'username atau password salah!!');
			return redirect()->to(base_url('/login/admin'))->withInput();
		}

		// jika semua sudah terpenuhi
		$id = $data->id_admin;
		session()->set('login', [
			'status' => true,
			'id' => $id,
			'level' => 1
		]);

		return redirect()->to('/admin/dashboard');
	}
}
