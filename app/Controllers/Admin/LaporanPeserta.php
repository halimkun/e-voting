<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PesertaModel;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;


class LaporanPeserta extends BaseController
{
	private $model;

	public function __construct()
	{
		$this->model = new PesertaModel();
	}

	public function index()
	{
		$data = [
			'title' => 'LAPORAN PESERTA',
			"act" => 'laporan',
			'act_list' => 'laporan_peserta',
			'list_kelas' => $this->model->select('kelas')->groupBy('kelas')->findAll(),
			'list_jurusan' => $this->model->select('jurusan')->groupBy('jurusan')->findAll(),
			'tahun'		=> $this->model->getTahun(),
		];
		return view('admin/laporanPeserta', $data);
	}

	public function cetakPdf()
	{
		$kelas = $this->request->getPost('kelas');
		$jurusan = $this->request->getPost('jurusan');
		$tahun = $this->request->getPost('tahun');

		$data_peserta = $this->model->cetak($kelas, $jurusan, $tahun);

		if (empty($data_peserta)) {
			session()->setFlashdata('info-peserta', "Oupss.. maaf sepertinya tidak ada data untuk siswa kelas $kelas dan jurusan $jurusan");
			return redirect()->to(base_url('admin/laporan/peserta'));
		}

		$nama_file = 'data_peserta';

		if ($kelas != '') {
			$nama_file .= '_' . $kelas;
		}

		if ($jurusan != '') {
			$nama_file .= '_' . $jurusan;
		}

		if ($tahun != '') {
			$nama_file .= '_' . $tahun;
		}

		$data = [
			'data_peserta' => $data_peserta,
			'kelas' => $kelas,
			'jurusan' => $jurusan
		];
		$dompdf = new Dompdf();

		return view('admin/view_cetak/pesertaPdf', $data);

		// $dompdf->loadHtml(view('admin/view_cetak/pesertaPdf', $data));
		// // (Optional) Setup the paper size and orientation
		// $dompdf->setPaper('A4', 'portrait');

		// // Render the HTML as PDF
		// $dompdf->render();

		// // Output the generated PDF to Browser
		// $dompdf->stream($nama_file . '.pdf');

	}

	public function cetakExcel()
	{
		$kelas = $this->request->getPost('kelas');
		$jurusan = $this->request->getPost('jurusan');
		$tahun = $this->request->getPost('tahun');

		$data_peserta = $this->model->cetak($kelas, $jurusan, $tahun);

		if (empty($data_peserta)) {
			session()->setFlashdata('info-peserta-excel', "Oupss.. maaf sepertinya tidak ada data untuk siswa kelas $kelas dan jurusan $jurusan");
			return redirect()->to(base_url('admin/laporan/peserta'));
		}

		$nama_file = 'data_peserta';

		if ($kelas != '') {
			$nama_file .= '_' . $kelas;
		}

		if ($jurusan != '') {
			$nama_file .= '_' . $jurusan;
		}

		if ($tahun != '') {
			$nama_file .= '_' . $tahun;
		}

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'No');
		$sheet->setCellValue('B1', 'Username');
		$sheet->setCellValue('C1', 'Password');
		$sheet->setCellValue('D1', 'Nama');
		$sheet->setCellValue('E1', 'Kelas');
		$sheet->setCellValue('F1', 'Jurusan');
		$sheet->setCellValue('G1', 'Tahun Ajaran');

		$spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
		$column = 2;
		$no = 1;

		foreach ($data_peserta as $dt) {
			$sheet->setCellValue('A' . $column, $no++);
			$sheet->setCellValue('B' . $column, $dt->username);
			$sheet->setCellValue('C' . $column, $dt->password);
			$sheet->setCellValue('D' . $column, $dt->nama);
			$sheet->setCellValue('E' . $column, $dt->kelas);
			$sheet->setCellValue('F' . $column, $dt->jurusan);
			$sheet->setCellValue('G' . $column, $dt->tahun_ajaran);
			$column++;
		}

		$styleArray = [
			'borders' => [
				'allBorders' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
				],
			],
		];

		$sheet->getStyle('A1:G' . ($column - 1))->applyFromArray($styleArray);
		$writer = new Xls($spreadsheet);

		// Redirect hasil generate xlsx ke web client
		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename=' . $nama_file . '.xls');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}
}
