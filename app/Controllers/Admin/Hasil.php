<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CandidateModel;
use App\Models\HasilModel;
use App\Models\GeneralModel;

class Hasil extends BaseController
{
  private $CandidateModel;
  private $HasilModel;
  private $GeneralModel;
  
  public function __construct()
  {
    $this->CandidateModel = new CandidateModel();
    $this->HasilModel = new HasilModel();
    $this->GeneralModel = new GeneralModel();
  }
  
	public function index()
	{
		$data = [
		  'title' => "HASIL VOTING",
		  'act' => 'hasil_voting',
		  'js' => ['chart/Chart'],
		  'data_chart' => $this->CandidateModel->getDataChart(true),
		  'total_suara_masuk' => $this->HasilModel->countAll(),
		  'status_acara' => $this->GeneralModel->getData('status_acara')
		];
		return view('admin/hasilVoting', $data);
	}
}
