<?php

namespace App\Models;

use CodeIgniter\Model;

class GeneralModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'general';
	protected $primaryKey           = 'id_sekolah';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['nama_sekolah','logo_sekolah','alamat_sekolah','email_sekolah','foto_sekolah','status_acara'];
  
  public function getData($field = null)
  {
    $data = $this->where('id_sekolah', '1')->first();
    if ($field == null) {
      return $data;
    } else{
      return $data[$field];
    }
  }
  
}
