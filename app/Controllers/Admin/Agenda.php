<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

// TODO: Agenda belum siap, perbaiki kontennya
class Agenda extends BaseController
{

	protected $validation;
	protected $agenda;

	public function __construct()
	{
		$this->validation = \Config\Services::validation();
		$this->agenda = new \App\Models\AgendaModel();
		helper('Flasher');
	}

	public function index($id = null)
	{

		$data = [
			'title' 		=> 'TAMBAH AGENDA',
			'act' 			=> 'agenda',
			'css'			=> ['sweetalert/sweetalert2.min'],
			'js' 			=> ['js/img_preview', 'sweetalert/sweetalert2.all.min', 'js/flasher'],
			'validation'	=> $this->validation,
			'agenda'		=> $this->agenda->findAll(),
		];

		if ($id !== null) {
			$agenda_edit = $this->agenda->find($id);
			$data['agenda_edit'] = $agenda_edit;
		}

		return view('admin/agenda', $data);
	}

	public function save()
	{
		$file = $this->request->getFile('foto');
		$fname = $file->getRandomName();

		$data = [
			'mulai'		=> $this->request->getPost('mulai'),
			'selesai'	=> $this->request->getPost('selesai'),
			'acara'		=> $this->request->getPost('acara'),
			'keterangan' => $this->request->getPost('keterangan'),
		];

		if (isset($_POST['id'])) {
			$data['id'] = $this->request->getPost('id');
		}


		$rules = [
			'mulai'		=> 'required',
			'selesai'	=> 'required',
			'acara'		=> 'required|alpha_numeric_punct|max_length[255]',
			'keterangan' => 'required',
		];

		if ($file->getError() == 0 || ($file->getError() == 0 && isset($_POST['id']))) {
			$data['foto'] = $fname;
			$rules['foto'] = 'uploaded[foto]|max_size[foto,2048]|mime_in[foto,image/png,image/jpg,image/jpeg]|is_image[foto]';
		}

		if (!$this->validate($rules)) {
			return redirect()->back()->withInput();
		}

		if ($this->agenda->save($data)) {
			if ($file->getError() == 0) {
				$file->move('files/agenda', $fname);
			}

			setFlasher('Selamat!!', 'success', 'Data-berhasil-ditambahkan!!');
			return redirect()->to(base_url('/admin/agenda'));
		} else {
			setFlasher('Mohon Maaf!!', 'danger', 'Data-gagal-ditambahkan!!');
			return redirect()->to(base_url('/admin/agenda'));
		}
	}

	public function delete($id = null)
	{
		if ($id == null) {
			return redirect()->to(base_url('/admin/agenda'));
		}

		$agenda = $this->agenda->find($id);
		
		if ($agenda == null) {
			setFlasher('Mohon Maaf!!', 'danger', 'Data-tidak-ditemukan!!');
			return redirect()->to(base_url('/admin/agenda'));
		}

		if ($this->agenda->delete($id)) {
			if (file_exists('files/agenda/' . $agenda['foto'])) {
				unlink('files/agenda/' . $agenda['foto']);
			}

			setFlasher('Selamat!!', 'success', 'Data-berhasil-dihapus!!');
			return redirect()->to(base_url('/admin/agenda'));
		} else {
			setFlasher('Mohon Maaf!!', 'danger', 'Data-gagal-dihapus!!');
			return redirect()->to(base_url('/admin/agenda'));
		}
	}
}
