<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'admin';
	protected $primaryKey           = 'id_admin';
	protected $useAutoIncrement     = false;
	protected $returnType           = 'object';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['username','password','nama','foto_profile'];


}
