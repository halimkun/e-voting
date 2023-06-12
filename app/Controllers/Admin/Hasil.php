<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CandidateModel;
use App\Models\HasilModel;

class Hasil extends BaseController
{
  private $CandidateModel;
  private $HasilModel;
  
  public function __construct()
  {
    $this->CandidateModel = new CandidateModel();
    $this->HasilModel = new HasilModel();
  }
  
	public function index()
	{
		$data = [
		  'title' => "HASIL VOTING",
		  'act' => 'hasil_voting',
		  'js' => ['chart/Chart'],
		  'data_chart' => $this->CandidateModel->getDataChart(true),
		  'total_suara_masuk' => $this->HasilModel->countAll()
		];
		return view('admin/hasilVoting', $data);
	}
}
