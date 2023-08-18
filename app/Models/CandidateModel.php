<?php

namespace App\Models;

use CodeIgniter\Model;

class CandidateModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'candidate';
	protected $primaryKey           = 'id_candidate';
	protected $useAutoIncrement     = false;
	protected $returnType           = 'object';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['id_candidate', 'no_urut', 'ketua','wakil','visi','misi','slogan','foto', 'periode'];
	
	public function getTotal()
	{
	  return $this->where('periode', setting('App.tahun_ajaran'))->countAllResults();
	}
	
  public function getDataChart($order = false)
  {
    if($order == false){
      return $this->select('candidate.id_candidate, ketua, wakil, foto')->selectCount('hasil.id_candidate', 'jmlh')->join('hasil', 'hasil.id_candidate = candidate.id_candidate', 'left')->where('periode', setting('App.tahun_ajaran'))->groupBy('candidate.id_candidate')->orderBy('jmlh', 'DESC')->get()->getResultArray();
    } else{
      return $this->select('candidate.id_candidate, ketua, wakil, foto, no_urut')->selectCount('hasil.id_candidate', 'jmlh')->join('hasil', 'hasil.id_candidate = candidate.id_candidate', 'left')->where('periode', setting('App.tahun_ajaran'))->groupBy('candidate.id_candidate')->orderBy('no_urut', 'ASC')->get()->getResultArray();
    }
  }
	
	public function getData($id_candidate = null)
	{
	  if ($id_candidate === null) {
	    return $this->orderBy('periode', 'DESC')->orderBy('no_urut', 'ASC')->findAll();
	  } else{
	    return $this->where('id_candidate', $id_candidate)->first();
	  }
	}
	
	public function getTahun()
	{
	  return $this->select('periode')->groupBy('periode')->orderBy('periode', 'DESC')->get()->getResultArray();
	}
}
