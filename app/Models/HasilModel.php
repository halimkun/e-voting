<?php

namespace App\Models;

use CodeIgniter\Model;

class HasilModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'hasil';
	protected $primaryKey           = 'id_hasil';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'object';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['id_candidate', 'id_peserta'];
  
 
  
  
}
