<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CandidateModel;
use Dompdf\Dompdf;


class LaporanKandidat extends BaseController
{
	public function index()
	{
		$data = [
		  'title' => 'LAPORAN KANDIDAT',
		  'act' => 'laporan',
		  'act_list' => 'laporan_kandidat'
		];
		return view('admin/laporanKandidat', $data);
	}
	
	public function cetakPdf()
	{
	  $kandidatModel = new CandidateModel();
    $data = [
      'data_kandidat' => $kandidatModel->orderBy('no_urut', 'ASC')->findAll()
    ];
    
    // instantiate and use the dompdf class
    $dompdf = new Dompdf();
    $dompdf->loadHtml(view('admin/view_cetak/kandidatPdf', $data));
   
    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'portrait');
    
    // Render the HTML as PDF
    $dompdf->render();
    
    // Output the generated PDF to Browser
    $dompdf->stream('laporan_kandidat.pdf');
	}
	
}
