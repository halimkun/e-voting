<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CandidateModel;
use App\Models\PesertaModel;
use Dompdf\Dompdf;

class LaporanHasil extends BaseController
{
	public function index()
	{
		$data = [
		  'title' => 'LAPORAN HASIL VOTING',
		  'act' => 'laporan',
		  'act_list' => 'laporan_hasil'
		];
		return view('admin/laporanHasil', $data);
	}
	
	public function cetakPdf()
	{
	  $modelCandidat = new CandidateModel();
	  $modelPeserta = new PesertaModel();
	  
	  if(setting("App.status_acara") != "2"){
	    session()->setFlashdata('info-cetak-hasil', 'Oupss.. namapknya acara belum selesai,, Mohon Tunggu acara selesai dulu!!');
	    return redirect()->to(base_url('admin/laporan/hasil'));
	  }
	  
	  
	  $data = [
	    'data_hasil' => $modelCandidat->getDataChart(true),
	    'suara_masuk' => $modelPeserta->getTotal(true),
	    'jmlh_peserta' => $modelPeserta->getTotal(),
	    'peserta_memilih' => $modelPeserta->getTotal(true),
	    'peserta_tidak_memilih' => $modelPeserta->getTotal(false)
	  ];
	  
	  
	  return view('admin/view_cetak/hasilPdf', $data);

	//   $dompdf = new Dompdf();
	//   $dompdf->loadHtml(view('admin/view_cetak/hasilPdf', $data));
	//   $dompdf->setPaper('A4', 'portrait');
	//   $dompdf->render();
	//   $dompdf->stream('laporan_hasil_voting.pdf', ['Attachment' => false]);
	}
	
}
