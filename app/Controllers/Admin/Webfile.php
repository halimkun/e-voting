<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Webfile extends BaseController
{

	protected $files;

	public function __construct()
	{
		$this->files = new \App\Models\WebfileModel();
		helper('Flasher');
	}

	public function index()
	{
		$validation = \Config\Services::validation();
		$data = [
			'title' 		=> 'PUBLIKSI FILE',
			'act' 			=> 'downloads',
			'css'			=> ['sweetalert/sweetalert2.min'],
			'js' 			=> ['js/img_preview', 'sweetalert/sweetalert2.all.min', 'js/flasher'],
			'validation'	=> $validation,
			'publikasi'		=> $this->files->findAll(),
		];

		return view('admin/webFiles', $data);
	}

	public function save()
	{
		$data = [
			'judul' => $this->request->getPost('judul'),
			'keterangan' => $this->request->getPost('keterangan'),
		];

		$file = $this->request->getFile('dokumen');

		$rules = [
			'judul' => 'required|alpha_numeric_punct|max_length[255]',
		];


		if ($file->getError() == 0) {
			$rules['dokumen'] = 'uploaded[dokumen]|max_size[dokumen,10240]|mime_in[dokumen,image/png,image/jpg,image/jpeg,application/pdf]|is_image[dokumen]';
		}

		$data['file'] = $file->getRandomName();

		if (!$this->validate($rules)) {
			return redirect()->back()->withInput();
		}

		// public/files/publication

		if ($this->files->save($data)) {
			$file->move('files/publication', $data['file']);

			setFlasher('Selamat!!', 'success', 'Data-berhasil-ditambahkan!!');
			return redirect()->back();
		} else {
			setFlasher('Maaf!!', 'danger', 'Data-gagal-ditambahkan!!');
			return redirect()->back()->withInput();
		}
	}

	public function delete($id)
	{
		$publikasi = $this->files->find($id);

		if ($this->files->delete($id)) {
			unlink('files/publication/' . $publikasi['file']);
			setFlasher('Selamat!!', 'success', 'Data-berhasil-dihapus!!');
			return redirect()->back();
		} else {
			setFlasher('Maaf!!', 'danger', 'Data-gagal-dihapus!!');
			return redirect()->back();
		}
	}
}
