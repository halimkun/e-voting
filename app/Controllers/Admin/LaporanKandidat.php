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
		  'title' 		=> 'LAPORAN KANDIDAT',
		  'act_list' 	=> 'laporan_kandidat',
		  'act' 		=> 'laporan',
		];

		return view('admin/laporanKandidat', $data);
	}
	
	public function cetakPdf()
	{
	  $kandidatModel = new CandidateModel();
		$data = [
			'data_kandidat' => $kandidatModel->orderBy('no_urut', 'ASC')->findAll()
		];
		
		return view('admin/view_cetak/kandidatPdf', $data);

		// // instantiate and use the dompdf class
		// $dompdf = new Dompdf();
		// $dompdf->loadHtml(view('admin/view_cetak/kandidatPdf', $data));
	
		// // (Optional) Setup the paper size and orientation
		// $dompdf->setPaper('A4', 'portrait');
		
		// // Render the HTML as PDF
		// $dompdf->render();

		// $dompdf->stream('Laporan Kandidat.pdf', ["Attachment" => false]);
	}
	
}
