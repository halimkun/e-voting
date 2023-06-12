<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PesertaModel;
use App\Models\CandidateModel;
use App\Models\HasilModel;

class Dashboard extends BaseController
{
  public function __construct()
  {
    $this->PesertaModel = new PesertaModel();
    $this->CandidateModel = new CandidateModel();
    $this->HasilModel = new HasilModel();
    helper('Flasher');
  }
  
	public function index()
	{
		$data = [
		  'title' => 'DASHBOARD',
		  'act' => 'dashboard',
		  'css' => ['sweetalert/sweetalert2.min'],
		  'js' => ['chart/Chart','sweetalert/sweetalert2.all.min','js/flasher'],
		  'jmlh_candidate' => $this->CandidateModel->getTotal(),
		  'jmlh_peserta' => $this->PesertaModel->getTotal(),
		  'sudah_memilih' => $this->PesertaModel->getTotal(true),
		  'sudah_memilih_persen' => $this->PesertaModel->getTotal(true, true),
		  'belum_memilih' => $this->PesertaModel->getTotal(false),
		  'belum_memilih_persen' => $this->PesertaModel->getTotal(false, true),
		  'data_chart' => $this->CandidateModel->getDataChart(),
		  'total_suara_masuk' => $this->HasilModel->countAll(),
		];
		
		return view('admin/dashboard', $data);
	}
	
	public function editAcara($param)
	{
		setting('App.status_acara', $param);
		
		if($param == 1){
			$pesan = 'berhasil-memulai-acara!!';
		} elseif($param == 2){
			$pesan = 'berhasil-menghentikan-acara!!';
		} else{
			setting('App.status_acara', 0);
			$pesan = 'berhasil-mereset-acara!!';
		}

		setFlasher('Selamat!!', 'success', $pesan);
		return redirect()->to(base_url('/admin/dashboard'));
	}
	
}
