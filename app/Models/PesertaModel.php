<?php

namespace App\Models;

use CodeIgniter\Model;

class PesertaModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'peserta';
	protected $primaryKey           = 'id_peserta';
	protected $useAutoIncrement     = false;
	protected $returnType           = 'object';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['id_peserta', 'username', 'password', 'nama', 'kelas', 'jurusan', 'status_pilihan', 'waktu_pilih', 'tahun_ajaran'];

	public function getTotal($param = null, $persen = false)
	{
		if ($param === null) {
			$data = $this->where("tahun_ajaran", setting("App.tahun_ajaran"))->selectCount('id_peserta', 'jmlh')->first()->jmlh;
			// $data =  $this->countAll();
			return $data;
		} else if ($param == true) {
			$data = $this->where("tahun_ajaran", setting("App.tahun_ajaran"))->where('status_pilihan', '1')->selectCount('id_peserta', 'jmlh')->first()->jmlh;
		} else if ($param == false) {
			$data = $this->where("tahun_ajaran", setting("App.tahun_ajaran"))->where('status_pilihan', '0')->selectCount('id_peserta', 'jmlh')->first()->jmlh;
		}

		$dt = (int) $data;
		if ($persen == false) {
			return number_format($dt, 0, '.', '.');
		} else {
			$dt_all = $this->getTotal();
			return number_format($dt / $dt_all * 100, 2) . '%';
		}
	}

	public function getData($id_peserta = null, $jmlh_pager = 10, $keyword = '')
	{
		if ($id_peserta == null) {
			return $this->like('username', $keyword)->orLike('nama', $keyword)->orLike('kelas', $keyword)->orLike('jurusan', $keyword)->orderBy('tahun_ajaran', 'DESC')->orderBy('nama', 'ASC')->paginate($jmlh_pager, 'peserta');
		} else {
			$data = $this->where('id_peserta', $id_peserta)->first();
			return json_encode($data);
		}
	}

	public function cetak($kelas, $jurusan, $tahun)
	{
		$data = $this->select("*");
		if ($kelas != "") {
			$data->where('kelas', $kelas);
		}

		if ($jurusan != "") {
			$data->where('jurusan', $jurusan);
		}

		if ($tahun != "") {
			$data->where('tahun_ajaran', $tahun);
			$data->orderBy('tahun_ajaran', 'DESC');
		}

		return $data->orderBy('kelas', 'ASC')->orderBy('nama', 'ASC')->findAll();
	}

	public function resetMemilih()
	{
		// ganti semua status_pilihan menjadi 0 jika status_pilihan != 0
		$this->where('status_pilihan !=', '0')->set(['status_pilihan' => '0'])->update();

		// ganti semua waktu_pilih menjadi null jika waktu_pilih != null
		$this->where('waktu_pilih !=', null)->set(['waktu_pilih' => null])->update();
	}

	public function getTahun()
	{
		return $this->select('tahun_ajaran')->groupBy('tahun_ajaran')->orderBy('tahun_ajaran', 'DESC')->get()->getResultArray();
	}
}
