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
	protected $allowedFields        = ['id_peserta','username', 'password', 'nama','kelas','jurusan','status_pilihan','waktu_pilih'];
	
	public function getTotal($param = null, $persen = false)
	{
	  if ($param === null) {
	    $data =  $this->countAll();
	    return $data;
	  }else if($param == true){
	    $data = $this->where('status_pilihan', '1')->selectCount('id_peserta', 'jmlh')->first()->jmlh;
	  }else if($param == false){
      $data = $this->where('status_pilihan', '0')->selectCount('id_peserta', 'jmlh')->first()->jmlh;
	  }
	  $dt = (integer) $data;
	  if($persen == false ){
	    return number_format($dt, 0, '.', '.');
	  }else{
	    $dt_all = $this->getTotal();
	    return number_format($dt / $dt_all * 100, 2) . '%';
	  }
	}
	
	public function getData($id_peserta = null, $jmlh_pager = 10, $keyword = '')
	{
	  if($id_peserta == null){
	    return $this->like('username', $keyword)->orLike('nama', $keyword)->orLike('kelas', $keyword)->orLike('jurusan',$keyword)->orderBy('nama', 'ASC')->paginate($jmlh_pager, 'peserta');
	  } else{
	    $data = $this->where('id_peserta', $id_peserta)->first();
	    return json_encode($data);
	  }
	}
	
	public function cetak($kelas, $jurusan)
	{
	  if($kelas == ""){
	    if($jurusan == ""){
	      return $this->orderBy('kelas', 'ASC')->findAll();
	    }else{
	      return $this->where('jurusan', $jurusan)->orderBy('kelas', 'ASC')->findAll();
	    }
	  }else{
	    if($jurusan == ""){
	      return $this->where('kelas', $kelas)->orderBy('kelas', 'ASC')->findAll();
	    }else{
	      return $this->where('kelas', $kelas)->where('jurusan', $jurusan)->orderBy('kelas', 'ASC')->findAll();
	    }
	  }
	}
	
	

}
