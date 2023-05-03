<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CandidateModel;
use App\Models\GeneralModel;
use App\Models\HasilModel;
use App\Models\PesertaModel;


class Pilih extends BaseController
{
  private $candidateModel;
  private $generalModel;
  private $hasilModel;
  private $pesertaModel;
  
  public function __construct()
  {
    $this->candidateModel = new CandidateModel();
    $this->generalModel = new GeneralModel();
    $this->hasilModel = new HasilModel();
    $this->pesertaModel = new PesertaModel();
  }
  
	public function index()
	{
		$data = [
		  'dt_kandidat' => $this->candidateModel->orderBy('no_urut', 'ASC')->findAll(),
		  'general' => $this->generalModel->first()
		];
		return view('pemilihan/index', $data);
	}
	
	public function cek(){
	  $pilihan = $this->request->getPost('pilihan');
	  $id_peserta = session()->get('login')['id'];
	  
	  if($pilihan == null){
	    session()->setFlashdata('error-pilih', 'true');
	    return redirect()->to(base_url('/pilih'));
	  }
	  
	  if($this->hasilModel->insert(['id_candidate' => $pilihan, 'id_peserta' => $id_peserta])){
	    if($this->pesertaModel->update($id_peserta, ['status_pilihan' => '1', 'waktu_pilih' => date("Y-m-d H:i:s")])){
	      session()->setFlashdata('info-pilih', 'true');
	    }
	  }
	  return redirect()->to(base_url('/pilih'));
	  
	}
	
	public function getOneData($id_candidate)
	{
	  $data = $this->candidateModel->where('id_candidate', $id_candidate)->first();
	  $data = esc($data);
	  echo json_encode($data);
	}
	
}
