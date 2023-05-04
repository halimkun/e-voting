<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\GeneralModel;

class Pengaturan extends BaseController
{
	private $GeneralModel;

	public function __construct()
	{
		$this->GeneralModel = new GeneralModel();
		helper('Flasher');
	}

	public function index()
	{
		$validation = \Config\Services::validation();
		$data = [
			'title' 		=> 'SETTING',
			'act' 			=> 'setting',
			'css' 			=> ['sweetalert/sweetalert2.min'],
			'js' 			=> ['js/img_preview', 'sweetalert/sweetalert2.all.min', 'js/flasher'],
			'data_sekolah' 	=> $this->GeneralModel->first(),
			'validation' 	=> $validation
		];

		return view('admin/setting', $data);
	}

	public function edit()
	{
		$nama_sekolah 	= $this->request->getPost('nama_sekolah');
		$alamat_sekolah = $this->request->getPost('alamat_sekolah');
		$email_sekolah 	= $this->request->getPost('email_sekolah');
		$logo_lama 		= $this->request->getPost('logo_lama');
		$logo 			= $_FILES['logo'];

		$rules = [
			'nama_sekolah' => [
				'rules' => 'required|alpha_numeric_space'
			],
			'alamat_sekolah' => [
				'rules' => 'required'
			],
			'email_sekolah' => [
				'rules' => 'required|valid_email'
			]
		];

		if ($logo['error'] == 0) {
			$rules['logo'] = [
				'rules' => 'uploaded[logo]|max_size[logo,2048]|mime_in[logo,image/png,image/jpg,image/jpeg]|is_image[logo]'
			];
		}

		if (!$this->validate($rules)) {
			return redirect()->to(base_url('/admin/setting'))->withInput();
		}

		setting('App.nama_sekolah', esc($nama_sekolah));
		setting('App.alamat_sekolah', esc($alamat_sekolah));
		setting('App.email_sekolah', esc($email_sekolah));

		if ($logo['error'] == 0) {
			$logoName 	= $logo['name'];
			$eks 		= $this->request->getFile('logo')->getClientExtension();
			$logoName 	= 'logo.' . $eks;
			$tmpName 	= $logo['tmp_name'];
			if (unlink('img/' . $logo_lama)) {
				move_uploaded_file($tmpName, 'img/' .  $logoName);
			}
		}

		setting('App.logo_sekolah', $logoName);

		setFlasher('Selamat!!', 'success', 'Data-berhasil-diubah!!');
		return redirect()->to(base_url('/admin/setting'));
	}

	public function about_update()
	{
		$about_sekolah = $this->request->getPost('about_sekolah');
		$about_title = $this->request->getPost('about_title');

		$rules = [
			'about_sekolah' => [
				'rules' => 'required'
			],
			'about_title' => [
				'rules' => 'required|alpha_numeric_space'
			],
		];

		if (!$this->validate($rules)) {
			return redirect()->to(base_url('/admin/setting'))->withInput();
		}

		setting('App.about_sekolah', esc($about_sekolah));
		setting('App.about_title', esc($about_title));

		setFlasher('Selamat!!', 'success', 'Data-berhasil-diubah!!');
		return redirect()->to(base_url('/admin/setting'));
	}
}
