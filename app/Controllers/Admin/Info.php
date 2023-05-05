<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

// TODO: Info belum siap, perbaiki kontennya
class Info extends BaseController
{
	protected $info;

	public function __construct()
	{
		$this->info = new \App\Models\InfoModel();
		helper('Flasher');
	}

	public function index($id = null)
	{
		$data = [
			'act' 			=> 'info',
			'css'			=> ['sweetalert/sweetalert2.min', 'summernote/summernote-bs4.min'],
			'js' 			=> ['sweetalert/sweetalert2.all.min', 'js/flasher', 'summernote/summernote-bs4.min'],
			'validation'	=> \Config\Services::validation(),
		];

		if ($id == null) {
			$data['title'] = 'TAMBAH INFORMASI';
			$data['info'] = $this->info->findAll();
		} else {
			$data['title'] = 'EDIT INFORMASI';
			$data['info'] = $this->info->find($id);
			$data['id'] = $id;
		}

		return view('admin/info', $data);
	}

	public function save()
	{
		$data = [
			'judul' => $this->request->getPost('judul'),
			'isi' => $this->request->getPost('isi'),
		];


		$rules = [
			'judul' => 'required|alpha_numeric_punct|max_length[255]',
			'isi' => 'required',
		];

		if (isset($_POST['id'])) {
			$data['id'] = $this->request->getPost('id');
			$rules['id'] = 'required|numeric';
		}

		if (!$this->validate($rules)) {
			return redirect()->back()->withInput();
		}

		if ($this->info->save($data)) {
			setFlasher('Selamat!!', 'success', 'Berita-berhasil-' . isset($data['id']) ? 'diubah' : 'ditambahkan' . '!!');
			return redirect()->to('/admin/info');
		} else {
			setFlasher('Mohon Maaf!!', 'error', 'Berita-gagal-' . isset($data['id']) ? 'diubah' : 'ditambahkan' . '!!');
			return redirect()->back()->withInput();
		}
	}

	public function summernote_upload()
	{
		// upload image from summernote editor
		$file = $this->request->getFile('file');
		$rules = [
			'file' => 'uploaded[file]|max_size[file,2048]|mime_in[file,image/png,image/jpg,image/jpeg]|is_image[file]',
		];

		if (!$this->validate($rules)) {
			return json_encode([
				'success' => false,
				'msg' => $this->validator->getError('file'),
			]);
		}

		$data['file'] = $file->getRandomName();

		if ($file->getError() == 0) {
			$file->move('img/info', $data['file']);
			return json_encode([
				'success' 	=> true,
				'url' 		=> base_url('img/info/' . $data['file']),
				'name' 		=> $data['file'],
			]);
		} else {
			return json_encode([
				'success' => false,
				'msg' => $file->getError(),
			]);
		}
	}

	public function summernote_delete()
	{
		$filename = $this->request->getGet('src');
		$filepath = 'img/info/' . $filename;

		if (file_exists($filepath)) {
			unlink($filepath);
			return json_encode([
				'success' => true,
				'msg' => 'File berhasil dihapus',
			]);
		} else {
			return json_encode([
				'success' => false,
				'msg' => 'File tidak ditemukan',
			]);
		}
	}

	public function delete($id)
	{
		$data = $this->info->find($id);

		// if data 
		if ($this->info->delete($id)) {
			$dom = new \DOMDocument();
			$dom->loadHTML($data['isi']);

			$image_tags = $dom->getElementsByTagName('img');

			foreach ($image_tags as $image_tag) {
				$src = $image_tag->getAttribute('src');
				$exp = explode('/', $src);
				$file_name = end($exp);

				// unlink
				$filepath = 'img/info/' . $file_name;
				if (file_exists($filepath)) {
					unlink($filepath);
				}
			}
			
			setFlasher('Selamat!!', 'success', 'Berita-berhasil-dihapus!!');
			return redirect()->to('/admin/info');
		} else {
			setFlasher('Mohon Maaf!!', 'error', 'Berita-gagal-dihapus!!');
			return redirect()->back();
		}
	}
}
